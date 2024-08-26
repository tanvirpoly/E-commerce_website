<?php
if(!defined('BASEPATH'))
  exit('No direct script access allowed');

class Order extends CI_Controller
{

public function __construct()
  {
  parent::__construct();
  $this->load->model("prime_model", "pm");
  $this->checkPermission();
}

public function index()
  {
  $data['title'] = 'Order';
  if($_SESSION['email'] == 'admin')
  {
      $other = array(
    'order_by' => 'oid',
    'join' => 'left'
        );
  $field = array(
    'order' => 'order.*',
    'users' => 'users.name',
    'customers' => 'customers.customerName,customers.mobile, customers.address'
        );
  $join = array(
    'customers' => 'customers.customerID = order.custid',
    'users' => 'users.uid = order.regby'
        );
  
 
  $data['order'] = $this->pm->get_data('order',false,$field,$join,$other);
  }
  else
  {
     $where = array(
        'order.custid' => $_SESSION['customerID']
        );
      
    $other = array(
    'order_by' => 'oid',
    'join' => 'left'
        );
  $field = array(
    'order' => 'order.*',
    'users' => 'users.name',
    'customers' => 'customers.customerName,customers.mobile, customers.address'
        );
  $join = array(
    'customers' => 'customers.customerID = order.custid',
    'users' => 'users.uid = order.regby'
        );
  
 
  $data['order'] = $this->pm->get_data('order',$where,$field,$join,$other);
  }
  
  
    // var_dump(count($data['order'])); exit();
  $this->load->view('order/order_list', $data);
}

public function new_order()
  {
  $data['title'] = 'Order';

  $where = array(
    'compid' => $_SESSION['compid']
        );
  $dwhere = array(
    'compid' => $_SESSION['compid'],
    'userrole' => 9,
        );

  $data['product'] = $this->pm->get_data('products', $where);
  $data['delivery_man'] = $this->pm->get_data('users', $dwhere);

  $this->load->view('order/new_order', $data);
}

public function getProduct($id)
  {
    $where = array(
      'productID' => $id
    );
    $other = array(
      'join' => 'left'
    );
    $field = array(
      'products' => 'products.*',
      'stock' => 'stock.totalPices'
    );
    $join = array(
      'stock' => 'products.productID = stock.product'
    );
    $productlist = $this->pm->get_data('products', $where, $field, $join, $other);

    $str = "";
    foreach ($productlist as $value) {
      $id = $value['productID'];
      $str .= "<tr>
    <td><input type='text' name='productName[]' value='" . $value['productName'] . "' required ><input type='hidden' readonly='readonly' name='product_id[]' value='" . $value['productID'] . "'></td>
    <td><input type='text' id='quantity_" . $value['productID'] . "' onkeyup='getTotal(" . $id . ")' name='quantity[]' value='0'></td>
    <td>" . $value['sprice'] . "<input type='hidden' onkeyup='getTotal(" . $id . ")' id='tp_" . $value['productID'] . "' name='tp[]' value='" . $value['sprice'] . "'></td>
    <td>
    <input readonly='readonly' type='text' id='totalPrice_" . $value['productID'] . "' name='total_price[]' value='0.00' readonly>
    </td><td>
    <span class='item_remove btn btn-danger btn-xs' onClick='$(this).parent().parent().remove();'>x</span>
    </td></tr>";
    }
    echo json_encode($str);
  }

public function save_order()
  {
    $info = $this->input->post();

    $query = $this->db->select('oid')
      ->from('order')
      ->where('compid', $_SESSION['compid'])
      ->limit(1)
      ->order_by('oid', 'DESC')
      ->get()
      ->row();
    if ($query) {
      $sn = $query->oid + 1;
    } else {
      $sn = 1;
    }

    $cn = strtoupper(substr($_SESSION['compname'], 0, 3));
    $pc = sprintf("%'05d", $sn);

    $cusid = $cn . 'O-' . $pc;

    $quotation = array(
      'compid' => $_SESSION['compid'],
      'oCode' => $cusid,
      'oDate' => date('Y-m-d', strtotime($info['date'])),
      'custid' => $info['customerID'],
      'tAmount' => $info['totalPrice'],
      'paidAmount' => $info['paidAmount'],
      'dueAmount' => $info['dueAmount'],
      'scost' => $info['shiping_cost'],
      //'dOption' => $info['dOption'],
      'shmethod' => $info['shmethod'],
      'sCompany' => $info['sCompany'],
      'sName' => $info['sName'],
      'sMobile' => $info['sMobile'],
      'sAddress' => $info['sAddress'],
      'note' => $info['note'],
      'regby' => $_SESSION['uid']
    );
    //var_dump($quotation); exit();
    $result = $this->pm->insert_data('order', $quotation);
    //var_dump($purchase_id); exit();

    if ($result) {
      $sdata = [
        'exception' => '<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Order add Successfully !</h4>
        </div>'
      ];
    } else {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
      ];
    }
    $this->session->set_userdata($sdata);
    redirect('Order');
  }

public function view_Order($id)
  {
  $data['title'] = 'Order';

    $where = array(
      'oid' => $id
    );
    // var_dump($where);
    $join = array(
      'products' => 'products.productID = order_product.product',
      'sma_units' => 'sma_units.id = products.unit',
    );
    $data['pquotation'] = $this->pm->get_data('order_product', $where, false, $join);
     $whereOne = array(
      'order.oid' => $id
    );
    $field = array(
      'order' => 'order.*',
      'customers' => 'customers.*',
      'sales' => 'sales.paidAmount,sales.scost'
    );

    $join = array(
      'customers' => 'customers.customerID = order.custid',
      'sales' => 'sales.oid = order.oid'
    );
    $quotation = $this->pm->get_data('order', $whereOne, $field, $join);
    $data['quotation'] = $quotation[0];
    // if (!empty($quotation)) {
    //      $data['quotation'] = $quotation[0];
    //     } else {
    //         // Handle the case where no rows are returned, for example:
    //         $data['quotation'] = null; // or any other default value or action you prefer
    //     }

    $data['company'] = $this->pm->company_details();

    $quotation = array(
      'vstatus' => 1
    );

    $this->pm->update_data('order', $quotation, $where);

    $this->load->view('order/view_order', $data);
  }

  public function pos_order_details($sid)
  {
  $pid = $sid;
  $data = [
    'title'   => 'Sales',
    'company' => $this->pm->company_details(),
    'sales'   => $this->pm->get_order_salesdata($pid),
    'salesp'  => $this->pm->get_sales_order_products_data($pid)
      ];
  
  //$this->load->view('sale/view_pos_sales',$data);
  $this->load->view('order/pos_print_details',$data);
}

  public function edit_Order($id)
  {
    $data['title'] = 'Order';

    $cwhere = array(
      'compid' => $_SESSION['compid']
    );
    $dwhere = array(
      'compid' => $_SESSION['compid'],
      'userrole' => 9,
    );
    $data['customer'] = $this->pm->get_data('customers', $cwhere);
    $data['product'] = $this->pm->get_data('products', $cwhere);
    $data['shipping'] = $this->pm->get_data('shipping_method', false);
    $data['delivery_man'] = $this->pm->get_data('users', $dwhere);

    $where = array(
      'oid' => $id
    );
    $join = array(
      'products' => 'products.productID = order_product.product'
    );
    $data['pquotation'] = $this->pm->get_data('order_product', $where, false, $join);

    $quotation = $this->pm->get_data('order', $where);
    $data['quotation'] = $quotation[0];

    $this->load->view('order/edit_order', $data);
  }

  public function update_Order()
  {
    $info = $this->input->post();

    $where = array(
      'oid' => $info['oid']
    );

    $quotation = array(
      'compid' => $_SESSION['compid'],
      'oDate' => date('Y-m-d', strtotime($info['date'])),
      'custid' => $info['customer'],
      'tAmount' => $info['totalPrice'],
      'paidAmount' => $info['paidAmount'],
      'dueAmount' => $info['dueAmount'],
      'scost' => $info['shiping_cost'],
      //'dOption' => $info['dOption'],
      'shmethod' => $info['shmethod'],
      //'sCompany'       => $info['sCompany'],
      'sName' => $info['sName'],
      //'sMobile'        => $info['sMobile'],
      //'sAddress'       => $info['sAddress'],
      'note' => $info['note'],
      'upby' => $_SESSION['uid']
    );

    $result = $this->pm->update_data('order', $quotation, $where);

    $this->pm->delete_data('order_product', $where);

    $length = count($this->input->post('product_id'));

    for ($i = 0; $i < $length; $i++) {
      $qproduct = array(
        'oid' => $info['oid'],
        'product' => $info['product_id'][$i],
        'pName' => $info['productName'][$i],
        'oPrice' => $info['tp'][$i],
        'oQnt' => $info['quantity'][$i],
        'tPrice' => $info['total_price'][$i],
        'regby' => $_SESSION['uid']
      );
      //var_dump($quotation_product); exit();
      $result2 = $this->pm->insert_data('order_product', $qproduct);
    }
    if ($result) {
      $sdata = [
        'exception' => '<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Order update Successfully !</h4>
        </div>'
      ];
    } else {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
      ];
    }
    $this->session->set_userdata($sdata);
    redirect('Order');
  }

  public function delete_Order($id)
  {
    $where = array(
      'oid' => $id
    );

    $result = $this->pm->delete_data('order', $where);
    $result2 = $this->pm->delete_data('order_product', $where);

    if ($result && $result2) {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Order delete Successfully !</h4>
        </div>'
      ];
    } else {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
      ];
    }
    $this->session->set_userdata($sdata);
    redirect('Order');
  }

  public function cancel_Order($id)
  {
    $where = array(
      'oid' => $id
    );

    $quotation = array(
      'status' => 5,
      'upby' => $_SESSION['uid']
    );

    $result = $this->pm->update_data('order', $quotation, $where);

    if ($result) {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Order Cancelled Successfully !</h4>
        </div>'
      ];
    } else {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
      ];
    }
    $this->session->set_userdata($sdata);
    redirect('Order');
  }

  public function sale_Order($id)
  {
    $data['title'] = 'Order';

    $cwhere = array(
      'compid' => $_SESSION['compid']
    );
    $data['customer'] = $this->pm->get_data('customers', false);
    $data['product'] = $this->pm->get_data('products', false);
    $data['shipping'] = $this->pm->get_data('shipping_method', false);

    $where = array(
      'oid' => $id
    );
    $join = array(
      'products' => 'products.productID = order_product.product'
    );
    $data['pquotation'] = $this->pm->get_data('order_product', $where, false, $join);

    $quotation = $this->pm->get_data('order', $where);
    $data['quotation'] = $quotation[0];

    $this->load->view('order/sale_order', $data);
  }

  public function get_shipping_charge()
  {
    $section = $this->pm->get_shipping_method_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
  }

  public function savle_sale_Order()
  {
    $info = $this->input->post();

    $where = array(
      'oid' => $info['oid']
    );

    $order = array(
      'status' => 2,
      'upby' => $_SESSION['uid']
    );

    $this->pm->update_data('order', $order, $where);

    $cashAccount = "SELECT balance,ca_id FROM cash 
    WHERE ca_id = (SELECT MIN(ca_id) FROM cash );";
    $cashDetails = $this->db->query($cashAccount)->row();
    
    $orderNo = $this->input->post('oid');

    $orderAccount = "SELECT (tAmount+scost) as total FROM `order` WHERE  oid = $orderNo;";
    $orderDetails = $this->db->query($orderAccount)->row("total");

    $hit_cash_account = $cashDetails->balance + $orderDetails;
    $where = array(
      'ca_id' => $cashDetails->ca_id
    );

    $data = array(
      'balance' => $hit_cash_account
    );
    $result3 = $this->pm->update_data('cash', $data, $where);
    // echo "<pre>";
    // var_dump($result3);
    // die();

    $query = $this->db->select('saleID')
      ->from('sales')
      ->limit(1)
      ->order_by('saleID', 'DESC')
      ->get()
      ->row();
    if ($query) {
      $sn = $query->saleID + 1;
    } else {
      $sn = 1;
    }
    $cn = strtoupper(substr($_SESSION['compname'], 0, 3));
    $pc = sprintf("%'05d", $sn);

    $cusid = 'INV-' . $cn . $pc;

    $shipping = $this->pm->get_shipping_method_data($info['sMethod']);

    $quotation = array(
      'compid' => $_SESSION['compid'],
      'oid' =>$info['oid'],
      'invoice_no' => $cusid,
      'saleDate' => date('Y-m-d', strtotime($info['date'])),
      'customerID' => $info['customer'],
      'totalAmount' => $info['totalPrice'],
      'paidAmount' => $info['paidAmount'],
       'dueamount' => $info['dueAmount'],
      'shmethod' => $shipping->mName,
      'scost' => $info['shiping_cost'],
      'vAmount' => 0,
      'accountType' => 'Cash',
      'accountNo' => 1,
      'note' => $info['note'],
      'sstatus' => 'Online Sell',
      'regby' => $_SESSION['uid']
    );
    // var_dump($quotation); exit();
    $result = $this->pm->insert_data('sales', $quotation);
    //var_dump($purchase_id); exit();
    if ($result) {
      $length = count($info['product_id']);

      for ($i = 0; $i < $length; $i++) {
        $qdata = array(
          'saleID' => $result,
          'productID' => $info['product_id'][$i],
          'sprice' => $info['tp'][$i],
          'quantity' => $info['quantity'][$i],
          'totalPrice' => $info['total_price'][$i],
          'regby' => $_SESSION['uid']
        );
        //var_dump($purchase_product);            
        $result2 = $this->pm->insert_data('sale_product', $qdata);

        $pid = $info['product_id'][$i];
        $aid = $_SESSION['compid'];

        $swhere = array(
          'product' => $pid,
          'compid' => $aid
        );

        $stpd = $this->pm->get_data('stock', $swhere);

        $this->pm->delete_data('stock', $swhere);

        if ($stpd) {
          $tquantity = ($stpd[0]['totalPices'] - $info['quantity'][$i]);
        } else {
          $tquantity = '-' . $info['quantity'][$i];
        }

        $stock_info = array(
          'compid' => $_SESSION['compid'],
          'product' => $pid,
          'totalPices' => $tquantity,
          'regby' => $_SESSION['uid']
        );
        //var_dump($stock_info);    
        $this->pm->insert_data('stock', $stock_info);
      }
    }
    
    if ($result2 && $result) {

      $sdata = [
        'exception' => '<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Order sale add Successfully !</h4>
        </div>'
      ];
    } else {
      $sdata = [
        'exception' => '<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
      ];
    }
    $this->session->set_userdata($sdata);
    redirect('Order');
  }

  public function order_ledger_report()
  {
    $data['title'] = 'Order Report';
    $data['customer'] = $this->pm->get_data('users', false);
    $data['company'] = $this->pm->company_details();

    if (isset($_GET['search'])) {
      $report = $_GET['reports'];
      if ($report == 'dailyReports') {
        $sdate = date("Y-m-d", strtotime($_GET['sdate']));
        $edate = date("Y-m-d", strtotime($_GET['edate']));
        $data['sdate'] = $sdate;
        $data['edate'] = $edate;
        $data['report'] = $report;
        $uid = $_GET['dcustomer'];

        $where = array(
          'uid' => $uid
        );
        $data['users'] = $this->pm->get_data('users', $where);
        $data['sale'] = $this->pm->user_dorder_ledger($uid, $sdate, $edate);
      } else if ($report == 'monthlyReports') {
        $month = $_GET['month'];
        $data['month'] = $month;
        $year = $_GET['year'];
        $data['year'] = $year;

        if ($month == 01) {
          $name = 'January';
        } elseif ($month == 02) {
          $name = 'February';
        } elseif ($month == 03) {
          $name = 'March';
        } elseif ($month == 04) {
          $name = 'April';
        } elseif ($month == 05) {
          $name = 'May';
        } elseif ($month == 06) {
          $name = 'June';
        } elseif ($month == 07) {
          $name = 'July';
        } elseif ($month == 8) {
          $name = 'August';
        } elseif ($month == 9) {
          $name = 'September';
        } elseif ($month == 10) {
          $name = 'October';
        } elseif ($month == 11) {
          $name = 'November';
        } else {
          $name = 'December';
        }
        $data['name'] = $name;
        $data['report'] = $report;
        $uid = $_GET['mcustomer'];

        $where = array(
          'uid' => $uid
        );
        $data['users'] = $this->pm->get_data('users', $where);
        $data['sale'] = $this->pm->user_morder_ledger($uid, $month, $year);
      } else if ($report == 'yearlyReports') {
        $year = $_GET['ryear'];
        $data['year'] = $year;
        $data['report'] = $report;
        $uid = $_GET['ycustomer'];

        $where = array(
          'uid' => $uid
        );
        $data['users'] = $this->pm->get_data('users', $where);
        $data['sale'] = $this->pm->user_yorder_ledger($uid, $year);
      } else if ($report == 'allReports') {
        $uid = $_GET['customer'];
        $data['report'] = $report;

        $where = array(
          'uid' => $uid
        );
        $data['users'] = $this->pm->get_data('users', $where);
        $data['sale'] = $this->pm->user_aorder_ledger($uid);
      }
    } else {
    }

    $this->load->view('order/order_report', $data);
  }










}
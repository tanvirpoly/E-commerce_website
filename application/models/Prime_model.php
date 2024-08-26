<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Prime_model extends CI_Model
{



  public function get_data($table, $where = false, $fields = false, $join_table = false, $other = false)
  {
    if ($fields != false) {
      foreach ($fields as $coll => $value) {
        $this->db->select($value);
      }
    }

    $this->db->from($table);

    if ($join_table != false) {
      if (is_array($other) && array_key_exists('join', $other)) {
        foreach ($join_table as $coll => $value) {
          $this->db->join($coll, $value, $other['join']);
        }
      } else {
        foreach ($join_table as $coll => $value) {
          $this->db->join($coll, $value);
        }
      }
    }

    if ($where != false) {
      $this->db->where($where);
    }

    if ($other != false) {
      if (array_key_exists('or_where', $other)) {
        $this->db->or_where($other['or_where']);
      }
      if (array_key_exists('order_by', $other)) {
        $this->db->order_by($other['order_by'], 'desc');
      }
      if (array_key_exists('group_by', $other)) {
        $this->db->group_by($other['group_by']);
      }
      if (array_key_exists('limit', $other)) {
        if (array_key_exists('offset', $other)) {
          $this->db->limit($other['limit'], $other['offset']);
        } else {
          $this->db->limit($other['limit']);
        }
      }

      if (array_key_exists('like', $other)) {
        foreach ($other['like'] as $key => $value) {
          $this->db->like($key, $value);
        }
      }
      if (array_key_exists('or_like', $other)) {
        foreach ($other['or_like'] as $key => $value) {
          $this->db->or_like($key, $value);
        }
      }
    }
    $query = $this->db->get();

    $result = $query->result_array();
    //   var_dump($this->db->last_query());
//   die();

    return $result;
  }

  public function insert_data($table, $data)
  {
    $this->db->insert($table, $data);

    return $this->db->insert_id();
  }

  public function update_data($table, $data = false, $where = false)
  {
    $this->db->update($table, $data, $where);

    return $this->db->affected_rows();
  }

  public function delete_data($table, $where)
  {
    $this->db->where($where);
    $this->db->delete($table);

    return $this->db->affected_rows();
  }

  public function count_all($tbl)
  {
    return $this->db->count_all($tbl);
  }

  public function all_query($sql)
  {
    return $result = $this->db->query($sql)->result_array();
  }

  public function check_user_email($id)
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('email', $id)
      ->get();

    $count_row = $query->num_rows();

    if ($count_row == 0) {
      return 1;
    } else {
      return 0;
    }
  }

  public function get_category_data($id)
  {
    $query = $this->db->select('*')
      ->from('categories')
      ->where('categoryID', $id)
      ->get()
      ->row();
    return $query;
  }
  public function get_sub_category_data($id)
  {
    $query = $this->db->select('*')
      ->from('categories_sub')
      ->where('subcategoryID', $id)
      ->get()
      ->row();
    return $query;
  }
  public function get_child_category_data($id)
  {
    $query = $this->db->select('*')
      ->from('categories_child')
      ->where('childcategoryID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_unit_data($id)
  {
    $query = $this->db->select('*')
      ->from('sma_units')
      ->where('id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_size_data($id)
  {
    $query = $this->db->select('*')
      ->from('product_sizes')
      ->where('sizeID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_delivery_time_data($id)
  {
    $query = $this->db->select('*')
      ->from('delivery_time')
      ->where('dtID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_tag_data($id)
  {
    $query = $this->db->select('*')
      ->from('product_tags')
      ->where('tagID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_cost_type_data($id)
  {
    $query = $this->db->select("*")
      ->from('cost_type')
      ->where('ct_id', $id)
      ->get()
      ->row();

    return $query;
  }

  public function get_dept_data($id)
  {
    $query = $this->db->select('*')
      ->from('department')
      ->where('dpt_id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_bank_account($id)
  {
    $query = $this->db->select('*')
      ->from('bankaccount')
      ->where('ba_id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_mobile_transaction($id)
  {
    $query = $this->db->select('*')
      ->from('mobileaccount')
      ->where('ma_id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_user_notice()
  {
    $query = $this->db->select('*')
      ->from('notice')
      ->or_where('ntype', 'All')
      ->or_where('ntype', $_SESSION['uid'])
      ->order_by('nid', 'DESC')
      ->get()
      ->result();
    return $query;
  }

  public function get_user_role_data($id)
  {
    $query = $this->db->select('*')
      ->from('access_lavels')
      ->where('ax_id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_customer_data($id)
  {
    $query = $this->db->select('*')
      ->from('customers')
      ->where('customerID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_countdown_data($id)
  {
    $query = $this->db->select('*')
      ->from('countdown')
      ->where('countdownID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_sales_customer_data($id)
  {
    $cust = $this->db->select('customerID')
      ->from('sales')
      ->where('saleID', $id)
      ->get()
      ->row();

    $query = $this->db->select('mobile')
      ->from('customers')
      ->where('customerID', $cust->customerID)
      ->get()
      ->row();
    return $query;
  }

  public function get_supplier_data($id)
  {
    $query = $this->db->select('*')
      ->from('suppliers')
      ->where('supplierID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_emp_data($id)
  {
    $query = $this->db->select('*')
      ->from('employees')
      ->where('employeeID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_employee()
  {
    $emp = $this->db->select('empid')
      ->from('users')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['empid'];
    }, $emp);
    //var_dump($emp_id); exit();
    if ($emp_id == NULL) {
      $empid = 0;
    } else {
      $empid = $emp_id;
    }
    //var_dump($empid); exit();
    return $this->db->select('employeeID,employeeName')
      ->from('employees')
      ->where_not_in('employeeID', $empid)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();
  }

  public function get_user_data($id)
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('uid', $id)
      ->get()
      ->row();
    return $query;
  }

  public function company_profile_details()
  {
    $query = $this->db->select('*')
      ->from('com_profile')
      ->where('com_pid', 1)
      ->get()
      ->row();
    return $query;
  }

  public function company_details()
  {
    $query = $this->db->select('*')
      ->from('com_profile')
      ->where('com_pid', 1)
      //   ->where('com_pid',$_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function countdown_details()
  {
    $query = $this->db->select('*')
      ->from('countdown')
      ->get()
      ->result();
    return $query;
  }
  public function com_details($print_com)
  {
    $query = $this->db->select('*')
      ->from('com_profile')
      ->where('com_pid', $print_com)
      ->get()
      ->row();
    return $query;
  }

  public function get_company_data($id)
  {
    $query = $this->db->select('*')
      ->from('com_profile')
      ->where('com_pid', $id)
      ->get()
      ->row();
    return $query;
  }

  public function supplier_purchases_due_details($id, $sid)
  {
    $query = $this->db->select("SUM(`due`) as total")
      ->FROM('purchase')
      ->where_not_in('purchaseID', $id)
      ->where('supplier', $sid)
      ->get()
      ->row();
    return $query;
  }

  public function supplier_paid_details($sid)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('supplier', $sid)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function customer_sales_due_details($id, $cusid)
  {
    $query = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`dueamount`) as dtotal")
      ->FROM('sales')
      ->where_not_in('saleID', $id)
      ->WHERE('customerID', $cusid)
      ->get()
      ->row();
    return $query;
  }

  public function customer_vaucher_paid_details($cusid)
  {
    $query = $this->db->select('SUM(`totalamount`) as total')
      ->from('vaucher')
      ->where('customerID', $cusid)
      ->where('vauchertype', 'Credit Voucher')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function customer_returns_details($cusid)
  {
    $query = $this->db->select('SUM(`paidAmount`) as total')
      ->from('returns')
      ->where('customerID', $cusid)
      ->get()
      ->row();
    return $query;
  }

  public function customer_sales_payment($cusid)
  {
    $query = $this->db->select('SUM(sales_payment.amount) as total,sales.customerID')
      ->from('sales_payment')
      ->join('sales', 'sales.saleID = sales_payment.saleID', 'left')
      ->where('customerID', $cusid)
      ->get()
      ->row();
    return $query;
  }

  public function get_profile_data()
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('uid', $_SESSION['uid'])
      ->get()
      ->row();
    return $query;
  }

  public function current_password_check($cpassword)
  {
    return $this->db->select('*')
      ->from('users')
      ->where('password', $cpassword)
      ->get()
      ->row();
  }

  public function get_sales_data()
  {
    if ($_SESSION['role'] > 2) {
      $query = $this->db->select('
                          sales.*,
                          customers.cus_id,
                          customers.customerName,
                          customers.mobile,
                          customers.email,
                          customers.address,
                          users.empid,
                          users.name,
                          users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('sales.regby', $_SESSION['uid'])
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                          sales.*,
                          customers.cus_id,
                          customers.customerName,
                          customers.mobile,
                          customers.email,
                          customers.address,
                          users.empid,
                          users.name,
                          users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_salesdata($sid)
  {
  return $this->db->select('
                    sales.*,
                    customers.customerName,customers.mobile,customers.address')
                ->from('sales')
                ->join('customers','customers.customerID = sales.customerID','left')
                //->join('employees','employees.empid = sales.employee','left')
                ->where('saleID',$sid)
                ->get()
                ->row();
}

public function get_order_salesdata($sid)
  {
  return $this->db->select('
                    order.*,delivery_time.*,
                    customers.customerName,customers.mobile,customers.address,users.name')
                ->from('order')
                ->join('customers','customers.customerID = order.custid','left')
                ->join('delivery_time','delivery_time.dtID = order.dDate','left')
                ->join('users','users.uid = order.sName','left')
                ->where('oid',$sid)
                ->get()
                ->row();
}

public function get_sales_products_data($sid)
  {
  return $this->db->select('sale_product.*,products.productID,products.productName')
                ->from('sale_product')
                ->join('products','products.productID = sale_product.productID','left')
                ->where('saleID',$sid)
                ->get()
                ->result();
}

public function get_sales_order_products_data($sid)
  {
  return $this->db->select('order_product.*,products.productID,products.productName')
                ->from('order_product')
                ->join('products','products.productID = order_product.product','left')
                ->where('oid',$sid)
                ->get()
                ->result();
}

  public function get_dsales_data($sdate, $edate, $customer, $employee, $compid)
  {
    //   var_dump($customer, $employee, $compid, $_SESSION['role']);die;
    if ($_SESSION['role'] > 2) {
      if ($customer == 'All' && $employee == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($customer == 'All' && $employee == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.compid', $compid)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($customer == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.regby', $employee)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($employee == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($customer == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.regby', $employee)
          ->where('sales.compid', $compid)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($employee == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.compid', $compid)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.regby', $employee)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.regby', $employee)
          ->where('sales.compid', $compid)
          ->where('sales.regby', $_SESSION['uid'])
          ->get()
          ->result();
      }
    } else {
      if ($customer == 'All' && $employee == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->get()
          ->result();
      } else if ($customer == 'All' && $employee == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.compid', $compid)
          ->get()
          ->result();
      } else if ($customer == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.regby', $employee)
          ->get()
          ->result();
      } else if ($employee == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->get()
          ->result();
      } else if ($customer == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.regby', $employee)
          ->where('sales.compid', $compid)
          ->get()
          ->result();
      } else if ($employee == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.compid', $compid)
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.regby', $employee)
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                                sales.*,
                                customers.cus_id,
                                customers.customerName,
                                customers.mobile,
                                customers.email,
                                customers.address,
                                users.empid,
                                users.name,
                                users.mobile as umobile')
          ->from('sales')
          ->join('customers', 'customers.customerID = sales.customerID', 'left')
          ->join('users', 'users.uid = sales.regby', 'left')
          ->where('sales.saleDate >=', $sdate)
          ->where('sales.saleDate <=', $edate)
          ->where('sales.customerID', $customer)
          ->where('sales.regby', $employee)
          ->where('sales.compid', $compid)
          ->get()
          ->result();
      }
    }
    return $query;
  }

  public function get_msales_data($month, $year, $customer, $employee, $compid)
  {
    if ($customer == 'All' && $employee == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->get()
        ->result();
    } else if ($customer == 'All' && $employee == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($customer == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.regby', $employee)
        ->get()
        ->result();
    } else if ($employee == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->get()
        ->result();
    } else if ($customer == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.regby', $employee)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($employee == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.regby', $employee)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.regby', $employee)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_ysales_data($year, $customer, $employee, $compid)
  {
    if ($customer == 'All' && $employee == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->get()
        ->result();
    } else if ($customer == 'All' && $employee == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($customer == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.regby', $employee)
        ->get()
        ->result();
    } else if ($employee == 'All' && $compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->get()
        ->result();
    } else if ($customer == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.regby', $employee)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($employee == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    } else if ($compid == 'All') {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.regby', $employee)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                            sales.*,
                            customers.cus_id,
                            customers.customerName,
                            customers.mobile,
                            customers.email,
                            customers.address,
                            users.empid,
                            users.name,
                            users.mobile as umobile')
        ->from('sales')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->join('users', 'users.uid = sales.regby', 'left')
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sales.customerID', $customer)
        ->where('sales.regby', $employee)
        ->where('sales.compid', $compid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_purchses_data()
  {
    if ($_SESSION['role'] > 2) {
      $query = $this->db->select('
                          purchase.*,
                          suppliers.sup_id,
                          suppliers.compname')
        ->from('purchase')
        ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
        ->where('purchase.compid', $_SESSION['compid'])
        ->where('purchase.regby', $_SESSION['uid'])
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                          purchase.*,
                          suppliers.sup_id,
                          suppliers.compname')
        ->from('purchase')
        ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_dpurchses_data($sdate, $edate, $supid, $compid)
  {
    if ($_SESSION['role'] > 2) {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                purchase.*,
                                suppliers.sup_id,
                                suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.supplier', $supid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      }
    } else {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                                purchase.*,
                                suppliers.sup_id,
                                suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.supplier', $supid)
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('purchase.purchaseDate >=', $sdate)
          ->where('purchase.purchaseDate <=', $edate)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      }
    }
    return $query;
  }

  public function get_mpurchses_data($month, $year, $supid, $compid)
  {
    if ($_SESSION['role'] > 2) {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      }
    } else {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('MONTH(purchaseDate)', $month)
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      }
    }

    return $query;
  }

  public function get_ypurchses_data($year, $supid, $compid)
  {
    if ($_SESSION['role'] > 2) {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->where('purchase.regby', $_SESSION['uid'])
          ->get()
          ->result();
      }
    } else {
      if ($supid == 'All' && $compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->get()
          ->result();
      } else if ($supid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      } else if ($compid == 'All') {
        $query = $this->db->select('
                            purchase.*,
                            suppliers.sup_id,
                            suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->get()
          ->result();
      } else {
        $query = $this->db->select('
                              purchase.*,
                              suppliers.sup_id,
                              suppliers.compname')
          ->from('purchase')
          ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
          ->where('YEAR(purchaseDate)', $year)
          ->where('purchase.supplier', $supid)
          ->where('purchase.compid', $compid)
          ->get()
          ->result();
      }
    }
    return $query;
  }

  public function total_stock_sell_amount()
  {
    $total = 0;
    $query = $this->db->select("totalPices, products.sprice")
      ->FROM('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      //   ->where('compid',$_SESSION['compid'])
      ->get()
      ->result();
    foreach ($query as $q) {

      $total += $q->totalPices * $q->sprice;
    }
    return $total;
  }
  public function total_stock_purchase_amount()
  {
    $total = 0;
    $query = $this->db->select("totalPices, products.pprice")
      ->FROM('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      //   ->where('compid',$_SESSION['compid'])
      ->get()
      ->result();
    foreach ($query as $q) {

      $total += $q->totalPices * $q->pprice;
    }
    return $total;
  }

  public function total_sales_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }


  public function total_cogs_amount()
  {
    $query = $this->db->select("sale_product.quantity,products.pprice")
      ->FROM('sale_product')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->get()
      ->result();
    return $query;
  }

  public function total_purchases_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_emp_payments_amount()
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_returns_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_preturns_amount()
  {
    $query = $this->db->select("SUM(`paidPrice`) as total")
      ->FROM('preturns')
      //   ->where('compid',$_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_cvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_dvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_svoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_dsales_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('sales.saleDate >=', $sdate)
      ->where('sales.saleDate <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function total_dpurchases_amount($sdate, $edate)
  {
    //   $query = $this->db->select("sale_product.quantity,products.pprice")
//                   ->FROM('sale_product')
//                   ->join('products','products.productID = sale_product.productID','left')
//                   ->where('DATE(sale_product.regdate) >=', $sdate)
//                   ->where('DATE(sale_product.regdate) <=', $edate)
//                   ->get()
//                   ->result();

    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('DATE(purchase.regdate) >=', $sdate)
      ->where('DATE(purchase.regdate) <=', $edate)
      ->get()
      ->row();

    return $query;
  }

  // public function total_dpurchases_amount($sdate,$edate)
//   {
//   $query = $this->db->select("SUM(`paidAmount`) as total")
//                   ->FROM('purchase')
//                   ->WHERE('compid',$_SESSION['compid'])
//                   ->where('purchaseDate >=', $sdate)
//                   ->where('purchaseDate <=', $edate)
//                   ->get()
//                   ->row();
//   return $query;  
// }

  public function total_demp_payments_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(salary) as total")
      ->FROM('employee_payment')
      //->WHERE('compid',$_SESSION['compid'])
      ->where('DATE(regdate) >=', $sdate)
      ->where('DATE(regdate) <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function total_dreturns_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('returnDate >=', $sdate)
      ->where('returnDate <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function total_dpreturns_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`paidPrice`) as total")
      ->FROM('preturns')
      ->where('prDate >=', $sdate)
      ->where('prDate <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function total_dcvoucher_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_ddvoucher_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_dsvoucher_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_msales_amount($month, $year)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('MONTH(sales.regdate)', $month)
      ->where('YEAR(sales.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_mpurchases_amount($month, $year)
  {
    //   $query = $this->db->select("sale_product.quantity,products.pprice")
//                   ->FROM('sale_product')
//                   ->join('products','products.productID = sale_product.productID','left')
//                   ->where('MONTH(sale_product.regdate)',$month)
//                   ->where('YEAR(sale_product.regdate)',$year)
//                   ->get()
//                   ->result();

    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('MONTH(purchase.regdate)', $month)
      ->where('YEAR(purchase.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_memp_payments_amount($month, $year)
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('MONTH(regdate)', $month)
      ->where('YEAR(regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_mreturns_amount($month, $year)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('MONTH(returnDate)', $month)
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_mpreturns_amount($month, $year)
  {
    $query = $this->db->select("SUM(`paidPrice`) as total")
      ->FROM('preturns')
      ->where('MONTH(prDate)', $month)
      ->where('YEAR(prDate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_mcvoucher_amount($month, $year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_mdvoucher_amount($month, $year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_msvoucher_amount($month, $year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_ysales_amount($year)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('YEAR(sales.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_ypurchases_amount($year)
  {
    //   $query = $this->db->select("sale_product.quantity,products.pprice")
//                   ->FROM('sale_product')
//                   ->join('products','products.productID = sale_product.productID','left')
//                   ->where('YEAR(sale_product.regdate)',$year)
//                   ->get()
//                   ->result();

    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('YEAR(purchase.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_yemp_payments_amount($year)
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('YEAR(regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_yreturns_amount($year)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_ypreturns_amount($year)
  {
    $query = $this->db->select("SUM(`paidPrice`) as total")
      ->FROM('preturns')
      ->where('YEAR(prDate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_ycvoucher_amount($year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_ydvoucher_amount($year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function total_ysvoucher_amount($year)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function check_email($empemail)
  {
    return $this->db->select('*')
      ->from('users')
      ->where('email', $empemail)
      ->get()
      ->row();
  }

  public function check_mobile_number($mid)
  {
    return $this->db->select('*')
      ->from('users')
      ->where('mobile', $mid)
      ->get()
      ->row();
  }

  public function sales_cust_ledger_data($custid)
  {
    //var_dump($custid); exit();
    $query = $this->db->select("*")
      ->FROM('sales')
      ->WHERE('customerID', $custid)
      ->get()
      ->result();
    return $query;
  }

  public function voucher_cust_ledger_data($custid)
  {
    $query = $this->db->select("*")
      ->FROM('vaucher')
      ->WHERE('customerID', $custid)
      ->where('status', 1)
      ->get()
      ->result();
    return $query;
  }

  public function return_cust_ledger_data($custid)
  {
    $query = $this->db->select("*")
      ->FROM('returns')
      ->WHERE('customerID', $custid)
      ->get()
      ->result();
    return $query;
  }

  public function payment_cust_ledger_data($custid)
  {
    $query = $this->db->select("*")
      ->FROM('customer_payment')
      ->WHERE('custid', $custid)
      ->get()
      ->result();
    return $query;
  }

  public function sales_dcust_ledger_data($custid, $sdate, $edate)
  {
    $query = $this->db->select("*")
      ->FROM('sales')
      ->WHERE('customerID', $custid)
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->get()
      ->result();
    //var_dump($query); exit();
    return $query;
  }

  public function voucher_dcust_ledger_data($custid, $sdate, $edate)
  {
    $query = $this->db->select("*")
      ->FROM('vaucher')
      ->WHERE('customerID', $custid)
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->result();
    //var_dump($query); exit();
    return $query;
  }

  public function return_dcust_ledger_data($custid, $sdate, $edate)
  {
    $query = $this->db->select("*")
      ->FROM('returns')
      ->WHERE('customerID', $custid)
      ->where('returnDate >=', $sdate)
      ->where('returnDate <=', $edate)
      ->get()
      ->result();
    //var_dump($query); exit();
    return $query;
  }

  public function payment_dcust_ledger_data($custid, $sdate, $edate)
  {
    $query = $this->db->select("*")
      ->FROM('customer_payment')
      ->WHERE('custid', $custid)
      ->where('pDate >=', $sdate)
      ->where('pDate <=', $edate)
      ->get()
      ->result();
    return $query;
  }

  public function sales_mcust_ledger_data($custid, $month, $year)
  {
    $query = $this->db->select("*")
      ->FROM('sales')
      ->WHERE('customerID', $custid)
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function voucher_mcust_ledger_data($custid, $month, $year)
  {
    $query = $this->db->select("*")
      ->FROM('vaucher')
      ->WHERE('customerID', $custid)
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->result();
    return $query;
  }

  public function return_mcust_ledger_data($custid, $month, $year)
  {
    $query = $this->db->select("*")
      ->FROM('returns')
      ->WHERE('customerID', $custid)
      ->where('MONTH(returnDate)', $month)
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function payment_mcust_ledger_data($custid, $month, $year)
  {
    $query = $this->db->select("*")
      ->FROM('customer_payment')
      ->WHERE('custid', $custid)
      ->where('MONTH(pDate)', $month)
      ->where('YEAR(pDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function sales_ycust_ledger_data($custid, $year)
  {
    $query = $this->db->select("*")
      ->FROM('sales')
      ->WHERE('customerID', $custid)
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function voucher_ycust_ledger_data($custid, $year)
  {
    $query = $this->db->select("*")
      ->FROM('vaucher')
      ->WHERE('customerID', $custid)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->result();
    return $query;
  }

  public function return_ycust_ledger_data($custid, $year)
  {
    $query = $this->db->select("*")
      ->FROM('returns')
      ->WHERE('customerID', $custid)
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function payment_ycust_ledger_data($custid, $year)
  {
    $query = $this->db->select("*")
      ->FROM('customer_payment')
      ->WHERE('custid', $custid)
      ->where('YEAR(pDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function get_voucher_data()
  {
    if ($_SESSION['role'] > 2) {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('compid', $_SESSION['compid'])
        ->where('status', 1)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('status', 1)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_dall_voucher_data($sdate, $edate, $vtype, $compid)
  {
    if ($vtype == 'All' && $compid = 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('voucherdate >=', $sdate)
        ->where('voucherdate <=', $edate)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($vtype == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('voucherdate >=', $sdate)
        ->where('voucherdate <=', $edate)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($compid == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('voucherdate >=', $sdate)
        ->where('voucherdate <=', $edate)
        ->where('vauchertype', $vtype)
        ->where('status', 1)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('voucherdate >=', $sdate)
        ->where('voucherdate <=', $edate)
        ->where('vauchertype', $vtype)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_mall_voucher_data($month, $year, $vtype, $compid)
  {
    if ($vtype == 'All' && $compid = 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('MONTH(voucherdate)', $month)
        ->where('YEAR(voucherdate)', $year)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($vtype == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('MONTH(voucherdate)', $month)
        ->where('YEAR(voucherdate)', $year)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($compid == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('MONTH(voucherdate)', $month)
        ->where('YEAR(voucherdate)', $year)
        ->where('vauchertype', $vtype)
        ->where('status', 1)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('MONTH(voucherdate)', $month)
        ->where('YEAR(voucherdate)', $year)
        ->where('vauchertype', $vtype)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_yall_voucher_data($year, $vtype, $compid)
  {
    if ($vtype == 'All' && $compid = 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('YEAR(voucherdate)', $year)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($vtype == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('YEAR(voucherdate)', $year)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    } else if ($compid == 'All') {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('YEAR(voucherdate)', $year)
        ->where('vauchertype', $vtype)
        ->where('status', 1)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("*")
        ->from('vaucher')
        ->where('YEAR(voucherdate)', $year)
        ->where('vauchertype', $vtype)
        ->where('compid', $compid)
        ->where('status', 1)
        ->get()
        ->result();
    }
    return $query;
  }

  public function daily_sales_amount($date)
  {
    $query = $this->db->select("SUM(paidAmount) as total")
      ->FROM('sales')
      ->where('saleDate', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function daily_purchases_amount($date)
  {
    $query = $this->db->select("SUM(sale_product.quantity * products.pprice) as tprice")
      ->FROM('sale_product')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->where('DATE(sale_product.regdate)', $date)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function daily_dvoucher_amount($date)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function daily_svoucher_amount($date)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function daily_empslry_amount($date)
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      //->WHERE('vauchertype','Supplier Pay')
      ->where('DATE(regdate)', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function daily_returns_amount($date)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('returnDate', $date)
      ->get()
      ->row();
    return $query;
  }
  public function daily_preturns_amount($date)
  {
    $query = $this->db->select("SUM(`paidPrice`) as total")
      ->FROM('preturns')
      ->where('prDate', $date)
      ->get()
      ->row();
    return $query;
  }

  public function period_sales_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(paidAmount) as total")
      ->FROM('sales')
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function period_purchases_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(sale_product.quantity * products.pprice) as tprice")
      ->FROM('sale_product')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->where('DATE(sale_product.regdate) >=', $sdate)
      ->where('DATE(sale_product.regdate) <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function period_dvoucher_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function period_svoucher_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function period_empslry_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('DATE(regdate) >=', $sdate)
      ->where('DATE(regdate) <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function period_returns_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('returnDate >=', $sdate)
      ->where('returnDate <=', $edate)
      ->get()
      ->row();
    return $query;
  }
  public function today_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(paidAmount) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('saleDate', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }
  public function today_due_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(dueamount) as totalDue")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('saleDate', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function staff_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(totalAmount) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('regby', $_SESSION['uid'])
      ->get()
      ->row();
    // var_dump($this->db->last_query($query)); die();
    return $query;
  }

  public function today_online_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(tAmount) as total")
      ->FROM('order')
      ->where('oDate',$date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }
  public function today_service_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(pAmount) as total")
      ->FROM('service_sale')
      ->where('compid', $_SESSION['compid'])
      ->where('ssDate', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function today_purchases_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("sale_product.quantity,products.pprice")
      ->FROM('sale_product')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->where('DATE(sale_product.regdate)', $date)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function today_purchases_sum_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(paidAmount) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->where('purchaseDate', $date)
      ->get()
      ->row();
    return $query;
  }


  public function today_emp_payments_amount()
  {
    $d = date('d');
    $m = date('m');
    $y = date('Y');
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->where('DAY(regdate)', $d)
      ->where('MONTH(regdate)', $m)
      ->where('YEAR(regdate)', $y)
      ->get()
      ->row();
    return $query;
  }

  public function today_returns_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->where('returnDate', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_due_payment()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`amount`) as total")
      ->FROM('sales_payment')
      ->where('DATE(regdate)', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_bank_withdraw()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`amount`) as total")
      ->FROM('transfer_account')
      ->where('facType', 'Bank')
      ->where('DATE(regdate)', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_bank_transfer()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`amount`) as total")
      ->FROM('transfer_account')
      ->where('sacType', 'Bank')
      ->where('DATE(regdate)', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_collection_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`amount`) as total")
      ->FROM('sales_payment')
      ->where('date(regdate)', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_cpayment_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`pAmount`) as total")
      ->FROM('customer_due_payment')
      ->where('date(pDate)', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_cvoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function today_dvoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function today_svoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function today_empslry_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      //->WHERE('vauchertype','Supplier Pay')
      ->where('DATE(regdate)', $date)
      ->get()
      ->row();
    //var_dump($query); exit();
    return $query;
  }

  public function today_product_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(sale_product.totalPrice) as ta,SUM(sale_product.quantity) as tq,sale_product.productID,sale_product.quantity,sales.saleDate")
      ->FROM('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->where('sales.saleDate', $date)
      ->where('compid', $_SESSION['compid'])
      ->group_by('sale_product.productID')
      ->get()
      ->result();
    return $query;
  }

  public function pre_sales_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('saleDate <', $date)
      ->get()
      ->row();
    return $query;
  }

  public function pre_purchases_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->where('purchaseDate <', $date)
      ->get()
      ->row();
    return $query;
  }

  public function pre_emp_payments_amount()
  {
    $d = date('d');
    $m = date('m');
    $y = date('Y');
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->where('DAY(regdate) <', $d)
      ->where('MONTH(regdate) <=', $m)
      ->where('YEAR(regdate) <=', $y)
      ->get()
      ->row();
    return $query;
  }

  public function pre_returns_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->where('returnDate <', $date)
      ->get()
      ->row();
    return $query;
  }

  public function pre_cvoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('voucherdate <', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function pre_dvoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate <', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function pre_svoucher_amount()
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate <', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function get_dspurchase_data($sdate, $edate, $sid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('purchaseDate >=', $sdate)
      ->where('purchaseDate <=', $edate)
      ->where('supplier', $sid)
      ->get()
      ->result();

    return $query;
  }

  public function get_dsvoucher_data($sdate, $edate, $sid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('supplier', $sid)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_dpurchase_return_data($sdate, $edate, $sid)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('prDate >=', $sdate)
      ->where('prDate <=', $edate)
      ->where('customerID', $sid)
      ->get()
      ->result();

    return $query;
  }

  public function get_mspurchase_data($month, $year, $sid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('MONTH(purchaseDate)', $month)
      ->where('YEAR(purchaseDate)', $year)
      ->where('supplier', $sid)
      ->get()
      ->result();

    return $query;
  }
  public function get_cash_account_data($id)
  {
    $query = $this->db->select('*')
      ->from('cash')
      ->where('ca_id', $id)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function get_msvoucher_data($month, $year, $sid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('supplier', $sid)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_mpurchase_return_data($month, $year, $sid)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('MONTH(prDate)', $month)
      ->where('YEAR(prDate)', $year)
      ->where('customerID', $sid)
      ->get()
      ->result();

    return $query;
  }


  public function get_yspurchase_data($year, $sid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('YEAR(purchaseDate)', $year)
      ->where('supplier', $sid)
      ->get()
      ->result();

    return $query;
  }

  public function get_ysvoucher_data($year, $sid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('YEAR(voucherdate)', $year)
      ->where('supplier', $sid)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_ypurchase_return_data($year, $sid)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('YEAR(prDate)', $year)
      ->where('customerID', $sid)
      ->get()
      ->result();

    return $query;
  }

  public function total_category()
  {
    $query = $this->db->select('*')
      ->from('categories')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_unit()
  {
    $query = $this->db->select('*')
      ->from('sma_units')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_expense_type()
  {
    $query = $this->db->select('*')
      ->from('cost_type')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_depertment()
  {
    $query = $this->db->select('*')
      ->from('department')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_bank_account()
  {
    $query = $this->db->select('*')
      ->from('bankaccount')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_mobile_account()
  {
    $query = $this->db->select('*')
      ->from('mobileaccount')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_notice()
  {
    $query = $this->db->select('*')
      ->from('notice')
      ->or_where('ntype', 'All')
      ->or_where('ntype', $_SESSION['uid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_user_type()
  {
    $query = $this->db->select('*')
      ->from('access_lavels')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_balance_transfer()
  {
    $query = $this->db->select('SUM(amount) as total')
      ->from('transfer_account')
      ->get()
      ->row();

    return $query;
  }

  public function product_fetch_data($compid)
  {
    $this->db->order_by("productID", "DESC");
    $this->db->where('compid', $compid);
    $query = $this->db->get("products");

    return $query->result();
  }

  public function product_image($pid)
  {
    return $this->db->select('*')
      ->from('products')
      ->where('productID', $pid)
      ->get()
      ->row();
  }

  public function insert_product_data($data)
  {
    $this->db->insert_batch('products', $data);
  }

  public function get_purchase_payment($id)
  {
    $query = $this->db->select('paidAmount,due')
      ->from('purchase')
      ->where('purchaseID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_sales_payment($id)
  {
    $query = $this->db->select('paidAmount,dueamount')
      ->from('sales')
      ->where('saleID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function total_customer()
  {
    $query = $this->db->select('*')
      ->from('customers')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_supplier()
  {
    $query = $this->db->select('*')
      ->from('suppliers')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_product()
  {
    $query = $this->db->select('*')
      ->from('products')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_employee()
  {
    $query = $this->db->select('*')
      ->from('employees')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_user()
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('compid', $_SESSION['compid'])
      ->get();

    $count_row = $query->num_rows();

    return $count_row;
  }

  public function total_sale()
  {
    $query = $this->db->select("SUM(`totalAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }
public function total_sale_order_due()
{
    $date = date('Y-m-d');
    $querySales = $this->db->select("SUM(`paidAmount`) as total")
                                ->from('sales')
                                ->where('saleDate',$date)
                                ->get()->row();
    
    $queryOrder = $this->db->select("SUM(`totalAmount`) as totalOne")
                          ->from('order')
                          ->where('oDate',$date)
                          ->where('status', 2)
                          ->get()->row();

    $queryDuePayment = $this->db->select("SUM(`pAmount`) as totalTwo")
                                ->from('customer_due_payment')
                                ->where('pDate',$date)
                                ->get()->row();

    $total = $querySales->total + $queryOrder->totalOne + $queryDuePayment->totalTwo;

    return $total;
    

}


  public function total_purchase()
  {
    $query = $this->db->select("SUM(`totalPrice`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_stock()
  {
    $query = $this->db->select('SUM(`totalPices`) as total')
      ->from('stock')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_voucher()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function get_stock_data($id)
  {
    $query = $this->db->select('totalPices')
      ->from('stock')
      ->where('product', $id)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function customer_fetch_data($compid)
  {
    $this->db->where('compid', $compid);
    $query = $this->db->get("customers");
    return $query->result();
  }

  public function insert_customer_data($data)
  {
    $this->db->insert_batch('customers', $data);
  }

  public function supplier_fetch_data($compid)
  {
    $this->db->order_by("supplierID", "DESC");
    $this->db->where('compid', $compid);
    $query = $this->db->get("suppliers");
    return $query->result();
  }

  public function insert_supplier_data($data)
  {
    $this->db->insert_batch('suppliers', $data);
  }

  public function count_all_user()
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('userrole', 2)
      ->get();

    $count_row = $query->num_rows();
    return $count_row;
  }

  public function get_today_order_data(){
    $date = date('Y-m-d');
      $query = $this->db->select('order.*,users.name,delivery_time.delivery_time,customers.customerName,customers.mobile, customers.address')
        ->from('order')
        ->join('delivery_time','delivery_time.dtID = order.dDate','left')
        ->join('customers','customers.customerID = order.custid','left')
        ->join('users','users.uid = order.sName','left')
        ->where('oDate',$date)
        ->get()
        ->result_array();
        return $query;
  }
    

  public function get_today_sales_data(){
    $date = date('Y-m-d');
      $query = $query = $this->db->select('
      sales.*,
      customers.cus_id,
      customers.customerName,
      customers.mobile,
      customers.email,
      customers.address,
      users.empid,
      users.name,
      users.mobile as umobile')
->from('sales')
->join('customers', 'customers.customerID = sales.customerID', 'left')
->join('users', 'users.uid = sales.regby', 'left')
->where('sales.saleDate', $date)
// ->where('sales.regby', $_SESSION['uid'])
->get()
->result_array();
        return $query;
  }

  public function count_all_order()
  {
      $query_result= 0;
    if ($_SESSION['role'] == 2) {
      $date = date('Y-m-d');
      $query = $this->db->select('*')
        ->from('order')
        ->where('status',2)
        ->where('oDate',$date)
        ->get();
    } else if($_SESSION['role'] == 8)  {
      $query = $this->db->select('*')
        ->from('order')
        ->where('status',2)
        ->where('regby',$_SESSION['uid'])
        ->get();
    }else {
      $query = $this->db->select('*')
        ->from('order')
        ->where('status',2)
        ->where('sName', $_SESSION['uid'])
        ->get();
    }
    $count_row = $query->num_rows();
    foreach($query->result() as $row)
    {
        $query_result += $row->tAmount;
    }
    return ['count_row'=>$count_row,'query_result'=>$query_result];
  }


  public function count_all_active_user()
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('userrole', 2)
      ->where('status', 'Active')
      ->get();

    $count_row = $query->num_rows();
    return $count_row;
  }

  public function count_all_inactive_user()
  {
    $query = $this->db->select('*')
      ->from('users')
      ->where('userrole', 2)
      ->where('status', 'Inactive')
      ->get();

    $count_row = $query->num_rows();
    return $count_row;
  }

  public function count_all_today_user()
  {
    $d = date('d');
    $m = date('m');
    $y = date('Y');

    $query = $this->db->select('*')
      ->from('users')
      ->where('userrole', 2)
      ->where('DAY(regdate)', $d)
      ->where('MONTH(regdate)', $m)
      ->where('YEAR(regdate)', $y)
      ->get();

    $count_row = $query->num_rows();
    return $count_row;
  }

  public function count_all_month_user()
  {
    $m = date('m');
    $y = date('Y');

    $query = $this->db->select('*')
      ->from('users')
      ->where('userrole', 2)
      ->where('MONTH(regdate)', $m)
      ->where('YEAR(regdate)', $y)
      ->get();

    $count_row = $query->num_rows();
    return $count_row;
  }

  public function graph_data_point()
  {
    $date_arr = $this->getLastNDays(7, 'Y-m-d');
    $dataPoints = array();

    for ($i = 0; $i < 7; $i++) {
      array_push($dataPoints, array("y" => $this->get_today_sale(preg_replace('/[^A-Za-z0-9\-]/', '', $date_arr[$i])), "label" => preg_replace('/[^A-Za-z0-9\-]/', '', $date_arr[$i])));
    }

    return $dataPoints;
  }

  public function get_today_sale($date)
  {
    $query = $this->db->select("SUM(`totalAmount`) as total")
      ->FROM('sales')
      ->where('saleDate', $date)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();

    if ($query->total) {
      return $query->total;
    } else {
      $dt = 0;
      return $dt;
    }
  }

  public function getLastNDays($days, $format = 'd-m')
  {
    $m = date("m");
    $de = date("d");
    $y = date("Y");
    $dateArray = array();
    for ($i = 0; $i <= $days - 1; $i++) {
      $dateArray[] = '"' . date($format, mktime(0, 0, 0, $m, ($de - $i), $y)) . '"';
    }
    return array_reverse($dateArray);
  }

  public function get_page_and_function()
  {
    $query = $this->db->select('
              tbl_page_functions.pfunc_id,
              tbl_page_functions.pageid,
              tbl_page_functions.fcname,
              tbl_pages.pageid,
              tbl_pages.master_page,
              tbl_pages.cname,
              tbl_master_page_title.master_id,
              tbl_master_page_title.c_master_title')
      ->from('tbl_pages')
      ->join('tbl_master_page_title', 'tbl_master_page_title.master_id = tbl_pages.master_page', 'left')
      ->join('tbl_page_functions', 'tbl_page_functions.pageid = tbl_pages.pageid', 'left')
      ->get()
      ->result();
    return $query;
  }

  public function saveNewMaster_data($data)
  {
    $column = $data['master_title'];
    $table = 'tbl_user_m_permission';

    $fields = array(
      'preferences' => array('type' => 'INT', 'constraint' => 5)
    );

    $fields2 = array(
      'preferences' => array(
        'name' => $column,
        'type' => 'INT',
        'constraint' => 5
      ),
    );
    // $add = mysql_query("ALTER TABLE $table ADD $column INT( 1 ) NOT NULL");
    $this->load->dbforge();
    $this->dbforge->add_column('tbl_user_m_permission', $fields);

    $this->load->dbforge();
    $add = $this->dbforge->modify_column('tbl_user_m_permission', $fields2);
    // var_dump($add); exit();
    return $this->db->insert('tbl_master_page_title', $data);
  }

  public function saveNewPage_data($data)
  {
    $column = $data['pagename'];
    $table = 'tbl_user_p_permission';

    $fields = array(
      'preferences' => array('type' => 'INT', 'constraint' => 5)
    );

    $fields2 = array(
      'preferences' => array(
        'name' => $column,
        'type' => 'INT',
        'constraint' => 5
      ),
    );
    // $add = mysql_query("ALTER TABLE $table ADD $column INT( 1 ) NOT NULL");
    $this->load->dbforge();
    $this->dbforge->add_column('tbl_user_p_permission', $fields);

    $this->load->dbforge();
    $add = $this->dbforge->modify_column('tbl_user_p_permission', $fields2);
    // var_dump($add); exit();
    return $this->db->insert('tbl_pages', $data);
  }

  public function saveNewPageFunction_data($data)
  {
    $column = $data['pfunc_name'];
    $table = 'tbl_user_f_permission';

    $fields = array(
      'preferences' => array('type' => 'INT', 'constraint' => 5)
    );

    $fields2 = array(
      'preferences' => array(
        'name' => $column,
        'type' => 'INT',
        'constraint' => 5
      ),
    );
    // $add = mysql_query("ALTER TABLE $table ADD $column INT( 1 ) NOT NULL");
    $this->load->dbforge();
    $this->dbforge->add_column('tbl_user_f_permission', $fields);

    $this->load->dbforge();
    $add = $this->dbforge->modify_column('tbl_user_f_permission', $fields2);
    // var_dump($add); exit();
    return $this->db->insert('tbl_page_functions', $data);
  }

  public function get_page_data_by_master($id)
  {
    $query = $this->db->select('*')
      ->from('tbl_pages')
      ->where('master_page', $id)
      ->get()
      ->result();
    return $query;
  }

  public function get_user_permission_data()
  {
    $emp = $this->db->select('compid')
      ->from('tbl_user_m_permission')
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['compid'];
    }, $emp);

    if ($emp_id == null) {
      $emp_id = 0;
    }

    $emps = $this->db->select('compid,name,compname')
      ->from('users')
      ->where_not_in('compid', $emp_id)
      ->where('userrole', 2)
      ->get()
      ->result();
    return $emps;
  }

  public function total_sales_product()
  {
    $query = $this->db->select("
                        SUM(sale_product.quantity) as tq,
                        SUM(sale_product.totalPrice) as ta,
                        sale_product.productID,
                        sales.compid,
                        sale_product.saleID,
                        sales.saleDate")
      ->from('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->group_by('sale_product.productID')
      ->get()
      ->result();
    return $query;
  }

  public function total_dsales_product($sdate, $edate)
  {
    $query = $this->db->select("
                        SUM(sale_product.quantity) as tq,
                        SUM(sale_product.totalPrice) as ta,
                        sale_product.productID,
                        sales.compid,
                        sales.saleDate,
                        sales.saleID")
      ->from('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->where('compid', $_SESSION['compid'])
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->group_by('productID')
      ->get()
      ->result();
    return $query;
  }

  public function total_msales_product($month, $year)
  {
    $query = $this->db->select("
                        SUM(sale_product.quantity) as tq,
                        SUM(sale_product.totalPrice) as ta,
                        sale_product.productID,
                        sales.compid,
                        sales.saleDate")
      ->from('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->group_by('productID')
      ->where('compid', $_SESSION['compid'])
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function total_ysales_product($year)
  {
    $query = $this->db->select("
                        SUM(sale_product.quantity) as tq,
                        SUM(sale_product.totalPrice) as ta,
                        sale_product.productID,
                        sales.compid,
                        sales.saleDate")
      ->from('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->group_by('productID')
      ->where('compid', $_SESSION['compid'])
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function get_help_reply_data($id)
  {
    $query = $this->db->select("help_support_reply.reply,users.name")
      ->from('help_support_reply')
      ->join('users', 'users.uid = help_support_reply.regby', 'left')
      ->where('hp_id', $id)
      ->get()
      ->result();
    return $query;
  }

  public function get_user_notice_data($id)
  {
    $query = $this->db->select('*')
      ->from('notice')
      ->where('nid', $id)
      ->get()
      ->row();
    return $query;
  }



  public function today_sales($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal")
      ->FROM('sales')
      ->where('compid', $cid)
      ->where('saleDate', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_purchases($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
      ->FROM('purchase')
      ->where('compid', $cid)
      ->where('purchaseDate', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_emp_payments($cid)
  {
    $d = date('d');
    $m = date('m');
    $y = date('Y');
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $cid)
      ->where('DAY(regdate)', $d)
      ->where('MONTH(regdate)', $m)
      ->where('YEAR(regdate)', $y)
      ->get()
      ->row();
    return $query;
  }

  public function today_returns($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $cid)
      ->where('returnDate', $date)
      ->get()
      ->row();
    return $query;
  }

  public function today_cvouchers($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $cid)
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function today_dvouchers($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $cid)
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function today_svouchers($cid)
  {
    $date = date('Y-m-d');
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $cid)
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('voucherdate', $date)
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  // public function get_mall_emp_payments_data($month,$year)
//     {
//     $query = $this->db->select('*')
//                     ->from('employee_payment')
//                     ->where('compid',$_SESSION['compid'])
//                     ->where('MONTH(regdate)',$month)
//                     ->where('YEAR(regdate)',$year)
//                     ->get()
//                     ->result();
//     return $query; 
// }

  // public function get_mall_returns_data($month,$year)
//     {
//     $query = $this->db->select('*')
//                     ->from('returns')
//                     ->where('compid',$_SESSION['compid'])
//                     ->where('MONTH(returnDate)',$month)
//                     ->where('YEAR(returnDate)',$year)
//                     ->get()
//                     ->result();
//     return $query; 
// }

  // public function get_mall_vouchers_data($month,$year)
//     {
//     $query = $this->db->select('*')
//                     ->from('vaucher')
//                     ->where('compid',$_SESSION['compid'])
//                     ->where('MONTH(voucherdate)',$month)
//                     ->where('YEAR(voucherdate)',$year)
//                     ->get()
//                     ->result();
//     return $query; 
// }


  // public function get_yall_emp_payments_data($year)
//     {
//     $query = $this->db->select('*')
//                     ->from('employee_payment')
//                     //->where('company',$_SESSION['company'])
//                     ->where('YEAR(regdate)',$year)
//                     ->get()
//                     ->result();
//     return $query; 
// }


  public function cash_sales_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Cash')
      ->get()
      ->row();
    return $query;
  }

  public function cash_purchases_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Cash')
      ->get()
      ->row();
    return $query;
  }

  public function cash_cvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('accountType', 'Cash')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function cash_dvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('accountType', 'Cash')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function cash_svoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('accountType', 'Cash')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function cash_emp_payments_amount()
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Cash')
      ->get()
      ->row();
    return $query;
  }

  public function cash_returns_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Cash')
      ->get()
      ->row();
    return $query;
  }

  public function bank_sales_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Bank')
      ->get()
      ->row();
    return $query;
  }

  public function bank_purchases_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Bank')
      ->get()
      ->row();
    return $query;
  }

  public function bank_cvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('accountType', 'Bank')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function bank_dvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('accountType', 'Bank')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function bank_svoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('accountType', 'Bank')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function bank_emp_payments_amount()
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Bank')
      ->get()
      ->row();
    return $query;
  }

  public function bank_returns_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Bank')
      ->get()
      ->row();
    return $query;
  }

  public function mobile_sales_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('sales')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Mobile')
      ->get()
      ->row();
    return $query;
  }

  public function mobile_purchases_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('purchase')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Mobile')
      ->get()
      ->row();
    return $query;
  }

  public function mobile_cvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Credit Voucher')
      ->where('accountType', 'Mobile')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function mobile_dvoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Debit Voucher')
      ->where('accountType', 'Mobile')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function mobile_svoucher_amount()
  {
    $query = $this->db->select("SUM(`totalamount`) as total")
      ->FROM('vaucher')
      ->where('compid', $_SESSION['compid'])
      ->WHERE('vauchertype', 'Supplier Pay')
      ->where('accountType', 'Mobile')
      ->where('status', 1)
      ->get()
      ->row();
    return $query;
  }

  public function mobile_emp_payments_amount()
  {
    $query = $this->db->select("SUM(`salary`) as total")
      ->FROM('employee_payment')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Mobile')
      ->get()
      ->row();
    return $query;
  }

  public function mobile_returns_amount()
  {
    $query = $this->db->select("SUM(`paidAmount`) as total")
      ->FROM('returns')
      ->where('compid', $_SESSION['compid'])
      ->where('accountType', 'Mobile')
      ->get()
      ->row();
    return $query;
  }

  public function get_salary_emp($id, $id2, $id3)
  {
    $emp = $this->db->select('empid')
      ->from('employee_payment')
      ->where('month', $id)
      ->where('year', $id2)
      ->where('empid', $id3)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    //var_dump($emp); exit();
//   $emp_id = array_map (function($value)
//     {
//     return $value['empid'];
//     },$emp);

    if ($emp) {
      $empid = $emp->empid;
    } else {
      $empid = $id3;
    }

    $emps = $this->db->select('
                    employees.employeeID,
                    employees.employeeName,
                    employees.joiningDate,
                    employees.salary,
                    department.dept_name,
                    SUM(employee_payment.salary) as total')
      ->from('employees')
      ->join('department', 'department.dpt_id = employees.dpt_id', 'left')
      ->join('employee_payment', 'employee_payment.empid = employees.employeeID', 'left')
      ->where('employees.employeeID', $empid)
      ->where('employees.compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $emps;
  }

  public function get_order_track_data($oid)
  {
    $query = $this->db->select('order.*,customers.customerName,customers.mobile,customers.email,customers.address')
      ->from('order')
      ->join('customers', 'customers.customerID = order.custid', 'left')
      ->where('oCode', $oid)
      ->get()
      ->row();
    return $query;
  }

  public function get_morder_track_data($oid)
  {
    $query = $this->db->select('order.*,customers.customerName,customers.mobile,customers.email,customers.address')
      ->from('order')
      ->join('customers', 'customers.customerID = order.custid', 'left')
      ->where_in('customers.mobile', $oid)
      ->get()
      ->result();
    return $query;
  }

  public function sales_fetch_data()
  {
    $query = $this->db->select('sales.*,customers.customerName,customers.mobile,customers.email,customers.address,users.name,users.mobile as umobile')
      ->from('sales')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->join('users', 'users.uid = sales.regby', 'left')
      ->where('sales.compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function user_dorder_ledger($uid, $sdate, $edate)
  {
    if ($uid == 'All') {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('oDate >=', $sdate)
        ->where('oDate <=', $edate)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('oDate >=', $sdate)
        ->where('oDate <=', $edate)
        ->where('order.regby', $uid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function user_morder_ledger($uid, $month, $year)
  {
    if ($uid == 'All') {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('MONTH(oDate)', $month)
        ->where('YEAR(oDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('MONTH(oDate)', $month)
        ->where('YEAR(oDate)', $year)
        ->where('order.regby', $uid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function user_yorder_ledger($uid, $year)
  {
    if ($uid == 'All') {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('YEAR(oDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('
                        order.*,
                        customers.customerName,
                        customers.mobile,
                        customers.address')
        ->from('order')
        ->join('customers', 'customers.customerID = order.custid', 'left')
        ->where('YEAR(oDate)', $year)
        ->where('order.regby', $uid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function user_aorder_ledger($uid)
  {
    $query = $this->db->select('
                    order.*,
                    customers.customerName,
                    customers.mobile,
                    customers.address')
      ->from('order')
      ->join('customers', 'customers.customerID = order.custid', 'left')
      ->where('order.regby', $uid)
      ->get()
      ->result();
    return $query;
  }

  public function sales_adata()
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function sales_ddata($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function sales_mdata($month, $year)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function sales_ydata($year)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('YEAR(saleDate)', $year)
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->result();

    return $query;
  }

  public function sales_due_adata()
  {
    $query = $this->db->select('sales.*,customers.customerName,customers.mobile,')
      ->from('sales')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('totalAmount > paidAmount')
      ->where('sales.compid', $_SESSION['compid'])
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_ddata($sdate, $edate)
  {
    $query = $this->db->select('sales.*,customers.customerName,customers.mobile,')
      ->from('sales')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('totalAmount > paidAmount')
      ->where('sales.compid', $_SESSION['compid'])
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_mdata($month, $year)
  {
    $query = $this->db->select('sales.*,customers.customerName,customers.mobile,')
      ->from('sales')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('totalAmount > paidAmount')
      ->where('sales.compid', $_SESSION['compid'])
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_ydata($year)
  {
    $query = $this->db->select('sales.*,customers.customerName,customers.mobile')
      ->from('sales')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('totalAmount > paidAmount')
      ->where('sales.compid', $_SESSION['compid'])
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();

    return $query;
  }




  public function get_bank_purchase_data()
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_sale_data()
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_sreturn_data()
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_preturn_data()
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('accountType', 'Bank')
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_voucher_data()
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dpurchase_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('purchaseDate >=', $sdate)
      ->where('purchaseDate <=', $edate)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dsale_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dsreturn_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('returnDate >=', $sdate)
      ->where('returnDate <=', $edate)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dpreturn_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('accountType', 'Bank')
      ->where('prDate >=', $sdate)
      ->where('prDate <=', $edate)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dvoucher_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mpurchase_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('MONTH(purchaseDate)', $month)
      ->where('YEAR(purchaseDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_msale_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_msreturn_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('MONTH(returnDate)', $month)
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mpreturn_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('accountType', 'Bank')
      ->where('MONTH(prDate)', $month)
      ->where('YEAR(prDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mvoucher_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ypurchase_data($year)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('YEAR(purchaseDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ysale_data($year)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('YEAR(saleDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ysreturn_data($year)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('YEAR(returnDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ypreturn_data($year)
  {
    $query = $this->db->select('*')
      ->from('preturns')
      ->where('accountType', 'Bank')
      ->where('YEAR(prDate)', $year)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_yvoucher_data($year)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('YEAR(voucherdate)', $year)
      ->where('status', 1)
      ->get()
      ->result();

    return $query;
  }

  public function get_product_stock_data()
  {
    $emp = $this->db->select('productID')
      ->from('products')
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['productID'];
    }, $emp);
    //var_dump($emp_id); exit();
    if ($emp_id == NULL) {
      $empid = 0;
    } else {
      $empid = $emp_id;
    }

    $query = $this->db->select('stock.*,products.productName,products.productcode,products.pprice,products.sprice,products.categoryID,products.unit')
      ->from('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      ->where_in('stock.product', $empid)
      ->where('totalPices > 0')
      ->get()
      ->result();
    return $query;
  }

  public function get_product_sstock_data($catid)
  {
    $emp = $this->db->select('productID')
      ->from('products')
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['productID'];
    }, $emp);
    //var_dump($emp_id); exit();
    if ($emp_id == NULL) {
      $empid = 0;
    } else {
      $empid = $emp_id;
    }

    $query = $this->db->select('stock.*,products.productName,products.productcode,products.pprice,products.sprice')
      ->from('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      ->where('categoryID', $catid)
      ->where('totalPices > 0')
      ->where_in('stock.product', $empid)
      ->get()
      ->result();
    return $query;
  }

  public function search_result($query)
  {
    // Use CodeIgniter's Active Record or Query Builder to construct your database query
    // var_dump($query);
    // Example: Searching a table named 'products' for names containing the query
    $query = $this->db->select('products.*, sma_units.unitName')
      ->from('products')
      ->join('sma_units', 'sma_units.id = products.unit', 'left')
      ->where('website_show', 1)
      ->like('products.productName', $query, 'both')
      //   ->order_by("LOCATE($query, products.productName)")
      ->get();

    if ($query->num_rows() > 0) {
      return $query->result(); // Return an array of matching results
    } else {
      return array(); // Return an empty array if no results are found
    }
  }

  public function get_product_ptype_sstock_data($catid)
  {
    $emp = $this->db->select('productID')
      ->from('products')
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['productID'];
    }, $emp);
    //var_dump($emp_id); exit();
    if ($emp_id == NULL) {
      $empid = 0;
    } else {
      $empid = $emp_id;
    }

    if ($catid == 1) {
      $query = $this->db->select('stock.*,products.productName,products.productcode,products.pprice,products.sprice')
        ->from('stock')
        ->join('products', 'products.productID = stock.product', 'left')
        ->where('totalPices > 0')
        ->where_in('stock.product', $empid)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('stock.*,products.productName,products.productcode,products.pprice,products.sprice')
        ->from('stock')
        ->join('products', 'products.productID = stock.product', 'left')
        ->where('dtquantity > 0')
        ->where_in('stock.product', $empid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_dproduct_sstock_data()
  {
    $emp = $this->db->select('productID')
      ->from('products')
      ->get()
      ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map(function ($value) {
      return $value['productID'];
    }, $emp);
    //var_dump($emp_id); exit();
    if ($emp_id == NULL) {
      $empid = 0;
    } else {
      $empid = $emp_id;
    }

    $query = $this->db->select('stock.*,products.productName,products.productcode,products.pprice,products.sprice')
      ->from('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      ->where('dtquantity > 0')
      ->where_in('stock.product', $empid)
      ->get()
      ->result();
    return $query;
  }

  public function damage_product_data()
  {
    $query = $this->db->select('stock.*,products.productName,products.productcode')
      ->from('stock')
      ->join('products', 'products.productID = stock.product', 'left')
      ->where('dtquantity > 0')
      ->get()
      ->result();
    return $query;
  }

  public function count_total_order()
  {
    $query = $this->db->select('*')
      ->from('order')
      ->get();

    $count_row = $query->num_rows();

    if ($count_row) {
      return $count_row;
    } else {
      return 0;
    }
  }

  public function count_total_porder()
  {
    $query = $this->db->select('*')
      ->from('order')
      ->where('status', 1)
      ->get();

    $count_row = $query->num_rows();

    if ($count_row) {
      return $count_row;
    } else {
      return 0;
    }
  }

  public function count_total_corder()
  {
    $query = $this->db->select('*')
      ->from('order')
      ->where('status', 5)
      ->get();

    $count_row = $query->num_rows();

    if ($count_row) {
      return $count_row;
    } else {
      return 0;
    }
  }

  public function count_total_sorder()
  {
    $query = $this->db->select('*')
      ->from('order')
      ->where('status', 2)
      ->get();

    $count_row = $query->num_rows();

    if ($count_row) {
      return $count_row;
    } else {
      return 0;
    }
  }


  public function sales_due_payment_data()
  {
    $query = $this->db->select('sales_payment.*,sales.saleID,customers.customerName')
      ->from('sales_payment')
      ->join('sales', 'sales.saleID = sales_payment.saleID')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_dpayment_data($sdate, $edate)
  {
    $query = $this->db->select('sales_payment.*,sales.saleID,customers.customerName')
      ->from('sales_payment')
      ->join('sales', 'sales.saleID = sales_payment.saleID')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('DATE(sales_payment.regdate) >=', $sdate)
      ->where('DATE(sales_payment.regdate) <=', $edate)
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_mpayment_data($month, $year)
  {
    $query = $this->db->select('sales_payment.*,sales.saleID,customers.customerName')
      ->from('sales_payment')
      ->join('sales', 'sales.saleID = sales_payment.saleID')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('MONTH(sales_payment.regdate)', $month)
      ->where('YEAR(sales_payment.regdate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function sales_due_ypayment_data($year)
  {
    $query = $this->db->select('sales_payment.*,sales.saleID,customers.customerName')
      ->from('sales_payment')
      ->join('sales', 'sales.saleID = sales_payment.saleID')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('YEAR(sales_payment.regdate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function get_transfer_account_data()
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->get()
      ->result();
    return $query;
  }

  public function get_dtransfer_account_data($sdate, $edate)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('DATE(regdate) >=', $sdate)
      ->where('DATE(regdate) <=', $edate)
      ->get()
      ->result();
    return $query;
  }

  public function get_mtransfer_account_data($month, $year)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('MONTH(regdate)', $month)
      ->where('YEAR(regdate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function get_ytransfer_account_data($year)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('YEAR(regdate)', $year)
      ->get()
      ->result();
    return $query;
  }

  public function get_cost_report_data()
  {
    $query = $this->db->select('vaucher.*,cost_type.costName')
      ->from('vaucher')
      ->join('cost_type', 'cost_type.ct_id = vaucher.costType', 'left')
      ->where('vaucher.vauchertype', 'Debit Voucher')
      ->get()
      ->result();
    return $query;
  }

  public function get_dcost_report_data($sdate, $edate, $vtype)
  {
    if ($vtype == 'All') {
      $query = $this->db->select('vaucher.*,cost_type.costName')
        ->from('vaucher')
        ->join('cost_type', 'cost_type.ct_id = vaucher.costType', 'left')
        ->where('vaucher.vauchertype', 'Debit Voucher')
        ->where('DATE(voucherdate) >=', $sdate)
        ->where('DATE(voucherdate) <=', $edate)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('vaucher.*,cost_type.costName')
        ->from('vaucher')
        ->join('cost_type', 'cost_type.ct_id = vaucher.costType', 'left')
        ->where('vaucher.vauchertype', 'Debit Voucher')
        ->where('DATE(voucherdate) >=', $sdate)
        ->where('DATE(voucherdate) <=', $edate)
        ->where('vaucher.costType', $vtype)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_mcost_report_data($month, $year, $vtype)
  {
    $query = $this->db->select('vaucher.*,cost_type.costName')
      ->from('vaucher')
      ->join('cost_type', 'cost_type.ct_id = vaucher.costType', 'left')
      ->where('vaucher.vauchertype', 'Debit Voucher')
      ->where('MONTH(vaucher.voucherdate)', $month)
      ->where('YEAR(vaucher.voucherdate)', $year)
      ->where('vaucher.costType', $vtype)
      ->get()
      ->result();
    return $query;
  }

  public function get_ycost_report_data($year, $vtype)
  {
    $query = $this->db->select('vaucher.*,cost_type.costName')
      ->from('vaucher')
      ->join('cost_type', 'cost_type.ct_id = vaucher.costType', 'left')
      ->where('vaucher.vauchertype', 'Debit Voucher')
      ->where('YEAR(vaucher.voucherdate)', $year)
      ->where('vaucher.costType', $vtype)
      ->get()
      ->result();
    return $query;
  }

  public function get_sales_emi_payment($id)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('saleID', $id)
      ->get()
      ->row();
    return $query;
  }

  public function today_cash_amount()
  {
    $query = $this->db->select('SUM(balance) as ta')
      ->from('cash')
      ->get()
      ->row();
    return $query;
  }

  public function today_bank_amount()
  {
    $query = $this->db->select('SUM(balance) as ta')
      ->from('bankaccount')
      ->get()
      ->row();
    return $query;
  }

  public function today_mobile_amount()
  {
    $query = $this->db->select('SUM(balance) as ta')
      ->from('mobileaccount')
      ->get()
      ->row();
    return $query;
  }

  public function daily_demp_payments_amount($sdate, $edate)
  {
    $query = $this->db->select("employee_payment.*,employees.employeeName")
      ->FROM('employee_payment')
      ->join('employees', 'employees.employeeID = employee_payment.empid', 'left')
      ->where('DATE(employee_payment.regdate) >=', $sdate)
      ->where('DATE(employee_payment.regdate) <=', $edate)
      ->get()
      ->result();
    return $query;
  }

  public function get_sales_product_data()
  {
    $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
      ->from('sale_product')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->join('customers', 'customers.customerID = sales.customerID', 'left')
      ->where('sales.compid', $_SESSION['compid'])
      ->order_by('sale_product.saleID', 'DESC')
      // ->limit(10000)
      ->get()
      ->result();

    return $query;
  }

  public function get_dsales_product_data($sdate, $edate, $pid)
  {
    if ($pid == 'All') {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('sales.saleDate >=', $sdate)
        ->where('sales.saleDate <=', $edate)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('sales.saleDate >=', $sdate)
        ->where('sales.saleDate <=', $edate)
        ->where('sale_product.productID', $pid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_msales_product_data($month, $year, $pid)
  {
    if ($pid == 'All') {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('MONTH(sales.saleDate)', $month)
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sale_product.productID', $pid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_ysales_product_data($year, $pid)
  {
    if ($pid == 'All') {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('YEAR(sales.saleDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select('sale_product.*,sales.invoice_no,sales.saleDate,products.productName,products.productcode,customers.customerName,customers.mobile')
        ->from('sale_product')
        ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
        ->join('products', 'products.productID = sale_product.productID', 'left')
        ->join('customers', 'customers.customerID = sales.customerID', 'left')
        ->where('sales.compid', $_SESSION['compid'])
        ->where('YEAR(sales.saleDate)', $year)
        ->where('sale_product.productID', $pid)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_top_sales_product_data()
  {
    $query = $this->db->select('sma_units.unitName,sales.compid,products.productName,products.image,products.productcode,SUM(sale_product.quantity) as total')
      ->from('sale_product')
      ->join('products', 'products.productID = sale_product.productID', 'left')
      ->join('sma_units', 'products.unit = sma_units.id', 'left')
      ->join('sales', 'sales.saleID = sale_product.saleID', 'left')
      ->where('sales.compid', $_SESSION['compid'])
      ->group_by('sale_product.productID')
      ->order_by('total', 'DESC')
      ->get()
      ->result();

    return $query;
  }

  public function total_service_sales_amount()
  {
    $query = $this->db->select("SUM(pAmount) as total,SUM(amount) as ttotal")
      ->FROM('service_sale')
      ->where('compid', $_SESSION['compid'])
      ->get()
      ->row();
    return $query;
  }

  public function total_dservice_sales_amount($sdate, $edate)
  {
    $query = $this->db->select("SUM(`pAmount`) as total")
      ->FROM('service_sale')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('service_sale.regdate >=', $sdate)
      ->where('service_sale.regdate <=', $edate)
      ->get()
      ->row();
    return $query;
  }

  public function total_mservice_sales_amount($month, $year)
  {
    $query = $this->db->select("SUM(`pAmount`) as total")
      ->FROM('service_sale')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('MONTH(service_sale.regdate)', $month)
      ->where('YEAR(service_sale.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function total_yservice_sales_amount($year)
  {
    $query = $this->db->select("SUM(`pAmount`) as total")
      ->FROM('service_sale')
      ->WHERE('compid', $_SESSION['compid'])
      ->where('YEAR(service_sale.regdate)', $year)
      ->get()
      ->row();
    return $query;
  }

  public function get_service_info_data($id)
  {
    $query = $this->db->select('*')
      ->from('service_info')
      ->where('siid', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_emp_payment_ledger_data($empid)
  {
    $query = $this->db->select("*")
      ->from('employee_payment')
      ->where('empid', $empid)
      ->get()
      ->result();
    return $query;
  }

  public function get_memp_payment_ledger_data($month, $year, $empid)
  {
    $query = $this->db->select("*")
      ->from('employee_payment')
      ->where('month', $month)
      ->where('year', $year)
      ->where('empid', $empid)
      ->get()
      ->result();
    return $query;
  }

  public function get_yemp_payment_ledger_data($year, $empid)
  {
    $query = $this->db->select("*")
      ->from('employee_payment')
      ->where('year', $year)
      ->where('empid', $empid)
      ->get()
      ->result();
    return $query;
  }


  public function get_bank_dlpurchase_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('purchaseDate >=', $sdate)
      ->where('purchaseDate <=', $edate)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dlsale_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('saleDate >=', $sdate)
      ->where('saleDate <=', $edate)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dlsreturn_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('returnDate >=', $sdate)
      ->where('returnDate <=', $edate)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dlvoucher_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('voucherdate >=', $sdate)
      ->where('voucherdate <=', $edate)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dlfbank_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('facType', 'Bank')
      ->where('DATE(regdate) >=', $sdate)
      ->where('DATE(regdate) <=', $edate)
      ->where('facAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_dltbank_data($sdate, $edate, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('sacType', 'Bank')
      ->where('DATE(regdate) >=', $sdate)
      ->where('DATE(regdate) <=', $edate)
      ->where('sacAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mlpurchase_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('MONTH(purchaseDate)', $month)
      ->where('YEAR(purchaseDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mlsale_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('MONTH(saleDate)', $month)
      ->where('YEAR(saleDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mlsreturn_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('MONTH(returnDate)', $month)
      ->where('YEAR(returnDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mlvoucher_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('MONTH(voucherdate)', $month)
      ->where('YEAR(voucherdate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mlfbank_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('facType', 'Bank')
      ->where('MONTH(regdate)', $month)
      ->where('YEAR(regdate)', $year)
      ->where('facAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_mltbank_data($month, $year, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('sacType', 'Bank')
      ->where('MONTH(regdate)', $month)
      ->where('YEAR(regdate)', $year)
      ->where('sacAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ylpurchase_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('purchase')
      ->where('accountType', 'Bank')
      ->where('YEAR(purchaseDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ylsale_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('sales')
      ->where('accountType', 'Bank')
      ->where('YEAR(saleDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ylsreturn_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('returns')
      ->where('accountType', 'Bank')
      ->where('YEAR(returnDate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ylvoucher_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('vaucher')
      ->where('accountType', 'Bank')
      ->where('YEAR(voucherdate)', $year)
      ->where('accountNo', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_ylfbank_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('facType', 'Bank')
      ->where('YEAR(regdate)', $year)
      ->where('facAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_bank_yltbank_data($year, $baid)
  {
    $query = $this->db->select('*')
      ->from('transfer_account')
      ->where('sacType', 'Bank')
      ->where('YEAR(regdate)', $year)
      ->where('sacAcno', $baid)
      ->get()
      ->result();

    return $query;
  }

  public function get_sub_category_details_data($id)
  {
    $query = $this->db->select("*")
      ->FROM('categories_sub')
      ->where('categoryID', $id)
      ->get()
      ->result();
    return $query;
  }

  public function get_product_by_id($id)
  {
    $this->db->select('products.*, 
                            categories.categoryName, 
                            categories.categoryID,
                            categories_sub.subcategoryName,
                            categories_sub.subcategoryID,
                            categories_child.childcategoryID,
                            categories_child.childcategoryName,
                            sma_units.unitName,
                            suppliers.compname');
    $this->db->from('products');
    $this->db->join('categories', 'categories.categoryID=products.categoryID', 'left');
    $this->db->join('categories_sub', 'categories_sub.categoryID=categories.categoryID', 'left');
    $this->db->join('categories_child', 'categories_child.subcategoryID=categories_sub.subcategoryID', 'left');
    $this->db->join('suppliers', 'suppliers.supplierID = products.branding', 'left');
    $this->db->join('sma_units', 'sma_units.id =products.unit', 'left');
    $this->db->order_by('products.productID', 'DESC');
    $this->db->where('products.status', 'Active');
    $this->db->where('products.productID', $id);
    $info = $this->db->get();
    // var_dump($info->row());exit();
    return $info->row();
  }

public function get_customer_due_data($id)
  {
  $customer = $this->db->select("balance,cbalance")
                      ->FROM('customers')
                      ->where('customerID', $id)
                      ->get()
                      ->row();

  $sale = $this->db->select("SUM(dueamount) as total")
                  ->FROM('sales')
                  ->where('customerID', $id)
                  ->get()
                  ->row();
  if($sale)
    {
    $cdue = $sale->total;
    }
  else
    {
    $cdue = 0;
    }
  $voucher = $this->db->select("SUM(totalamount) as total")
                  ->FROM('vaucher')
                  ->where('customerID', $id)
                  ->get()
                  ->row();
  if($voucher)
    {
    $vpaid = $voucher->total;
    }
  else
    {
    $vpaid = 0;
    }
    //var_dump($cdue); var_dump($voucher[$i]->dAmount); 
  $return = $this->db->select("SUM(paidAmount) as total")
              ->FROM('returns')
              ->WHERE('customerID', $id)
              ->get()
              ->row();
  if($return)
    {
    $tra = $return->total;
    }
  else
    {
    $tra = 0;
    }
  $amount = (($customer->balance+$cdue)-($vpaid+$tra));
  
  return $amount;
}

  public function get_customer_due_amount_data($id)
  {
    $treturn = $this->db->select("*")
      ->FROM('customers')
      ->WHERE('customerID', $id)
      ->get()
      ->row();

    return $treturn;
  }

  public function get_customer_current_due_amount_data($id)
  {
    // $tsale = $this->db->select("SUM(dueamount) as dtotal")
    //   ->FROM('sales')
    //   ->WHERE('customerID', $id)
    //   ->get()
    //   ->row();

    // $tvpaid = $this->db->select("SUM(totalamount) as total")
    //   ->FROM('vaucher')
    //   ->WHERE('customerID', $id)
    //   ->WHERE('status', 1)
    //   ->get()
    //   ->row();

    // $tcpay = $this->db->select("SUM(pAmount) as total")
    //   ->FROM('customer_payment')
    //   ->WHERE('custid', $id)
    //   ->get()
    //   ->row();

    $treturn = $this->db->select("cbalance")
                          ->FROM('customers')
                          ->WHERE('customerID',$id)
                          ->get()
                          ->row();
                          $tdue = $treturn->cbalance;
    // if ($tsale->dtotal < $tvpaid->total + $tcpay->total) {
    //   $tdue = 0;
    // } else {
    //   $tdue = ($tsale->dtotal) - ($tvpaid->total + $tcpay->total);
    // }

    return $tdue;
  }

  public function get_customer_total_due_amount_data($id)
  {
    $tsale = $this->db->select("SUM(dueamount) as dtotal")
      ->FROM('sales')
      ->WHERE('customerID', $id)
      ->get()
      ->row();

    $tvpaid = $this->db->select("SUM(totalamount) as total")
      ->FROM('vaucher')
      ->WHERE('customerID', $id)
      ->WHERE('status', 1)
      ->get()
      ->row();

    $tcpay = $this->db->select("SUM(pAmount) as total")
      ->FROM('customer_payment')
      ->WHERE('custid', $id)
      ->get()
      ->row();

    $treturn = $this->db->select("balance")
      ->FROM('customers')
      ->WHERE('customerID', $id)
      ->get()
      ->row();

    $tdue = ($tsale->dtotal + $treturn->balance) - ($tvpaid->total + $tcpay->total);

    return $tdue;
  }

  public function get_shipping_method_data($id)
  {
    $query = $this->db->select('*')
      ->from('shipping_method')
      ->where('smid', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_pos_slogan_data($id)
  {
    $query = $this->db->select('*')
      ->from('pos_slogan')
      ->where('id', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_customer_invoice_due($id)
  {
    $query = $this->db->select('SUM(dueamount) as dueamount')
      ->from('sales')
      ->where('customerID', $id)
      ->get()
      ->row();
    return $query;
  }
  public function get_customer_payment_data()
  {
    $today = date("Y-m-d");
    $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
      ->from('customer_due_payment')
      ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
      ->where('date(pDate)', $today)
      ->get()
      ->result();
      // var_dump($this->db->last_query($query));
      // die();
    return $query;
  }

  public function get_customer_dpayment_data($custid, $sdate, $edate)
  {
    if ($custid == 'All') {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('pDate >=', $sdate)
        ->where('pDate <=', $edate)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('customer_due_payment.custid', $custid)
        ->where('pDate >=', $sdate)
        ->where('pDate <=', $edate)
        ->get()
        ->result();
    }
    // var_dump($this->db->last_query($query));
    // die();
    return $query;
  }

  public function get_customer_mpayment_data($custid, $month, $year)
  {
    if ($custid == 'All') {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('MONTH(pDate)', $month)
        ->where('YEAR(pDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('customer_due_payment.custid', $custid)
        ->where('MONTH(pDate)', $month)
        ->where('YEAR(pDate)', $year)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_customer_ypayment_data($custid, $year)
  {
    if ($custid == 'All') {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('YEAR(pDate)', $year)
        ->get()
        ->result();
    } else {
      $query = $this->db->select("customer_due_payment.*,customers.customerName,customers.mobile")
        ->from('customer_due_payment')
        ->join('customers', 'customers.customerID = customer_due_payment.custid', 'left')
        ->where('customer_due_payment.custid', $custid)
        ->where('YEAR(pDate)', $year)
        ->get()
        ->result();
    }
    return $query;
  }

  public function get_balance_adjustment_data($id)
  {
    $query = $this->db->select("*")
      ->from('badjusts')
      ->where('baid', $id)
      ->get()
      ->row();
    return $query;
  }

  public function get_adjustmentbalance_data()
  {
    $query = $this->db->select("any_value(users.name) as name,any_value(balance_adjustment.adjustment_type) as adjustment_type,any_value(balance_adjustment.accountType) as accountType,any_value(balance_adjustment.amount) as amount,any_value(balance_adjustment.note) as note,any_value(cash.cashName) as cashName,any_value(mobileaccount.accountName) as moAccountName,any_value(bankaccount.accountName) as baAccountName,any_value(balance_adjustment.approve) as approve,any_value(balance_adjustment.id) as id,any_value(balance_adjustment.date) as date")
      ->from('balance_adjustment')
      ->join('users', 'users.uid = balance_adjustment.regby', 'left')
      ->join('cash', 'cash.ca_id = balance_adjustment.cash_accountNo', 'left')
      ->join('mobileaccount', 'mobileaccount.ma_id = balance_adjustment.mobile_accountNo', 'left')
      ->join('bankaccount', 'bankaccount.ba_id  = balance_adjustment.bank_accountNo', 'left')
      ->where('balance_adjustment.compid', $_SESSION['compid'])
      ->get()
      ->result_array();
      // var_dump($this->db->last_query($query));
      // die();
    return $query;
  }
  

public function get_due_customer_data()
  {
  $query = $this->db->select("*")
              ->from('customers')
              ->where('nbalance > 0')
              ->or_where('cbalance > 0')
              ->get()
              ->result();
      // die();
  return $query;
}

public function today_return_amount()
  {
  $date = date('Y-m-d');
  $query = $this->db->select("SUM(paidAmount) as total")
          ->FROM('returns')
          ->where('DATE(returnDate)',$date)
          ->get()
          ->row();
    //var_dump($query); exit();
  return $query;
}

public function total_return_amount()
  {
  $query = $this->db->select("SUM(paidAmount) as total")
          ->FROM('returns')
          ->get()
          ->row();
    //var_dump($query); exit();
  return $query;
}


public function get_supplier_due_amount_data($id)
  {
  $suppliers = $this->db->select("balance")
                  ->FROM('suppliers')
                  ->WHERE('supplierID',$id)
                  ->get()
                  ->row();
  $tpur = $this->db->select("SUM(totalPrice) as total,SUM(paidAmount) as ptotal,SUM(due) as dtotal")
                  ->FROM('purchase')
                  ->WHERE('supplier',$id)
                  ->get()
                  ->row();

  $tvpaid = $this->db->select("SUM(totalamount) as total")
                    ->FROM('vaucher')
                    ->WHERE('supplier',$id)
                    ->get()
                    ->row();

   $tprt = $this->db->select("SUM(totalPrice) as total")
                      ->FROM('preturns')
                      ->WHERE('customerID',$id)
                      ->get()
                      ->row();
    //var_dump($query); exit();
  $query = (($suppliers->balance+$tpur->total)-($tpur->ptotal+$tvpaid->total+$tprt->total));
  
  return $query;
}




}
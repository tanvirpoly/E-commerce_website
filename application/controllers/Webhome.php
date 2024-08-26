<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Webhome extends CI_Controller {

public function __construct()
  {
  parent::__construct();
  $this->load->model("prime_model",'pm');
  $this->load->library('cart');
}

        ################################################
        #   /* Pages  start*/                          #
        ################################################

public function index()
  {
      $info = $this->input->post();
      $other = array(
       'order_by' => 'productID',
       'join'     => 'left' 
            );
    $field = array(
        'products'   => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit'
            );
            
    $Uwhere = array(
      'products.compid' => '1',
      'products.fpshow' => '1'
            );
      
      
  $where = array(
    'status' => 'Active'
        );

  $data['company'] = $company = $this->pm->company_details();
 
  $data['title'] = $company->com_name;
  
  $data['categories'] = $this->pm->get_data('categories',$where);
//   $data['categories_sub'] = $this->pm->get_data('categories_sub', $kwhere);
  $data['countdown'] = $this->pm->countdown_details();
//   $data['about'] = $this->pm->get_data('about_us',false);
  $data['slider_image'] = $this->pm->get_data('slider_image',$where);
   $data['product'] = $this->pm->get_data('products',$Uwhere,$field,$join,$other);
   
 
  $this->load->view('web/webhome',$data);
}

public function view_category_details()
    {
    $data['title'] = 'Product'; 

    $where = array(
    //   'products.categoryID' => $id
    'website_show' => 1
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['categories'] = $product = $this->pm->get_data('categories',false);
    $data['suppliers'] = $product = $this->pm->get_data('suppliers',false);
    $data['company'] = $company = $this->pm->company_details();
    $data['title'] = $company->com_name;
    

    $this->load->view('web/all_categories',$data);
    
    
}

public function view_category($id)
    {
    $cat = $this->db->select('*')->from('categories')->where('categoryID', $id)->get()->row();
    
    // $data['title'] = ($data['banner']->categoryName)?$data['banner']->categoryName:'Category'; 
    $data['title'] = ($cat->categoryName)?$cat->categoryName:'Category'; 
    
    
    $where = array(
       'products.categoryID' => $id,
       'website_show' => 1
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['categories'] = $product = $this->pm->get_data('categories',false);
    $data['suppliers'] = $product = $this->pm->get_data('suppliers',false);
    $data['company'] = $company = $this->pm->company_details();
    
    $this->load->view('web/category_details',$data);
}

public function view_sub_category($id)
    {
    $data['title'] = 'Product'; 
    
    $data['banner'] = $this->db->select('*')->from('categories_sub')->where('subcategoryID', $id)->get()->row();

    $where = array(
       'products.subcategoryID' => $id,
       'website_show' => 1
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories_sub' => 'categories_sub.subcategoryName, categories_sub.categoryID',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories_sub' => 'categories_sub.subcategoryID = products.subcategoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['categories'] = $product = $this->pm->get_data('categories',false);
    $data['suppliers'] = $product = $this->pm->get_data('suppliers',false);
    $data['company'] = $company = $this->pm->company_details();
    $data['title'] = $company->com_name;
    
    $this->load->view('web/category_details',$data);
}

public function view_child_category($id)
    {
    $data['title'] = 'Product'; 

    $where = array(
       'products.childcategoryID' => $id,
       'website_show' => 1
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories_child' => 'categories_child.childcategoryName, categories_child.categoryID',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories_child' => 'categories_child.childcategoryID = products.childcategoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['categories'] = $product = $this->pm->get_data('categories',false);
    $data['suppliers'] = $product = $this->pm->get_data('suppliers',false);
    $data['company'] = $company = $this->pm->company_details();
    $data['title'] = $company->com_name;
    
    $this->load->view('web/category_details',$data);
}


public function view_product($id)
    {
    $data['title'] = 'Product'; 

    $where = array(
       'productID' => $id  
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['product'] = $product[0];
    $data['company'] = $company = $this->pm->company_details();
     $data['title'] = $company->com_name;
     

    $Rwhere = array(
       'products.categoryID' => $product[0]['categoryID'],
       'products.website_show' => 1
            );
    $Rother = array(
       'join' => 'left' 
            );
    $Rfield = array(
        'products'  => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $Rjoin = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );
    
    $data['related'] = $product = $this->pm->get_data('products',$Rwhere,$Rfield,$Rjoin,$Rother);
    $data['categories'] = $product = $this->pm->get_data('categories',false);

    

    $this->load->view('web/product_details',$data);
}
public function all_product_list()
    {
    $data['title'] = 'Product'; 

    $where = array(
    //   'productID' => $id  
    'website_show' => 1
            );
    $other = array(
       'join' => 'left' 
            );
    $field = array(
        'products'  => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName',
        'suppliers'  => 'suppliers.compname'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit',
        'suppliers'  => 'suppliers.supplierID = products.branding'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['categories'] = $product = $this->pm->get_data('categories',false);
    // $data['product'] = $product[0];
    $data['company'] = $company = $this->pm->company_details();
     $data['title'] = $company->com_name;
    
    $this->load->view('web/all_products',$data);
}

public function search_function()
    {
    $query = $this->input->post('query');
    // $query = 'a';
    $results = $this->pm->search_result($query);
    // echo '<pre>';print_r($results);exit();
    $output = "";
    // if (!empty($results)) {
    foreach ($results as $value) {
        $per = 0;
    //   $output .= '<div>' . str_ireplace($query, '<span class="highlight">' . $query . '</span>', $result->productName) . '</div>';
        $output .= '
        <div class="col">
            <div class="product-card">
                <div class="product-media">
                    <div class="product-label">
                        <label class="label-text off">';
                            $per = 0;
                            if ($value->regularPrice > 0 && $value->sprice > 0) {
                                $per = round((floatval($value->regularPrice) - floatval($value->sprice)) / floatval($value->regularPrice) * 100);
                            }
                            $output .= $per . '%';
                            
                            $output .= '</label>
                    </div>
                    <button class="product-wish wish">
                        <i class="fas fa-heart"></i>
                    </button>';
                    
                        if ($value->image) {
                            $img = $value->image;
                        } else {
                            $img = 'demoimg.jpg';
                        }
        
        $output .= '<input type="hidden" id="imageData" value="' . base_url() . '/upload/product/' . $img . '">
                    <a class="product-image" href="' . site_url('productDetails') . '/' . $value->productID. '">
                        <img src="' . base_url() . '/upload/product/' . $img . '" alt="product">
                    </a>
                    <div class="product-widget">
                        <button type="button" title="Product View" href="#" class="btn btn-inline fas fa-eye product-view" data-bs-toggle="modal" data-bs-target="#product-view" data-id="' . $value->productID. '" id="' . $value->productID. '"></button>
                    </div>
                </div>
                <div class="product-content">
                    <h6 class="product-name">
                        <a href="' . site_url('productDetails') . '/' . $value->productID . '" method="post" enctype="multipart/form-data">' . str_ireplace($query, '<span class="highlight">' . $query . '</span>', $value->productName) . '</a>
                    </h6>
                    <h6 class="product-price" style="color: black;">';
                    if ($value->regularPrice > 0) {
                        $output .= "<del>&#2547; " . $value->regularPrice. "</del>";
                    }
        
                    $output .= '<span>&#2547; ' . $value->sprice. '<small>/' . $value->unitName. '</small></span>
                    </h6>
                    <input type="hidden" class="form-control" name="productID" value="' . $value->productID. '" required>
                    <input type="hidden" class="form-control" name="categoryID" value="' . $value->categoryID. '" required>
                    <button class="product-add add_2cart" title="Add to Cart" data-productid="'.$value->productID.'" data-productname="'.$value->productName.'" data-productprice="'.$value->sprice.'" style="padding: 0px;">
                        <i class="fas fa-shopping-basket"></i>
                        <span>add to cart</span>
                    </button>
                    <div class="product-action">
                        <input class="action-input" title="Quantity Number" type="text" name="quantity" id="productquantity" value="1">
                        <button class="action-plus add_cart" title="Quantity Plus" id="minus" data-productid="' . $value->productID. '" data-productname="'. $value->productName. '" data-productprice="' . $value->sprice. '"><i class="icofont-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>';
    }
    // print_r($output);
    // die;
    // }

    echo $output;
}

public function view_checkout($id = null)
  {
  $data['title'] = 'Home';

    $other = array(
       'order_by' => 'productID',
       'join'     => 'left' 
            );
    $field = array(
        'products'   => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit'
            );
            
    $Uwhere = array(
      'products.compid' => '1',
      'products.website_show' => 1
            );
      
      
  $where = array(
    'status' => 'Active'
        );

  $data['company'] = $company = $this->pm->company_details();
 
  $data['title'] = $company->com_name;
  $data['countdown'] = $company = $this->pm->countdown_details();
  
  $data['category'] = $this->pm->get_data('categories',$where);
  
//   $data['about'] = $this->pm->get_data('about_us',false);
  $data['slider_image'] = $this->pm->get_data('slider_image',$where);
   $data['product'] = $this->pm->get_data('products',$Uwhere,$field,$join,$other);
   
   
   
   $Cother = array(
       'order_by' => 'cartID',
       'join'     => 'left' 
            );
    $Cfield = array(
        'cart_list'   => 'cart_list.*',
        'products' => 'products.productName, products.image, products.sprice',
        'sma_units'  => 'sma_units.unitName',
        'customers' => 'customers.customerName, customers.mobile, customers.address'
        
        
       
        
            );
    $Cjoin = array(
        'products' => 'products.productID = cart_list.productID',
        'sma_units'  => 'sma_units.id = products.unit',
        'customers' => 'customers.customerID = cart_list.userID'
        
            );
            
    $Cwhere = array(
      'cart_list.userID' => 1
            );
    $data['cart_list'] = $this->pm->get_data('cart_list',$Cwhere,$Cfield,$Cjoin,$Cother);
    $data['delivery_time'] = $this->pm->get_data('delivery_time', array('status' => 'Active'));

    
  $this->load->view('web/checkout',$data);
}

// public function check_out_order()
//   {
//   $data['title'] = 'Check Out';
//   $data['division'] = $this->pm->get_data('divisions',false);

//   $this->load->view('webview/check_out',$data);
// }

public function delete_wishlist($id)
    {
        
    $where = array(
        'cartID' => $id
            );
            
    $result = $this->pm->delete_data('cart_list',$where);
   
    
    redirect($_SERVER['HTTP_REFERER']);
}



public function new_sale()
    {
        
    unset($_SESSION['stockProducts']);
    $data['title'] = 'Sale';
    
    $where = array(
      'compid' => 1,
      'regby'  => $_SESSION['uid'],
      'status' => 'Active'
            );

    $data['customer'] = $this->pm->get_data('customers',$where);

    $data['product'] = $this->db->select('products.*,stock.totalPices')
                                ->from('products')
                                ->join('stock','stock.product=products.productID','left')
                                ->where('products.compid',$_SESSION['compid'])
                                ->where('products.status','Active')
                                ->get()
                                ->result();


    $this->load->view('sale/NewSale',$data);
}

public function saved_sale()
    {
    $info = $this->input->post();

    $query = $this->db->select('saleID')
                  ->from('sales')
                  ->limit(1)
                  ->order_by('saleID','DESC')
                  ->get()
                  ->row();
    if($query)
        {
        $sn = $query->saleID+1;
        }
    else
        {
        $sn = 1;
        }
    $cn = "DHKBZR";
    $pc = sprintf("%'05d", $sn);

    $cusid = 'INV-'.$cn.$pc;
    // $cusid = $pc;

    
  $config['upload_path'] = './upload/';
  $config['allowed_types'] = '*';
  $config['max_size'] = 0;
  $config['max_width'] = 0;
  $config['max_height'] = 0;

  $this->load->library('upload',$config);
  $this->upload->initialize($config);
                    
  if($this->upload->do_upload('gnid'))
    {
    $gnid = $this->upload->data('file_name');
    }
  else
    {
    $gnid = '';
    }
  
  if($this->upload->do_upload('gcheck'))
    {
    $gcheck = $this->upload->data('file_name');
    }
  else
    {
    $gcheck = '';
    }

    $sale = array(
        'compid'         => "1",
        'invoice_no'     => $cusid,
        'saleDate'       => date('Y-m-d'),
        'customerID'     => $info['customerID'],
        'totalAmount'    => $info['totalprice'],
        'paidAmount'     => $info['total_paid'],
        'pAmount'        => $info['total_paid'],
        'dueamount'      => $info['due'],
        'discount'       => $info['discount'],             
        'vCost'          => $info['vCost'],
        'vType'          => $info['vType'],             
        'vAmount'        => $info['vAmount'],
        // 'terms'          => $info['terms'],
        'accountType'    => $info['accountType'],
        'accountNo'      => $info['accountNo'],
        'note'           => $info['note'],
        'sstatus'        => 'Cash Sell',
        'regby'          => $_SESSION['uid']
            );
        //var_dump($sale); exit();
    $result = $this->pm->insert_data('sales',$sale);
       
    $length = count($info['productID']);

    for ($i = 0; $i < $length; $i++)
        {
        $spdata = array(
            'saleID'     => $result,
            'productID'  => $info['productID'][$i],
            'pName'      => $info['productName'][$i],
            'quantity'   => $info['pices'][$i],
            'sprice'     => $info['salePrice'][$i],
            'totalPrice' => $info['totalprice'][$i],
            'regby'      => $_SESSION['uid']
                );

        $this->pm->insert_data('sale_product',$spdata);

        $pid = $info['productID'][$i];
        $aid = $_SESSION['compid'];

        $swhere = array(
            'compid'  => $_SESSION['compid'],
            'product' => $pid
                    );

        $stpd = $this->pm->get_data('stock',$swhere);

        $this->pm->delete_data('stock',$swhere);

        if($stpd)
            {
            $tquantity = $stpd[0]['totalPices']-($info['pices'][$i]);
            $dtqnt = $stpd[0]['dtquantity'];
            }
        else{
            $tquantity = '-'.($info['pices'][$i]);
            $dtqnt = 0;
            }

        $stock_info = array(
            'compid'     => $_SESSION['compid'],
            'product'    => $info['productID'][$i],
            'totalPices' => $tquantity,
            'dtquantity' => $dtqnt,
            'regby'      => $_SESSION['uid']
                    );
        //var_dump($stock_info);    
        $this->pm->insert_data('stock',$stock_info);  
        }
    

            
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product Sale Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    //redirect('Sale');
    redirect('viewSale/'.$result);
}


public function category_product_list($id = null)
  {
  $data['title'] = 'Home';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  $data['mmview'] = $this->pm->get_main_manu_view($id);
    
  $this->load->view('web/mhome',$data);
}

public function product_list($id = null) 
  {
  $data['title'] = 'Products';
  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['material'] = $this->pm->get_data('product_material',$where);
  $data['color'] = $this->pm->get_data('product_color',$where);
  $data['brand'] = $this->pm->get_data('cost_type',$where);
  $data['size'] = $this->pm->get_data('product_size',$where);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  $data['smview'] = $this->pm->get_sub_manu_view($id);
  $data['ssubmanu'] = $this->pm->get_submanu_data($id);
  
  $this->load->view('web/product_list',$data);
}

public function sub_manu_product_view()
  {
  $section = $this->pm->sub_manu_search_view($_POST['id'],$_POST['sid'],$_POST['bid'],$_POST['cid'],$_POST['mid'],$_POST['lid']);
  $someJSON = json_encode($section);
  echo $someJSON;
}

public function band_search_view()
  {
  $section = $this->pm->band_search_view($_POST['id'],$_POST['sid'],$_POST['cid'],$_POST['mid'],$_POST['lid']);
  $someJSON = json_encode($section);
  echo $someJSON;
}

public function ssub_product_list($id = null) 
  {
  $data['title'] = 'Products';
  
  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['material'] = $this->pm->get_data('product_material',$where);
  $data['color'] = $this->pm->get_data('product_color',$where);
  $data['brand'] = $this->pm->get_data('cost_type',$where);
  $data['size'] = $this->pm->get_data('product_size',$where);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  $data['smview'] = $smview = $this->pm->get_ssub_manu_view($id);
  $data['ssubmanu'] = $this->pm->get_ssubmanu_data($id);
  
  $this->load->view('web/ssub_product',$data);
}

public function brand_product_list($id = null) 
  {
  $data['title'] = 'Products';
  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['material'] = $this->pm->get_data('product_material',$where);
  $data['color'] = $this->pm->get_data('product_color',$where);
  $data['brand'] = $this->pm->get_data('cost_type',$where);
  $data['size'] = $this->pm->get_data('product_size',$where);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  $data['smview'] = $this->pm->get_brand_product($id);

  $this->load->view('web/pbrand_list',$data);
}

public function product_details($id = null) 
  {
  $data['title'] = 'Products';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();

  $pwhere = array(
    'productID' => $id
        );
  $other = array(
   'join' => 'left' 
        );
  $field = array(
    'products'  => 'products.*',
    'categories' => 'categories.catName',
    'sma_units'  => 'sma_units.unitName',
    'ssub_manu'  => 'ssub_manu.ssubName',
    'cost_type'  => 'cost_type.costName',
    'product_material' => 'product_material.mName'
        );
  $join = array(
    'categories' => 'categories.catid = products.catid',
    'sma_units'  => 'sma_units.untid = products.untid',
    'ssub_manu'  => 'ssub_manu.ssmid = products.ssmid',
    'cost_type'  => 'cost_type.ct_id = products.ct_id',
    'product_material' => 'product_material.pmid = products.pmaterial'
        );

  $product = $this->pm->get_data('products',$pwhere,$field,$join,$other);
  $data['product'] = $product[0];

  $pid = $product[0]['productID'];
  $cid = $product[0]['untid'];

  $data['pcolor'] = $this->pm->get_product_color($pid);
  $data['psize'] = $this->pm->get_product_size($pid);
  $data['rproduct'] = $this->pm->get_data('products',array('categoryID' => $cid));
  
  $this->load->view('web/product_details',$data);
}

public function get_product_by_id()
  {
  $section = $this->pm->get_product_by_id($_POST['id']);
  $someJSON = json_encode($section);
  echo $someJSON;
}

// public function add_to_cart()
//   {
// //   $psid = $this->input->post('psize');
//      $productID = $this->input->post('pid');
//      $quantity = $this->input->post('quantity');
//      var_dump($productID, $quantity);exit();
// //   $pcid = $this->input->post('pcolor');

// //   $prosize = $this->pm->pro_size($psid);
// //   $pimage = $this->pm->product_image($pid);
// //   $procolor = $this->pm->product_color($pcid);
// //     //var_dump($quantity); exit();
//   $data = array(
//     'id'     => $productID,
//     'name'   => $this->input->post('name'), 
//     'price'  => $this->input->post('pprice'), 

//           );

//   $this->cart->insert($data);
//   echo $this->show_cart();

//   // $tpqnt = $this->cart->total_items();
//   // alert($tpqnt);
//   // $qnt ='<spam>'.$tpqnt.'</spam>';
//   // alert($qnt);
//   //$('#tpqnt').html(qnt);
  
// //   $data = array(
// //   'id'      => 'sku_123ABC',
// //   'qty'     => 50,
// //   'price'   => 100,
// //   'name'    => 'T-Shirt',
// //   'options' => array('Size' => 'L', 'Color' => 'Red')
// // );

// // $this->cart->insert($data);

        
// // redirect($_SERVER['HTTP_REFERER']);
  
// }

public function add_to_cart()
  {
  $pid = $this->input->post('pid');
//   $pid = '47';
  
  $pimage = $this->pm->product_image($pid);
    //var_dump($quantity); exit();
  $data = array(
    'id'     => $pid,
    'name'   => $this->input->post('name'),
    'price'  => $this->input->post('pprice'),
    'pprice' => $pimage->regularPrice,
    'qty'    => 1,
    'image' => $pimage->image,
          );
        //   var_dump($data);die;
  $this->cart->insert($data);
  echo $this->show_cart();
}

public function get_cart_quantity()
  {
  $someJSON = json_encode($psid);
  echo $someJSON;
}
 
public function show_cart()
  { 
  $output = '';
  $no = 0;
  $c = count($this->cart->contents());
  $output .= '
    <div class="cart-header">
        <div class="cart-total">
          <i class="fas fa-shopping-basket"></i>
          <span>total item ('.$c.')</span>
        </div>
        <button class="cart-close"><i class="icofont-close"></i></button>
      </div>
      <ul class="cart-list">';
    //   var_dump($this->cart->contents());
  foreach ($this->cart->contents() as $items)
    {
    $no++;
    if($items['image'])
      {
      $img = 'https://dhakabazar.online/upload/product/'.$items['image'];
      }
    else
      {
      $img = '<i class="fa fa-shopping-cart fa-5x" ></i>';
      }
    $output .='
      <li class="cart-item">
          <div class="cart-media">
            <a href="#"><img src="'.$img.'" alt="product"></a>
            <button id="'.$items['rowid'].'" class="romove_cart" href="#"><i class="far fa-trash-alt"></i></button>
          </div>
          <div class="cart-info-group">
              <div class="cart-info">
                  <h6><a href="#">'.$items['name'].'</a></h6>
                  <p>TK. '.$items['price'].'</p>
              </div>
              <div class="cart-action-group">
                  <div class="product-action">
                      <input class="action-input" title="Quantity Number" type="text" id="quantity" name="quantity" value="'.$items['qty'].'">
                      
                  </div>
                  <h6>TK. '.$items['price'].'</h6>
              </div>
          </div>
        </li>
      ';
    }
  $output .= '
    </ul>
      <div class="cart-footer">
        <a class="cart-checkout-btn" href="'.base_url().'checkOut">
          <span class="checkout-label">Proceed to Checkout</span>
          <span class="checkout-price">'.'৳ '.number_format($this->cart->total()).'</span>
        </a>
      </div>';
  return $output;
}
 
public function load_cart()
 { 
  echo $this->show_cart();
}
 
public function delete_cart()
  { 
   $data = array(
    'rowid' => $this->input->post('row_id'), 
    'qty' => 0, 
        );
  $this->cart->update($data);
  echo $this->show_cart();
  
}

public function check_out_order()
  {
  $data['title'] = 'Check Out';
  $other = array(
       'order_by' => 'productID',
       'join'     => 'left' 
            );
    $field = array(
        'products'   => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units'  => 'sma_units.unitName'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit'
            );
            
    $Uwhere = array(
      'products.compid' => '1',
            );
  $where = array(
    'status' => 'Active'
        );

  $data['company'] = $company = $this->pm->company_details();
 
  $data['title'] = $company->com_name;
  $data['countdown'] = $company = $this->pm->countdown_details();
  
  $data['categories'] = $this->pm->get_data('categories',$where);
//   echo '<pre>';print_r($this->cart->contents());
  
//   $data['about'] = $this->pm->get_data('about_us',false);
  $data['slider_image'] = $this->pm->get_data('slider_image',$where);
   $data['product'] = $this->pm->get_data('products',$Uwhere,$field,$join,$other);
   $Cother = array(
       'order_by' => 'cartID',
       'join'     => 'left' 
            );
    $Cfield = array(
        'cart_list'   => 'cart_list.*',
        'products' => 'products.productName, products.image, products.sprice',
        'sma_units'  => 'sma_units.unitName',
        'customers' => 'customers.customerName, customers.mobile, customers.address'
            );
    $Cjoin = array(
        'products' => 'products.productID = cart_list.productID',
        'sma_units'  => 'sma_units.id = products.unit',
        'customers' => 'customers.customerID = cart_list.userID'
        
            );
            
    $Cwhere = array(
      'cart_list.userID' => 1
            );
    // $data['cart_list'] = $this->pm->get_data('cart_list',$Cwhere,$Cfield,$Cjoin,$Cother);
    $data['cart_list'] = $this->cart->contents();
    $data['delivery_time'] = $this->pm->get_data('delivery_time', array('status' => 'Active'));
  $data['area'] = $this->pm->get_data('delivery_area',false);

  $this->load->view('web/checkout',$data);
}

public function save_order_product()
  {
  $info = $this->input->post();
    //   var_dump(date('Y-m-d h:i:s a', strtotime($info['dDate']))); exit();
  
  $cust = $this->db->select('*')->from('customers')->where('mobile', $info['mobile'])->get()->row();
  
  if($cust){
      $custid = $cust->customerID;
  }
  else{
      $query = $this->db->select('cus_id')
                  ->from('customers')
                  ->limit(1)
                  ->order_by('customerID','DESC')
                  ->get()
                  ->row();
    if($query)
        {
        $sn = substr($query->cus_id,5)+1;
        }
    else
        {
        $sn = 1;
        }
    //var_dump($sn); exit();
    $cn = strtoupper(substr('Dhaka Bazar',0,3));
    $pc = sprintf("%'05d",$sn);

    $cusid = 'C-'.$cn.$pc;

    $data = array(
        'compid'       => 1,
        'cus_id'       => $cusid,
        'customerName' => $info['customerName'],
        'mobile'       => '+88'.$info['mobile'],
        'email'        => $info['email'],
        'address'      => $info['address'],
        'regby'        => $_SESSION['uid']
            );

    $custid = $this->pm->insert_data('customers',$data);
  }
  
  $query = $this->db->select('oid')
                ->from('order')
                ->limit(1)
                ->order_by('oid','DESC')
                ->get()
                ->row();
  if($query)
    {
    $sn = $query->oid+1;
    }
  else
    {
    $sn = 1;
    }

  $cn = strtoupper(substr('Dhaka Bazar',0,3));
  $pc = sprintf("%'05d",$sn);

  $cusid = $cn.'O-'.$pc;
  $date = date('Y-m-d');

  $quotation = array(
    // 'compid'  => $_SESSION['compid'],
    'oCode'   => $cusid,
    'oDate'   => $date,
    'dArea'   => $info['dArea'],
    'dDate'   => $info['delivery_time'],
    'custid'  => $custid,
    'tAmount' => $info['tAmount'],
    'totalAmount' => $info['totalAmount'],
    //'scost'     => $info['scost'],
    'regby'        => (isset($_SESSION['uid']))? $_SESSION['uid'] : 1
        );
      //var_dump($quotation); exit();
    $result = $this->pm->insert_data('order',$quotation);
       
  $length = count($info['product']);

  for($i = 0; $i < $length; $i++)
    {
    $spdata = array(
      'oid'      => $result,
      'product'  => $info['product'][$i],                    
      'oQnt' => $info['qty'][$i],
      'oPrice'   => $info['sprice'][$i],
      'tPrice'   => $info['tprice'][$i],
      'regdate'   => $date
          );

    $result2 = $this->pm->insert_data('order_product',$spdata); 
    }

  if($result2)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Product Order Placed Successfully !</h4>
        </div>'
            ];  
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-ban"></i> Failed !</h4>
        </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('orderInvoice'.'/'.$result);
}

public function order_invoice($id)
  {
  $data['title'] = 'Order Invoice';
  
  $data['cart_list'] = $this->cart->contents();
  
  $where = array(
    'oid' => $id
        );
  $join = array(
    'products' => 'products.productID = order_product.product',
    'sma_units' => 'sma_units.id = products.unit'
        );
  $data['porder'] = $this->pm->get_data('order_product',$where,false,$join);
  
  $field = array(
    'order' => 'order.*',
    'customers'=>'customers.*',
    'delivery_time'=>'delivery_time.*',
        );

  $pjoin = array(
    'customers' => 'customers.customerID = order.custid',
    'delivery_time' => 'delivery_time.dtID = order.dDate',
        );
  
  $orders = $this->pm->get_data('order',$where,$field,$pjoin);
  
  $data['order'] = $orders[0];
  
  $data['categories'] = $product = $this->pm->get_data('categories',false);
  $data['company'] = $company = $this->pm->company_details();

  $this->load->view('web/check_out_invoice',$data);
}

public function load_product_cart()
  { 
  echo $this->show_product_cart();
}

public function show_product_cart()
  { 
  $output = '';
  $no = 0;
  foreach ($this->cart->contents() as $items)
    {
    $no++;
    $output .='
      <tr>
        <td>'.$items['name'].'<input type="hidden" name="product[]"" value="'.$items['id'].'" required ></td>
        <td>'.$items['psize'].'<input type="hidden" name="psize[]"" value="'.$items['ps_id'].'" required ></td>
        <td>'.number_format($items['price']).'<input type="hidden" name="price[]"" value="'.$items['price'].'" required ></td>
        <td>'.$items['qty'].'<input type="hidden" name="quantity[]"" value="'.$items['qty'].'" required ></td>
        <td>'.number_format($items['subtotal']).'<input type="hidden" name="tprice[]"" value="'.$items['subtotal'].'" required ></td>
        <td><button type="button" id="'.$items['rowid'].'" class="romoveCart btn btn-danger btn-sm">X</button></td>
      </tr>';
    }
  $output .= '
    <tr>
      <th colspan="5">Total Amount</th>
      <th colspan="2">'.'৳ '.number_format($this->cart->total()).'</th>
    </tr>';
  return $output;
}

// public function saved_sale()
//   {
//   if($_SESSION['empid'])
//     {
//   $info = $this->input->post();

//   $query = $this->db->select('invoice_no')
//                 ->from('sales')
//                 ->limit(1)
//                 ->order_by('invoice_no','DESC')
//                 ->get()
//                 ->row();
//   if($query)
//     {
//     $sn = substr($query->invoice_no,7)+1;
//     }
//   else
//     {
//     $sn = 1;
//     }

//   $company = $this->pm->company_details();
//   $cn = strtoupper(substr($company->com_name,0,3));
//   $pc = sprintf("%'05d", $sn);

//   $cusid = 'INV-'.$cn.$pc;

//   $sale = array(
//     'invoice_no'  => $cusid,
//     'saleDate'    => date('Y-m-d'),
//     'custid'      => $_SESSION['empid'],
//     'totalAmount' => array_sum($info['tprice']),
//     'regby'       => $_SESSION['uid']
//             );
//         //var_dump($sale); exit();
//   $result = $this->pm->insert_data('sales',$sale);
       
//   $length = count($info['product']);

//   for($i = 0; $i < $length; $i++)
//     {
//     $spdata = array(
//       'saleID'   => $result,
//       'product'  => $info['product'][$i],
//       'psize'    => $info['psize'][$i],
//       'pcolor'   => $info['pcolor'][$i],                       
//       'quantity' => $info['quantity'][$i],
//       'sprice'   => $info['price'][$i],
//       'tPrice'   => $info['tprice'][$i],
//       'regby'    => $_SESSION['uid']
//           );

//     $result2 == $this->pm->insert_data('sale_product',$spdata); 
//     }
//   if($result2)
//     {
//     $sdata = [
//       'exception' =>'<div class="alert alert-success alert-dismissible">
//         <h4><i class="icon fa fa-check"></i> Product Order Place Successfully !</h4>
//         </div>'
//             ];  
//     }
//   else
//     {
//     $sdata = [
//       'exception' =>'<div class="alert alert-danger alert-dismissible">
//         <h4><i class="icon fa fa-ban"></i> Failed !</h4>
//         </div>'
//             ];
//     }
//   $this->session->set_userdata($sdata);
//   redirect('checkOut');
//   }
//   else
//     {
//     $sdata = [
//       'exception' =>'<div class="alert alert-danger alert-dismissible">
//         <h4><i class="icon fa fa-ban"></i> Sign Up Your Account !</h4>
//         </div>'
//             ];
//     }
//   $this->session->set_userdata($sdata);
//   redirect('login');
// }

public function about_information() 
  {
  $data['title'] = 'About Us';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  
  $this->load->view('web/about_us',$data);
}

public function contact_information() 
  {
  $data['title'] = 'Contact Us';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['company'] = $this->pm->company_details();
  
  $this->load->view('web/contact_us',$data);
}

public function dr_policy_information() 
  {
  $data['title'] = 'Delivery & Return Policy';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );
  $other = array(
    'limit' => 5
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['unit'] = $this->pm->get_data('sma_units',$swhere,false,false,$other);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['policy'] = $this->pm->get_data('delivery_return_policy',false);
  $data['company'] = $this->pm->company_details();
  
  $this->load->view('web/dreturn_policy',$data);
}

public function com_policy_information() 
  {
  $data['title'] = 'Company Policy';

  $where = array(
    'status' => 'Active'
        );
  $swhere = array(
    'status' => 'Active',
    'catid' => 1
        );
  $other = array(
    'limit' => 5
        );

  $data['mainmanu'] = $this->pm->get_data('categories',$where);
  $data['submanu'] = $this->pm->get_data('sma_units',$swhere);
  $data['unit'] = $this->pm->get_data('sma_units',$swhere,false,false,$other);
  $data['about'] = $this->pm->get_data('about_us',false);
  $data['policy'] = $this->pm->get_data('company_policy',false);
  $data['company'] = $this->pm->company_details();
  
  $this->load->view('web/cpolicy',$data);
}


        ################################################
        #   /* Pages  end*/                            #
        ################################################
}
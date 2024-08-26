<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

public function __construct(){
    parent::__construct();       
    $this->load->model("prime_model",'pm');            
    $this->checkPermission();   
    $this->load->library('PHPExcel');
    $this->load->library('excel');
    $this->load->library('zend');
    $this->zend->load('Zend/Barcode'); 
}

public function index()
    {
    $data['title'] = 'Product'; 

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
    if($_SESSION['role'] > 2)
    {
    $where = array(
      'products.compid' => $_SESSION['compid']
            );

    $data['product'] = $this->pm->get_data('products',$where,$field,$join,$other);
    }
  else
    {
    $data['product'] = $this->pm->get_data('products',false,$field,$join,$other);
    }

    $uwhere = array(
      'status' => 'Active'
          );

    $data['category'] = $this->pm->get_data('categories',$uwhere);
     
     
      $child_other = array(
       'order_by' => 'childcategoryID',
       'join'     => 'left' 
            );
    $child_field = array(
        'categories_child'   => 'categories_child.*',
        'categories' => 'categories.categoryName',
        'categories_sub' => 'categories_sub.subcategoryName',
       
            );
    $child_join = array(
        'categories' => 'categories.categoryID = categories_child.categoryID',
        'categories_sub' => 'categories_sub.subcategoryID = categories_child.subcategoryID',
            );
    $data['category_child'] = $this->pm->get_data('categories_child',false, $child_field, $child_join, $child_other);
    
     $sub_other = array(
       'order_by' => 'subcategoryID',
       'join'     => 'left' 
            );
    $sub_field = array(
        'categories_sub'   => 'categories_sub.*',
        'categories' => 'categories.categoryName',
       
            );
    $sub_join = array(
        'categories' => 'categories.categoryID = categories_sub.categoryID',
            );
    $data['category_sub'] = $this->pm->get_data('categories_sub',false, $sub_field, $sub_join, $sub_other);
    $data['unit'] = $this->pm->get_data('sma_units',$uwhere);
    // $data['product_colors'] = $this->pm->get_data('product_colors');

    $data['product_sizes'] = $this->pm->get_data('product_sizes');
    $data['product_tags'] = $this->pm->get_data('product_tags');
    $data['supplier'] = $this->pm->get_data('suppliers',$uwhere);
    
    $this->load->view('products/product',$data);
}

public function save_product()
    {
    $info = $this->input->post();
    //var_dump('hello'); exit();
    $config['upload_path'] = './upload/product/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
    if ($this->upload->do_upload('userfile'))
        {
        $img = $this->upload->data('file_name');
        }
    else
        {
        $img = '';
        }
        
        
    if ($this->upload->do_upload('userfile1'))
        {
        $img1 = $this->upload->data('file_name');
        }
    else
        {
        $img1 = '';
        }
        
    if ($this->upload->do_upload('userfile2'))
        {
        $img2 = $this->upload->data('file_name');
        }
    else
        {
        $img2 = '';
        }
        
        if ($this->upload->do_upload('userfile3'))
        {
        $img3 = $this->upload->data('file_name');
        }
    else
        {
        $img3 = '';
        }
        
        if ($this->upload->do_upload('userfile4'))
        {
        $img4 = $this->upload->data('file_name');
        }
    else
        {
        $img4 = '';
        }
        
        if ($this->upload->do_upload('userfile5'))
        {
        $img5 = $this->upload->data('file_name');
        }
    else
        {
        $img5 = '';
        }
    //var_dump($img); exit();
    
    if(substr($info['categoryID'],0,1)=='C'){
        
        $childid = substr($info['categoryID'],1);
        
        $child_where = array(
            
            'childcategoryID' => $childid,
            
            );
            
        $data['category_child'] = $this->pm->get_data('categories_child',$child_where);
        foreach($data['category_child'] as $value){
            
            $subid = $value['subcategoryID'];
            $catid = $value['categoryID'];
        }
    }
    elseif(substr($info['categoryID'],0,1)=='S'){
        
        $sub = substr($info['categoryID'],1);
        $child_where = array(
            
            'subcategoryID' => $sub,
            
            );
            
        $data['categories_sub'] = $this->pm->get_data('categories_sub',$child_where);
        foreach($data['categories_sub'] as $value){
            
            $subid = $value['subcategoryID'];
            $catid = $value['categoryID'];
            
            $childid = 0;
        }
        
        
        
    
    }
    else{
        $catid = $info['categoryID'];
        $subid = 0;
        $childid = 0;
    }
    // if($info['categoryID'] == 'newCategory')
    //     {
    //     $cdata = [
    //         'compid'       => $_SESSION['compid'],
    //         'categoryName' => $info['newCategory'],
    //         'regby'        => $_SESSION['uid']
    //             ];
           
    //     $catdata = $this->pm->insert_data('categories',$cdata);

    //     $catid = $catdata;
    //     }
    // else
    //     {
    //     $catid = $info['categoryID'];
    //     }

    if($info['units'] == 'newUnit')
        {
        $udata = [
            'compid'   => $_SESSION['compid'],
            'unitName' => $info['newUnit'],
            'regby'    => $_SESSION['uid']
                ];
       
        $utdata = $this->pm->insert_data('sma_units',$udata);

        $utid = $utdata;
        }
    else
        {
        $utid = $info['units'];
        }

    // $query = $this->db->select('productID')
    //               ->from('products')
    //               //->where('compid',$_SESSION['compid'])
    //               ->limit(1)
    //               ->order_by('productID','DESC')
    //               ->get()
    //               ->row();
    // if($query)
    //     {
    //     $sn = $query->productID+1;
    //     }
    // else
    //     {
    //     $sn = 1;
    //     }

    // $cn = strtoupper(substr($_SESSION['compname'],0,3));
    // $pc = sprintf("%'05d",$sn);

    // $cusid = 'P'.$cn.$pc;
    //var_dump($cusid); exit();
    $info = [
        'compid'      => $_SESSION['compid'],
        'productcode' => $info['pCode'],
        'productName' => $info['productName'],
        'categoryID'  => $catid,
        'subcategoryID'  => $subid,
        'childcategoryID'  => $childid,
        'unit'        => $utid,
        'pprice'      => $info['pprice'],
        'sprice'      => $info['sprice'],
        'regularPrice'      => $info['regularPrice'],
        'branding'      => $info['newBranding'],
        'sortDescription'      => $info['shortDescription'],
        'longDescription'      => $info['longDescription'],
        'lowStock'      => $info['lowStock'],
        'maxAdd'      => $info['maxAdd'],
        // 'colorID'      => $info['newColor'],
        'fpshow'      => $info['productShow'],
        'sizeID'      => $info['newSize'],
        'tagID'      => $info['newTag'],
        'shipping_time'      => $info['shippingTime'],
        'website_show'      => $info['productShow'],
        // 'stockFor'      => $info['stockFor'],
        'lowStock'      => $info['lowStock'],
        'gImage1'       => $img1,
        'gImage2'       => $img2,
        'gImage3'       => $img3,
        'gImage4'       => $img4,
        'gImage5'       => $img5,
        'image'       => $img,
        'regby'       => $_SESSION['uid']
            ];
    $result = $this->pm->insert_data('products',$info);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product added Successfully !</h4>
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
    redirect('Product');
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
        'sma_units'  => 'sma_units.unitName'
            );
    $join = array(
        'categories' => 'categories.categoryID = products.categoryID',
        'sma_units'  => 'sma_units.id = products.unit'
            );

    $data['product'] = $product = $this->pm->get_data('products',$where,$field,$join,$other);
    $data['product'] = $product[0];

    $this->load->view('products/productView',$data);
}

public function edit_products($id)
    {
    $data['title'] = 'Product';

    $where = array(
        'status' => 'Active'
            );

    // $data['category'] = $this->pm->get_data('categories',$where);
    // $uwhere = array(
    //   'status' => 'Active'
    //       );

    $data['category'] = $this->pm->get_data('categories',$where);
     
     
      $child_other = array(
       'order_by' => 'childcategoryID',
       'join'     => 'left' 
            );
    $child_field = array(
        'categories_child'   => 'categories_child.*',
        'categories' => 'categories.categoryName',
        'categories_sub' => 'categories_sub.subcategoryName',
       
            );
    $child_join = array(
        'categories' => 'categories.categoryID = categories_child.categoryID',
        'categories_sub' => 'categories_sub.subcategoryID = categories_child.subcategoryID',
            );
    $data['category_child'] = $this->pm->get_data('categories_child',false, $child_field, $child_join, $child_other);
    
     $sub_other = array(
       'order_by' => 'subcategoryID',
       'join'     => 'left' 
            );
    $sub_field = array(
        'categories_sub'   => 'categories_sub.*',
        'categories' => 'categories.categoryName',
       
            );
    $sub_join = array(
        'categories' => 'categories.categoryID = categories_sub.categoryID',
            );
    $data['category_sub'] = $this->pm->get_data('categories_sub',false, $sub_field, $sub_join, $sub_other);
    $data['unit'] = $this->pm->get_data('sma_units',$where);
    $data['product_sizes'] = $this->pm->get_data('product_sizes', false);
    $data['product_tags'] = $this->pm->get_data('product_tags', false);
    $data['supplier'] = $this->pm->get_data('suppliers',$where);

    $pwhere = array(
        'productID' => $id
            );

    $product = $this->pm->get_data('products',$pwhere);
    $data['product'] = $product[0];
    //var_dump($data['unit']);
    $this->load->view('products/edit_product',$data);
}

public function update_product()
    {
    $info = $this->input->post();
    $pid = $info['productid'];
    //var_dump($pid); exit();
    $config['upload_path'] = './upload/product/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;

    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    if ($this->upload->do_upload('userfile'))
        {
        $img = $this->upload->data('file_name');
        }
    else
        {
        $pimg = $this->db->select('image')->from('products')->where('productID',$pid)->get()->row();
        if($pimg)
            {
            $img = $pimg->image;
            }
        else
            {
            $img = '';
            }
        }
    
    if(substr($info['categoryID'],0,1)=='C'){
        
        $childid = substr($info['categoryID'],1);
        
        $child_where = array(
            
            'childcategoryID' => $childid,
            
            );
            
            
        // $child_field = array(
        //     'categories_child'   => 'categories_child.*',
        //     'categories' => 'categories.categoryID',
        //     'categories_sub' => 'categories_sub.subcategoryID',
           
        //         );
        // $child_join = array(
        //     'categories' => 'categories.categoryID = categories_child.categoryID',
        //     'categories_sub' => 'categories_sub.subcategoryID = categories_child.subcategoryID',
        //         );
                
        // $child_other = array(
        //   'order_by' => 'childcategoryID',
        //   'join'     => 'left' 
        //         );
                
        $data['category_child'] = $this->pm->get_data('categories_child',$child_where, $child_field, $child_join, $child_other);
        foreach($data['category_child'] as $value){
            
            $subid = $value['subcategoryID'];
            $catid = $value['categoryID'];
        }
    }
    elseif(substr($info['categoryID'],0,1)=='S'){
         $sub = substr($info['categoryID'],1);
        $child_where = array(
            
            'subcategoryID' => $sub,
            
            );

                
        $data['categories_sub'] = $this->pm->get_data('categories_sub',$child_where);
        foreach($data['categories_sub'] as $value){
            
            $subid = $value['subcategoryID'];
            $catid = $value['categoryID'];
            $childid = 0;
        }
        
        
        
        // $subid = substr($info['categoryID'],1); 
        // $catid = $info['categoryID'];
        // $childid = 0;
    }
    else{
        $catid = $info['categoryID'];
        $subid = 0;
        $childid = 0;
    }
    
    if($info['units'] == 'newUnit')
        {
        $udata = [
            'compid'   => $_SESSION['compid'],
            'unitName' => $info['newUnit'],
            'regby'    => $_SESSION['uid']
                ];
       
        $utdata = $this->pm->insert_data('sma_units',$udata);

        $utid = $utdata;
        }
    else
        {
        $utid = $info['units'];
        }

    $info = [
        'productcode' => $info['pCode'],
        'productName' => $info['productName'],
        'categoryID'  => $catid,
        'subcategoryID'  => $subid,
        'childcategoryID'  => $childid,
        'unit'        => $utid,
        'pprice'      => $info['pprice'],
        'sprice'      => $info['sprice'],
        'regularPrice'      => $info['regularPrice'],
        'branding'      => $info['newBranding'],
        'sortDescription'      => $info['shortDescription'],
        'longDescription'      => $info['longDescription'],
        'lowStock'      => $info['lowStock'],
        'maxAdd'      => $info['maxAdd'],
        'fpshow'      => $info['productShow'],
        'sizeID'      => $info['newSize'],
        'tagID'      => $info['newTag'],
        'shipping_time'      => $info['shippingTime'],
        'website_show'      => $info['productShow'],
        // 'stockFor'      => $info['stockFor'],
        'lowStock'      => $info['lowStock'],
        // 'gImage1'       => $img1,
        // 'gImage2'       => $img2,
        // 'gImage3'       => $img3,
        // 'gImage4'       => $img4,
        // 'gImage5'       => $img5,
        'image'       => $img,
        'upby'       => $_SESSION['uid']
            ];
    $where = array(
        'productID' => $pid
            );
    //var_dump($where); exit();
    $result = $this->pm->update_data('products',$info,$where);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product updated Successfully !</h4>
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
    redirect('Product');
}

public function delete_products($pid)
    {
    $where = array(
        'productID' => $pid
            );
    //var_dump($where); exit();
    $result = $this->pm->delete_data('products',$where);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product delete Successfully !</h4>
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
    redirect('Product');
}

public function low_product_stock_reports()
    {
    $data['title'] = 'Low Stock Report'; 

    $other = array(
       'join' => 'left'         
            );
    $where = array(
       'stock.compid' => $_SESSION['compid'],
       'stock.totalPices <' => 6
            );
    $field = array(
        'stock' => 'stock.*',
        'products' => 'products.productName,products.productcode,products.pprice'
            );
    $join = array(
        'products' => 'products.productID = stock.product'
            );

    $data['stock'] = $this->pm->get_data('stock',$where,$field,$join,$other);
    $data['company'] = $this->pm->company_details();
    //var_dump($data['products']); exit();
    $this->load->view('products/low_product_stock',$data);
}

public function product_reports()
    {
    $data['title'] = 'Stock Report';
    
    $data['category'] = $this->pm->get_data('categories',false);

  if(isset($_GET['search']))
    {
    $stid = $_GET['sType'];
    if($stid == 1)
      {
      $catid = $_GET['category'];
            
      $data['stock'] = $this->pm->get_product_sstock_data($catid);
      $data['sType'] = 0;
      }
    }
  else
    {
    $data['stock'] = $this->pm->get_product_stock_data();
    }
    //var_dump($data['products']); exit();
    $this->load->view('products/product_report',$data);
}

public function save_product_store()
    {
    $info = $this->input->post();

    $swhere = array(
        'product' => $info['product']
                );

    $stpd = $this->pm->get_data('stock',$swhere);

    $this->pm->delete_data('stock',$swhere);

    if($stpd)
        {
        $tquantity = $stpd[0]['totalPices']+$info['quantity'];
        $dtqnt = $stpd[0]['dtquantity'];
        }
    else{
        $tquantity = $info['quantity'];
        $dtqnt = 0;
        }

    $info = [
        'compid'     => $_SESSION['compid'],
        'product'    => $info['product'],
        'totalPices' => $tquantity,
        'dtquantity' => $dtqnt,
        'regby'      => $_SESSION['uid']
            ];
    //var_dump($productID); exit();
    $result = $this->pm->insert_data('stock',$info);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product Store Successfully !</h4>
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
    redirect('Product');
}

public function save_damage_product()
    {
    $info = $this->input->post();

    $swhere = array(
        'product' => $info['product'],
        'compid'  => $_SESSION['compid']
                );

    $stpd = $this->pm->get_data('stock',$swhere);

    $this->pm->delete_data('stock',$swhere);

    if($stpd)
        {
        $tquantity = $stpd[0]['totalPices']-$info['quantity'];
        $dtqnt = $stpd[0]['dtquantity']+$info['quantity'];
        }
    else{
        $tquantity = '-'.$info['quantity'];
        $dtqnt = $info['quantity'];
        }

    $stock = [
        'compid'     => $_SESSION['compid'],
        'product'    => $info['product'],
        'totalPices' => $tquantity,
        'dtquantity' => $dtqnt,
        'regby'      => $_SESSION['uid']
            ];
    //var_dump($productID); exit();
    $result = $this->pm->insert_data('stock',$stock);
    
    $dproduct = [
        'compid'   => $_SESSION['compid'],
        'product'  => $info['product'],
        'quantity' => $info['quantity'],
        'regby'    => $_SESSION['uid']
            ];
    //var_dump($productID); exit();
    $this->pm->insert_data('ds_product',$dproduct);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Damage Product Store Successfully !</h4>
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
    redirect('Product');
}

public function export_action()
    {
    $this->load->library("excel");
    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array("Product Name", "Product Code", "Category", "Units", "Purchase Price", "Sale Price");

    $column = 0;

    foreach($table_columns as $field)
        {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
        }

    $product_data = $this->pm->product_fetch_data($_SESSION['compid']);
    //print_r($product_data); exit();
    $excel_row = 2;

    foreach($product_data as $row)
        {
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->productName);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->productcode);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->categoryID);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->unit);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->pprice);
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->sprice);
        $excel_row++;
        }

    //$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
    $object->getActiveSheet()->setTitle('Products');

    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

    header("Last-Modified: ".gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Products Data.xls"');
    ob_end_clean();
    $object_writer->save('php://output');
}

public function excel_import()
    {
    if(isset($_FILES["file"]["name"]))
        {
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        foreach($object->getWorksheetIterator() as $worksheet)
            {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $catid = '';
            for($row=2; $row<=$highestRow; $row++)
                {
                $productName = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $code = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $categoryID = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $units = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $pprice = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $sprice = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                
                $cat = $this->db->select('categoryID')->from('categories')->where('categoryID', $categoryID)->get()->row();
                $unt = $this->db->select('id')->from('sma_units')->where('id', $units)->get()->row();
                
                if(!$cat && !is_numeric($categoryID)){
                    $data = array(
                        'compid'       => $_SESSION['compid'],
                        'categoryName' => $categoryID,
                        'regby'        => $_SESSION['uid']
                            );
                    $this->db->insert('categories',$data);
                    $catn = $this->db->select('categoryID')->from('categories')->where('categoryName', $categoryID)->get()->row();
                    $categoryID = intval($catn->categoryID);
                }
                if(!$unt && !is_numeric($units)){
                    $data = array(
                        'compid'   => $_SESSION['compid'],
                        'unitName' => $units,         
                        'regby'    => $_SESSION['uid']
                            );
                    $this->db->insert('sma_units',$data);
                    $unit = $this->db->select('id')->from('sma_units')->where('unitName', $units)->get()->row();
                    $units = intval($unit->id);
                }

                if($code){
                    $cusid = $code;
                }else{
                    
                    $query = $this->db->select('productcode')
                                  ->from('products')
                                  ->where('compid',$_SESSION['compid'])
                                  ->limit(1)
                                  ->order_by('productcode','DESC')
                                  ->get()
                                  ->row();
                    if($query)
                        {
                        $sn = substr($query->productcode,5)+1;
                        }
                    else
                        {
                        $sn = 1;
                        }
    
                    $cn = strtoupper(substr($_SESSION['compname'],0,3));
                    $pc = sprintf("%'05d",$sn);
    
                    $cusid = 'P-'.$cn.$pc;
                }


                $data = array(
                    'compid'      => $_SESSION['compid'],
                    'productName' => $productName,
                    'productcode' => $cusid,
                    'categoryID'  => $categoryID,
                    'unit'        => $units,
                    'pprice'      => $pprice,
                    'sprice'      => $sprice,
                    'regby'       => $_SESSION['uid']
                        );
                // var_dump($data);exit();
                $result = $this->db->insert('products', $data);
                }
            }
            
        
        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Product import Successfully !</h4>
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
    }   
}

public function add_product()
    {
    $query = $this->db->select('productcode')
                  ->from('products')
                  ->where('compid',$_SESSION['compid'])
                  ->limit(1)
                  ->order_by('productcode','DESC')
                  ->get()
                  ->row();
    if($query)
        {
        $sn = substr($query->productcode,5)+1;
        }
    else
        {
        $sn = 1;
        }

    $cn = strtoupper(substr($_SESSION['compname'],0,3));
    $pc = sprintf("%'05d", $sn);

    $cusid = 'P-'.$cn.$pc;

    $data = array(
        'compid'      => $_SESSION['compid'],
        'productName' => $_POST['productName'],
        'productcode' => $cusid,
        'categoryID'  => $_POST['categoryID'],
        'unit'        => $_POST['unit'],
        'pprice'      => $_POST['pprice'],
        'sprice'      => $_POST['sprice'],            
        'regby'       => $_SESSION['uid']
            );

    $result = $this->pm->insert_data('products',$data);


    if($result)
        {
        $swhere = array(
            'compid' => $_SESSION['compid']
                );
        $products = $this->pm->get_data('products',$swhere);

        $append = '<div id="customer_hide"><label>Product *</label>
                    <select class="form-control chosen" name="products" onchange="myFunction()" id="products" required>
                    <option value="">Select One</option>
                    ';
        foreach($products as $value)
            {
            $append .= '<option value=" '.$value['productID'] .' ">'.$value['productName'].'('.$value['productcode'].')</option>';
            }
        $append .= '</select></div>';
        echo $append;
        }
    else
        {
        echo "Product Added Failed!";
        }
}

public function product_barcode_list()
  {
  $data['title'] = 'Product';

  $data['products'] = $this->pm->get_data('products',false);

    //var_dump($data['products']); exit();
  $data['content'] = $this->load->view('products/product_BC_list',$data,TRUE);
  $this->load->view('themes/adminlte',$data);
}

public function create_product_barcode($id)
  {
  $data['title'] = 'Product';

  if(isset($_GET['search']))
    {
    $nopack = $_GET['nopack'];
    $data['nopack'] = $nopack;
    $data['product'] = $id;

    $where = array(
      'productID' => $id
          );

    $data['product'] = $this->pm->get_data('products',$where);
    }
  else
    {
    $where = array(
      'productID' => $id
          );

    $data['product'] = $this->pm->get_data('products',$where);
    }
    //var_dump($data['products']); exit();
  $this->load->view('products/product_barcode',$data);
}

public function stock_product_export()
    {
    $this->load->library("excel");
    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array("Product Name","Product Code","Category","Units","Purchase Price","Sale Price","In Quantity","Out Quantity","Stock","Damage Stock","Stock Sale Price","Stock Purchase Price");

    $column = 0;

    foreach($table_columns as $field)
        {
        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        $column++;
        }

    $product_data = $this->pm->get_product_stock_data();
    //print_r($product_data); exit();
    $excel_row = 2;

    foreach($product_data as $row)
        {
        $cat = $this->db->select("categoryName")->from('categories')->where('categoryID',$row->categoryID)->get()->row();
        $unt = $this->db->select("unitName")->from('sma_units')->where('id',$row->unit)->get()->row();
        
        $pp = $this->db->select("SUM(purchase_product.quantity) as tpq,purchase.compid")
                    ->from('purchase_product')
                    ->join('purchase','purchase.purchaseID = purchase_product.purchaseID','left')
                    ->where('productID',$row->product)
                    ->group_by('purchase_product.purchaseID')
                    ->get()
                    ->row();

        $spp = $this->db->select("SUM(sale_product.quantity) as tsq,sales.compid")
                    ->from('sale_product')
                    ->join('sales','sales.saleID = sale_product.saleID','left')
                    ->where('productID',$row->product)
                    ->group_by('sale_product.saleID')
                    ->get()
                    ->row();
      
        $rp = $this->db->select("SUM(returns_product.quantity) as trq,returns.compid")
                    ->from('returns_product')
                    ->join('returns','returns.returnId = returns_product.rt_id','left')
                    ->where('productID',$row->product)
                    ->group_by('returns_product.rt_id')
                    ->get()
                    ->row();
      
        $rpp = $this->db->select("SUM(quantity) as trq")
                    ->from('preturns_product')
                    ->where('product',$row->product)
                    ->get()
                    ->row();
        if($pp){ $tpq = $pp->tpq; } else{ $tpq = 0; }
        if($rpp){ $trq = $rpp->trq; } else{ $trq = 0; }
        if($spp){ $tsq = $spp->tsq; } else{ $tsq = 0; }
        if($rp){ $trpq = $rp->trq; } else{ $trpq = 0; }
        
        $tiq = $tpq-$trq;
        $toq = $tsq-$trpq;
        $ssa = $row->totalPices*$row->sprice;
        $spa = $row->totalPices*$row->pprice;
                          
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->productName);
        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->productcode);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $cat->categoryName);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $unt->unitName);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->pprice);
        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->sprice);
        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $tiq);
        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $toq);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->totalPices);
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->dtquantity);
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $ssa);
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $spa);
        $excel_row++;
        }

    //$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
    $object->getActiveSheet()->setTitle('Products');

    //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');

    header("Last-Modified: ".gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Products Stock.xls"');
    ob_end_clean();
    $object_writer->save('php://output');
}






}
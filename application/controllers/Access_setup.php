<?php 
defined ('BASEPATH') OR exit('no direct script access allowed');
class Access_setup extends CI_Controller

##############################################################################
{   	/* Code Start From Here */
##############################################################################

public function __construct()
  {
  parent::__construct();
  $this->load->model("prime_model","pm");
  $this->checkPermission();
}

	#############################################################
	#				/* Pages start*/							#
	#############################################################
						

public function user_access_setup()
  {
  $data = ['title' => 'Access Setup'];

  $where = array('ax_id >' => 2);
  $data['user'] = $this->pm->get_data('access_lavels',$where);
  
  $this->load->view('user_role/user_access_setup',$data);
}

public function view_uaccess_setup($id)
  {
  $data = ['title' => 'Access Setup'];

  $where = array('utype'=> $id);
  $data['master'] = $this->pm->get_data('tbl_user_m_permission',$where);
  $data['page'] = $this->pm->get_data('tbl_user_p_permission',$where);
  $data['function'] = $this->pm->get_data('tbl_user_f_permission',$where);

  $awhere = array('ax_id'=> $id);
  $data['user'] = $this->pm->get_data('access_lavels',$awhere);
  
  $this->load->view('user_role/view_uaccess_setup',$data);
}

public function edit_uaccess_setup($id)
  {
  $data = ['title' => 'Access Setup'];

  $where = array('utype'=> $id);
  $data['master'] = $this->pm->get_data('tbl_user_m_permission',$where);
  $data['page'] = $this->pm->get_data('tbl_user_p_permission',$where);
  $data['function'] = $this->pm->get_data('tbl_user_f_permission',$where);

  $awhere = array('ax_id'=> $id);
  $data['user'] = $this->pm->get_data('access_lavels',$awhere);
  
  $this->load->view('user_role/edit_uaccess_setup',$data);
}

public function setup_user_access($id)
  {
  $info = $this->input->post();

  $where = array(
    'utype' => $id
        );

  if(isset($info['product']) == 1)
    {
    $product = 1;
    }
  else
    {
    $product = 0;
    }
  if(isset($info['purchase']) == 1)
    {
    $purchase = 1;
    }
  else
    {
    $purchase = 0;
    }
  if(isset($info['sales']) == 1)
    {
    $sales = 1;
    }
  else
    {
    $sales = 0;
    }
  if(isset($info['return']) == 1)
    {
    $return = 1;
    }
  else
    {
    $return = 0;
    }
  if(isset($info['preturn']) == 1)
    {
    $preturn = 1;
    }
  else
    {
    $preturn = 0;
    }
  if(isset($info['quotation']) == 1)
    {
    $quotation = 1;
    }
  else
    {
    $quotation = 0;
    }
  if(isset($info['voucher']) == 1)
    {
    $voucher = 1;
    }
  else
    {
    $voucher = 0;
    }
  if(isset($info['salary']) == 1)
    {
    $salary = 1;
    }
  else
    {
    $salary = 0;
    }
  if(isset($info['users']) == 1)
    {
    $users = 1;
    }
  else
    {
    $users = 0;
    }
  if(isset($info['report']) == 1)
    {
    $report = 1;
    }
  else
    {
    $report = 0;
    }
  if(isset($info['setting']) == 1)
    {
    $setting = 1;
    }
  else
    {
    $setting = 0;
    }
  if(isset($info['access_setup']) == '1')
    {
    $access_setup = 1;
    }
  else
    {
    $access_setup = 0;
    }
  
  $mdata = [
    'dashboard'    => 1,
    'product'      => $product,
    'purchase'     => $purchase,
    'sales'        => $sales,
    'return'       => $return,
    'preturn'      => $preturn,
    'quotation'    => $quotation,
    'voucher'      => $voucher,
    'salary'       => $salary,
    'users'        => $users,
    'report'       => $report,
    'setting'      => $setting,
    'access_setup' => $access_setup,
    'upby'         => $_SESSION['uid']
            ];
    //var_dump($where); var_dump($data); exit();
  $result = $this->pm->update_data('tbl_user_m_permission',$mdata,$where);
  
  if(isset($info['productlist']) == 1)
    {
    $productlist = 1;
    }
  else
    {
    $productlist = 0;
    }
  if(isset($info['newproduct']) == 1)
    {
    $newproduct = 1;
    }
  else
    {
    $newproduct = 0;
    }
  if(isset($info['purchaselist']) == 1)
    {
    $purchaselist = 1;
    }
  else
    {
    $purchaselist = 0;
    }
  if(isset($info['newpurchase']) == 1)
    {
    $newpurchase = 1;
    }
  else
    {
    $newpurchase = 0;
    }
  if(isset($info['saleslist']) == 1)
    {
    $saleslist = 1;
    }
  else
    {
    $saleslist = 0;
    }
  if(isset($info['newsale']) == 1)
    {
    $newsale = 1;
    }
  else
    {
    $newsale = 0;
    }
  if(isset($info['sreturnlist']) == 1)
    {
    $sreturnlist = 1;
    }
  else
    {
    $sreturnlist = 0;
    }
  if(isset($info['newsreturn']) == 1)
    {
    $newsreturn = 1;
    }
  else
    {
    $newsreturn = 0;
    }
  if(isset($info['preturnlist']) == 1)
    {
    $preturnlist = 1;
    }
  else
    {
    $preturnlist = 0;
    }
  if(isset($info['newpreturn']) == 1)
    {
    $newpreturn = 1;
    }
  else
    {
    $newpreturn = 0;
    }
  if(isset($info['quotationlist']) == 1)
    {
    $quotationlist = 1;
    }
  else
    {
    $quotationlist = 0;
    }
  if(isset($info['newquotation']) == 1)
    {
    $newquotation = 1;
    }
  else
    {
    $newquotation = 0;
    }
  if(isset($info['voucherlist']) == 1)
    {
    $voucherlist = 1;
    }
  else
    {
    $voucherlist = 0;
    }
  if(isset($info['newvoucher']) == 1)
    {
    $newvoucher = 1;
    }
  else
    {
    $newvoucher = 0;
    }
  if(isset($info['emppaylist']) == 1)
    {
    $emppaylist = 1;
    }
  else
    {
    $emppaylist = 0;
    }
  if(isset($info['newemppay']) == 1)
    {
    $newemppay = 1;
    }
  else
    {
    $newemppay = 0;
    }
  if(isset($info['customer']) == 1)
    {
    $customer = 1;
    }
  else
    {
    $customer = 0;
    }
  if(isset($info['supplier']) == 1)
    {
    $supplier = 1;
    }
  else
    {
    $supplier = 0;
    }
  if(isset($info['employee']) == 1)
    {
    $employee = 1;
    }
  else
    {
    $employee = 0;
    }
  if(isset($info['user']) == '1')
    {
    $user = 1;
    }
  else
    {
    $user = 0;
    }
  if(isset($info['salesreport']) == 1)
    {
    $salesreport = 1;
    }
  else
    {
    $salesreport = 0;
    }
  if(isset($info['purchasereport']) == 1)
    {
    $purchasereport = 1;
    }
  else
    {
    $purchasereport = 0;
    }
  if(isset($info['profitreport']) == 1)
    {
    $profitreport = 1;
    }
  else
    {
    $profitreport = 0;
    }
  if(isset($info['salepreport']) == 1)
    {
    $salepreport = 1;
    }
  else
    {
    $salepreport = 0;
    }
  if(isset($info['customerreport']) == 1)
    {
    $customerreport = 1;
    }
  else
    {
    $customerreport = 0;
    }
  if(isset($info['customerledger']) == 1)
    {
    $customerledger = 1;
    }
  else
    {
    $customerledger = 0;
    }
  if(isset($info['supplierreport']) == 1)
    {
    $supplierreport = 1;
    }
  else
    {
    $supplierreport = 0;
    }
  if(isset($info['supplierledger']) == 1)
    {
    $supplierledger = 1;
    }
  else
    {
    $supplierledger = 0;
    }
  if(isset($info['stockreport']) == 1)
    {
    $stockreport = 1;
    }
  else
    {
    $stockreport = 0;
    }
  if(isset($info['voucherreport']) == 1)
    {
    $voucherreport = 1;
    }
  else
    {
    $voucherreport = 0;
    }
  if(isset($info['dailyreport']) == 1)
    {
    $dailyreport = 1;
    }
  else
    {
    $dailyreport = 0;
    }
  if(isset($info['cashbook']) == 1)
    {
    $cashbook = 1;
    }
  else
    {
    $cashbook = 0;
    }
  if(isset($info['bankbook']) == 1)
    {
    $bankbook = 1;
    }
  else
    {
    $bankbook = 0;
    }
  if(isset($info['mobilebook']) == 1)
    {
    $mobilebook = 1;
    }
  else
    {
    $mobilebook = 0;
    }
  if(isset($info['salewpreport']) == 1)
    {
    $salewpreport = 1;
    }
  else
    {
    $salewpreport = 0;
    }
  if(isset($info['custduereport']) == '1')
    {
    $custduereport = 1;
    }
  else
    {
    $custduereport = 0;
    }
  if(isset($info['banktranreport']) == 1)
    {
    $banktranreport = 1;
    }
  else
    {
    $banktranreport = 0;
    }
  if(isset($info['duepayreport']) == 1)
    {
    $duepayreport = 1;
    }
  else
    {
    $duepayreport = 0;
    }
  if(isset($info['btransreport']) == 1)
    {
    $btransreport = 1;
    }
  else
    {
    $btransreport = 0;
    }
  if(isset($info['expensereport']) == 1)
    {
    $expensereport = 1;
    }
  else
    {
    $expensereport = 0;
    }
  if(isset($info['category']) == 1)
    {
    $category = 1;
    }
  else
    {
    $category = 0;
    }
  if(isset($info['unit']) == 1)
    {
    $unit = 1;
    }
  else
    {
    $unit = 0;
    }
  if(isset($info['costtype']) == 1)
    {
    $costtype = 1;
    }
  else
    {
    $costtype = 0;
    }
  if(isset($info['department']) == 1)
    {
    $department = 1;
    }
  else
    {
    $department = 0;
    }
  if(isset($info['bankaccount']) == 1)
    {
    $bankaccount = 1;
    }
  else
    {
    $bankaccount = 0;
    }
  if(isset($info['mobileaccount']) == 1)
    {
    $mobileaccount = 1;
    }
  else
    {
    $mobileaccount = 0;
    }
  if(isset($info['usertype']) == 1)
    {
    $usertype = 1;
    }
  else
    {
    $usertype = 0;
    }
  if(isset($info['balancetransfer']) == 1)
    {
    $balancetransfer = 1;
    }
  else
    {
    $balancetransfer = 0;
    }
  if(isset($info['companyprofile']) == 1)
    {
    $companyprofile = 1;
    }
  else
    {
    $companyprofile = 0;
    }
  if(isset($info['accessetup']) == 1)
    {
    $accessetup = 1;
    }
  else
    {
    $accessetup = 0;
    }
  
  $pdata = [
    'productlist'     => $productlist,
    'newproduct'      => $newproduct,
    'purchaselist'    => $purchaselist,
    'newpurchase'     => $newpurchase,
    'saleslist'       => $saleslist,
    'newsale'         => $newsale,
    'sreturnlist'     => $sreturnlist,
    'newsreturn'      => $newsreturn,
    'preturnlist'     => $preturnlist,
    'newpreturn'      => $newpreturn,
    'quotationlist'   => $quotationlist,
    'newquotation'    => $newquotation,
    'voucherlist'     => $voucherlist,
    'newvoucher'      => $newvoucher,
    'emppaylist'      => $emppaylist,
    'newemppay'       => $newemppay,
    'customer'        => $customer,
    'supplier'        => $supplier,
    'employee'        => $employee,
    'user'            => $user,
    'salesreport'     => $salesreport,
    'purchasereport'  => $purchasereport,
    'profitreport'    => $profitreport,
    'salepreport'     => $salepreport,
    'customerreport'  => $customerreport,
    'customerledger'  => $customerledger,
    'supplierreport'  => $supplierreport,
    'supplierledger'  => $supplierledger,
    'stockreport'     => $stockreport,
    'voucherreport'   => $voucherreport,
    'dailyreport'     => $dailyreport,
    'cashbook'        => $cashbook,
    'bankbook'        => $bankbook,
    'mobilebook'      => $mobilebook,
    'salewpreport'    => $salewpreport,
    'custduereport'   => $custduereport,
    'banktranreport'  => $banktranreport,
    'duepayreport'    => $duepayreport,
    'btransreport'    => $btransreport,
    'expensereport'   => $expensereport,
    'category'        => $category,
    'unit'            => $unit,
    'costtype'        => $costtype,
    'department'      => $department,
    'bankaccount'     => $bankaccount,
    'mobileaccount'   => $mobileaccount,
    'usertype'        => $usertype,
    'balancetransfer' => $balancetransfer,
    'companyprofile'  => $companyprofile,
    'accessetup'      => $accessetup,
    'upby'            => $_SESSION['uid']
            ];
            
  $result2 = $this->pm->update_data('tbl_user_p_permission',$pdata,$where);

  if(isset($info['editproduct']) == 1)
    {
    $editproduct = 1;
    }
  else
    {
    $editproduct = 0;
    }
  if(isset($info['storeproduct']) == 1)
    {
    $storeproduct = 1;
    }
  else
    {
    $storeproduct = 0;
    }
  if(isset($info['deleteproduct']) == 1)
    {
    $deleteproduct = 1;
    }
  else
    {
    $deleteproduct = 0;
    }
  if(isset($info['barcodeproduct']) == 1)
    {
    $barcodeproduct = 1;
    }
  else
    {
    $barcodeproduct = 0;
    }
  if(isset($info['editpurchase']) == 1)
    {
    $editpurchase = 1;
    }
  else
    {
    $editpurchase = 0;
    }
  if(isset($info['deletepurchase']) == 1)
    {
    $deletepurchase = 1;
    }
  else
    {
    $deletepurchase = 0;
    }
  if(isset($info['editsale']) == 1)
    {
    $editsale = 1;
    }
  else
    {
    $editsale = 0;
    }
  if(isset($info['deletesale']) == 1)
    {
    $deletesale = 1;
    }
  else
    {
    $deletesale = 0;
    }
  if(isset($info['editreturn']) == 1)
    {
    $editreturn = 1;
    }
  else
    {
    $editreturn = 0;
    }
  if(isset($info['deletereturn']) == 1)
    {
    $deletereturn = 1;
    }
  else
    {
    $deletereturn = 0;
    }
  if(isset($info['editpreturn']) == 1)
    {
    $editpreturn = 1;
    }
  else
    {
    $editpreturn = 0;
    }
  if(isset($info['deletepreturn']) == 1)
    {
    $deletepreturn = 1;
    }
  else
    {
    $deletepreturn = 0;
    }
  if(isset($info['editquotation']) == 1)
    {
    $editquotation = 1;
    }
  else
    {
    $editquotation = 0;
    }
  if(isset($info['deletequotation']) == 1)
    {
    $deletequotation = 1;
    }
  else
    {
    $deletequotation = 0;
    }
  if(isset($info['editvoucher']) == '1')
    {
    $editvoucher = 1;
    }
  else
    {
    $editvoucher = 0;
    }
  if(isset($info['deletevoucher']) == 1)
    {
    $deletevoucher = 1;
    }
  else
    {
    $deletevoucher = 0;
    }
  if(isset($info['editemppayment']) == 1)
    {
    $editemppayment = 1;
    }
  else
    {
    $editemppayment = 0;
    }
  if(isset($info['deleteemppayment']) == 1)
    {
    $deleteemppayment = 1;
    }
  else
    {
    $deleteemppayment = 0;
    }
  if(isset($info['newcustomer']) == 1)
    {
    $newcustomer = 1;
    }
  else
    {
    $newcustomer = 0;
    }
  if(isset($info['editcustomer']) == 1)
    {
    $editcustomer = 1;
    }
  else
    {
    $editcustomer = 0;
    }
  if(isset($info['deletecustomer']) == 1)
    {
    $deletecustomer = 1;
    }
  else
    {
    $deletecustomer = 0;
    }
  if(isset($info['newsupplier']) == 1)
    {
    $newsupplier = 1;
    }
  else
    {
    $newsupplier = 0;
    }
  if(isset($info['editsupplier']) == 1)
    {
    $editsupplier = 1;
    }
  else
    {
    $editsupplier = 0;
    }
  if(isset($info['deletesupplier']) == 1)
    {
    $deletesupplier = 1;
    }
  else
    {
    $deletesupplier = 0;
    }
  if(isset($info['newemployee']) == 1)
    {
    $newemployee = 1;
    }
  else
    {
    $newemployee = 0;
    }
  if(isset($info['editemployee']) == 1)
    {
    $editemployee = 1;
    }
  else
    {
    $editemployee = 0;
    }
  if(isset($info['deleteemployee']) == 1)
    {
    $deleteemployee = 1;
    }
  else
    {
    $deleteemployee = 0;
    }
  if(isset($info['newuser']) == 1)
    {
    $newuser = 1;
    }
  else
    {
    $newuser = 0;
    }
  if(isset($info['edituser']) == 1)
    {
    $edituser = 1;
    }
  else
    {
    $edituser = 0;
    }
  if(isset($info['deleteuser']) == '1')
    {
    $deleteuser = 1;
    }
  else
    {
    $deleteuser = 0;
    }
  if(isset($info['newcategory']) == 1)
    {
    $newcategory = 1;
    }
  else
    {
    $newcategory = 0;
    }
  if(isset($info['editcategory']) == 1)
    {
    $editcategory = 1;
    }
  else
    {
    $editcategory = 0;
    }
  if(isset($info['deletecategory']) == 1)
    {
    $deletecategory = 1;
    }
  else
    {
    $deletecategory = 0;
    }
  if(isset($info['newunit']) == 1)
    {
    $newunit = 1;
    }
  else
    {
    $newunit = 0;
    }
  if(isset($info['editunit']) == 1)
    {
    $editunit = 1;
    }
  else
    {
    $editunit = 0;
    }
  if(isset($info['deleteunit']) == 1)
    {
    $deleteunit = 1;
    }
  else
    {
    $deleteunit = 0;
    }
  if(isset($info['newctype']) == 1)
    {
    $newctype = 1;
    }
  else
    {
    $newctype = 0;
    }
  if(isset($info['editctype']) == 1)
    {
    $editctype = 1;
    }
  else
    {
    $editctype = 0;
    }
  if(isset($info['deletectype']) == 1)
    {
    $deletectype = 1;
    }
  else
    {
    $deletectype = 0;
    }
  if(isset($info['newdepartment']) == 1)
    {
    $newdepartment = 1;
    }
  else
    {
    $newdepartment = 0;
    }
  if(isset($info['editdepartment']) == 1)
    {
    $editdepartment = 1;
    }
  else
    {
    $editdepartment = 0;
    }
  if(isset($info['deletedepartment']) == 1)
    {
    $deletedepartment = 1;
    }
  else
    {
    $deletedepartment = 0;
    }
  if(isset($info['newbaccount']) == 1)
    {
    $newbaccount = 1;
    }
  else
    {
    $newbaccount = 0;
    }
  if(isset($info['editbaccount']) == 1)
    {
    $editbaccount = 1;
    }
  else
    {
    $editbaccount = 0;
    }
  if(isset($info['deletebaccount']) == '1')
    {
    $deletebaccount = 1;
    }
  else
    {
    $deletebaccount = 0;
    }
  if(isset($info['newmaccount']) == 1)
    {
    $newmaccount = 1;
    }
  else
    {
    $newmaccount = 0;
    }
  if(isset($info['editmaccount']) == 1)
    {
    $editmaccount = 1;
    }
  else
    {
    $editmaccount = 0;
    }
  if(isset($info['deletemaccount']) == 1)
    {
    $deletemaccount = 1;
    }
  else
    {
    $deletemaccount = 0;
    }
  if(isset($info['newutype']) == 1)
    {
    $newutype = 1;
    }
  else
    {
    $newutype = 0;
    }
  if(isset($info['editutype']) == 1)
    {
    $editutype = 1;
    }
  else
    {
    $editutype = 0;
    }
  if(isset($info['deleteutype']) == 1)
    {
    $deleteutype = 1;
    }
  else
    {
    $deleteutype = 0;
    }
  if(isset($info['newbtranfer']) == 1)
    {
    $newbtranfer = 1;
    }
  else
    {
    $newbtranfer = 0;
    }
  if(isset($info['editbtranfer']) == 1)
    {
    $editbtranfer = 1;
    }
  else
    {
    $editbtranfer = 0;
    }
  if(isset($info['deletebtranfer']) == 1)
    {
    $deletebtranfer = 1;
    }
  else
    {
    $deletebtranfer = 0;
    }
  if(isset($info['newcprofile']) == 1)
    {
    $newcprofile = 1;
    }
  else
    {
    $newcprofile = 0;
    }
  if(isset($info['editcprofile']) == 1)
    {
    $editcprofile = 1;
    }
  else
    {
    $editcprofile = 0;
    }
  if(isset($info['deletecprofile']) == 1)
    {
    $deletecprofile = 1;
    }
  else
    {
    $deletecprofile = 0;
    }

  $fdata = [
    'editproduct'      => $editproduct,
    'storeproduct'     => $storeproduct,
    'deleteproduct'    => $deleteproduct,
    'barcodeproduct'   => $barcodeproduct,
    'editpurchase'     => $editpurchase,
    'deletepurchase'   => $deletepurchase,
    'editsale'         => $editsale,
    'deletesale'       => $deletesale,
    'editreturn'       => $editreturn,
    'deletereturn'     => $deletereturn,
    'editpreturn'      => $editpreturn,
    'deletepreturn'    => $deletepreturn,
    'editquotation'    => $editquotation,
    'deletequotation'  => $deletequotation,
    'editvoucher'      => $editvoucher,
    'deletevoucher'    => $deletevoucher,
    'editemppayment'   => $editemppayment,
    'deleteemppayment' => $deleteemppayment,
    'newcustomer'      => $newcustomer,
    'editcustomer'     => $editcustomer,
    'deletecustomer'   => $deletecustomer,
    'newsupplier'      => $newsupplier,
    'editsupplier'     => $editsupplier,
    'deletesupplier'   => $deletesupplier,
    'newemployee'      => $newemployee,
    'editemployee'     => $editemployee,
    'deleteemployee'   => $deleteemployee,
    'newuser'          => $newuser,
    'edituser'         => $edituser,
    'deleteuser'       => $deleteuser,
    'newcategory'      => $newcategory,
    'editcategory'     => $editcategory,
    'deletecategory'   => $deletecategory,
    'newunit'          => $newunit,
    'editunit'         => $editunit,
    'deleteunit'       => $deleteunit,
    'newctype'         => $newctype,
    'editctype'        => $editctype,
    'deletectype'      => $deletectype,
    'newdepartment'    => $newdepartment,
    'editdepartment'   => $editdepartment,
    'deletedepartment' => $deletedepartment,
    'newbaccount'      => $newbaccount,
    'editbaccount'     => $editbaccount,
    'deletebaccount'   => $deletebaccount,
    'newmaccount'      => $newmaccount,
    'editmaccount'     => $editmaccount,
    'deletemaccount'   => $deletemaccount,
    'newutype'         => $newutype,
    'editutype'        => $editutype,
    'deleteutype'      => $deleteutype,
    'newbtranfer'      => $newbtranfer,
    'editbtranfer'     => $editbtranfer,
    'deletebtranfer'   => $deletebtranfer,
    'newcprofile'      => $newcprofile,
    'editcprofile'     => $editcprofile,
    'deletecprofile'   => $deletecprofile,
    'upby'             => $_SESSION['uid']
            ];
    //var_dump($data2); exit();
  $result3 = $this->pm->update_data('tbl_user_f_permission',$fdata,$where);

  if($result && $result && $result3)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> User Page and Function Access add Successfully !</h4>
      </div>'
          ];    
    }
  else
    {
    $sdata=[
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-ban"></i> Failed !</h4>
      </div>'
          ];
    }

  $this->session->set_userdata($sdata);
  redirect('userAccess');
}




	#########################################################
	#				/* Pages End */							#
	#########################################################


############################################################################
}   	/* Code Ends Here */
############################################################################
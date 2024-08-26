<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userlogin extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model",'pm');
    $this->load->library('email');
}

        ################################################
        #   /* Pages  start*/                          #
        ################################################

public function index()
    {
    $data['title'] = 'Sign In';
    

  $data['company'] = $company = $this->pm->company_details();



 

        
    $this->load->view('web/login',$data);
}

public function loginProcess()
    {
    $info = $this->input->post();

    $uname = $info['username'];
    if(is_numeric($uname))
        {     
        $where = array(
            'mobile'   => '+88'.$info['username'],
            'status'   => 'Active',
            'password' => $info['password']
                );
        }
    else
        {
        $where = array(
            'email'    => $info['username'],
            'status'   => 'Active',
            'password' => $info['password']
                );
        }
    // var_dump($where); //exit();
    $user_data = $this->pm->get_data('users',$where);
    //var_dump($user_data); exit();
    if($user_data)
        {
        $udata = [
            'uid'      => $user_data[0]['uid'],
            'name'     => $user_data[0]['name'],
            'compname' => $user_data[0]['compname'],
            'email'    => $user_data[0]['email'],
            'role'     => $user_data[0]['userrole'],
            'compid'   => $user_data[0]['compid'],
            'empid'    => $user_data[0]['empid']
                ];
        //var_dump($udata); exit();
        $this->session->set_userdata($udata);

        $pwhere = array(
            'utype'  => $user_data[0]['userrole'],
            'compid'   => $user_data[0]['compid'],
                );

        $master = $this->pm->get_data('tbl_user_m_permission',$pwhere);
        $page = $this->pm->get_data('tbl_user_p_permission',$pwhere);
        $function = $this->pm->get_data('tbl_user_f_permission',$pwhere);
        //var_dump($paccess); exit();
        if($page)
          {
          $mdata = [
            'dashboard'    => 1,
            'product'      => $master[0]['product'],
            'purchase'     => $master[0]['purchase'],
            'sales'        => $master[0]['sales'],
            'return'       => $master[0]['return'],
            'preturn'      => $master[0]['preturn'],
            'quotation'    => $master[0]['quotation'],
            'voucher'      => $master[0]['voucher'],
            'salary'       => $master[0]['salary'],
            'users'        => $master[0]['users'],
            'report'       => $master[0]['report'],
            'setting'      => $master[0]['setting'],
            'access_setup' => $master[0]['access_setup']
                    ];
          
          $pdata = [
            'productlist'     => $page[0]['productlist'],
            'newproduct'      => $page[0]['newproduct'],
            'purchaselist'    => $page[0]['purchaselist'],
            'newpurchase'     => $page[0]['newpurchase'],
            'saleslist'       => $page[0]['saleslist'],
            'newsale'         => $page[0]['newsale'],
            'sreturnlist'     => $page[0]['sreturnlist'],
            'newsreturn'      => $page[0]['newsreturn'],
            'preturnlist'     => $page[0]['preturnlist'],
            'newpreturn'      => $page[0]['newpreturn'],
            'quotationlist'   => $page[0]['quotationlist'],
            'newquotation'    => $page[0]['newquotation'],
            'voucherlist'     => $page[0]['voucherlist'],
            'newvoucher'      => $page[0]['newvoucher'],
            'emppaylist'      => $page[0]['emppaylist'],
            'newemppay'       => $page[0]['newemppay'],
            'customer'        => $page[0]['customer'],
            'supplier'        => $page[0]['supplier'],
            'employee'        => $page[0]['employee'],
            'user'            => $page[0]['user'],
            'salesreport'     => $page[0]['salesreport'],
            'purchasereport'  => $page[0]['purchasereport'],
            'profitreport'    => $page[0]['profitreport'],
            'salepreport'     => $page[0]['salepreport'],
            'customerreport'  => $page[0]['customerreport'],
            'customerledger'  => $page[0]['customerledger'],
            'supplierreport'  => $page[0]['supplierreport'],
            'supplierledger'  => $page[0]['supplierledger'],
            'stockreport'     => $page[0]['stockreport'],
            'voucherreport'   => $page[0]['voucherreport'],
            'dailyreport'     => $page[0]['dailyreport'],
            'cashbook'        => $page[0]['cashbook'],
            'bankbook'        => $page[0]['bankbook'],
            'mobilebook'      => $page[0]['mobilebook'],
            'salewpreport'    => $page[0]['salewpreport'],
            'custduereport'   => $page[0]['custduereport'],
            'banktranreport'  => $page[0]['banktranreport'],
            'duepayreport'    => $page[0]['duepayreport'],
            'btransreport'    => $page[0]['btransreport'],
            'expensereport'   => $page[0]['expensereport'],
            'category'        => $page[0]['category'],
            'unit'            => $page[0]['unit'],
            'costtype'        => $page[0]['costtype'],
            'department'      => $page[0]['department'],
            'bankaccount'     => $page[0]['bankaccount'],
            'mobileaccount'   => $page[0]['mobileaccount'],
            'usertype'        => $page[0]['usertype'],
            'balancetransfer' => $page[0]['balancetransfer'],
            'companyprofile'  => $page[0]['companyprofile'],
            'accessetup'      => $page[0]['accessetup']
                            ];

          $fdata = [
            'editproduct'      => $function[0]['editproduct'],
            'storeproduct'     => $function[0]['storeproduct'],
            'deleteproduct'    => $function[0]['deleteproduct'],
            'barcodeproduct'   => $function[0]['barcodeproduct'],
            'editpurchase'     => $function[0]['editpurchase'],
            'deletepurchase'   => $function[0]['deletepurchase'],
            'editsale'         => $function[0]['editsale'],
            'deletesale'       => $function[0]['deletesale'],
            'editreturn'       => $function[0]['editreturn'],
            'deletereturn'     => $function[0]['deletereturn'],
            'editpreturn'      => $function[0]['editpreturn'],
            'deletepreturn'    => $function[0]['deletepreturn'],
            'editquotation'    => $function[0]['editquotation'],
            'deletequotation'  => $function[0]['deletequotation'],
            'editvoucher'      => $function[0]['editvoucher'],
            'deletevoucher'    => $function[0]['deletevoucher'],
            'editemppayment'   => $function[0]['editemppayment'],
            'deleteemppayment' => $function[0]['deleteemppayment'],
            'newcustomer'      => $function[0]['newcustomer'],
            'editcustomer'     => $function[0]['editcustomer'],
            'deletecustomer'   => $function[0]['deletecustomer'],
            'newsupplier'      => $function[0]['newsupplier'],
            'editsupplier'     => $function[0]['editsupplier'],
            'deletesupplier'   => $function[0]['deletesupplier'],
            'newemployee'      => $function[0]['newemployee'],
            'editemployee'     => $function[0]['editemployee'],
            'deleteemployee'   => $function[0]['deleteemployee'],
            'newuser'          => $function[0]['newuser'],
            'edituser'         => $function[0]['edituser'],
            'deleteuser'       => $function[0]['deleteuser'],
            'newcategory'      => $function[0]['newcategory'],
            'editcategory'     => $function[0]['editcategory'],
            'deletecategory'   => $function[0]['deletecategory'],
            'newunit'          => $function[0]['newunit'],
            'editunit'         => $function[0]['editunit'],
            'deleteunit'       => $function[0]['deleteunit'],
            'newctype'         => $function[0]['newctype'],
            'editctype'        => $function[0]['editctype'],
            'deletectype'      => $function[0]['deletectype'],
            'newdepartment'    => $function[0]['newdepartment'],
            'editdepartment'   => $function[0]['editdepartment'],
            'deletedepartment' => $function[0]['deletedepartment'],
            'newbaccount'      => $function[0]['newbaccount'],
            'editbaccount'     => $function[0]['editbaccount'],
            'deletebaccount'   => $function[0]['deletebaccount'],
            'newmaccount'      => $function[0]['newmaccount'],
            'editmaccount'     => $function[0]['editmaccount'],
            'deletemaccount'   => $function[0]['deletemaccount'],
            'newutype'         => $function[0]['newutype'],
            'editutype'        => $function[0]['editutype'],
            'deleteutype'      => $function[0]['deleteutype'],
            'newbtranfer'      => $function[0]['newbtranfer'],
            'editbtranfer'     => $function[0]['editbtranfer'],
            'deletebtranfer'   => $function[0]['deletebtranfer'],
            'newcprofile'      => $function[0]['newcprofile'],
            'editcprofile'     => $function[0]['editcprofile'],
            'deletecprofile'   => $function[0]['deletecprofile']
                    ];

          $this->session->set_userdata($mdata);
          $this->session->set_userdata($pdata);
          $this->session->set_userdata($fdata);
          }
        redirect('Dashboard');
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Invalid Login id or Password !</h4>
            </div>'
                ];

        $this->session->set_userdata($sdata);
        redirect('Login');
        }
}

public function register_account()
    {
    $data['title'] = 'Sign Up';
        
    $this->load->view('register',$data);
}

public function check_user_email()
    {
  $grup = $this->pm->check_user_email($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function save_register()
    {
    $info = $this->input->post();

    $ewhere = array(
        'email' => $info['email']
            );
    $edata = $this->pm->get_data('users',$ewhere);

    $mwhere = array(
        'mobile' => '+88'.$info['mobile']
            );
    //var_dump($mwhere); exit();
    $mdata = $this->pm->get_data('users',$mwhere);
    if($edata)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> This email all ready Used !</h4>
            </div>'
            ];

        $this->session->set_userdata($sdata);
        redirect('signUp');
        }
    else if($mdata)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> This mobile number all ready Used !</h4>
            </div>'
            ];

        $this->session->set_userdata($sdata);
        redirect('signUp');
        }
    else
        {
        $query = $this->db->select('compid')
                  ->from('users')
                  ->limit(1)
                  ->order_by('compid','DESC')
                  ->get()
                  ->row();
        if($query)
            {
            $sn = substr($query->compid,5)+1;
            }
        else
            {
            $sn = 1;
            }
        //var_dump($sn); exit();
        $cn = strtoupper(substr($info['name'],0,2));
        $pc = sprintf("%'05d",$sn);

        $empid = 'SUN-'.$cn.'-'.$pc;

        $data = array(
            'name'     => $info['name'],
            'compid'   => $empid,
            'compname' => $info['name'],
            'email'    => $info['email'],
            'mobile'   => '+88'.$info['mobile'],
            'password' => $info['password']
                );

        $result = $this->pm->insert_data('users',$data);

        $where = array(
            'uid' => $result
                );

        $cdata = array(
            'empid'  => $result
                );

        $this->pm->update_data('users',$cdata,$where);

        $udata = [
            'uid'      => $result,
            'name'     => $info['name'],
            'compname' => $info['name'],
            'email'    => $info['email'],
            'role'     => 2,
            'compid'   => $empid
                ];
        //var_dump($sdata); exit();
        $this->session->set_userdata($udata);
        
        $cdata = array(
            'com_name'   => $info['name'],
            'compid'     => $empid,
            'com_mobile' => '+88'.$info['mobile'],
            'com_email'  => $info['email']
                );

        $result = $this->pm->insert_data('com_profile',$cdata);

        $pdata = [
            'utype'        => 2,
            'compid'       => $empid,
            'regby'        => $result,
            'dashboard'    => 1,
            'product'      => 1,
            'purchase'     => 1,
            'sales'        => 1,
            'return'       => 1,
            'quotation'    => 1,
            'voucher'      => 1,
            'users'        => 1,
            'report'       => 1,
            'setting'      => 1,
            'access_setup' => 1,
            'help_support' => 1
                            ];

        $fdata = [
            'utype'                 => 2,
            'compid'                => $empid,
            'regby'                 => $result,
            'add_product'           => 1,
            'view_product'          => 1,
            'edit_product'          => 1,
            'delete_product'        => 1,
            'store_product'         => 1,
            'import_product'        => 1,
            'new_purchase'          => 1,
            'edit_purchase'         => 1,
            'view_purchase'         => 1,
            'delete_purchase'       => 1,
            'new_sale'              => 1,
            'view_sale'             => 1,
            'edit_sale'             => 1,
            'delete_sale'           => 1,
            'new_return'            => 1,
            'view_return'           => 1,
            'edit_return'           => 1,
            'delete_return'         => 1,
            'new_quotation'         => 1,
            'view_quotation'        => 1,
            'edit_quotation'        => 1,
            'delete_quotation'      => 1,
            'new_voucher'           => 1,
            'view_voucher'          => 1,
            'edit_voucher'          => 1,
            'delete_voucher'        => 1,
            'customer'              => 1,
            'supplier'              => 1,
            'employee'              => 1,
            'user'                  => 1,
            'sales_report'          => 1,
            'purchase_report'       => 1,
            'profit_loss_report'    => 1,
            'sales_purchase_report' => 1,
            'customer_report'       => 1,
            'customer_ledger'       => 1,
            'supplier_report'       => 1,
            'supplier_ledger'       => 1,
            'stock_report'          => 1,
            'voucher_report'        => 1,
            'daily_report'          => 1,
            'cash_book'             => 1,
            'bank_book'             => 1,
            'mobile_book'           => 1,
            'category'              => 1,
            'unit'                  => 1,
            'department'            => 1,
            'bank_account'          => 1,
            'mobile_account'        => 1,
            'notice'                => 1,
            'user_type'             => 1
                    ];

        $this->pm->insert_data('tbl_user_m_permission',$pdata);
        $this->pm->insert_data('tbl_user_p_permission',$pdata);
        $this->pm->insert_data('tbl_user_f_permission',$fdata);
        if($result)
            {
            $digits = 4;
            $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $msg = $otp.' is your otp code for verify. Expires in 10 minites. Sunshine it';

            $to = '+88'.$info['mobile'];
            $token = "a4ef84bb5cc3c850b25d27a5baf4b497";
            $message = $msg;
            $url = "http://api.greenweb.com.bd/api2.php";
            
            $data = array(
                'to'      => "$to",
                'message' => "$message",
                'token'   =>"$token"
                  );
            //var_dump($data); exit();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING,'');
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);

            $udata = array(
                'otp'  => $otp,
                'upby' => $_SESSION['uid']
                  );
            //var_dump($udata); exit();

            $uwhere = array(
                'mobile' => $to,
                'uid'    => $_SESSION['uid']
                  );

            $result2 = $this->pm->update_data('users',$udata,$uwhere);

            if($result2)
                {
                $sdata = [
                  'exception' =>'<div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i>User Register Successfully!. Enter OTP code, for verify your account.</h4>
                    </div>'
                    ];

                $this->session->set_userdata($sdata);
                redirect('OTP');
                }
            else
                {
                $sdata = [
                  'exception' =>'<div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i>Somethings is Wrong !</h4>
                    </div>'
                    ];

                $this->session->set_userdata($sdata);
                redirect('signUp');
                }
            }
        else
            {
            $sdata = [
              'exception' =>'<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Failed !</h4>
                </div>'
                    ];

            $this->session->set_userdata($sdata);
            redirect('signUp');
            }
        }
}

public function otp_checked()
    {
    $data['title'] = 'Account Verify';
        
    $this->load->view('otp_checked',$data);
}

public function save_otp_check()
    {
    $info = $this->input->post();

    $where = array(
        'otp' => $info['otp'],
        'uid' => $_SESSION['uid']
            );

    $data = array(
        'status' => 'Active',
        'upby'   => $_SESSION['uid']
            );
        //var_dump($where); exit();
    $result = $this->pm->update_data('users',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Account Verify Successfully !</h4>
            </div>'
                ];  

        $this->session->set_userdata($sdata);
        redirect('Login');
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];

        $this->session->set_userdata($sdata);
        redirect('OTP');
        }
}

public function forget_password()
    {
    $data['title'] = 'Forget Password';
        
    $this->load->view('forget_password',$data);
}

public function check_forget_password_email()
  {
  $this->load->library('email');

  $empemail = $this->input->post('username');
  
  if(is_numeric($empemail))
    {
    $mid = '+88'.$this->input->post('username');
    $fpe = $this->pm->check_mobile_number($mid);
    // var_dump($fpe); var_dump($mid); exit();
    
    if($fpe)
        {
        $prdata = [
            'useruid' => $fpe->uid
                ];
        
        $this->session->set_userdata($prdata);
        
        $digits = 6;
        $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        $msg = $otp.' is your otp code for verify. Expires in 10 minites. Sunshine it';

        $to = $mid;
        $token = "4451583824966151583824966";
        $message = $msg;
        $url = "http://sms.iglweb.com/api/v1/balance?api_key=(API";
        
        $data = array(
            'to'      => "$to",
            'message' => "$message",
            'token'   =>"$token"
              );
            //var_dump($data); exit();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

        $udata = array(
            'otp'  => $otp,
            'upby' => $_SESSION['useruid']
              );
        //var_dump($udata); exit();

        $uwhere = array(
            'mobile' => $mid,
            'uid'    => $_SESSION['useruid']
              );

        $result = $this->pm->update_data('users',$udata,$uwhere);
            
        if($result)
            {
            $sdata = [
                'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Enter Your OTP code !</h4>
                </div>'
                    ];
    
            $this->session->set_userdata($sdata);
            redirect('otpPassword');
            }
        else
            {
            $sdata = [
                'exception' =>'<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Somethings is Wrong !</h4>
                </div>'
                    ];
        
            $this->session->set_userdata($sdata);
            redirect('forgetPassword');
            }
        }
      else
        {
        $sdata = [
            'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> This mobile is not exit !</h4>
            </div>'
                ];
    
        $this->session->set_userdata($sdata);
        redirect('forgetPassword');
        }
    }
    else
        {
      $fpe = $this->pm->check_email($empemail);
      
      $prdata = [
        'useruid' => $fpe->uid
            ];
    
        $this->session->set_userdata($prdata);
        //var_dump($fpe); exit();
      if($fpe)
        {
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.gmail.com',
          'smtp_port' => 465,
          'smtp_user' => 'sajadulshogib43@gmail.com', // change it to yours
          'smtp_pass' => 'sojib@1994', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
            );

        $to = $fpe->email;

        $message = "<p>
                      <h3>Hi !</h3>
                      <h4>Reset your Sunshine Account Password.</h4>
                      <p>We have received a request to reset your Sunshine account password associated with this email address. If you have not placed this request, you can safely ignore this email and we assure you that your account is completely secure.</p>
                      <p>If you do need to change your Sunshine Password, you can use the link given below.</p>
                      <b>New Password Setup : http://maxmarketingbd.com/app/passwordSetup .</b>
                      <p>Please contact <b style='color: green;'>support@sunshine.com.bd</b> for any queries regarding this.</p><br>
                      <h5>Cheers</h5>
                      <h6>Sunshine Team</h6>
                      <h6><b style='color: green;'>www.sunshine.com.bd</b></h6>
                      </p>";
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from('sajadulshogib43@gmail.com'); // change it to yours
        $this->email->to($to);// change it to yours
        $this->email->subject('Forget Password');
        $this->email->message($message);
        
        if($this->email->send())
            {
            $sdata = [
                'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Check Your email !</h4>
                </div>'
                        ];  
    
            $this->session->set_userdata($sdata);
            redirect('Login');
            }
        else
            {
            $sdata = [
                'exception' =>'<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Somethings is Wrong !</h4>
                </div>'
                    ];
    
            $this->session->set_userdata($sdata);
            redirect('forgetPassword');
            }
        }
      else
        {
        $sdata = [
            'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> This email id is not exit !</h4>
            </div>'
                ];
    
        $this->session->set_userdata($sdata);
        redirect('forgetPassword');
        }
    }
}

public function otp_password()
    {
    $data['title'] = 'Forget Password';
        
    $this->load->view('otp_password',$data);
}

public function check_otp()
    {
    $info = $this->input->post();

    $where = array(
        'otp' => $info['otp'],
        'uid' => $_SESSION['useruid']
            );
    
    $result = $this->pm->get_data('users',$where);
   // var_dump($result); exit();

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Password Setup !</h4>
            </div>'
                ];  

        $this->session->set_userdata($sdata);
        redirect('passwordSetup');
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];

        $this->session->set_userdata($sdata);
        redirect('forgetPassword');
        }
}

public function logout()
    {
    $this->session->sess_destroy();
    redirect('Login');
}

public function account_verify()
    {
    $where = [
        'email' => $_SESSION['useremail']
            ];

    $info = [
        'status' => 'Active',
        'upby'   => $_SESSION['uid']
            ];
       
    $result = $this->pm->update_data('users',$info,$where);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>User verify Successfully !</h4>
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
    redirect('Login');
}

public function password_setup()
    {
    $data['title'] = 'Password Setup';
        
    $this->load->view('pass_setup',$data);
}

public function save_passord_setup()
    {
    $info = $this->input->post();

    $npassword = $info['npassword'];
    $cpassword = $info['cpassword'];

    if($npassword == $cpassword)
        {
        $info = [
            'password' => $info['npassword'],
            'upby'     => $_SESSION['useruid']
                ];
        
        $where = array(
            'uid' => $_SESSION['useruid']
                );
        //var_dump($where); exit();
        $result = $this->pm->update_data('users',$info,$where);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>New Password Setup Successfully !</h4>
                </div>'
                    ];  

            $this->session->set_userdata($sdata);
            //$this->session->unset_userdata($prdata);
            redirect('Login');
            }
        else
            {
            $sdata = [
              'exception' =>'<div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Failed !</h4>
                </div>'
                    ];

            $this->session->set_userdata($sdata);
            redirect('passwordSetup');
            }
        }
    else
        {
        $sdata = [
            'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Password can not match !</h4>
            </div>'
                ];

        $this->session->set_userdata($sdata);
        redirect('passwordSetup');
        }
}



        ################################################
        #   /* Pages  end*/                            #
        ################################################
}
<?php
if(!defined('BASEPATH'))
  exit('No direct script access allowed');

class Balance extends  CI_Controller {

public function __construct()
  {
  parent::__construct();
  $this->load->model("prime_model","pm");
  $this->checkPermission();
}

public function index()
  {
  $data['title'] = 'Balance Adjustment';
  
  $other = array(
    'order_by' => 'baid'
        );
  $data['balance'] = $this->pm->get_data('badjusts',false,false,false,$other);
  
  $this->load->view('balance/balance_adjust',$data);
}

public function save_balance_adjustment()
  {
  $info = $this->input->post();
 
  $data = array(
    'aDate'       => date('Y-m-d',strtotime($info['aDate'])),
    'aType'       => $info['aType'],
    'aAmount'     => $info['aAmount'],
    'accountType' => $info['accountType'],
    'accountNo'   => $info['accountNo'],
    'notes'       => $info['notes'],
    'regby'       => $_SESSION['uid']
        );
  
  $result = $this->pm->insert_data('badjusts',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Balance Adjustment Successfully !</h4>
        </div>'
            ];
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Something is error !</h4>
        </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('Balance');
}

public function get_balance_adjustment_data()
  {
  $section = $this->pm->get_balance_adjustment_data($_POST['id']);
  $someJSON = json_encode($section);
  echo $someJSON;
}

public function update_balance_adjustment()
  {
  $info = $this->input->post();
 
  $data = array(
    'aDate'       => date('Y-m-d',strtotime($info['aDate'])),
    'aType'       => $info['aType'],
    'aAmount'     => $info['aAmount'],
    'accountType' => $info['accountType'],
    'accountNo'   => $info['accountNo'],
    'notes'       => $info['notes'],
    'regby'       => $_SESSION['uid']
        );
  $where = array(
    'baid' => $info['baid']
        );
  $result = $this->pm->update_data('badjusts',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Balance Adjument updated Successfully !</h4>
        </div>'
            ];
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Something is error !</h4>
        </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('Balance');
}

public function delete_balance_adjustment($id)
  {
  $where = array(
    'baid' => $id
        );
  $result = $this->pm->delete_data('badjusts',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Balance Adjument Delete Successfully !</h4>
        </div>'
            ];
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Something is error !</h4>
        </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('Balance');
}

public function approve_balance_adjustment($id)
  {
  $data = array(
    'status' => 1,
    'upby'   => $_SESSION['uid']
        );
  $where = array(
    'baid' => $id
        );
  $result = $this->pm->update_data('badjusts',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Balance Adjument approve Successfully !</h4>
        </div>'
            ];
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Something is error !</h4>
        </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('Balance');
}





 
}
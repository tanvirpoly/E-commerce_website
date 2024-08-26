<?php
if(!defined('BASEPATH'))
  exit('No direct script access allowed');

class Hradmin extends CI_Controller {

public function __construct()
  {
  parent::__construct();
  $this->load->model("prime_model","pm");
  $this->checkPermission();
}


public function office_time_setup()
  {
  $data['title'] = 'Office Time';

  $data['offtime'] = $this->pm->get_data('office_time',false);

  $this->load->view('hradmin/office_time',$data);
}

public function save_office_time()
  {
  $info = $this->input->post();

  $data = array(
    'ot_category' => $info['offType'],
    'off_start'   => $info['offstart'],
    'off_end'     => $info['offend'],
    'status'      => $info['status'],
    'regby'       => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('office_time',$data);

  if($info['status'] == 1)
    {
    $offdata = array(
      'status' => 2,
      'regby'  => $_SESSION['uid']
          );
    $this->pm->office_time_update($offdata,$result);
    }

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Office Time setup Successfully !</h4>
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
  redirect('offTime');
}

public function get_office_time_data()
  {
  $grup = $this->pm->get_office_time_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_office_time()
  {
  $info = $this->input->post();

  $where = array(
    'ot_id' => $info['ltid']
        );

  $data = array(
    'ot_category' => $info['offType'],
    'off_start'   => $info['offstart'],
    'off_end'     => $info['offend'],
    'status'      => $info['status'],
    'upby'        => $_SESSION['uid']
        );
    
  $result2 = $this->pm->update_data('office_time',$data,$where);

  if($info['status'] == 1)
    {
    $result = $info['ltid'];

    $offdata = array(
      'status' => 2,
      'upby'   => $_SESSION['uid']
          );
    $this->pm->office_time_update($offdata,$result);
    }

  if($result2)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Office Time setup update Successfully !</h4>
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
  redirect('offTime');
}

public function delete_office_time($id)
  {
  $where = array(
    'ot_id' => $id
        );
    
  $result = $this->pm->delete_data('office_time',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Office Time setup delete Successfully !</h4>
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
  redirect('offTime');
}

public function employee_attendance()
  {
  $data['title'] = 'Attendance';

  $other = array(
    'join' => 'left',
    'order_by' => 'autoid'
        );
  $field = array(
    'emp_dev_attendance' => 'emp_dev_attendance.*',
    'employees' => 'employees.emp_id,employees.employeeName',
    'department' => 'department.dept_name'
        );
  $join = array(
    'employees' => 'employees.employeeID = emp_dev_attendance.accid',
    'department' => 'department.dpt_id = employees.dpt_id'
        );
  $data['attendance'] = $this->pm->get_data('emp_dev_attendance',false,$field,$join,$other);

  $owhere = array(
    'status' => 1
        );

  $offtime = $this->pm->get_data('office_time',$owhere);
  $data['offtime'] = $offtime[0];

  $data['employee'] = $this->pm->get_data('employees',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/attendance',$data);
}

public function save_emp_attendance()
  {
  $info = $this->input->post();

  $emp = $this->db->select('employeeName')->from('employees')->where('employeeID',$info['employee'])->get()->row();

  $empin = strtotime($info['atime_in']);

  $offt = $this->db->select('off_start,off_end')->from('office_time')->where('status',1)->get()->row();

  $otime = strtotime($offt->off_start);

  if($empin >= $otime)
    {
    $late = round(($empin-$otime)/60);
    }
  else
    {
    $late = 0;
    }

  $data = array(
    'accid'     => $info['employee'],
    'device_id' => 1,
    'ename'     => $emp->employeeName,
    'adate'     => date('Y-m-d'),
    'year'      => date('Y'),
    'month'     => date('m'),
    'ain'       => $info['atime_in'],
    'late'      => $late,
    'aout'      => '00:00:00',
    'early'     => '0',
    'off_start' => $offt->off_start,
    'off_end'   => $offt->off_end,
    'regby'     => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('emp_dev_attendance',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Employee Attendance add Successfully !</h4>
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
  redirect('empAttend');
}

public function update_emp_attendance($id)
  {
  $info = $this->input->post();

  $empin = strtotime($info['atime_out']);

  $offt = $this->db->select('off_start,off_end')->from('office_time')->where('status',1)->get()->row();

  $otime = strtotime($offt->off_end);

  if($empin >= $otime)
    {
    $late = round(($empin-$otime)/60);
    }
  else if($empin <= $otime)
    {
    $late = round(($otime-$empin)/60);
    }
  else
    {
    $late = 0;
    }

  $data = array(
    'aout'  => $info['atime_out'],
    'early' => $late,
    'upby'  => $_SESSION['uid']
        );
    //var_dump($data); exit();
  $where = array(
    'autoid' => $id
        );
    
  $result = $this->pm->update_data('emp_dev_attendance',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Employee Attendance update Successfully !</h4>
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
  redirect('empAttend');
}

public function leave_days_setup()
  {
  $data['title'] = 'Leave Days';
    
  $data['leaveType'] = $this->pm->get_data('leave_type',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/leave_setup',$data);
}

public function save_leave_type()
  {
  $info = $this->input->post();

  $data = array(
    'leaveType' => $info['LeaveType'],
    'leaveDays' => $info['leaveDays'],
    'regby'     => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('leave_type',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Type Setup Successfully !</h4>
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
  redirect('leaveDays');
}

public function get_leave_type_data()
  {
  $grup = $this->pm->get_leave_type_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_leave_type()
  {
  $info = $this->input->post();

  $data = array(
    'leaveType' => $info['LeaveType'],
    'leaveDays' => $info['leaveDays'],
    'upby'      => $_SESSION['uid']
        );

  $where = array(
    'lt_id' => $info['ltid']
        );
    
  $result = $this->pm->update_data('leave_type',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Type Setup update Successfully !</h4>
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
  redirect('leaveDays');
}

public function delete_leave_type($id)
  {
  $where = array(
    'lt_id' => $id
        );
    
  $result = $this->pm->delete_data('leave_type',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Type Setup delete Successfully !</h4>
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
  redirect('leaveDays');
}

public function festival_bonus_setup()
  {
  $data['title'] = 'Festival Bonus';
    
  $data['leaveType'] = $this->pm->get_data('festival_bonus',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/festival_bonus',$data);
}

public function save_festival_bonus()
  {
  $info = $this->input->post();

  $data = array(
    'festivalName' => $info['LeaveType'],
    'bAmount'      => $info['leaveDays'],
    'regby'        => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('festival_bonus',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Festival Bonus Setup Successfully !</h4>
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
  redirect('fBonus');
}

public function get_festival_bonus_data()
  {
  $grup = $this->pm->get_festival_bonus_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_festival_bonus()
  {
  $info = $this->input->post();

  $data = array(
    'festivalName' => $info['LeaveType'],
    'bAmount'      => $info['leaveDays'],
    'upby'         => $_SESSION['uid']
        );

  $where = array(
    'fb_id' => $info['fbid']
        );
    
  $result = $this->pm->update_data('festival_bonus',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Festival Bonus Setup update Successfully !</h4>
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
  redirect('fBonus');
}

public function delete_festival_bonus($id)
  {
  $where = array(
    'fb_id' => $id
        );
    
  $result = $this->pm->delete_data('festival_bonus',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Festival Bonus Setup delete Successfully !</h4>
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
  redirect('fBonus');
}

public function salary_structure_setup()
  {
  $data['title'] = 'Salary Structure';

  $where = [
    'ssid' => 1
        ];
    
  $leave = $this->pm->get_data('salary_structure',$where);
  if($leave){
  $data['sstructure'] = $leave[0];}
  else{
      $data['sstructure']= $this->pm->get_data('salary_structure',$where);
  }
    //var_dump($data); exit();
  $this->load->view('hradmin/salary_structure',$data);
}

public function save_salary_structure()
  {
  $info = $this->input->post();
  
  $total = $info['basic']+$info['hrent']+$info['medical']+$info['transport']+$info['childAl'];
  
  if($total == 100)
    {
    $data = array(
      'basic'     => $info['basic'],
      'hrent'     => $info['hrent'],
      'medical'   => $info['medical'],
      'transport' => $info['transport'],
      'childAl'   => $info['childAl'],
    //   'cl'        => $info['cl'],
    //   'el'        => $info['el'],
    //   'ml'        => $info['ml'],
      'upby'      => $_SESSION['uid']
            );

    $where = array(
      'ssid' => 1
        );
    $leave = $this->pm->get_data('salary_structure',$where);
    if($leave){
    $result = $this->pm->update_data('salary_structure',$data,$where);
    }
    else 
    {
        $result = $this->pm->insert_data('salary_structure',$data);
    }

    if($result)
      {
      $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Salary Structure Setup Successfully !</h4>
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
    }
  else
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-ban"></i> Salary Structure can not match 100% !</h4>
      </div>'
            ];
    }
  $this->session->set_userdata($sdata);
  redirect('sStructure');
}







public function user_leave_application()
  {
  $data['title'] = 'Leave Application';

  $where = [
    'leave_apply.regby' => $_SESSION['uid']
        ];
  $field = array(
    'leave_apply' => 'leave_apply.*',
    'leave_type' => 'leave_type.leaveType'
        );
  $join = array(
    'leave_type' => 'leave_type.ltid = leave_apply.ltid'
        );
  $other = array(
    'order_by' => 'laid',
    'join' => 'left'
        );
    
  $data['leave'] = $this->pm->get_data('leave_apply',$where,$field,$join,$other);
  $data['leaveType'] = $this->pm->get_data('leave_type',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/leave_form',$data);
}

public function get_leave_days_total()
  {
  $grup = $this->pm->get_leave_days_total($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function save_leave_application()
  {
  $info = $this->input->post();

  $data = array(
    'ltid'         => $info['ltype'],
    'leave_left'   => $info['leaveleft'],
    'fdate'        => date('Y-m-d', strtotime($info['from_days'])),
    'tdate'        => date('Y-m-d', strtotime($info['to_days'])),
    'apply_day'    => $info['apply_days'],
    'lsubject'     => $info['subject'],
    'lapplication' => $info['application'],
    'regby'        => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('leave_apply',$data);

  $where = [
    'ltid' => $info['ltype'],
    'empid' => $_SESSION['uid']
      ];

  $llimit = $this->pm->get_data('leave_limit',$where);

  if($llimit)
    {
    $ldata = array(
      'leave_left' => $llimit[0]['leave_left'],
      'upby'       => $_SESSION['uid']
          );

    $result2 = $this->pm->update_data('leave_limit',$ldata,$where);
    }
  else
    {
    $ldata = array(
      'empid'       => $_SESSION['uid'],
      'ltid'        => $info['ltype'],
      'leave_left'  => $info['leaveleft'],
      'leave_limit' => $info['leaveleft'],
      'regby'       => $_SESSION['uid']
          );

    $result2 = $this->pm->insert_data('leave_limit',$ldata);
    }

  if($result && $result2)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Application add Successfully !</h4>
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
  redirect('lApply');
}

public function get_user_lapply_data()
  {
  $grup = $this->pm->get_user_lapply_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function leave_application_list()
  {
  $data['title'] = 'Leave Application';

  $field = array(
    'leave_apply' => 'leave_apply.*',
    'leave_type' => 'leave_type.leaveType',
    'users' => 'users.name'
        );
  $join = array(
    'leave_type' => 'leave_type.ltid = leave_apply.ltid',
    'users' => 'users.uid = leave_apply.regby'
        );
  $other = array(
    'order_by' => 'laid',
    'join' => 'left'
        );
    
  $data['leave'] = $this->pm->get_data('leave_apply',false,$field,$join,$other);
  $data['leaveType'] = $this->pm->get_data('leave_type',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/leave_approve',$data);
}

public function approve_leave_application()
  {
  $info = $this->input->post();

  $where = [
    'laid' => $info['la_id']
          ];
  $data = array(
    'afdate'      => date('Y-m-d', strtotime($info['sdate'])),
    'atdate'      => date('Y-m-d', strtotime($info['edate'])),
    'approve_day' => $info['adays'],
    'leave_left'  => $info['lleft']-$info['adays'],
    'note'        => $info['note'],
    'status'      => 'Approve',
    'regby'       => $_SESSION['uid']
        );
    
  $result = $this->pm->update_data('leave_apply',$data,$where);

  $lwhere = [
    'ltid' => $info['lt_id'],
    'empid' => $info['empid']
          ];

  $llimit = $this->pm->get_data('leave_limit',$lwhere);

  if($llimit)
    {
    $ldata = array(
      'leave_left' => $llimit[0]['leave_left']-$info['adays'],
      'upby'       => $_SESSION['uid']
          );

    $result2 = $this->pm->update_data('leave_limit',$ldata,$lwhere);
    }
  else
    {
    $ldata = array(
      'empid'       => $info['empid'],
      'ltid'        => $info['lt_id'],
      'leave_left'  => $info['lleft']-$info['adays'],
      'regby'       => $_SESSION['uid']
          );

    $result2 = $this->pm->insert_data('leave_limit',$ldata);
    }

  if($result && $result2)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Application Approve Successfully !</h4>
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
  redirect('lApplylist');
}

public function cancel_leave_application()
  {
  $info = $this->input->post();

  $where = [
    'laid' => $info['la_id']
        ];

  $data = array(
    'note' => $info['notes'],
    'status' => 'Cancel',
    'upby' => $_SESSION['uid']
        );
    
  $result = $this->pm->update_data('leave_apply',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Application Cancel Successfully !</h4>
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
  redirect('lApplylist');
}

public function performance_bonus_setup()
  {
  $data['title'] = 'Performance Bonus';

  $where = array(
    'status' => 'Active'
        );
  $join = array(
    'employees' => 'employees.empid = prf_bonus.empid'
        );
  $other = array(
    'order_by'=>'pfid',
    'join' => 'left'
        );
  $field = array(
    'prf_bonus' => 'prf_bonus.*',
    'employees' => 'employees.empCode,employees.empName'
        ); 
    
  $data['leaveType'] = $this->pm->get_data('prf_bonus',false,$field,$join,$other);
  $data['employee'] = $this->pm->get_data('employees',$where);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/prf_bonus',$data);
}

public function save_performance_bonus()
  {
  $info = $this->input->post();

  $data = array(
    'month' => $info['month'],
    'year'  => $info['year'],
    'empid' => $info['employee'],
    'bonus' => $info['bonus'],
    'note'  => $info['note'],
    'regby' => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('prf_bonus',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Performance Bonus Setup Successfully !</h4>
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
  redirect('pBonus');
}

public function get_performance_bonus_data()
  {
  $grup = $this->pm->get_performance_bonus_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_performance_bonus()
  {
  $info = $this->input->post();

  $data = array(
    'month' => $info['month'],
    'year'  => $info['year'],
    'empid' => $info['employee'],
    'bonus' => $info['bonus'],
    'note'  => $info['note'],
    'upby'  => $_SESSION['uid']
        );

  $where = array(
    'pfid' => $info['ltid']
        );
    
  $result = $this->pm->update_data('prf_bonus',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Performance Bonus Setup update Successfully !</h4>
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
  redirect('pBonus');
}

public function delete_performance_bonus($id)
  {
  $where = array(
    'pfid' => $id
        );
    
  $result = $this->pm->delete_data('prf_bonus',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Performance Bonus Setup delete Successfully !</h4>
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
  redirect('pBonus');
}

public function working_day_setup()
  {
  $data['title'] = 'Working Days';

  $data['leaveType'] = $this->pm->get_data('working_day',false);
    //var_dump($data['users']); exit();
  $this->load->view('hradmin/working_day',$data);
}

public function save_working_day()
  {
  $info = $this->input->post();

  $data = array(
    'year'    => $info['year'],
    'month'   => $info['month'],
    'workday' => $info['workday'],
    'note'    => $info['notes'],
    'regby'   => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('working_day',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Working Day Setup Successfully !</h4>
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
  redirect('workDays');
}

public function get_working_day_data()
  {
  $grup = $this->pm->get_working_day_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_working_day()
  {
  $info = $this->input->post();

  $data = array(
    'year'    => $info['year'],
    'month'   => $info['month'],
    'workday' => $info['workday'],
    'note'    => $info['notes'],
    'upby'    => $_SESSION['uid']
        );

  $where = array(
    'wdid' => $info['ltid']
        );
    
  $result = $this->pm->update_data('working_day',$data,$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Working Day Setup update Successfully !</h4>
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
  redirect('workDays');
}

public function delete_working_day($id)
  {
  $where = array(
    'wdid' => $id
        );
    
  $result = $this->pm->delete_data('working_day',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Working Day Setup delete Successfully !</h4>
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
  redirect('workDays');
}

public function leave_payment_list()
  {
  $data['title'] = 'Leave Payment';

  $data['employee'] = $this->pm->get_data('employees',false);

  $other = array(
    'order_by' => 'lp_id',
    'join' => 'left'
        );
  $field = array(
    'leave_payment' => 'leave_payment.*',
    'employees' => 'employees.empId,employees.empName'
        );
  $join = array(
    'employees' => 'employees.employeeID = leave_payment.employee'
        );
  $data['lpayment'] = $this->pm->get_data('leave_payment',false,$field,$join,$other);

  $this->load->view('hradmin/leave_payment',$data);
}

public function get_emp_leave_payment()
  {
  $grup = $this->pm->get_emp_leave_payment($_POST['id'],$_POST['id2'],$_POST['id3']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function save_leave_payment()
  {
  $info = $this->input->post();

  $data = array(
    'month'    => $info['month'],
    'year'     => $info['year'],
    'employee' => $info['employee'],
    'tldays'   => $info['tldays'],
    'tpldays'  => $info['tpldays'],
    'plAmount' => $info['plAmount'],
    'pAmount'  => $info['pAmount'],
    'note'     => $info['note'],
    'regby'    => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('leave_payment',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Payment add Successfully !</h4>
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
  redirect('lPayment');
}

public function delete_leave_payment($id)
  {
  $where = array(
    'lp_id' => $id
        );

  $result = $this->pm->delete_data('leave_payment',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Leave Payment delete Successfully !</h4>
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
  redirect('lPayment');
}

public function overtime_payment_list()
  {
  $data['title'] = 'OverTime Payment';

  $data['employee'] = $this->pm->get_data('employees',false);

  $other = array(
    'order_by' => 'otp_id',
    'join' => 'left'
        );
  $field = array(
    'overtime_payment' => 'overtime_payment.*',
    'employees' => 'employees.empId,employees.empName'
        );
  $join = array(
    'employees' => 'employees.employeeID = overtime_payment.employee'
        );
  $data['lpayment'] = $this->pm->get_data('overtime_payment',false,$field,$join,$other);

  $this->load->view('hradmin/overtime_payment',$data);
}

public function save_overtime_payment()
  {
  $info = $this->input->post();

  $data = array(
    'month'    => $info['month'],
    'year'     => $info['year'],
    'employee' => $info['employee'],
    'pAmount'  => $info['pAmount'],
    'note'     => $info['note'],
    'regby'    => $_SESSION['uid']
        );
    
  $result = $this->pm->insert_data('overtime_payment',$data);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-success alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Overtime Payment add Successfully !</h4>
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
  redirect('otPayment');
}

public function delete_overtime_payment($id)
  {
  $where = array(
    'otp_id' => $id
        );

  $result = $this->pm->delete_data('overtime_payment',$where);

  if($result)
    {
    $sdata = [
      'exception' =>'<div class="alert alert-danger alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Overtime Payment delete Successfully !</h4>
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
  redirect('otPayment');
}





}
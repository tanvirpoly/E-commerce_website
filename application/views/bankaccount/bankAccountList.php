<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bank Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Bank Account</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <section class="content">
      <div class="container-fluid">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bank Account</h3>
              <?php if($_SESSION['newbaccount'] == 1){ ?>
              <button type="button" class="btn btn-primary add_bank" data-toggle="modal" data-target=".bs-example-modal-abank" style="float: right" ><i class="fa fa-plus"></i> New Bank Account</button>
              <?php } ?>
            </div>

            <div class="card-body">
              <table class="table table-responsive table-bordered">
                <thead>
                  <tr>
                    <th style="width: 5%;">#SN.</th>
                    <th style="width: 13%;">Account Name</th>
                    <th style="width: 12%;">Account No</th>
                    <th style="width: 13%;">Bank Name</th>
                    <th style="width: 13%;">Branch Name</th>
                    <th style="width: 12%;">Opening Balance</th>
                    <!--<th style="width: 13%;">Current Balance</th>-->
                    <th style="width: 10%;">Status</th>
                    <th style="width: 9%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  $tba = 0;
                  foreach ($bank as $value) {
                  $id = $value['ba_id'];
                  //var_dump($id);
                  $sa = $this->db->select('SUM(paidAmount) as total')
                              ->from('sales')
                              ->where('accountType','Bank')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($sa); exit();
                  if($sa == null){
                    $saa = 0;
                    }
                  else{
                    $saa = $sa->total;
                    }

                  $pa = $this->db->select("SUM(paidAmount) as total")
                              ->from('purchase')
                              ->where('accountType','Bank')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); exit();
                  if($pa == null){
                    $paa = 0;
                    }
                  else{
                    $paa = $pa->total;
                    }

                  $va = $this->db->select("SUM(totalamount) as total")
                              ->from('vaucher')
                              ->where('accountType','Bank')
                              ->where('vauchertype','Credit Voucher')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); //exit();
                  if($va == null){
                    $vaa = 0;
                    }
                  else{
                    $vaa = $va->total;
                    }

                  $va2 = $this->db->select("SUM(totalamount) as total")
                              ->from('vaucher')
                              ->where('accountType','Bank')
                              ->where_not_in('vauchertype','Credit Voucher')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); //exit();
                  if($va2 == null){
                    $vaa2 = 0;
                    }
                  else{
                    $vaa2 = $va2->total;
                    }
                  $tva = $vaa-$vaa2;

                  $temp = $this->db->select("SUM(salary) as total")
                              ->from('employee_payment')
                              ->where('accountType','Bank')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); //exit();
                  if($temp == null){
                    $tempa = 0;
                    }
                  else{
                    $tempa = $temp->total;
                    }

                  $tr = $this->db->select("SUM(totalPrice) as total,SUM(scAmount) as sctotal")
                              ->from('returns')
                              ->where('accountType','Bank')
                              ->where('accountNo',$id)
                              ->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); //exit();
                  if($tr == null){
                    $tra = 0;
                    }
                  else{
                    $tra = $tr->total-$tr->sctotal;
                    }
                    
                  $ptr = $this->db->select("SUM(totalPrice) as total")
                              ->from('preturns')
                              ->where('accountType','Bank')
                              ->where('accountNo',$id)
                              //->where('compid',$_SESSION['compid'])
                              ->get()
                              ->row();
                  //var_dump($pa); //exit();
                  if($ptr == null){
                    $tptr = 0;
                    }
                  else{
                    $tptr = $ptr->total;
                    }

                  $i++;
                  ?>
                  <tr class="gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['accountName']; ?></td>
                    <td><?php echo $value['accountNo']; ?></td>
                    <td><?php echo $value['bankName']; ?></td>
                    <td><?php echo $value['branchName']; ?></td>
                    <td><?php echo number_format(($value['balance']), 2); ?></td>
                    <!--<td><?php echo number_format(((($value['balance'])+$saa+$tva+$tptr)-($paa+$tempa+$tra)), 2); $tba += ((($value['balance'])+$saa+$tva+$tptr)-($paa+$tempa+$tra)); ?></td>-->
                    <td><?php echo $value['status']; ?></td>
                    <td>
                      <?php if($_SESSION['editbaccount'] == 1){ ?>
                      <button type="button" class="btn btn-success btn-xs bank_edit" data-toggle="modal" data-target=".bs-example-modal-ebank" data-id="<?php echo $value['ba_id']; ?>" ><i class="fa fa-edit"></i></button>
                      <?php } if($_SESSION['deletebaccount'] == 1){ ?>
                      <a href="<?php echo site_url('BankAccount/bank_account_delete').'/'.$value['ba_id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this Bank Account ?');" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                      <?php } ?>
                    </td>
                  </tr>   
                  <?php } ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="modal fade bs-example-modal-abank" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" >Bank Account Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <form action="<?php echo base_url('BankAccount/save_bank_account');?>" method="post">
                <div class="col-md-12 col-sm-12 col-12">
                  <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-12">
                      <label>Account Name *</label>
                      <input type="text" class="form-control" name="accountName" placeholder="Account Name" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-12">
                      <label>Account No *</label>
                      <input type="text" class="form-control" name="accountNo" placeholder="Account No" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-12">
                      <label>Bank Name *</label>
                      <input type="text" class="form-control" name="bankName" placeholder="Bank Name" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-12">
                      <label>Branch Name</label>
                      <input type="text" class="form-control" name="branchName" placeholder="Branch Name" >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-12">
                      <label>Opening Balance</label>
                      <input type="text" class="form-control" name="balance" placeholder="Opening Balance" >
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade bs-example-modal-ebank" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" >Bank Transaction Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <form action="<?php echo base_url('BankAccount/update_bank_account');?>" method="post">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label>Account Name *</label>
                      <input type="text" class="form-control" name="accountName" id="accountName" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label>Account No *</label>
                      <input type="text" class="form-control" name="accountNo" id="accountNo" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label>Bank Name *</label>
                      <input type="text" class="form-control" name="bankName" id="bankName" required >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label>Branch Name</label>
                      <input type="text" class="form-control" name="branchName" id="branchName" >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                      <label>Account Balance</label>
                      <input type="text" class="form-control" name="balance" id="balance" >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                      <label>Status</label>
                      <select class="form-control" name="status" id="status" >
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" id="bankAccountId" name="bankAccountId" >
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".bank_edit").click(function () {
          var catid = $(this).data('id');
            //alert(l_id);
          $('input[name="bankAccountId"]').val(catid);
        });

        $('.bank_edit').click(function() {
          var id = $(this).data('id');
            //alert(id);
          var url = '<?php echo base_url() ?>BankAccount/get_bank_account';
            //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
                //alert(data);
              var HTML = data["accountNo"];
              var HTML2 = data["accountName"];
              var HTML3 = data["bankName"];
              var HTML6 = data["branchName"];
              var HTML4 = data["balance"];
              var HTML5 = data["status"];
            //alert(HTML);
              $("#accountNo").val(HTML);
              $("#accountName").val(HTML2);
              $("#bankName").val(HTML3);
              $("#branchName").val(HTML6);
              $("#balance").val(HTML4);
              $("#status").val(HTML5);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>
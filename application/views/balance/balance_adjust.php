<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Balance Adjustment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Balance Adjustment</li>
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
              <h3 class="card-title">Balance Adjustment List</h3>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-newBank" style="float: right;" ><i class="fa fa-plus"></i> New Adjustment</button>
            </div>

            <div class="card-body">
              <div class="col-sm-12 col-md-12 col-12">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>Date</th>
                      <th>Type</th>
                      <th>Account</th>
                      <th>Amount</th>
                      <th>Note</th>
                      <th>Status</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach($balance as $value){
                    $i++;
                    ?>
                    <tr class="gradeX">
                      <td><?php echo $i; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['aDate'])) ?></td>
                      <td>
                        <?php if($value['aType'] == 1){ ?>
                        <?php echo 'Deposit'; ?>
                        <?php } else if($value['aType'] == 2){ ?>
                        <?php echo 'Withdraw'; ?>
                        <?php } ?>
                      </td>
                      <td><?php echo $value['accountType']; ?></td>
                      <td><?php echo number_format($value['aAmount'], 2); ?></td>
                      <td><?php echo $value['notes']; ?></td>
                      <td>
                        <?php if($value['status'] == 1){ ?>
                        <?php echo 'Approve'; ?>
                        <?php } else { ?>
                        <?php echo 'Not-Approve'; ?>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($value['status'] == 0){ ?>
                        <a class="btn btn-info btn-xs" href="<?php echo site_url('Balance/approve_balance_adjustment').'/'.$value['baid'] ?>" onclick="return confirm('Are you sure you want to Approve this Balance Adjustment ?');" ><i class="fa fa-check"></i></a>
                        <button type="button" class="btn btn-success btn-xs editBank" data-toggle="modal" data-target=".bs-example-modal-editBank" data-id="<?php echo $value['baid']; ?>" ><i class="fa fa-edit"></i></button>
                        <a class="btn btn-danger btn-xs" href="<?php echo site_url('Balance/delete_balance_adjustment').'/'.$value['baid'] ?>" onclick="return confirm('Are you sure you want to delete this Balance Adjustment ?');" ><i class="fa fa-trash"></i></a>
                        <?php } ?>
                      </td>
                    </tr>   
                    <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <div class="modal fade bs-example-modal-newBank" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >Balance Adjustment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="<?php echo base_url() ?>Balance/save_balance_adjustment" method="post" >
            <div class="col-sm-12 col-md-12 col-12" >
              <div class="form-group ">
                <label>Adjustment Date *</label>
                <input type="text" class="form-control datepicker" name="aDate" value="<?php echo date('m/d/Y') ?>" required >
              </div>
              <div class="form-group ">
                <label>Select Adjustment Type *</label>
                <select class="form-control" name="aType" required >
                  <option value="">Select One</option>
                  <option value="1">Deposit</option>
                  <option value="2">Withdraw</option>
                </select>
              </div>
              <div class="form-group">
                <label>Adjustment Amount *</label>
                <input type="text" class="form-control" name="aAmount" placeholder="Amount" required >
              </div>
              <div class="form-group ">
                <label>Select Account Type *</label>
                <select class="form-control accountType" name="accountType" required >
                  <option value="">Select One</option>
                  <option value="Cash">Cash</option>
                  <option value="Bank">Bank</option>
                  <option value="Mobile">Mobile</option>
                </select>
              </div>
              <div class="form-group ">
                <label>Select Account Number *</label>
                <select class="form-control accountNo" name="accountNo" required >
                  <option value="">Select Account No.</option>
                </select>
              </div>
              <div class="form-group">
                <label>Notes</label>
                <input type="text" class="form-control" name="notes" placeholder="If Have any Notes" >
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="modal fade bs-example-modal-editBank" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >Balance Adjustment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="<?php echo base_url() ?>Balance/update_balance_adjustment" method="post" >
            <div class="col-sm-12 col-md-12 col-12" >
              <div class="form-group ">
                <label>Adjustment Date *</label>
                <input type="text" class="form-control datepicker" name="aDate" value="<?php echo date('m/d/Y') ?>" required >
              </div>
              <div class="form-group ">
                <label>Select Adjustment Type *</label>
                <select class="form-control" name="aType" id="aType" required >
                  <option value="">Select One</option>
                  <option value="1">Deposit</option>
                  <option value="2">Withdraw</option>
                </select>
              </div>
              <div class="form-group">
                <label>Adjustment Amount *</label>
                <input type="text" class="form-control" name="aAmount" id="aAmount" placeholder="Amount" required >
              </div>
              <div class="form-group ">
                <label>Select Account Type *</label>
                <select class="form-control accountType" name="accountType" required >
                  <option value="">Select One</option>
                  <option value="Cash">Cash</option>
                  <option value="Bank">Bank</option>
                  <option value="Mobile">Mobile</option>
                </select>
              </div>
              <div class="form-group ">
                <label>Select Account Number *</label>
                <select class="form-control accountNo" name="accountNo" required >
                  <option value="">Select Account No.</option>
                </select>
              </div>
              <div class="form-group">
                <label>Notes</label>
                <input type="text" class="form-control" name="notes" id="notes" placeholder="If Have any Notes" >
              </div>
            </div>
            <input type="hidden" name="baid" id="baid" required >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".editBank").click(function(){
          var baid = $(this).data('id');
            //alert(baid);
          $('input[name="baid"]').val(baid);
          });

        $('.editBank').click(function(){
          var id = $(this).data('id');
          //alert(id);
          var url = '<?php echo base_url() ?>Balance/get_balance_adjustment_data';
            //alert(url);
          $.ajax({
            method: 'POST',
            url     : url,
            dataType: 'json',
            data    : {'id' : id},
            success:function(data){ 
              //alert(data);
              var HTML = data["aType"];
              var HTML2 = data["aAmount"];
              var HTML3 = data["notes"];
              //alert(HTML);
              $("#aType").val(HTML);
              $("#aAmount").val(HTML2);
              $("#notes").val(HTML3);
              },
            error:function(){
              alert('error');
              }
            });
          });
        });
    </script>

    <script type="text/javascript">
      $('.accountType').on('change',function(){
        var value = $(this).val();
        //alert(value);
        $('.accountNo').empty();
        getAccountNo(value,'.accountNo');
        });

      function getAccountNo(value,place)
        {
        $(place).empty();
        if(value != ''){
          $.ajax({
            url: '<?php echo site_url()?>Voucher/getAccountNo',
            async: false,
            dataType: "json",
            data: 'id=' + value,
            type: "POST",
            success: function (data){
              $(place).append(data);
              $(place).trigger("chosen:updated");
              }
            });
          }
        else
          {
          customAlert('Select Account Type',"error",true);
          }
        }
    </script>

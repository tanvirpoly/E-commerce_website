<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Sales</li>
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
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sales List</h3>
                <?php if($_SESSION['newsale'] == 1){ ?>
                <a href="<?php echo site_url('newSale') ?>" class="btn btn-primary" style="float: right; margin-right: 10px;" ><i class="fa fa-plus"></i> New Sale</a>
                <!--<a href="<?php echo site_url('newDSale') ?>" class="btn btn-danger" style="float: right; margin-right: 10px;" ><i class="fa fa-plus"></i> Damage Sale</a>-->
                <!--<a href="<?php echo site_url('Sale/sales_export_action') ?>" class="btn btn-success" style="float: right; margin-right: 10px;" ><i class="fa fa-list"></i> Export Sales</a>-->
                <?php } ?>
              </div>

              <div class="card-body table-responsive">
                <table id="example" class="table table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>Inv. No.</th>
                      <th>Date</th>
                      <th>Customer</th>
                      <th>Total</th>            
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Status</th>
                      <th style="width: 9%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($sales as $value){
                    $i++;
                    // $query = $this->db->select('returns.totalPrice as returnTotal')
                    //           ->from('returns')
                    //           ->where($value['invoice_no'], 'returns.invoice')
                    //           ->get()
                    //           ->row();
                    $query = $this->db->select('returns.totalPrice as returnTotal')
                              ->from('returns')
                              ->where('invoice', $value['invoice_no']) // Assuming 'invoice' is the correct column name
                              ->get()
                              ->row();

                        $totalAmount = $value['totalAmount'];
                        
                        if ($query) {
                            $returnTotal = $query->returnTotal;
                            $totalAmount -= $returnTotal;
                        }

                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><a href="<?php echo site_url('viewSale').'/'.$value['saleID']; ?>"><?php echo $value['invoice_no']; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['regdate'])); ?></td>
                      <td><?php echo $value['customerName']; ?><br><?php echo $value['mobile']; ?></td>
                      <!--<td><?php echo $value['mobile']; ?></td>-->
                      <td><?php echo number_format($totalAmount, 2); ?></td>
                      <td><?php echo number_format($value['paidAmount'], 2); ?></td>
                      <td><?php echo number_format($value['dueamount'], 2); ?></td>
                      <td>
                        <?php if($value['dueamount'] == 0){ ?>
                        <?php echo "<span style='color:green;'>Full Paid</span>"; ?>
                        <?php } else if ($value['totalAmount'] == $value['dueamount']){
                            echo "<span style='color:red;'>Due</span>";
                        }
                        else { ?>
                        <?php echo "<span style='color:blue;'>Partial Paid</span>"; ?>
                        <?php } ?>
                      </td>
                      <td>
                        <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="<?php echo site_url('viewSale').'/'.$value['saleID']; ?>"><i class="fa fa-eye"></i> View</a></li>
                              <?php if($value['ptype'] == 1){ ?>
                              <?php if($_SESSION['editsale'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('editSale').'/'.$value['saleID']; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <?php } if($_SESSION['deletesale'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Sale/delete_sales').'/'.$value['saleID']; ?>"><i class="fa fa-trash"></i> Delete</a></li>
                              <?php } } else{ ?>
                              <?php if($_SESSION['editsale'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('editDSale').'/'.$value['saleID']; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <?php } if($_SESSION['deletesale'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Sale/delete_dproduct_sales').'/'.$value['saleID']; ?>"><i class="fa fa-trash"></i> Delete</a></li>
                              <?php } } ?>
                              <?php if($value['dueamount'] > 0 && $value['sType'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item">
                                <a href="#" class="payment" data-toggle="modal" data-target=".bs-example-modal-payment" data-id="<?php echo $value['saleID']; ?>" id="<?php echo $value['saleID']; ?>" onclick="document.getElementById('payment').style.display='block'" ><i class="fa fa-plus"></i> Payment</a>
                              </li>
                              <?php } ?> 
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Sale/delivery_chalan').'/'.$value['saleID']; ?>"><i class="fa-solid fa-truck"></i> Chalan</a></li>
                              
                            </ul>
                          </div>
                        </div>
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

    <div id="payment" class="modal fade bs-example-modal-payment" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" > Payment Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <form action="<?php echo base_url('Sale/save_sales_payment');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Due Amount</label>
                <input type="text" class="form-control" name="damount" id="damount" readonly >
              </div>
              <input type="hidden" class="form-control" name="pamount" id="pamount" >
              <div class="form-group">
                <label>Paid Amount *</label>
                <input type="text" class="form-control" name="amount" id="payamount" placeholder="Amount" required >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-12">
                  <label>Account Type *</label>
                  <select class="form-control" name="accountType" id="accountType" required >
                    <option value="Cash">Cash</option>
                    <option value="Bank">Bank</option>
                    <option value="Mobile">Mobile</option>
                  </select>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-12">
                  <label>Account No *</label>
                  <select class="form-control" name="accountNo" id="accountNo" >
                    <option value="">Select Account Type First</option>
                  </select>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-12">
                          <label>Note</label>
                          <textarea type="text" class="form-control" name="note" placeholder="If have any note" rows="2" ></textarea>
                        </div>
            </div>
            <input type="hidden" id="saleID" name="saleID" required >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="pbsubmit" ><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click','.payment',function(){
          var id = $(this).attr("id");
        //alert(l_id);
          $('input[name="saleID"]').val(id);
          });

        $(document).on('click','.payment',function(){
          var id = $(this).attr("id");
            //alert(id);
          var url = "<?php echo base_url(); ?>Sale/get_sales_payment";
            //alert(url);
          $.ajax({
            method: "POST",
            url     : url,
            dataType: "json",
            data    : {'id' : id},
            success:function(data){
            //alert(data);
              var HTML = data["dueamount"];
              var HTML2 = data["paidAmount"];
            //alert(HTML2);
              $("#damount").val(HTML);
              $("#pamount").val(HTML2);
              },
            error:function(){
              alert('error');
              }
            });
          });
        });
    </script>
    <script type="text/javascript">
$(document).ready(function(){
  // Retrieve the initial values of damount and pamount
  var initialDAmount = parseFloat($("#damount").val());
  var initialPAmount = parseFloat($("#pamount").val());

  // Handle keyup event on the payamount input field
  $("#payamount").keyup(function(){
    // Get the updated values of damount and pamount
    var updatedDAmount = parseFloat($("#damount").val());
    var updatedPAmount = parseFloat($(this).val());

    // Check if pamount is greater than damount
    if (updatedPAmount > updatedDAmount) {
      // Display an error or take necessary action
      // For example, you can add an error message or disable the submit button
      alert("Paid Amount cannot be greater than Due Amount.");
      $("#pbsubmit").prop('disabled', true);
    } else {
      // Enable the submit button and clear any error message
      $("#pbsubmit").prop('disabled', false);
      $("#error-message").text("");
    }
  });

  // Initialize the values of damount and pamount on page load
  $("#damount").val(initialDAmount);
  $("#pamount").val(initialPAmount);
});
</script>
    <script type="text/javascript">
    
        $(document).ready(function(){
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val(1);
            });

      $('#accountType').on('change',function(){
        var value = $(this).val();
        $('#accountNo').empty();
        getAccountNo(value, '#accountNo');
        });
        
        function getAccountNo(value,place){
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
            customAlert('Please Select Account Type', "error", true);
            }
          }
    </script>
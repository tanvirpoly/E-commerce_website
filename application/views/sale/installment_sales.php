<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Installment Sales</h1>
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
                <h3 class="card-title">Installment Sales List</h3>
              </div>

              <div class="card-body">
                <table id="example" class="table table-responsive table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>In. No.</th>
                      <th>Date</th>
                      <th>Customer</th>
                      <th>Garantor</th>
                      <th>Files</th>
                      <th>Total</th>            
                      <th>Paid</th>
                      <th>Due</th>
                      <th>EMI</th>
                      <th style="width: 9%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($sales as $value){
                    $i++;
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value['invoice_no']; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['regdate'])); ?></td>
                      <td><?php echo $value['customerName']; ?><br><?php echo $value['mobile']; ?></td>
                      <td><?php echo $value['gName']; ?><br><?php echo $value['gMobile']; ?></td>
                      <td>
                        <?php if($value['gNid']){ ?>
                        <a class="btn btn-info btn-sm" href="<?php echo site_url().'upload/'.$value['gNid'] ?>" dowanload >NID</a>
                        <?php } if($value['gCheck']){ ?>
                        <a class="btn btn-info btn-sm" href="<?php echo site_url().'upload/'.$value['gCheck'] ?>" dowanload >Check</a>
                        <?php } ?>
                      </td>
                      <td><?php echo number_format($value['totalAmount'], 2); ?></td>
                      <td><?php echo number_format($value['paidAmount'], 2); ?></td>
                      <td><?php echo number_format($value['dueamount'], 2); ?></td>
                      <td><?php echo $value['nEmi'].' / '.number_format($value['pEmi'], 2); ?></td>
                      <td>
                        <?php if($value['dueamount'] > 0){ ?>
                        <a href="#" class="btn btn-primary payment" data-toggle="modal" data-target=".bs-example-modal-payment" data-id="<?php echo $value['saleID']; ?>" id="<?php echo $value['saleID']; ?>" onclick="document.getElementById('payment').style.display='block'" >Payment</a>
                        <?php } ?> 
                        <?php if($value['pEmi'] > 0){ ?>
                        <a class=" btn btn-info btn-sm" href="<?php echo site_url().'viewSPayment/'.$value['saleID'] ?>" ><i class="fa fa-eye"></i></a>
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

    <div id="payment" class="modal fade bs-example-modal-payment" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >EMI Payment Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <form action="<?php echo base_url('Sale/save_sales_emi_payment');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Due EMI</label>
                <input type="text" class="form-control" name="dEmi" id="dEmi" readonly >
              </div>
              <div class="form-group">
                <label>Due Amount</label>
                <input type="text" class="form-control" name="dAmount" id="dAmount" readonly >
              </div>
              <div class="form-group">
                <label>Paid EMI</label>
                <input type="text" class="form-control" name="paidEmi" value="1" id="paidEmi" onkeyup="calculate_emi()" required >
              </div>
              <input type="hidden" class="form-control" name="pEmi" id="pEmi" required >
              <input type="hidden" class="form-control" name="pAmount" id="pAmount" required >
              <div class="form-group">
                <label>Paid Amount *</label>
                <input type="text" class="form-control" name="payAmount" id="payAmount" placeholder="Amount" required >
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
          var url = "<?php echo base_url(); ?>Sale/get_sales_emi_payment";
            //alert(url);
          $.ajax({
            method: "POST",
            url     : url,
            dataType: "json",
            data    : {'id' : id},
            success:function(data){
            //alert(data);
              var HTML = data["nEmi"];
              var HTML2 = data["tpEmi"];
              var HTML3 = data["dueamount"];
              var HTML4 = data["pEmi"];
              var HTML5 = data["paidAmount"];
              
              var demi = HTML - HTML2;
                //alert(HTML2);
              $("#dEmi").val(demi);
              $("#dAmount").val(HTML3);
              $("#pEmi").val(HTML4);
              $("#pAmount").val(HTML5);
              $("#payAmount").val(HTML4);
              },
            error:function(){
              alert('error');
              }
            });
          });
        });
    </script>
    
    <script type="text/javascript">
        
        function calculate_emi(){
            var paid = $('#paidEmi').val();
            var total = $('#pEmi').val();
            //alert(paid); alert(total); 
            var remaining = total*paid;
            $('#payAmount').val(Math.round(remaining));
            }

    </script>
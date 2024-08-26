<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Sale Reports</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sale Reports</h3>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('Sale/sales_export_action'); ?>" style="float: right; margin-right: 10px;" ><i class="far fa-file-excel"></i> Export Excel</a>
              </div>

              <div class="card-body">

                <div class="col-sm-12 col-md-12 col-12">
                  <div id="print">
                    <div class="">
                      <table id="example" class="table table-responsive table-bordered" >
                        <thead>
                          <tr>
                            <!-- <th style="width: 5%;">#SN.</th> -->
                            <th>Invoice No</th>
                            <th>Date</th>
                            <!--<th>Sales Man</th>-->
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Discount</th>
                            <th style="width: 10%;">Due</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 0;
                          $ts = 0;
                          $tp = 0;
                          $td = 0;
                          $tda = 0;
                          foreach ($sales as $sale){
                          $i++;
                          ?>
                          <tr>
                            <!-- <td><?php echo $i; ?></td> -->
                            <td><?php echo $sale->invoice_no; ?></td>
                            <td><?php echo date('j F Y', strtotime($sale->saleDate)); ?></td>
                            <!--<td><?php echo $sale->name; ?></td>-->
                            <td><?php echo $sale->customerName; ?></td>
                            <td><?php echo number_format($sale->totalAmount, 2); $ts += $sale->totalAmount; ?></td>
                            <td><?php echo number_format($sale->paidAmount, 2); $tp += $sale->paidAmount; ?></td>
                            <td><?php 
                            if($sale->discount > 0){
                              echo number_format($sale->discount, 2);
                            }else{
                              echo number_format(0.00, 2);
                            }
                             $td += $sale->discount; ?></td>
                            <td><?php echo number_format($sale->dueamount, 2); $tda += $sale->dueamount; ?></td>
                          </tr> 
                          <?php } ?>
                          <?php
                    $j = $i;
                    foreach ($order as $value) {
                    $id = $value['oid'];
                    $j++;
                    ?>
                    <tr>
                      <!-- <td><?php echo $i; ?></td> -->
                      <td><?php echo $value['oCode']; ?></td>
                      <td><?php echo date('j F Y', strtotime($value['oDate'])); ?></td>
                      <td><?php echo $value['customerName']; ?></td>
                      <td><?php echo number_format($value['tAmount'], 2) ?></td>
                      <td><?php echo number_format($value['scost'], 2) ?></td>
                      <td><?php echo number_format(($value['tAmount']+$value['scost']), 2) ?></td>
                      <!-- <td><?php echo $value['delivery_time']; ?></td> -->
                      <!-- <td><?php echo $value['dArea']; ?></td> -->
                      <!-- <td><?php echo $value['name']; ?></td> -->
                      <!-- <td>
                        <?php if($value['status'] == 1){ ?>
                        <?php echo 'On Process'; ?>
                        <?php } else if($value['status'] == 2){ ?>
                        <span style="color: green;"><?php echo 'Order Delivery'; ?></span>
                        <?php } else if($value['status'] == 5){ ?>
                        <span style="color: red;"><?php echo 'Canceled'; ?></span>
                        <?php } else{ ?>
                        <?php echo 'N/A'; ?>
                        <?php } ?>
                      </td> -->
                    </tr>
                    <?php } ?>
                        </tbody>
                        <tbody>
                          <!-- <tr>
                            <td colspan="4" align="right"><b>Total Amount</b></td>
                            <td><b><?php echo number_format($ts, 2); ?></b></td>
                            <td><b><?php echo number_format($tp, 2); ?></b></td>
                            <td><b><?php echo number_format($td, 2); ?></b></td>
                            <td><b><?php echo number_format($tda, 2); ?></b></td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>
                    <div class="row no-print" >
                      <div class="col-12" style="text-align: center;">
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="printDiv('print')" ><i class="fas fa-print"></i> Print</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#daily').click(function(){
          $('#dreports').removeAttr('class','d-none');
          $('#mreports').attr('class','d-none');
          $('#yreports').attr('class','d-none');

          $('#sdate').attr('required','required');
          $('#edate').attr('required','required');
          $('#dcustomer').attr('required','required');
          $('#demployee').attr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#yreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#mcustomer').attr('required','required');
          $('#memployee').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#mreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#ycustomer').attr('required','required');
          $('#yemployee').attr('required','required');
          });
        });
    </script>
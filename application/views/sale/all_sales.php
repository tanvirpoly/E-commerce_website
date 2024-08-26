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
                  <form action="<?php echo base_url() ?>saleReport" method="get">
                    <div class="col-md-12 col-sm-12 col-12">
                      <div class="form-group col-md-12 col-sm-12 col-12">
                        <b>
                          <input type="radio" name="reports" value="dailyReports" id="daily" required >&nbsp;&nbsp;Daily Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" name="reports" value="monthlyReports" id="monthly" required >&nbsp;&nbsp;Monthly Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" name="reports" value="yearlyReports" id="yearly" required >&nbsp;&nbsp;Yearly Reports
                        </b>
                      </div>

                      <div class="d-none" id="dreports">
                        <div class="row">
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <label>Start Date *</label>
                            <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('m/d/Y') ?>" id="sdate" required="" >
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <label>End Date *</label>
                            <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('m/d/Y') ?>" id="edate" required="" >
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Customer *</label>
                            <select class="form-control select2" name="dcustomer" id="dcustomer" required="" >
                              <option value="All">All Customer</option>
                              <?php foreach($customers as $value){ ?>
                              <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['cus_id'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php if($_SESSION['role'] > 2){ ?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <input type="hidden" class="form-control" name="demployee" id="demployee" value="<?php echo $_SESSION['uid']?>" required="" >
                            <input type="text" class="form-control" value="<?php echo $_SESSION['name']?>" required readonly >
                          </div>
                          <?php } else{?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <select class="form-control select2" name="demployee" id="demployee" required="" >
                              <option value="All">All Employee</option>
                              <?php foreach($employees as $value){ ?>
                              <option value="<?php echo $value['uid']; ?>"><?php echo $value['name'].' ( '.$value['empid'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php }?>
                          <!--<div class="form-group col-md-2 col-sm-2 col-12">-->
                          <!--  <label>Select Company *</label>-->
                          <!--  <select class="form-control" name="dsmethod" id="dsmethod" required="" >-->
                          <!--    <option value="">Select One</option>-->
                          <!--    <option value="All">All Company</option>-->
                          <!--    <?php foreach($company as $value){ ?>-->
                          <!--    <option value="<?php echo $value['com_pid']; ?>"><?php echo $value['com_name']; ?></option>-->
                          <!--    <?php } ?>-->
                          <!--  </select>-->
                          <!--</div>-->
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="mreports">
                        <div class="row">
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <label>Select Month *</label>
                            <select class="form-control" name="month" id="month" required="" >
                              <option value="">Select One</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <label>Select Year *</label>
                            <select class="form-control" name="year" id="year" required="" >
                              <?php $d = date("Y"); ?>
                              <option value="">Select One</option>
                              <?php for ($x = 2020; $x <= $d; $x++) { ?>
                              <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Customer *</label>
                            <select class="form-control select2" name="mcustomer" id="mcustomer" required="" >
                              <option value="All">All Customer</option>
                              <?php foreach($customers as $value){ ?>
                              <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['cus_id'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php if($_SESSION['role'] > 2){ ?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <input type="hidden" class="form-control" name="memployee" id="memployee" value="<?php echo $_SESSION['uid']?>" required="" >
                            <input type="text" class="form-control" value="<?php echo $_SESSION['name']?>" required readonly >
                          </div>
                          <?php } else{?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <select class="form-control select2" name="memployee" id="memployee" required="" >
                              <option value="All">All Employee</option>
                              <?php foreach($employees as $value){ ?>
                              <option value="<?php echo $value['uid']; ?>"><?php echo $value['name'].' ( '.$value['empid'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php } ?>
                          <!--<div class="form-group col-md-2 col-sm-2 col-12">-->
                          <!--  <label>Select Company *</label>-->
                          <!--  <select class="form-control" name="msmethod" id="msmethod" required="" >-->
                          <!--    <option value="">Select One</option>-->
                          <!--    <option value="All">All Company</option>-->
                          <!--    <?php foreach($company as $value){ ?>-->
                          <!--    <option value="<?php echo $value['com_pid']; ?>"><?php echo $value['com_name']; ?></option>-->
                          <!--    <?php } ?>-->
                          <!--  </select>-->
                          <!--</div>-->
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="yreports">
                        <div class="row">
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <label>Select Year *</label>
                            <select class="form-control" name="ryear" id="ryear" required="" >
                              <?php $d = date("Y"); ?>
                              <option value="">Select One</option>
                              <?php for ($x = 2020; $x <= $d; $x++) { ?>
                              <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Customer *</label>
                            <select class="form-control select2" name="ycustomer" id="ycustomer" required="" >
                              <option value="All">All Customer</option>
                              <?php foreach($customers as $value){ ?>
                              <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['cus_id'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php if($_SESSION['role'] > 2){ ?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <input type="hidden" class="form-control" name="yemployee" id="yemployee" value="<?php echo $_SESSION['uid']?>" required="" >
                            <input type="text" class="form-control" value="<?php echo $_SESSION['name']?>" required readonly >
                          </div>
                          <?php } else{?>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Employee *</label>
                            <select class="form-control select2" name="yemployee" id="yemployee" required="" >
                              <option value="All">All Employee</option>
                              <?php foreach($employees as $value){ ?>
                              <option value="<?php echo $value['uid']; ?>"><?php echo $value['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <?php } ?>
                          <!--<div class="form-group col-md-2 col-sm-2 col-12">-->
                          <!--  <label>Select Company *</label>-->
                          <!--  <select class="form-control" name="ysmethod" id="ysmethod" required="" >-->
                          <!--    <option value="">Select One</option>-->
                          <!--    <option value="All">All Company</option>-->
                          <!--    <?php foreach($company as $value){ ?>-->
                          <!--    <option value="<?php echo $value['com_pid']; ?>"><?php echo $value['com_name']; ?></option>-->
                          <!--    <?php } ?>-->
                          <!--  </select>-->
                          <!--</div>-->
                          <div class="form-group col-md-2 col-sm-2 col-xs-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-sm-12 col-md-12 col-12">
                  <div id="print">
                    <div class="">
                      <table id="example" class="table table-responsive table-bordered" >
                        <thead>
                          <tr>
                            <th style="width: 5%;">#SN.</th>
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
                            <td><?php echo $i; ?></td>
                            <td><a href="<?php echo site_url('viewSale').'/'.$sale->saleID; ?>"><?php echo $sale->invoice_no; ?></td>
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
                        </tbody>
                        <tbody>
                          <tr>
                            <td colspan="4" align="right"><b>Total Amount</b></td>
                            <td><b><?php echo number_format($ts, 2); ?></b></td>
                            <td><b><?php echo number_format($tp, 2); ?></b></td>
                            <td><b><?php echo number_format($td, 2); ?></b></td>
                            <td><b><?php echo number_format($tda, 2); ?></b></td>
                          </tr>
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
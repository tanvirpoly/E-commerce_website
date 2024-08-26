<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bank Ledger Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Bank Ledger</li>
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
                <h3 class="card-title">Bank Ledger Reports</h3>
              </div>

              <div class="card-body">
                <div class="col-sm-12 col-md-12 col-12">
                  <form action="<?php echo base_url() ?>bankLReport" method="get">
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
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Start Date *</label>
                            <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('m/d/Y') ?>" id="sdate" required="" >
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>End Date *</label>
                            <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('m/d/Y') ?>" id="edate" required="" >
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Bank *</label>
                            <select class="form-control" name="dbank" >
                              <option value="">Select One</option>
                              <?php foreach($bank as $value){ ?>
                              <option value="<?php echo $value['ba_id']; ?>"><?php echo $value['accountName'].' ( '.$value['bankName'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="mreports">
                        <div class="row">
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Select Month *</label>
                            <select class="form-control" name="month" id="month" required="" >
                              <option value="">Select One</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
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
                            <label>Select Bank *</label>
                            <select class="form-control" name="mbank" >
                              <option value="">Select One</option>
                              <?php foreach($bank as $value){ ?>
                              <option value="<?php echo $value['ba_id']; ?>"><?php echo $value['accountName'].' ( '.$value['bankName'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="yreports">
                        <div class="row">
                          <div class="form-group col-md-3 col-sm-3 col-12">
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
                            <label>Select Bank *</label>
                            <select class="form-control" name="ybank" >
                              <option value="">Select One</option>
                              <?php foreach($bank as $value){ ?>
                              <option value="<?php echo $value['ba_id']; ?>"><?php echo $value['accountName'].' ( '.$value['bankName'].' )'; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-2 col-sm-2 col-xs-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-sm-12 col-md-12 col-12">
                  <?php if(isset($_GET['search'])) { ?>
                  <div id="print">
                    <div class="col-sm-12 col-md-12 col-12">
                      <div class="col-sm-12 col-md-12 col-12">
                        Account Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bledger[0]['accountName']; ?>
                      </div>
                      <div class="col-sm-12 col-md-12 col-12">
                        Account No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bledger[0]['accountNo']; ?>
                      </div>
                      <div class="col-sm-12 col-md-12 col-12">
                        Bank Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bledger[0]['bankName']; ?>
                      </div>
                      <div class="col-sm-12 col-md-12 col-12">
                        Branch Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $bledger[0]['branchName']; ?>
                      </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-12 col-12">
                      <?php if ($report == 'dailyReports') { ?>
                        <div class="box-header" style="text-align: center;">
                          <h3 class="box-title"><b>Bank Ledger Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                        </div>
                      <?php } else if ($report == 'monthlyReports') { ?>
                        <div class="box-header" style="text-align: center;">
                          <h3 class="box-title"><b>Bank Ledger Reports in : <?php echo $name.' '.$year; ?></b></h3>
                        </div>
                      <?php } else if ($report == 'yearlyReports') { ?>
                        <div class="box-header" style="text-align: center;">
                          <h3 class="box-title"><b>Bank Ledger Reports in : <?php echo $year; ?></b></h3>
                        </div>
                      <?php } ?>
                    </div>
                    
                    <div class="col-sm-12 col-md-12 col-12">
                      <table id="example" class="table table-responsive table-bordered table-hover" >
                        <thead>
                          <tr>
                            <th style="width: 5%;">#SN.</th>
                            <th>Date</th>
                            <th>Particular</th>
                            <th>Invoice No.</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                            <th style="width: 10%;">Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><?php echo date('d-m-Y',strtotime($bledger[0]['regdate'])); ?></td>
                            <td><?php echo 'Opening Balance'; ?></td>
                            <td><?php echo $bledger[0]['accountName']; ?></td>
                            <td></td>
                            <td><?php echo number_format($bledger[0]['balance'], 2); ?></td>
                            <td></td>
                          </tr>
                          
                          <?php if ($pruchase != null) { ?>
                          <?php
                          $i = 1;
                          foreach ($pruchase as $value){
                          $i++;
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->purchaseDate)); ?></td>
                            <td><?php echo 'Purchase'; ?></td>
                            <td><a href="<?php echo base_url().'viewPurchase/'.$value->purchaseID; ?>"><?php echo $value->challanNo; ?></td>
                            <td><?php echo number_format($value->totalPrice, 2); ?></td>
                            <td><?php echo number_format($value->paidAmount, 2); ?></td>
                            <td><?php echo number_format($value->due, 2); ?></td>
                          </tr>
                          <?php } ?> 
                          <?php } else{ ?>
                          <?php $i = 1; ?>
                          <?php } ?>
                          
                          <?php if ($sale != null) { ?>

                          <?php
                          $j = $i;
                          foreach ($sale as $value){
                          $j++;
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $j; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->saleDate)); ?></td>
                            
                            <td><?php echo 'Sales'; ?></td>
                            <td><a href="<?php echo base_url().'viewSale/'.$value->saleID; ?>"><?php echo $value->invoice_no; ?></td>
                            <td><?php echo number_format(($value->totalAmount), 2); ?></td> 
                            <td><?php echo number_format(($value->paidAmount), 2); ?></td> 
                            <td><?php echo number_format(($value->dueamount), 2); ?></td> 
                          </tr>   
                          <?php } ?> 
                          <?php } else{ ?>
                          <?php $j = 1; ?>
                          <?php } ?>
                          
                          <?php if ($sreturn != null) { ?>

                          <?php
                          $k = $j;
                          foreach ($sreturn as $value) {
                          $k++;
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $k; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->returnDate)); ?></td>
                            <td><?php echo 'Sale Returns'; ?></td>
                            <td><a href="<?php echo base_url().'viewReturn/'.$value->returnId; ?>"><?php echo $value->rid; ?></td>
                            <td><?php echo number_format(($value->totalPrice), 2); ?></td> 
                            <td><?php echo number_format(($value->scAmount), 2); ?></td> 
                            <td><?php echo number_format(($value->paidAmount), 2); ?></td> 
                            <td><?php echo '00'; ?></td>
                          </tr>   
                          <?php } ?>
                          <?php } else{ ?>
                          <?php $k = 0; ?>
                          <?php } ?> 
                          
                          <?php if ($preturn != null) { ?>

                          <?php
                          $l = $k;
                          foreach ($preturn as $value) {
                          $l++;
                          $query=$this->db->select('bankName')
                                          ->from('bankaccount')
                                          ->where('ba_id',$value->accountNo)
                                          ->get()
                                          ->row();
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $l; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->prDate)); ?></td>
                            <td><?php echo 'Purchase Returns'; ?></td>
                            <td><a href="<?php echo base_url().'viewpReturn/'.$value->prid; ?>"><?php echo $value->prCode; ?></td>
                            <td><?php echo number_format(($value->totalPrice), 2); ?></td> 
                            <td><?php echo number_format(($value->paidPrice), 2); ?></td> 
                            <td><?php echo number_format(($value->totalPrice-$value->paidPrice), 2); ?></td> 
                          </tr>   
                          <?php } ?>
                          <?php } else{ ?>
                          <?php $l = 0; ?>
                          <?php } ?>
                          
                          <?php if ($voucher != null) { ?>

                          <?php
                          $m = $l;
                          $tvpa = 0;
                          foreach ($voucher as $value) {
                          $m++;
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $m; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->voucherdate)); ?></td>
                            <td><?php echo 'Voucher'; ?></td>
                            <td><a href="<?php echo base_url().'viewVoucher/'.$value->vuid; ?>"><?php echo $value->invoice; ?></td>
                            <td><?php echo '00'; ?></td> 
                            <td><?php echo number_format(($value->totalamount), 2); $tvpa += $value->totalamount; ?></td> 
                            <td><?php echo '00'; ?></td>
                          </tr>   
                          <?php } ?>
                          <?php } else{ ?>
                          <?php $m = 0; ?>
                          <?php } ?>
                          
                          <?php if ($fbank != null) { ?>

                          <?php
                          $n = $m;
                          $tfba = 0;
                          foreach ($fbank as $value) {
                          $n++;
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $n; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->regdate)); ?></td>
                            <td><?php echo 'From Account'; ?></td>
                            <td><?php echo ''; ?></td>
                            <td><?php echo '00'; ?></td> 
                            <td><?php echo number_format(($value->amount), 2); $tfba += $value->amount; ?></td> 
                            <td><?php echo '00'; ?></td>
                          </tr>   
                          <?php } ?>
                          <?php } else{ ?>
                          <?php $n = 0; ?>
                          <?php } ?>
                          
                          <?php if ($tbank != null) { ?>

                          <?php
                          $p = $n;
                          $ttba = 0;
                          foreach ($tbank as $value) {
                          $p++;
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $p; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value->regdate)); ?></td>
                            <td><?php echo 'To Account'; ?></td>
                            <td><?php echo ''; ?></td>
                            <td><?php echo '00'; ?></td> 
                            <td><?php echo number_format(($value->amount), 2); $ttba += $value->amount; ?></td> 
                            <td><?php echo '00'; ?></td>
                          </tr>   
                          <?php } ?>
                          <?php } else{ ?>
                          <?php $p = 0; ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-12" style="text-align: center; margin-top: 20px">
                    <a href="javascript:void(0)" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                  </div>
                  <?php } ?>
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
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#yreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#mreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          });
        });
    </script>
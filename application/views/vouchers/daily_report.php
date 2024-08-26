<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Daily Report</li>
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
                <h3 class="card-title">Daily Report</h3>
              </div>

              <div class="card-body">
                <div class="col-sm-12 col-md-12 col-12">
                  <div id="print">
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-12">
                        <h3>Date : <?php echo date('d-m-Y'); ?></h3>
                      </div>
                      <div class="table-responsive">
                        <table id="" class="table table-bordered" >
                        <thead>
                          <tr>
                            <th colspan="3" style="text-align: center;">Income</th>
                            <th colspan="3" style="text-align: center;">Expense</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 10%;">1</td>
                            <td style="width: 20%;">Company Opening Balance</td>
                            <td style="width: 20%;">
                              <?php echo number_format(($cash->ta), 2); ?>
                            </td>
                            <td style="width: 10%;">1</td>
                            <td style="width: 20%;">Purchase Amount</td>
                            <td style="width: 20%;">
                              <?php
                              $ctpa = 0;
                              foreach ($cpurchase as $value){
                              ?>
                              <?php $ctpa += ($value->quantity*$value->pprice); ?>
                              <?php } ?>
                              <?php echo number_format($ctpa, 2); ?>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 10%;">2</td>
                            <td style="width: 20%;">Bank Opening Balance</td>
                            <td style="width: 20%;"><?php echo number_format(($bank->ta), 2); ?></td>
                            <td style="width: 10%;">2</td>
                            <td>Debit Voucher / Expense</td>
                            <td><?php echo number_format($cdvoucher->total, 2); ?></td>
                          </tr>
                          <tr>
                            <td style="width: 10%;">3</td>
                            <td style="width: 20%;">Mobile Opening Balance</td>
                            <td style="width: 20%;"><?php echo number_format(($mobile->ta), 2); ?></td>
                            <td style="width: 10%;">3</td>
                            <td>Supplier Pay</td>
                            <td><?php echo number_format($csvoucher->total, 2); ?></td>
                          </tr>
                          <tr>
                            <td style="width: 10%;">4</td>
                            <td style="width: 20%;">Previous Amount</td>
                            <td style="width: 20%;">
                              <?php $pamount = (($psale->total+$pcvoucher->total)-($ppurchase->total+$pdvoucher->total+$pempp->total+$preturn->total+$psvoucher->total)); ?>
                              <?php echo number_format(($pamount), 2); ?>
                            </td>
                            <td>4</td>
                            <td>Employee Payments</td>
                            <td><?php echo number_format($cempp->total, 2); ?></td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Sales Amount</td>
                            <td><?php echo number_format($csale->total, 2); ?></td>
                            <td>5</td>
                            <td>Returns</td>
                            <td><?php echo number_format(($creturn->total), 2); ?></td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Credit Voucher</td>
                            <td><?php echo number_format($ccvoucher->total, 2); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <!--<td>6</td>-->
                            <!--<td>Bank Transfer Amount</td>-->
                            <!--<td><?php echo number_format(($cbta->total), 2); ?></td>-->
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Due Payment Amount</td>
                            <td><?php echo number_format($cduep->total, 2); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <!--<tr>-->
                          <!--  <td>8</td>-->
                          <!--  <td>Bank Withdraw Amount</td>-->
                          <!--  <td><?php echo number_format($cbwa->total, 2); ?></td>-->
                          <!--  <td></td>-->
                          <!--  <td></td>-->
                          <!--  <td></td>-->
                          <!--</tr>-->
                          
                          <tr>
                            <td colspan="2" style="text-align: center;"><b>Today Total</b></td>
                            <td>
                              <?php $ti = $csale->total+$ccvoucher->total+$pamount+$cduep->total+$cash->ta+$bank->ta+$mobile->ta; ?>
                              <b><?php echo number_format($ti, 2); ?></b>
                            </td>
                            <td colspan="2" style="text-align: center;"><b>Today Total</b></td>
                            <td>
                              <?php $te = $ctpa+$cdvoucher->total+$csvoucher->total; ?>
                              <b><?php echo number_format($te, 2); ?></b>
                              </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" style="text-align: right;"><h4>Cash On Hand</h4></th>
                            <th colspan="3" style="text-align: left;"><h4><?php echo number_format(($ti-$te), 2); ?></h4></th>
                          </tr>
                        </tfoot>
                      </table>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12" align="center">
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-3">
                          <p style="margin-top: 30px;">-----------------------</p>
                          <p>Prepared By</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-3">
                          <p style="margin-top: 30px;">-----------------------</p>
                          <p>Checked By</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-3">
                          <p style="margin-top: 30px;">-----------------------</p>
                          <p>Verified By</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-3">
                          <p style="margin-top: 30px;">-----------------------</p>
                          <p>Authorized By</p>
                        </div>
                      </div>
                    </div>
                  </div><br>
                  <div class="form-group col-md-12 col-sm-12 col-12" style="text-align: center;margin-top: 20px">
                    <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
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
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
                     <form action="#" method="get">
                        <!--<div class="row">-->
                        <!--  <div class="form-group col-md-5 col-sm-5 col-12">-->
                        <!--    <label>Start Date *</label>-->
                        <!--    <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('m/d/Y') ?>" id="sdate" required="" >-->
                        <!--  </div>-->
                        <!--  <div class="form-group col-md-5 col-sm-5 col-12">-->
                        <!--    <label>End Date *</label>-->
                        <!--    <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('m/d/Y') ?>" id="edate" required="" >-->
                        <!--  </div>-->
                        <!--  <div class="form-group col-md-2 col-sm-2 col-12">-->
                        <!--    <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Filter</button>-->
                        <!--  </div>-->
                        <!--</div>-->
                      </form>
                      </div>
                      <div class="table-responsive">
                         <table id="" class="table table-bordered" >
                        <thead>
                          <tr>
                              <th>Date</th>
                              <th>Sell Amount</th>
                              <th>Purchase Amount</th>
                              <th>Expenses</th>
                              <th>Sales Returned</th>
                              <th>Purchase Returned</th>
                              <th>Sell/Gross Profit</th>
                              <th>Net Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($reports as $r){
                                    echo '
                                        <tr>
                                            <td>'.date('d/m/Y', strtotime($r['date'])).'</td>
                                            <td>'.$r['sellAmount'].'</td>
                                            <td>'.$r['purAmount'].'</td>
                                            <td>'.($r['dAmount'] + $r['sAmount'] + $r['tsalary']).'</td>
                                            <td>'.$r['dReturn'].'</td>
                                            <td>'.$r['dpReturn'].'</td>
                                            <td>'.($r['sellAmount'] - $r['purAmount'] - $r['dReturn'] + $r['dpReturn']).'</td>
                                            <td>'.(($r['sellAmount'] - $r['purAmount'] - $r['dReturn'] + $r['dpReturn']) - ($r['dAmount'] + $r['sAmount'] + $r['tsalary'])).'</td>
                                        </tr>
                                    ';
                                }
                            ?>
                        </tbody>
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
<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profit Report (Product Wise)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Profit Report (Product Wise)</li>
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
                <h3 class="card-title">Profit Report (Product Wise)</h3>
              </div>

              <div class="card-body">
                <div class="col-sm-12 col-md-12 col-12">
                  <form action="<?php echo base_url() ?>spReports" method="get">
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
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="mreports">
                        <div class="row">
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Month *</label>
                            <select class="form-control" name="month" id="month" required="" >
                              <option value="">Select Month</option>
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
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Year *</label>
                            <select class="form-control" name="year" id="year" required="" >
                              <option value="">Select Year</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                            </select>
                          </div>
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <button type="submit" name="search" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-search-plus" ></i>&nbsp;Search</button>
                          </div>
                        </div>
                      </div>

                      <div class="d-none" id="yreports">
                        <div class="row">
                          <div class="form-group col-md-3 col-sm-3 col-12">
                            <label>Year *</label>
                            <select class="form-control" name="ryear" id="ryear" required="" >
                              <option value="">Select Year</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
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
                  <div id="print">
                    <div class="row" id="header" style="display: none">
                        <div class="col-sm-2 col-md-2 col-2">
                          <img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="width: 100%;">
                        </div>
                        <div class="col-sm-8 col-md-8 col-8" style="text-align: center" >
                          <div class="col-sm-12 col-md-12 col-12">
                            <h3><b><?php echo $company->com_name; ?></b></h3>
                          </div>
                          <div class="col-sm-12 col-md-12 col-12">
                            <?php echo $company->com_address; ?>
                          </div>
                          <div class="col-sm-12 col-md-12 col-12">
                            <?php echo $company->com_email; ?>
                          </div>
                          <div class="col-sm-12 col-md-12 col-12">
                            <?php echo $company->com_mobile; ?>
                          </div>
                        </div>
                    </div>
                        
                    <div class="col-sm-12 col-md-12 col-12">
                      <?php if(isset($_GET['search'])) { ?>
                        <?php if ($report == 'dailyReports') { ?>
                          <div class="box-header" style="text-align: center;">
                            <h3 class="box-title"><b>Profit Report (Product Wise) in : <?php echo date('d/m/Y', strtotime($sdate)).' - '.date('d/m/Y', strtotime($edate)); ?></b></h3>
                          </div>
                        <?php } else if ($report == 'monthlyReports') { ?>
                          <div class="box-header" style="text-align: center;">
                            <h3 class="box-title"><b>Profit Report (Product Wise) in : <?php echo $name.' '.$year; ?></b></h3>
                          </div>
                        <?php } else if ($report == 'yearlyReports') { ?>
                          <div class="box-header" style="text-align: center;">
                            <h3 class="box-title"><b>Profit Report (Product Wise) in : <?php echo $year; ?></b></h3>
                          </div>
                        <?php } ?>
                      <?php } ?>
                      <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width: 5%;">#SN.</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 15%;">Product ID</th>
                            <th style="width: 15%;">Quantity</th>
                            <th style="width: 15%;">Sales</th>
                            <th style="width: 15%;">Purchases</th>
                            <th style="width: 15%;">Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 0;
                          $totalTQ = 0;
                          $totalSale = 0;
                          $totalPurchase = 0;
                          $TotalProfit = 0;
                          foreach ($salep as $value){
                          $i++;

                          $product = $this->db->select('productName,productcode,pprice')
                                            ->from('products')
                                            ->where('productID',$value->productID)
                                            ->get()
                                            ->row();

                          $pur = $this->db->select('SUM(quantity) as ta, pprice')
                                          ->from('purchase_product')
                                          ->where('productID',$value->productID)
                                          ->get()
                                          ->row();
                          if($product)
                            {
                            $pprice = $product->pprice;
                            }
                          else
                            {
                            $pprice = 0;
                            }
                        //   var_dump($pur);
                          ?>
                          
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php if($product){ ?><?php echo $product->productName; ?><?php } ?></td>
                            <td><?php if($product){ ?><?php echo $product->productcode; ?><?php } ?></td>
                            <td><?php echo number_format($value->tq, 2); $totalTQ += $value->tq; ?></td>
                            <td><?php echo number_format($value->ta, 2); $totalSale += $value->ta;?></td>
                            <td><?php echo number_format(($value->tq*$pprice), 2); $totalPurchase += $value->tq*$pprice ?></td>
                            <td>
                                <?php 
                                    $profit = $value->ta - ($value->tq * $pprice);
                                    echo number_format($profit, 2);
                                    $TotalProfit += $profit;
                                ?>
                            </td>

                          </tr>
                          <?php } ?>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="3" align="right";><b>Total Amount</b></td>
                                <td><b><?php echo number_format($totalTQ,2);?></b></td>
                                <td><b><?php echo number_format($totalSale,2);?></b></td>
                                <td><b><?php echo number_format($totalPurchase,2);?></b></td>
                                <td><b><?php echo number_format($TotalProfit,2);?></b></td>
                                
                            </tr>
                        </tbody>
                      </table>
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
          $('#dvtype').attr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mvtype').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yvtype').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#yreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dvtype').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#mvtype').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yvtype').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','d-none');
          $('#dreports').attr('class','d-none');
          $('#mreports').attr('class','d-none');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dvtype').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mvtype').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#yvtype').attr('required','required');
          });
        });
    </script>
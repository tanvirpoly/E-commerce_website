<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>
<style>
  @import url("https://fonts.googleapis.com/css?family=Roboto:400,500,700");

  * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: "Roboto", sans-serif;
  }

  a {
    text-decoration: none;
  }

  .product-card {
    /*width: 225px;*/
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 10px auto;
    background: #fafafa;
  }

  .badge {
    position: absolute;
    left: 8px;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
    z-index: 999;
  }

  .product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 150px;
    padding: 10px;
    background: #f0f0f0;
  }

  .product-tumb img {
    max-width: 100%;
    max-height: 100%;
  }

  .product-details {
    padding: 10px;
  }

  .product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
  }

  .product-details h6 a {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #363636;
    text-decoration: none;
    transition: 0.3s;
  }

  .product-details h6 a:hover {
    color: #fbb72c;
  }

  .product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
  }

  .product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
  }

  /*.product-bottom-details div {*/
  /*  float: left;*/
  /*  width: 50%;*/
  /*}*/

  .product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
  }

  .product-price small {
    font-size: 80%;
    font-weight: 400;
    /*text-decoration: line-through;*/
    display: inline-block;
    margin-right: 5px;
  }

  .product-links {
    text-align: right;
  }

  .product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
  }

  .product-links a:hover {
    color: #fbb72c;
  }


  /*///////////////////////////////////////////////*/
  .diagram {
    height: 100%;
  }

  .col-lg-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }

  .services-list div {
    background: #fff;
    border-radius: 10px;
    transition: background 0.5s, transform 0.5s;
  }

  .services-list div:hover {
    background: #fff;
    transform: translateY(-10px);
  }

  @media (max-width: 767px) {
    .col-lg-3 {
      flex: 0 0 100%;
      max-width: 100%;
    }
  }
</style>
<div class="content-wrapper">
  <section class="content-header">
    <!--  <div class="container-fluid">-->
    <!--    <div class="row mb-2">-->
    <!--<div class="col-sm-6">-->
    <!--  <h1>Dashboard</h1>-->
    <!--</div>-->
    <!--<div class="col-sm-6">-->
    <!--  <ol class="breadcrumb float-sm-right">-->
    <!--    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>-->
    <!--    <li class="breadcrumb-item active">Dashboard</li>-->
    <!--  </ol>-->
    <!--</div>-->
    <!--    </div>-->
    <!--  </div>-->
  </section>

  <?php
  $exception = $this->session->userdata('exception');
  if (isset($exception)) {
    echo $exception;
    $this->session->unset_userdata('exception');
  } ?>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!--<div class="card-header">-->
            <!--  <h3 class="card-title">Dashboard</h3>-->
            <!--</div>-->

            <div class="card-body">

              <section class="content">
                <div class="container-fluid">
                  <!--<div class="box-header with-border">-->
                  <!--  <h2><b>Welcome To "<?php echo $_SESSION['compname']; ?>"</b></h2>-->
                  <!--</div>-->
                  <div class="row">
                    <?php if ($_SESSION['customer'] == 1) { ?>
                      <!--<div class="col-lg-3 col-6">-->
                      <!--  <a href="<?php echo base_url('Customer'); ?>">-->
                      <!--  <div class="small-box box1" style="background-color:#b54dc9;color:white;">-->
                      <!--    <div class="inner">-->
                      <!--      <h3><?php echo $customer; ?></h3>-->
                      <!--      <p>Total Customer</p>-->
                      <!--    </div>-->
                      <!--    <div class="icon">-->
                      <!--      <i class="fas fa-users"></i>-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--  </a>-->
                      <!--</div>-->
                    <?php }
                    if ($_SESSION['productlist'] == 1) { ?>
                      <!--<div class="col-lg-3 col-6">-->
                      <!--  <a href="<?php echo base_url('Product'); ?>">-->
                      <!--  <div class="small-box box1" style="background-color:#6b36a0;color:white;">-->
                      <!--    <div class="inner">-->
                      <!--      <h3><?php echo $product; ?></h3>-->
                      <!--      <p>Total Product</p>-->
                      <!--    </div>-->
                      <!--    <div class="icon">-->
                      <!--      <i class="fas fa-dolly"></i>-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--  </a>-->
                      <!--</div>-->
                    <?php }
                    if ($_SESSION['supplier'] == 1) { ?>
                      <!--<div class="col-lg-3 col-6">-->
                      <!--  <a href="<?php echo base_url('Supplier'); ?>">-->
                      <!--  <div class="small-box box1" style="background-color:#005af1;color:white;">-->
                      <!--    <div class="inner">-->
                      <!--      <h3><?php echo $supplier; ?></h3>-->
                      <!--      <p>Total Supplier</p>-->
                      <!--    </div>-->
                      <!--    <div class="icon">-->
                      <!--      <i class="fas fa-people-carry-box"></i>-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--  </a>-->
                      <!--</div>-->
                    <?php }
                    if ($_SESSION['salesreport'] == 1) { ?>
                      <!--<div class="col-lg-3 col-6">-->
                      <!--  <a href="<?php echo base_url('saleReport'); ?>">-->
                      <!--  <div class="small-box box1" style="background-color:#51abe6;color:white;">-->
                      <!--    <div class="inner">-->
                      <!--      <h3><?php echo number_format($tsale->total + $ssale->ttotal, 2); ?></h3>-->
                      <!--      <p>Total Sales</p>-->
                      <!--    </div>-->
                      <!--    <div class="icon">-->
                      <!--      <i class="fa fa-shopping-basket"></i>-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--  </a>-->
                      <!--</div>-->
                    <?php } ?>
                    <!--<div class="col-lg-3 col-6">-->
                    <!--  <div class="small-box box1" style="background-color:#88c423;color:white;">-->
                    <!--    <div class="inner">-->
                    <!--      <h3><?php echo number_format($stockpur, 2); ?></h3>-->
                    <!--      <p>STOCK - Purchase Value</p>-->
                    <!--    </div>-->
                    <!--    <div class="icon">-->
                    <!--      <i class="far fa-money-bill-alt"></i>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <?php if ($_SESSION['salesreport'] == 1) { ?>
                      <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>dsalesReport">
                          <div class="small-box box1" style="background-color:#b54dc9;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format((($sale->total+$service->total)-$tsreturn->total), 2); ?>
                              </h3>
                              <p>Today Sales</p>
                            </div>
                            <div class="icon">
                              <i class="fas fa-bag-shopping"></i>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-lg-3 col-6">
                         <a href="<?php echo base_url(); ?>Sale"> 
                          <div class="small-box box1" style="background-color:#b54dc9;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format(($ptsale->total-$sreturn->total), 2); ?>
                              </h3>
                              <p>Total Sales</p>
                            </div>
                            <div class="icon">
                              <i class="fas fa-bag-shopping"></i>
                            </div>
                          </div>
                        <!-- </a> -->
                      </div>
                    <?php } ?>

                    <?php if($_SESSION['role'] != 2){?>
                      <div class="col-lg-3 col-6">
                        <!-- <a href="<?php echo base_url(); ?>totalsales"> -->
                          <div class="small-box box1" style="background-color:#b54dc9;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format($staffsales->total, 2); ?>
                              </h3>
                              <p>Staff Sales</p>
                            </div>
                            <div class="icon">
                              <i class="fas fa-bag-shopping"></i>
                            </div>
                          </div>
                        <!-- </a> -->
                      </div>
                    <?php }?>

                    <?php if ($_SESSION['purchasereport'] == 1) { ?>
                      <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>dpurReport">
                          <div class="small-box box1" style="background-color:#6b36a0;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format($purchase->total, 2); ?>
                              </h3>
                              <p>Todays Purchase</p>
                            </div>
                            <div class="icon">
                              <i class="fas fa-cart-shopping"></i>
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php }
                    if ($_SESSION['expensereport'] == 1) { ?>
                      <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>dexpReport">
                          <div class="small-box box1" style="background-color:#005af1;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format(($dvoucher->total + $empslry->total), 2); ?>
                              </h3>
                              <p>Today Expense</p>
                            </div>
                            <div class="icon">
                              <!--<i class="fas fa-funnel-dollar"></i>-->
                              <i class="fas fa-bangladeshi-taka-sign"></i>
                            </div>
                          </div>
                        </a>
                      </div>
                    <?php }
                    if ($_SESSION['voucherreport'] == 1) { ?>
                      <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>dsalesReport">
                          <div class="small-box box1" style="background-color:#51abe5;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format(($collection->total-$tsreturn->total), 2); ?>
                              </h3>
                              <p>Todays Due Collection</p>
                            </div>
                            
                            <div class="icon">
                              <!--<i class="fas fa-comment-dollar"></i>-->
                              <i class="fas fa-bangladeshi-taka-sign"></i>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>dsalesReport">
                          <div class="small-box box1" style="background-color:red;color:white;">
                            <div class="inner">
                              <h3>
                                <?php echo number_format(($due->totalDue+$tsreturn->total), 2); ?>
                              </h3>
                              <p>Todays Due</p>
                            </div>
                            
                            <div class="icon">
                              <!--<i class="fas fa-comment-dollar"></i>-->
                              <i class="fas fa-bangladeshi-taka-sign"></i>
                            </div>
                          </div>
                        </a>
                      </div>
                      
                       <div class="col-lg-3 col-6">
                        <a href="<?php echo base_url(); ?>order">
                            <div class="small-box box1" style="background-color:green;color:white;">
                                <div class="inner">
                                    <?php echo 'Today\'s Online Orders:' . $order['count_row']; ?>
                                    <?php ?>
                                    <?php echo '<br>'.'Total Onine Sales Today:' . '<h5>'.'৳ ' . number_format($order['query_result'], 2).'</h5>'; ?>
                                </div>
                                <div class="icon">
                                    <!--<i class="fas fa-comment-dollar"></i>-->
                                    <i class="fas fa-bangladeshi-taka-sign"></i>
                                    
                                    fa-taka
                                </div>
                            </div>
                        </a>
                        </div>
                        
                        <!--<div class="col-lg-3 col-6">-->
                        <!--<a href="#">-->
                        <!--    <div class="small-box box1" style="background-color:red;color:white;">-->
                        <!--        <div class="inner">-->
                        <!--      <h3>-->
                                 
                        <!--        <?php echo number_format($cpayment->total+$order['query_result']+$sale->total,2); ?>-->
                                
                        <!--      </h3>-->
                        <!--      <p>Todays Total Sales</p>-->
                        <!--    </div>-->
                        <!--        <div class="icon">-->
                        <!--            <i class="fas fa-comment-dollar"></i>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</a>-->
                        <!--</div>-->

                      
                      
                    <?php } ?>
                    <!--<div class="col-lg-3 col-6">-->
                    <!--  <div class="small-box box1" style="background-color:#b54dc9;color:white;">-->
                    <!--    <div class="inner">-->
                    <!--      <h3><?php echo number_format($stockpur, 2); ?></h3>-->
                    <!--      <p>STOCK - Purchase Value</p>-->
                    <!--    </div>-->
                    <!--    <div class="icon">-->
                    <!--      <i class="far fa-money-bill-alt"></i>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-3 col-6">-->
                    <!--  <div class="small-box box1"  style="background-color:#88c423;color:white;">-->
                    <!--    <div class="inner">-->
                    <!--      <h3><?php echo number_format($stocksell, 2); ?></h3>-->
                    <!--      <p>STOCK - Sell Value</p>-->
                    <!--    </div>-->
                    <!--    <div class="icon">-->
                    <!--      <i class="far fa-money-bill-alt"></i>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>

                  <?php if ($_SESSION['role'] <= 2) { ?>
                    <div class="row">
                      <div class="col-lg-6 col-12"
                        style="background-color:#b4dcf68a;color:black;display: flex;flex-flow: column wrap;padding: 20px;margin-bottom: 10px;box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
                        <h4 style="text-align:center;font-weight:bold;font-family: Times New Roman, Times, serif;">Top
                          Sale Products</h4>
                        <div class="row">
                          <?php
                          $i = 0;
                          foreach ($sales as $value) {
                            $i++;
                            if ($i <= 6) {
                              ?>
                              <!--<div class="col-lg-4 col-md-4 col-12">-->
                              <!--  <div class="small-box services-list" style="background-color:white;color:black;" >-->
                              <!--    <div class="inner table-responsive text-center" style="overflow:hidden;">-->
                              <!--        <?php if ($value->image == null) { ?>-->
                                <!--        <i class="fa fa-shopping-cart fa-4x" aria-hidden="true" style="color:#88c423c9;"></i>-->
                                <!--        <?php } else { ?> -->
                                <!--        <img src="<?php echo base_url() . '/upload/product/' . $value->image; ?>" style="width: 50px; height: 50px;">-->
                                <!--        <?php } ?>-->
                              <!--      <p style="text-align:center;font-weight:bold;"><?= $value->productName; ?></p>-->
                              <!--      <p style="text-align:center;font-size:1.4rem;"><?php echo $value->total . ' ' . $value->unitName; ?></p>-->
                              <!--    </div>-->
                              <!--  </div>-->
                              <!--</div>-->
                              <div class="col-lg-4 col-md-4 col-12">
                                <div class="badge">
                                  <?= $i ?>
                                </div>
                                <div class="product-card">
                                  <div class="product-tumb">
                                    <?php if ($value->image == null) { ?>
                                      <i class="fa fa-shopping-cart fa-4x" aria-hidden="true" style="color:#88c423c9;"></i>
                                    <?php } else { ?>
                                      <img src="<?php echo base_url() . '/upload/product/' . $value->image; ?>" alt="">
                                    <?php } ?>
                                  </div>
                                  <div class="product-details">
                                    <span class="product-catagory"></span>
                                    <h6><a href="">
                                        <?= $value->productName; ?>
                                      </a></h6>
                                    <div class="product-bottom-details">
                                      <div class="product-price"><small>Total Sale: </small>
                                        <?= number_format($value->total, 2) . ' ' . $value->unitName; ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php }
                          } ?>
                        </div>
                        <div style="text-align:center;">
                          <a href="<?= base_url() ?>tsProduct" target="_blank">
                            <button class="btn"
                              style="background-color:#005af1;text-align:center;color:white !important;margin:10px;">View
                              More</button>
                          </a>
                        </div>
                      </div>


                      <div class="col-lg-6 col-12">
                        <div class="small-box" style="background-color:#e2cef691;color:black;">
                          <div class="inner table-responsive" id="table-content ">
                            <h4 style="text-align:center;font-weight:bold;font-family: Times New Roman, Times, serif;">Low
                              Stock Products</h4>
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th style="width: 5%;">SN.</th>
                                  <!--<th>Code</th>-->
                                  <th>Name</th>
                                  <th>Quantity</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 0;
                                foreach ($stock as $result) {
                                  $i++;
                                  $pid = $result['product'];
                                  $cid = $result['compid'];
                                  if ($i <= 3) {
                                    ?>
                                    <tr>
                                      <td
                                        style="white-space: nowrap;overflow: hidden;width: 10px;height: 10px;text-overflow: ellipsis;">
                                        <?php echo $i; ?>
                                      </td>
                                      <!--<td style="white-space: nowrap;overflow: hidden;width: 10px;height: 10px;text-overflow: ellipsis;"><?php echo $result['productcode']; ?></td>-->
                                      <td
                                        style="white-space: nowrap;overflow: hidden;width: 10px;height: 10px;text-overflow: ellipsis;">
                                        <?php echo $result['productName']; ?>
                                      </td>
                                      <td
                                        style="white-space: nowrap;overflow: hidden;width: 10px;height: 10px;text-overflow: ellipsis;">
                                        <?php echo $result['totalPices']; ?>
                                      </td>
                                    </tr>
                                  <?php }
                                } ?>
                              </tbody>
                            </table>
                            <div style="text-align:center;">
                              <a href="<?= base_url() ?>lowStock" target="_blank">
                                <button class="btn"
                                  style="background-color:#6b36a0; text-align:center;color:white !important;">View
                                  More</button>
                              </a>
                            </div>
                          </div>
                          <!--<div class="icon">-->
                          <!--  <i class="far fa-money-bill-alt"></i>-->
                          <!--</div>-->
                        </div>
                      </div>
                    </div>
                    <div class="row" style="display:flex;">
                      <div class="col-md-6 col-sm-6 col-12">
                        <div class="card text-center diagram">
                          <br>
                          <h3 style="font-family: Times New Roman, Times, serif;"><b>Last 7 Days' Sales </b></h3>
                          (Products)
                          <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                        </div>
                      </div>
                      <?php
                      $sp = 0;
                      $cg = 0;
                      $query1 = $this->db->select('SUM(paidAmount) as spaid')
                        ->from('sales')
                        ->get()
                        ->row();

                      $query2 = $this->db->select('SUM(paidAmount) as ppaid')
                        ->from('purchase')
                        ->get()
                        ->row();

                      $query3 = $this->db->select('purchase_product.productID,purchase_product.pprice,sale_product.quantity')
                        ->from('purchase_product')
                        ->join('sale_product', 'purchase_product.productID=sale_product.productID', 'left')
                        ->get()
                        ->result();

                      $query4 = $this->db->select('SUM(pAmount) as sspaid')
                        ->from('service_sale')
                        ->get()
                        ->row();

                      $query5 = $this->db->select('SUM(totalamount) as cv')
                        ->from('vaucher')
                        ->where('vauchertype', 'Credit Voucher')
                        ->get()
                        ->row();

                      $query6 = $this->db->select('SUM(totalamount) as dv')
                        ->from('vaucher')
                        ->where('vauchertype', 'Debit Voucher')
                        ->get()
                        ->row();

                      $query7 = $this->db->select('SUM(totalamount) as sp')
                        ->from('vaucher')
                        ->where('vauchertype', 'Supplier Pay')
                        ->get()
                        ->row();

                      $query8 = $this->db->select('SUM(pAmount) as salary')
                        ->from('employee_payment')
                        ->get()
                        ->row();

                      foreach ($query3 as $q3) {
                        $cg += $q3->pprice * $q3->quantity;
                      }

                      // var_dump($query1->spaid);
                      // var_dump($query2->ppaid);
                      // var_dump($cg);
                    
                      $gp = ($query1->spaid - $cg) + $query4->sspaid + $query5->cv;

                      $exp = $query6->dv + $query7->sp + $query8->salary;

                      $np = $gp - $exp;

                      // var_dump($gp);
                      // var_dump($exp);
                      // var_dump($np);
                      ?>
                      <div class="col-md-6 col-sm-6 col-12">
                        <div class="card diagram" style="text-align: center;">
                          <br>
                          <h3 style="font-family: Times New Roman, Times, serif;"><b>Profit Loss Pie Chart</b></h3>
                          <br>
                          <canvas id="myChart" style=" width: 50%;"></canvas>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('footer/footer'); ?>

<script type="text/javascript">
  window.onload = function () {

    CanvasJS.addColorSet("greenShades",
      [
        "#1382d6",
        "#33A02C",
        "#FF7F00",
        "#6A3D9A",
        "#E31A1C",
        "#FDBF6F",
        "#B2DF8A"
      ]);

    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      theme: "light1",
      colorSet: "greenShades",
      //   title:{
      //     text: "Last 7 Days Sales"
      //     },
      axisY: {
        title: "Products sales amount"
      },
      data: [{
        type: "column",
        yValueFormatString: "#,##0.## Taka",
        dataPoints: <?php echo json_encode($this->pm->graph_data_point(), JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
  }
</script>

<script>
  var gp = <?php echo $gp; ?>;
  var np = <?php echo $np; ?>;
  var te = <?php echo $exp; ?>;
  // alert(te);
  var data = {
    labels: ["Gross Profit", "Total Expense", "Net Profit "],
    datasets: [
      {
        data: [gp, te, np],
        backgroundColor: ["#FF9EAA", "#B799FF", "#FEFF86"]
      }
    ]
  };
  var ctx = document.getElementById("myChart").getContext("2d");
  var myPieChart = new Chart(ctx, {
    type: "pie",
    data: data
  });

</script>
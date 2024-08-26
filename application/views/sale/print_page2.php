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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sale Information</h3>
              </div>

              <div class="card-body">
                <div class="invoice p-3 mb-3">

                  <div id="print">

                    <div class="" style="background:url(<?php echo base_url('assets/dist/img/sslogo.jpg'); ?>) center no-repeat;" >
                    <div class="row invoice-info">
                      <div class="col-sm-4 col-4 invoice-col">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height:150px; width:auto;"><?php } ?>
                      </div>
                      <div class="col-sm-8 col-8 invoice-col">
                        <address>
                          <?php if($company){ ?><h3><b><?php echo $company->com_name; ?></b></h3><?php } ?>
                          <p>
                            <b><i class="fa fa-phone"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_mobile; ?><?php } ?><br>
                            <b><i class="fa fa-envelope"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_email; ?><?php } ?><br>
                            <b><i class="fa fa-globe"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_web; ?><?php } ?><br>
                            <b><i class="fa fa-map-marker"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_address; ?><?php } ?><br>
                          </p>
                        </address>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-9 col-sm-9 col-8">
                        <div class="row">
                          <div style="width: 20%; border: 1px solid;">Customer</div>
                          <div style="width: 75%; border: 1px solid;"><?php echo $prints['customerName']; ?></div>
                        </div>
                        <div class="row">
                          <div style="width: 20%; border: 1px solid;">Address</div>
                          <div style="width: 75%; border: 1px solid;"><?php echo $prints['address']; ?></div>
                        </div>
                        <div class="row">
                          <div style="width: 20%; border: 1px solid;">Mobile & Email</div>
                          <div style="width: 75%; border: 1px solid;"><?php echo $prints['mobile']; ?>, <?php echo $prints['email']; ?></div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-4">
                        <div class="row">
                          <div style="width: 40%;  border: 1px solid;" >Invoice#</div>
                          <div style="width: 60%; border: 1px solid;"><?php echo $prints['invoice_no']; ?></div>
                        </div>
                        <div class="row">
                          <div style="width: 40%; border: 1px solid;" >Date</div>
                          <div style="width: 60%; border: 1px solid;" ><?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?></div>
                        </div>
                        <div class="row">
                          <div style="width: 40%; border: 1px solid;" >Customer ID</div>
                          <div style="width: 60%; border: 1px solid;" ><?php echo $prints['cus_id']; ?></div>
                        </div>
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12">
                        <div class="row">
                          <div style="width: 5%; border: 1px solid;">#SN.</div>
                          <div style="width: 35%; border: 1px solid;">Product Name</div>
                          <div style="width: 15%; border: 1px solid;">Quantity</div>
                          <div style="width: 15%; border: 1px solid;">Unit</div>
                          <div style="width: 15%; border: 1px solid;">Rate</div>
                          <div style="width: 15%; border: 1px solid;">Price</div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                          <?php
                          $i = 0;
                          $tq = 0;
                          $stotal = 0;
                          foreach ($salesp as $value){
                          $i++;
                          ?>
                          <div class="row" style="margin-left: -15px; margin-right: -15px;" >
                            <div style="width: 5%; border: 1px solid;"><?php echo $i; ?></div>
                            <div style="width: 35%; border: 1px solid;"><?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?><br><?php echo $value['warranty']; ?></div>
                            <div style="width: 15%; border: 1px solid;"><?php echo round($value['quantity']); $tq += $value['quantity']; ?></div>
                            <div style="width: 15%; border: 1px solid;"><?php echo $value['unitName']; ?></div>
                            <div style="width: 15%; border: 1px solid;"><?php echo number_format($value['sprice'], 2);; ?></div>
                            <div style="width: 15%; border: 1px solid;"><?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></div>
                          </div>
                          <?php } ?>
                          <div class="row" style="margin-left: -15px; margin-right: -15px;" >
                            <div style="width: 85%; border: 1px solid; text-align: right;" ><b>Grand Total :</b></div>
                            <div style="width: 15%; border: 1px solid;"><b><?php echo number_format($stotal, 2); ?></b></div>
                          </div>
                        </div>
                        <div class="row">
                          <div style="width: 50%; border: 1px solid;" >
                            <span class="col-md-12 col-12" ><b>Terms of Sale</b></span><br>
                            <span class="col-md-12 col-12" >
                            1. All Prices invoiced are in BDT, excluding vat & tax.<br>
                            &nbsp;&nbsp;2. All item remain the property of SYNET until full payment has been received.<br>
                            &nbsp;&nbsp;3. Goods collected or delivered are not returnable. Any claims for damages shall be made within 7 days after delivery.<br>
                            &nbsp;&nbsp;4. Interest at 20% per month will be charged if this invoice remains unpaid after the expiry of the above terms.
                            </span><br>
                            <span class="col-md-12 col-12" ><b>Payment Mathod</b></span><br>
                            <span class="col-md-12 col-12" >
                            Account Name : SY Network Solutions (Pvt.) Limited<br>
                            &nbsp;&nbsp;Bank / Branch Code : 090262537<br>
                            &nbsp;&nbsp;Accout No : 107-110-27242<br>
                            &nbsp;&nbsp;Swift Code : DBBLBDDH107
                            </span><br>
                          </div>
                          <div style="width: 9%;" ></div>
                          <div style="width: 40%;" >
                            <div class="row">
                              <div style="width: 60%; border: 1px solid; text-align: right;"><b>Discount <?php if($prints['discountType'] == '%') { ?>(<?php echo $prints['discount']; ?>)<?php } ?></b></div>
                              <div style="width: 40%; border: 1px solid;"><?php echo number_format($prints['discountAmount'], 2); ?></div>
                            </div>
                            <div class="row">
                              <div style="width: 60%; border: 1px solid; text-align: right;"><b>VAT <?php echo '( '.$prints['vat'].' % )'; ?></b></div>
                              <div style="width: 40%; border: 1px solid;"><?php echo (($stotal*$prints['vat'])/100); ?></div>
                            </div>
                            <div class="row">
                              <div style="width: 60%; border: 1px solid; text-align: right;"><b>Amount</b></div>
                              <div style="width: 40%; border: 1px solid;"><?php echo number_format($prints['totalAmount'], 2); ?></div>
                            </div>
                            <div class="row">
                              <div style="width: 60%; border: 1px solid; text-align: right;"><b>Paid</b></div>
                              <div style="width: 40%; border: 1px solid;"><?php echo number_format($prints['paidAmount'], 2); ?></div>
                            </div>
                            <div class="row">
                              <div style="width: 60%; border: 1px solid; text-align: right;"><b>Due</b></div>
                              <div style="width: 40%; border: 1px solid;"><?php echo number_format($prints['dueamount'], 2); ?></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <?php if($prints['note'] != null){ ?>
                    <div class="row">
                      <p>Note / Remarks&nbsp;:&nbsp;</p>
                      <p><?php echo $prints['note']; ?></p>
                    </div>
                    <?php } ?>
                    
                    <div class="row" id="header" style="display: none">
                      <div class="col-md-12 col-12" style="text-align: center; position: absolute; bottom: 0;">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-6">
                            <p>------------------------------</p>
                            <p>Received By</p>
                          </div>
                          <div class="col-md-6 col-sm-6 col-6">
                            <p>------------------------------</p>
                            <p>Authorized By</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div><br><br>

                  <div class="row no-print" >
                    <div class="col-12" style="text-align: center;">
                      <a href="javascript:void(0)" class="btn btn-primary" onclick="printDiv('print')" ><i class="fas fa-print"></i> Print</a>
                      <a href="<?php echo site_url('Sale') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Back</a>
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

    <?php
      function convertNumber($number){
        $words = array(
          '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty');
    
        $number_length = strlen($number);

        $number_array = array(0,0,0,0,0,0,0,0,0);        
        $received_number_array = array();
    
        for($i=0;$i<$number_length;$i++)
          {    
          $received_number_array[$i] = substr($number,$i,1);    
          }
        
        for($i=9-$number_length,$j=0;$i<9;$i++,$j++)
          { 
          $number_array[$i] = $received_number_array[$j]; 
          }
        $number_to_words_string = "";

        for($i=0,$j=1;$i<9;$i++,$j++)
          {
          if($i==0 || $i==2 || $i==4 || $i==7)
            {
            if($number_array[$j]==0 || $number_array[$i] == "1")
              {
              $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
              $number_array[$i] = 0;
              }
            }
          }
        $value = "";
        for($i=0;$i<9;$i++)
          {
          if($i==0 || $i==2 || $i==4 || $i==7)
            {    
            $value = $number_array[$i]*10; 
            }
          else
            { 
            $value = $number_array[$i];    
            }            
          if($value!=0)
            {
            $number_to_words_string.= $words["$value"]." ";
            }
          if($i==1 && $value!=0)
            {
            $number_to_words_string.= "Crores ";
            }
          if($i==3 && $value!=0)
            {
            $number_to_words_string.= "Lakhs ";
            }
          if($i==5 && $value!=0)
            {
            $number_to_words_string.= "Thousand ";
            }
          if($i==6 && $value!=0)
            {
            $number_to_words_string.= "Hundred ";
            }            
          }
        if($number_length>9)
          {
          $number_to_words_string = "Sorry This does not support more than 99 Crores";
          }
        return ucwords(strtolower($number_to_words_string)." Taka Only.");
        }
    ?>

    <script type="text/javascript">
      function printpDiv(divName){
        $('#pprint').show();
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        }
    </script>
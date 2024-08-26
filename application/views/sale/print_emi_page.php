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
                <h3 class="card-title">Sale EMI Payment Information</h3>
              </div>

              <div class="card-body">
                <div class="invoice p-3 mb-3">

                  <div id="print">
                    <div class="row invoice-info">
                      <div class="col-sm-8 col-8 invoice-col">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height:80px; width:auto;"><?php } ?><br>
                        <div style="padding: 10px;">
                          <span style="padding: 10px; border: 2px solid #29B577; color: #29B577;">Billing From</span>
                        </div>
                        <address>
                          <?php if($company){ ?><h3><b><?php echo $company->com_name; ?></b></h3><?php } ?>
                          <p style="font-size: 22px;"><?php if($company){ ?><?php echo $company->com_address; ?><?php } ?><br>
                          <b>Mobile : </b><?php if($company){ ?><?php echo $company->com_mobile; ?><?php } ?><br>
                          <b>Email : </b><?php if($company){ ?><?php echo $company->com_email; ?><?php } ?><br>
                          <b>Website : </b><?php if($company){ ?><?php echo $company->com_web; ?><?php } ?><br>
                          <b>Facebook : </b><?php if($company){ ?><?php echo $company->com_fab; ?><?php } ?><br>
                          <b>Vat Reg. No. : </b><?php if($company){ ?><?php echo $company->com_vat; ?><?php } ?></p>
                        </address>
                      </div>
                      <div class="col-sm-4 col-4 invoice-col">
                        <div class="col-sm-12 col-12">
                          <h3>Sale Invoice</h3>
                          <p style="font-size: 22px;"><b>Invoice No. # </b><?php echo $prints['invoice_no']; ?><br>
                          <b>Sale Date #</b> <?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?><br>
                        </div>
                        
                        <div style="padding: 10px;">
                          <span style="padding: 10px; border: 2px solid #29B577; color: #29B577;">Payment</span>
                        </div>
                        
                        <address>
                          <h3><b><?php echo $prints['customerName']; ?></b></h3>
                          <p style="font-size: 22px;"><?php echo $prints['address']; ?><br>
                          <b>Mobile : </b><?php echo $prints['mobile']; ?></p>
                        </address>
                      </div>
                    </div>

                    <div class="row" style="font-size: 22px;">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#SN.</th>
                              <th>Date</th>
                              <th>EMI</th>
                              <th>Paid Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            foreach ($semip as $value){
                            $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo date('d-m-Y', strtotime($value['regdate'])); ?></td>
                              <td><?php echo round($value['nEmi']); $tq += $value['nEmi']; ?></td>
                              <td><?php echo number_format($value['pEmi'], 2); $stotal += $value['pEmi']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr>
                              <td colspan="2" align="right"><b>Grand Total :</b></td>
                              <td><b><?php echo $tq; ?></b></td>
                              <td><b><?php echo number_format($stotal, 2); ?></b></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                    <div class="row" id="header" style="display: none">
                      <div class="col-md-12 col-12" style="text-align: center; position: absolute; bottom: 0;">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-6" style="margin-top: 60px;">
                            <p>------------------------------</p>
                            <p>Received By</p>
                          </div>
                          <div class="col-md-6 col-sm-6 col-6">
                            <p><?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_simg; ?>" style="height:70px; width:auto;"><?php } ?></p>
                            <p>Authorized By</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="pprint" class="d-none">
                    <div class="row">
                      <div class="col-12">
                        <h4>
                          <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height:50px; width:auto;">&nbsp;&nbsp;<?php echo $company->com_name; ?><?php } ?>
                          <small class="float-right">Print Date : <?php echo date('d-m-Y'); ?></small>
                        </h4>
                      </div>
                    </div>
                    <div class="row invoice-info">
                      <div class="col-sm-4 col-12 invoice-col">
                        From
                        <address>
                          Address : <?php if($company){ ?><?php echo $company->com_address; ?><?php } ?><br>
                          Phone : <?php if($company){ ?><?php echo $company->com_mobile; ?><?php } ?><br>
                          Email : <?php if($company){ ?><?php echo $company->com_email; ?><?php } ?><br>
                        </address>
                      </div>
                      <div class="col-sm-4 col-12 invoice-col">
                        To
                        <address>
                          Customer : <?php echo $prints['customerName'].' ( '.$prints['cus_id'].' )'; ?><br>
                          Phone : <?php echo $prints['mobile']; ?><br>
                          Address : <?php echo $prints['address']; ?><br>
                        </address>
                      </div>
                      <div class="col-sm-4 col-12 invoice-col">
                        <b>Invoice No. # <?php echo $prints['invoice_no']; ?></b><br>
                        <b>Mano No. # <?php echo $prints['mamo']; ?></b><br>
                        <b>Payment Mode :</b> <?php echo $prints['accountType']; ?><br>
                        <b>Sales Date :</b> <?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <table class="table table-striped ">
                          <tbody>
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            foreach ($salesp as $value){
                            $i++;
                            ?>
                            <tr>
                                <tr>
                                  <td>Product&nbsp;:&nbsp;<?php echo $value['productName']; ?></td>
                                </tr>
                                <tr>
                                  <td>Quantity&nbsp;:&nbsp;<?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                                </tr>
                                <tr>
                                  <td>Unit Price&nbsp;:&nbsp;<?php echo number_format($value['sprice'], 2);; ?></td>
                                </tr>
                                <tr>
                                  <td>Sub Total&nbsp;:&nbsp;<?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></td>
                                </tr>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr>
                              <td>Total Amount&nbsp;:&nbsp;<?php echo number_format($stotal, 2); ?></td>
                            </tr>
                            <tr>
                              <td>Shipping Cost&nbsp;:&nbsp;<?php echo number_format($prints['scost'], 2); ?></td>
                            </tr>
                            <tr>
                              <td>Discount <?php if($prints['discountType'] == '%') { ?>(<?php echo $prints['discount']; ?>)<?php } ?>&nbsp;:&nbsp;<?php echo number_format($prints['discountAmount'], 2); ?></td>
                            </tr>
                            <tr>
                              <td>Payable Amount&nbsp;:&nbsp;<?php echo number_format(($stotal-$prints['discountAmount']), 2); ?></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">Paid Amount</td>
                              <td>Payable Amount&nbsp;:&nbsp;<?php echo number_format($prints['paidAmount'], 2); ?></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right"> </td>
                              <td>Payable Amount&nbsp;:&nbsp;<?php echo number_format($prints['dueamount'], 2); ?></td>
                            </tr>
                          </tbody>
                          <tbody>
                            <tr>
                              <td>
                                Previous Due&nbsp;:&nbsp;<?php $pd = ($csdue->total-($cvpa->total+$cra->total)); ?>
                                <?php echo number_format($pd, 2); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Total Due&nbsp;:&nbsp;<?php echo number_format(($pd+$prints['dueamount']), 2); ?></td>
                            </tr>
                          </tbody>
                          <tbody style="text-align: center;">
                            <tr>
                              <?php $twa = round(abs($prints['paidAmount'])); ?>
                              <td>( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumber($twa); ?> )</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                    <?php if($prints['note'] != null){ ?>
                    <div class="row">
                      <p class="lead">Note / Remarks&nbsp;:&nbsp;</p>
                      <p class="lead"><?php echo $prints['note']; ?></p>
                    </div>
                    <?php } ?>
                  </div>

                  <div class="row no-print" >
                    <div class="col-12" style="text-align: center;">
                      <!--<a href="javascript:void(0)" class="btn btn-primary" onclick="printpDiv('pprint')" ><i class="fas fa-print"></i> POS Print</a>-->
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
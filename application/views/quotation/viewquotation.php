<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>
    
  <style>
    .topics tr { 
      line-height: 5px;
      }
    @media print {
      .topics tr { 
        line-height: 5px;
        position: static;
        }
      }
    
  </style>
  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Quotation</li>
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
                <h3 class="card-title">Quotation Information</h3>
              </div>

              <div class="card-body">
                <div class="invoice p-3 mb-3">
                  <div id="print">
                    <div class="row invoice-info">
                      <div class="col-sm-2 col-2 invoice-col">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height:auto; width: 100%;"><?php } ?>
                      </div>
                      <div class="col-sm-7 col-7 invoice-col text-center">
                        <address style="margin-top: 20px;">
                          <?php if($company){ ?><h3><b><?php echo $company->com_name; ?></b></h3><?php } ?>
                          <!--<p>-->
                          <!--  <b><i class="fa fa-phone"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_mobile; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-envelope"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_email; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-globe"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_web; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-map-marker"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_address; ?><?php } ?><br>-->
                          <!--</p>-->
                        </address>
                      </div>
                      <div class="col-sm-3 col-3 invoice-col text-center">
                        <h4><b>Quotation</b></h4>
                        <table class="table table-bordered topics">
                          <thead>
                            <tr>
                              <th>Quotation #</th>
                              <th><?php echo $quotation['qinvoice']; ?></th>
                            </tr>
                            <tr>
                              <th>Date</th>
                              <th><?php echo date('d-m-Y', strtotime($quotation['quotationDate'])); ?></th>
                            </tr>
                            <!--<tr>-->
                            <!--  <th>Client ID</th>-->
                            <!--  <th><?php echo $quotation['cus_id']; ?></th>-->
                            <!--</tr>-->
                            <!--<tr>      -->
                            <!--  <td><b>Warranty</b></td>-->
                            <!--  <td></td>-->
                            <!--</tr>   -->
                          </thead>
                        </table>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12">
                        <table class="table table-bordered topics" >
                          <thead >
                            <tr >
                              <th style="width: 20%; border: 2px solid black !important;">Customer</th>
                              <th style="width: 80%; border: 2px solid black !important;"><?php echo $quotation['customerName']; ?></th>
                            </tr>
                            <tr>
                              <th style="width: 20%; border: 2px solid black !important;">Address</th>
                              <th style="width: 80%; border: 2px solid black !important;"><?php echo $quotation['address']; ?></th>
                            </tr>
                            <tr>
                              <th style="width: 20%; border: 2px solid black !important;">Mobile</th>
                              <th style="width: 80%; border: 2px solid black !important;"><?php echo $quotation['mobile']; ?></th>
                            </tr>
                            <tr>
                              <th style="width: 20%; border: 2px solid black !important;">Email</th>
                              <th style="width: 80%; border: 2px solid black !important;"><?php echo $quotation['email']; ?></th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                      <div class="col-md-12 col-sm-12 col-12">
                        <table class="table table-bordered" >
                          <thead >
                            <tr >
                              <td>Dear Sir,<br><?php echo $quotation['message']; ?></td>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-12">
                        <table class="table table-bordered topics">
                          <thead class="">
                            <tr>
                              <th style="width: 5%; background-color: #dfdfdf !important;">SL</th>
                              <th style="background-color: #dfdfdf !important;">Description</th>
                              <th style="background-color: #dfdfdf !important;">Capacity</th>
                              <th style="background-color: #dfdfdf !important;">Unit Price</th>
                              <th style="background-color: #dfdfdf !important;">Quantity</th>
                              <th style="width: 10%; background-color: #dfdfdf !important;">Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            foreach ($pquotation as $value){
                            $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value['pName']; ?></td>
                              <td><?php echo $value['capacity']; ?></td>
                              <td><?php echo number_format($value['salePrice'], 2);; ?></td>
                              <td><?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                              <td><?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></td>
                            </tr>
                            <?php } ?>
                            
                          </tbody>
                          <tbody>
                            <tr>
                              <td colspan="5" style="text-align: right;" ><b>Total Amount</b></td>
                              <td><b><?php echo number_format($stotal, 2); ?></b></td>
                            </tr>
                            <tr>
                              <td colspan="6" style="text-align: center;" >In word : <?php echo convertNumber($stotal); ?></td>
                            </tr>
                          </tbody>
                          <!--<tbody>-->
                          <!--  <tr>-->
                          <!--    <td colspan="7">-->
                          <!--      <span class="col-md-12 col-12" ><b>This Quotation is based upon the following specific terms :</b></span><br>-->
                          <!--      <span class="col-md-12 col-12" >-->
                          <!--          1. All Prices are in Bangladesh Currency (BDT) unless otherwise stated.<br>-->
                          <!--          &nbsp;&nbsp;2. All item  (s) including Intellectual property remain the property of SYNET until full payment has been received<br>-->
                          <!--          &nbsp;&nbsp;3. Payment terms are 30 days from delivery or self collection<br>-->
                          <!--          &nbsp;&nbsp;4. The prices quoted above are valid for thirty (30) days only , excluding VAT & TAX.<br>-->
                          <!--          &nbsp;&nbsp;5. A Cancellation fee of 30% of total order would apply post receipt of confirmation<br>-->
                          <!--          &nbsp;&nbsp;6. No Performance bonds or retentions have been provided for.-->
                          <!--      </span><br>-->
                          <!--    </td>-->
                          <!--  </tr>-->
                          <!--  <tr>-->
                          <!--    <td colspan="7">-->
                          <!--        Accepted By : -->
                          <!--    </td>-->
                          <!--  </tr>-->
                          <!--  <tr>-->
                          <!--    <td colspan="7" style="text-align: center;">-->
                          <!--       <p>---------------------------------------------------------------------------</p>-->
                          <!--       <p>Signiture / Date / Company Stamp</p>-->
                          <!--    </td>-->
                          <!--  </tr>-->
                          <!--</tbody>-->
                        </table>
                      </div>
                      
                      <div class="col-md-12 col-sm-12 col-12">
                        <table class="table table-bordered">
                          <tbody>
                            <tr style="text-align: center;">
                              <td style="background-color: #dfdfdf !important;"><b>Terms & Conditions</b></td>
                            </tr>
                            <tr  style="">
                              <td><?php echo $quotation['terms']; ?></td>
                            </tr>
                            <!--<tr class="topics" style="text-align: center;">-->
                            <!--  <td><b>Please confirm your acceptance through email.</b></td>-->
                            <!--</tr>-->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="col-md-12 col-12" >
                        <table class="table table-bordered topics">
                          <tbody>
                            <tr class="topics" >
                              <td><b>Prepared By</b></td>
                            </tr>
                            <tr class="topics" >
                              <td><?php echo $quotation['name']; ?></td>
                            </tr>
                            <!--<trclass="topics" >-->
                            <!--  <td><?php echo $quotation['umobile']; ?></td>-->
                            <!--</tr>-->
                            <!--<tr style="text-align: center;">-->
                            <!--  <td><b>Thank you for your business!</b></td>-->
                            <!--</tr>-->
                            <!--<tr style="text-align: center;">-->
                            <!--  <td>Should you have any enquiries concerning this quote, please contact</td>-->
                            <!--</tr>-->
                            <tr style="text-align: center;">
                              <td><?php echo $company->com_address; ?>  Mobile : <?php echo $company->com_mobile; ?>, Email : <?php echo $company->com_email; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                        
                    <!--<div class="row">-->
                    <!--  <div class="col-md-12 col-sm-12 col-12">-->
                    <!--    <div class="form-group col-md-12 col-sm-12 col-12">-->
                    <!--      Note / Remarks-->
                    <!--    </div>-->
                    <!--    <?php if($quotation['note']){ ?>-->
                    <!--    <div class="form-group col-md-12 col-sm-12 col-xs-12">-->
                    <!--      <?php echo $quotation['note']; ?>-->
                    <!--    </div>-->
                    <!--    <?php } ?>-->
                    <!--  </div>-->
                    <!--</div>-->
                        
                    <!--<div class="col-md-12 col-sm-12 col-12" style="text-align: center;">-->
                    <!--  <div class="row">-->
                    <!--    <div class="col-md-4 col-sm-4 col-4">-->
                    <!--      <p>------------------------------</p>-->
                    <!--      <p>Prepared By</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-4 col-sm-4 col-4">-->
                    <!--      <p>------------------------------</p>-->
                    <!--      <p>Verified By</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-4 col-sm-4 col-xs-4">-->
                    <!--      <p>------------------------------</p>-->
                    <!--      <p>Authorized By</p>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
                    <a href="javascript:void(0)" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
                    <a href="<?php echo site_url('Quotation') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Back</a>
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
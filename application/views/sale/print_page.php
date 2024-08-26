<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

    <style>
        @media print{
        .thwprint:after {
          display: none !important;
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
          font-size: 2px;
            }
          }
    #printOnly {
       display : none;
    }
    
    @media print {

        #printOnly {
           display : block;
           text-align:center;
        }
    }
    
   
</style>

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

              <div class="">
                <div class="invoice p-3 mb-3">
                  <div id="print">
                    <div class="row invoice-info">
                      <div class="col-sm-4 col-4 invoice-col text-right">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="width: 100%;height:auto;"><?php } ?>
                      </div>
                      <div class="col-md-8 col-sm-8 col-8 text-right">
                        <address>
                          <?php echo $company->com_address; ?><br>
                          <?php echo $company->com_email; ?><br>
                          <?php echo 'Contact No.: '.$company->com_mobile; ?><br>
                          <?php echo $company->com_web; ?><br>
                        </address>
                      </div>
                      </div>
                      <hr>
                      <!---->
                      <div class="row invoice-info" style="display:flex;align-items:center;justify-content:center;">
                          <div class="col-sm-4 invoice-col">
                            <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Date # </b></td>
                                    <td><?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Purchase # </b></td>
                                    <td><?php echo $prints['invoice_no']; ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Company # </b></td>
                                    <td><?php echo $prints['com_name']; ?></td>
                                  </tr>   
                                </tbody>
                              </table>
                          </div>
                          <div class="col-sm-4 invoice-col">
                              
                          </div>
                          <div class="col-sm-4 invoice-col">
                              <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Customer Name # </b></td>
                                    <td><?php echo $prints['customerName']; ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Address # </b></td>
                                    <td><?php echo $prints['address']; ?></td>
                                  </tr> 
                                  <tr class="gradeX">      
                                    <td><b>Contact No # </b></td>
                                    <td><?php echo $prints['mobile']; ?></td>
                                  </tr>
                                    
                                </tbody>
                              </table>
                          </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>SL</th>
                              <th>Product</th>
                              <th>Qty</th>
                              <!--<th>Unit</th>-->
                              <th>Unit Price</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody >
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            $pdue = $this->pm->get_customer_due_data($prints['customerID']);
                            foreach ($salesp as $value){
                            $i++;
                            ?>
                            <tr <?php if($i%2 == 0){ ?>style="background-color: #ddd !important;"<?php }else{ ?>style="background-color: #fff !important;"<?php } ?>>
                              <td style=" " ><?php echo $i; ?></td>
                              <td style=" " ><?php echo $value['pName']; ?></td>
                              <td style=" " ><?php echo $value['quantity'].' '.$value['unitName']; $tq += $value['quantity']; ?></td>
                              <td style=" " ><?php echo number_format($value['sprice'], 2);; ?></td>
                              <td style=" " ><?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                           <tbody>
                                <tr style="color:blue;">
                                    <td colspan="4" style="text-align: right;" ><b>Total Amount :</b></td>
                                    <td><b><?php echo number_format($stotal, 2); ?></b></td>
                                </tr>
                                <?php if($prints['vAmount']!=0){ ?>
                                <tr>
                                    <td colspan="4" style="text-align: right;" ><b>VAT :</b></td>
                                    <td><b><?php echo $prints['vAmount']; ?></b></td>
                                </tr>
                                <?php } if($prints['discountAmount']!=0){ ?>
                                <tr>
                                    <td colspan="4" style="text-align: right;" ><b>Discount :</b></td>
                                    <td><b><?php echo number_format($prints['discountAmount'], 2); ?></b></td>
                                </tr>
                                
                                <?php } ?>
                                <tr style="color:blue;">
                                    <td colspan="4" style="text-align: right;" ><b>Net Amount :</b></td>
                                    <td><b><?php echo number_format((($stotal+$prints['vAmount'])-$prints['discountAmount']), 2); ?></b></td>
                                </tr>
                                <tr style="color:red;">
                                    <td colspan="4" style="text-align: right;" ><b>Previous Due Amount :</b></td>
                                    <td><b><?php echo number_format($prints['pdAmount'], 2); ?></b></td>
                                </tr>
                                <tr style="color:green;">
                                    <td colspan="4" style="text-align: right;" ><b>Paid Amount :</b></td>
                                    <td><b><?php echo number_format($prints['paidAmount'], 2); ?></b></td>
                                </tr>
                                <tr style="color:red;">
                                    <td colspan="4" style="text-align: right;" ><b>Due Amount :</b></td>
                                    <td><b><?php echo number_format($prints['dueamount'], 2); ?></b></td>
                                </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php if($prints['note']){?>
                    <div style="padding:10px;">
                        <p><b>Note:</b> <?php echo $prints['note'];?></p>
                    </div>
                    <?php } if($prints['terms']){?>
                    <div style="padding:10px;">
                        <p><b style="color:blue;">Terms and Conditions:</b> <?php echo $prints['terms'];?></p>
                    </div>
                    <?php } ?>
                    
                  
                    <div class="row" id="printOnly" style="bottom:0;position: fixed;width:100%;">
              
                      <div class="col-md-12 col-12" style="text-align: center;">
                          <br><br>
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p> Customer </p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p> Prepared By </p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p> Verified By</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p> Authorized By</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row no-print" >
                    <div class="col-12" style="text-align: center;">
                    <a href="<?=base_url('printPSale/'.$this->uri->segment(2,0))?>"
                                            class="btn btn-primary"><i class="fas fa-print"></i> POS Print</a>
                      <a href="javascript:void(0)" class="btn btn-primary" onclick="printDiv('print')" ><i class="fas fa-print"></i> Print</a>
                      <a href="<?php echo site_url('newSale') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Back</a>
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
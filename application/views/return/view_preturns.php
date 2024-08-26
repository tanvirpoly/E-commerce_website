<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>
<style>
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
            <h1>Return</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Return</li>
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
                <h3 class="card-title">Return Information</h3>
              </div>

              <div class="card-body">
                <div class="invoice p-3 mb-3">
                  <div id="print">
                    <div class="row invoice-info">
                      <div class="col-sm-4 col-md-4 col-xs-4 invoice-col">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="width: 100%;height:auto;" alt='logo'><?php } ?>
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
                    <div class="row invoice-info">
                        <div class="col-md-4 col-sm-4 col-4">
                        <table class="table">
                            <tbody>
                              <tr class="gradeX">      
                                <td><b>Date # </b></td>
                                <td><?php echo date('d-m-Y', strtotime($returns['prDate'])); ?></td>
                              </tr>
                              <tr class="gradeX">      
                                <td><b>Return Invoice # </b></td>
                                <td><?php echo $returns['prCode']; ?></td>
                              </tr>
                              <tr class="gradeX">      
                                <td><b>Purchase Inv. # </b></td>
                                <td><?php echo $returns['challanNo']; ?></td>
                              </tr>   
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-4 col-sm-4 col-4">
                          <div class="inv" style="  background-color: #f2f2f2; padding: 30px 0px; margin: 0px 35px; border-radius: 10rem; color: black;text-align: center;">
                              <h4>Purchase Return</h4>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-4">
                          <table class="table">
                            <tbody>
                              <tr class="gradeX">      
                                <td><b>Supplier Name # </b></td>
                                <td><?php echo $returns['supplierName']; ?></td>
                              </tr>
                              <tr class="gradeX">      
                                <td><b>Address # </b></td>
                                <td><?php echo $returns['address']; ?></td>
                              </tr> 
                              <tr class="gradeX">      
                                <td><b>Contact No # </b></td>
                                <td><?php echo $returns['mobile']; ?></td>
                              </tr>
                                
                            </tbody>
                          </table>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#SN.</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            foreach ($rproduct as $value) {
                            $i++;
                            ?>
                            <tr style="min-height: 200px;">
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value['productName']; ?></td>
                              <td><?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                              <td><?php echo number_format($value['pPrice'], 2); ?></td>
                              <td><?php echo number_format($value['tPrice'], 2); $stotal += $value['tPrice']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr>
                              <td colspan="2" align="right" >Total Amount</td>
                              <td><?php echo $tq; ?></td>
                              <td></td>
                              <td><?php echo number_format($stotal, 2); ?></td>
                            </tr>
                          </tbody>
                          <tbody style="text-align: center;">
                            <tr>
                              <?php $twa = abs($stotal); ?>
                              <td colspan="5">( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumber($twa); ?> )</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  
                    <?php if($returns['note'] != null){ ?>
                    <div class="row" style="padding:10px;">
                      <p class="">Note / Remarks&nbsp;:&nbsp;</p>
                      <p class=""><?php echo $returns['note']; ?></p>
                    </div>
                    <?php } ?>
                    <div class="row" id="printOnly" style="bottom:0;position: fixed;width:100%;">
                      <div class="col-md-12 col-12" style="text-align: center;">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p>Supplier</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p>Prepared By</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p>Verified By</p>
                          </div>
                          <div class="col-md-3 col-sm-3 col-3">
                            <p>------------------------------</p>
                            <p>Authorized By</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row no-print" >
                    <div class="col-12" style="text-align: center;">
                      <a href="javascript:void(0)" class="btn btn-primary" onclick="printDiv('print')" ><i class="fas fa-print"></i> Print</a>
                      <a href="<?php echo site_url('pReturn') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Back</a>
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
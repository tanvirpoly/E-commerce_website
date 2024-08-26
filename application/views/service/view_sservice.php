<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale Service</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">SALE SERVICE</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sale Service</h3>
              </div>

              <div class="card-body">
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
                          <div class="col-md-4 col-sm-4 col-4">
                            <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Date # </b></td>
                                    <td><?php echo date('d-m-Y', strtotime($service['ssDate'])); ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Invoice # </b></td>
                                    <td><?php echo $service['ssCode']; ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Company # </b></td>
                                    <td><?php if($company){ ?><b><?php echo $company->com_name; ?></b><?php } ?></td>
                                  </tr>   
                                </tbody>
                              </table>
                          </div>
                          <div class="col-md-4 col-sm-4 col-4">
                              <div class="inv" style="  background-color: #f2f2f2; padding: 30px 0px; margin: 0px 35px; border-radius: 10rem; color: black;text-align: center;">
                                  <h4>Sale Invoice</h4>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-4">
                              <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Customer Name # </b></td>
                                    <td><?php echo $service['customerName']; ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Address # </b></td>
                                    <td><?php echo $service['address']; ?></td>
                                  </tr> 
                                  <tr class="gradeX">      
                                    <td><b>Contact No # </b></td>
                                    <td><?php echo $service['mobile']; ?></td>
                                  </tr>
                                    
                                </tbody>
                              </table>
                          </div>
                    </div>
                      <!---->
                      
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>SERVICE NAME</th>
                              <th>QTY</th>
                              <th>UNIT PRICE</th>
                              <th>AMOUNT</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            $stotal = 0;
                            foreach ($sservice as $value){
                            $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $value['siName']; ?><br><?php echo $value['siDetails']; ?></td>
                              <td><?php echo round($value['quantity']); ?></td>
                              <td><?php echo number_format($value['sprice'], 2); ?></td>
                              <td><?php echo number_format($value['tPrice'], 2); $stotal += $value['tPrice']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr>
                              <td colspan="3">
                                <?php echo $service['terms']; ?>
                              </td>
                              <td colspan="2">
                                <table class="table table-striped">
                                  <tr>
                                    <td align="right">TOTAL</td>
                                    <td><?php echo number_format($stotal, 2); ?></td>
                                  </tr>
                                  <tr>
                                    <td align="right">PAID</td>
                                    <td><?php echo number_format($service['pAmount'], 2); ?></td>
                                  </tr>
                                  <tr  style="color:red;">
                                    <td align="right">DUE</td>
                                    <td><?php echo number_format(($stotal-$service['pAmount']), 2); ?></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                          <tbody style="text-align: left;">
                            <tr>
                              <?php $twa = round(abs($stotal)); ?>
                              <td colspan="5">( IN WORDS&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumber($twa); ?> )</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
     
                  </div>

                  <div class="row no-print" >
                    <div class="col-12" style="text-align: center;">
                      <a href="javascript:void(0)" class="btn btn-primary" onclick="printDiv('print')" ><i class="fas fa-print"></i> PRINT</a>
                      <a href="<?php echo site_url('serviceSale') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> BACK</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
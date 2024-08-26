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
            <h1>Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Order</li>
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
                <h3 class="card-title">Order Information</h3>
              </div>

              <div class="card-body">
                <div class="invoice p-3 mb-3">
                  <div id="print">
                    <div class="row invoice-info">
                      <div class="col-sm-2 col-2 invoice-col">
                        <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height:100px; width: 100%;"><?php } ?>
                      </div>
                      <div class="col-sm-7 col-7 invoice-col">
                        <address style="margin-top: 60px;">
                          <?php if($company){ ?><h3><b><?php echo $company->com_name; ?></b></h3><?php } ?>
                          <p>
                            <b><i class="fa fa-map-marker"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_address; ?><?php } ?>
                          </p>
                          <!--<p>-->
                          <!--  <b><i class="fa fa-phone"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_mobile; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-envelope"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_email; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-globe"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_web; ?><?php } ?><br>-->
                          <!--  <b><i class="fa fa-map-marker"></i></b>&nbsp;&nbsp;<?php if($company){ ?><?php echo $company->com_address; ?><?php } ?><br>-->
                          <!--</p>-->
                        </address>
                      </div>
                      <div class="col-sm-3 col-3 invoice-col text-center">
                        <h4 style="margin-top: 30px;">Delivery Challan</h4>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-7 col-sm-7 col-8">
                        <table class="table table-bordered" >
                          <thead >
                            <tr >
                              <th style="width: 20%;">Customer</th>
                              <td style="width: 80%;"><?php echo $quotation['customerName']; ?></td>
                            </tr>
                            <tr>
                              <th >Mobile</th>
                              <td ><?php echo $quotation['mobile']; ?></td>
                            </tr>
                            <tr>
                              <th >Address</th>
                              <td ><?php echo $quotation['address']; ?></td>
                            </tr>
                            <tr>
                              <th >Email</th>
                              <td ><?php echo $quotation['email']; ?></td>
                            </tr>
                          </thead>
                        </table>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Order#</th>
                              <td><?php echo $quotation['oCode']; ?></td>
                            </tr>
                            <tr>
                              <th>Order Date</th>
                              <td><?php echo date('d-m-Y', strtotime($quotation['oDate'])); ?></td>
                            </tr>
                            <tr>
                              <th>Client ID</th>
                              <td><?php echo $quotation['cus_id']; ?></td>
                            </tr> 
                            
                            
                            <?php 
                                $query = $this->db->select('*')
                                  ->from('users')
                                  ->where('uid',$quotation['sName'])
                                  ->get()
                                  ->row();
                                
                            ?>
                            
                            
                            <tr>
                              <th>Delivery Man</th>
                              <td><?php if(isset($query))
                              {
                                  
                                  echo  $query->name;
                                  
                                  
                              } 
                              
                              
                              ?></td>
                            </tr>  
                          </thead>
                        </table>
                      </div>
                    </div>
                    
                    
                    
                    
                    <!--<div class="col-md-12 col-sm-12 col-12">-->
                    <!--<div class="row">-->
                    <!--    <div style="width: 100%;">-->
                    <!--      <h4 class="" style="background-color: #132C54 !important; color: #fff; padding: 5px;"><b>SHIP TO</b></h4>-->
                    <!--      <table class="table table-bordered table-responsive">-->
                    <!--        <tbody style="line-height: 5px !important;">-->
                    <!--          <tr class="gradeX">      -->
                    <!--            <td><b>Name : </b></td>-->
                    <!--            <td><?php echo $quotation['customerName']; ?></td>-->
                    <!--          </tr>-->
                    <!--          <tr class="gradeX">      -->
                    <!--            <td><b>Company : </b></td>-->
                    <!--            <td><?php echo $quotation['customerCompany']; ?></td>-->
                    <!--          </tr>-->
                    <!--          <tr class="gradeX">      -->
                    <!--            <td><b>Address : </b></td>-->
                    <!--            <td><?php echo $quotation['address']; ?></td>-->
                    <!--          </tr>-->
                    <!--          <tr class="gradeX">      -->
                    <!--            <td><b>Mobile : </b></td>-->
                    <!--            <td><?php echo $quotation['mobile']; ?></td>-->
                    <!--          </tr>   -->
                    <!--        </tbody>-->
                    <!--      </table>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 5%;">#SN.</th>
                                <th style="width: 20%;" class="d-none d-sm-table-cell">Item</th>
                               
                                <th style="width: 15%;" class="d-none d-sm-table-cell">Quantity</th>
                                <th style="width: 15%;" class="d-none d-sm-table-cell">Unit Name</th>
                                <th style="width: 15%;" class="d-none d-sm-table-cell">Unit Price</th>
                                <th style="width: 15%;" class="d-none d-sm-table-cell">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $i = 0;
                              $tq = 0;
                              $stotal = 0;
                              $One = 0;
                              $two = 0;
                              $total = 0;
                              foreach ($pquotation as $value) {
                                $i++;
                                ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td class="d-none d-sm-table-cell"><?php echo $value['productName']; ?></td>
                                  <td class="d-none d-sm-table-cell"><?php echo round($value['oQnt']); $tq += $value['oQnt']; ?></td>
                                  <td class="d-none d-sm-table-cell"><?php echo $value['unitName']; ?></td>
                                  <td class="d-none d-sm-table-cell"><?php echo number_format($value['oPrice'], 2); ?></td>
                                  <td class="d-none d-sm-table-cell"><?php echo number_format($value['tPrice'], 2); $stotal += $value['tPrice']; ?></td>
                                </tr>
                              <?php } ?>
                              
                              <tr>
                                <td colspan="5" style="text-align: right;"><b>Sub Total :</b></td>
                                <td><b><?php echo number_format($stotal, 2); ?></b></td>
                              </tr>
                              <tr>
                                
                                
                                <td colspan="5" style="text-align: right;"><b>Shiping Cost :</b></td>
                                 <td><b><?php echo $quotation['scost']; $One+=$quotation['scost'] ?></b></td>
                              </tr>
                              <tr>
                                <td colspan="5" style="text-align: right;"><b>Due :</b></td>
                                <td><b>
                                <?php 
                                $value = $stotal + $One; 
                                echo number_format($value, 2);  
                                $two+=$value ;
                                ?>
                                </b></td>
                              </tr>
                              <tr>
                                <!--<td style="width: 20%;" class="d-none d-sm-table-cell"><b>Shiping Method</b></td>-->
                                <!--<td><b><?php echo $quotation['shmethod']?></b></td>-->
                               
                                <td colspan="5" style="text-align: right;"><b>Paid :</b></td>
                                <td><b><?php echo $quotation['paidAmount']?></b></td>
                              </tr>
                              <tr>
                                <td colspan="5" style="text-align: right;"><b>Total :</b></td>
                                <td><b><?php echo  $two - $quotation['paidAmount'];  ?></b></td>
                              </tr>
                              <!--<tr>-->
                              <!--  <td colspan="5" style="text-align: right;"><b>Paid Amount :</b></td>-->
                              <!--  <td><b><?php echo number_format($quotation['paidAmount'], 2); ?></b></td>-->
                              <!--</tr>-->
                              <!--<tr>-->
                              <!--  <td colspan="5" style="text-align: right;"><b>Due Amount :</b></td>-->
                              <!--  <td><b><?php echo number_format($quotation['dueAmount'], 2); ?></b></td>-->
                              <!--</tr>-->
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                        
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12">
                        <div class="form-group col-md-12 col-sm-12 col-12">
                          Note / Remarks
                        </div>
                        <?php if($quotation['note']){ ?>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                          <?php echo $quotation['note']; ?>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                        
                    <!--<div class="col-md-12 col-sm-12 col-12" style="text-align: center;">-->
                    <!--  <div class="row">-->
                    <!--    <div class="col-md-6 col-sm-6 col-6">-->
                    <!--      <p>------------------------------</p>-->
                    <!--      <p>Authorized Signature</p>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-6 col-sm-6 col-xs-6">-->
                    <!--      <p>------------------------------</p>-->
                    <!--      <p>Signature & Company Stamp</p>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
                  <a href="<?=base_url('printOrderPSale/'.$this->uri->segment(2,0))?>"
                                            class="btn btn-primary"><i class="fas fa-print"></i> POS Print</a>
                    <a href="javascript:void(0)" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
                    <a href="<?php echo site_url('Order') ?>" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Back</a>
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
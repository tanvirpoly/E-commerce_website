<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Voucher</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Voucher</li>
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
                <h3 class="card-title">Voucher Information</h3>
              </div>

              <div class="card-body">
                <div id="print">
                  <div class="col-sm-12 col-md-12 col-12">
                      <?php if($company){ ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <div style="display: flex;align-items: center;">
                                        <img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="height: 80px; width:auto; margin-right: 25px;">
                                    </div>
                                    <div style="text-align:center;">
                                        <h3><b><?php echo $company->com_name; ?></b></h3>
                                        <span><?php echo $company->com_address; ?></span><br>
                                        Email :&nbsp;<?php echo $company->com_email; ?>
                                        <?php echo $company->com_mobile; ?><br>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        <hr style="width: 100%; text-align: left; margin-left: 0; background-color: #4f7893;">
                   <?php
                    $i = 0;
                            foreach ($voucherp as $value) {
                            $i++;
                   $supplier = $this->db->select('supplierName')->from('suppliers')->where('supplierID',$value['vuid'])->get()->row();
                              
                      if($supplier)
                        {
                        $sname = $supplier->supplierName;
                        }
                      else
                        {
                        $sname = 'N/A';
                        }
                    }
                                
                    if($voucher['vauchertype']=='Credit Voucher')
                    {
                        $str= 'Money Receipt';
                    }
                    else $str= $voucher['vauchertype'];
                   ?>
                    
                       <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12" style="display:flex;">
                                    <div class="col-sm-4 col-md-4 col-xs-4">
                                        <b>No:</b> <?php echo $voucher['invoice']; ?><br>
                                     <?php if($voucher['vauchertype']=='Credit Voucher'){ ?>   
                                     <b>Received From:</b> <?php echo $voucher['customerName'].' [ '.$voucher['customerCompany'].' ]'; }?>
                                     <?php if($voucher['vauchertype']=='Supplier Pay'){ ?>
                                     <b>Payment To:</b> <?php echo $sname; }?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-4" style="text-align:center;margin-top:10px;">
                                        <span class="receipt" style="background-color: #dee2e6 !important;color:black;padding: 20px;border-radius: 22px;"><?php echo $str; ?></span>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-4" style="text-align:right;">
                                        <b>Date:</b> <?php echo date('d-m-Y',strtotime($voucher['voucherdate'])); ?><br>
                                        <b>Payment Mode:</b> <?php echo $voucher['accountType']; ?>
                                    </div>
                                </div>
                            </div>
                    <br><br>
                    
                        
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12" >
                        <table class="table table-bordered table-striped">
                         <?php    if($voucher['vauchertype']=='Debit Voucher'){ ?>
                          <thead style="background-color: #fff; color: #000;">
                            <tr>
                              <th style="width: 5%;">#SN.</th>
                              <th>Type</th>
                              <th>Details</th>
                              <th style="width: 20%;">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            foreach ($voucherp as $value) {
                            $i++;
                            $cost = $this->db->select('costName')->from('cost_type')->where('ct_id',$voucher['costType'])->get()->row();
                            if($cost)
                                {
                                $vptype = $cost->costName;
                                }
                              else
                                {
                                $vptype = 'N/A';
                                }
                            ?>
                            <tr style="background-color: #fff; color: #000;" >
                              <td><?php echo $i; ?></td>
                              <td><?php echo $vptype; ?></td>
                              <td><?php echo $value['particulars']; ?></td>
                              <td><?php echo number_format($value['amount'], 2); ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr style="background-color: #fff; color: #000;">
                                <td colspan="3" align="right" >Total Price</td>
                                <td><?php echo number_format($voucher['totalamount'], 2); ?></td>
                            </tr>
                          </tbody>
                          <tbody style="">
                            <tr style="text-align: center; background-color: #fff; color: #000;">
                                <?php $twa = abs($voucher['totalamount']); ?>
                                <td colspan="4">( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumber($twa); ?> )</td>
                            </tr>
                          </tbody>
                        <?php } 
                        else { ?>
                        <thead style="background-color: #fff; color: #000;">
                            <tr>
                              <th style="width: 5%;">#SN.</th>
                              <th>Details</th>
                              <th style="width: 20%;">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 0;
                            foreach ($voucherp as $value) {
                            $i++;
                          
                            ?>
                            <tr style="background-color: #fff; color: #000;" >
                              <td><?php echo $i; ?></td>
                              <!--<td><?php echo $vptype; ?></td>-->
                              <td><?php echo $value['particulars']; ?></td>
                              <td><?php echo number_format($value['amount'], 2); ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tbody>
                            <tr style="background-color: #fff; color: blue;font-weight:bold;">
                                <td colspan="2" align="right" >Total Price</td>
                                <td><?php echo number_format($voucher['totalamount'], 2); ?></td>
                            </tr>
                          </tbody>
                          <tbody style="">
                            <tr style="text-align: center; background-color: #fff; color: #000;">
                                <?php $twa = abs($voucher['totalamount']); ?>
                                <td colspan="3" >( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumber($twa); ?> )</td>
                            </tr>
                          </tbody>
                          <?php } ?>
                            </table>
                        </div>
                        </div><br>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php if($voucher['reference'] != NULL){ ?>
                              <strong>Notes</strong>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $voucher['reference']; ?>
                              <?php } ?>
                            </div>
                        </div><br>

                        <div class="col-md-12 col-sm-12 col-12" style="text-align: center;">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-4">
                                    <p>------------------------------</p>
                                    <p>Approved By</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4">
                                    <p>------------------------------</p>
                                    <p>Paid By</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4">
                                    <p>------------------------------</p>
                                    <p>Received By</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-12" style="text-align: center; margin-top: 20px">
                  <a href="javascript:void(0)" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                  <a href="<?php echo site_url('Voucher') ?>" class="btn btn-danger" ><i class="fa fa-arrow-left"></i> Back</a>
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
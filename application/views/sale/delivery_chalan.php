<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

    <style>
        @media print{
        .thwprint:after {
          display: none !important;
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
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
                          
                          <div class="col-sm-4 invoice-col">
                               <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Date # </b></td>
                                    <td><?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Invoice # </b></td>
                                    <td><?php echo $prints['invoice_no']; ?></td>
                                  </tr>
                                  <tr class="gradeX">      
                                    <td><b>Client ID # </b></td>
                                    <td><?php echo $prints['cus_id']; ?></td>
                                  </tr>   
                                </tbody>
                              </table>
                          </div>
                         
                          <div class="col-md-4 col-sm-4 col-4">
                            <div class="inv" style="background-color: #f2f2f2; padding: 5% 0; margin: 0 5%; border-radius: 10px; color: black; text-align: center;">
                                <h4>Challan Invoice</h4>
                            </div>
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
                      <!---->

                    <div class="row">
                      <div class="col-12">
                         <div class= "table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead >
                            <tr>
                              <th>#SN.</th>
                              <th>Discription</th>
                              <th>Quantity</th>
                            </tr>
                          </thead>
                          <tbody >
                            <?php
                            $i = 0;
                            $tq = 0;
                            $stotal = 0;
                            foreach ($salesp as $value){
                            $i++;
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <!--<td style="border: 2px solid black !important;" ><?php echo $value['productcode']; ?></td>-->
                              <td><?php echo $value['pName']; ?><br><?php echo $value['warranty']; ?></td>
                              <td><?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="margin: 10px;">
                          <?php if($prints['note'] != null){ ?>
                          <p><b>Note / Remarks&nbsp;:&nbsp;</b><?php echo $prints['note']; ?></p>
                          <?php } ?>
                        </div>
                    
                    
                    <div class="row" id="header" style="display: none">
                      <div class="col-md-12 col-12" style="position: absolute;margin-top:30px;">
                        
                          <div class="col-md-12 col-12" >
                            <div class="row">
                              <div class="col-md-6 col-sm-6 col-6" style="text-align: center;">
                                <p>------------------------------</p>
                                <p>Received By</p>
                              </div>
                              <div class="col-md-6 col-sm-6 col-6" style="text-align: center;">
                                <p>------------------------------</p>
                                <p>Authorized By</p>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

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

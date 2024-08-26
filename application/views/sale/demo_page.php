<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

<div class="content-wrapper">
  <!-- Main content -->
  
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
    
    <section class="invoice">
    <div class="row">
      <div class="col-sm-4 invoice-col">
          <?php if($company){ ?><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" style="width: 100%;height:auto;"><?php } ?>


      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
          To
        <address>
                <?php echo $company->com_address; ?><br>
                <?php echo $company->com_email; ?><br>
                <?php echo 'Contact No.: '.$company->com_mobile; ?><br>
                <?php echo $company->com_web; ?><br>
        </address>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
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
                          
                          <div class="col-sm-12 invoice-col">
                              <table class="table">
                                <tbody>
                                  <tr class="gradeX">      
                                    <td><b>Customer# </b></td>
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
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
       
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->


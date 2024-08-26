<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

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

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quotation List</h3>
                <?php if($_SESSION['newquotation'] == 1){ ?>
                <a href="<?php echo site_url('newQuotation'); ?>" class="btn btn-primary" style="float: right;" ><i class="fa fa-plus"></i>&nbsp;New Quotation</a>
                <?php } ?>
              </div>

              <div class="card-body">
                <table id="example" class="table table-responsive table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th style="width: 15%;">Q No.</th>
                      <th style="width: 15%;">Date</th>
                      <th style="width: 25%;">Customer</th>
                      <!-- <th style="width: 20%;">Product</th> -->
                      <th style="width: 15%;">Quantity</th>
                      <!-- <th style="width: 10%;">Unit Price</th> -->
                      <th style="width: 15%;">Total Price</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($quotation as $value) {
                    $id = $value['qutid'];
                    $i++;
                    $pp = $this->db->select('SUM(quantity) as total')
                                  ->from('quotation_product')
                                  ->where('qutid',$value['qutid'])
                                  ->get()
                                  ->row();
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value['qinvoice']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($value['quotationDate'])) ?></td>
                      <td><?php echo $value['customerName']; ?></td>
                      <!-- <td>
                        <?php foreach ($pp as $p) { ?>
                        <?php echo $p->productName.'-'.$p->productcode; ?><br>
                        <?php } ?>
                      </td> -->
                      <td>
                        <!-- <?php foreach ($pp as $p) { ?>
                        <?php echo $p->quantity; ?><br>
                        <?php } ?> -->
                        <?php echo $pp->total; ?>
                      </td>
                     <!--  <td>
                        <?php foreach ($pp as $p) { ?>
                        <?php echo number_format($p->salePrice, 2); ?><br>
                        <?php } ?>
                      </td> -->
                      <td><?php echo number_format($value['totalPrice'], 2) ?></td>
                      <td>
                        <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="<?php echo site_url('viewQuotation').'/'.$id; ?>"><i class="fa fa-eye"></i> View</a></li>
                              <li class="dropdown-divider"></li>
                              <?php if($_SESSION['editquotation'] == 1){ ?>
                              <li class="dropdown-item"><a href="<?php echo site_url('editQuotation').'/'.$id; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <?php } if($_SESSION['deletequotation'] == 1){ ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Quotation/delete_quotation').'/'.$id; ?>"><i class="fa fa-trash"></i> Delete</a></li>
                              <?php } ?> 
                            </ul>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    
<?php $this->load->view('footer/footer'); ?>
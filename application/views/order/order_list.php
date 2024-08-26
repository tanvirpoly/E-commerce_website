<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

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
                <h3 class="card-title">Order List</h3>
                <!--<a href="<?php echo site_url('newOrder'); ?>" class="btn btn-primary" style="float: right;" ><i class="fa fa-plus"></i>&nbsp;New Order</a>-->
              </div>

              <div class="card-body">
                <table id="example" class="table table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>Order No.</th>
                      <th>Date</th>
                      <th>Customer</th>
                      <th>Price</th>
                      <th>Charge</th>
                      <th>Total</th>
                      <th>Area</th>
                      <th>Delivery Person</th>
                      <th>Status</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach($order as $value) {
                    $id = $value['oid'];
                    $i++;
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value['oCode']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($value['oDate'])) ?></td>
                      <td><?php echo $value['customerName']; ?><br><?php echo $value['mobile'].'<br>'.$value['address']; ?></td>
                      <td><?php echo number_format($value['tAmount'], 2) ?></td>
                      <td><?php echo number_format($value['scost'], 2) ?></td>
                      <td><?php echo number_format(($value['tAmount']+$value['scost']), 2) ?></td>
                      <td><?php echo $value['dArea']; ?></td>
                      <td><?php echo $value['name']; ?></td>
                      <td>
                        <?php if($value['status'] == 1){ ?>
                        <?php echo 'On Process'; ?>
                        <?php } else if($value['status'] == 2){ ?>
                        <span style="color: green;"><?php echo 'Order Delivery'; ?></span>
                        <?php } else if($value['status'] == 5){ ?>
                        <span style="color: red;"><?php echo 'Canceled'; ?></span>
                        <?php } else{ ?>
                        <?php echo 'N/A'; ?>
                        <?php } ?>
                      </td>
                      <td>
                        <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="<?php echo site_url('viewOrder').'/'.$id; ?>"><i class="fa fa-eye"></i> View</a></li>
                              <?php 
                                if($_SESSION['role'] != 8){ 
                                    if($value['status'] == 1){ 
                               ?>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('editOrder').'/'.$id; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('saleOrder').'/'.$id; ?>"><i class="fa fa-plus-circle"></i> Delivery</a></li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Order/delete_Order').'/'.$id; ?>" onclick="return confirm('Are you sure you want to delete this Order ?');"><i class="fa fa-trash"></i> Delete</a></li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Order/cancel_Order').'/'.$id; ?>" onclick="return confirm('Are you sure you want to cancel this Order ?');"><i class="fa fa-ban"></i> Cancel</a></li>
                              <?php } } ?>
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
<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Balance Adjustment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Balance Adjustment</li>
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
                <h3 class="card-title">Balance Adjustment List</h3>
                <a href="<?php echo site_url('balance_adjustment') ?>" class="btn btn-primary" style="float: right" ><i class="fa fa-plus"></i> New Balance Adjustment</a>
              </div>

              <div class="card-body">
                <table id="example" class="table table-bordered" style="width:100%;" >
                    <thead>
                        <tr>
                            <th style="width: 5%;">SN</th>
                            <th>DATE</th>
                            <th>ADJUSTMENT TYPE</th>
                            <th>AMOUNT</th>
                            <th>NOTE</th>
                            <th>ACCOUNT TYPE</th>
                            <th>STAFF NAME</th>
                            <th>ACCOUNT NO</th>
                            <th>ACTION</th>
                            <!-- <th style="width: 10%;">OPTION</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($adjustment as $value) {
                        $i++;
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['date']; ?></a></td>
                            <td><?php echo $value['adjustment_type']; ?></td>
                            <td><?php echo $value['amount']; ?></td>
                            <td><?php echo $value['note']; ?></td>
                            <td><?php echo $value['accountType']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td>
                            <?php if($value['accountType'] == 'Cash') { ?>
                              <?php echo $value['cashName']; ?>
                              <?php } ?>

                            <?php if($value['accountType'] == 'Bank') { ?>
                              <?php echo $value['baAccountName']; ?>
                              <?php } ?>

                              <?php if($value['accountType'] == 'Mobile') { ?>
                                <?php echo $value['moAccountName']; ?>
                            <?php } ?>
                            </td>                           
                             <td><?php if($value['approve'] == 0){ ?><li class="dropdown-item"><a href="<?php echo site_url('CashAccount/invest_approve').'/'.$value['id']; ?>"><i class="fa fa-check"></i> Approve</a></li><?php } ?></td>
                      
                            <!-- <td><?php echo $value['regby']; ?></td> -->
                            <!-- <td>
                            <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                            <?php if($_SESSION['view_voucher'] == '1') { ?>
                              <li class="dropdown-item"><a href="<?php echo site_url('viewVoucher').'/'.$value['vuid']; ?>"><i class="fa fa-eye"></i> View</a></li>
                              
                            <?php } ?>
                             <?php if($value['status']==0){ ?>
                            <?php if($_SESSION['edit_voucher'] == '1') { ?>
                            <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('editVoucher').'/'.$value['vuid']; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                            <?php } ?>
                            
                           
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Voucher/voucher_approve').'/'.$value['vuid']; ?>" onclick="return confirm('Are you sure you want to Approve this Voucher ?');" ><i class="fa fa-check"></i> Approve</a></li>
                            <?php } ?>
                            <?php if($_SESSION['delete_voucher'] == '1') { ?>
                             <li class="dropdown-divider"></li>

                              <li class="dropdown-item"><a href="<?php echo site_url('Voucher/voucher_delete').'/'.$value['vuid']; ?>" onclick="return confirm('Are you sure you want to Delete this Voucher ?');" ><i class="fa fa-trash"></i> Delete</a></li>
                            <?php } ?> 
                            </ul>
                          </div>
                        </div>
                            </td> -->
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
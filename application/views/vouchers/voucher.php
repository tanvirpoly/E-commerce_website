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
                <h3 class="card-title">Voucher List</h3>
                <?php if($_SESSION['newvoucher'] == 1){ ?>
                <a href="<?php echo site_url('newVoucher') ?>" class="btn btn-primary" style="float: right" ><i class="fa fa-plus"></i> New Voucher</a>
                <?php } ?>
              </div>

              <div class="card-body table-responsive">
                <table id="example" class="table table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>Invoice</th>
                      <th>Date</th>
                      <th>Vaucher Type</th>
                      <th>Emplyoee</th>
                      <th>Participant</th>
                      <th>Particulars</th>
                      <!-- <th>Customer</th>
                      <th>Supplier</th> -->
                      <!--<th>Reference</th>-->
                      <th>Amount</th>
                      <th>Status</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($vaucher as $value) {
                    $i++;
                    $cid = $value['customerID'];
                    $eid = $value['empid'];
                    $csid = $value['costType'];
                    $sid = $value['supplier'];

                    $customer = $this->db->select('cus_id,customerName')
                                        ->from('customers')
                                        ->where('customerID',$cid)
                                        ->get()
                                        ->row();

                    $employee = $this->db->select('empid,name')
                                        ->from('users')
                                        ->where('empid',$eid)
                                        ->get()
                                        ->row();
                                        
                    $expense = $this->db->select('costName')
                                        ->from('cost_type')
                                        ->where('ct_id', $csid)
                                        ->get()
                                        ->row();

                    $supplier = $this->db->select('sup_id,supplierName')
                                        ->from('suppliers')
                                        ->where('supplierID',$sid)
                                        ->get()
                                        ->row();
                                        
                    $voucherp = $this->db->select('vaucher_particular.particulars')
                                  ->from('vaucher_particular')
                                //   ->join('products','products.productID = purchase_product.productID','left')
                                  ->where('vuid',$value['vuid'])
                                  ->get()
                                  ->result();
                    
                    ?>
                    <tr class="gradeX">
                      <td><?php echo $i; ?></td>
                      <td><a href="<?php echo site_url('viewVoucher').'/'.$value['vuid']; ?>"><?php echo $value['invoice']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($value['voucherdate'])); ?></td>
                      <td><?php echo $value['vauchertype']; ?></td>
                      <td>
                          <?php if($employee){ ?>
                          <?php echo $employee->name; ?>
                          <?php } else{ ?>
                          <?php echo 'N/A'; ?>
                          <?php } ?>
                      </td>
                       <td>
                          <?php 
                          $party='N/A';
                          if($customer){ 
                           $party='Cus: '.$customer->customerName; 
                           } 
                          else if($supplier){ 
                          $party='Sup: '. $supplier->supplierName;
                          } 
                          else if($expense){ 
                          $party='Exp: '. $expense->costName;
                          }
                          echo $party;
                          ?>
                      </td> 
                      <td><?php foreach ($voucherp as $p) { ?>
                        <?php echo $p->particulars; ?><br>
                        <?php } ?></td>
                      <!--<td><?php echo $value['reference']; ?></td>-->
                      <td><?php echo number_format($value['totalamount'], 2); ?></td>
                      <td><?php if($value['status'] == 1){ ?><span style="color: green;"><?php echo "Approve"; ?></span><?php } else{ ?><span style="color: red;"><?php echo "Pending";?></span><?php } ?></td>
                      <td>
                        <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="<?php echo site_url('viewVoucher').'/'.$value['vuid']; ?>"><i class="fa fa-eye"></i> View</a></li>
                              <li class="dropdown-divider"></li>
                              <?php if($value['status'] == 0){ ?>
                              <?php if($_SESSION['editvoucher'] == 1){ ?>
                              <li class="dropdown-item"><a href="<?php echo site_url('editVoucher').'/'.$value['vuid']; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <li class="dropdown-divider"></li>
                              <?php } if($_SESSION['deletevoucher'] == 1){ ?>
                              <li class="dropdown-item"><a href="<?php echo site_url('Voucher/voucher_delete').'/'.$value['vuid']; ?>"><i class="fa fa-trash"></i> Delete</a></li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item"><a href="<?php echo site_url('Voucher/voucher_approve').'/'.$value['vuid']; ?>"><i class="fa fa-check"></i> Approve</a></li>
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
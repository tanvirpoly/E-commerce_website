<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Return</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Purchase Return</li>
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
                <h3 class="card-title">Purchase Return List</h3>
                <?php if($_SESSION['newpreturn'] == 1){ ?>
                <a href="<?php echo site_url('newpReturn') ?>" class="btn btn-primary" style="float: right;" ><i class="fa fa-plus"></i> New Purchase Return</a>
                <?php } ?>
              </div>

              <div class="card-body">
                <table id="example" class="table table-responsive table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th>Date</th>
                      <th>R-Inv. No.</th>
                      <th>Supplier</th>
                      <th>Quantity</th>                    
                      <th >Total Price</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($return as $value) {
                    $i++;
                    
                    $rp = $this->db->select('sum(quantity) as total')
                                    ->from('preturns_product')
                                    ->where('prid',$value['prid'])
                                    ->get()
                                    ->row();
                    ?>
                    <tr class="gradeX" style="border: 1px solid #000;">
                      <td><?php echo $i; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['prDate'])); ?></td>
                      <td> <a href="<?php echo site_url('viewpReturn').'/'.$value['prid'] ?>"><?php echo $value['prCode']; ?></td>
                      <td><?php echo $value['supplierName']; ?></td>
                      <td><?php echo $rp->total; ?></td>
                      <td><?php echo number_format($value['totalPrice'], 2); ?></td>
                      <td>
                        <a class=" btn btn-primary btn-xs" href="<?php echo site_url('viewpReturn').'/'.$value['prid'] ?>"><i class="fa fa-eye"></i></a>
                        <?php if($_SESSION['deletepreturn'] == 1){ ?>
                        <!--<a class=" btn btn-success btn-xs" href="<?php echo site_url('editpReturn').'/'.$value['prid'] ?>"><i class="fa fa-edit"></i></a>-->
                        <a href="<?php echo site_url('Returns/delete_preturns').'/'.$value['prid'] ?>" class="btn btn-danger btn-xs" 
                            onclick="return confirm('Are you sure you want to delete this Purchase Return?');"><i class="fa fa-trash"></i></a>
                        <?php } ?>
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
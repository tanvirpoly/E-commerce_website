<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Return</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Sales Return</li>
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
                <h3 class="card-title">Sales Return List</h3>
                <?php if($_SESSION['newsreturn'] == 1){ ?>
                <a href="<?php echo site_url('newReturn') ?>" class="btn btn-primary" style="float: right;" ><i class="fa fa-plus"></i> New Sale Return</a>
                <?php } ?>
              </div>

              <div class="card-body table-responsive">
                <table id="example" class="table table-bordered" >
                  <thead>
                    <tr>
                      <th style="width: 5%;">#SN.</th>
                      <th style="width: 12%;">Date</th>
                      <th style="width: 15%;">R-Inv. No.</th>
                      <th style="width: 18%;">Customer</th>
                      <th style="width: 10%;">Quantity</th>
                      <!-- <th style="width: 10%;">Unit Price</th>-->                     
                      <th style="width: 10%;">Total</th>
                      <th style="width: 10%;">Charge</th>
                      <th style="width: 10%;">Paid</th>
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($return as $value) {
                    $i++;
                    
                    $rp = $this->db->select('sum(quantity) as total')
                                    ->from('returns_product')
                                    ->where('rt_id',$value['returnId'])
                                    ->get()
                                    ->row();
                    ?>
                    <tr class="gradeX" style="border: 1px solid #000;">
                      <td><?php echo $i; ?></td>
                      <td><?php echo date('d-m-Y',strtotime($value['returnDate'])); ?></td>
                      <td><a href="<?php echo site_url('viewReturn').'/'.$value['returnId'] ?>"><?php echo $value['rid']; ?></td>
                      <td><?php echo $value['customerName']; ?></td>
                      <td>
                          <?php echo $rp->total; ?>
                      <!-- <?php foreach ($rp as $p) { ?>
                      <?php echo $p->quantity; ?><br>
                      <?php } ?> -->
                      </td>
                   <!--  <td>
                        <?php foreach ($rp as $p) { ?>
                        <?php echo $p->salePrice; ?><br>
                        <?php } ?>
                    </td> -->
                      <td><?php echo number_format($value['totalPrice'], 2); ?></td>
                      <td><?php echo number_format($value['scAmount'], 2); ?></td>
                      <td><?php echo number_format($value['paidAmount'], 2); ?></td>
                      <td>
                        <a class=" btn btn-info btn-xs" href="<?php echo site_url('viewReturn').'/'.$value['returnId'] ?>"><i class="fa fa-eye"></i></a>
                        <?php if($_SESSION['deletereturn'] == 1){ ?>
                        <!--<a class=" btn btn-success btn-xs" href="<?php echo site_url('editReturn').'/'.$value['returnId'] ?>"><i class="fa fa-edit"></i></a>-->
                        <a href="<?php echo site_url('Returns/delete_returns').'/'.$value['returnId'] ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></a>
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
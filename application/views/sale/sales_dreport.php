<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Due Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Customer Reports</li>
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
                <h3 class="card-title">Customer Reports</h3>
              </div>

              <div class="card-body">
                <div class="col-sm-12 col-md-12 col-12">
                  <div id="print">
                    <div class="col-sm-12 col-md-12 col-12">
                    </div>
                    <div class="">
                      <table id="example" class="table table-bordered" >
                        <thead>
                          <tr>
                            <th style="width: 10%;">ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Previous Due</th>
                            <th>Total Sales</th>
                            <th>Total Paid</th>
                            <th>Total Payment</th>
                            <th>Total Return</th>
                            <th style="width: 10%;">Total Due</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 0;
                          $toa = 0;
                          $tsa = 0;
                          $tpa = 0;
                          $pat = 0;
                          $tra = 0;
                          $tda = 0;
                          foreach ($customer as $value){
                          $i++;

                          $id = $value['customerID'];

                            $tsale = $this->db->select("SUM(totalAmount) as total,SUM(paidAmount) as ptotal,SUM(dueamount) as dtotal")
                                              ->FROM('sales')
                                              ->WHERE('customerID',$id)
                                              ->get()
                                              ->row();

                            $tvpaid = $this->db->select("SUM(totalamount) as total")
                                                ->FROM('vaucher')
                                                ->WHERE('customerID',$id)
                                                ->WHERE('status',1)
                                                ->get()
                                                ->row();

                            $treturn = $this->db->select("SUM(paidAmount) as total")
                                                ->FROM('returns')
                                                ->WHERE('customerID',$id)
                                                ->get()
                                                ->row();
                                                
                          $tdue = ($tsale->dtotal+$value['balance'])-($treturn->total+$tvpaid->total);
                          
                          ?>
                          <tr <?php if($tdue == 0){ ?>Style="display: none;"<?php } ?>>
                            <td><?php echo $value['cus_id']; ?></td>
                            <td><?php echo $value['customerName']; ?></td>
                            <td><?php echo $value['mobile']; ?></td>
                            <td><?php echo $value['balance']; $toa += $value['balance']; ?></td>
                            <td><?php echo number_format($tsale->total, 2); $tsa += $tsale->total; ?></td>
                            <td><?php echo number_format($tsale->ptotal, 2); $tpa += $tsale->total; ?></td>
                            <td><?php echo number_format($tvpaid->total, 2); $pat += $tvpaid->total; ?></td>
                            <td><?php echo number_format($treturn->total, 2); $tra += $treturn->total; ?></td>
                            <td><?php echo number_format($tdue, 2); $tda += $tdue; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3" align="right"><b>Total Amount</b></td>
                            <td><b><?php echo number_format($toa, 2); ?></b></td>
                            <td><b><?php echo number_format($tsa, 2); ?></b></td>
                            <td><b><?php echo number_format($tpa, 2); ?></b></td>
                            <td><b><?php echo number_format($pat, 2); ?></b></td>
                            <td><b><?php echo number_format($tra, 2); ?></b></td>
                            <td><b><?php echo number_format($tda, 2); ?></b></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-12" style="text-align: center; margin-top: 20px">
                    <a href="javascript:void(0)" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
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

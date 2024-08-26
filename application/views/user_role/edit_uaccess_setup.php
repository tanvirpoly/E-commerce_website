<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Access Setup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Access Setup</li>
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
                <h3 class="card-title">User Permission Setup Information</h3>
              </div>

              <div class="card-body">
        		<div class="row">
        		  <div class="col-md-12 col-sm-12 col-12">
              	    <table>
              		  <tbody>
                        <tr>
                          <td>User Type</td>
                          <td>: <?= $user[0]['lavelName']; ?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td>: <?= $user[0]['status']; ?></td>
                        </tr>
                      </tbody>
    				</table>
                  </div>
            
            	  <div class="col-md-12 col-sm-12 col-12">
                    <div class="box-header">
                      <h3 class="box-title">List of Pages And Functions</h3>
                    </div>
                    <div class="box-body">
                      <form action="<?= base_url().'Access_setup/setup_user_access/'.$user[0]['ax_id']; ?>" method="post">
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="product" value="1" <?php if($master[0]['product'] == '1'){ ?>checked<?php } ?>> Products
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="productlist" value="1" <?php if($page[0]['productlist'] == '1'){ ?>checked<?php } ?>> Products List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editproduct" value="1" <?php if($function[0]['editproduct'] == '1'){ ?>checked<?php } ?>> Edit Product</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="storeproduct" value="1" <?php if($function[0]['storeproduct'] == '1'){ ?>checked<?php } ?>> Store Product</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteproduct" value="1" <?php if($function[0]['deleteproduct'] == '1'){ ?>checked<?php } ?>> Delete Product</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="barcodeproduct" value="1" <?php if($function[0]['barcodeproduct'] == '1'){ ?>checked<?php } ?>> Product Barcode</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newproduct" value="1" <?php if($page[0]['newproduct'] == '1'){ ?>checked<?php } ?>> New Product</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="purchase" value="1" <?php if($master[0]['purchase'] == '1'){ ?>checked<?php } ?>> Purchases
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="purchaselist" value="1" <?php if($page[0]['purchaselist'] == '1'){ ?>checked<?php } ?>> Purchases List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editpurchase" value="1" <?php if($function[0]['editpurchase'] == '1'){ ?>checked<?php } ?>> Edit Purchase</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletepurchase" value="1" <?php if($function[0]['deletepurchase'] == '1'){ ?>checked<?php } ?>> Delete Purchase</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newpurchase" value="1" <?php if($page[0]['newpurchase'] == '1'){ ?>checked<?php } ?>> New Purchase</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="sales" value="1" <?php if($master[0]['sales'] == '1'){ ?>checked<?php } ?>> Sales
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="saleslist" value="1" <?php if($page[0]['saleslist'] == '1'){ ?>checked<?php } ?>> Sales List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editsale" value="1" <?php if($function[0]['editsale'] == '1'){ ?>checked<?php } ?>> Edit Sale</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletesale" value="1" <?php if($function[0]['deletesale'] == '1'){ ?>checked<?php } ?>> Delete Sale</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newsale" value="1" <?php if($page[0]['newsale'] == '1'){ ?>checked<?php } ?>> New Sale</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="return" value="1" <?php if($master[0]['return'] == '1'){ ?>checked<?php } ?>> Sales Returns
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="sreturnlist" value="1" <?php if($page[0]['sreturnlist'] == '1'){ ?>checked<?php } ?>> Sales Return List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editreturn" value="1" <?php if($function[0]['editreturn'] == '1'){ ?>checked<?php } ?>> Edit Return</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletereturn" value="1" <?php if($function[0]['deletereturn'] == '1'){ ?>checked<?php } ?>> Delete Return</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newsreturn" value="1" <?php if($page[0]['newsreturn'] == '1'){ ?>checked<?php } ?>> New Sale Return</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="preturn" value="1" <?php if($master[0]['preturn'] == '1'){ ?>checked<?php } ?>> Purchase Returns
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="preturnlist" value="1" <?php if($page[0]['preturnlist'] == '1'){ ?>checked<?php } ?>> Purchase Return List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editpreturn" value="1" <?php if($function[0]['editpreturn'] == '1'){ ?>checked<?php } ?>> Edit Return</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletepreturn" value="1" <?php if($function[0]['deletepreturn'] == '1'){ ?>checked<?php } ?>> Delete Return</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newpreturn" value="1" <?php if($page[0]['newpreturn'] == '1'){ ?>checked<?php } ?>> New Purchase Return</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="quotation" value="1" <?php if($master[0]['quotation'] == '1'){ ?>checked<?php } ?>> Quotation
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="quotationlist" value="1" <?php if($page[0]['quotationlist'] == '1'){ ?>checked<?php } ?>> Quotation List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editquotation" value="1" <?php if($function[0]['editquotation'] == '1'){ ?>checked<?php } ?>> Edit Quotation</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletequotation" value="1" <?php if($function[0]['deletequotation'] == '1'){ ?>checked<?php } ?>> Delete Quotation</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newquotation" value="1" <?php if($page[0]['newquotation'] == '1'){ ?>checked<?php } ?>> New Quotation</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="voucher" value="1" <?php if($master[0]['voucher'] == '1'){ ?>checked<?php } ?>> Voucher
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="voucherlist" value="1" <?php if($page[0]['voucherlist'] == '1'){ ?>checked<?php } ?>> Voucher List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editvoucher" value="1" <?php if($function[0]['editvoucher'] == '1'){ ?>checked<?php } ?>> Edit Voucher</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletevoucher" value="1" <?php if($function[0]['deletevoucher'] == '1'){ ?>checked<?php } ?>> Delete Voucher</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newvoucher" value="1" <?php if($page[0]['newvoucher'] == '1'){ ?>checked<?php } ?>> New Voucher</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="salary" value="1" <?php if($master[0]['salary'] == '1'){ ?>checked<?php } ?>> Salary
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="emppaylist" value="1" <?php if($page[0]['emppaylist'] == '1'){ ?>checked<?php } ?>> Employee Payment List</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editemppayment" value="1" <?php if($function[0]['editemppayment'] == '1'){ ?>checked<?php } ?>> Edit Employee Payment</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteemppayment" value="1" <?php if($function[0]['deleteemppayment'] == '1'){ ?>checked<?php } ?>> Delete Employee Payment</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="newemppay" value="1" <?php if($page[0]['newemppay'] == '1'){ ?>checked<?php } ?>> New Employee Payment</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="users" value="1" <?php if($master[0]['users'] == '1'){ ?>checked<?php } ?>> Users
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="customer" value="1" <?php if($page[0]['customer'] == '1'){ ?>checked<?php } ?>> Customer</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newcustomer" value="1" <?php if($function[0]['newcustomer'] == '1'){ ?>checked<?php } ?>> New Customer</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editcustomer" value="1" <?php if($function[0]['editcustomer'] == '1'){ ?>checked<?php } ?>> Edit Customer</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletecustomer" value="1" <?php if($function[0]['deletecustomer'] == '1'){ ?>checked<?php } ?>> Delete Customer</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="supplier" value="1" <?php if($page[0]['supplier'] == '1'){ ?>checked<?php } ?>> Supplier</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newsupplier" value="1" <?php if($function[0]['newsupplier'] == '1'){ ?>checked<?php } ?>> New Supplier</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editsupplier" value="1" <?php if($function[0]['editsupplier'] == '1'){ ?>checked<?php } ?>> Edit Supplier</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletesupplier" value="1" <?php if($function[0]['deletesupplier'] == '1'){ ?>checked<?php } ?>> Delete Supplier</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="employee" value="1" <?php if($page[0]['employee'] == '1'){ ?>checked<?php } ?>> Employee</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newemployee" value="1" <?php if($function[0]['newemployee'] == '1'){ ?>checked<?php } ?>> New Employee</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editemployee" value="1" <?php if($function[0]['editemployee'] == '1'){ ?>checked<?php } ?>> Edit Employee</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteemployee" value="1" <?php if($function[0]['deleteemployee'] == '1'){ ?>checked<?php } ?>> Delete Employee</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="user" value="1" <?php if($page[0]['user'] == '1'){ ?>checked<?php } ?>> User</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newuser" value="1" <?php if($function[0]['newuser'] == '1'){ ?>checked<?php } ?>> New User</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="edituser" value="1" <?php if($function[0]['edituser'] == '1'){ ?>checked<?php } ?>> Edit User</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteuser" value="1" <?php if($function[0]['deleteuser'] == '1'){ ?>checked<?php } ?>> Delete User</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="report" value="1" <?php if($master[0]['report'] == '1'){ ?>checked<?php } ?>> Reports
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 70%;">Page</th>
                                      <th style="width: 30%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="salesreport" value="1" <?php if($page[0]['salesreport'] == '1'){ ?>checked<?php } ?>> Sales Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="purchasereport" value="1" <?php if($page[0]['purchasereport'] == '1'){ ?>checked<?php } ?>> Purchases Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="profitreport" value="1" <?php if($page[0]['profitreport'] == '1'){ ?>checked<?php } ?>> Profit / Loss Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="salepreport" value="1" <?php if($page[0]['salepreport'] == '1'){ ?>checked<?php } ?>> Sale / Purchase Profit Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="customerreport" value="1" <?php if($page[0]['customerreport'] == '1'){ ?>checked<?php } ?>> Customers Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="customerledger" value="1" <?php if($page[0]['customerledger'] == '1'){ ?>checked<?php } ?>> Customer Ledger</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="supplierreport" value="1" <?php if($page[0]['supplierreport'] == '1'){ ?>checked<?php } ?>> Suppliers Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="supplierledger" value="1" <?php if($page[0]['supplierledger'] == '1'){ ?>checked<?php } ?>> Supplier Ledger</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="stockreport" value="1" <?php if($page[0]['stockreport'] == '1'){ ?>checked<?php } ?>> Stock Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="voucherreport" value="1" <?php if($page[0]['voucherreport'] == '1'){ ?>checked<?php } ?>> Voucher Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="dailyreport" value="1" <?php if($page[0]['dailyreport'] == '1'){ ?>checked<?php } ?>> Daily Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="cashbook" value="1" <?php if($page[0]['cashbook'] == '1'){ ?>checked<?php } ?>> Cash Book</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="bankbook" value="1" <?php if($page[0]['bankbook'] == '1'){ ?>checked<?php } ?>> Bank Book</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="mobilebook" value="1" <?php if($page[0]['mobilebook'] == '1'){ ?>checked<?php } ?>> Mobile Book</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="salewpreport" value="1" <?php if($page[0]['salewpreport'] == '1'){ ?>checked<?php } ?>> Profit Report ( Sale Wise )</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="custduereport" value="1" <?php if($page[0]['custduereport'] == '1'){ ?>checked<?php } ?>> Customer Due Reports</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="banktranreport" value="1" <?php if($page[0]['banktranreport'] == '1'){ ?>checked<?php } ?>> Bank Transction Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="duepayreport" value="1" <?php if($page[0]['duepayreport'] == '1'){ ?>checked<?php } ?>> Due Payment Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="btransreport" value="1" <?php if($page[0]['btransreport'] == '1'){ ?>checked<?php } ?>> Balance Transfer Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="expensereport" value="1" <?php if($page[0]['expensereport'] == '1'){ ?>checked<?php } ?>> Expense Report</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="setting" value="1" <?php if($master[0]['setting'] == '1'){ ?>checked<?php } ?>> Setting
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 40%;">Page</th>
                                      <th style="width: 60%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="category" value="1" <?php if($page[0]['category'] == '1'){ ?>checked<?php } ?>> Category</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newcategory" value="1" <?php if($function[0]['newcategory'] == '1'){ ?>checked<?php } ?>> New Category</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editcategory" value="1" <?php if($function[0]['editcategory'] == '1'){ ?>checked<?php } ?>> Edit Category</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletecategory" value="1" <?php if($function[0]['deletecategory'] == '1'){ ?>checked<?php } ?>> Delete Category</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="unit" value="1" <?php if($page[0]['unit'] == '1'){ ?>checked<?php } ?>> Unit</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newunit" value="1" <?php if($function[0]['newunit'] == '1'){ ?>checked<?php } ?>> New Unit</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editunit" value="1" <?php if($function[0]['editunit'] == '1'){ ?>checked<?php } ?>> Edit Unit</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteunit" value="1" <?php if($function[0]['deleteunit'] == '1'){ ?>checked<?php } ?>> Delete Unit</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="costtype" value="1" <?php if($page[0]['costtype'] == '1'){ ?>checked<?php } ?>> Expense Type</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newctype" value="1" <?php if($function[0]['newctype'] == '1'){ ?>checked<?php } ?>> New Expense Type</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editctype" value="1" <?php if($function[0]['editctype'] == '1'){ ?>checked<?php } ?>> Edit Expense Type</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletectype" value="1" <?php if($function[0]['deletectype'] == '1'){ ?>checked<?php } ?>> Delete Expense Type</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="department" value="1" <?php if($page[0]['department'] == '1'){ ?>checked<?php } ?>> Department</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newdepartment" value="1" <?php if($function[0]['newdepartment'] == '1'){ ?>checked<?php } ?>> New Department</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editdepartment" value="1" <?php if($function[0]['editdepartment'] == '1'){ ?>checked<?php } ?>> Edit Department</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletedepartment" value="1" <?php if($function[0]['deletedepartment'] == '1'){ ?>checked<?php } ?>> Delete Department</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="bankaccount" value="1" <?php if($page[0]['bankaccount'] == '1'){ ?>checked<?php } ?>> Bank Account</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newbaccount" value="1" <?php if($function[0]['newbaccount'] == '1'){ ?>checked<?php } ?>> New Bank Account</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editbaccount" value="1" <?php if($function[0]['editbaccount'] == '1'){ ?>checked<?php } ?>> Edit Bank Account</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletebaccount" value="1" <?php if($function[0]['deletebaccount'] == '1'){ ?>checked<?php } ?>> Delete Bank Account</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="mobileaccount" value="1" <?php if($page[0]['mobileaccount'] == '1'){ ?>checked<?php } ?>> Mobile Account</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newmaccount" value="1" <?php if($function[0]['newmaccount'] == '1'){ ?>checked<?php } ?>> New Mobile Account</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editmaccount" value="1" <?php if($function[0]['editmaccount'] == '1'){ ?>checked<?php } ?>> Edit Mobile Account</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletemaccount" value="1" <?php if($function[0]['deletemaccount'] == '1'){ ?>checked<?php } ?>> Delete Mobile Account</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="usertype" value="1" <?php if($page[0]['usertype'] == '1'){ ?>checked<?php } ?>> User Type</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newutype" value="1" <?php if($function[0]['newutype'] == '1'){ ?>checked<?php } ?>> New User Type</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editutype" value="1" <?php if($function[0]['editutype'] == '1'){ ?>checked<?php } ?>> Edit User Type</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deleteutype" value="1" <?php if($function[0]['deleteutype'] == '1'){ ?>checked<?php } ?>> Delete User Type</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="balancetransfer" value="1" <?php if($page[0]['balancetransfer'] == '1'){ ?>checked<?php } ?>> Balance Transfer</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newbtranfer" value="1" <?php if($function[0]['newbtranfer'] == '1'){ ?>checked<?php } ?>> New Balance Transfer</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editbtranfer" value="1" <?php if($function[0]['editbtranfer'] == '1'){ ?>checked<?php } ?>> Edit Balance Transfer</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletebtranfer" value="1" <?php if($function[0]['deletebtranfer'] == '1'){ ?>checked<?php } ?>> Delete Balance Transfer</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="companyprofile" value="1" <?php if($page[0]['companyprofile'] == '1'){ ?>checked<?php } ?>> Company Setup</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;">
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="newcprofile" value="1" <?php if($function[0]['newcprofile'] == '1'){ ?>checked<?php } ?>> New Company</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="editcprofile" value="1" <?php if($function[0]['editcprofile'] == '1'){ ?>checked<?php } ?>> Edit Company</label>
                                            </div>
                                          </li>
                                          <li>
                                            <div class="checkbox">
                                              <label><input type="checkbox" name="deletecprofile" value="1" <?php if($function[0]['deletecprofile'] == '1'){ ?>checked<?php } ?>> Delete Company</label>
                                            </div>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-sm-4 col-12">
                            <h5 style="background-color: #007bff; color: #fff; padding-left: 20px; border-radius: 10px;padding: 10px;">
                              <input type="checkbox" name="access_setup" value="1" <?php if($master[0]['access_setup'] == '1'){ ?>checked<?php } ?>> Access Setup
                            </h5>
                            <div class="page_box" >
                              <div class="col-md-12 col-sm-12 col-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th style="width: 50%;">Page</th>
                                      <th style="width: 50%;">Function</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="accessetup" value="1" <?php if($page[0]['accessetup'] == '1'){ ?>checked<?php } ?>> Access Setup</label>
                                        </div>
                                      </td>
                                      <td>
                                        <ul style="list-style-type: none; margin-left: -40px;"></ul>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

						</div>
	              		<div class="col-md-12 col-sm-12 col-12" style="text-align: center;">
                    	  <button type="submit" class="btn btn-info"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                          <a href="<?php echo site_url('userAccess') ?>" class="btn btn-danger" ><i class="fa fa-arrow-left" ></i>&nbsp;&nbsp;Back</a>
                    	</div>
                      </form>
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

<?php $this->load->view('footer/footer');?>
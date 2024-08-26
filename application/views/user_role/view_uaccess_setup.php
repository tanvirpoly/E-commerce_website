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
                <h3 class="card-title">Access Setup Information</h3>
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
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Master</th>
                          <th>Page</th>
                          <th>Function</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <ul style="list-style-type:none;">
                              <li>
                                <b>
                                  <?php if($master[0]['dashboard'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Dashboard
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['product'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Products
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['purchase'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Purchases
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['sales'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sales
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['return'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sales Returns
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['preturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Purchases Returns
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['quotation'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Quotations
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['voucher'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Vouchers
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['salary'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Employee Payment
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['users'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Users
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['report'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['setting'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Setting
                              </li>
                              <li>
                                <b>
                                  <?php if($master[0]['access_setup'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Access Setup
                              </li>
                            </ul>
                          </td>

                          <td>
                            <ul style="list-style-type:none;">
                              <li>
                                <b>
                                  <?php if($page[0]['productlist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Product List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newproduct'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Product
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['purchaselist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Purchases List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newpurchase'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Purchase
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['saleslist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sales List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newsale'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Sale
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['sreturnlist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sale Return List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newsreturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Sale Return
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['preturnlist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Purrchase Return List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newpreturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Purrchase Return
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['quotationlist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Quotation List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newquotation'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Quotation
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['voucherlist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Voucher List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newvoucher'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Voucher
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['emppaylist'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Employee Payment List
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['newemppay'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Employee Payment
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['customer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Customers
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['supplier'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Suppliers
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['employee'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Employees
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['user'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Users
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['salesreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sales Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['purchasereport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Purrchase Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['profitreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Profit / Loss Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['salepreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Sale / Purchase Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['customerreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Customer Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['customerledger'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Customer Ledger
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['supplierreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Supplier Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['supplierledger'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Supplier Ledger
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['stockreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Stock Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['voucherreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Voucher Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['dailyreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Daily Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['cashbook'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Cash Book
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['bankbook'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Bank Book
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['mobilebook'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Mobile Book
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['salewpreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Profit Report ( Sale Wise )
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['custduereport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Customer Due Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['banktranreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Bank Transtion Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['duepayreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Due Payment Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['btransreport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Balance Transfer Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['expensereport'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Expense Reports
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['category'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Category
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['unit'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Units
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['costtype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Expense Type
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['department'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Departments
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['bankaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Bank Account
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['mobileaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Mobile Account
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['usertype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> User Type
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['balancetransfer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Balance Transfer
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['companyprofile'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Company Profile
                              </li>
                              <li>
                                <b>
                                  <?php if($page[0]['accessetup'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Acces Setup
                              </li>
                            </ul>
                          </td>
                          <td>
                            <ul style="list-style-type:none;">
                              <li>
                                <b>
                                  <?php if($function[0]['editproduct'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Product
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['storeproduct'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Store Product
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteproduct'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Product
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['barcodeproduct'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Product Barcode
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editpurchase'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Purchase
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletepurchase'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Purchase
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editsale'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Sale
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletesale'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Sale
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editreturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Sale Return
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletereturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Sale Return
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editpreturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Purchase Return
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletepreturn'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                    <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Purchase Return
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editquotation'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Quotation
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletequotation'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Quotation
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editvoucher'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Voucher
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletevoucher'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Voucher
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editemppayment'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Employee Payment
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteemppayment'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Employee Payment
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newcustomer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Customer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editcustomer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Customer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletecustomer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Customer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newsupplier'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Supplier
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editsupplier'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Supplier
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletesupplier'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Supplier
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newemployee'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Employee
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editemployee'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Employee
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteemployee'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Employee
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newuser'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New User
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['edituser'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit User
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteuser'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete User
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newcategory'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Category
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editcategory'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Category
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletecategory'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Category
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newunit'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Unit
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editunit'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Unit
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteunit'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Unit
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newctype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Expense Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editctype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Expense Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletectype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Expense Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newdepartment'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Department
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editdepartment'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Department
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletedepartment'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Department
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newbaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Bank Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editbaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Bank Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletebaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Bank Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newmaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Mobile Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editmaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Mobile Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletemaccount'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Mobile Account
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newutype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New User Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editutype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit User Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deleteutype'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete User Type
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newbtranfer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Balance Transfer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editbtranfer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Balance Transfer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletebtranfer'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Balance Transfer
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['newcprofile'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> New Company Profile
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['editcprofile'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Edit Company Profile
                              </li>
                              <li>
                                <b>
                                  <?php if($function[0]['deletecprofile'] == '1'){ ?>
                                  <i class="fas fa-check" style="color:green;"> </i>
                                  <?php }else{ ?>
                                  <i class="fas fa-times" style="color:red;"> </i>
                                  <?php } ?>
                                </b> Delete Company Profile
                              </li>
                            </ul>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
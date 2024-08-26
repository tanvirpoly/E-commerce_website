<nav style="font-size: 40px;" class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
    id="myDIV">
    <li class="nav-item has-treeview menu-open">
      <a href="<?php echo base_url(); ?>Dashboard" class="nav-link active">
        <i class="nav-icon fa-solid fa-chart-pie"></i>
        <p style="font-size: 22px;"> Dashboard</p>
      </a>
    </li>
    <?php if ($_SESSION['product'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Product" class="nav-link">
          <i class="nav-icon fa-solid fa-dolly"></i>
          <p style="font-size: 20px;"> Products </p>
        </a>
      </li>


    <?php }
    if ($_SESSION['report'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>uReport" class="nav-link">
          <i class="nav-icon fas fa-folder-open"></i>
          <p style="font-size: 20px;"> Reports</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['category'] == 1) { ?>
      <li class="nav-item has-treeview">
        <a href="<?php echo base_url(); ?>Category" class="nav-link">
          <i class="nav-icon fas fa-folder-open"></i>
          <p style="font-size: 20px;"> Category<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url('Category'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('subCategory'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p> Sub Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('childSubCategory'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p> Sub-Child Category</p>
            </a>
          </li>

        </ul>

      </li>
    <?php }
    if ($_SESSION['customer'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url('Customer'); ?>" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p style="font-size: 20px;"> Customer</p>
        </a>
      </li>



    <?php }
    if ($_SESSION['sales'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Sale" class="nav-link">
          <i class="nav-icon fa-sharp fa-solid fa-bag-shopping"></i>
          <p style="font-size: 20px;"> Invoice </p>
        </a>
      </li>
    <?php }
    if ($_SESSION['quotation'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>order" class="nav-link">
          <i class="nav-icon fa-sharp fa-solid fa-bag-shopping"></i>
          <p style="font-size: 20px;">
            <?= ($_SESSION['role'] == 8) ? 'My Order' : 'Online Order ' ?>
          </p>
        </a>
      </li>
    <?php }
    if ($_SESSION['purchase'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Purchase" class="nav-link">
          <i class="nav-icon fa-solid fa-cart-shopping"></i>
          <p style="font-size: 20px;"> Purchases </p>
        </a>
      </li>
    <?php }
    if ($_SESSION['return'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Return" class="nav-link">
          <i class="nav-icon fas fa-retweet"></i>
          <p style="font-size: 20px;"> Sales Returns</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['preturn'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>pReturn" class="nav-link">
          <i class="nav-icon fa-solid fa-rotate-left"></i>
          <p style="font-size: 20px;"> Purchases Returns</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['setting'] == 1) { ?>
      <li class="nav-item has-treeview">
        <a href="javascript:void(0);" class="nav-link">
          <i class="nav-icon fas fa-hand-holding-usd"></i>
          <p style="font-size: 20px;"> Store Setup<i class="fas fa-angle-left right"></i></p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url('Supplier'); ?>" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>Create Company/Brand</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Size'); ?>" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>Create Size</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('DeliveryTime'); ?>" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>Delivery Time Setup</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Unit'); ?>" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>Create Unit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Tag'); ?>" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>Create Tags</p>
            </a>
          </li>




        </ul>

      </li>
    <?php }
    if ($_SESSION['users'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>uSetting" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p style="font-size: 20px;"> Admin & User</p>
        </a>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>#" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-cog"></i><p style="font-size: 20px;"> Decoration</p>-->
      <!--  </a>-->
      <!--</li>-->
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>#" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-cog"></i><p style="font-size: 20px;"> Special Offer</p>-->
      <!--  </a>-->
      <!--</li>-->
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>#" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-cog"></i><p style="font-size: 20px;"> Footer</p>-->
      <!--  </a>-->
      <!--</li>-->
      <!--<li class="nav-item has-treeview">-->
      <!--  <a href="<?php echo base_url(); ?>#" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-cog"></i><p style="font-size: 20px;"> Page Create <i class="fas fa-angle-left right"></i></p>-->

      <!--  </a>-->

      <!--  <ul class="nav nav-treeview">-->
      <!--  <li class="nav-item">-->
      <!--    <a href="#" class="nav-link">-->
      <!--      <i class="far fa-circle nav-icon"></i><p> About Us</p>-->
      <!--    </a>-->
      <!--  </li>-->
      <!--  <li class="nav-item">-->
      <!--    <a href="#" class="nav-link">-->
      <!--      <i class="far fa-circle nav-icon"></i><p> Contact Us</p>-->
      <!--    </a>-->
      <!--  </li>-->
      <!--  <li class="nav-item">-->
      <!--    <a href="#" class="nav-link">-->
      <!--      <i class="far fa-circle nav-icon"></i><p> Privacy Policy</p>-->
      <!--    </a>-->
      <!--  </li>-->
      <!--</ul>-->
      <!--</li>-->



      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>pReturn" class="nav-link">-->
      <!--    <i class="nav-icon fa-solid fa-retweet"></i><p style="font-size: 20px;"> Quotation</p>-->
      <!--  </a>-->
      <!--</li>-->

      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>serviceInfo" class="nav-link">-->
      <!--    <i class="nav-icon fa fa-clipboard"></i><p> Service List</p>-->
      <!--  </a>-->
      <!--</li>-->
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>serviceSale" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-search-dollar"></i><p> Service Sale</p>-->
      <!--  </a>-->
      <!--</li>-->
    <?php }
    if ($_SESSION['voucher'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Voucher" class="nav-link">
          <i class="nav-icon fas fa-mail-bulk"></i>
          <p style="font-size: 20px;"> Expenses</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['role'] == 2) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>adjustment_list" class="nav-link">
          <i class="nav-icon fas fa-mail-bulk"></i>
          <p style="font-size: 20px;"> Deposit / Withdraw</p>
        </a>
      </li>
      <!-- <li class="nav-item">
          <a href="<?php echo base_url(); ?>adjustment_list" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i><p> Balance Adjustment</p>
          </a>
        </li> -->
    <?php }
    if ($_SESSION['balancetransfer'] == 1) { ?>
      <!-- <li class="nav-item">
        <a href="<?php echo base_url(); ?>Balance" class="nav-link">
          <i class="nav-icon fa fa-money-bill-transfer"></i>
          <p style="font-size: 20px;"> Deposit / Withdraw</p>
        </a>
      </li> -->
      <!-- <li class="nav-item">
        <a href="<?php echo base_url(); ?>transAccount" class="nav-link">
          <i class="nav-icon fa fa-money-bill-transfer"></i>
          <p style="font-size: 20px;"> Balance Transfer</p>
        </a>
      </li> -->
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>sStructure" class="nav-link">-->
      <!--    <i class="nav-icon fa-solid fa-sitemap"></i> <p> Salary Structure</p>-->
      <!--  </a>-->
      <!--</li>-->
    <?php }
    if ($_SESSION['salary'] == 1) { ?>
      <!--<li class="nav-item">-->
      <!--  <a href="<?php echo base_url(); ?>empPayment" class="nav-link">-->
      <!--    <i class="nav-icon fas fa-hand-holding-usd"></i><p style="font-size: 20px;"> Salary</p>-->
      <!--  </a>-->
      <!--</li>-->
    <?php }
    if ($_SESSION['users'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Countdown" class="nav-link">
          <i class="nav-icon fas fa-shop"></i>
          <p style="font-size: 20px;"> Offer Countdown</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['setting'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>Setting" class="nav-link">
          <i class="nav-icon fas fa-cogs"></i>
          <p style="font-size: 20px;"> Settings</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['access_setup'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url(); ?>userAccess" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p style="font-size: 20px;"> Access Setup</p>
        </a>
      </li>
    <?php }
    if ($_SESSION['setting'] == 1) { ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p style="font-size: 20px;"> Site Settings<i class="fas fa-angle-left right"></i></p>


        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>addSlider" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p> Slider Add</p>
            </a>
          </li>

        </ul>
      </li>

    <?php }
    if ($_SESSION['access_setup'] == 1) { ?>
      <li class="nav-item">
        <a href="<?php echo base_url('backup/download'); ?>" class="nav-link">
          <i class="nav-icon fa-solid fa-database"></i>
          <p style="font-size: 20px;">Database Backup</p>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item">
      <a href="<?php echo base_url(); ?>Login/logout" class="nav-link">
        <i class="nav-icon far fa-arrow-alt-circle-left"></i>
        <p style="font-size: 20px;"> Logout</p>
      </a>
    </li>

  </ul>
</nav>

<script>
  // var header = document.getElementById("myDIV");
  // var btns = header.getElementsByClassName("nav-link");
  // for (var i = 0; i < btns.length; i++) {
  //   btns[i].addEventListener("click", function() {
  //   var current = document.getElementsByClassName("active");
  //   if (current.length > 0) { 
  //     current[0].className = current[0].className.replace(" active", "");
  //   }
  //   this.className += " active";
  //   });
  // }
// </script>
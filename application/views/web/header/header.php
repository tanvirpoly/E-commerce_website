<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- AUTHOR META -->
    <meta name="author" content="misbah">
    <meta name="email" content="misbah.uddin.sagor@gmail.com">
    <meta name="profile" content="https://themeforest.net/user/mironcoder">
        <!-- TEMPLATE META -->
    <meta name="name" content="Dhaka Bazar">
    <meta name="title" content="Dhaka Bazar">
    <meta name="keywords" content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, webshop, farm, grocery, natural, online store">
        <!-- WEBPAGE TITLE -->
    <title><?php echo $title; ?></title>

    <link rel="icon" href="<?php echo base_url().'upload/company/'.$company->com_logo; ?>">
    <!-- FONTS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/fonts/fontawesome/fontawesome.min.css">
        <!-- VENDOR -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/vendor/venobox/venobox.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/vendor/slickslider/slick.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/vendor/niceselect/nice-select.min.css">
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/vendor/bootstrap/bootstrap.min.css">
        <!-- CUSTOM -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/checkout.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/product-details.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/invoice.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/home-standard.css">
    
    <style type="text/css">
        [type=radio] { 
          position: absolute;
          opacity: 0;
          width: 0;
          height: 0;
          }
    
          /* IMAGE STYLES */
        [type=radio] + img {
          cursor: pointer;
          }
    
          /* CHECKED STYLES */
        [type=radio]:checked + img {
          outline: 2px solid #f00;
          }
    
        .img-magnifier-container {
          position:relative;
          }
    
        .img-magnifier-glass {
          position: absolute;
          border-radius: 0;
          cursor: none;
          width: 300px;
          height: 300px;
          }
    </style>
    
    <style>
        body {
            position: relative; 
          
        }
        
        .cart-button {
            position: fixed;
            top: 50%; /* Vertically align to the middle */
            right: 0; /* Align to the rightmost position */
            transform: translateY(-50%); /* Center vertically */
            z-index:999;
            opacity:1;
        }
        
        .cart-button:hover{
            opacity:1;
        }
        
        .cart-button button {
            background-color: #000000; /* Customize button styles */
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        @media screen and (min-width: 992px) {
            
            .fixed-column {
                position: fixed;
                left: 0;
                height: 100%;
                /*width: 25%;*/
                background-color: #f0f0f0; /* Set the background color for the fixed column */
                overflow-y:scroll;
            }
            .scrolling-column {
                margin-left: 16%; /* Adjust the margin to match the width of the fixed column */
                padding: 0px; /* Add padding to create space between the columns */
            }
        }
        @media screen and (max-width: 992px) {
            
            .login, .reg {
                display:none;
            }
        }
        .highlight {
          background-color: #000000;
          font-weight: bold;
        }


/* Add more styles as needed for your button */

    </style>
    
    <style>
            @media screen and (max-width: 600px) {
        .gtClass {display: none;}
          }
          
        .banner-category-item .mcategory ::before {
        position: absolute;
        top: 50%;
        right: 10px;
        content: "\f054";
        font-size: 10px;
        font-weight: 900;
        font-family: "Font Awesome 5 Free";
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        }
        
        .bHeight
          {
          height: 500px; 
          overflow-y: scroll;
          }
        
    </style>
    
    
    <style>
        .header-form {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
        }
        #search-input {
            height: 30px;
            border: none;
            padding: 0 10px;
            font-size: 14px;
            flex: 1;
        }
        button {
            height: 30px;
            width: 30px;
            border: none;
            background-color: #f0f0f0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        button i {
            font-size: 14px;
        }
        

        
    
    
    /*.notification-badge {*/
    /*    position: absolute;*/
    /*    top: 4px;*/
    /*    right: 6px;*/
    /*    background-color: red;*/
    /*    color: white;*/
    /*    border-radius: 50%;*/
    /*    width: 20px;*/
    /*    height: 20px;*/
    /*    font-size: 12px;*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    align-items: center;*/
    /*}*/
    
      body > .skiptranslate {
        display: none;
    }

    body {
        top: 0px !important;
    }
    
    
.banner-category-head {
    background-color: #000000 !important;
}

    
    </style>
    
    
  </head>

  <body>
    <header class="header-part" >
      <div class="container-fluid" style="background-color:#000000; position: relative;">
        <div class="header-content" style="position: relative; height:60px">
          <div class="header-media-group" style="position: relative;" >
            <button class="header-user" style="background-color: #000000;">
              <i class="fa fa-bars" style="background-color: #000000;" ></i>
              <!--<img src="<?php echo base_url(); ?>design/images/user.png" alt="user">-->
            </button>
            
            <a href="<?php echo base_url(); ?>">
              <img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" alt="logo">
            </a>
            
            <button class="header-src"><i class="fas fa-search"></i></button>
          </div>
          <a style="padding-left: 5px" href="<?php echo base_url(); ?>" class="header-logo">
            <img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" alt="logo">
          </a>
          

          <form class="header-form" id="search-form" method="post">
              <input type="text" id="search-input" placeholder="Search anything...">
              <button><i class="fas fa-search"></i></button>
          </form>
          
          
         <!--start Google translator-->
        
        	<span style="padding-top:14px">
			    <div class="translate" id="google_translate_element"> </div>
			    
                <script type="text/javascript">
                    function googleTranslateElementInit() {  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');}
                </script>
                
			</span> 
        
         <!--end Google translator-->
         
          
          
          <?php if(isset($_SESSION['uid'])){ ?>
          <a href="<?php echo base_url('Dashboard'); ?>" class="header-widget" title="My Account">
            <img src="<?php echo base_url(); ?>design/images/user.png" alt="user">
            <span style="color:#fff;"><?= $_SESSION['name']; ?></span>
          </a>
        <?php } else {?>
          <!--<a href="<?php echo base_url(); ?>" class="header-widget login" title="My Account">-->
            <!--<img src="<?php echo base_url(); ?>design/images/user.png" alt="user">-->
            <a class="btn btn-inline login" href="<?php echo base_url(); ?>userLogin"><span>login</span></a>
          <!--</a>-->
          <!--<a href="<?php echo base_url(); ?>" class="header-widget" title="Be a customer">-->
            <!--<img src="<?php echo base_url(); ?>design/images/user.png" alt="user">-->
            <a class="btn btn-inline reg" href="<?php echo base_url(); ?>signUp"><span>Sign Up</span></a>
          <!--</a>-->
        <?php }?>
        </div>
      </div>
      <div class="cart-button">
        <button class="header-widget header-cart btn" title="cartlist">
          <i class="fas fa-shopping-basket"></i>
          <div id="ccount"></div>
          <div>৳ <small><?php echo number_format($this->cart->total()); ?></small></div>
        </button>
      </div>
    </header>

    <!--<nav class="navbar-part">-->
    <!--  <div class="container-fluid">-->
    <!--    <div class="row">-->
    <!--      <div class="col-lg-12">-->
    <!--        <div class="navbar-content">-->
    <!--          <ul class="navbar-list">-->
    <!--            <li class="navbar-item ">-->
    <!--              <a class="navbar-link" href="<?php echo base_url('home'); ?>">home</a>-->
    <!--            </li>-->
    <!--            <li class="navbar-item">-->
    <!--              <a class="navbar-link" href="#">About US</a>-->
    <!--            </li>-->
              
          
    <!--            <li class="navbar-item">-->
    <!--              <a class="navbar-link" href="#">contact us</a>-->
    <!--            </li>         -->
    <!--            <li class="navbar-item dropdown">-->
    <!--              <a class="navbar-link dropdown-arrow" href="#">MY Account</a>-->
    <!--              <ul class="dropdown-position-list">-->
    <!--                <li><a href="<?php echo base_url(); ?>userLogin">login</a></li>-->
    <!--                <li><a href="<?php echo base_url(); ?>userRegister">register</a></li>-->
    <!--              </ul>-->
    <!--            </li>         -->
    <!--          </ul>-->
              
            
    <!--          <div class="navbar-list">-->
                <!--<div class="navbar-select">-->
                <!--  <i class="fas fa-flag"></i>-->
                <!--  <select class="select">-->
                <!--    <option value="english" selected>EN</option>-->
                <!--    <option value="bangali">BN</option>-->
                <!--  </select>-->
                  
                 
                <!--</div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</nav>-->


    <aside class="cart-sidebar" id="detail_cart">
        
    </aside>

    <aside class="nav-sidebar">
      <div class="nav-header">
        <a href="#"><img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" alt="logo"></a>
        <button class="nav-close"><i class="icofont-close"></i></button>
      </div>
      <div class="nav-content">
       
         
        <ul class="nav-list">
          <li>
            <a class="nav-link" href="<?= base_url();?>"><i class="icofont-home"></i>Home</a>
          </li>
          <li>
            <a class="nav-link" href="<?php echo base_url(); ?>signUp"><i class="icofont-plus"></i>Sign up</a>
          </li>
          <li>
            <a class="nav-link" href="<?php echo base_url(); ?>Login"><i class="icofont-login"></i>Login</a>
          </li>
          
          <!--<li>-->
          <!--  <a class="nav-link" href="#"><i class="icofont-contacts"></i>contact us</a>-->
          <!--</li>-->
        </ul>
        <div class="nav-info-group">
          <div class="nav-info">
            <i class="icofont-ui-touch-phone"></i>
            <p>
              <small>call us</small>
              <span><?php echo $company->com_mobile; ?></span>
            </p>
          </div>
          <div class="nav-info">
            <i class="icofont-ui-email"></i>
            <p>
              <small>email us</small>
              <span><?php echo $company->com_email; ?></span>
            </p>
          </div>
        </div>
        <div class="nav-footer">
          <p>All Rights Reserved by <a href="#"><?php echo $company->com_name; ?></a></p>
        </div>
      </div>
    </aside>
    
    <!--<aside class="carticon-sidebar">-->
        
    <!--</aside>-->
    
    <div class="mobile-menu" style="position: fixed; bottom: 10px;">
      <a href="<?php echo base_url(); ?>" title="Home Page">
        <i class="fas fa-home"></i>
        <span>Home</span>
      </a>
      <a href="<?php echo base_url('Webhome/view_category_details'); ?>" title="Category List">
        <i class="fas fa-list"></i>
        <span>Category</span>
      </a>
      <!--<button class="cate-btn" href="<?php echo base_url(); ?>" title="Category List">-->
      <!--  <i class="fas fa-list"></i>-->
      <!--  <span>category</span>-->
      <!--</button>-->
      <button class="cart-btn" title="Cartlist">
        <i class="fas fa-shopping-basket"></i>
        <span>cartlist</span>
        <sup></sup>
      </button>
    
    </div>
    
    <div class="modal fade" id="product-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
          <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
          <div class="product-view">
            <div class="row">
              <div class="col-md-6 col-lg-6">
                <div class="view-gallery">
                  <!--<div class="view-label-group">-->
                  <!--  <label class="view-label new">new</label>-->
                  <!--  <label class="view-label off">-10%</label>-->
                  <!--</div>-->
                  <ul class="preview-slider slider-arrow"> 
                      <li><img id="proImage" src="<?= base_url().'upload/product/demoimg.jpg';?>" alt="product"></li>
                  </ul>
                  <ul class="thumb-slider">
                      <li><img src="" alt="product" id="thImage"></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div class="view-details">
                      <h3 class="view-name">
                          <a href="" id="pName"></a>
                      </h3>
                      <div class="view-meta">
                          <p>SKU:<span id="productID"></span></p>
                          <p>BRAND:<span id="compname"></span></p>
                      </div>
                      <h3 class="view-price">
                          <del id="dprice"></del>
                          <span id="sprice"><small id="unit"></small></span>
                      </h3>
                      <p class="view-desc" id="pdesc"></p>
                      <!--<div class="view-add-group">-->
                      <!--    <button class="product-add" title="Add to Cart">-->
                      <!--        <i class="fas fa-shopping-basket"></i>-->
                      <!--        <span>add to cart</span>-->
                      <!--    </button>-->
                      <!--    <div class="product-action">-->
                      <!--        <button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button>-->
                      <!--        <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">-->
                      <!--        <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>-->
                      <!--    </div>-->
                      <!--</div>-->
                      <!--<div class="view-action-group">-->
                      <!--    <a class="view-wish wish" href="#" title="Add Your Wishlist">-->
                      <!--        <i class="icofont-heart"></i>-->
                      <!--        <span>add to wish</span>-->
                      <!--    </a>-->
                      <!--    <a class="view-compare" href="compare.html" title="Compare This Item">-->
                      <!--        <i class="fas fa-random"></i>-->
                      <!--        <span>Compare This</span>-->
                      <!--    </a>-->
                      <!--</div>-->
                  </div>
              </div>
            </div>
          </div>
        </div> 
      </div> 
    </div>

    <div class="row mt-2">
        <div class="col-lg-2 fixed-column flex-nowrap">
            <div class="banner-category">
                <div class="banner-category-head">
                    <i class="fas fa-bars"></i>
                    <span>Top Categories</span>
                </div>
                <ul class="nav-pills flex-column bHeight" id="menu" style="height:100%;">
                    <?php
                    $i = 0;
                    foreach ($categories as $category) {
                        $i++;
                        ?>
                        <li class="banner-category-item">
                            
                            <a class="mcategory" href="#submenu<?= $i; ?>" data-bs-toggle="collapse" class="px-0 align-middle"  >
                                <i class="flaticon-vegetable"></i>
                                <span class="ms-1 d-none d-sm-inline"><?= $category['categoryName']; ?></span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu<?= $i; ?>" data-bs-parent="#menu" style="padding: 10px; border-radius: 10px;" >
                                <?php
                                $subcategories = $this->pm->get_data('categories_sub', ['categoryID' => $category['categoryID']]);
                                $j = 0;
                                foreach ($subcategories as $subcategory) {
                                    $j++;
                                    ?>
                                    <li class="w-100">
                                            <a href="<?= site_url('subcategoryDetails').'/'.$subcategory['subcategoryID']; ?>" style="padding: 0px;" >
                                                <i class="fas fa-chevron-right"></i>
                                                <span class="d-none d-sm-inline"><?= $subcategory['subcategoryName']; ?></span>
                                            </a>
                                        <ul class="collapse nav flex-column ms-1" id="childmenu<?= $j; ?>" data-bs-parent="#submenu<?= $i; ?>" style="padding: 0px; border-radius: 10px;">
                                            <?php
                                            $childcategories = $this->pm->get_data('categories_child', ['subcategoryID' => $subcategory['subcategoryID']]);
                                            $k = 0;
                                            foreach ($childcategories as $childcategory) {
                                                $k++;
                                                ?>
                                                <li>
                                                    <a href="<?= site_url('childcategoryDetails').'/'.$childcategory['childcategoryID']; ?>" class="nav-link px-0" style="padding: 0px;"  >
                                                        <i class="fa fa-arrow-right"></i>
                                                        <span class="d-none d-sm-inline"><?= $childcategory['childcategoryName']; ?></span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 scrolling-column d-none" id="search-content">
            <!--<div id="search-results">-->
                <!--=====================================
                        DEALS PART START
            =======================================-->
                <section class="section deals-part">
                    <div class="container-fluid">
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-12">-->
                        <!--        <div class="section-heading">-->
                        <!--            <h2>All Items</h2>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="row" id="no-search"></div>
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 row-cols-xl-6" id="search-results"></div>
                    </div>
                </section>
        <!--=====================================
                        DEALS PART END
            =======================================-->
            <!--</div>-->
        </div>
<div class="col-lg-10 scrolling-column" id="main-content">
    
    
         <!--Google Translator Script-->
    
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    

<?php $this->load->view('web/header/header'); ?>

        <!--=====================================
                    BANNER PART START
        =======================================-->
        
            <style>
                .banner-part {
                    padding: 0px 0px 0px 0px !important;
                }
                
                .category-wrap {
                    margin-bottom: 2rem;
                }
                .category-media img {
                    max-width: 100%;
                    height: auto;
                }
                .section-heading h2 {
                    text-align: center;
                    margin-bottom: 2rem;
                }

            </style>

        
        
        <section class="banner-part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="home-grid-slider slider-dots">
                                    <?php
                                            $i = 0;
                                            foreach ($slider_image as $value){
                                            $i++;
                                         ?>
                                    <div class="banner-wrap1" >
                                        <img src="<?php echo base_url().'/upload/product/'.$value['simage']; ?>" style="background-size: cover; background-repeat: no-repeat; background-attachment: fixed; height: 700px; width: 100%;" >
                                    </div>

                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <!--=====================================
                        BANNER PART END
            =======================================-->

        <!--=====================================
                        INTRO PART START
            =======================================-->
        <!--<section class="section intro-part">-->
        <!--    <div class="container-fluid">-->
        <!--        <div class="row intro-content">-->
        <!--            <div class="col-sm-6 col-lg-3">-->
        <!--                <div class="intro-wrap">-->
        <!--                    <div class="intro-icon">-->
        <!--                        <i class="fas fa-truck"></i>-->
        <!--                    </div>-->
        <!--                    <div class="intro-content">-->
        <!--                        <h5>Cash on delivery</h5>-->
                                <!--<p>Lorem ipsum dolor sit amet adipisicing elit nobis.</p>-->

        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-sm-6 col-lg-3">-->
        <!--                <div class="intro-wrap">-->
        <!--                    <div class="intro-icon">-->
        <!--                        <i class="fas fa-sync-alt"></i>-->
        <!--                    </div>-->
        <!--                    <div class="intro-content">-->
        <!--                        <h5>instant return policy</h5>-->
                                <!--<p>Lorem ipsum dolor sit amet adipisicing elit nobis.</p>-->

        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-sm-6 col-lg-3">-->
        <!--                <div class="intro-wrap">-->
        <!--                    <div class="intro-icon">-->
        <!--                        <i class="fas fa-headset"></i>-->
        <!--                    </div>-->
        <!--                    <div class="intro-content">-->
        <!--                        <h5>quick support system</h5>-->
                                <!--<p>Lorem ipsum dolor sit amet adipisicing elit nobis.</p>-->

        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-sm-6 col-lg-3">-->
        <!--                <div class="intro-wrap">-->
        <!--                    <div class="intro-icon">-->
        <!--                        <i class="fas fa-lock"></i>-->
        <!--                    </div>-->
        <!--                    <div class="intro-content">-->
        <!--                        <h5>secure payment way</h5>-->
                                <!--<p>Lorem ipsum dolor sit amet adipisicing elit nobis.</p>-->

        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--=====================================
                        INTRO PART END
            =======================================-->

        <!--=====================================
                        CATEGORY PART START
            =======================================-->
            
            <section class="section category-part">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-heading">
                                <h2>Categories</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="category-slider slider-arrow">
                                <?php
                                    $i = 0;
                                    foreach ($categories as $key => $value) { 
                                        $i++;
                                ?>
                                <div class="category-wrap col-12 col-sm-6 col-md-4 col-lg-3">
                                    <a href="<?php echo site_url('categoryDetails').'/'.$value['categoryID']; ?>">
                                        <div class="category-media" style="height: 230px;">
                                            <?php if ($value['categoryImage']) { ?>
                                                <img class="img-fluid" style="height: 270px; width: 100%;" src="<?php echo base_url('upload/product/'.$value['categoryImage']); ?>" alt="category">
                                            <?php } else { ?>
                                                <img class="img-fluid" src="<?php echo base_url('upload/noimage.jpg'); ?>" alt="category">
                                            <?php } ?>
                                        </div>
                                    </a>
                                    <div class="category-meta" style="margin-top: 2rem;">
                                        <a href="<?php echo site_url('categoryDetails').'/'.$value['categoryID']; ?>">
                                            <h4><?php echo $value['categoryName']; ?></h4>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="section-btn-50 text-center">
                                <a href="<?php echo site_url('view_category_details'); ?>" class="btn btn-outline">
                                    <i class="fas fa-eye"></i>
                                    <span>view all category</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        
        
        <!--=====================================
                        CATEGORY PART END
            =======================================-->

        <!--=====================================
                        COUNTDOWN PART START
            =======================================-->
        <!--<section class="section countdown-part">-->
        <!--    <div class="container-fluid">-->
        <!--        <div class="row align-items-center">-->
        <!--            <div class="col-lg-6 mx-auto">-->

        <!--                <div class="countdown-content">-->
        <!--                    <h3><?php echo $countdown->countdownTitle; ?></h3>-->
        <!--                    <p><?php echo $countdown->countdownDescription; ?></p>-->
        <!--                    <div class="countdown countdown-clock" id="countdown">-->
        <!--                        <span class="countdown-time" id="days"><span></span><small>days</small></span>-->
        <!--                        <span class="countdown-time" id="hours"><span></span><small>hours</small></span>-->
        <!--                        <span class="countdown-time" id="minutes"><span></span><small>minutes</small></span>-->
        <!--                        <span class="countdown-time" id="seconds"><span></span><small>seconds</small></span>-->
        <!--                    </div>-->

                            <!--<div class="countdown countdown-clock"></div>-->
                            <!--<a href="#" class="btn btn-inline">-->
                            <!--    <i class="fas fa-shopping-basket"></i>-->
                            <!--    <span>shop now</span>-->
                            <!--</a>-->

        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-1"></div>-->
        <!--            <div class="col-lg-5">-->
        <!--                <div class="countdown-img">-->
        <!--                    <img src="<?php echo base_url('upload/offers'); ?>/<?php echo $countdown->countdownImage; ?>"-->
        <!--                        alt="countdown">-->
        <!--                    <div class="countdown-off">-->
        <!--                        <span><?php echo $countdown->countdownDiscount; ?>%</span>-->
        <!--                        <span>off</span>-->
        <!--                    </div>-->

        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--=====================================
                        COUNTDOWN PART END
            =======================================-->
        <!--=====================================
                    DEALS PART START
        =======================================-->
        
        
<section class="section deals-part">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12">
                <div class="section-heading">
                    <h2>Best Offers on Items</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="countdown deals-clock" id="countdown">
                    <span class="countdown-time" id="days"><span></span><small>days</small></span>
                    <span class="countdown-time" id="hours"><span></span><small>hours</small></span>
                    <span class="countdown-time" id="minutes"><span></span><small>minutes</small></span>
                    <span class="countdown-time" id="seconds"><span></span><small>seconds</small></span>
                </div>
            </div>
        </div> <br>
        
        
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 row-cols-xl-6">
        <?php 
            // var_dump($countdown);
            foreach($countdown as $value){
        ?>
            <div class="col">
                <div class="product-card">
                    <div class="product-media">
                        <a class="product-image" href="#">
                            <input type="hidden" id="duration" value="<?= htmlspecialchars($value->countdownDuration, ENT_QUOTES, 'UTF-8'); ?>">
                            <img src="<?= base_url('upload/offers/' . htmlspecialchars($value->countdownImage, ENT_QUOTES, 'UTF-8')); ?>" alt="product">
                        </a>
                    </div>
                    <div class="product-content">
                        <h6 class="product-name">
                            <a href="#"><?= htmlspecialchars($value->countdownTitle, ENT_QUOTES, 'UTF-8'); ?></a>
                        </h6>
                        <h6 class="product-price">
                            <!--<del>$34</del>-->
                            <span><?= htmlspecialchars($value->countdownDiscount, ENT_QUOTES, 'UTF-8') . '%'; ?></span>
                        </h6>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
        
        
        
        
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25">
                    <a href="#" class="btn btn-inline">
                        <i class="fas fa-eye"></i>
                        <span>View All Deals</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

        
        <!--=====================================
                    DEALS PART END
        =======================================-->
        <!--=====================================
                        DEALS PART START
            =======================================-->
            
        <style>
        .topnav {height: 300px;}
            @media screen and (max-width: 600px) {
        .topnav {height: 230px;}
          }
        </style>
        <section class="section deals-part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>All Items</h2>
                        </div>
                    </div>
                </div>
                <!--<div id="search-results"></div>-->
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-4">

                    <?php
                        $i = 0;
                        foreach ($product as $value){
                        $i++;
                        
                        $stock = $this->db->select('*')
                                        ->from('stock')
                                        ->where('product',$value['productID'])
                                        //->where('compid',$_SESSION['compid'])
                                        ->get()
                                        ->row();
    
                        if($stock)
                          {
                          $st = $stock->totalPices;
                          $dst = $stock->dtquantity;
                          }
                        else
                          {
                          $st = '0';
                          $dst = 0;
                          }
                        ?>

                    <div class="col" style="">
                        <div class="product-card topnav">
                            <div class="product-media" >
                                <div class="product-label">
                                    <label class="label-text off">
                                        <?php 
                                        $per = 0;
                                            if($value['regularPrice'] > 0 && $value['sprice'] > 0 && $value['regularPrice'] != $value['sprice']){
                                                $per = round((floatval($value['regularPrice']) - floatval($value['sprice'])) / floatval($value['regularPrice']) * 100);
                                                // $per = (($value['regularPrice'] - $value['sprice']) / $value['regularPrice'] * 100));
                                                // $per = number_format((100/floatval($value['regularPrice'])) * floatval($value['sprice']), 2);
                                            }
                                        echo $per.'%';
                                        ?>
                                    </label>
                                </div>

                                <!--<button class="product-wish wish">-->
                                <!--    <i class="fas fa-heart"></i>-->
                                <!--</button>-->
                                <?php
                                    if($value['image']){
                                        $img = $value['image'];
                                    }else{
                                        $img = 'demoimg.jpg';
                                    }
                                
                                ?>
                                <input type="hidden" id="imageData" value="<?php echo base_url().'/upload/product/'.$img; ?>">
                                <a class="product-image-card"
                                    href="<?php echo site_url('productDetails').'/'.$value['productID']; ?>">
                                    <img style="" src="<?php echo base_url().'/upload/product/'.$img; ?>" alt="product">
                                </a>
                                <!--<div class="product-widget">-->
                                <!--    <button type="button" title="Product View" href="#" class="btn btn-inline fas fa-eye product-view" data-bs-toggle="modal"-->
                                <!--        data-bs-target="#product-view" data-id="<?php echo $value['productID']; ?>" id="<?php echo $value['productID']; ?>"></button>-->
                                <!--</div>-->
                            </div>
                            <div class="product-content">
                                <h6 class="product-name">
                                    <a href="<?php echo site_url('productDetails').'/'.$value['productID']; ?>"
                                        method="post"
                                        enctype="multipart/form-data"><?php echo $value['productName']; ?></a>
                                </h6>
                                <h6 class="product-price" style="color: black;">
                                    <?php
                                        if($value['regularPrice'] > 0 && $value['regularPrice'] != $value['sprice']){
                                            echo "<del>&#2547; ".$value['regularPrice']."</del>";
                                        }
                                    ?>
                                    <span>&#2547; <?php echo $value['sprice']; ?><small>/<?php echo $value['unitName']; ?></small></span>
                                </h6>

                                <input type="hidden" class="form-control" name="productID"
                                    value="<?php echo $value['productID']; ?>" required>
                                <input type="hidden" class="form-control" name="categoryID"
                                    value="<?php echo $value['categoryID']; ?>" required>

                                <!--<div class="cart-action-group">-->
                                <!--    <div class="product-action" style="padding-left: 55px; padding-bottom: 10px;">-->
                                <!--        <button class="action-minus add_cart" title="Quantity Minus" id="add_cart"-->
                                <!--            data-productid="<?php echo $value['productID']; ?>" data-productname="<?php echo $value['productName']; ?>" data-productprice="<?php echo $value['sprice']; ?>"><i-->
                                <!--                class="icofont-minus"></i></button>-->
                                <!--        <input class="action-input" title="Quantity Number" type="text" id="quantity"-->
                                <!--            name="quantity" value="1">-->
                                <!--        <button class="action-plus" title="Quantity Plus" id="add_cart"-->
                                <!--            data-productid="1" data-productname="1" data-productprice="1"><i-->
                                <!--                class="icofont-plus"></i></button>-->
                                <!--    </div>-->
                                <!--    <?php $quantity = $this->input->post('quantity'); ?>-->

                                <!--</div>-->
                                <button class="product-add add_cart" title="Add to Cart"
                                    data-productid="<?php echo $value['productID']; ?>"
                                    data-productname="<?php echo $value['productName']; ?>"
                                    data-productprice="<?php echo $value['sprice']; ?>" style="padding: 0px;" >
                                    <i class="fas fa-shopping-basket"></i>
                                    <span>add to cart</span>
                                </button>
                                
                                <div class="product-action">
                                    <button class="action-minus romove_cart" title="Quantity Minus" data-productid="<?php echo $value['productID']; ?>"
                                    data-productname="<?php echo $value['productName']; ?>"
                                    data-productprice="<?php echo $value['sprice']; ?>"><i class="icofont-minus"></i></button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity" id="productquantity" value="1" style="padding: 0px;">
                                    <button class="action-plus add_cart" title="Quantity Plus" data-productid="<?php echo $value['productID']; ?>"
                                    data-productname="<?php echo $value['productName']; ?>"
                                    data-productprice="<?php echo $value['sprice']; ?>" style="padding: 0px;" ><i class="icofont-plus"></i></button>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                    <?php } ?>

                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25">
                            <a href="<?php echo site_url('all_products'); ?>" class="btn btn-inline">
                                <i class="fas fa-eye"></i>
                                <span>view all items</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                        DEALS PART END
            =======================================-->


<?php $this->load->view('web/footer/footer'); ?>

<script>
    // Check if the countdown end time is stored in local storage
    localStorage.removeItem('countdownEndTime');
    var storedEndTime = localStorage.getItem('countdownEndTime');

    if (storedEndTime) {
        // If it's stored, use that value
        var countDownDate = parseInt(storedEndTime);
    } else {
        // If it's not stored, set the countdown for 24 hours
        var hoursToCount = $("#duration").val();
        // alert(hoursToCount);
        countDownDate = new Date().getTime() + (hoursToCount * 60 * 60 * 1000);
        // Store the end time in local storage for persistence
        localStorage.setItem('countdownEndTime', countDownDate);
    }

    // Update the countdown every 1 second
    var x = setInterval(function() {
        // Get the current date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down time
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes, and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update the countdown-time elements
        $("#days span").html(days);
        $("#hours span").html(hours);
        $("#minutes span").html(minutes);
        $("#seconds span").html(seconds);

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            $("#countdown").html("EXPIRED");
            // Clear the stored end time from local storage
            localStorage.removeItem('countdownEndTime');
        }
    }, 1000);
</script>



<!--<script type="text/javascript">-->
<!--    var slide_index = 1;-->
<!--    displaySlides(slide_index);-->

<!--    function nextSlide(n) {-->
<!--        displaySlides(slide_index += n);-->
<!--    }-->

<!--    function currentSlide(n) {-->
<!--        displaySlides(slide_index = n);-->
<!--    }-->

<!--    function displaySlides(n) {-->
<!--        var i;-->
<!--        var slides = document.getElementsByClassName("showSlide");-->
<!--        if (n > slides.length) {-->
<!--            slide_index = 1-->
<!--        }-->
<!--        if (n < 1) {-->
<!--            slide_index = slides.length-->
<!--        }-->
<!--        for (i = 0; i < slides.length; i++) {-->
<!--            slides[i].style.display = "none";-->
<!--        }-->
<!--        slides[slide_index - 1].style.display = "block";-->
<!--    }-->
<!--</script>-->

<script type="text/javascript">
    $(document).ready(function() {
        $('.minus').click(function() {
            // $("#productquantity").val($('#quantity').val())
            // console.log($('#quantity').val());
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var c = 0;
        $('.add_cart').click(function() {
            // alert('hi');
            var pid = $(this).data("productid");
            var name = $(this).data("productname");
            var pprice = $(this).data("productprice");
            console.log(pid, name, pprice);
            $.ajax({
                url: "<?php echo site_url('Webhome/add_to_cart');?>",
                method: "POST",
                data: {
                    pid: pid,
                    name: name,
                    pprice: pprice,
                },
                success: function(data) {
                    c++;
                    console.log(data);
                    $('#ccount').html(c);
                    $('#detail_cart').html(data);
                    // alert("nice works");
                }
            });
        });
        $('#detail_cart').load("<?php echo site_url('Webhome/load_cart');?>");
        $(document).on('click', '.romove_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('Webhome/delete_cart');?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
        $('.cart-close').on('click', function(){
                $('body').css('overflow', 'inherit');
                $('.cart-sidebar').removeClass('active');
                $('.backdrop').fadeOut();
            });
    });
</script>






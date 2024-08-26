<?php $this->load->view('web/header/header'); ?>

        <!--=====================================
                    CATEGORY PART START
        =======================================-->
        <section class="section deals-part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>All Items</h2>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">

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

                    <div class="col">
                        <div class="product-card">

                            <div class="product-media">
                                <div class="product-label">
                                    <label class="label-text off">
                                        <?php 
                                        $per = 0;
                                            if($value['regularPrice'] > 0 && $value['sprice'] > 0 && $value['regularPrice'] != $value['sprice']){
                                                $per = round((floatval($value['regularPrice']) - floatval($value['sprice'])) / floatval($value['regularPrice']) * 100);
                                            }
                                        echo $per.'%';
                                        ?>
                                    </label>
                                </div>

                                <button class="product-wish wish">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <?php
                                    if($value['image']){
                                        $img = $value['image'];
                                    }else{
                                        $img = 'demoimg.jpg';
                                    }
                                
                                ?>
                                <input type="hidden" id="imageData" value="<?php echo base_url().'/upload/product/'.$img; ?>">
                                <a class="product-image-items"
                                    href="<?php echo site_url('productDetails').'/'.$value['productID']; ?>">
                                    <img src="<?php echo base_url().'/upload/product/'.$img; ?>" alt="product">
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
                                        if($value['regularPrice'] > 0){
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
                                <button class="product-add add_cart" title="Add to Cart" id="add_cart"
                                    data-productid="<?php echo $value['productID']; ?>" ;
                                    data-productname="<?php echo $value['productName']; ?>"
                                    data-productprice="<?php echo $value['sprice']; ?>" style="padding: 0px;" >
                                    <i class="fas fa-shopping-basket"></i>
                                    <span>add to cart</span>
                                </button>
                                <div class="product-action">
                                    <button class="action-minus" title="Quantity Minus" style="padding: 0px;" ><i class="icofont-minus"></i></button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1" style="padding: 0px;" >
                                    <button class="action-plus" title="Quantity Plus" style="padding: 0px;" ><i class="icofont-plus"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php } ?>

                </div>
                <!--<div class="row">-->
                <!--    <div class="col-lg-12">-->
                <!--        <div class="section-btn-25">-->
                <!--            <a href="<?php echo site_url('view_category_details'); ?>" class="btn btn-inline">-->
                <!--                <i class="fas fa-eye"></i>-->
                <!--                <span>view all deals</span>-->
                <!--            </a>-->

                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </section>
        <!--=====================================
                    CATEGORY PART END
        =======================================-->


        <!--=====================================
                    INTRO PART START
        =======================================-->
        <section class="intro-part" style="padding:60px 0px;">
            <div class="container-fluid">
                <div class="row intro-content">
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="intro-content">
                                <h5>free home delivery</h5>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="intro-content">
                                <h5>instant return policy</h5>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="intro-content">
                                <h5>quick support system</h5>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="intro-content">
                                <h5>secure payment way</h5>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    INTRO PART END
        =======================================-->
<?php $this->load->view('web/footer/footer'); ?>

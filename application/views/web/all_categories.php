<?php $this->load->view('web/header/header'); ?>




        <!--=====================================
                    CATEGORY PART START
        =======================================-->
        <section class="inner-section">
            <div class="container">
                <!--<div class="row">-->
                <!--    <div class="col-lg-12">-->
                <!--        <div class="top-filter">-->
                <!--            <div class="filter-show">-->
                <!--                <label class="filter-label">Show :</label>-->
                <!--                <select class="form-select filter-select">-->
                <!--                    <option value="1">12</option>-->
                <!--                    <option value="2">24</option>-->
                <!--                    <option value="3">36</option>-->
                <!--                </select>-->
                <!--            </div>-->
                <!--            <div class="filter-short">-->
                <!--                <label class="filter-label">Short by :</label>-->
                <!--                <select class="form-select filter-select">-->
                <!--                    <option selected>default</option>-->
                <!--                    <option value="3">trending</option>-->
                <!--                    <option value="1">featured</option>-->
                <!--                    <option value="2">recommend</option>-->
                <!--                </select>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-center">
                    <?php
                        $i = 0;
                        foreach ($categories as $key => $value) { 
                            $i++;
                            $query = $this->db->select('*')
                                            ->from('products')
                                            ->where('categoryID',$value['categoryID'])
                                            ->get();
                            
                              $catProduct = $query->num_rows();
                    ?>
                    <div class="col">
                        <div class="category-wrap">
                            <div class="category-media">
                                <?php if ($value['categoryImage']) { ?>
                                    <img src="<?php echo base_url().'/upload/product/'.$value['categoryImage']; ?>" alt="category">
                                    <?php } else {?>
                                    <img src="<?php echo base_url().'/upload/noimage.jpg'; ?>" alt="category">
                                    <?php }?>
                                
                                <div class="category-overlay">
                                    <a href="<?php echo site_url('categoryDetails').'/'.$value['categoryID']; ?>"><i class="fas fa-link"></i></a>
                                </div>
                            </div>
                            <div class="category-meta">
                                <h4><?php echo $value['categoryName']; ?></h4>
                                <!--<p><?= $catProduct.' item(s)';?></p>-->
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!--<div class="row">-->
                <!--    <div class="col-lg-12">-->
                <!--        <div class="bottom-paginate">-->
                <!--            <p class="page-info">Showing 12 of 60 Results</p>-->
                <!--            <ul class="pagination">-->
                <!--                <li class="page-item">-->
                <!--                    <a class="page-link" href="#">-->
                <!--                        <i class="fas fa-long-arrow-alt-left"></i>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--                <li class="page-item"><a class="page-link active" href="#">1</a></li>-->
                <!--                <li class="page-item"><a class="page-link" href="#">2</a></li>-->
                <!--                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                <!--                <li class="page-item">...</li>-->
                <!--                <li class="page-item"><a class="page-link" href="#">60</a></li>-->
                <!--                <li class="page-item">-->
                <!--                    <a class="page-link" href="#">-->
                <!--                        <i class="fas fa-long-arrow-alt-right"></i>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--            </ul>-->
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

<?php $this->load->view('web/header/header'); ?>

  <div class="product-section section pb-60">
    <div class="container">
      <div class="row mt-30">
        <div class="section-title col">
          <h1>About Us</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12 mt-30">
          <p style="text-align: justify; text-justify: inter-word;"><?php echo $about[0]['about_content']; ?></p>
        </div>
      </div>
    </div>
  </div>

                  

<?php $this->load->view('web/footer/footer'); ?>
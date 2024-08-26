<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Slider</li>
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
                <h3 class="card-title">Update Slider</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>SiteSettings/update_product" enctype="multipart/form-data" >
                  <div class="row">
                    <input type="hidden" class="form-control" name="sid" value="<?php echo $slider_image['sid']; ?>" >
                 
                    
                    <div class="form-group col-md-6 col-sm-12 col-12">
                 <label>Slider Name *</label>
              <input type="text" class="form-control" name="sliderName" value="<?php echo $slider_image['sMessage']; ?>" required >
            </div>
                    
              
                   
                     <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label>Slider Image</label>
                        <div class="custom-file">
                            <input type="file" name="userfile" class="custom-file-input" id="customImg" onchange="loadFile(event)">
                            <label class="custom-file-label" for="customImg">Slider Image <span style="color:gray;">(Optional)</span></label>
                        </div>
                        <div id="imagePreviewContainer">
                            <?php if ($slider_image['simage']) { ?>
                                <img src="<?php echo base_url('upload/product'); ?>/<?php echo $slider_image['simage']; ?>" width="100px">
                            <?php } ?>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-12" style="text-align: center; margin-top: 20px;">
                    <div class="col-md-9 col-md-offset-4">  
                      <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                      <a href="<?php echo site_url('Product') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('footer/footer'); ?>


<script>
    function loadFile(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function () {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            var existingImage = imagePreviewContainer.querySelector('img');
            if (existingImage) {
                existingImage.src = reader.result;
            } else {
                var imgElement = document.createElement('img');
                imgElement.src = reader.result;
                imgElement.style.width = '100px';
                imagePreviewContainer.appendChild(imgElement);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>



<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>
<style>
        /* Mobile Responsive Styles */
@media (max-width: 768px) {
    /*.bs-example-modal-product_add {*/
        max-width: 35%; /* Adjust the maximum width as needed */
        
    /*}*/
    
    .card-header {
          display: flex;
        flex-direction: column;
        align-items: flex-start;
      }
    
      .header-buttons {
          display: flex;
        flex-direction: column;
      }
    
      .header-buttons button {
        margin-top: 5px;
      }
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Slider List</h3>
                <?php if($_SESSION['newproduct'] == 1){ ?>
                <button type="button" class="btn bg-violet product_add" data-toggle="modal" data-target=".bs-example-modal-product_add" style="float: right; margin-left: 10px;" ><i class="fa fa-plus"></i>&nbsp;Add Slider</button>
               
                
              
                <?php } ?>
         
              </div>

              <div class="card-body table-responsive">
                <table id="example" class="table table-bordered" style="width:100%;"  >
                  <thead>
                    <tr>
                      <!--<th  style="width: 5%;">#SN.</th>-->
                      <th  style="width: 10%;">Image</th>
                    
                      <th  style="width: 10%;">Name</th>
                   
                      <th  style="width: 15%;">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($slider_image as $value){
                    $i++;
                    ?>
                    <tr>
                      <!--<td><?php echo $i; ?></td>-->
         
                      
                      <td>
                        <?php if($value['simage'] == null) { ?>
                        <i class="fa fa-shopping-cart fa-4x" aria-hidden="true" ></i>
                        <?php } else{ ?> 
                        <img src="<?php echo base_url().'/upload/product/'.$value['simage']; ?>" style="width: 50px; height: 50px;">
                        <?php } ?> 
                      </td>

                      <td><?php echo $value['sMessage']; ?></td>
                   
   
                      <td>
                   
                        <div class="input-group input-group-md mb-3">
                          <div class="input-group-prepend">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> Action </button>
                            <ul class="dropdown-menu">
                             
                              
                            <?php  { ?>
                              <li class="dropdown-item"><a href="<?php echo site_url('editSlider').'/'.$value['sid']; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                              <li class="dropdown-divider"></li>
                           
                              <li class="dropdown-item"><a href="<?php echo site_url('SiteSettings/delete_products').'/'.$value['sid']; ?>" onclick="return confirm('Are you sure you want to Delete this Product ?');" ><i class="fa fa-trash"></i> Delete</a></li>
                        
                            
                            <?php } ?> 
                            </ul>
                          </div>
                        </div>
                      </td>
                    </tr>   
                    <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php
    $query = $this->db->select('productID')
                  ->from('products')
                  ->where('compid',$_SESSION['compid'])
                  ->limit(1)
                  ->order_by('productID','DESC')
                  ->get()
                  ->row();
    if($query)
        {
        $sn = $query->productID+1;
        }
    else
        {
        $sn = 1;
        }

    $cn = strtoupper(substr($_SESSION['compname'],0,3));
    $pc = sprintf("%'05d",$sn);

    $cusid = 'P-'.$cn.$pc;
    // var_dump($cusid); exit();
?>

    <div class="modal fade bs-example-modal-product_add" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: aliceblue;">
            <h4 class="modal-title">Slider Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <form method="POST" action="<?php echo base_url() ?>SiteSettings/save_slider" enctype="multipart/form-data" >
            <div class="row" style="padding:20px;">
            
            <div class="form-group col-md-6 col-sm-12 col-12">
                 <label>Slider Name *</label>
              <input type="text" class="form-control" name="sliderName" placeholder="Slider Name *" required >
            </div>
           
            
            
           
            
     
            <div class="form-group col-md-6 col-sm-12 col-12">
                <label>Slider Image <small style="color: red; font-size:10px">( Maximum image size 500kb and png, jpg format )</small></label>
                <input type="file" name="userfile" onchange="previewImage(event)">
            </div>
            
            
            <div id="image-preview" class="col-md-6 col-sm-12 col-12" ></div>
            </div>
            
            
            
            
            <div class="modal-footer" style="background-color: aliceblue;">
              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>


    



<?php $this->load->view('footer/footer'); ?>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('image-preview');
            output.innerHTML = '<img src="' + reader.result + '" alt="Product Image" style=" width:100px">';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#categoryID').change(function(){
            var catid = $('#categoryID').val();
              //alert(catid);
            if(catid == 'newCategory')
              {
              $('#newCategory').removeAttr('class','d-none');
              $('#newcat').attr('required','required');
              }
            else
              {
              $('#newCategory').attr('class','d-none');
              $('#newcat').removeAttr('required','required');
              }
            });
          });
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#unit').change(function(){
            var catid = $('#unit').val();
              //alert(catid);
            if(catid == 'newUnit')
              {
              $('#newUnit').removeAttr('class','d-none');
              $('#newut').attr('required','required');
              }
            else
              {
              $('#newUnit').attr('class','d-none');
              $('#newut').removeAttr('required','required');
              }
            });
          });
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#import_form').on('submit',function(event){
            event.preventDefault();
            $.ajax({
              url:"<?php echo base_url(); ?>Product/excel_import",
              method:"POST",
              data:new FormData(this),
              contentType:false,
              cache:false,
              processData:false,
              xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                  if (e.lengthComputable) {
                    var percent = Math.round((e.loaded / e.total) * 100);
                    $('#progressBar').css('width', percent + '%').html(percent + '%');
                  }
                });
                return xhr;
              },
              success:function(data){
                $('#file').val('');
                // load_data();
                // alert(data);
                console.log(data);
                $('#templete').remove();
                $('.modal-backdrop').remove();
                window.location.reload();
              }
            });
          });
        });
      </script>    
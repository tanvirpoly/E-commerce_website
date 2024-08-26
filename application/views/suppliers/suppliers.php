<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Brand</li>
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
                <h3 class="card-title">Brand List</h3>
                <?php if($_SESSION['newsupplier'] == 1){ ?>
                <button type="button" class="btn btn-primary add_supplier" data-toggle="modal" data-target=".bs-example-modal-add_supplier" style="float: right;" ><i class="fa fa-plus"></i> New Brand</button>
                <!--<button type="button" class="btn btn-success template" data-toggle="modal" data-target=".bs-example-modal-template" style="float: right; margin-right: 10px;" ><i class="far fa-file-excel"></i> Import</button>-->
                <?php }  ?>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" >
                  <thead>
                    <tr>
                      <!--<th style="width: 5%;">#SN.</th>-->
                      <!--<th>ID</th>-->
                      <th>Company</th>
                      <th>Brand</th>
                      <th>Mobile</th>
                      <!--<th>Address</th>-->
                      <!--<th>Email</th>-->
                      <!--<th>Price</th>-->
                      
                      <!--<th>Balance</th>-->
                       <!--<th style="width: 10%;">Status</th> -->
                      <th style="width: 10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($supplier as $value){
                    $i++;
                    ?>
                    <tr>
                      <!--<td><?php echo $i; ?></td>-->
                      <!--<td><?php echo $value['sup_id']; ?></td>-->
                      <td><?php echo $value['compname']; ?></td>
                      <td><?php echo $value['supplierName']; ?></td>
                      <td><?php echo $value['mobile']; ?></td>
                      <!--<td><?php echo $value['address']; ?></td>-->
                      <!--<td><?php echo $value['email']; ?></td>-->
                      <!--<td><?php echo number_format($value['balance'],2); ?>-->
                      <!--<td><?php echo number_format($value['balance'],2); ?></td>-->
                       <!--<td><?php echo $value['status']; ?></td> -->
                      <td>
                        <?php if($_SESSION['editsupplier'] == 1){ ?>
                        <button type="button" class="btn btn-success btn-xs supplier_edit" data-toggle="modal" data-target=".bs-example-modal-supplier_edit" data-id="<?php echo $value['supplierID'];?>" id="<?php echo $value['supplierID'];?>" ><i class="fa fa-edit"></i></button>
                        <?php } if($_SESSION['deletesupplier'] == 1){ ?>
                        <a class=" btn btn-danger btn-xs" href="<?php echo site_url('Supplier/delete_supplier').'/'.$value['supplierID']; ?>" ><i class="fa fa-trash"></i></a>
                        <?php } ?>
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
      </div>
    </section>
  </div>

    <div class="modal fade bs-example-modal-add_supplier" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" >
          <div class="modal-header">
            <h4 class="modal-title">Company Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <form autocomplete="off" action="<?php echo base_url('Supplier/save_supplier');?>" method="post">
            <div class="col-md-12 col-sm-12 col-12">
             <div class="form-group col-md-12 col-sm-12 col-12">
                <input type="text" class="form-control" name="compname" placeholder="Company Name" >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-12">
                <input type="text" class="form-control" name="supplierName" placeholder="Brand Name *" required >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number *" onkeypress="return isNumberKey(event)" maxlength="11" required minlength="11" >
              </div>
             
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <input type="email" class="form-control" name="email" placeholder="example@sunshine.com" >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <input type="text" class="form-control" name="address" placeholder="Address" >
              </div>
              <!--<div class="form-group col-md-12 col-sm-12 col-xs-12">-->
              <!--  <input type="text" class="form-control" name="balance" placeholder="Opening Balance" >-->
              <!--</div>-->
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>Brand Image <small style="color: red; font-size:10px">( Maximum image size 500kb and png, jpg format )</small></label>
                <input type="file" name="userfile" onchange="previewImage(event)">
              </div>
              <!--<div class="form-group col-md-12 col-sm-12 col-xs-12">-->
              <!--  <input type="text" class="form-control" name="notes" placeholder="Price" >-->
              <!--</div>-->
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-supplier_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content" >
          <div class="modal-header">
            <h4 class="modal-title">Update Company Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <form action="<?php echo base_url('Supplier/update_supplier');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                  <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Company Name</label>
                  <input type="text" class="form-control" name="compname" id="compname" >
                </div>
                <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Brand Name *</label>
                  <input type="text" class="form-control" name="supplierName" id="supplierName" required >
                </div>
                <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Contact Number *</label>
                  <input type="text" class="form-control" name="mobile" id="mobile" onkeypress="return isNumberKey(event)" maxlength="11" required >
                </div>
                
                <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" id="email" >
                </div>
                <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Address</label>
                  <input type="text" class="form-control" name="address" id="address">
                </div>
                <!--<div class="form-group col-md-6 col-sm-6 col-12">-->
                <!--  <label>Opening Balance</label>-->
                <!--  <input type="text" class="form-control" name="balance" id="balance" >-->
                <!--</div>-->
                <!--<div class="form-group col-md-12 col-sm-12 col-xs-12">-->
                <!--  <label>Price</label>-->
                <!--  <input type="text" class="form-control" name="notes" id="notes" placeholder="Price" >-->
                <!--</div>-->
                
                <div class="form-group col-md-6 col-sm-6 col-12">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status" >
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label>Brand Image</label>
                    <div class="custom-file">
                        <input type="file" name="userfile" class="custom-file-input" id="customImg" onchange="loadFile(event)">
                        <label class="custom-file-label" for="customImg">Brand Image</label>
                    </div>
                    <div id="imagePreviewContainer">
                        <img id="imglink" src="" width="100px">
                    </div>
                </div>
              </div>
              <input type="hidden" id="sup_id" name="sup_id" >
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-template" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content" >
          <div class="modal-header">
            <h4 class="modal-title">Supplier template</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-12">
              <div style="width: 100%; height: 100px; background: aliceblue;text-align: center;">
                <a href="<?php echo base_url('assets/templates/suppliers.xlsx'); ?>" style="padding:1em; text-align: center; display:inline-block; text-decoration: none !important; margin:0 auto;">New template</a>
              </div>
            </div>
            <!--<div class="form-group col-md-6 col-sm-6 col-12">-->
            <!--  <div style="width: 100%;height: 100px;background: #fff4f4;text-align: center;">-->
            <!--    <a href="<?php echo base_url('Supplier/export_action') ?>" style="padding:1em;text-align: center;display:inline-block;text-decoration: none !important;margin:0 auto;">Exists  template</a>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
          <div class="col-md-12 col-sm-12 col-12">
            <form method="post" id="import_form" enctype="multipart/form-data">
              <div class="form-group col-md-12 col-sm-12 col-12">
                <label>Import Template<span style="color: red;">*</span></label>
                <input type="file" name="file" id="file" required accept=".xls, .xlsx" >
              </div>
              <div class="form-group col-md-12 col-sm-12 col-12" style="margin-top: 25px; text-align: center;">
                <input type="submit" name="import" value="Import" class="btn btn-primary" style="width:100px;" >
              </div>
            </form>
            <div class="progress">
              <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
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

    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click','.supplier_edit',function(){
          var catid = $(this).attr("id");
          //alert(l_id);
          $('input[name="sup_id"]').val(catid);
          });

        $(document).on('click','.supplier_edit',function(){
          var id = $(this).attr("id");
          //alert(id);
          var url = '<?php echo base_url() ?>Supplier/get_supplier_data';
          //alert(url);
          $.ajax({
            method: 'POST',
            url     : url,
            dataType: 'json',
            data    : {'id' : id},
            success:function(data){ 
            //alert(data);
            var HTML = data["supplierName"];
            var HTML2 = data["compname"];
            var HTML3 = data["mobile"];
            var HTML4 = data["email"];
            var HTML5 = data["address"];
            var HTML6 = data["balance"];
            var HTML7 = data["status"];
            //alert(HTML);
            $("#supplierName").val(HTML);
            $("#compname").val(HTML2);
            $("#mobile").val(HTML3);
            $("#email").val(HTML4);
            $("#address").val(HTML5);
            $("#balance").val(HTML6);
            $("#status").val(HTML7);
            
            if(data["bimage"]){
                var imageUrl ="https://dhakabazar.online/upload/brand/"+data["bimage"];
            }else{
                var imageUrl ="https://dhakabazar.online/upload/noimage.jpg";
            }
            
    
            // Create the image element and set its attributes
            var imageElement = $('#imglink');
            imageElement.attr('src', imageUrl);
            imageElement.attr('alt', 'Description');
            },
          error:function(){
            alert('error');
            }
          });
        });
      });
    </script>

    <script type="text/javascript" >
      $(document).ready(function(){
        $('#import_form').on('submit',function(event){
          event.preventDefault();
          $.ajax({
            url:"<?php echo base_url(); ?>Supplier/excel_import",
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
            success:function(data)
              {
                //   alert('hi');
              $('#file').val('');
            //   load_data();
            //   alert(data);
              $('#temp').remove();
              $('.modal-backdrop').remove();
              window.location.reload();
              }
            });
          });
        });
    </script>
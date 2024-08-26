<?php $this->load->view('web/header/header'); ?>

  <div class="product-section section pb-60">
    <div class="container">
      <div class="row mt-30">
        <div class="section-title col">
          <h1>Featured Products</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-4 col-12 mt-60">
          <ul>
            <?php foreach ($ssubmanu as $ssvalue) { ?>
            <li><a href="<?php echo base_url().'ssubProduct/'.$ssvalue->ssmid; ?>"><b><?php echo $ssvalue->ssubName; ?></b></a></li>
            <?php } ?>
          </ul>
        </div>

        <div class="col-lg-9 col-md-8 col-12">
          <div class="col-lg-12 col-md-12 col-12 mb-60">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-12">
                <select name="size" id="size" onchange="sub_manu_product()" class="form-control" >
                  <option value="">Size</option>
                  <?php foreach($size as $value) { ?>
                  <option value="<?php echo $value['psid']; ?>"><?php echo $value['sizeName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-12">
                <select name="brand" id="brand" onchange="sub_manu_product()" class="form-control" >
                  <option value="0">Brand</option>
                  <?php foreach($brand as $value) { ?>
                  <option value="<?php echo $value['ct_id']; ?>"><?php echo $value['costName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-12">
                <select name="color" id="color" onchange="sub_manu_product()" class="form-control" >
                  <option value="0">Color</option>
                  <?php foreach($color as $value) { ?>
                  <option value="<?php echo $value['pcid']; ?>"><?php echo $value['colorName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-12">
                <select name="material" id="material" onchange="sub_manu_product()" class="form-control" >
                  <option value="0">Material</option>
                  <?php foreach($material as $value) { ?>
                  <option value="<?php echo $value['pmid']; ?>"><?php echo $value['mName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-12">
                <select name="price" id="price" onchange="sub_manu_product()" class="form-control" >
                  <option value="0">Price</option>
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-12">
                <select name="newIn" id="newIn" onchange="sub_manu_product()" class="form-control" >
                  <option value="0">New In</option>
                  <option value="1">This Week</option>
                  <option value="2">Last Week</option>
                  <option value="3">Last Month</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="smProduct">
            </div>
            <div id="sm2Product" class="">
            <?php foreach ($smview as $pvalue) { ?>
            <input type="hidden" id="untid" value="<?php echo $pvalue->untid; ?>" required >
            <div class="col-lg-4 col-md-4 col-12 mb-60">
              <div class="product">
                <div class="image">
                  <a href="<?php echo base_url().'productDetails/'.$pvalue->productID; ?>" class="img" >
                    <img src="<?php echo base_url().'upload/product/'.$pvalue->image; ?>" alt="Product"></a>
                  <a href="#" class="wishlist"><i class="fa fa-heart-o"></i></a>
                </div>
                <div class="content">
                  <div class="head fix">
                    <div class="title-category">
                      <a href="<?php echo base_url().'brandProduct/'.$pvalue->ct_id; ?>" class="category"><b><?php echo $pvalue->costName; ?></b></a>
                      <a href="<?php echo base_url().'productDetails/'.$pvalue->productID; ?>" class="category"><b><?php echo $pvalue->productName; ?></b></a>
                    </div>
                    <div class="price">
                      <span class="new">৳ <?php echo $pvalue->sprice; ?></span>
                    </div>
                  </div>
                  <!-- <div class="action-button fix">
                    <a href="#">add to cart</a>
                  </div> -->
                </div>
              </div>
            </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php $this->load->view('web/footer/footer'); ?>

    <script type="text/javascript" >
      function sub_manu_product(){
        var id = $('#untid').val();
        var sid = $('#size').val();
        var bid = $('#brand').val();
        var cid = $('#color').val();
        var mid = $('#material').val();
        //var pid = $('#price').val();
        var lid = $('#newIn').val();
        var url = "<?php echo base_url()?>Webhome/sub_manu_product_view";
        //alert(id); alert(lid); //alert(bid);alert(cid); alert(mid); alert(lid);alert(url);
        $.ajax({
          type:'POST',
          url: url,       
          dataType: 'json',
          data: {'id':id,'sid':sid,'bid':bid,'cid':cid,'mid':mid,'lid':lid},
          success:function(data){ 
            //alert(data);
            var HTML = '';
            for(var key in data)
              {
              HTML +="<div class='col-lg-4 col-md-4 col-12 mb-60'><div class='product'><div class='image'><a href='"+"'productDetails/'"+data[key]["productID"]+"'class='img' ><img src='"+'http://localhost/ecommerce/upload/product/'+data[key]["image"]+"' style='width: 100%; height: auto;' ></a><a href='#' class='wishlist'><i class='fa fa-heart-o'></i></a></div><div class='content'><div class='head fix'><div class='title-category'><a href='"+'brandProduct/'+data[key]["ct_id"]+"'class='category'><b>'"+data[key]["costName"]+"'</b></a><a href='"+'productDetails/'+data[key]["productID"]+"'class='category'><b>'"+data[key]["productName"]+"'</b></a></div><div class='price'><span class='new'>৳ '"+data[key]["sprice"]+"'</span></div></div></div></div></div>";
              }
            $("#smProduct").html(HTML);
            $('#sm2Product').attr('class','d-none');
            },
          error:function(data){
            alert('error');
            }
          });
        }
    </script>
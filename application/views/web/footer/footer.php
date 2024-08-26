
   
   
   
    <footer class="footer-part" style="background-color: #000000 !important;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-xl-4">
            <div class="footer-widget">
              <a class="footer-logo" href="<?php echo base_url(); ?>">
                <img style="height:120px" src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>" alt="logo">
              </a>
              <p class="footer-desc">Order grocery and food online with same-day home delivery Without Delivery Charg. Save money, save time..</p>
              <ul class="footer-social">
                <li><a class="icofont-facebook" href="#"></a></li>
                <li><a class="icofont-twitter" href="#"></a></li>
                <li><a class="icofont-linkedin" href="#"></a></li>
                <li><a class="icofont-instagram" href="#"></a></li>
                <li><a class="icofont-pinterest" href="#"></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-xl-4">
            <div class="footer-widget contact">
              <h3 class="footer-title">contact us</h3>
              <ul class="footer-contact">
                <li>
                  <i class="icofont-ui-email"></i>
                  <p>
                    <span><?php echo $company->com_email; ?></span>
                  </p>
                </li>
                <li>
                  <i class="icofont-ui-touch-phone"></i>
                  <p>
                    <span><?php echo $company->com_mobile; ?></span>
                  </p>
                </li>
                <li>
                  <i class="icofont-location-pin"></i>
                  <p><?php echo $company->com_address; ?></p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-xl-4">
            <div class="footer-widget">
              <h3 class="footer-title">quick Links</h3>
              <div class="footer-links">
                <ul>
                  <?php if(isset($_SESSION['uid'])){ ?>
                  <li><a href="<?php echo base_url(); ?>Order">Order History</a></li>
                  <li><a href="<?php echo base_url(); ?>myProfile">My Account</a></li>
                  <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>signUp">Register</a></li>
                  <li><a href="<?php echo base_url(); ?>userLogin">Login</a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div style="background: #171616;" class="footer-bottom">
              <p class="footer-copytext">&copy;  All Copyrights Reserved by <a target="_blank" href="<?php echo base_url(); ?>"><?php echo $company->com_name; ?></a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
       </div>
</div>


    <!-- VENDOR -->
    <script src="<?php echo base_url(); ?>design/vendor/bootstrap/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/bootstrap/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/countdown/countdown.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/niceselect/nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/slickslider/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>design/vendor/venobox/venobox.min.js"></script>
        <!-- CUSTOM -->
    <script src="<?php echo base_url(); ?>design/js/nice-select.js"></script>
    <script src="<?php echo base_url(); ?>design/js/countdown.js"></script>
    <script src="<?php echo base_url(); ?>design/js/accordion.js"></script>
    <script src="<?php echo base_url(); ?>design/js/venobox.js"></script>
    <script src="<?php echo base_url(); ?>design/js/slick.js"></script>
    <script src="<?php echo base_url(); ?>design/js/main.js"></script>
    
    <script>
        $('.header-cart, .cart-btn').on('click', function(){
            $('body').css('overflow', 'hidden');
            $('.cart-sidebar').addClass('active');
            $('.cart-close').on('click', function(){
                $('body').css('overflow', 'inherit');
                $('.cart-sidebar').removeClass('active');
                $('.backdrop').fadeOut();
            });
        });
    </script>
    <script>
// Dropdown Menu
var dropdown = document.querySelectorAll(".dropdown");
var dropdownArray = Array.prototype.slice.call(dropdown, 0);
dropdownArray.forEach(function (el) {
  var button = el.querySelector('a[data-toggle="dropdown"]'),
    menu = el.querySelector(".dropdown-menu"),
    arrow = button.querySelector("i.icon-arrow");

  button.onclick = function (event) {
    if (!menu.hasClass("show")) {
      menu.classList.add("show");
      menu.classList.remove("hide");
      arrow.classList.add("open");
      arrow.classList.remove("close");
      event.preventDefault();
    } else {
      menu.classList.remove("show");
      menu.classList.add("hide");
      arrow.classList.remove("open");
      arrow.classList.add("close");
      event.preventDefault();
    }
  };
});

Element.prototype.hasClass = function (className) {
  return (
    this.className &&
    new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className)
  );
};

</script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

    <script>
      $(document).ready(function() {
        $('#search-input').on('input', function() {
          var query = $(this).val();
          console.log(query);
          if (query.length >= 1) { // Adjust the minimum length for search
    
            // Send an AJAX request to your CodeIgniter controller to fetch search results
            $.ajax({
              type: "POST",
              url: "<?php echo base_url() ?>webhome/search_function", // Replace with your controller and function
              data: { query: query },
              success: function(data) {
                // Display the results in a div
                // console.log(data);
                $('#main-content').hide();
                // $('#search-content').show();
                $("#search-content").removeClass("d-none");
                $('#search-results').html(data);
              },
              error: function(){
                $('#search-results').html('<div>Search for Products</div>');
              }
            });
          } else {
            $('#no-search').html("<div class='col-12' style='color: #9d9898; font-size:30px;font-weight:bold;text-align:center;'>Search for Products</div>"); // Clear the results if query is too short
            $('#search-results').html("");
          }
        });
      });
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,bn',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false,
                exclude: ['.notranslate'],
                multilanguagePage: true
            }, 'google_translate_element');
        }
        
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click', '.product-view', function(){
          var proid = $(this).attr('id');
        //   console.log(proid);
          $('input[name="proid"]').val(proid);
          });

        $(document).on('click', '.product-view', function(){
          var id = $(this).attr('id');
          var url = '<?php echo base_url() ?>Webhome/get_product_by_id';
          $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            data: {'id': id},
            success: function(data){
                console.log(data);

              $("#pName").html(data['productName']);
              $("#productID").html(data['productcode']);
              $("#compname").text(data['compname']);
              if(data['regularPrice'] > 0){
                $("#dprice").text(' ৳ ' + parseFloat(data['regularPrice']).toFixed(2));
              }
              $("#sprice").text(' ৳ ' + parseFloat(data['sprice']).toFixed(2) + '/' +data['unitName']);
            //   $("#unit").text(data['unitName']);
              $("#pdesc").html(data['sortDescription']);
              $("#proImage").attr("src", 'upload/product/' +data["image"]);
              $("#thImage").attr("src", 'upload/product/' +data["image"]);
              },
            error: function(){
              alert('error');
              }
            });
          });
        });
    </script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        var c = 0;
        $(document).on('click','.add_2cart', function(){
             var pid = $(this).data("productid");
            var name = $(this).data("productname");
            var pprice = $(this).data("productprice");
            //alert(pid); alert(name); alert(pprice);
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
    });
</script>
  </body>
</html>

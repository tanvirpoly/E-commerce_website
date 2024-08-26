<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Order</li>
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
                <h3 class="card-title">Order Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo site_url("Order/save_order") ?>">
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Order Date *</label>
                      <input type="text" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y') ?>" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Customer *</label>
                      <div class="input-group input-group-sm">
                        <select name="customerID" id="customerID" class="form-control select2" required >
                        </select>
                        <span class="input-group-append">
                          <button type="button" class="btn btn-danger btn-sm customer_add" data-toggle="modal" data-target=".bs-example-modal-customer_add" ><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Product *</label>                        
                      <select name="productID" id="products" class="form-control select2" required>
                        <option value="">Select One</option>
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="col-md-12 col-sm-12 col-12" >
                      <table id="mtable" class="table table-bordered table-striped">
                        <thead class="btn-default">
                          <tr>
                            <th>Product</th>
                            <th>Quantity</th>      
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                      </table>
                    </div>

                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Total Price *</label>                        
                      <input type="text" class="form-control" readonly name="totalPrice" id="totalPrice" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Paid Amount *</label>                        
                      <input type="text" class="form-control" name="paidAmount" onkeyup="calculate_remain()" id="paidAmount" value="0" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Due Amount</label>                        
                      <input type="text" class="form-control" name="dueAmount" id="dueAmount" readonly >
                    </div>
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Delivery Option *</label>                        -->
                    <!--  <select name="dOption" class="form-control" required >-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <option value="Inside Dhaka">Inside Dhaka</option>-->
                    <!--    <option value="Outside Dhaka">Outside Dhaka</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipping Method</label>
                      <select class="form-control" name="shmethod" >
                        <option value="">Select One</option>
                        <option value="Redx">Redx</option>
                        <option value="Patho">Patho</option>
                        <option value="Sundorban">Sundorban</option>
                        <option value="SA Poribahon">SA Poribahon</option>
                        <option value="Showroon">Showroon</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipping Cost *</label>
                      <input type="text" class="form-control" name="shiping_cost" onkeyup="calculate_tamount()" value="0" onkeypress="return isNumberKey(event)" required >
                    </div>
                    
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipment Company</label>
                      <input type="text" class="form-control" name="sCompany" placeholder="Shipment Company" >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                    <label>Delivery Persion *</label>                        
                      <select name="sName" id="sName" class="form-control select2" required>
                        <option value="">Select One</option>
                        <?php foreach($delivery_man as $value){ ?>
                        <option value="<?php echo $value['userrole']; ?>"><?php echo $value['name'].' ( '.$value['mobile'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipment Contact Number</label>
                      <input type="text" class="form-control" name="sMobile" placeholder="Mobile Number" >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipment Address</label>
                      <input type="text" class="form-control" name="sAddress" placeholder="Address" >
                    </div>
                    
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Note</label>                        
                      <input type="text" class="form-control" name="note" placeholder="If have any note">
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-12" style="margin-top:20px; text-align: center;">
                    <button type="submit" class="btn btn-info"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                    <a href="<?php echo site_url('Order') ?>" class="btn btn-danger" ><i class="fa fa-arrow-left" ></i>&nbsp;&nbsp;Back</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


    <div id="customer_add" class="modal fade bs-example-modal-customer_add" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Customer Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Customer Name *" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number *" onkeypress="return isNumberKey(event)" maxlength="11" minlength="11" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="email" class="form-control" name="email" id="email" placeholder="example@sunshine.com">
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="address" id="address" placeholder="Address *" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="balance" id="balance" placeholder="Opening Balance" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="pbsubmit" ><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
          </div>
        </div>
      </div>
    </div>

<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript" >
      $(function(){
        load_customers();
        function load_customers(){
          var url = "<?php echo base_url()?>Sale/get_sale_customer";
          //alert(url);
          $.ajax({
            type:'POST',
            url: url,       
            dataType: 'json',
            success:function(data){ 
            //alert(data);
              var HTML = "<option value=''>Select One</option>";
              for (var key in data) 
                {
                if (data.hasOwnProperty(key))
                  {
                  HTML +="<option value='"+data[key]["customerID"]+"'>" + data[key]["customerName"]+' ( '+data[key]["mobile"]+' )'+"</option>";
                  }
                }
              $("#customerID").html(HTML);
              },
            error:function(data){
               alert('error');
              }
            });
          }

        $("#pbsubmit").click(function(){
          var customerName = $("#customerName").val();
          var mobile = $("#mobile").val();
          var email = $("#email").val();
          var address = $("#address").val();
          var balance = $("#balance").val();
          var dataString = 'customerName='+ customerName + '&mobile='+ mobile + '&email='+ email + '&address='+ address + '&balance='+ balance;
          // AJAX Code To Submit Form.
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Customer/add_customer') ?>",
            data: dataString,
            cache: false,
            success: function(result){
              //alert(result);
              load_customers();
              $('#customer_add').remove();
              $('.modal-backdrop').remove();
              }
            });
          return false;
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#products').change(function(){        
          var id = $('#products').val();
          var base_url = '<?php echo base_url() ?>'+'Order/getProduct/' + id;
          // alert(id);
          // alert(base_url);
          $.ajax({
            type: 'GET',
            url: base_url,
            dataType: 'text',
            success: function(data){
              var jsondata = JSON.parse(data);                
              $('#tbody').append(jsondata);
              }
            });
          });
        });
    </script>

    <script type="text/javascript">
      function getTotal(id)
        {
        var tp = $('#tp_' + id).val();
        var quantity = $('#quantity_' + id).val();
        
        var totalPrice = parseFloat(quantity) * parseFloat(tp);
        $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
        calculatePrice();
        }

      function calculatePrice()
        {
        var totalPrice = Number(0),pruchaseCost;
        $("input[name='total_price[]']").each(function(){
          totalPrice = Number(parseFloat(totalPrice) + parseFloat($(this).val()));
          });
        $('#totalPrice').val(totalPrice.toFixed(2));
        $('#dueAmount').val(totalPrice.toFixed(2));
        }
        
    function calculate_remain(){
        var paid = $('#paidAmount').val();
        var total = $('#totalPrice').val();
        
        var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
        
        $('#dueAmount').val(remaining);
        }
    </script>
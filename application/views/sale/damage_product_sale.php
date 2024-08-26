<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <!--<section class="content-header">-->
    <!--  <div class="container-fluid">-->
    <!--    <div class="row mb-2">-->
    <!--      <div class="col-sm-6">-->
    <!--        <h1>Sales</h1>-->
    <!--      </div>-->
    <!--      <div class="col-sm-6">-->
    <!--        <ol class="breadcrumb float-sm-right">-->
    <!--          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>-->
    <!--          <li class="breadcrumb-item active">Sales</li>-->
    <!--        </ol>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</section>-->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Damage Product Sale Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>Sale/saved_dproduct_sale" >
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Sale Date *</label>
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
                      <input type="text" id="productID" class="form-control" placeholder="Select Product" autofocus="autofocus" list="pdlist"  >
                      <datalist id="pdlist">
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value->productcode; ?>"><?php echo $value->productName; ?></option>
                        <?php } ?>
                      </datalist>
                    </div>
                  </div>

                    <div class="col-md-12 col-sm-12 col-12" >
                      <table id="mtable" class="table table-bordered table-striped">
                        <thead class="btn-default">
                          <tr>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub Total</th> 
                            <th>Action</th>                       
                          </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                        <tbody>
                          <!--<tr>-->
                          <!--  <td colspan="4" align="right">Shipping Cost *</td>-->
                          <!--  <td>-->
                          <!--    <input type="hidden" class="form-control" id="totalsprice" >-->
                          <!--    <input type="text" id="shiping_cost" class="form-control" name="shiping_cost" onkeyup="calculate_tamount()" value="0" onkeypress="return isNumberKey(event)" required >-->
                          <!--  </td>-->
                          <!--  <td></td>-->
                          <!--</tr>-->
                          <tr>
                            <td colspan="4" align="right">Discount</td>
                            <td>
                              <input type="hidden" class="form-control" id="totaldprice" >
                              <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" onkeyup="discountType()" value="0" >
                              <input type="hidden" class="form-control" id="discounttype" name="discounttype" >
                              <input type="hidden" class="form-control" id="discountamount" name="discountamount" >
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Total Amount *</td>
                            <td><input type="text" name="totalprice" class="form-control" id="totalprice" required readonly ></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Paid Amount *</td>
                            <td><input type="text" id="total_paid" class="form-control" name="total_paid" onkeyup="calculate_remain()" onkeypress="return isNumberKey(event)" required ></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Due Amount</td>
                            <td><input type="text" name="due" class="form-control" id="total_remain" readonly ></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                  <div class="row">
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Delivery Option</label>-->
                    <!--  <select class="form-control" name="dOption" >-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <option value="Inside Dhaka">Inside Dhaka</option>-->
                    <!--    <option value="Outside Dhaka">Outside Dhaka</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipping Method</label>-->
                    <!--  <select class="form-control" name="shmethod" >-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <option value="Redx">Redx</option>-->
                    <!--    <option value="Patho">Patho</option>-->
                    <!--    <option value="Sundorban">Sundorban</option>-->
                    <!--    <option value="SA Poribahon">SA Poribahon</option>-->
                    <!--    <option value="Showroon">Showroon</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Account Type *</label>
                      <select class="form-control" name="accountType" id="accountType" required >
                        <option value="Cash">Cash</option>
                        <option value="Bank">Bank</option>
                        <option value="Mobile">Mobile</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Account No *</label>
                      <select class="form-control" name="accountNo" id="accountNo" >
                        <option value="">Select Account Type First</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Note</label>
                      <textarea type="text" class="form-control" name="note" placeholder="If have any note" rows="4" ></textarea>
                    </div>
                  </div>
                    
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px; text-align: center;">
                    <button type="submit" class="btn btn-info"><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                    <a href="<?php echo site_url('Sale') ?>" class="btn btn-danger" ><i class="fa fa-arrow-left" ></i>&nbsp;&nbsp;Back</a>
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
              <input type="text" class="form-control" name="balance" id="balance" placeholder="Amount" >
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
      $('#productID').on('keyup',function(){
        var id = $('#productID').val();
        var url = '<?php echo base_url() ?>' + 'Sale/damage_product_details/'+id;
         // alert(id); exit();
        $.ajax({
          type: 'GET',
          url: url,
          dataType: 'text',
          success: function(data){
              //alert(data); exit();
            var jsondata = JSON.parse(data);
            $('#mtable').append(jsondata);
            $('#productID').val('');
            }
          });
        });
    </script>

    <script type="text/javascript">

        function totalPrice(id){
            var pices = $('#pices_'+id).val();
            var salePrice = $('#salePrice_'+id).val();

            var totalPrice = (parseFloat(salePrice).toFixed(2)*pices);
            $('#totalPrice_'+id).val(parseFloat(totalPrice).toFixed(2));
            
            var paid = $('#paid_'+id).val();
            if(paid == 0)
                {
                $('#paid_'+id).val(parseFloat(totalPrice).toFixed(2));
                }
            else
                {
                $('#paid_'+id).val(paid);  
                }
            var remaining = parseFloat(totalPrice)-parseFloat(paid);
            $('#remaining_'+id).val(parseFloat(remaining).toFixed(2));
            
            calculateTotalPrice();
            }

        function calculateTotalPrice() {
            var sum=0;
            $(".totalPrice").each(function () {
                sum += parseFloat($(this).val());
            });
            $('#totalprice').val(parseFloat(sum).toFixed(2));
            $('#total_paid').val(parseFloat(sum).toFixed(2));
            $('#totalsprice').val(parseFloat(sum).toFixed(2));
            $('#totaldprice').val(parseFloat(sum).toFixed(2));
            }
            
        function calculate_tamount(){
            var paid = $('#shiping_cost').val();
            var total = $('#totalsprice').val();
            //alert(paid); alert(total); 
            var remaining = +total + +paid;
            
            $('#totalprice').val(parseFloat(remaining).toFixed(2));
            $('#total_paid').val(parseFloat(remaining).toFixed(2));
            $('#totaldprice').val(parseFloat(remaining).toFixed(2));
            }

        function calculate_remain(){
            var paid = $('#total_paid').val();
            var total = $('#totalprice').val();
            var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
            $('#total_remain').val(remaining);
            }
    </script>

    <script type="text/javascript">
      function discountType(){
        var disc = $('#discount').val();
        var total = $('#totalsprice').val();
        var tsa = $('#totaldprice').val();
        var discc = disc.slice(-1);
        var disca = disc.substring(0, disc.length - 1);
      //alert(disca);
        $('#discounttype').val(discc);
        $('#discountamount').val(disca);
        
        if(discc == '%')
          {
          var dis = total*disca;
          var dsa = dis/100;
          
          var total = tsa-dsa;
          }
        else
          {
          var total = tsa-disc;
          }
          
        $('#totalprice').val(parseFloat(total).toFixed(2));
        $('#total_paid').val(parseFloat(total).toFixed(2));
        }
    </script>

    <script type="text/javascript">
    
        $(document).ready(function(){
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val(1);
            });

      $('#accountType').on('change',function(){
        var value = $(this).val();
        $('#accountNo').empty();
        getAccountNo(value, '#accountNo');
        });
        
        function getAccountNo(value,place){
          $(place).empty();
          if(value != ''){
            $.ajax({
              url: '<?php echo site_url()?>Voucher/getAccountNo',
              async: false,
              dataType: "json",
              data: 'id=' + value,
              type: "POST",
              success: function (data){
                $(place).append(data);
                $(place).trigger("chosen:updated");
                }
              });
            }
          else
            {
            customAlert('Please Select Account Type', "error", true);
            }
          }
    </script>

    <script type="text/javascript">
      $(function(){
        $(".select2").select2();
      });
    </script>
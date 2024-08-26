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
              <li class="breadcrumb-item active">Order Delivery</li>
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
                <h3 class="card-title">Order Delivery Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo site_url("Order/savle_sale_Order") ?>">
                  <input type="hidden" name="oid" value="<?php echo $quotation['oid']; ?>" required >
                  <input type="hidden" name="customer" value="<?php echo $quotation['custid']; ?>" required >
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Order Date *</label>
                      <input type="text" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y',strtotime($quotation['oDate'])) ?>" required >
                    </div>
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Select Customer *</label>                        -->
                    <!--  <select name="customer" class="form-control select2" required >-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <?php foreach($customer as $value){ ?>-->
                    <!--    <option <?php echo ($quotation['custid'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['mobile'].' )'; ?></option>-->
                    <!--    <?php } ?>-->
                    <!--  </select>-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Product</label>                        
                      <select name="productID" id="products" class="form-control select2" >
                        <option value="">Select One</option>
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
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
                        <?php 
                        foreach($pquotation as $value){
                        $pid = $value['productID'];
                        ?>
                        <tr>
                          <td>
                            <?php echo $value['productName']; ?>
                            <input class="form-control" type="hidden" readonly='readonly' name='product_id[]' value="<?php echo $value['productID'];?>">
                          </td> 
                          <td>
                            <input class="form-control" type='text' id="quantity_<?php echo $value['productID']?>" onkeyup="getTotal('<?php echo $pid?>')" name='quantity[]' value="<?php echo $value['oQnt']; ?>">
                          </td>
                          <td>
                            <?php //echo $value['oPrice']?>
                            <input class="form-control" type='text' onkeyup='getTotal(<?php echo $value['productID']?>)' id='tp_<?php echo $pid?>' name='tp[]' value='<?php echo $value['oPrice']?>'>
                          </td>
                          <td>
                            <input class="form-control" readonly='readonly' type='text' id='totalPrice_<?php echo $pid?>' name='total_price[]' value='<?php echo $value['tPrice']?>'>
                          </td>
                          <td>
                            <input type="button" class="btn btn-danger" value="Remove" onClick="$(this).parent().parent().remove();">
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="row" >
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Total Price</label>                        
                      <input type="text" class="form-control" name="totalPrice" id="totalPrice" value="<?php echo $quotation['tAmount']; ?>" readonly >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Shipping Method *</label>                        
                      <select class="form-control select2" name="sMethod" id="sMethod" required >
                        <option value="">Select One</option>
                        <?php foreach($shipping as $value){ ?>
                        <option <?php echo ($quotation['shmethod'] == $value['smid'])?'selected':''?>  value="<?php echo $value['smid']; ?>"><?php echo $value['mName']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipping Cost *</label>
                      <input type="text" class="form-control" name="shiping_cost" id="sCost" value="0" required readonly >
                    </div>
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Delivery Charge *</label>-->
                    <!--  <input type="text" class="form-control" name="vAmount" id="vAmount" value="0" onkeyup="calculate_remain()" required  >-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Paid Amount *</label>                        
                      <input type="text" class="form-control" name="paidAmount" onkeyup="calculate_remain()" id="paidAmount" value="0" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Due Amount</label>                        
                      <input type="text" class="form-control" name="dueAmount" id="dueAmount" value="<?php echo ($quotation['tAmount']+$quotation['scost']); ?>" readonly >
                    </div>
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Delivery Option *</label>                        -->
                    <!--  <select name="dOption" class="form-control" required >-->
                    <!--    <option value="<?php echo $quotation['dOption']; ?>"><?php echo $quotation['dOption']; ?></option>-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <option value="Inside Dhaka">Inside Dhaka</option>-->
                    <!--    <option value="Outside Dhaka">Outside Dhaka</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Note</label>                        
                      <input type="text" class="form-control" value="<?php echo $quotation['note']; ?>" name="note" >
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; text-align: center;">
                    <button type="submit" class="btn btn-info">Sale Order</button>
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

<?php $this->load->view('footer/footer'); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#products').change(function(){        
          var id = $('#products').val();
          var base_url = '<?php echo base_url() ?>'+'Quotation/getProduct/' + id;
          // alert(id);alert(base_url);
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
      $(document).ready(function(){
        $('#sMethod').change(function(){        
          var id = $('#sMethod').val();
          var url = '<?php echo base_url() ?>'+'Order/get_shipping_charge';
          // alert(id);alert(base_url);
          $.ajax({
            method: 'POST',
            url     : url,
            dataType: 'json',
            data    : {'id' : id},
            success:function(data){
              var HTML = data["sCharge"];
              
              $("#sCost").val(HTML);
              
              calculate_remain();
              },
            error:function(){
              alert('error');
              }
            });
          });
        });
    </script>

    <script type="text/javascript">
        function getTotal(id){
          var tp = $('#tp_'+id).val();
          var quantity = $('#quantity_'+id).val();
      
          var totalPrice = parseFloat(quantity) * parseFloat(tp);
          $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
          calculatePrice();
          }

        function calculatePrice(){
          var totalPrice = Number(0),pruchaseCost;
          $("input[name='total_price[]']").each(function(){
            totalPrice = Number(parseFloat(totalPrice) + parseFloat($(this).val()));
            });
          $('#totalPrice').val(totalPrice.toFixed(2));
          $('#dueAmount').val(totalPrice.toFixed(2));
          }
          
        function calculate_remain(){
            var paid = $('#paidAmount').val();
            var price = $('#totalPrice').val();
            var sCost = $('#sCost').val();
            //var dc = $('#vAmount').val();
            
            var total = +price + +sCost;
            var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
            
            $('#dueAmount').val(remaining);
            }
    </script>
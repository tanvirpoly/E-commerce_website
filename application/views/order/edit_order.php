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
                <form method="POST" action="<?php echo site_url("Order/update_Order") ?>">
                  <input type="hidden" name="oid" value="<?php echo $quotation['oid']?>">
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Order Date *</label>
                      <input type="text" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y',strtotime($quotation['oDate'])) ?>" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Customer *</label>                        
                      <select name="customer" class="form-control select2" required >
                        <option value="">Select One</option>
                        <?php foreach($customer as $value){ ?>
                        <option <?php echo ($quotation['custid'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['mobile'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Product</label>                        
                      <select id="products" class="form-control select2" >
                        <option value="">Select One</option>
                        <?php foreach($product as $value): ?>
                        <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?></option>
                        <?php endforeach?>
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
                            <input type='text' class="form-control" name='productName[]' value="<?php echo $value['productName']; ?>" required >
                            <input type="hidden" readonly='readonly' name='product_id[]' value="<?php echo $value['productID'];?>">
                          </td> 
                          <td>
                            <input type='text' class="form-control" id="quantity_<?php echo $value['productID']?>" onkeyup="getTotal('<?php echo $pid?>')" name='quantity[]' value="<?php echo $value['oQnt']; ?>">
                          </td>
                          <td>
                            <?php echo $value['oPrice']?>
                            <input type='hidden' class="form-control"  onkeyup='getTotal(<?php echo $value['productID']?>)' id='tp_<?php echo $pid?>' name='tp[]' readonly='readonly' value='<?php echo $value['oPrice']?>'>
                          </td>
                          <td>
                            <input type='text' class="form-control"  id='totalPrice_<?php echo $pid?>' name='total_price[]' value='<?php echo $value['tPrice']; ?>' readonly >
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
                      <input type="text" class="form-control" readonly name="totalPrice" id="totalPrice" value="<?php echo $quotation['tAmount']; ?>">
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Shipping Method *</label>                        
                      <select class="form-control select2" name="shmethod" id="sMethod" required >
                        <option value="">Select One</option>
                        <?php foreach($shipping as $value){ ?>
                        <option value="<?php echo $value['smid']; ?>"><?php echo $value['mName']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Shipping Cost *</label>
                      <input type="text" class="form-control" name="shiping_cost" id="sCost" value="0" required readonly >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                    <label>Delivery Persion *</label>                        
                      <select name="sName" id="sName" class="form-control select2" required>
                        <option value="">Select One</option>
                        <?php foreach($delivery_man as $value){ ?>
                          <option <?php echo ($quotation['custid'] == $value['uid'])?'selected':''?> value="<?php echo $value['uid']; ?>"><?php echo $value['name'].' ( '.$value['mobile'].' )'; ?></option>
                        <!-- <option value="<?php echo $value['userrole']; ?>"><?php echo $value['name'].' ( '.$value['mobile'].' )'; ?></option> -->
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Paid Amount *</label>                        
                      <input type="text" class="form-control" name="paidAmount" onkeyup="calculate_remain()" id="paidAmount" value="0" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Due Amount</label>                        
                      <input type="text" class="form-control" name="dueAmount" id="dueAmount" value="<?php echo $quotation['dueAmount']; ?>" readonly >
                    </div>
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipment Company</label>-->
                    <!--  <input type="text" class="form-control" name="sCompany" value="<?php echo $quotation['sCompany']; ?>" >-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipment Persion</label>-->
                    <!--  <input type="text" class="form-control" name="sName" value="<?php echo $quotation['sName']; ?>" >-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipment Contact Number</label>-->
                    <!--  <input type="text" class="form-control" name="sMobile" value="<?php echo $quotation['sMobile']; ?>" >-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipment Address</label>-->
                    <!--  <input type="text" class="form-control" name="sAddress" value="<?php echo $quotation['sAddress']; ?>" >-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Note</label>                        
                      <input type="text" class="form-control" value="<?php echo $quotation['note']?>" name="note" >
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; text-align: center;">
                    <button type="submit" class="btn btn-info"><i class="far fa-save"></i>&nbsp;&nbsp;Update</button>
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
          var base_url = '<?php echo base_url() ?>'+'Order/getProduct/' + id;
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
            
            var total = +price + +sCost;
            var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
            
            $('#dueAmount').val(remaining);
            }
    </script>
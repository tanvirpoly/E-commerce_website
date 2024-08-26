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
                <h3 class="card-title">Update Sale Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>Sale/update_dproduct_sale" >
                  <input type="hidden" name="saleID" value="<?php echo $sale['saleID']; ?>" required >
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Sale Date *</label>
                      <input type="text" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y', strtotime($sale['saleDate'])) ?>" required >
                    </div> 
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Select Customer *</label>
                      <select class="form-control select2" name="customerID" required >
                        <option value="">Select One</option>
                        <?php foreach($customer as $value):?>
                        <option <?php echo ($sale['customerID'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['mobile'].' )'; ?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Select Product</label>
                      <input type="text" id="productID" class="form-control" placeholder="Select Product" autofocus="autofocus" list="pdlist"  >
                      <datalist id="pdlist">
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value->productcode; ?>"><?php echo $value->productName; ?></option>
                        <?php } ?>
                      </datalist>
                    </div>

                    <div class="col-sm-12 col-md-12 col-12"  >
                      <table id="mtable" class="table table-bordered table-striped">
                        <thead class="btn-default">
                          <tr>
                            <th>Products</th>
                            <th>Stock Quantity</th>
                            <th>Sale Quantity</th>
                            <th>Sale Price</th>
                            <th>Total Price</th> 
                            <th>Action</th> 
                          </tr>
                        </thead>
                        <tbody id="tbody">
                          <?php
                          $sl = 0;
                          foreach($salesp as $value){
                          $id = $value['productID'];
                          $sqt = $this->db->select('dtquantity')
                                      ->from('stock')
                                      ->where('product',$id)
                                      ->get()
                                      ->row();
                          ?>
                          <tr>
                            <td>
                              <?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?>
                              <input type='hidden' name='productID[]' value="<?php echo $value['productID']; ?>">
                            </td>
                            <td>
                              <?php echo $sqt->dtquantity; ?>
                            </td>
                            <td>
                              <input type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='pices[]' id='pices_<?php echo $id ?>' value="<?php echo $value['quantity']; ?>">
                            </td>
                            <td>
                              <input type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='salePrice[]' id='salePrice_<?php echo $id ?>' value="<?php echo $value['sprice']; ?>">
                            </td>
                            <td>
                              <input type='text' class='totalPrice' name='totalPrice[]' readonly id='totalPrice_<?php echo $id ?>' value="<?php echo $value['totalPrice']; $sl += $value['totalPrice']; ?>" >
                            </td>
                            <td>
                              <span class='btn btn-danger item_remove' onClick='$(this).parent().parent().remove();'>x</span>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tbody>
                          <!--<tr>-->
                          <!--  <td colspan="4" align="right">Shipping Cost *</td>-->
                          <!--  <td>-->
                          <!--    <input type="hidden" class="form-control" id="totalsprice" value="<?php echo $sl; ?>" >-->
                          <!--    <input type="text" id="shiping_cost" class="form-control" name="shiping_cost" onkeyup="calculate_tamount()" value="<?php echo $sale['scost']; ?>" onkeypress="return isNumberKey(event)" required >-->
                          <!--  </td>-->
                          <!--  <td></td>-->
                          <!--</tr>-->
                          <tr>
                            <td colspan="4" align="right">Discount</td>
                            <td>
                              <input type="hidden" class="form-control" id="totaldprice" value="<?php echo $sl; ?>" >
                              <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $sale['discount']; ?>" onkeyup="discountType()" value="0" >
                              <input type="hidden" class="form-control" id="discounttype" name="discounttype" >
                              <input type="hidden" class="form-control" id="discountamount" name="discountamount" value="<?php echo $sale['discountAmount']; ?>" >
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Total Amount *</td>
                            <td><input type="text" readonly name="totalprice" class="form-control" id="totalprice" required value="<?php echo $sale['totalAmount']; ?>" ></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Paid Amount *</td>
                            <td><input type="text" id="total_paid" class="form-control" name="total_paid" onkeyup="calculate_remain()" value="<?php echo $sale['paidAmount']; ?>" onkeypress="return isNumberKey(event)" required ></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">Due Amount</td>
                            <td><input type="text" readonly name="due" class="form-control" id="total_remain" value="<?php echo $sale['totalAmount']-$sale['paidAmount']; ?>"  ></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Mamo No. *</label> -->
                    <!--  <input type="text" name="mamo" class="form-control" required placeholder="Mamo No." value="<?php echo $sale['mamo']; ?>" >-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Delivery Option</label>-->
                    <!--  <select class="form-control" name="dOption" >-->
                    <!--    <option value="<?php echo $sale['dOption']; ?>"><?php echo $sale['dOption']; ?></option>-->
                    <!--    <option value="">Select One</option>-->
                    <!--    <option value="Inside Dhaka">Inside Dhaka</option>-->
                    <!--    <option value="Outside Dhaka">Outside Dhaka</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Shipping Method</label>-->
                    <!--  <select class="form-control" name="shmethod" >-->
                    <!--    <option value="<?php echo $sale['shmethod']; ?>"><?php echo $sale['shmethod']; ?></option>-->
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
                        <option value="">Select One</option>
                        <option <?php echo ($sale['accountType'] == 'Cash')?'selected':''?> value="Cash">Cash</option>
                        <option <?php echo ($sale['accountType'] == 'Bank')?'selected':''?> value="Bank">Bank</option>
                        <option <?php echo ($sale['accountType'] == 'Mobile')?'selected':''?> value="Mobile">Mobile</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Account No *</label>
                      <select class="form-control" name="accountNo" id="accountNo" required >
                          <option value="">Select Account Type First</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Note</label>
                      <textarea type="text" class="form-control" name="note" placeholder="If have any note" rows="4" ><?php echo $sale['note']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px; text-align: center;">
                    <button type="submit" class="btn btn-info"><i class="far fa-save"></i>&nbsp;&nbsp;Update</button>
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
    
<?php $this->load->view('footer/footer'); ?>


    <script type="text/javascript">
      $('#productID').on('keyup',function(){
        var id = $('#productID').val();
        var url = '<?php echo base_url() ?>' + 'Sale/damage_product_details/'+id;
          //alert(id); exit();
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

        $(document).ready(function(){
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val("<?php echo $sale['accountNo'] ?>");
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
<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Sale Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>Sale/update_sale" >
                  <input type="hidden" name="saleID" value="<?php echo $sale['saleID']; ?>" required >
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12" style="display:none;">
                      <label>Sale Date *</label>
                      <input type="hidden" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y', strtotime($sale['saleDate'])) ?>" required >
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
                      <!--<input type="text" id="productID" class="form-control" placeholder="Select Product" autofocus="autofocus" list="pdlist"  >-->
                      <select name="productID" id="productID" class="form-control select2">
                        <option value="">Select One</option>
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName'].' ( '.$value['productcode'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                        <label>Send SMS? *</label>
                        <select name="sms" class="form-control select2" required >
                            <option <?= ($sale['sms'] == 1)? 'selected':'';?> value="1">Yes</option>
                            <option <?= ($sale['sms'] == 0)? 'selected':'';?> value="0">No</option>
                        </select>
                    </div>
                    
                    

                    <div class="col-sm-12 col-md-12 col-12"  >
                      <table id="mtable" class="table table-bordered table-striped">
                        <thead class="btn-default">
                          <tr>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th> 
                            <th>Action</th> 
                          </tr>
                        </thead>
                        <tbody id="tbody">
                          <?php
                          $sl = 0;
                          foreach($salesp as $value){
                          $id = $value['productID'];
                          $sqt = $this->db->select('totalPices')
                                      ->from('stock')
                                      ->where('compid',$_SESSION['compid'])
                                      ->where('product',$id)
                                      ->get()
                                      ->row();
                          ?>
                          <tr>
                            <!--<td>-->
                              <!--<?php echo $value['productcode']; ?>-->
                              <input type='hidden' name='productID[]' value="<?php echo $value['productID']; ?>">
                            <!--</td>-->
                            <td>
                                <?php echo $value['pName']; ?>
                              <input type='hidden' name='productName[]' value="<?php echo $value['pName']; ?>">
                            </td>
                            <!--<td>-->
                            <!--  <?php echo $sqt->totalPices; ?>-->
                            <!--</td>-->
                            <td>
                              <input class="form-control" type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='pices[]' id='pices_<?php echo $id ?>' value="<?php echo $value['quantity']; ?>">
                            </td>
                            <td>
                              <input class="form-control" type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='salePrice[]' id='salePrice_<?php echo $id ?>' value="<?php echo $value['sprice']; ?>">
                            </td>
                            <td>
                              <input type='text' class='totalPrice form-control' name='totalPrice[]' readonly id='totalPrice_<?php echo $id ?>' value="<?php echo $value['totalPrice']; $sl += $value['totalPrice']; ?>" >
                            </td>
                            <td>
                              <span class='btn btn-danger item_remove' onclick='deleteProduct(this)' ><i class='fa fa-trash'></i></span>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tbody>
                        <tr>
                          <td colspan="3" align="right" >Total Amount</td>
                          <td colspan="2">
                            <input type="text" name="totalprice" class="form-control" id="tAmount" value="<?php echo $sl; ?>" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >VAT</td>
                          <td colspan="2" >
                            <input type="text" class="form-control" name="vCost" id="vCost" onkeyup="vatcostcalculator()" value="<?php echo $sale['vCost']; ?>" >
                            <input type="hidden" class="form-control" name="vType" id="vType" value="<?php echo $sale['vType']; ?>" >
                            <input type="hidden" class="form-control" name="vAmount" id="vAmount" value="<?php echo $sale['vAmount']; ?>" >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Discount</td>
                          <td colspan="2" >
                            <input type="text" class="form-control" name="discount" id="discount" onkeyup="discountType()" value="<?php echo $sale['discount']; ?>" >
                            <input type="hidden" class="form-control" id="disType" name="disType" value="<?php echo $sale['discountType']; ?>" >
                            <input type="hidden" class="form-control" id="disAmount" name="disAmount" value="<?php echo $sale['discountAmount']; ?>" >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Net Amount</td>
                          <td colspan="2">
                            <input type="text" class="form-control" name="nAmount" id="nAmount" value="<?php echo (($sl+$sale['vAmount'])-$sale['discountAmount']); ?>" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Previous Due Amount</td>
                          <td colspan="2"  >
                            <input type="text" class="form-control" name="pdAmount" id="pdAmount" value="<?php echo $sale['pdAmount']; ?>" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right">Paid Amount *</td>
                          <td colspan="2"  >
                            <input type="text" class="form-control" name="pAmount" onkeyup="calculate_remain()" id="pAmount" value="<?php echo $sale['paidAmount']; ?>" required >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right">Due Amount *</td>
                          <td colspan="2"  ><input type="text" class="form-control" name="dAmount" id="dAmount" value="<?php echo $sale['dueamount']; ?>" readonly ></td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                    
                        
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
                    <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                    <!--  <label>Message *</label>-->
                    <!--  <textarea type="text" class="form-control" name="sCompany" placeholder="Message"><?php echo $sale['sCompany']; ?></textarea>-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Note</label>
                      <textarea type="text" class="form-control" name="note" placeholder="If have any note" rows="1" ><?php echo $sale['note']; ?></textarea>
                    </div>
                    <!--<div class="form-group col-md-12 col-sm-12 col-12">-->
                    <!--  <label>Terms & Conditions</label>-->
                    <!--  <textarea type="text" class="form-control" name="terms" id="editor" placeholder="Terms & Conditions"><?php echo $sale['terms']; ?></textarea>-->
                    <!--</div>-->
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
      $(document).ready(function(){
        $('#customerID').change(function(){ 
          var id = $('#customerID').val();
          var url = '<?php echo base_url() ?>'+'Sale/get_customer_due_amount_data';
            // alert(id);
          $.ajax({
            type: 'POST',
            async: false,
            url: url,
            data: {'id' : id},
            dataType: 'json',
            success: function(data)
              {
                //   console.log(data);
            //   alert(HTML);
              $("#pdAmount").val(data);
              },
            error:function(data){
              alert('Error');
              }
            });
          });
        });
    </script>
    
    <script type="text/javascript">
      $('#productID').change(function(){
        var id = $('#productID').val();
        var url = '<?php echo base_url() ?>' + 'Sale/getDetails2/'+id;
          //alert(id); exit();
        $.ajax({
          type: 'GET',
          url: url,
          dataType: 'text',
          success: function(data){
              //alert(data); exit();
              if(data==1){
                  alert('Product stock is not available')
              }
              else if(data==2){
                  alert('Product is already added')
              }
              else{
                var jsondata = JSON.parse(data);
                $('#mtable').append(jsondata);
                calculatePrice();
              }
            //$('#productID').val('');
            }
          });
        });
    </script>
    
    <script type="text/javascript" >
      function deleteProduct(o) {
        var p=o.parentNode.parentNode;
        p.parentNode.removeChild(p);
         
        calculatePrice();
        }
    </script>
    
    <script type="text/javascript">
      function totalPrice(id){        
        var quantity = $('#pices_'+id).val();
        var tp = $('#salePrice_'+id).val();
        // alert(tp); alert(quantity);
        var totalPrice = quantity*parseFloat(tp);
        $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
        
        calculatePrice();
        }

      function calculatePrice() {
        var sum=0;
        $(".totalPrice").each(function()
          {
          sum += parseFloat($(this).val());
          });
            // alert(sum);
        $('#tAmount').val(parseFloat(sum).toFixed(2));
        $('#nAmount').val(parseFloat(sum).toFixed(2));
        $('#dAmount').val(parseFloat(sum).toFixed(2));
            // $('#remainging').val(totalPrice);
        calculate_remain();
        }

      function calculate_remain()
        {
        var ta = $('#tAmount').val();
        var vat = $('#vAmount').val();
        var dis = $('#disAmount').val();
        var pda = $('#pdAmount').val();
        var paid = $('#pAmount').val();
        
        var net = ((+ta + +vat)-dis);
        var due = ((+net + +pda)-paid);
        
        $('#nAmount').val(parseFloat(net).toFixed(2));
        $('#dAmount').val(parseFloat(due).toFixed(2));
        }
    </script>
    
    <script type="text/javascript">
      function vatcostcalculator(){
        var vat = $('#vCost').val();
        var total = $('#tAmount').val();
        var discc = vat.slice(-1);
        var disca = vat.substring(0, vat.length - 1);
        //alert(discc);
        $('#vType').val(discc);
        
        if(discc == '%')
          {
          var da = parseFloat(total).toFixed(2)*parseFloat(disca).toFixed(2);
          var dat = parseFloat(da).toFixed(2)/100;
            //alert(da);alert(dat);
          $('#vAmount').val(dat);
          }
        else
          {
          $('#vAmount').val(vat);
          }
            //alert(remaining);
        calculate_remain();
        }
    </script>
    
    <script type="text/javascript">
      function discountType(){
        var disc = $('#discount').val();
        var total = $('#tAmount').val();
        var discc = disc.slice(-1);
        var disca = disc.substring(0, disc.length - 1);
            //alert(discc);
        $('#disType').val(discc);
        
        if(discc == '%')
          {
          var da = parseFloat(total).toFixed(2)*parseFloat(disca).toFixed(2);
          var dat = parseFloat(da).toFixed(2)/100;
            //alert(da);alert(dat);
          $('#disAmount').val(dat);
          }
        else
          {
          $('#disAmount').val(disc);
          }
          //alert(remaining);
        calculate_remain();
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
    
    
<?php $this->load->view('header/header'); ?>
<?php $this->load->view('navbar/navbar'); ?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">Sale Information</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url() ?>Sale/saved_sale" enctype='multipart/form-data' >
                  <div class="row">
                    <div class="form-group col-md-4 col-sm-4 col-12" style="display:none;">
                      <label>Sale Date *</label>
                      <input type="hidden" name="date" class="form-control datepicker" value="<?php echo date('m/d/Y') ?>" required >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>CUSTOMER*</label>
                      <div class="input-group input-group-sm">
                        <select name="customerID" id="customerID" class="form-control select2"  required >
                          <option value="">Select One</option>
                        </select>
                        <span class="input-group-append" style="margin-left:-30px;">
                          <button type="button" class="btn btn-danger btn-sm customer_add" data-toggle="modal" data-target=".bs-example-modal-customer_add" style="position: absolute; height: -webkit-fill-available;"><i class="fa fa-plus"></i></button>
                        </span>
                      </div>
                    </div>
                    
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>ITEM*</label>
                      <!--<input type="text" id="productID" class="form-control" placeholder="Select Product" list="pdlist"  >-->
                      <select name="productID" id="productID" class="form-control select2" required >
                        <option value="">Select One</option>
                        <?php foreach($product as $value){ ?>
                        <option value="<?php echo $value->productID; ?>"><?php echo $value->productName.' | Stock: '.$value->totalPices.' | Price: '.$value->sprice; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-12">
                      <label>Send SMS? *</label>
                      <select name="sms" class="form-control select2" required >
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12 col-12 table-responsive" >
                    <table id="mtable" class="table table-bordered table-striped">
                      <thead class="btn-default">
                        <tr>
                          <th>Item</th>
                          <th>QTY</th>
                          <th>Rate</th>
                          <th>Total</th> 
                          <th>Action</th>                       
                        </tr>
                      </thead>
                      <tbody id="tbody">

                      </tbody>
                      <tbody>
                        <tr>
                          <td colspan="3" align="right" >Total Amount</td>
                          <td colspan="2">
                            <input type="text" name="totalprice" class="form-control" id="tAmount" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >VAT</td>
                          <td colspan="2" >
                            <input type="text" class="form-control" name="vCost" id="vCost" onkeyup="vatcostcalculator()" value="0" >
                            <input type="hidden" class="form-control" name="vType" id="vType" value="0" >
                            <input type="hidden" class="form-control" name="vAmount" id="vAmount" value="0" >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Discount</td>
                          <td colspan="2" >
                            <input type="text" class="form-control" name="discount" id="discount" onkeyup="discountType()" value="0" >
                            <input type="hidden" class="form-control" id="disType" name="disType" value="0" >
                            <input type="hidden" class="form-control" id="disAmount" name="disAmount" value="0" >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Net Amount</td>
                          <td colspan="2">
                            <input type="text" class="form-control" name="nAmount" id="nAmount" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right" >Previous Due Amount</td>
                          <td colspan="2"  >
                            <input type="text" class="form-control" name="pdAmount" id="pdAmount" value="0" required readonly >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right">Paid Amount *</td>
                          <td colspan="2"  >
                            <input type="text" class="form-control" name="pAmount" value="0" onkeyup="calculate_remain()" id="pAmount" required >
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right">Due Amount *</td>
                          <td colspan="2"  ><input type="text" class="form-control" name="dAmount" id="dAmount" readonly ></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                    <div class="row">
                        <div class="form-group col-md-4 col-sm-4 col-12">
                          <label>Payment Type *</label>
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
                        <!--<div class="form-group col-md-4 col-sm-4 col-12">-->
                        <!--  <label>Note</label>-->
                        <!--  <textarea type="text" class="form-control" name="note" placeholder="If have any note" rows="1" ></textarea>-->
                        <!--</div>-->
                        <!--<div class="form-group col-md-12 col-sm-6 col-12">-->
                        <!--  <label>Terms & Conditions</label>-->
                        <!--  <textarea type="text" class="form-control" name="terms" id="editor" placeholder="Terms & Conditions"></textarea>-->
                        <!--</div>-->
                    </div>
                    
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px; text-align: center;">
                    <button type="submit" class="btn btn-info" onclick="" ><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
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
          <form method="POST" action="<?php echo base_url() ?>Sale/saved_customer" >
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number *" onkeypress="return isNumberKey(event)" maxlength="11" minlength="11" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Customer Name " >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="customerCompany" id="customerCompany" placeholder="Company Name " >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" name="address" id="address" placeholder="Address *" required >
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <input type="email" class="form-control" name="email" id="email" placeholder="example@sunshine.com">
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <input type="text" class="form-control" name="balance" id="balance" value="0" >
            </div>
          </div>
          <div class="modal-footer">
            <button style="size: 100px;" type="submit" class="btn btn-primary" id="pbsubmit" ><i class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
          </div>
          </form>
        </div>
      </div>
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
                //   HTML +="<option if(data[key]['customerID'] == 2){selected} value='"+data[key]["customerID"]+"'>" + data[key]["mobile"]+' ( '+data[key]["customerName"]+' )'+"</option>";
                  HTML += "<option " + (data[key]['customerID'] == 2 ? "selected" : "") + " value='" + data[key]["customerID"] + "'>" + data[key]["mobile"] + ' ( ' + data[key]["customerName"] + ' )' + "</option>";


                  }
                }
              $("#customerID").html(HTML);
              }
            });
          }

        // $("#pbsubmit").click(function(){
        //   var customerName = $("#customerName").val();
        //   var mobile = $("#mobile").val();
        //   var email = $("#email").val();
        //   var address = $("#address").val();
        //   var balance = $("#balance").val();
        //   var dataString = 'customerName='+ customerName + '&mobile='+ mobile + '&email='+ email + '&address='+ address + '&balance='+ balance;
        //   // AJAX Code To Submit Form.
        //   $.ajax({
        //     type: "POST",
        //     url: "<?php echo site_url('Customer/add_customer') ?>",
        //     data: dataString,
        //     cache: false,
        //     success: function(result){
        //       //alert(result);
        //       load_customers();
        //       $(".card-body").css({ overflow:"auto" });
        //       $('#customer_add').remove();
        //       $('.modal-backdrop').remove();
        //       }
        //     });
        //   return false;
        // });
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
        var stock = $('#stock').html();
        // alert(tp); alert(quantity);
        
        if(parseFloat(quantity) > parseFloat(stock))
          {
          document.getElementById('pices_' + id).style.background="#FFCCCB";
          alert('You do not have enough stock for this item');
            // document.getElementById('quantity_' + id).setAttribute('readonly', true);
          document.getElementById('pices_' + id).value = 0;
          quantity = 0;
          }
        else
          {
          document.getElementById('pices_' + id).style.background = "white";
          }
        
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

    
<?php $this->load->view('header/header'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?php $this->load->view('navbar/navbar22'); ?>

<style>
    .text {
        display: block;
        /* or inline-block */
        text-overflow: ellipsis;
        word-wrap: break-word;
        overflow: hidden;
        max-height: 1.6em;
        max-width: 7.8em;
        line-height: 1.8em;
    }
    .select-wrapper {
        display: flex;
        align-items: center;
      }
      .customer_add {
        margin-left: 10px;
      }
</style>
<div class="basic-form-area mg-b-15" style="min-height: 550px;">
    <div class="container-fluid">
        <div class="row" style="margin: 15px 15px 0px 15px;display: flex;flex-direction: row;justify-content: center;">
            <?php
        $exception=$this->session->userdata('exception');
        if(isset($exception))
        {
        echo $exception;
        $this->session->unset_userdata('exception');
        } ?>

            <div style="background: #F5F5F5;" class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset">
                    <div class="sparkline8-hd">

                    </div>
                    <div class="sparkline8-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">
                                        <form method="POST" name="itemForm"
                                            action="<?php echo site_url('Sale/save_pos_sale') ?>"
                                            enctype="multipart/form-data">
                                            <!--<form action="#" id="pos_sales_submit" method="post" >-->
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <label>CUSTOMER *</label>
                                                    <div class=" col-md-11 col-sm-11 col-xs-11 select-wrapper">
                                                        <select elect name="customerID" id="customerID"
                                                            class="form-control select2" required>
                                                        </select>
                                                        <!--<span class="input-group-append">-->
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm customer_add"
                                                                data-toggle="modal"
                                                                data-target=".bs-example-modal-customer_add"><i
                                                                    class="fa fa-plus"></i></button>
                                                        <!--</span>-->
                                                    </div>
                                                    
                                                    <label>PRODUCT *</label>
                                                    
                                                    <input type="text" name="" id="product" class="form-control"
                                                        placeholder="Search Product Name / Code" autofocus />
                                                        
                                                    <p id="message" style="color:red"></p>
                                                    
                                                    <!--<input list="pdlist" name="productID" id="productID"-->
                                                    <!--    class="form-control" placeholder="Search Product Name"-->
                                                    <!--    autofocus />-->
                                                    <!--<datalist id="pdlist">-->
                                                    <!--    <?php foreach($products as $value){ ?>-->
                                                    <!--    <option value="<?php echo $value['productcode']; ?>"></option>-->
                                                    <!--    <?php } ?>-->
                                                    <!--</datalist>-->
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="mtable" class="table">
                                                    <thead>
                                                        <tr style="background: #000; color: #fff;">
                                                            <th style="width: 30%;">ITEM</th>
                                                            <th style="width: 10%;">STOCK</th>
                                                            <th style="width: 15%;">QTY</th>
                                                            <th style="width: 15%;">RATE</th>
                                                            <th style="width: 15%;">AMOUNT</th>
                                                            <th style="width: 10%;">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Shipping Cost (+)</label>
                                                    <input type="hidden" class="form-control" id="tsAmount" value="0"
                                                        required>
                                                    <input type="text" class="form-control" name="sCost" id="sCost"
                                                        onkeyup="shippingCost()" required value="0">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>VAT & Tax (%) (+) </label>
                                                    <input type="text" class="form-control" name="vCost" id="vCost"
                                                        onkeyup="vatcostcalculator()" value="0">
                                                    <input type="hidden" class="form-control" name="vType" id="vType"
                                                        value="0">
                                                    <input type="hidden" class="form-control" name="vAmount"
                                                        id="vAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>Discount (-)</label>
                                                    <input type="text" class="form-control" name="discount"
                                                        id="discount" onkeyup="discountType()" value="0">
                                                    <input type="hidden" class="form-control" id="disType"
                                                        name="disType" value="0">
                                                    <input type="hidden" class="form-control" id="disAmount"
                                                        name="disAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label>TOTAL*</label>
                                                    <input type="text" name="nAmount" class="form-control" id="nAmount"
                                                        placeholder="Total Amount" required readonly>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label style="color: green;">PAID*</label>
                                                    <input type="text" name="totalprice" class="form-control"
                                                        id="totalprice" onkeyup="duecalculator()"
                                                        placeholder="Paid Amount" required>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                    <label style="color: red;">DUE</label>
                                                    <input type="text" name="dAmount" class="form-control" id="dAmount"
                                                        placeholder="Due Amount" value="0" required readonly>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-12">
                                                    <label>PAYMENT MODE *</label>
                                                    <select class="form-control" name="accountType" id="accountType"
                                                        required>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Bank">Bank</option>
                                                        <option value="Mobile">Mobile</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-12">
                                                    <label>ACCOUNT *</label>
                                                    <select class="form-control" name="accountNo" id="accountNo"
                                                        required>
                                                        <option value="">Select Account Type First</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <label>Notes</label>
                                                    <input type="text" class="form-control" name="note"
                                                        placeholder="If have any notes">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12"
                                                style="text-align: center; margin-top: 20px;">
                                                <button type="button" class="btn btn-success form-control"
                                                    onclick="document.itemForm.submit()"><i class="fa fa-floppy-o"></i>
                                                    PAY NOW</button>
                                                <a class="btn btn-danger form-control mt-2"
                                                    href="<?php echo site_url(); ?>posSales"><i class="fa fa-trash"></i>
                                                    CANCEL</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background: #fff;width:20px;"></div>
            <div style="background: #F5F5F5;" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="sparkline8-list basic-res-b-30 shadow-reset" style>
                    <div class="sparkline8-graph" style="margin-left: 10px;">
                        <div class="basic-login-form-ad" style="background: #f5f5f5;min-height: 636px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin:0 auto;">
                                <input class="form-control" type="text" id="search-box" placeholder="Search..." title="Search your product here" style="margin:10px;">
                                <!-- <button id="sort-button">Sort A-Z</button> -->
                            </div>
                            <div class="row" style="display: flex;justify-content: space-around;align-items: center;" id="button-container">
                                <?php $i = 0; foreach($sproduct as $value){ $i++; ?>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="background: white; text-align: center; margin-bottom:10px; margin-right:5px;width: 100px;height: 100px;border: 1px solid #eee;overflow:hidden;">
                                    <button class="btn btn-link" value="<?php echo $value['productcode']; ?>"
                                        id="productcode_<?php echo $value['productID']; ?>"
                                        onclick="pos_product_add(<?php echo $value['productID']; ?>)"
                                        title="<?php echo $value['productName']; ?>">
                                        <?php if($value['image'] == null){ ?>
                                        <!--<img src="<?php echo base_url().'assets/product.png'; ?>" style="max-height: 60px;" >-->
                                        <i class="fa fa-shopping-cart" style="max-height: 60px;font-size:60px;"></i>
                                        <?php } else{ ?>
                                        <img src="<?php echo base_url().'upload/product/'.$value['image']; ?>"
                                            style="max-height: 60px;" alt="img">
                                        <?php } ?>
                                        <p class="text"
                                            style="color: black; font-size: 13px; font-weight: bold;text-align:center;">
                                            <?php echo $value['productName']; ?></p>
                                    </button>
                                </div>
                                <?php if($i%6 == 0) { ?>
                                <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>-->
                                <?php } ?>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="customer_add" class="modal fade bs-example-modal-customer_add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" name="customerName" id="customerName"
                        placeholder="Customer Name *" required>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number *"
                        onkeypress="return isNumberKey(event)" maxlength="11" minlength="11" required>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@sunshine.com">
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <input type="text" class="form-control" name="balance" id="balance" placeholder="Amount">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="pbsubmit" onclick="return false;"><i
                        class="far fa-save"></i>&nbsp;&nbsp;Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="far fa-window-close"></i>&nbsp;&nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer/footer22'); ?>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $('#search-box').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('#button-container div').each(function() {
                var buttonText = $(this).text().toLowerCase();
                if (buttonText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
    $(document).ready(function() {
        // Filter buttons based on search term
        $('#search-box').on('input', function() {
            // Same as above
        });
        // Sort buttons based on text
        $('#sort-button').on('click', function() {
            var buttons = $('#button-container button').get();
            buttons.sort(function(a, b) {
                var aText = $(a).text().toLowerCase();
                var bText = $(b).text().toLowerCase();
                return aText.localeCompare(bText);
            });
            $('#button-container').empty().append(buttons);
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        load_customers();

        function load_customers() {
            var url = "<?php echo base_url()?>Sale/get_sale_customer";
            //alert(url);
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                success: function(data) {
                    //alert(data);
                    //var HTML = "<option value=''>Select One</option>";
                    var HTML = "";
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            HTML += "<option value='" + data[key]["customerID"] + "'>" + data[key][
                                "customerName"
                            ] + ' ( ' + data[key]["mobile"] + ' )' + "</option>";
                        }
                    }
                    $("#customerID").html(HTML);
                },
                error: function(data) {
                    alert('error');
                }
            });
        }
        $("#pbsubmit").click(function() {
            var customerName = $("#customerName").val();
            var mobile = $("#mobile").val();
            var email = $("#email").val();
            var address = $("#address").val();
            var balance = $("#balance").val();
            var dataString = 'customerName=' + customerName + '&mobile=' + mobile + '&email=' + email +
                '&address=' + address + '&balance=' + balance;
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Customer/add_customer') ?>",
                data: dataString,
                cache: false,
                success: function(result) {
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
    // var browsers = document.getElementById('productID');
    //  // On Select Event Listener
    // browsers.addEventListener('change', function(e) {
    //      var val = this.value;
    //     if ($('#pdlist option').filter(function() {
    //             return this.value.toUpperCase() === val.toUpperCase();
    //         }).length) {
    //      var  productCode = val
    //         var url = '<?php echo base_url() ?>' + 'Sale/get_pos_sale_details/' + productCode;
    //             $('#productID').val('');
    //             //alert(id); alert(url); //exit();
    //             $.ajax({
    //                 type: 'GET',
    //                 url: url,
    //                 dataType: 'text',
    //                 success: function(data) {
    //                     if (data == 1) {
    //                         alert('You have already added this item');
    //                     } else {
    //                         var jsondata = JSON.parse(data);
    //                         //alert(jsondata); exit();
    //                         $('#mtable').append(jsondata);
    //                         //$('#parcelID').val('');
    //                         //return false;
    //                         calculatePrice(); 
    //                     }
    //                 }
    //             });
    //     }
    // });
    // jQuery(document).ready(function($) {
    //     function delay(callback, ms) {
    //         var timer = 0;
    //         return function() {
    //             var context = this,
    //                 args = arguments;
    //             clearTimeout(timer);
    //             timer = setTimeout(function() {
    //                 callback.apply(context, args);
    //             }, ms || 0);
    //         };
    //     }
    //     // Enter event Listene
    //     $('#productID').on('keyup', delay(function(e) {
    //         if (e.keyCode == 13) {
    //             var productCode = $('#productID').val();
    //             var url = '<?php echo base_url() ?>' + 'Sale/get_pos_sale_details/' + productCode;
    //             $('#productID').val('');
    //             //alert(id); alert(url); //exit();
    //             $.ajax({
    //                 type: 'GET',
    //                 url: url,
    //                 dataType: 'text',
    //                 success: function(data) {
    //                     if (data == 1) {
    //                         alert('You have already added this item');
    //                     } else {
    //                         var jsondata = JSON.parse(data);
    //                         //alert(jsondata); exit();
    //                         $('#mtable').append(jsondata);
    //                         //$('#parcelID').val('');
    //                         //return false;
    //                         calculatePrice(); 
    //                     }
    //                 }
    //             });
    //         }
    //     }, 200));
    // });
</script>

<script type="text/javascript">
    $('#product').keypress(function(event) {
        if (event.keyCode == 10) {
            var productcode = this.value;
            //alert(productcode);
            $.ajax({
                url: '<?php echo base_url() ?>' + 'Sale/get_pos_sale_details_with_code/' + productcode,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    // alert(data.productID);
                    $('#product').val("");
                    $("#product").focus();
                    return pos_product_add(data.productID);
                }
            })
        }
    });
    var adata;
    jQuery(document).ready(function($) {
        $.ajax({
            url: '<?php echo base_url() ?>' + 'Sale/getAllProductDetailsWithJSON/',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                adata = $.map(data, function(value, key) {
                    return {
                        id: value.productID,
                        label: value.productName +' | Stock:'+ value.totalPices+' | Sale Price:'+ value.sprice,
                        code: value.productcode,
                    };
                });
                // console.log(adata);
            }
        })
    })
    $("#product").autocomplete({
        source: function(request, response) {
            var results = $.ui.autocomplete.filter(adata, request.term);
            response(results);
        },
        select: function(event, ui) {
            //alert(ui.item.code);
            pos_product_add(ui.item.id);
            ui.item.value = "";
        }
    });

    function pos_product_add(id) {
        var id = $('#productcode_' + id).val();
        var table = 'products';
        var info = {
            'id': id,
            'table': table
        };
        var url = '<?php echo base_url() ?>' + 'Sale/get_pos_sale_details/' + id;
        // console.log(url);
        // $('#productID').val('');
        // alert(id); alert(url);
        $.ajax({
            type: 'POST',
            async: false,
            url: url,
            data: info,
            dataType: 'json',
            success: function(data) {
                if (data == 1) {
                    //alert('You already add this item');
                    $('#message').text('You have already added this item');
                    $('#product').val("");
                    $("#product").focus();
                    return false;
                } else {
                    // alert(data); 
                    // var jsondata = JSON.parse(data);
                    $('#mtable tbody').append(data);
                    //$('#product').val('');
                    calculatePrice();
                }
                // $('#mtable tbody').append(jsondata);
                //$('#product').val('');
            }
        });
    }
</script>

<script type="text/javascript">
    function deleteProduct(o) {
        var p = o.parentNode.parentNode;
        var productcode = $('#productcode').val();
        p.parentNode.removeChild(p);
        calculatePrice();
    }
</script>

<script type="text/javascript">
    function getTotal(id) {
        // var pices = $('#quantity_' + id).val();
        var salePrice = $('#tp_' + id).val();
        var stock = $('#stock').html();
        
        if (parseFloat($('#quantity_' + id).val()) > parseFloat(stock)) {
            document.getElementById('quantity_' + id).style.background="#FFCCCB";
            alert('You do not have enough stock for this item');
            // document.getElementById('quantity_' + id).setAttribute('readonly', true);
            document.getElementById('quantity_' + id).value = 1;
    
        } else {
            document.getElementById('quantity_' + id).style.background = "white";
        }
        var pices = $('#quantity_' + id).val();
        var totalPrice = (parseFloat(salePrice).toFixed(2) * pices);
        $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
        calculatePrice();
        
    }

    function calculatePrice() {
        var totalPrice = Number(0),
            pruchaseCost;
        $("input[name='tPrice[]']").each(function() {
            totalPrice = Number(parseFloat(totalPrice) + parseFloat($(this).val()));
        });
        //alert(totalPrice);
        $('#totalprice').val(totalPrice.toFixed(2));
        $('#tsAmount').val(totalPrice.toFixed(2));
        $('#nAmount').val(totalPrice.toFixed(2));
    }
</script>

<script type="text/javascript">
    function shippingCost() {
        var sCost = $('#sCost').val();
        var total = $('#tsAmount').val();
        var tdis = $('#disAmount').val();
        var tvat = $('#vAmount').val();
        var da = +sCost + +total;
        var dat = +da + +tvat;
        //alert(da);alert(dat);
        var total = dat - tdis;
        //alert(remaining);
        $('#nAmount').val(parseFloat(total).toFixed(2));
        $('#totalprice').val(parseFloat(total).toFixed(2));
        //$('#total_paid').val(parseFloat(total).toFixed(2));
    }
</script>

<script type="text/javascript">
    function vatcostcalculator() {
        var vat = $('#vCost').val();
        var total = $('#tsAmount').val();
        var discc = vat.slice(-1);
        var disca = vat.substring(0, vat.length - 1);
        //alert(discc);
        $('#vType').val(discc);
        if (discc == '%') {
            var da = parseFloat(total).toFixed(2) * parseFloat(disca).toFixed(2);
            var dat = parseFloat(da).toFixed(2) / 100;
            //alert(da);alert(dat);
            //var remaining = parseFloat(total).toFixed(2)-parseFloat(dat).toFixed(2);
            $('#vAmount').val(dat);
        } else {
            var remaining = parseFloat(total).toFixed(2) - parseFloat(vat).toFixed(2);
            $('#vAmount').val(vat);
        }
        //alert(remaining);
        shippingCost();
    }
</script>

<script type="text/javascript">
    function discountType() {
        var disc = $('#discount').val();
        var total = $('#nAmount').val();
        var discc = disc.slice(-1);
        var disca = disc.substring(0, disc.length - 1);
        //alert(discc);
        $('#disType').val(discc);
        if (discc == '%') {
            var da = parseFloat(total).toFixed(2) * parseFloat(disca).toFixed(2);
            var dat = parseFloat(da).toFixed(2) / 100;
            //alert(da);alert(dat);
            var remaining = parseFloat(total).toFixed(2) - parseFloat(dat).toFixed(2);
            $('#disAmount').val(dat);
        } else {
            var remaining = parseFloat(total).toFixed(2) - parseFloat(disc).toFixed(2);
            $('#disAmount').val(disc);
        }
        //alert(remaining);
        shippingCost();
        //$('#totalprice').val(parseFloat(remaining).toFixed(2));
        //$('#total_paid').val(parseFloat(remaining).toFixed(2));
    }
</script>

<script type="text/javascript">
    function duecalculator() {
        var disc = $('#totalprice').val();
        var total = $('#nAmount').val();
        var remaining = parseFloat(total).toFixed(2) - parseFloat(disc).toFixed(2);
        $('#dAmount').val(parseFloat(remaining).toFixed(2));
    }
</script>

<script type="text/javascript">
    $(function() {
        $("#pos_sales_submit").submit(function() {
            dataString = $("#pos_sales_submit").serialize();
            //alert("hello");
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Sale/save_pos_sale') ?>",
                data: dataString,
                success: function(data) {
                    //alert(result);
                    printDiv('print');
                    location.reload();
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    (function() {
        var textField = document.getElementById('productID');
        if (textField) {
            textField.addEventListener('keydown', function(mozEvent) {
                var event = window.event || mozEvent;
                if (event.keyCode === 13) {
                    event.preventDefault();
                }
            });
        }
    })();
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var value = $("#accountType").val();
        $('#accountNo').val(1);
        getAccountNo(value, '#accountNo');
        //$('#accountNo').val(1);
    });
    $('#accountType').on('change', function() {
        var value = $(this).val();
        $('#accountNo').empty();
        getAccountNo(value, '#accountNo');
    });

    function getAccountNo(value, place) {
        $(place).empty();
        if (value != '') {
            //alert(value);
            $.ajax({
                url: '<?php echo site_url()?>Voucher/getAccountNo',
                async: false,
                dataType: "json",
                data: 'id=' + value,
                type: "POST",
                success: function(data) {
                    $(place).append(data);
                    $(place).trigger("chosen:updated");
                }
            });
        } else {
            customAlert('Please Select Account Type', "error", true);
        }
    }
</script>
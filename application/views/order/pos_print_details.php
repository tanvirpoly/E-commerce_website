<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <base href="" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="shortcut icon" href="assets/images/icon.png" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/styles/theme.css" type="text/css" />
    <style type="text/css" media="all">
    body {
        color: #000;
    }

    #wrapper {
        max-width: 480px;
        margin: 0 auto;
        padding-top: 20px;
    }

    .btn {
        border-radius: 0;
        margin-bottom: 5px;
    }

    .bootbox .modal-footer {
        border-top: 0;
        text-align: center;
    }

    h3 {
        margin: 5px 0;
    }

    .order_barcodes img {
        float: none !important;
        margin-top: 5px;
    }

    @media print {
        .no-print {
            display: none;
        }

        #wrapper {
            max-width: 480px;
            width: 100%;
            min-width: 250px;
            margin: 0 auto;
        }

        .no-border {
            border: none !important;
        }

        .border-bottom {
            border-bottom: 1px solid #ddd !important;
        }

        table tfoot {
            display: table-row-group;
        }
    }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="receiptData">
            <div class="no-print">
            </div>
            <div id="receipt-data">
                <div class="text-center">
                    <!--<img src="http://localhost/pos_ok/assets/uploads/logos/Sunshine_Logo.png" alt="">-->
                    <span
                        style="text-transform: uppercase; font-size: 18px;"><b><?php echo $company->com_name; ?></b></span>
                    <p><?php echo $company->com_address; ?> <br>Tel: <?php echo $company->com_mobile; ?><br><span
                            style='text-transform: uppercase; font-size: 18px;'>Invoice<span> </p>
                </div>
                <?php
                $parent = $sales->regdate;

                $timestamp = strtotime($parent);
                
                $date = date('Y-n-j', $timestamp); // d.m.YYYY
                $time = date('H:i:s', $timestamp);
                ?>
                Date: <?php echo $date.' | '.$time ;?><br>Invoice No.:
                <?php echo $sales->oCode; ?><br>
                <p>Payment Mode: <?php echo 'Cash'; ?><br>Customer:
                    <?php echo $sales->customerName; ?> <br>Mobile:
                    <?php echo $sales->mobile; ?><br>Address:
                    <?php echo $sales->address; ?><br>Delivery Time:
                    <?php echo $sales->delivery_time; ?><br>Delivery Man:
                    <?php echo $sales->name; ?><br>
                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th class="no-border border-bottom">SN</th>
                            <th class="no-border border-bottom">ITEM</th>
                            <th class="no-border border-bottom">QTY</th>
                            <th class="no-border border-bottom">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $i = 0;
                          $st = 0;
                          $pdue = $this->pm->get_customer_due_data($sales->custid);
                          foreach ($salesp as $value){
                          $i++;
                          ?>
                        <tr>
                            <td class="no-border border-bottom"><?php echo $i; ?></td>
                            <td class="no-border border-bottom"><?php echo $value->productName; ?></td>
                            <td class="no-border border-bottom"><?php echo $value->oQnt; ?></td>
                            <td class="no-border border-bottom">
                                <?php echo number_format($value->tPrice, 1); $st += $value->tPrice; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Sub Total :</th>
                            <td class="no-border border-bottom"><?php echo number_format($st, 2); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Shipping Charge (+)
                                :</th>
                            <td class="no-border border-bottom"><?php echo number_format($sales->scost, 2); ?></td>
                        </tr>
                        <!-- <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">VAT Amount (+)
                                <?php if($sales->vType == '%') { ?>(<?php echo $sales->vCost; ?>)<?php } ?> :</th>
                            <td class="no-border border-bottom"><?php echo number_format($sales->vAmount, 2); ?></td>
                        </tr> -->
                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Total Amount
                                :</th>
                            <td class="no-border border-bottom"><?php echo number_format($sales->scost+$st, 2); ?></td>
                        </tr>
                        <!-- <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Total Amount :</th>
                            <td class="no-border border-bottom">
                                <?php echo number_format((($st+$sales->vAmount)-$sales->discountAmount), 2); ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Paid Amount :</th>
                            <td class="no-border border-bottom">
                                <?php echo number_format(($sales->paidAmount), 2); ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Due Amount :</th>
                            <td class="no-border border-bottom">
                                <?php echo number_format((($st+$sales->vAmount)-$sales->discountAmount-$sales->paidAmount), 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Previous Due :</th>
                            <td class="no-border border-bottom">
                            <?php echo number_format(($pdue - $sales->dueamount), 2);  ?>
                            </td>
                        </tr>

                        <tr>
                            <th colspan="3" class="no-border border-bottom" style="text-align: right;">Total Due :</th>
                            <td class="no-border border-bottom">
                            <?php echo number_format(($pdue +(($st+$sales->vAmount)-$sales->discountAmount-$sales->paidAmount)), 2);  ?>
                            </td>
                        </tr> -->
                    </tfoot>
                </table>
                <?php
                $sql = "SELECT slogan_title FROM `pos_slogan` WHERE id=(SELECT MAX(id) FROM pos_slogan);";
                $result = $this->db->query($sql)->row();
                ?>
                <p class="text-center"><?php echo $result->slogan_title?> <?php echo $company->com_name; ?></p>
            </div>
            <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                <hr>
                <span class="pull-right col-xs-12">
                    <button onclick="window.print();" class="btn btn-block btn-primary">Print</button> </span>
                <span class="col-xs-12">
                    <a class="btn btn-block btn-warning" href="<?=base_url('Order')?>">Back to POS</a>
                </span>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/custom.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        window.print();
        return false;
    });
    </script>
</body>

</html>

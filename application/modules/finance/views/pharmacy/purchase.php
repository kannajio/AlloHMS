<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo "Purchase" ?>
                <div class="col-md-4 clearfix no-print pull-right">
                    <a data-toggle="modal" href="#myModal"> 
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo "Add Purchase"; ?>
                            </button>
                        </div>
                    </a> 
                </div>
            </header>

            <div class="panel-body"> 
                <div class="adv-table editable-table">
                    <div class="space15">
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> <?php echo 'Product'; ?></th>
                                <th> <?php echo 'Seller'; ?></th>
                                <th> <?php echo 'Qty'; ?></th>
                                <!-- <th> <?php //echo 'Purchase Price'; ?></th>
                                <th> <?php //echo 'MRP'; ?></th>
                                <th> <?php //echo 'Manufacturing Date'; ?></th>
                                <th> <?php //echo 'Expiry Date'; ?></th> -->
                                <th> <?php echo 'Purchase Date'; ?></th>
                                <th> <?php echo 'Generic Name'; ?></th>
                                <th> <?php echo 'Pattern Name'; ?></th>
                                <th> <?php echo 'Manufacturing Company'; ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                            .load{
                                float: right !important;
                            }

                        </style>


                        </tbody>
                    </table>




                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Add Purchase</h4>
            </div>
            <div class="modal-body row">

            <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPurchase" method="post" enctype="multipart/form-data">
                            <div class="row" style="padding: 20px;">
                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" name="product" id="product" class="form-control">
                                <span id="productlist"><span>
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="seller">Seller</label>
                                <input type="text" name="seller" id="seller" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="qty">QTY</label>
                                <input type="number" name="qty" id="qty" class="form-control">
                            </div>
                            </div>

                            <!-- <div class="col-md-4">  
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" name="purchase_price" id="purchase_price" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="number" name="mrp" id="mrp" class="form-control">
                            </div>
                            </div>

                             <div class="col-md-4">  
                            <div class="form-group">
                                <label for="m_date">Manufacturing Date</label>
                                <input type="date" name="m_date" id="m_date" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="e_date">Expiry Date</label>
                                <input type="date" name="e_date" id="e_date" class="form-control">
                            </div>
                            </div> -->

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="p_date">Purchase Date</label>
                                <input type="date" name="p_date" id="p_date" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="g_name">Generic Name</label>
                                <input type="text" name="g_name" id="g_name" class="form-control" >
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="p_name">Pattern Name</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" >
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="m_company">Manufacturing Company</label>
                                <input type="text" name="m_company" id="m_company" class="form-control" >
                            </div>
                            </div>


                            <div class="clearfix"></div>




                            <div class="form-group col-md-12" >
                                <input type="hidden" name="id" value='<?php
                                        if (!empty($purchase->id)) {
                                            echo $purchase->id;
                                        }
                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info pull-right">SUBMIT</button>
                            </div>
                        </div>
                                
                        

                        </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->


<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Edit Purchase<?php //echo lang('edit_purchase'); ?></h4>
            </div>
            <div class="modal-body row">
            <form role="form" class="clearfix"  id="editPharmacyForm" action="finance/pharmacy/addPurchase" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value=''>                
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" name="product" id="product" class="form-control">
                                <span id="productlist"><span>
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="seller">Seller</label>
                                <input type="text" name="seller" id="seller" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="qty">QTY</label>
                                <input type="number" name="qty" id="qty" class="form-control">
                            </div>
                            </div>

                            <!-- <div class="col-md-4">  
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" name="purchase_price" id="purchase_price" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="number" name="mrp" id="mrp" class="form-control">
                            </div>
                            </div>

                             <div class="col-md-4">  
                            <div class="form-group">
                                <label for="m_date">Manufacturing Date</label>
                                <input type="date" name="m_date" id="m_date" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="e_date">Expiry Date</label>
                                <input type="date" name="e_date" id="e_date" class="form-control">
                            </div>
                            </div> -->

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="p_date">Purchase Date</label>
                                <input type="date" name="p_date" id="p_date" class="form-control">
                            </div>
                            </div>

                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="g_name">Generic Name</label>
                                <input type="text" name="g_name" id="g_name" class="form-control" >
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="p_name">Pattern Name</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" >
                            </div>
                            </div>


                            <div class="col-md-6">  
                            <div class="form-group">
                                <label for="m_company">Manufacturing Company</label>
                                <input type="text" name="m_company" id="m_company" class="form-control" >
                            </div>
                            </div>


                            <div class="clearfix"></div>




                            <div class="form-group col-md-12" >
                                <input type="hidden" name="id" value='<?php
                                        if (!empty($purchase->id)) {
                                            echo $purchase->id;
                                        }
                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info pull-right">SUBMIT</button>
                            </div>
                        </div>
                                
                        

                        </form>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".editbutton", function () {
          
            var iid = $(this).attr('data-id');
            $('#editPharmacyForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'finance/pharmacy/editPurchaseByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#editPharmacyForm').find('[name="id"]').val(response.purchase.id).end()
                $('#editPharmacyForm').find('[name="product"]').val(response.purchase.product).end()
                $('#editPharmacyForm').find('[name="seller"]').val(response.purchase.seller).end()
                $('#editPharmacyForm').find('[name="qty"]').val(response.purchase.quantity).end()
                // $('#editPharmacyForm').find('[name="purchase_price"]').val(response.purchase.p_price).end()
                // $('#editPharmacyForm').find('[name="mrp"]').val(response.purchase.mrp).end()
                // $('#editPharmacyForm').find('[name="m_date"]').val(response.purchase.m_date).end()
                // $('#editPharmacyForm').find('[name="e_date"]').val(response.purchase.e_date).end()
                $('#editPharmacyForm').find('[name="p_date"]').val(response.purchase.p_date).end()
                $('#editPharmacyForm').find('[name="g_name"]').val(response.purchase.generic).end()
                $('#editPharmacyForm').find('[name="p_name"]').val(response.purchase.pat_name).end()
                $('#editPharmacyForm').find('[name="m_company"]').val(response.purchase.company).end()
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });</script>



<script>


    $(document).ready(function () {
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "finance/pharmacy/getPurchaseList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12,13],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
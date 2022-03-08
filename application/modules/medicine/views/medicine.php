<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('medicine'); ?> 
                <div class="clearfix no-print col-md-8 pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <style>
.datepicker {
  transform: translate(0, -10em);
}
                /*    .editable-table .search_form{
                        border: 0px solid #ccc !important;
                        padding: 0px !important;
                        background: none !important;
                        float: right;
                        margin-right: 14px !important;
                    }
    
    
                    .editable-table .search_form input{
                        padding: 6px !important;
                        width: 250px !important;
                        background: #fff !important;
                        border-radius: none !important;
                    }
    
                    .editable-table .search_row{
                        margin-bottom: 20px !important;
                    }
    
                    .panel-body {
                        padding: 15px 0px 15px 0px;
                    }*/

            </style>

            <div class="panel-body"> 
                <div class="adv-table editable-table">
                    <div class="space15">
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('store_box'); ?></th>
                                <th> <?php echo lang('p_price'); ?></th>
                                <th> <?php echo lang('s_price'); ?></th>
                                <th> <?php echo 'Strip Count'; ?></th>
                                <th> <?php echo 'Tab Per Strip'; ?></th>
                                <th> <?php echo lang('quantity'); ?></th>
                                <th> <?php echo lang('generic_name'); ?></th>
                                <th> <?php echo lang('company'); ?></th>
                                <th> <?php echo lang('effects'); ?></th>
                                <th> <?php echo 'Minimum Stock'; ?></th>
                                <th> <?php echo lang('expiry_date'); ?></th>
                                <th> <?php echo lang('added_date'); ?></th>
                                <th> <?php echo lang('updated_date'); ?></th>
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
                <h4 class="modal-title">  <?php echo lang('add_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="addMedicine" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('medicine_type'); ?></label>
                        <select class="form-control m-bot15" id="mtype" name="mtype" value=''>
                            <option value="tablet">Tablet</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value='' placeholder="" readonly>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <?php $cnt = range(0,40); ?>
                    
                    <div class="form-group col-md-4 stripcnt"> 
                        <label for="exampleInputEmail1"> <?php echo lang('strip_cnt'); ?></label>
                        <select name="strip_cnt" id="strip_cnt" class="form-control"  onchange="calcqty();">
                            <?php foreach($cnt as $c) { ?>    
                                <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4 tapstrip"> 
                        <label for="exampleInputEmail1"> <?php echo lang('tab_per_strip'); ?></label>
                        <select name="tab_per_strip" id="tab_per_strip" class="form-control"  onchange="calcqty();">
                            <?php foreach($cnt as $c) { ?>    
                                <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="min_stock"> <?php echo 'Minimum Stock'; ?></label>
                        <input type="text" class="form-control" name="min_stock" id="min_stock" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="c_date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <textarea class="form-control" name="remarks" id="" placeholder="Enter your remarks here"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
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
                <h4 class="modal-title">  <?php echo lang('edit_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('medicine_type'); ?></label>
                        <select class="form-control m-bot15" id="mtype" name="mtype" value=''>
                            <option value="tablet">Tablet</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <?php $cnt = range(0,40); ?>
                    <div class="form-group col-md-4 stripcnt"> 
                        <label for="exampleInputEmail1"> <?php echo lang('strip_cnt'); ?></label>
                        <select id="edit_strip_cnt" name="strip_cnt" class="form-control" onchange="editcalcqty();">
                            <?php foreach($cnt as $c) { ?>    
                                <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4 tapstrip"> 
                        <label for="exampleInputEmail1"> <?php echo lang('tab_per_strip'); ?></label>
                        <select id="edit_tab_per_strip" name="tab_per_strip" class="form-control" onchange="editcalcqty();">
                            <?php foreach($cnt as $c) { ?>    
                                <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='' placeholder="" readonly="" data-date-container='#myModal2'>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="min_stock"> <?php echo 'Minimum Stock'; ?></label>
                        <input type="text" class="form-control" name="min_stock" id="min_stock" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="c_date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <textarea class="form-control" name="remarks" id="" placeholder="Enter your remarks here"></textarea>
                    </div>
                     
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>



                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->









<!-- Load Medicine -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('load_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/load" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('add_quantity'); ?></label>
                        <input type="text" class="form-control" name="qty" id="exampleInputEmail1" value='' placeholder="">
                    </div>  

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Load Medicine -->












<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    function calcqty() {
        var scnt = $('#addMedicine #strip_cnt').val();
        var tper = $('#addMedicine #tab_per_strip').val();
        if(scnt > 0 && tper > 0) {
            var n1 = parseInt(scnt);
            var n2 = parseInt(tper);
            r = n1 * n2;
        } else {
            r = 0;
        }
        $('#addMedicine #quantity').val(r);
    }

    function editcalcqty() {
        var scnt = $('#editMedicineForm #edit_strip_cnt').val();
        var tper = $('#editMedicineForm #edit_tab_per_strip').val();
        if(scnt > 0 && tper > 0) {
            var n1 = parseInt(scnt);
            var n2 = parseInt(tper);
            r = n1 * n2;
        } else {
            r = 0;
        }
        $('#editMedicineForm #quantity').val(r);
    }

    $(document).ready(function () {
        
        $("#addMedicine select#mtype").change(function () {
            var r = 0;
            var mtype = $('#addMedicine #mtype').val();
            if(mtype == 'other') {
                $('#addMedicine .stripcnt').hide();
                $('#addMedicine .tapstrip').hide();
                r = 0;
                $('#addMedicine #quantity').val(r);
                $('#addMedicine #quantity').prop('readonly',false);
            } else {
                $('#addMedicine .stripcnt').show();
                $('#addMedicine .tapstrip').show();
                
                var scnt = $('#addMedicine #strip_cnt').val();
                var tper = $('#addMedicine #tab_per_strip').val();
                if(scnt > 0 && tper > 0) {
                    var n1 = parseInt(scnt);
                    var n2 = parseInt(tper);
                    r = n1 * n2;
                } else {
                    r = 0;
                }
                $('#addMedicine #quantity').val(r);
                $('#addMedicine #quantity').prop('readonly',true);
            }
            
        });

        $("#editMedicineForm select#mtype").change(function () {
            var r = 0;
            var mtype = $('#editMedicineForm #mtype').val();
            if(mtype == 'other') {
                $('#editMedicineForm .stripcnt').hide();
                $('#editMedicineForm .tapstrip').hide();
                r = 0;
                $('#editMedicineForm #quantity').val(r);
                $('#editMedicineForm #quantity').prop('readonly',false);
            } else {
                $('#editMedicineForm .stripcnt').show();
                $('#editMedicineForm .tapstrip').show();
                
                var scnt = $('#editMedicineForm #edit_strip_cnt').val();
                var tper = $('#editMedicineForm #edit_tab_per_strip').val();
                if(scnt > 0 && tper > 0) {
                    var n1 = parseInt(scnt);
                    var n2 = parseInt(tper);
                    r = n1 * n2;
                } else {
                    r = 0;
                }
                $('#editMedicineForm #quantity').val(r);
                $('#editMedicineForm #quantity').prop('readonly',true);
            }
            
            //alert(mtype);
        });
        $(".table").on("click", ".editbutton", function () {
          
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'medicine/editMedicineByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                
                $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end()
                $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end()
                $('#editMedicineForm').find('[name="box"]').val(response.medicine.box).end()
                $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end()
                $('#editMedicineForm').find('[name="s_price"]').val(response.medicine.s_price).end()
                $('#editMedicineForm').find('[name="quantity"]').val(response.medicine.quantity).end()
                $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end()
                $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end()
                $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end()
                $('#editMedicineForm').find('[name="min_stock"]').val(response.medicine.min_stock).end()
                $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end()
                $('#editMedicineForm').find('[name="c_date"]').val(response.medicine.u_date).end()
                $('#editMedicineForm').find('[name="remarks"]').val(response.medicine.remarks).end()
                if(response.medicine.strip_cnt == 0 && response.medicine.tab_per_strip == 0) {
                    $('#editMedicineForm .stripcnt').hide();
                    $('#editMedicineForm .tapstrip').hide();
                    $('#editMedicineForm select#mtype option[value="other"]').attr('selected','selected');
                } else {
                    $('#editMedicineForm select#mtype option[value="tablet"]').attr('selected','selected');
                    $('#edit_strip_cnt option[value='+response.medicine.strip_cnt+']').attr('selected','selected');
                    $('#edit_tab_per_strip option[value='+response.medicine.tab_per_strip+']').attr('selected','selected');
                    $('#editMedicineForm #quantity').prop('readonly',true);
                }
                
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".load", function () {

            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal3').modal('show');

            //  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid).end()
        });
    });
</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "medicine/getMedicineList",
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


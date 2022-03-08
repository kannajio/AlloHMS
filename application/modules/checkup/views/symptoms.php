
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('symptoms'); ?>
                <div class="clearfix no-print col-md-8 pull-right">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_symptom'); ?> 
                            </button>
                        </div>
                    </a>

                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('inputype'); ?></th>
                                <!-- <th><?php //echo lang('unit'); ?></th> -->
                                <th><?php echo lang('status'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

                        </style>

                        <?php foreach ($symptoms as $symptom) { ?>
                            <tr class="">
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $symptom->img_url; ?>"></td>
                                <td> <?php echo $symptom->name; ?></td>
                                <td> <?php echo $symptom->input_type; ?></td>
                                <td class="center"><?php echo $symptom->status == 1 ? "Active" : "Inactive"; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $symptom->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="checkup/delete_symptom?id=<?php echo $symptom->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        <?php } ?>




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




<!-- Add symptom Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_symptom'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="checkup/addNewSymptom" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('inputype'); ?></label>
                        <select name="input_type" id="input_type" class="form-control">
                            <option value="tag">Tag</option>
                            <option value="text">Textbox</option>
                            <option value="number">Number</option>
                            <option value="textarea">Textarea</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio Button</option>
                            <option value="selectbox">Select Box</option>
                        </select>
                    </div>
                    <div class="form-group" id="inputoption" style="display:none;">
                        <label for="exampleInputEmail1"><?php echo lang('options'); ?></label>
                        <textarea class="form-control" name="input_options"></textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <!-- <div class="form-group last col-md-9">
                        <div id="permission" class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('module_permission'); ?> </label><br>
                                <?php
                                foreach ($permissions as $permission) {
                                   
                                    if ($permission->feature == 'Dashboard' || $permission->feature == 'Human Resource' || $permission->feature == 'Email' || $permission->feature == 'Payroll') {
                                        ?>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="permission[]" value="<?php echo $permission->feature; ?>" 
                                                   checked
                                                   /> <label for="exampleInputEmail1"><?php echo $permission->feature; ?></label><br>
                                        </div>
    <?php }
} ?>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add symptom Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_symptom'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editsymptomForm" class="clearfix" action="checkup/addNewSymptom" method="post" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('inputype'); ?></label>
                        <select name="input_type" id="input_type" class="form-control">
                            <option value="tag">Tag</option>
                            <option value="text">Textbox</option>
                            <option value="number">Number</option>
                            <option value="textarea">Textarea</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio Button</option>
                            <option value="selectbox">Select Box</option>
                        </select>
                    </div>
                    <div class="form-group" id="inputoption" >
                        <label for="exampleInputEmail1"><?php echo lang('options'); ?></label>
                        <textarea class="form-control" name="input_options"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <!-- <div class="form-group last col-md-9">
                        <div id="permission" class="">
                            <div class="form-group" id="permission_checkbox">


                            </div>
                        </div>
                    </div> -->
                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
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
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editsymptomForm').trigger("reset");
                                                $.ajax({
                                                    url: 'checkup/editsymptomByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    var inputtype = response.symptoms.input_type;
                                                    
                                                    // Populate the form fields with the data returned from server
                                                    $("#editsymptomForm #status option[value='" + response.symptoms.status + "']").attr("selected","selected");
                                                    $("#editsymptomForm #input_type option[value='" + response.symptoms.input_type + "']").attr("selected","selected");
                                                    $('#editsymptomForm').find('[name="id"]').val(response.symptoms.id).end();
                                                    $('#editsymptomForm').find('[name="name"]').val(response.symptoms.name).end();
                                                    $('#editsymptomForm').find('[name="input_options"]').val(response.symptoms.input_options).end();
                                                    //$('#editsymptomForm').find('[name="unit"]').val(response.symptoms.unit).end();
                                                    //$('#editsymptomForm').find('[name="status"]').val(response.symptom.email).end();
                                                    // $('#permission_checkbox').html("");
                                                    // $('#permission_checkbox').append(response.option);
                                                    if(inputtype == 'checkbox' || inputtype == 'selectbox' || inputtype == 'radio') {
                                                        $("#editsymptomForm #inputoption").show();
                                                    } else {
                                                        $("#editsymptomForm #inputoption").hide();
                                                    }
                                                    $('#myModal2').modal('show');
                                                });
                                            });
                                            $("#input_type").change(function (e) {
                                                var it = $("#input_type").val();
                                                if(it == 'checkbox' || it == 'radio' || it == 'selectbox') {
                                                    $("#inputoption").show();
                                                } else {
                                                    $("#inputoption").hide();
                                                }
                                            });
                                            $("#editsymptomForm #input_type").change(function (e) {
                                                var it = $("#editsymptomForm #input_type").val();
                                                if(it == 'checkbox' || it == 'radio' || it == 'selectbox') {
                                                    $("#editsymptomForm #inputoption").show();
                                                } else {
                                                    $("#editsymptomForm #inputoption").hide();
                                                }
                                            });
                                        });</script>




<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,

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
                        columns: [1, 2, 3, 4],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"

            },

        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });
</script>






<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

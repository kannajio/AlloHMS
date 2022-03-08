<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo "In Patients" ?>
                <div class="col-md-4 clearfix no-print pull-right">
                    <a data-toggle="modal" id="addPayroll" href="#myModal"> 
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo "Admit Patient"; ?>
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
                                <th> <?php echo 'Patient Id'; ?></th>
                                <th> <?php echo 'Patient Name'; ?></th>
                                <th> <?php echo 'Bed'; ?></th>
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
                <h4 class="modal-title">  Add Patient</h4>
            </div>
            <div class="modal-body row">

            <form role="form" class="clearfix pos form1"  id="addIp" action="encounter/addIp" method="post" enctype="multipart/form-data">
                        <div class="col-md-12 panel">
                            <div class="col-md-2 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                            </div>
                            <div class="col-md-10"> 
                                <select class="form-control m-bot15  pos_select" id="pos_select" name="patient" value='' required> 
                                    <?php if (!empty($patients)) { ?>
                                        <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>  
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        
                        <!-- <div class="col-md-12">  
                            <div class="form-group">
                                <div class="col-md-2 payment_label"> 
                                    <label for="status">Bed</label>
                                </div>
                                <div class="col-md-10"> 
                                    <select name="bed" id="bed" class="form-control" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        
                        <div class="col-md-12">  
                            <div class="form-group" style="margin:14px;">
                                <button type="submit" name="submit" class="btn btn-info pull-right">Admit</button>
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
                <h4 class="modal-title">  Edit Patient<?php //echo lang('edit_purchase'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" class="clearfix"  id="editIp" action="encounter/addIp" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="">
                    <div class="col-md-12 panel">
                        <div class="col-md-2 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        </div>
                        <div class="col-md-10"> 
                            <select class="form-control m-bot15  pos_select" id="pos_select" name="patient" value=''required> 
                                <?php if (!empty($patients)) { ?>
                                    <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>  
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    
                    <!-- <div class="col-md-12">  
                        <div class="form-group">
                            <div class="col-md-2 payment_label"> 
                                <label for="status">Bed</label>
                            </div>
                            <div class="col-md-10"> 
                                <select name="bed" id="bed" class="form-control" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                    
                    <div class="col-md-12">  
                        <div class="form-group" style="margin:14px;">
                            <button type="submit" name="submit" class="btn btn-info pull-right">Admit</button>
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
        $("#addip").on("click", function () {
            $('#patient option:selected').removeAttr('selected');
            $('#bed option:selected').removeAttr('selected');
        });
        $(".table").on("click", ".editbutton", function () {
          
            var iid = $(this).attr('data-id');
            $('#editIp').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'encounter/editIpByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#editIp').find('[name="id"]').val(response.encounter.id).end()
                $('#editIp').find('[name="patient"]').val(response.encounter.patient_id).end()
                // $("#editIp #bed option[value='" + response.encounter.bed + "']").attr("selected","selected");
                
                var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
                $('#editIp').find('[name="patient"]').append(option).trigger('change');
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

        $("#addIp #pos_select").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfoWithAddNewOption',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });

        $("#editIp #pos_select").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfoWithAddNewOption',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });

        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            // "processing": true,
            // "serverSide": true,
            // "searchable": true,
            "ajax": {
                url: "encounter/getIpList",
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
                        columns: [1, 2, 3, 4, 5, 6,7,8],
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
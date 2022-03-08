
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('checkup'); ?>
                <div class="clearfix no-print col-md-8 pull-right">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="checkup/add_new">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_checkup'); ?> 
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
                                <th><?php echo lang('pname'); ?></th>
                                <th><?php echo lang('checkup'); ?></th>
                                
                                <!-- <th><?php //echo lang('unit'); ?></th> -->
                                <th><?php echo lang('cdate'); ?></th>
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

                        <?php foreach ($checkups as $cp) { ?>
                            <tr class="">
                                <td><?php echo $cp->pname; ?></td>
                                <td ><?php echo $cp->tname; ?></td>
                                <td ><?php echo $cp->created_at; ?></td>
                                <td class="center"><?php echo $cp->status == 1 ? "Active" : "Inactive"; ?></td>
                                <td class="no-print">
                                <a href="#" onclick="viewCheckup(<?php echo $cp->id; ?>); return false;" class="btn btn-info btn-xs btn_width" style="background:#53bee6; border:1px solid #53bee6;" target="_blank" title="<?php echo lang('view'); ?>" ><i class="fa fa-eye"> </i></a>   
                                    <a href="checkup/add_new/<?php echo $cp->id; ?>" class="btn btn-info btn-xs btn_width" title="<?php echo lang('edit'); ?>" ><i class="fa fa-edit"> </i></a>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="checkup/checkup_delete?id=<?php echo $cp->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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
<div class="modal fade" id="checkupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="checkupheader">View Checkup</h4>
            </div>
            <div class="modal-body">
            <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">
                <div id="bodyhtml"></div>
            

</form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editsymptomForm').trigger("reset");
                                                $.ajax({
                                                    url: 'symptoms/editsymptomByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $("#editsymptomForm #status option[value='" + response.symptoms.status + "']").attr("selected","selected");
                                                    $('#editsymptomForm').find('[name="id"]').val(response.symptoms.id).end();
                                                    $('#editsymptomForm').find('[name="name"]').val(response.symptoms.name).end();
                                                    //$('#editsymptomForm').find('[name="unit"]').val(response.symptoms.unit).end();
                                                    //$('#editsymptomForm').find('[name="status"]').val(response.symptom.email).end();
                                                    // $('#permission_checkbox').html("");
                                                    // $('#permission_checkbox').append(response.option);
                                                    $('#myModal2').modal('show');
                                                });
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
    function viewCheckup(id) {
        $.ajax({
            url: 'patient/viewCheckup?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response);
            $('#checkupModal').modal('show');
            $('#checkupModal #checkupheader').html(response.header);
            $('#checkupModal #bodyhtml').html(response.html);
        });
    }
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

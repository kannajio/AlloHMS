<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('pharmacist'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_pharmacist'); ?>
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
                                <th><?php echo lang('pharmid'); ?></th>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <th><?php echo lang('address'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
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

                        <?php foreach ($pharmacists as $pharmacist) { ?>
                            <tr class="">
                                <td> <?php echo $pharmacist->serial_id; ?></td>
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $pharmacist->img_url; ?>"></td>
                                <td> <?php echo $pharmacist->name; ?></td>
                                <td><?php echo $pharmacist->email; ?></td>
                                <td class="center"><?php echo $pharmacist->address; ?></td>
                                <td><?php echo $pharmacist->phone; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $pharmacist->id; ?>"><i class="fa fa-edit"></i> </button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="pharmacist/delete?id=<?php echo $pharmacist->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
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






<!-- Add Pharmacist Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                <h4 class="modal-title"> <?php echo lang('add_new_pharmacist'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="pharmacist/addNew" class="clearfix" method="post" id="addUserForm" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="name" class="manda-label"><?php echo lang('name'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value=''>
                    </div>
                    <div class="form-group">
                        <label for="email" class="manda-label"><?php echo lang('email'); ?><span class="manda-span">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password" class="manda-label"><?php echo lang('password'); ?><span class="manda-span">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="address" class="manda-label"><?php echo lang('address'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="manda-label"><?php echo lang('phone'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                        <span class="help-block">Allowed Types : gif | jpg | png | jpeg</span>
                        <span class="help-block"><?php echo lang('recommended_size'); ?> : 3000 x 2024</span>
                    </div>
                    <div class="form-group last col-md-9">
                        <div id="permission" class="">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('module_permission'); ?> </label><br>
                                <?php
                                foreach ($permissions as $permission) {
                                    if ( $permission->feature == 'Prescription' || $permission->feature == 'Medicine' || $permission->feature == 'Email' || $permission->feature == 'Pharmacy') {
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
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                <h4 class="modal-title"> <?php echo lang('edit_pharmacist'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPharmacistForm" class="clearfix editUserForm" action="pharmacist/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="manda-label"><?php echo lang('pharmid'); ?></label>
                        <input type="text" class="form-control" readonly name="serial_id" id="serial_id" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="manda-label"><?php echo lang('name'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email" class="manda-label"><?php echo lang('email'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password" class="manda-label"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="address" class="manda-label"><?php echo lang('address'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="manda-label"><?php echo lang('phone'); ?><span class="manda-span">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <div class="form-group last col-md-9">
                        <div id="permission" class="">
                            <div class="form-group" id="permission_checkbox">


                            </div>
                        </div>
                    </div>
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
                                            $('#editPharmacistForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'pharmacist/editPharmacistByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editPharmacistForm').find('[name="serial_id"]').val(response.pharmacist.serial_id).end();
                                                $('#editPharmacistForm').find('[name="id"]').val(response.pharmacist.id).end()
                                                $('#editPharmacistForm').find('[name="name"]').val(response.pharmacist.name).end()
                                                $('#editPharmacistForm').find('[name="password"]').val(response.pharmacist.password).end()
                                                $('#editPharmacistForm').find('[name="email"]').val(response.pharmacist.email).end()
                                                $('#editPharmacistForm').find('[name="address"]').val(response.pharmacist.address).end()
                                                $('#editPharmacistForm').find('[name="phone"]').val(response.pharmacist.phone).end()
                                                $('#permission_checkbox').html("");
                                                $('#permission_checkbox').append(response.option);
                                            });
                                        });
                                    });
</script>
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


<style>
.datepicker {
  transform: translate(0, -10em);
}
</style>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('camp'); ?>
                <div class="clearfix no-print col-md-8 pull-right">
                    <div class="pull-right"></div>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_camp'); ?> 
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
                                <th><?php echo lang('camp_name'); ?></th>
                                <th><?php echo lang('camp_address'); ?></th>
                                <th><?php echo lang('camp_phone'); ?></th>
                                <th><?php echo lang('camp_date'); ?></th>
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

                        <?php foreach ($camps as $camp) { ?>
                            <tr class="">
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $camp->img_url; ?>"></td>
                                <td> <?php echo $camp->camp_name; ?></td>
                                <td><?php echo $camp->address; ?></td>
                                <td><?php echo $camp->phone; ?></td>
                                <td><?php echo $camp->camp_date; ?></td>
                                <td class="no-print">
                                <a href="camp/campDetails/<?php echo $camp->id; ?>" class="btn btn-primary btn-xs btn_width" title="Dashboard" ><i class="fa fa-tachometer-alt"> </i></a>
                                <a href="camp/patientList/<?php echo $camp->id; ?>" class="btn btn-warning btn-xs btn_width" title="Patients" ><i class="fa fa-users-medical"> </i></a>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $camp->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="camp/delete_camp?id=<?php echo $camp->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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




<!-- Add vital Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_camp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="camp/addNewCamp" class="clearfix" method="post" id="addUserForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_name'); ?></label><span class="manda-span">*</span>
                        <input type="text" class="form-control" name="name" id="name" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_address'); ?></label><span class="manda-span">*</span>
                        <textarea class="form-control" name="address" id="address" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_phone'); ?></label><span class="manda-span">*</span>
                        <input type="text" class="form-control" name="phone" id="phone" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_date'); ?></label><span class="manda-span">*</span>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="date" value='' placeholder="" autocomplete="off" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add vital Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_camp'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editCampForm" class="clearfix" action="camp/addNewCamp" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_name'); ?></label><span class="manda-span">*</span>
                        <input type="text" class="form-control" name="name" id="name" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_address'); ?></label><span class="manda-span">*</span>
                        <textarea class="form-control" name="address" id="address" value=''></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_phone'); ?></label><span class="manda-span">*</span>
                        <input type="number" class="form-control" name="phone" id="phone" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('camp_date'); ?></label><span class="manda-span">*</span>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
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
                                                $('#editCampForm').trigger("reset");
                                                $.ajax({
                                                    url: 'camp/editcampByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    var d = response.camp.camp_date.split('-');
                                                    var da = d[2] + '-' + d[1] + '-' + d[0];
                                                    // Populate the form fields with the data returned from server                                                 
                                                    $('#editCampForm').find('[name="date"]').val(da).end();
                                                    // Populate the form fields with the data returned from server
                                                    $('#editCampForm').find('[name="id"]').val(response.camp.id).end();
                                                    $('#editCampForm').find('[name="name"]').val(response.camp.camp_name).end();
                                                    $('#editCampForm').find('[name="address"]').val(response.camp.address).end();
                                                    $('#editCampForm').find('[name="phone"]').val(response.camp.phone).end();
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
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

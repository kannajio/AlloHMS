<!--sidebar end-->
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
<style>
    .btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($temp->id))
                    echo lang('edit_template');
                else
                    echo lang('add_template');
                ?>
            </header>
            <div class="panel-body col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="checkup/add_new_template/<?php echo $temp->id; ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $temp->id; ?>">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" required id="name" value='<?php
                                            if (!empty($temp->name)) {
                                                echo $temp->name;
                                            }
                                            ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <select name="status" class="form-control m-bot15" required>
                                                <option value="1" <?php echo ($temp->status == '1') ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?php echo ($temp->status == '0') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="vitals" class="control-label">Add Vitals & Symptoms</label>
                                            
                                            <input type="hidden" id="product_index" value="0">
                                            <div class="field_product_wrapper row">
                                                <?php if($fields) { 
                                                    $i = 0;
                                                    foreach($fields as $field) { 
                                                        //echo "<pre>"; print_r($field); exit;
                                                        ?>
                                                        <div style="height:40px;clear:both;" class="productdiv" id="<?php echo $i; ?>">
                                                            <div class="col-xs-6 col-md-6">
                                                                <select name="vitals[]" class="form-control bot15 selectpicker" data-live-search="true" required>
                                                                    <option value="">--Select--</option>
                                                                <?php
                                                                    foreach($vitals as $vs) {
                                                                ?>
                                                                <option value="<?php echo $vs->id; ?>" <?php echo ($vs->id == $field->field_id) ? 'selected' : ''; ?> ><?php echo $vs->name; ?></option>
                                                                <?php  } ?>
                                                                </select>
                                                            </div>
                                                            <a href="javascript:void(0);" class="remove_button" title="Remove field" style="position:relative; top:8px; left:15px"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    <?php 
                                                        $i++;
                                                    } 
                                                } else {
                                                    ?>
                                                <div style="height:40px;clear:both;" class="productdiv" id="0">
                                                    <div class="col-xs-6 col-md-6">
                                                        <select name="vitals[]" class="form-control m-bot15 selectpicker" data-live-search="true" required>
                                                            <option value="">--Select--</option>
                                                        <?php
                                                            foreach($vitals as $vs) {
                                                        ?>
                                                        <option value="<?php echo $vs->id; ?>"><?php echo $vs->name; ?></option>
                                                        <?php  } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            </div>
                                            <a href="javascript:void(0);" class="addmore_btn row" title="Add field" style="margin:10px; clear:both; height:40px;"><i class="fa fa-plus"></i> Add More</a>  
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.selectpicker').selectpicker('refresh');
        var addmore_btn = $('.addmore_btn');
        var wrapperproduct = $('.field_product_wrapper');

        $(addmore_btn).click(function(){
            var product= $("select[name=\'vitals[]\']").map(function() {
                return $(this).val();
            }).toArray();
            $('.addmore_btn').css("pointer-events", "none");
            $('.addmore_btn').css("cursor", "default");
            //var length = Object.keys(product).length
            var length = $('#product_index').val();
            var currency = $('#currency').val();
            length = parseInt(length)+parseInt(1);
                var url =  'checkup/getaddfields';
                
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {product:product,length:length,currency:currency},
                    success: function(msg){
                        $('#product_index').val(length);
                        $(wrapperproduct).append(msg);
                        $('.addmore_btn').css("pointer-events", "auto");
                        $('.addmore_btn').css("cursor", "pointer");
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
        });

        $(wrapperproduct).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });

        $("#vital").select2({
            placeholder: '--Select--',
            allowClear: true,
            ajax: {
                url: 'checkup/getvitals',
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
    });
    </script>

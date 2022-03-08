<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel-body col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine');
                else
                    echo lang('add_medicine');
                ?>
            </header>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" id="addMedicine" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->name)) {
                                                echo $medicine->name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
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
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('medicine_type'); ?></label>
                                            <select class="form-control m-bot15" id="mtype" name="mtype" value=''>
                                                <option value="tablet">Tablet</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->price)) {
                                                echo $medicine->price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                                            <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->s_price)) {
                                                echo $medicine->s_price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                                            <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->box)) {
                                                echo $medicine->box;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" value='<?php
                                            if (!empty($medicine->quantity)) {
                                                echo $medicine->quantity;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                                            <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->generic)) {
                                                echo $medicine->generic;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->company)) {
                                                echo $medicine->company;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                                            <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->effects)) {
                                                echo $medicine->effects;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <!-- <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                                            <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->e_date)) {
                                                echo $medicine->e_date;
                                            }
                                            ?>' placeholder="" readonly="">
                                        </div> -->
                                        
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                                            <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->e_date)) {
                                                echo $medicine->e_date;
                                            }
                                            ?>' placeholder="" readonly="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="min_stock">Minimum Stock</label> 
                                            <input type="text" class="form-control" name="min_stock" id="min_stock" value='<?php
                                            if (!empty($medicine->min_stock)) {
                                                echo $medicine->min_stock;
                                            }
                                            ?>'>
                                        </div>
                                        <?php $cnt = range(0,40); ?>
                                        <div class="form-group col-md-4 stripcnt"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('strip_cnt'); ?></label>
                                            <select name="strip_cnt" id="strip_cnt" class="form-control" onchange="calcqty();">
                                                <?php foreach($cnt as $c) { ?>    
                                                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-4 tapstrip"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('tab_per_strip'); ?></label>
                                            <select name="tab_per_strip" id="tab_per_strip" class="form-control" onchange="calcqty();">
                                                <?php foreach($cnt as $c) { ?>    
                                                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control default-date-picker" name="c_date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                                            <textarea class="form-control" name="remarks" id="" placeholder="Enter your remarks here"></textarea>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                        </div>
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


<style>
    .wrapper{
        padding: 24px 30px;
    }
</style>
<script src="common/js/codearistos.min.js"></script>
<script>
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

    });
</script>
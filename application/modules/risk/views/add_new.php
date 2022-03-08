<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                echo '<b>'. $camp->camp_name . '</b> : ';
                if (!empty($patient->id))
                    echo lang('edit_patient');
                else
                    echo lang('add_new_patient');
                ?>
            </header>
            <div class="panel-body col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="camp/addNewPatient" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="campid" id="campid" value="<?php echo $campid; ?>">    
                                    <div class="col-lg-7">
                                    <div class="form-group">
<h3>Patient Details:</h3> <hr>
                                            <div class=""> 
                                                <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                            </div>
                                            <div class=""> 
                                                <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''> 
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>" <?php
                                                        if (!empty($patient->doctor)) {
                                                            if ($patient->doctor == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> ><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label><span class="manda-span">*</span>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($patient->name)) {
                                                echo $patient->name;
                                            }
                                            ?>' placeholder="" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($patient->email)) {
                                                echo $patient->email;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">        
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label><span class="manda-span">*</span>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('address');
                                            }
                                            if (!empty($patient->address)) {
                                                echo $patient->address;
                                            }
                                            ?>' placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('phone');
                                            }
                                            if (!empty($patient->phone)) {
                                                echo $patient->phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                            <select class="form-control m-bot15" name="sex" value=''>
                                                <option value="Male" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Male </option>
                                                <option value="Female" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Female </option>
                                                <option value="Others" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('sex') == 'Others') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Others') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('others'); ?> </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                                            if (!empty($setval)) {
                                                echo set_value('birthdate');
                                            }
                                            if (!empty($patient->birthdate)) {
                                                echo $patient->birthdate;
                                            }
                                            ?>" placeholder="">      
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('blodd_group'); ?></label>
                                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option value="<?php echo $group->group; ?>" <?php
                                                    if (!empty($setval)) {
                                                        if ($group->group == set_value('bloodgroup')) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($patient->bloodgroup)) {
                                                        if ($group->group == $patient->bloodgroup) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $group->group; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>
                                     <!--   <div id="permission" class="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('module_permission'); ?> </label><br>
                                                <?php
                                                $pat_permissions = explode(",", $patients_permissions->permissions);

                                                foreach ($permissions as $permission) {
                                                    ?>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" name="permission[]" value="<?php echo $permission->feature; ?>" 
                                                        <?php
                                                        if (empty($patient->id)) {
                                                            echo 'checked';
                                                        } else {
                                                            if (in_array($permission->feature, $pat_permissions)) {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>
                                                               /> <label for="exampleInputEmail1"><?php echo $permission->feature; ?></label><br>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>-->
                                        <?php if (empty($id)) { ?>

                                            <div class="form-group" style="background-color: transparent;">
                                                <div class="payment_label"> 
                                                </div>
                                                <div class=""> 
                                                    <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                                                </div>
                                            </div>

                                        <?php } ?>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($patient->id)) {
                                            echo $patient->id;
                                        }
                                        ?>'>
                                        <input type="hidden" name="p_id" value='<?php
                                        if (!empty($patient->patient_id)) {
                                            echo $patient->patient_id;
                                        }
                                        ?>'>
</div>
<div class="col-lg-12">
                                        <hr><h3>Checkup Details:</h3> <hr>
                                    </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select Form Templates</label><span class="manda-span">*</span>
                                                <select class="form-control temp_select" id="temp_select" name="form_id" value='' required> 
                                                    <?php if (!empty($temp)) { ?>
                                                        <option value="<?php echo $temp->tid; ?>" selected="selected"><?php echo $temp->tname; ?> - <?php echo $temp->tid; ?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="render_form">
                                            
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Tag Common Symptoms</h4>
                                            <div class="form-group"><input type="text" name="tags_3" id="tags_3" value="<?php echo $checkupTags; ?>" class="tags"> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <section class="">
                                                <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                            </section>
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
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tags_3').tagsInput({
            width: 'auto',

            //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
            autocomplete_url:'checkup/get_taged', // jquery ui autocomplete requires a json endpoint
            autocomplete:{selectFirst:true,width:'100px',autoFill:true},
            'interactive':true
        });

        $("#temp_select").select2({
            placeholder: '<?php echo lang('select_temp'); ?>',
            allowClear: true,
            ajax: {
                url: 'checkup/getTemplateOption',
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

        $("#temp_select").change(function(){
            var tempid = $('#temp_select').val();
            var url =  'checkup/getFormFields';
            var id = $('#id').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {tempid:tempid,id:id},
                success: function(msg){
                    $('#render_form').html('');
                    $('#render_form').append(msg);
                }
            });
        });
    });
</script>
<!--sidebar end-->
<style>
.tagsinput .tag:hover {
    color:#000;
    background-color: #cde69c;
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
                    echo lang('edit_checkup');
                else
                    echo lang('add_checkup');
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
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="checkup/add_new/<?php echo $temp->id; ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id" value="<?php echo $temp->id; ?>">
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                                <select class="form-control pos_select" id="pos_select" name="patient_id" value='' required> 
                                                    <?php if (!empty($temp)) { ?>
                                                        <option value="<?php echo $temp->pid; ?>" selected="selected"><?php echo $temp->pname; ?> - <?php echo $temp->psid; ?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Select Form Templates</label>
                                                <select class="form-control temp_select" id="temp_select" name="form_id" value='' required> 
                                                    <?php if (!empty($temp)) { ?>
                                                        <option value="<?php echo $temp->tid; ?>" selected="selected"><?php echo $temp->tname; ?> - <?php echo $temp->tid; ?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="render_form">
                                            <?php 
                                            if($fields) {
                                                $v = 0;
                                                $s = 0;
                                                $html_vital = $html_symptom = $html = '';
                                                
                                                foreach($fields as $vs) {
                                                    if($vs['category'] == 'vital') {
                                                        $html_vital .= '<div class="form-group col-md-6"><label for="exampleInputEmail1">'.$vs["name"].' ('.$vs["unit"].')</label>';
                                                        if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                                                            $html_vital .= '<input class="form-control" type="'.$vs["field_type"].'" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'">';
                                                        }
                                                        if($vs["input_type"] == 'textarea') {
                                                            $html_vital .= '<textarea class="form-control" name="'.$vs["field_id"].'" >'.$vs["field_values"].'</textarea>';
                                                        }
                                                        $html_vital .= '</div>';
                                                        $v++;
                                                    } else {
                                                        $html_symptom .= '<div class="form-group col-md-12"><label for="exampleInputEmail1">'.$vs["name"].'</label>';
                                                        if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                                                            $html_symptom .= '<input class="form-control" type="'.$vs["input_type"].'" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'">';
                                                        }
                                                        if($vs["input_type"] == 'textarea') {
                                                            $html_symptom .= '<textarea class="form-control" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'"></textarea>';
                                                        }
                                                        if($vs["input_type"] == 'checkbox') {
                                                            $expCheck = explode(',',$vs["input_options"]);
                                                            $expval = explode(',',$vs["field_values"]);
                                                            // $html_symptom .= '<select name="'.$vs["field_id"].'[]" class="form-control">';
                                                            // foreach($expCheck as $ch) {
                                                            //     $html_symptom .= '<option value="'.$ch.'">'.$ch.'</option>';
                                                            // }
                                                            // $html_symptom .= '</select>';
                                                            $html_symptom .= '<br>';
                                                            foreach($expCheck as $ch) {
                                                                if(in_array($ch,$expval)) {
                                                                    $checked = 'checked';
                                                                } else {
                                                                    $checked = '';
                                                                }
                                                                $html_symptom .= '<label class="checkbox-inline"><input type="checkbox" '.$checked.' name="'.$vs["field_id"].'[]" value="'.$ch.'">'.$ch.'</label>';
                                                            }
                                                        }
                                                        if($vs["input_type"] == 'radio') {
                                                            $expCheck = explode(',',$vs["input_options"]);
                                                            $expval = explode(',',$vs["field_values"]);
                                    
                                                            $html_symptom .= '<br>';
                                                            foreach($expCheck as $ch) {
                                                                if(in_array($ch,$expval)) {
                                                                    $checked = 'checked';
                                                                } else {
                                                                    $checked = '';
                                                                }
                                                                $html_symptom .= '<label class="radio-inline"><input type="radio" '.$checked.' name="'.$vs["field_id"].'" value="'.$ch.'">'.$ch.'</label>';
                                                            }
                                                        }
                                                        if($vs["input_type"] == 'selectbox') {
                                                            $expCheck = explode(',',$vs["input_options"]);
                                                            $expval = explode(',',$vs["field_values"]);
                                                            
                                                            $html_symptom .= '<select name="'.$vs["field_id"].'" class="form-control" style="width:50%">';
                                                            foreach($expCheck as $ch) {
                                                                if(in_array($ch,$expval)) {
                                                                    $checked = 'selected';
                                                                } else {
                                                                    $checked = '';
                                                                }
                                                                $html_symptom .= '<option value="'.$ch.'" '.$checked.' >'.$ch.'</option>';
                                                            }
                                                            $html_symptom .= '</select>';
                                                        }
                                                        $html_symptom .= '</div>';
                                                        $s++;
                                                    }
                                                }
                                                if($v > 0) {
                                                    $html .= '<div class="col-lg-12">
                                                    <h4>Vitals</h4> <hr>'.$html_vital.'</div>';
                                                }
                                                if($s > 0) {
                                                    $html .= '<div class="col-lg-12">
                                                    <h4>Symptoms</h4> <hr>'.$html_symptom.'</div>';
                                                }
                                                echo $html;
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Tag Common Symptoms</h4>
                                            <div class="form-group"><input type="text" name="tags_3" id="tags_3" value="<?php echo $checkupTags; ?>" class="tags"> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <hr><h3>Risk Factor:</h3> <hr>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('rtype'); ?></label><span class="manda-span">*</span>
                                                <select class="form-control" name="type" id="rtype" required>
                                                    <option value="1" <?php echo (($risk->type==1)?'selected':''); ?> >Low</option>
                                                    <option value="2"  <?php echo (($risk->type==2)?'selected':''); ?> >Medium</option>
                                                    <option value="3"  <?php echo (($risk->type==3)?'selected':''); ?> >High</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Risk Factors</h4>
                                            <div class="form-group"><input type="text" name="tags_4" id="tags_4" value="<?php echo $riskTags; ?>" class="tags"> 
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Risk Note</h4>
                                            <div class="form-group">
                                                <textarea name="note" id="note" class="form-control"><?php echo $risk->note; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
        $("#rtype").change(function(){
            var url =  'checkup/setrtype';
            var rtype = $('#rtype').val();
            //alert(rtype);
            $.ajax({
                type: "POST",
                url: url,
                data: {rtype:rtype},
                success: function(msg){
                    console.log(msg);
                    $('#tags_4_tagsinput').find('span.tag').remove()
                }
            });
        });
        $("#pos_select").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'checkup/getPatientinfoWithAddNewOption',
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

        $('#tags_4').tagsInput({
            width: 'auto',
            //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
            autocomplete_url:'checkup/get_risks/', // jquery ui autocomplete requires a json endpoint
            autocomplete:{
                selectFirst:true,
                width:'100px',
                autoFill:true
            },
            'interactive':true
        });
        
    });
    </script>

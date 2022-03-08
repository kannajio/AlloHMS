<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($nurse->id))
                    echo lang('edit_nurse');
                else
                    echo lang('add_nurse');
                ?>
            </header>
            <div class="panel-body col-md-7">
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
                                    <form role="form" action="nurse/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($nurse->name)) {
                                                echo $nurse->name;
                                            }
                                            ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('email');
                                            }
                                            if (!empty($nurse->email)) {
                                                echo $nurse->email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('address');
                                            }
                                            if (!empty($nurse->address)) {
                                                echo $nurse->address;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('phone');
                                            }
                                            if (!empty($nurse->phone)) {
                                                echo $nurse->phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <div id="permission" class="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo lang('module_permission'); ?> </label><br>
                                                <?php
                                                $nur_permission = explode(",", $nurses_permissions->permissions);

                                                foreach ($permissions as $permission) {
                                                    if ($permission->feature == 'Patient' || $permission->feature == 'Appointment' || $permission->feature == 'Patient Encounter' || $permission->feature == 'Bed'|| $permission->feature == 'Report' || $permission->feature == 'Email'|| $permission->feature == 'Donor') {
                                                    ?>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" name="permission[]" value="<?php echo $permission->feature; ?>" 
                                                        <?php
                                                        if (empty($nurse->id)) {
                                                            echo 'checked';
                                                        } else {
                                                            if (in_array($permission->feature, $nur_permission)) {
                                                                echo 'checked';
                                                            }
                                                        }
                                                        ?>
                                                               /> <label for="exampleInputEmail1"><?php echo $permission->feature; ?></label><br>
                                                    </div>
                                                <?php } } ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                               if (!empty($nurse->id)) {
                                                   echo $nurse->id;
                                               }
                                               ?>'>

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

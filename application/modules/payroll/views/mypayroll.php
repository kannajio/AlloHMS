<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo "Payroll" ?>
                <div class="col-md-4 clearfix no-print pull-right">
                    
                </div>
            </header>

            <div class="panel-body"> 
                <div class="adv-table editable-table">
                    <div class="space15">
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> <?php echo 'S.No'; ?></th>
                                <th> <?php echo 'Payroll Id'; ?></th>
                                <th> <?php echo 'Employee'; ?></th>
                                <th> <?php echo 'Month'; ?></th>
                                <th> <?php echo 'Year'; ?></th>
                                <th> <?php echo 'Net Salary'; ?></th>
                                <th> <?php echo 'Status'; ?></th>
                                
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
                <h4 class="modal-title">  Add Payroll</h4>
            </div>
            <div class="modal-body row">

            <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="payroll/addPayroll" method="post" enctype="multipart/form-data">
                            <div class="row" style="padding: 20px;">
                            <div class="col-md-2">  
                                <div class="form-group">
                                    <label for="id">S.No</label>
                                    <input type="text" id="id" name="id" class="form-control" readonly value="<?php echo $sno; ?>">
                                </div>
                            </div>

                            <!-- <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="payroll_id">Payroll Id</label>
                                    <input type="text" name="payroll_id" id="payroll_id" class="form-control" readonly value="<?php echo $payroll_id; ?>">
                                </div>
                            </div> -->

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="roll">Role</label>
                                    <select name="role" id="roll" required class="form-control" onchange="getEmployee(this.value);">
                                        <option value="">Select Role</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="pharmacist">Pharmacist</option>
                                        <option value="laboratorist">Laboratorist</option>
                                        <option value="accountant">Accountant</option>
                                        <option value="receptionist">Receptionist</option>
                                        <option value="human_resource">Human Resource</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="emp_id">Employee</label>
                                <select name="emp_id" id="emp_id" required class="form-control">
                                </select>
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select name="month" id="month" required class="form-control">
                                        <option value='1'>January</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-3">  
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" required name="year" id="year" class="form-control" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" max="9999">
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Basic Salary</label>
                                    <input type="text" data-type="number" onblur="checknet();" required name="basic" id="basic" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="allowance">Allowance</label>
                                    <input type="text" data-type="number" onblur="checknet();" required name="allowance" id="allowance" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="deduction">Deductions</label>
                                    <input type="text" data-type="number" onblur="checknet();" required name="deduction" id="deduction" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Net Salary</label>
                                    <input type="text" data-type="number" readonly required name="net" id="net" class="form-control" >
                                </div>
                            </div>

                            
                            <div class="form-group col-md-12" >
                                <button type="submit" name="submit" class="btn btn-info pull-right">SUBMIT</button>
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
                <h4 class="modal-title">  Edit Payroll<?php //echo lang('edit_purchase'); ?></h4>
            </div>
            <div class="modal-body row">
            <form role="form" class="clearfix"  id="editPayrollForm" action="payroll/addPayroll" method="post" enctype="multipart/form-data">
                        <div class="row" style="padding: 20px;">
                        <div class="col-md-2">  
                                <div class="form-group">
                                    <label for="id">S.No</label>
                                    <input type="text" id="id" name="id" class="form-control" readonly value="<?php echo $sno; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="payroll_id">Payroll Id</label>
                                    <input type="text" name="payroll_id" id="payroll_id" class="form-control" readonly value="<?php echo $payroll_id; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="roll">Role</label>
                                    <select name="role" id="roll" required class="form-control" onchange="getEmployeeEdit(this.value);">
                                        <option value="">Select Role</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="pharmacist">Pharmacist</option>
                                        <option value="laboratorist">Laboratorist</option>
                                        <option value="accountant">Accountant</option>
                                        <option value="receptionist">Receptionist</option>
                                        <option value="human_resource">Human Resource</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="emp_id">Employee</label>
                                <select name="emp_id" id="emp_id1" required class="form-control">
                                </select>
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select name="month" id="month" required class="form-control">
                                        <option value='1'>January</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-3">  
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" required name="year" id="year" class="form-control" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" max="9999">
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Basic Salary</label>
                                    <input type="text" data-type="number" onblur="checknet1();" required name="basic" id="basic1" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="allowance">Allowance</label>
                                    <input type="text" data-type="number" onblur="checknet1();" required name="allowance" id="allowance1" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="deduction">Deductions</label>
                                    <input type="text" data-type="number" onblur="checknet1();" required name="deduction" id="deduction1" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Net Salary</label>
                                    <input type="text" data-type="number" readonly required name="net" id="net1" class="form-control" >
                                </div>
                            </div>
                                <button type="submit" name="submit" class="btn btn-info pull-right">SUBMIT</button>
                            </div>
                        </div>
                                
                        

                        </form>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->


<!-- Edit Event Modal-->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  View Payroll<?php //echo lang('edit_purchase'); ?></h4>
            </div>
            <div class="modal-body row">
            <form role="form" class="clearfix"  id="viewPayrollForm" action="payroll/addPayroll" method="post" enctype="multipart/form-data">
                        <div class="row" style="padding: 20px;">
                        <div class="col-md-2">  
                                <div class="form-group">
                                    <label for="id">S.No</label>
                                    <input type="text" id="id" name="id" class="form-control" readonly value="<?php echo $sno; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="payroll_id">Payroll Id</label>
                                    <input type="text" readonly name="payroll_id" id="payroll_id" class="form-control" readonly value="<?php echo $payroll_id; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="roll">Role</label>
                                    <select name="role" disabled id="roll" required class="form-control" onchange="getEmployeeEdit(this.value);">
                                        <option value="">Select Role</option>
                                        <option value="doctor">Doctor</option>
                                        <option value="nurse">Nurse</option>
                                        <option value="pharmacist">Pharmacist</option>
                                        <option value="laboratorist">Laboratorist</option>
                                        <option value="accountant">Accountant</option>
                                        <option value="receptionist">Receptionist</option>
                                        <option value="human_resource">Human Resource</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">  
                            <div class="form-group">
                                <label for="emp_id">Employee</label>
                                <select name="emp_id" disabled id="emp_id2" required class="form-control">
                                </select>
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select name="month" disabled id="month" required class="form-control">
                                        <option value='1'>January</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-3">  
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input type="number" readonly required name="year" id="year" class="form-control" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" max="9999">
                            </div>
                            </div>

                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" disabled required>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Basic Salary</label>
                                    <input type="text" data-type="number" readonly onblur="checknet();" required name="basic" id="basic" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="allowance">Allowance</label>
                                    <input type="text" data-type="number" readonly onblur="checknet();" required name="allowance" id="allowance" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="deduction">Deductions</label>
                                    <input type="text" data-type="number" readonly onblur="checknet();" required name="deduction" id="deduction" onkeypress="return event.charCode == 46 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57)" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">  
                                <div class="form-group">
                                    <label for="basic">Net Salary</label>
                                    <input type="text" data-type="number" readonly required name="net" id="net" class="form-control" >
                                </div>
                            </div>
                            </div>
                        </div>
                                
                        

                        </form>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- View Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#addPayroll").on("click", function () {
            $('#roll option:selected').removeAttr('selected');
            $('#month option:selected').removeAttr('selected');
            $('#status option:selected').removeAttr('selected');
        });
        $(".table").on("click", ".editbutton", function () {
          
            var iid = $(this).attr('data-id');
            $('#editPayrollForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'payroll/editPayrollByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                console.log(response.payrolls.html);
                // Populate the form fields with the data returned from server
                $("#month option[value='" + response.payrolls.month + "']").attr("selected","selected");
                $("#roll option[value='" + response.payrolls.role + "']").attr("selected","selected");
                $("#status option[value='" + response.payrolls.status + "']").attr("selected","selected");
                $('#emp_id1').empty().append(response.payrolls.html);
                $('#editPayrollForm').find('[name="id"]').val(response.payrolls.id).end()
                $('#editPayrollForm').find('[name="payroll_id"]').val(response.payrolls.payroll_id).end()
                $('#editPayrollForm').find('[name="role"]').val(response.payrolls.role).end()
                $('#editPayrollForm').find('[name="year"]').val(response.payrolls.year).end()
                $('#editPayrollForm').find('[name="basic"]').val(response.payrolls.basic).end()
                $('#editPayrollForm').find('[name="allowance"]').val(response.payrolls.allowance).end()
                $('#editPayrollForm').find('[name="deduction"]').val(response.payrolls.deduction).end()
                $('#editPayrollForm').find('[name="net"]').val(response.payrolls.net).end()
            });
        });

        $(".table").on("click", ".viewbutton", function () {
          
          var iid = $(this).attr('data-id');
          $('#viewPayrollForm').trigger("reset");
          $('#myModal3').modal('show');
          $.ajax({
              url: 'payroll/editPayrollByJason?id=' + iid,
              method: 'GET',
              data: '',
              dataType: 'json',
          }).success(function (response) {
              console.log(response.payrolls.html);
              // Populate the form fields with the data returned from server
              $("#month option[value='" + response.payrolls.month + "']").attr("selected","selected");
              $("#roll option[value='" + response.payrolls.role + "']").attr("selected","selected");
              $("#status option[value='" + response.payrolls.status + "']").attr("selected","selected");
              $('#emp_id2').empty().append(response.payrolls.html);
              $('#viewPayrollForm').find('[name="id"]').val(response.payrolls.id).end()
              $('#viewPayrollForm').find('[name="payroll_id"]').val(response.payrolls.payroll_id).end()
              $('#viewPayrollForm').find('[name="role"]').val(response.payrolls.role).end()
              $('#viewPayrollForm').find('[name="year"]').val(response.payrolls.year).end()
              $('#viewPayrollForm').find('[name="basic"]').val(response.payrolls.basic).end()
              $('#viewPayrollForm').find('[name="allowance"]').val(response.payrolls.allowance).end()
              $('#viewPayrollForm').find('[name="deduction"]').val(response.payrolls.deduction).end()
              $('#viewPayrollForm').find('[name="net"]').val(response.payrolls.net).end()
          });
      });
    });

    function checknet() {
        var basic = $('#basic').val();
        var allowence = $('#allowance').val();
        var deduction = $('#deduction').val();
        console.log(deduction);
        if(basic != '' && allowence != '' && deduction != '') {
            var b = basic.replace(",", "");
            
            var a = allowence.replace(",", "");
            
            var d = deduction.replace(",", "");
            
            var ab = parseInt(a)+parseInt(b);
            if(ab > d) {
                var n = parseInt(ab)-parseInt(d);
                var num = new String(n).replace(/,/gi, "");
                var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
                console.log(num2);
                $('#net').val(num2);
            } else {
                $('#net').val('');
            }
        }
    }

    function checknet1() {
        var basic = $('#basic1').val();
        var allowence = $('#allowance1').val();
        var deduction = $('#deduction1').val();
        console.log(deduction);
        if(basic != '' && allowence != '' && deduction != '') {
            var b = basic.replace(",", "");
            
            var a = allowence.replace(",", "");
            
            var d = deduction.replace(",", "");
            
            var ab = parseInt(a)+parseInt(b);
            if(ab > d) {
                var n = parseInt(ab)-parseInt(d);
                var num = new String(n).replace(/,/gi, "");
                var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
                console.log(num2);
                $('#net1').val(num2);
            } else {
                $('#net1').val('');
            }
        }
    }

    $("input[data-type='number']").keyup(function(event){
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
        }
        var $this = $(this);
        var num = $this.val().replace(/,/gi, "");
        var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
        // the following line has been simplified. Revision history contains original.
        $this.val(num2);
    });

    function getEmployee(roll) {
        $.ajax({
                url: 'payroll/getEmployee?roll=' + roll,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                //console.log(response.data);
                $('#emp_id').empty().append(response.data);
                // Populate the form fields with the data returned from server
            });
    }

    function getEmployeeEdit(roll) {
        $.ajax({
                url: 'payroll/getEmployee?roll=' + roll,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                //console.log(response.data);
                $('#emp_id1').empty().append(response.data);
                // Populate the form fields with the data returned from server
            });
    }
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });</script>



<script>


    $(document).ready(function () {
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            // "processing": true,
            // "serverSide": true,
            // "searchable": true,
            "ajax": {
                url: "payroll/getMyPayrollList",
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
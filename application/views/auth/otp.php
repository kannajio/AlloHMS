<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">

        <title>Login - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <style>


                form{

                    padding: 0px;
                    border: none;


                }
          

            </style>

            <form class="form-signin" method="post" action="auth/login">
                 <h2 class="login form-signin-heading">Verification<br/><br/>
                 <?php 
                 $settings = $this->db->get('settings')->row();
                 if($settings->logo) {
                 ?>
                    <a href="auth/login" class="">
                    <img src="<?php echo $settings->logo; ?>" width="200" height=""></a>
                 <?php } else {
                 ?>
                    <a href="auth/login"><img alt="" src="uploads/favicon.png"></a>
                <?php } ?>
                </h2>
                <div id="infoMessage"><?php echo $message; ?></div>
                <div class="login-wrap">
                    <?php if($_SESSION['login_methode'] == 'email') { ?>
                        <input type="text" class="form-control" name="identity" value = "<?php echo $_SESSION['userinput']; ?>" required>
                        <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password">
                        <input type="checkbox" onclick="myFunction()"> <span style="position:relative; bottom:2px;">Show Password</span>
                    <?php } else { ?>
                        <input type="text" class="form-control" name="identity" readonly value = "<?php echo $_SESSION['userinput']; ?>" required>
                        <input type="text" class="form-control"  name="password" placeholder="Enter OTP" maxlength="5">
                        <p style="text-align: right;font-size: 12px;"><a href="auth/resend">Resend Otp</a></p>
                    <?php } ?>




                   <p><a data-toggle="modal" href="#myModal"> Forgot Password?</a></p>
                    <!--     
                          <label class="checkbox">
                              <input type="checkbox" value="remember-me"> Remember me
                              <span class="pull-right">
                                  <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
              
                              </span>
                          </label> 
                    -->
                    
                    
                    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
  <style>
                        table, th, td {
                            border: 1px solid #f1f2f7;
                            border-collapse: collapse;
                        }
                        th, td {
                            padding: 5px;
                            text-align: left;
                            font-size:12px;
                        }
                        td,th,h4{
                            color:#aaa;
                            
                        }
                    </style>
          


                </div>



            </form>

        </div>









        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="auth/forgot_password">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input class="btn detailsbutton" type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="common/js/jquery.js"></script>
        <script src="common/js/bootstrap.min.js"></script>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
    </body>
</html>

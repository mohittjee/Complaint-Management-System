<?php
session_start();
error_reporting(0);
include("includes/config.php");

if(isset($_POST['submit']))
{
    $ret = mysqli_query($bd, "SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
    $num = mysqli_fetch_array($ret);
    if($num > 0)
    {
        $extra = "dashboard.php";
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        $log = mysqli_query($bd, "insert into userlog(uid, username, userip, status) values('".$_SESSION['id']."', '".$_SESSION['login']."', '$uip', '$status')");
        $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
    else
    {
        $_SESSION['login'] = $_POST['username'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        mysqli_query($bd, "insert into userlog(username, userip, status) values('".$_SESSION['login']."', '$uip', '$status')");
        $errormsg = "Invalid username or password";
    }
}

if(isset($_POST['change']))
{
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = md5($_POST['password']);
    $query = mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
    $num = mysqli_fetch_array($query);
    if($num > 0)
    {
        mysqli_query($bd, "update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
        $msg = "Password Changed Successfully";
    }
    else
    {
        $errormsg = "Invalid email id or Contact no";
    }
}

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $contactno = $_POST['contactno'];
    $status = 1;
    $query = mysqli_query($bd, "insert into users(fullName, userEmail, password, contactNo, status) values('$fullname', '$email', '$password', '$contactno', '$status')");
    $msg = "Registration successful. Now you can login!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Campus Connect | User Management</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script type="text/javascript">
        function valid() {
            if(document.forgot.password.value != document.forgot.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.forgot.confirmpassword.focus();
                return false;
            }
            return true;
        }

        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {}
            });
        }
    </script>
</head>

<body>
    <div id="login-page">
        <div class="container">
            <div class="row">
                <!-- Login Form -->
                <div class="col-md-6">
                    <form class="form-login" name="login" method="post">
                        <h2 class="form-login-heading">Sign In Now</h2>
                        <p style="color: red;"><?php if($errormsg){ echo htmlentities($errormsg); } ?></p>
                        <div class="login-wrap">
                            <input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
                            <br>
                            <input type="password" class="form-control" name="password" required placeholder="Password">
                            <label class="checkbox">
                                <span class="pull-right">
                                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                                </span>
                            </label>
                            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                            <hr>
                            <div class="registration">
                                Don't have an account yet?<br/>
                                <a href="#register">Create an account</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Registration Form -->
                <div class="col-md-6" id="register">
                    <form class="form-login" method="post">
                        <h2 class="form-login-heading">User Registration</h2>
                        <p style="color: green;"><?php if($msg){ echo htmlentities($msg); } ?></p>
                        <div class="login-wrap">
                            <input type="text" class="form-control" placeholder="Full Name" name="fullname" required autofocus>
                            <br>
                            <input type="email" class="form-control" placeholder="Email" id="email" onBlur="userAvailability()" name="email" required>
                            <span id="user-availability-status1" style="font-size:12px;"></span>
                            <br>
                            <input type="password" class="form-control" placeholder="Password" required name="password"><br>
                            <input type="text" class="form-control" maxlength="10" name="contactno" placeholder="Contact no" required autofocus>
                            <br>
                            <button class="btn btn-theme btn-block" type="submit" name="register" id="register"><i class="fa fa-user"></i> Register</button>
                            <hr>
                            <div class="registration">
                                Already Registered<br/>
                                <a href="#login">Sign in</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Forgot Password -->
        <form class="form-login" name="forgot" method="post">
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your details below to reset your password.</p>
                            <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br>
                            <input type="text" name="contact" placeholder="Contact No" autocomplete="off" class="form-control" required><br>
                            <input type="password" class="form-control" placeholder="New Password" id="password" name="password" required><br>
                            <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>
</body>
</html>

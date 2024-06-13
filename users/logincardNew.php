<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
// $extra="change-password.php";
$extra="dashboard.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($bd, "insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($bd, "insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid username or password";
$extra="login.php";

}
}



if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($bd, "update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
$msg="Password Changed Successfully";

}
else
{
$errormsg="Invalid email id or Contact no";
}
}
?>
<!-- =================== -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>CampusConnect: Optimizing College Administrations</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



  <!-- ================================== -->
  <script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>

<!-- ========================== -->

  <!-- Favicons -->
  <link href="../XYZ/assets/img/team/team-3.png" rel="icon">
  <link href="../XYZ/assets/img/team/team-3.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../XYZ/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../XYZ/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../XYZ/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../XYZ/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../XYZ/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../XYZ/assets/css/main.css" rel="stylesheet">


  
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="https://www.doonbusinessschool.com/" class="logo d-flex align-items-center me-auto" target="_blank">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../XYZ/assets/img/logoodfgsdgo.png" alt="">
        <!-- <h1 class="sitename">Arsha</h1> -->
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact</a></li>

          <li class="dropdown"><a href="#"><span class="btn-getstarted">Sign Up Now!</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>As User</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="http://localhost/Complaint Management System/users/index.php" target="_blank">Login</a></li>
                  <li><a href="http://localhost/Complaint Management System/users/registration.php" target="_blank">Register</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>As Admin</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="http://localhost/Complaint Management System/admin/" target="_blank">Department Admin</a></li>
                  <li><a href="http://localhost/Complaint Management System/admin/" target="_blank">Super Admin</a></li>
                </ul>
              </li>
            </ul>
          </li>
         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      


      <!-- signup card activation-------- -->

      <nav class="navbar" style="display: none;">
          <span class="hamburger-btn material-symbols-rounded"></span>
          
          <ul class="links">
              <span class="close-btn material-symbols-rounded"></span>
          </ul>
      </nav>
      <!-- <a class="btn-getstarted " href="#about">Get Started</a> -->           
        <button class="login-btn btn-getstarted" style="border-width: 0;">LOG IN</button>

    </div>
  </header>
  




  <!-- sign popup form

  <div class="blur-bg-overlay"></div>
    <div class="form-popup">
        <span class="close-btn material-symbols-rounded">close</span>
        <div class="form-box login">
            <div class="form-details">
                <h2>Welcome Back</h2>
                <p>Please log in using your personal information to stay connected with us.</p>
            </div>
            <div class="form-content">
                <h2>LOGIN</h2>
                <form action="#">
                    <div class="input-field">
                        <input type="text" required>
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" required>
                        <label>Password</label>
                    </div>
                    <a href="#" class="forgot-pass-link">Forgot password?</a>
                    <button type="submit">Log In</button>
                </form>
                <div class="bottom-link">
                    Don't have an account?
                    <a href="#" id="signup-link">Signup</a>
                </div>
            </div>
        </div>
        <div class="form-box signup">
            <div class="form-details">
                <h2>Create Account</h2>
                <p>To become a part of our community, please sign up using your personal information.</p>
            </div>
            <div class="form-content">
                <h2>SIGNUP</h2>
                <form action="#">
                    <div class="input-field">
                        <input type="text" required>
                        <label>Enter your email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" required>
                        <label>Create password</label>
                    </div>
                    <div class="policy-text">
                        <input type="checkbox" id="policy">
                        <label for="policy">
                            I agree the
                            <a href="#" class="option">Terms & Conditions</a>
                        </label>
                    </div>
                    <button type="submit">Sign Up</button>
                </form>
                <div class="bottom-link">
                    Already have an account? 
                    <a href="#" id="login-link">Login</a>
                </div>
            </div>
        </div>
    </div> -->

  <!-- sign popup form end -->



<!-- new embedded one -->

<div id="login-page">
    <div class="container">
        <div class="form-popup">
            <span class="close-btn material-symbols-rounded">close</span>
            <div class="form-box login">
                <div class="form-details">
                    <h2>Welcome Back</h2>
                    <p>Please log in using your personal information to stay connected with us.</p>
                </div>
                <div class="form-content">
                    <h2>LOGIN</h2>
                    <form class="form-login" name="login" method="post" action="#">
                        <div class="input-field">
                            <input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
                        </div>
                        <div class="input-field">
                            <input type="password" class="form-control" name="password" required placeholder="Password">
                        </div>
                        <a href="#" class="forgot-pass-link" data-toggle="modal" data-target="#myModal">Forgot password?</a>
                        <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> Log In</button>
                    </form>
                    <div class="bottom-link">
                        Don't have an account?
                        <a href="registration.php">Create an account</a>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your details below to reset your password.</p>
                            <form class="form-login" name="forgot" method="post" action="#">
                                <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
                                <input type="text" name="contact" placeholder="Contact No" autocomplete="off" class="form-control" required><br>
                                <input type="password" class="form-control" placeholder="New Password" id="password" name="password" required><br />
                                <input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        </div>
    </div>
</div>








  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 class="">Campus Connect</h1>
            <p class="">Optimizing College Administrations</p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
              <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="../XYZ/assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section" >

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 class="">About This Project</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-7 content order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

            <p>
              The purpose of<b> Campus Connect</b> for Colleges and other educational institutes, for better 
              automation in focus. Campus Connect deals with all types of grievances, complaints and
              malpractices including those received from Students, Faculty and other Stakeholders.<br><br>
              The objectives of this project are:
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>To set up a mechanism for speedy and expeditious resolution of the grievance. </span></li>
              <li><i class="bi bi-check2-circle"></i> <span>To provide an appropriate counseling to the students in the process of resolving their complaint/queries.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>To provide an opportunity for the students to freely express their grievance, with utmost anonymity. </span></li>
            </ul>
            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-lg-5 order-1 order-lg-2 why-us-img">
            <img src="../XYZ/assets/img/why-us.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>

        </div>

      </div>

    </section><!-- /About Section -->









      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
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
<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
<input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >

		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>
		
		      	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>

















    <!-- Skills Section -->
    <section id="skills" class="skills section" style="background-color: color-mix(in srgb, var(--heading-color), transparent 95%)">

      <div class="container section-title" data-aos="fade-up">
        <h2>Technologies Used</h2>
      </div>
      
        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">

            <div class="col-lg-6 d-flex align-items-center">
              <img src="../XYZ/assets/img/skills.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 pt-4 pt-lg-0 content">

              <h3>XAMPP</h3>
              <p class="fst-italic">
                XAMPP, which stands for Cross-Platform, Apache, MySQL, PHP, and Perl, is a free platform that allows developers to test their code locally on their own computers.
              </p>

              <div class="skills-content skills-animation">

                <div class="progress">
                  <span class="skill"><span>HTML</span> <i class="val">100%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill"><span>CSS</span> <i class="val">90%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill"><span>PHP</span> <i class="val">75%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill"><span>JavaScript</span> <i class="val">55%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

              </div>

            </div>
          </div>

        </div>

    </section><!-- /Skills Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Introducing all the mentors and teachers who helped me throughout the project</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="../XYZ/assets/img/team/team-1.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Prof. Vishant Kumar</h4>
                <span>Mentor, Class Coordinator</span>
                <p>Helped me throughout the project</p>
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a> -->
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="../XYZ/assets/img/team/team-1.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Prof. Saurabh Singh</h4>
                <span>Guide, Program Coordinator</span>
                <p>Guided me throughout the project</p>
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a> -->
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="../XYZ/assets/img/team/team-3.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Mohit Kumar</h4>
                <span>Student</span>
                <p>I'm the one who built this project</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <!-- <a href=""><i class="bi bi-facebook"></i></a> -->
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    


    
   
    <!-- Contact Section -->
    <section id="contact" class="contact section" style="background-color: color-mix(in srgb, var(--heading-color), transparent 95%)">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Feel free to contact me anytime. Leave me a message now!</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>Nigam Road, Selaqui, Dehradun 248011</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Me</h3>
                  <p>+91 7292842654</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email</h3>
                  <p>mohittjee@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3442.590151789999!2d77.85646217493607!3d30.362595774764866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390f2a383e0ec653%3A0xeebe6d60f64f74f9!2sNigam%20Rd%2C%20Selaqui%20Industrial%20Area%2C%20Selakui%2C%20Haripur%2C%20Uttarakhand%20248011!5e0!3m2!1sen!2sin!4v1715542723223!5m2!1sen!2sin" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">
            <form action="../XYZ/forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">

    <!-- <div class="footer-newsletter">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright 2024</span> <strong class="px-1 sitename">Campus Connect</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../XYZ/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../XYZ/assets/vendor/php-email-form/validate.js"></script>
  <script src="../XYZ/assets/vendor/aos/aos.js"></script>
  <script src="../XYZ/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../XYZ/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../XYZ/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../XYZ/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../XYZ/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../XYZ/assets/js/main.js"></script>

</body>

</html>
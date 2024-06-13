<!-- ----------------new  -->
<?php
session_start();
error_reporting(0);
include("users/includes/config.php");
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

<!-- ------------------ new  -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo "CampusConnect: Optimizing College Administrations"; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./XYZ/assets/img/team/team-3.png" rel="icon">
  <link href="./XYZ/assets/img/team/team-3.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./XYZ/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./XYZ/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./XYZ/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./XYZ/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./XYZ/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="./XYZ/assets/css/main.css" rel="stylesheet">



  <!-- ------------new -->
  <!-- Bootstrap core CSS -->
  <!-- <link href="./users/assets/css/bootstrap.css" rel="stylesheet"> -->
    <!--external css-->
    <!-- <link href="./users/assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
        
    <!-- Custom styles for this template -->
    <!-- <link href="./users/assets/css/style.css" rel="stylesheet">
    <link href="./users/assets/css/style-responsive.css" rel="stylesheet"> -->


  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- ----------------------  -->
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

<!-- ------------- -->


  
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="" class="logo d-flex align-items-center me-auto" target="_blank">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="./XYZ/assets/img/team/team-3.png" alt="">
        <!-- <h1 class="sitename">Arsha</h1> -->
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#team">Team</a></li>
          <!-- <li><a href="#contact">Contact</a></li> -->

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

      <!-- <nav class="navbar" style="display: none;">
          <span class="hamburger-btn material-symbols-rounded"></span>
          
          <ul class="links">
              <span class="close-btn material-symbols-rounded"></span>
          </ul>
      </nav>

      <a class="btn-getstarted " href="http://localhost/Complaint Management System/users/logincardNew.php" target="_blank">Get Started</a>  

        <button class="login-btn btn-getstarted" style="border-width: 0;">LOG IN</button>

    </div> -->
  </header>
  




  <!-- sign popup form -->

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
                <form class = "form-login" name="login" method="post" action="#">
                    <div class="input-field">
                        <input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
                        <!-- <label>Email</label> -->
                    </div>


                    <!-- ------------------new  -->
                    <p style="padding-left:4%; padding-top:2%;  color:red">
		        	      <?php if($errormsg){
                      echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	      <?php if($msg){
                      echo htmlentities($msg);
		        		}?></p>
                <!-- ------------------------------  -->


                    <div class="input-field">
                        <input type="password" class="form-control" name="password" required placeholder="Password" required>
                        <!-- <label>Password</label> -->
                    </div>
                    <a class="forgot-pass-link" data-toggle="modal" href="#myModal">Forgot password?</a>
                    <button type="submit" name = "submit" ><i class="fa fa-lock"></i> Log In</button>
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

        <!-- model new -----------------------  -->

            
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="form-login" name="forgot" method="post" action="#">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">FORGOT PASSWORD?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Enter your details below to reset your password.</p>
                                    <div class="input-field">
                                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
                                    </div>
                                    <div class="input-field">
                                        <input type="text" name="contact" placeholder="Contact No" autocomplete="off" class="form-control" required>
                                    </div>
                                    <div class="input-field">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
                                    </div>
                                    <div class="input-field">
                                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="change" class="btn btn-theme" onclick="return valid();"><i class="fa fa-lock"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>





              <!-- -------------------------------------  -->

    </div>

  <!-- sign popup form end -->










  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 class="">Campus Connect</h1>
            <p class="">Optimizing College Administrations</p>
            <div class="d-flex">
              <a href="http://localhost/Complaint Management System/users/index.php" target="_blank" class="btn-get-started">Get Started</a>
              <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="./XYZ/assets/img/hero-img.png" class="img-fluid animated" alt="">
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
            <a href="./CampusConnect Report.pdf" target="_blank" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-lg-5 order-1 order-lg-2 why-us-img">
            <img src="./XYZ/assets/img/why-us.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Skills Section -->
    <section id="skills" class="skills section" style="background-color: color-mix(in srgb, var(--heading-color), transparent 95%);">

      <div class="container section-title" data-aos="fade-up">
        <h2>Technologies Used</h2>
      </div>
      
        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">

            <div class="col-lg-6 d-flex align-items-center">
              <img src="./XYZ/assets/img/skills.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 pt-4 pt-lg-0 content">

              <h3>XAMPP</h3>
              <p class="fst-italic">
                XAMPP, which stands for Cross-Platform, Apache, MySQL, PHP, and Perl, is a free platform that allows developers to test their code locally on their own computers.
              </p>

              <div class="skills-content skills-animation">

                <div class="progress" >
                  <span class="skill" style="margin-top:5px;"><span>HTML</span> <i class="val">100%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill" style="margin-top:5px;"><span>CSS</span> <i class="val">80%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill" style="margin-top:5px;"><span>PHP</span> <i class="val">75%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->

                <div class="progress">
                  <span class="skill" style="margin-top:5px;"><span>JavaScript</span> <i class="val">55%</i></span>
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
              <div class="pic"><img src="./XYZ/assets/img/team/team-1.png" class="img-fluid" alt=""></div>
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
              <div class="pic"><img src="./XYZ/assets/img/team/team-1.png" class="img-fluid" alt=""></div>
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
              <div class="pic"><img src="./XYZ/assets/img/team/team-3.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Mohit Kumar</h4>
                <span>Student</span>
                <p>Build this project with the help of guide and mentor</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <!-- <a href=""><i class="bi bi-facebook"></i></a> -->
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="./XYZ/assets/img/team/team-1.png" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Kanhiya Singh</h4>
                <span>Student</span>
                <p>Build this project with the help of guide and mentor</p>
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                  <!-- <a href=""><i class="bi bi-facebook"></i></a> -->
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <!-- <a href=""> <i class="bi bi-linkedin"></i> </a> -->
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    


    
   
   

  </main>

  <!-- <footer id="footer" class="footer"> -->

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
  <script src="./XYZ/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./XYZ/assets/vendor/php-email-form/validate.js"></script>
  <script src="./XYZ/assets/vendor/aos/aos.js"></script>
  <script src="./XYZ/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./XYZ/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./XYZ/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="./XYZ/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="./XYZ/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="./XYZ/assets/js/main.js"></script>



  <!-- for loginpage to work--------------------------  -->
  

 


</body>

</html>
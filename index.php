<!DOCTYPE html>
<?php include_once "check.php" ?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Republic of The Philippines</title>
  <link rel="icon" type="image/x-icon" href="assets/bfp-logo.png" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <!-- JQUERY -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
</head>

<body>
  <div class="alert alert-success alert-dismissible" id="errorMessage" style="display:none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
  <!-- Background Video-->
  <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="assets/mp4/bg.mp4" type="video/mp4" />
  </video>
  <!-- Masthead-->

  <div class="masthead">
    <div class="masthead-content text-white">
      <div class="container-fluid px-4 px-lg-0">
        <h1 class="fst-italic lh-1 mb-4 text-decoration-underline">Republic of the Philippines</h1>
        <p class="mb-5 fst-italic lh-1">Bureau of Fire Protection Fire Safety Enforcement Division Region 4A CALABARZON</p>
        <div id="contactForm">
          <!-- Email address input-->
          <div class="row input-group-newsletter">
            <div class="col-auto">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registermodal" id="" type="submit">REGISTER</button>
              <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginmodal" id="" type="submit">LOGIN</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- VISION MISSION -->
  <div class="modal fade" id="VandM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="card-header d-flex justify-content-between">
          <button type="button" style="border:white;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="cardstyle">
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" style="height:40px; width:40px; border-radius: 50%" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" style="height:40px; width:40px; border-radius: 50%"  data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img id="visionimg" src="assets/vision.png" class="img-fluid" alt="">
              </div>
              <div class="carousel-item">
                <img id="missionimg" src="assets/mission.png" class="img-fluid" alt="">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function(){
    $("#visionbtn").click(function(){
      $("#visionimg").show();
      $("#missionimg").hide();
    });
    $("#missionbtn").click(function(){
      $("#visionimg").hide();
      $("#missionimg").show();
    });
  });  
  </script>
  <div class="modal fade" id="contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-end">
          <button type="button" style="border:white;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="assets/location.png" class="img-fluid" alt="">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30941.15245396653!2d121.117962!3d14.215608!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd4d65be3dde426c8!2sBureau%20of%20Fire%20Protection%20Regional%20Office%204a%20CALABARZON!5e0!3m2!1sen!2sus!4v1666711406324!5m2!1sen!2sus" width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form action="" method="GET" id="form-login">
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="form-floating">
                  <input type="text" name="form_username" id="floatusername" class="form-control" placeholder="username" required>
                  <label for="floatusername">Account Code</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                <div class="form-floating">
                  <input type="password" name="form_password" id="floatpassword" class="form-control" placeholder="Password" required>
                  <label for="floatpassword">Password</label>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-xl w-100 p-3" id="loginbtn" type="submit">LOGIN</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <form method="POST" action="" id="registered-form">
            <!-- Name input-->
            <?php
            $code = rand(1000, 9999);
            $uniquecode = "BFP FSED:" . $code;
            ?>
            <div class="form-floating mb-3">
              <input class="form-control" value="<?php echo $uniquecode ?>" id="accountcode" name="accountcode" type="text" placeholder="Enter your ID..." required>
              <label for="accountcode">Account Code</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" id="emailadd" name="emailadd" type="email" placeholder="Enter your email address..." required>
              <label for="emailadd">Email Address</label>
            </div>
            <!-- password input-->
            <div class="form-floating mb-3">
              <input class="form-control" name="password" title="password must be secured" id="password" type="password" placeholder="password" required>
              <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" name="cpassword" id="cpassword" type="password" placeholder="password" required>
              <label for="cpassword">Confirm Password</label>
            </div>
            <div class="form-floating mb-3">
              <select name="position" id="position" onchange="showpos(this.value)" class="form-select" required>
                <option>--Choose--</option>
                <option value="Municipal">Municipal</option>
                <option value="Provincial">Provincial</option>
              </select>
              <label for="position">Position</label>
            </div>
            <div class="form-floating mb-3">
              <select name="location" id="location" class="form-select" required></select>
              <label for="location">Place</label>
            </div>
            Profile Picture
            <input type="file" class="form-control mb-3" name="profile-img" required>
            <button class="btn btn-primary btn-xl w-100 p-3" id="submitregbtn" type="submit">CREATE ACCOUNT</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showpos(posvalue) {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("location").innerHTML = this.responseText;
      }
      xhttp.open("GET", "position.php?choose=" + posvalue);
      xhttp.send();
    }
  </script>
  <!-- Social Icons-->
  <div class="social-icons">
    <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
      <a class="btn btn-dark m-3" style="cursor: pointer;" href="https://web.facebook.com/bfp4apis" title="Facebook"><i class="fab fa-facebook"></i></a>
      <a class="btn btn-dark m-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#VandM" title="Vision and Mission"><i class="fa-solid fa-bullseye"></i></a>
      <a class="btn btn-dark m-3" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#contact" title="Contact Us"><i class="fa-solid fa-address-book"></i></a>
    </div>
  </div>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/register.js"></script>
  <script src="js/login.js"></script>
  <script src="js/scripts.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>
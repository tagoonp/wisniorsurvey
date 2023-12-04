<?php 
require('./config/config_database.php');
require('./config/inc_config_general.php');
require('./config/inc_database.php'); 
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>สมัครใช้งาน <?php  echo FIX_TITLE_FULL; ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="./assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="./assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="./assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="./assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="./assets/vendor/preload.js/dist/css/preload.css" rel="stylesheet">
    <!-- Vendor -->
    <link rel="stylesheet" href="./assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css" />

    <link rel="stylesheet" href="./assets/custom/css/style.css?v=<?php echo $date; ?>" />
    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover" style="background-image: url('./upload/SL_060521_43530_17.jpg');background-size:     cover; 
      background-repeat:   no-repeat;
      background-position: center center; ">
      <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
          <div class="w-100 d-flex justify-content-center">
            <img
              src="./assets/img/illustrations/boy-with-rocket-light.png"
              class="img-fluid"
              alt="Login image"
              width="700"
              data-app-dark-img="illustrations/boy-with-rocket-dark.png"
              data-app-light-img="illustrations/boy-with-rocket-light.png"
            />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="card">
              <div class="card-body">
              <div class="app-brand mb-5">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                </span>
               
              </a>
            </div>
            <!-- /Logo -->
            <div class="text-center">
                <img src="./upload/logo-1.png" alt="" width="150">
                <h1 class="text-dark mb-3 mt-4">สมัครใช้งานระบบ</h1>
                <h5 class="text-dark mb-4"><?php  echo FIX_TITLE_EN; ?></h5>
            </div>
            
            <!-- <p class="mb-2 text-dark text-center">เข้าสู่ระบบด้วยหมายเลขโทรศัพท์</p> -->

            <form id="" class="mb-3" onsubmit="authen.signup(); return false;" autocomplete="off">
              <div class="mb-3">
                <input  type="text" class="form-control text-center" value="" id="txtFname" name="txtFname" placeholder="ชื่อ - นามสกุล" autofocus style="padding: 15px 3px;" />
              </div>
              <div class="mb-3">
                <input  type="email" class="form-control text-center" value="" id="txtEmail" name="txtEmail" placeholder="อีเมลแอดเดรส" style="padding: 15px 3px;" />
              </div>
              <div class="mb-3">
                <input  type="text" class="form-control text-center" value="" id="txtPhone" name="txtPhone" placeholder="หมายเลขโทรศัพท์ (ไม่บังคับ)" style="padding: 15px 3px;" />
              </div>
              <div class="mb-3">
                <input  type="password" class="form-control text-center" value="" id="txtPassword" name="txtPassword" placeholder="ตั้งรหัสผ่าน"  style="padding: 15px 13px;" />
              </div>
              <div class="mb-3">
                <input  type="password" class="form-control text-center" value="" id="txtPassword2" name="txtPassword2" placeholder="ยืนยันรหัสผ่านที่ตั้งอีกครั้ง"  style="padding: 15px 13px;" />
              </div>
              <button class="btn btn-primary d-grid w-100 btn-lg mb-5" type="submit">สมัครใช้งาน</button>
              <p class="text-center">
                <span class="text-dark">มีบัญชีผู้ใช้งานแล้ว</span>
                <a href="./" class="">
                  <span>- ไปเข้าสู่ระบบ - </span>
                </a>
              </p>
            </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="./assets/vendor/libs/hammer/hammer.js"></script>
    <script src="./assets/vendor/libs/i18n/i18n.js"></script>
    <script src="./assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="./assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="./assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="./assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="./assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="./assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="./assets/vendor/preload.js/dist/js/preload.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="./config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="./assets/custom/js/authen.js?v=<?php echo $dateu; ?>"></script>
    <script>
      $(document).ready(function(){
        preload.hide()
      })
    </script>
  </body>
</html>

<?php 
require('../../../../../../../config/server.inc.php');
require('../../../../../../../config/config.php');
require('../../../../../../../config/database.php'); 
require('../../../../../../../config/function.php'); 
require('../../../../../../../config/assesment_user.php'); 

$page_name = basename(__FILE__) ;

$userInfo = false;
if(!isset($_REQUEST['uid'])){
  $userInfo = false;
}

$target_uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);

?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>C-Care : ข้อมูลผู้ใช้งาน</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

    <link href="../../../../../assets/css/style.css?v=<?php echo filemtime('../../../../../assets/css/style.css'); ?>" rel="stylesheet">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        
        <?php 
        require_once('./comp/side_menu.php');
        ?>

        <!-- Layout container -->
        <div class="layout-page">

          <?php 
          require_once('./comp/nav.php');
          ?>
          

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                  <div class="col-12">
                    <h3>บัญชีผู้ใช้งาน</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <!-- <li class="breadcrumb-item">
                          <a href="javascript:void(0);">บัญชีผู้ใช้งาน</a>
                        </li> -->
                        <li class="breadcrumb-item active">บัญชีผู้ใช้งาน</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="col-12">
                    <div class="card">
                      <div class="card-header pt-4">
                        <h4>รายชื่อผู้ใช้งานทั้งหมด</h4>
                      </div>
                      <div class="card-body">
                        <table class="table table-border-top" id="table-1">
                          <thead>
                            <tr>
                              <th width="50">#</th>
                              <th>ชื่อ - นามสกุล</th>
                              <th>สถานบริการสาธารณสุข</th>
                              <th>หมายเลขโทรศัพท์</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $strSQL = "SELECT * FROM e4dx_user a LEFT JOIN e4dx_service_center b ON a.info_health_center_id = b.center_id
                                      WHERE role_inno_admin = 'Y' OR role_inno_staff = 'Y' AND allow_access = 'Y' AND delete_status = 'N'";
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                              $c = 1;
                              foreach ($res['data'] as $row) {
                                ?>
                                <tr>
                                  <td><?php echo $c; ?></td>
                                  <td>
                                  <?php   
                                  if(($row['info_photo'] != null) && ($row['info_photo'] != '')){
                                    ?>
                                    <img src="<?php echo $row['info_photo'];?>" alt="" width="40" style="border-radius: 50%;">
                                    <?php
                                  }else{
                                    ?>
                                    <img src="<?php echo ROOT_DOMAIN.'application/images/pi-icon-6.png';?>" alt="" width="40" style="border-radius: 50%;">
                                    <?php
                                  }
                                  ?>
                                    <a href="" style="padding-left: 20px;"><?php echo $row['fname'] . ' ' . $row['lname']; ?></a>
                                  </td>
                                  <td>
                                    <?php if(($row['center_name'] == '') || ($row['center_name'] == null)){ echo "-"; }else{ echo $row['center_name']; }?>
                                  </td>
                                  <td>
                                    <?php if(($row['mobile'] == '') || ($row['mobile'] == null)){ echo "-"; }else{ echo$row['mobile']; }?>
                                  </td>
                                  <td style="text-align: right;">
                                    <a href="app-user-info?uid=<?php echo $row['uid'];?>" class="btn btn-icon"><i class="bx bx-search"></i></a>
                                    <a href="" class="btn btn-icon"><i class="bx bx-trash text-danger"></i></a>
                                  </td>
                                </tr>
                                <?php
                                $c++;
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-crm.js"></script>

    <script>
      $(document).ready(function(){
        if($('#table-1').length){
          $('#table-1').dataTable({})
        }
      })
    </script>
  </body>
</html>

<?php 
require('../../../../../../../config/server.inc.php');
require('../../../../../../../config/config.php');
require('../../../../../../../config/database.php'); 
require('../../../../../../../config/function.php'); 
require('../../../../../../../config/assesment_user.php'); 

$page_name = basename(__FILE__) ;

$start_date = date('Y').'-01-01';
$end_date = date('Y-m-d');

$form_arr = array(
  'e4dx_assesment_adl', 
  'e4dx_assesment_bloodtest', 
  'e4dx_assesment_depression_2q', 
  'e4dx_assesment_depression_9q', 
  'e4dx_assesment_dm', 
  'e4dx_assesment_dropping', 
  'e4dx_assesment_druguse', 
  'e4dx_assesment_hearth', 
  'e4dx_assesment_knee', 
  'e4dx_assesment_lmna', 
  'e4dx_assesment_minicog_1', 
  'e4dx_assesment_mouth', 
  'e4dx_assesment_mouth_2', 
  'e4dx_assesment_mouth_3', 
  'e4dx_assesment_mouth_4', 
  'e4dx_assesment_muscle', 
  'e4dx_assesment_ncd', 
  'e4dx_assesment_smna',
  'e4dx_assesment_strain'
);

$form_prefix = array(
  'aadl', 
  'abt', 
  'ad2q', 
  'ad9q', 
  'dm2', 
  'ad', 
  'adu', 
  'adh', 
  'akn', 
  'almna', 
  'mc1', 
  'adm', 
  'adm2', 
  'adm2', 
  'adm2', 
  'amc', 
  'ncd', 
  'asmna', 
  'ast'
);
?>

<input type="hidden" name="txtUid" id="txtUid" value="<?php echo $currentUser['uid']; ?>">

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>C-Care : รายงานการทำแบบประเมิน</title>

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
    <link rel="stylesheet" href="../../../../../assets/vendor/preload.js/dist/css/preload.css" rel="stylesheet">
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
                  <div class="col-12 col-sm-9">
                    <h3>รายงานการทำแบบประเมิน <small>(ตั้งแต่ <?php echo $start_date . ' ถึง ' . $end_date; ?>)</small></h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="javascript:void(0);">รายงาน</a>
                        </li>
                        <li class="breadcrumb-item active">รายงานการทำแบบประเมิน</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="col-12 col-sm-3 text-right">
                    <button class="btn btn-primary mt-sm-4"><i class="bx bx-cog"></i> ตั้งค่า</button>
                  </div>
                  
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header pt-4">
                        <h4 class="mb-0">จำแนกตามสถานบริการที่อยู่ในระบบ</h4>
                      </div>
                      <div class="card-body">
                        <table class="table table-border-top" id="table-1">
                          <thead>
                            <tr>
                              <th>สถานบริการสาธารณสุข</th>
                              <th>ผู้ใช้งาน (บัญชี)</th>
                              <th>ทำแบบประเมิน (ครั้ง)</th>
                              <th>ร้องขอความช่วยเหลือ (ครั้ง)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $strSQL = "SELECT * FROM e4dx_service_center a INNER JOIN e4dx_changwat b ON a.center_province = b.Changwat
                                      WHERE 1";
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                              $c = 1;
                              foreach ($res['data'] as $row) {
                                ?>
                                <tr id="tbrow_<?php echo $c;?>" >
                                  <td>
                                    <div class="row">
                                      <div class="col-10">
                                        <span><a href="" style="padding-left: 0px;"><?php echo $row['center_name']; ?></a></span>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <?php 
                                    $strSQL = "SELECT COUNT(uid) cn FROM e4dx_user a LEFT JOIN e4dx_service_center b ON a.info_health_center_id = b.center_id
                                                WHERE 
                                                (role_inno_admin = 'Y' 
                                                OR role_inno_staff = 'Y' OR role_inno_volun = 'Y' OR role_inno_common = 'Y')
                                                AND a.allow_access = 'Y' 
                                                AND a.delete_status = 'N'
                                                AND a.info_health_center_id = '".$row['center_id']."'";
                                    $res = $db->fetch($strSQL, false, false);
                                    if($res){
                                      echo number_format($res['cn']);
                                    }else{
                                      echo "0";
                                    }
                                    ?>
                                  </td>
                                  <td>
                                    <?php 
                                    $c = 0;
                                    $csum = 0;
                                    foreach ($form_arr as $item) {
                                      $strSQL = "SELECT COUNT(1) CN FROM $item WHERE ".$form_prefix[$c]."_datetime BETWEEN '$start_date' AND '$end_date' AND ".$form_prefix[$c]."_uid IN (SELECT uid FROM e4dx_user WHERE info_health_center_id = '".$row['center_id']."')";
                                      $res = $db->fetch($strSQL, false, false);
                                      if($res){
                                        $csum += $res['CN'];
                                      }
                                      $c++;
                                    };
                                    echo number_format($csum, 0, '.', ',');
                                    ?>
                                  </td>
                                  <td>
                                  <?php 
                                    $strSQL = "SELECT COUNT(scr_id) CN FROM e4dx_service_center_request WHERE scr_datetime BETWEEN '$start_date' AND '$end_date' AND scr_center_id = '".$row['center_id']."'";
                                    $res = $db->fetch($strSQL, false, false);
                                    if($res){
                                      echo number_format($res['CN'], 0, '.', ',');
                                    }else{
                                      echo "0";
                                    }
                                    
                                    ?>
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
    <script src="../../../../../assets/vendor/preload.js/dist/js/preload.js"></script>
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

    <script src="../../../../../../../assets/js/core.js?v=<?php echo filemtime('../../../../../../../assets/js/core.js'); ?>"></script>

    <script>
      $(document).ready(function(){
        preload.hide()
        if($('#table-1').length){
          $('#table-1').dataTable({})
        }
      })

      function toggleNotification(target_uid){
        var param = {
          uid: $('#txtUid').val(),
          target_uid: target_uid
        }

        preload.show()

        console.log(param);

        var jxr = $.post(api + 'admin?stage=toggle_notification', param, function(){}, 'json')
                   .always(function(snap){
                      preload.hide()
                      if(snap.status != 'Success'){
                        console.log(snap);
                        alert('Error')
                      }
                   })
      }

      function deleteUser(target_uid, row_id){
        console.log(row_id);
        Swal.fire({
            title: 'คำเตือน',
            text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            confirmButtonClass: 'btn btn-danger mr-1',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: true,
        }).then(function (result) {
            if (result.value) {
              var param = {
                uid: $('#txtUid').val(),
                target_uid: target_uid
              }

              preload.show()
              console.log(param);

              var jxr = $.post(api + 'admin?stage=delete_user', param, function(){}, 'json')
                        .always(function(snap){
                            preload.hide()
                            console.log(snap);
                            if(snap.status != 'Success'){
                              alert('Error')
                            }else{
                              $('#tbrow_' + row_id).addClass('dn')
                            }
                        })
            }
        })
      }
    </script>
  </body>
</html>

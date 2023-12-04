<?php 
require('../../config/config_database.php');
require('../../config/inc_config_general.php');
require('../../config/inc_database.php'); 

if(
    (!isset($_REQUEST['rid'])) || 
    (!isset($_REQUEST['session_id'])) || 
    (!isset($_REQUEST['record_id']))
  ){
    $return['status'] = 'Fail';  $return['error_message'] = 'ไม่พบข้อมูล';
    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
}

$rid = mysqli_real_escape_string($conn, $_REQUEST['rid']);
$session_id = mysqli_real_escape_string($conn, $_REQUEST['session_id']);
$record_id = mysqli_real_escape_string($conn, $_REQUEST['record_id']);

$strSQL = "SELECT * FROM rsf6x_form_p1 WHERE p1_code = '$rid' AND p1_id = '$record_id'";
$resData = $db->fetch($strSQL, false, false);
if(!$resData){
    $return['status'] = 'Fail';  $return['error_message'] = 'ไม่พบข้อมูล';
    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
}
?>

<input type="hidden" id="txtUid" value="<?php echo $rid; ?>">
<input type="hidden" id="txtSid" value="<?php echo $session_id; ?>">
<input type="hidden" id="txtRid" value="<?php echo $record_id; ?>">
<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
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

    <title><?php  echo FIX_TITLE_TH; ?></title>

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
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="../../assets/vendor/preload.js/dist/css/preload.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/vendor/libs/nouislider/nouislider.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <link rel="stylesheet" href="../../assets/custom/css/style.css?v=<?php echo $date; ?>" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="bg" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; bottom: 0px; right: 0px; background-image: url('../../upload/SL_060521_43530_17.jpg');background-size:     cover; 
    background-repeat:   no-repeat;
    background-position: center center; z-index: 1;"></div>

    <div class="p-2" style="position: relative; z-index: 2;">
      <div class="row m-0">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-icon" onclick="window.location = './'" type="button" style="margin-top: 15px;"><i class="bx bx-home text-white" style="font-size: 2em;"></i></button>
                </div>
                <div class="col" style="padding-left: 0px;"><h2 class="text-white mb-3 mt-4">Covv-EPI</h2></div>
            </div>
            <h3 class="text-white">ภาพรวมการบันทึกข้อมูล ID : <?php echo $rid; ?></h3>
            
            <div class="row">
                <div class="col-6 col-sm-4">
                    <div class="card mb-4">
                        <div class="card-body" onclick="window.location='form-1?rid=<?php echo $rid; ?>&session_id=<?php echo $session_id; ?>&record_id=<?php echo $record_id; ?>'">
                            <div class="text-center">
                                <?php 
                                $strSQL = "SELECT ff_f1 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f1'] == 'Y')){
                                    ?>
                                    <i class='bx bxs-check-circle text-success' style="font-size: 3em;"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="bx bx-x" style="font-size: 3em;"></i>
                                    <?php
                                }
                                ?>
                                <h4 class="text-dark mb-0 mt-2">ตอนที่ 1</h4>
                                <h6 class="text-dark mb-0">ข้อมูลพื้นฐาน<br>ของผู้ตอบแบบ<br>สอบถาม</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4">
                    <div class="card mb-4">
                        <div class="card-body" onclick="window.location='form-2?rid=<?php echo $rid; ?>&session_id=<?php echo $session_id; ?>&record_id=<?php echo $record_id; ?>'">
                            <div class="text-center">
                            <?php 
                                $strSQL = "SELECT ff_f2 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f2'] == 'Y')){
                                    ?>
                                    <i class='bx bxs-check-circle text-success' style="font-size: 3em;"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="bx bx-x" style="font-size: 3em;"></i>
                                    <?php
                                }
                                ?>
                                <h4 class="text-dark mb-0 mt-2">ตอนที่ 2</h4>
                                <h6 class="text-dark mb-0">ความคิดเห็น<br>ต่อการฉีดวัคซีน<br>ป้องกัน COVID-19</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4">
                    <div class="card mb-4">
                        <div class="card-body" onclick="notOpenNow()">
                            <div class="text-center">
                            <?php 
                                $strSQL = "SELECT ff_f3 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f3'] == 'Y')){
                                    ?>
                                    <i class='bx bxs-check-circle text-success' style="font-size: 3em;"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="bx bx-x" style="font-size: 3em;"></i>
                                    <?php
                                }
                                ?>
                                <h4 class="text-dark mb-0 mt-2">ตอนที่ 3</h4>
                                <h6 class="text-dark mb-0">จัดลำดับ<br>ความสำคัญ<br>กิจกรรม</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4">
                    <div class="card mb-4">
                        <div class="card-body" onclick="notOpenNow()">
                            <div class="text-center">
                            <?php 
                                $strSQL = "SELECT ff_f4 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f4'] == 'Y')){
                                    ?>
                                    <i class='bx bxs-check-circle text-success' style="font-size: 3em;"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="bx bx-x" style="font-size: 3em;"></i>
                                    <?php
                                }
                                ?>
                                <h4 class="text-dark mb-0 mt-2">ตอนที่ 4</h4>
                                <h6 class="text-dark mb-0">ประเมินกิจกรรม<br>เพื่อเพิ่มการยิมรับ<br>วัคซีน</h6>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

           

        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../assets/vendor/preload.js/dist/js/preload.js"></script>
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/nouislider/nouislider.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/authen.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/form.js?v=<?php echo $dateu; ?>"></script>
    <script>
      $(document).ready(function(){
        preload.hide()
      })

      function notOpenNow(){
        Swal.fire({
            icon: "error",
            title: 'ขออภัย',
            text: 'ส่วนนี้ยังไม่เปิดให้ดำเนินการ',
            confirmButtonClass: 'btn btn-danger',
        })
      }
    </script>
  </body>
</html>

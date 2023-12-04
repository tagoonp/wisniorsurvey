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

    <div class="" style="position: relative; z-index: 2;">
      <div class="row m-0">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-icon" onclick="window.location = './'" type="button" style="margin-top: 15px;"><i class="bx bx-home text-white" style="font-size: 2em;"></i></button>
                </div>
                <div class="col" style="padding-left: 0px;"><h2 class="text-white mb-3 mt-4">Covv-EPI</h2></div>
            </div>
            <h5 class="text-white">ตอนที่ 1 : ข้อมูลพื้นฐาน</h5>
            <?php 
            $strSQL = "SELECT * FROM rsf6x_form_finish WHERE ff_code = '$rid' AND ff_f1 = 'Y'";
            $res = $db->fetch($strSQL, false, false);
            if($res){
                ?>
                <div class="row">
                    <div class="col-12 mb-3">
                        <button class="btn btn-primary">ตอนที่ 1</button>
                        <button class="btn btn-secondary" onclick="window.location='form-2?rid=<?php echo $rid; ?>&session_id=<?php echo $session_id; ?>&record_id=<?php echo $record_id; ?>'">ตอนที่ 2</button>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.1 ท่านอาศัยอยู่ จังหวัด/อำเภอ ใดในพื้นที่ 3 จังหวัดชายแดนใต้ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ1" class="form-check-input" type="radio" value="na" id="txtQ1_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ1" class="form-check-input" type="radio" value="1" id="txtQ1_1" <?php if($resData){ if($resData['p1_area'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ1_1">
                                จังหวัดปัตตานี 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ1" class="form-check-input" type="radio"  value="2"  id="txtQ1_2" <?php if($resData){ if($resData['p1_area'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ1_2">
                                จังหวัดยะลา 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ1" class="form-check-input" type="radio"  value="3"  id="txtQ1_3" <?php if($resData){ if($resData['p1_area'] == '3'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ1_3">
                                จังหวัดนราธิวาส 
                                </label>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <label for="" >ตำบลที่ท่านอาศัย : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtTambon" name="txtTambon" value="<?php if($resData){ if($resData['pt_tambon'] != null){ echo $resData['pt_tambon']; }} ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.2 เพศ :  <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ2" class="form-check-input" type="radio" value="na" id="txtQ2_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio" value="1" id="txtQ2_1"  <?php if($resData){ if($resData['p1_gender'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ2_1">
                                ชาย 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio"  value="2"  id="txtQ2_2"  <?php if($resData){ if($resData['p1_gender'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ2_2">
                                หญิง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio"  value="3"  id="txtQ2_3"  <?php if($resData){ if($resData['p1_gender'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ2_3">
                                เพศทางเลือก 
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.3 อายุ (ปี) : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-12 pt-2">
                            <input type="number" class="form-control" id="txtAge" name="txtAge" placeholder="กรอกเฉพาะตัวเลข" value="<?php if($resData){ if($resData['p1_age'] != null){ echo $resData['p1_age']; }} ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.4 นับถือศาสนาใด : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ4" class="form-check-input" type="radio" value="na" id="txtQ4_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ4" class="form-check-input" type="radio" value="1" id="txtQ4_1"  <?php if($resData){ if($resData['p1_rel'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ4_1">
                                พุทธ 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ4" class="form-check-input" type="radio"  value="2"  id="txtQ4_2"  <?php if($resData){ if($resData['p1_rel'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ4_2">
                                อิสลาม 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ4" class="form-check-input" type="radio"  value="3"  id="txtQ4_3"  <?php if($resData){ if($resData['p1_rel'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ4_3">
                                คริสต์ 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ4" class="form-check-input" type="radio"  value="4"  id="txtQ4_4"  <?php if($resData){ if($resData['p1_rel'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ4_4">
                                อื่น ๆ 
                                </label>
                            </div>
                        </div>
                        <div class="col-12 pt-2 <?php if($resData){ if($resData['p1_rel'] == '4'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q4hidden">
                            <label for="">หากเลือกอื่น ๆ กรุณาระบุ : </label>
                            <input type="text" class="form-control" id="txtOtherRel" name="txtOtherRel" value="<?php if($resData){  if($resData['p1_rel'] == '4'){ echo $resData['p1_rel_other']; } } ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.5 ระดับการศึกษาสูงสุด : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ5" class="form-check-input" type="radio" value="na" id="txtQ1_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio" value="1" id="txtQ5_1"  <?php if($resData){ if($resData['p1_edu'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ5_1">
                                ไม่ได้เรียนหนังสือ 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="2"  id="txtQ5_2"  <?php if($resData){ if($resData['p1_edu'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_2">
                                ระดับประถมศึกษา ป.4/ป.6 /ป.7 หรือเทียบเท่า 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="3"  id="txtQ5_3"  <?php if($resData){ if($resData['p1_edu'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_3">
                                ระดับมัธยมต้นหรือเทียบเท่า 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="4"  id="txtQ5_4"  <?php if($resData){ if($resData['p1_edu'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_4">
                                ระดับมัธยมปลายหรือเทียบเท่า
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="5"  id="txtQ5_5"  <?php if($resData){ if($resData['p1_edu'] == '5'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_5">
                                ระดับสายอาชีพ ปวช. ปวส.  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="6"  id="txtQ5_6"  <?php if($resData){ if($resData['p1_edu'] == '6'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_6">
                                ระดับปริญญาตรี
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ5" class="form-check-input" type="radio"  value="7"  id="txtQ5_7"  <?php if($resData){ if($resData['p1_edu'] == '7'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ5_7">
                                ระดับสูงกว่าปริญญาตรี
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.6 ท่านเป็นบุคลากรทางด้านสุขภาพหรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ6" class="form-check-input" type="radio" value="na" id="txtQ6_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio" value="1" id="txtQ6_1"  <?php if($resData){ if($resData['p1_healthstaff'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ6_1">
                                ไม่ใช่  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="2"  id="txtQ6_2"  <?php if($resData){ if($resData['p1_healthstaff'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_2">
                                แพทย์     
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="3"  id="txtQ6_3"  <?php if($resData){ if($resData['p1_healthstaff'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_3">
                                พยาบาล   
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="4"  id="txtQ6_4"  <?php if($resData){ if($resData['p1_healthstaff'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_4">
                                ทันตแพทย์
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="5"  id="txtQ6_5"  <?php if($resData){ if($resData['p1_healthstaff'] == '5'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_5">
                                เภสัชกร  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="6"  id="txtQ6_6"  <?php if($resData){ if($resData['p1_healthstaff'] == '6'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_6">
                                ผู้ช่วยพยาบาล
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="7"  id="txtQ6_7"  <?php if($resData){ if($resData['p1_healthstaff'] == '7'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_7">
                                นักเทคนิคการแพทย์
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="8"  id="txtQ6_8"  <?php if($resData){ if($resData['p1_healthstaff'] == '8'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_8">
                                นักรังสีเทคนิค
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="9"  id="txtQ6_9"  <?php if($resData){ if($resData['p1_healthstaff'] == '9'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_9">
                                จนท.สาธารณสุข
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="10"  id="txtQ6_10"  <?php if($resData){ if($resData['p1_healthstaff'] == '10'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ6_10">
                                อสม.
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.7 ลักษณะงานที่ท่านทำ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ7" class="form-check-input" type="radio" value="na" id="txtQ7_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio" value="1" id="txtQ7_1"  <?php if($resData){ if($resData['p1_job'] == '1'){ echo "checked"; }} ?>  />
                                <label class="form-check-label" for="txtQ7_1">
                                ข้าราชการ / พนักงาน,ลูกจ้างของรัฐ / พนักงานรัฐวิสาหกิจ 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="2"  id="txtQ7_2"  <?php if($resData){ if($resData['p1_job'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_2">
                                พนักงานบริษัทเอกชน 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="3"  id="txtQ7_3"  <?php if($resData){ if($resData['p1_job'] == '3'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_3">
                                ค้าขายรายย่อย / บริการรายย่อย   
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="4"  id="txtQ7_4"  <?php if($resData){ if($resData['p1_job'] == '4'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_4">
                                ธุรกิจส่วนตัว / ผู้ประกอบการ
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="5"  id="txtQ7_5"  <?php if($resData){ if($resData['p1_job'] == '5'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_5">
                                ผู้ใช้แรงงาน / รับจ้างทั่วไป  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="6"  id="txtQ7_6"  <?php if($resData){ if($resData['p1_job'] == '6'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_6">
                                เกษียณอายุ / พ่อบ้าน / แม่บ้าน  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="7"  id="txtQ7_7"  <?php if($resData){ if($resData['p1_job'] == '7'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_7">
                                เกษตรกร / ประมง
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="8"  id="txtQ7_8"  <?php if($resData){ if($resData['p1_job'] == '8'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_8">
                                อาชีพอิสระ อาทิ ทนายความ สถาปนิก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="9"  id="txtQ7_9"  <?php if($resData){ if($resData['p1_job'] == '9'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_9">
                                ว่างงาน / ไม่มีงานทำ / ตกงาน
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="10"  id="txtQ7_10"  <?php if($resData){ if($resData['p1_job'] == '10'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_10">
                                นักเรียน / นักศึกษา
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="11"  id="txtQ7_11"  <?php if($resData){ if($resData['p1_job'] == '11'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_11">
                                อื่น ๆ 
                                </label>
                            </div>
                        </div>
                        <div class="col-12 pt-2 <?php if($resData){ if($resData['p1_job'] == '11'){ }else{ echo "dn"; }} else { echo "dn"; }?>"  id="q7hidden">
                            <label for="">หากเลือกอื่น ๆ กรุณาระบุ : </label>
                            <input type="text" class="form-control" id="txtQ7Other" name="txtQ7Other" value="<?php if($resData){  if($resData['p1_job'] == '11'){ echo $resData['p1_job_other']; } } ?>" >
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.8 ท่านมีลักษณะหรือโรคตรงกับกลุ่ม608 ดังต่อนี้หรือไม่ (เลือกตอบได้หลายข้อตามความเป็นจริง) : </label>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox1" <?php if($resData){ if($resData['p1_608_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox1"> อายุ 60 ปีขึ้นไป</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox2"  <?php if($resData){ if($resData['p1_608_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox2"> โรคทางเดินหายใจเรื้อรัง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3"  <?php if($resData){ if($resData['p1_608_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox3"> โรคหัวใจและหลอดเลือด</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4"  <?php if($resData){ if($resData['p1_608_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4"> โรคไตวายเรื้อรัง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5" <?php if($resData){ if($resData['p1_608_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox5"> โรคหลอดเลือดสมอง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox6"  <?php if($resData){ if($resData['p1_608_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox6"> โรคอ้วน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox7" <?php if($resData){ if($resData['p1_608_7'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox7"> โรคมะเร็ง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox8"  <?php if($resData){ if($resData['p1_608_8'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox8"> โรคเบาหวาน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9"  <?php if($resData){ if($resData['p1_608_9'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox9"> หญิงตั้งครรภ์</label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.9 ท่านเคยไปรับการตรวจคัดกรองหาการติดเชื้อโควิด-19 ด้วย ชุดตรวจ Antigen test kit (ATK) หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ9" class="form-check-input" type="radio" value="na" id="txtQ9_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ9" class="form-check-input" type="radio" value="1" id="txtQ9_1"  <?php if($resData){ if($resData['p1_screen'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ9_1">
                                ไม่เคย           
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ9" class="form-check-input" type="radio"  value="2"  id="txtQ9_2" <?php if($resData){ if($resData['p1_screen'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ9_2">
                                เคย
                                </label>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <div id="q9hidden" class="<?php if($resData){ if($resData['p1_screen'] == '2'){ }else{ echo "dn"; }} else { echo "dn"; }?>" style="padding: 14px; border: dashed ; border-width: 1px 1px 1px 1px; border-radius: 10px; border-color: #ccc;">
                                <label for="" class="text-dark">
                                1.9.1 กรณีที่ท่านเคยตรวจคัดกรองหาการติดเชื้อโควิด-19 ด้วยชุดตรวจ Antigen test kit ท่านเข้าถึงการตรวจจากช่องทางใด
                                <br>
                                <small>
                                *** หมายเหตุ ชุดตรวจโควิด-19 แบบเร่งด่วน Antigen test kit (แอนติเจน เทสต์ คิท) คือ ชุดตรวจที่ใช้ตรวจหาโปรตีนของเชื้อก่อโรคโควิด-19 
                                </small>
                                </label>
                                <div class="row mt-2 mb-4">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_1" <?php if($resData){ if($resData['p1_screen_1_1'] == '1'){ echo "checked"; }} ?> />
                                            <label class="form-check-label" for="confCheckbox9_1"> ซื้อชุดตรวจมาใช้เอง </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_2" <?php if($resData){ if($resData['p1_screen_1_2'] == '1'){ echo "checked"; }} ?> />
                                            <label class="form-check-label" for="confCheckbox9_2"> ได้รับมาจากหน่วยงานสาธารณสุข </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_3" <?php if($resData){ if($resData['p1_screen_1_3'] == '1'){ echo "checked"; }} ?> />
                                            <label class="form-check-label" for="confCheckbox9_3"> ได้รับมาจากหน่วยงานอื่น ๆ </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- . row  -->

                                <label for="" class="text-dark">
                                1.9.2 กรณีที่ท่านได้รับการตรวจ ท่านตรวจโดยผู้ใด 
                                <br>
                                </label>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_4" <?php if($resData){ if($resData['p1_screen_2_1'] == '1'){ echo "checked"; }} ?>/>
                                            <label class="form-check-label" for="confCheckbox9_4"> ตรวจด้วยตัวเอง </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_5" <?php if($resData){ if($resData['p1_screen_2_2'] == '1'){ echo "checked"; }} ?>/>
                                            <label class="form-check-label" for="confCheckbox9_5"> ตรวจโดยคนในครอบครัว </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_6" <?php if($resData){ if($resData['p1_screen_2_3'] == '1'){ echo "checked"; }} ?>/>
                                            <label class="form-check-label" for="confCheckbox9_6"> ตรวจโดยเพื่อนหรือคนในที่ทำงาน </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_7" <?php if($resData){ if($resData['p1_screen_2_4'] == '1'){ echo "checked"; }} ?>/>
                                            <label class="form-check-label" for="confCheckbox9_7"> ตรวจโดยเจ้าหน้าที่หน่วยงานสาธารณสุข </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- . row  -->

                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.10 ท่านเคยถูกกักตัวเนื่องจากสัมผัสผู้ติดเชื้อโควิด-19 หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ10" class="form-check-input" type="radio" value="na" id="txtQ10_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ10" class="form-check-input" type="radio" value="1" id="txtQ10_1"  <?php if($resData){ if($resData['p1_isolate'] == '1'){ echo "checked"; }} ?>  />
                                <label class="form-check-label" for="txtQ10_1">
                                ไม่เคย           
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ10" class="form-check-input" type="radio"  value="2"  id="txtQ10_2"  <?php if($resData){ if($resData['p1_isolate'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ10_2">
                                เคย
                                </label>
                            </div>
                        </div>

                        <div class="col-12 pt-2">
                            <div id="q10hidden" class="<?php if($resData){ if($resData['p1_isolate'] == '2'){ }else{ echo "dn"; }} else { echo "dn"; }?>" style="padding: 14px; border: dashed ; border-width: 1px 1px 1px 1px; border-radius: 10px; border-color: #ccc;">
                                <label for="" class="text-dark">
                                1.10.1 เมื่อใด
                                </label>
                                <div class="row mt-2 mb-4">
                                    <div class="col-3" style="padding-right: 0px;">
                                        <select name="txtQ10DD" id="txtQ10DD" class="form-control">
                                        <option value="">วันที่</option>
                                        <?php 
                                        for ($i=1; $i <= 31; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($resData){ if($resData['p1_isolate_dd'] == $j){ echo "selected"; }} ?> ><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-3" style="padding-right: 0px;">
                                        <select name="txtQ10MM" id="txtQ10MM" class="form-control">
                                            <option value="">เดือน</option>
                                            <?php 
                                            for ($i=1; $i <= 12; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($resData){ if($resData['p1_isolate_mm'] == $j){ echo "selected"; }} ?>><?php echo $i; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select name="txtQ10YY" id="txtQ10YY" class="form-control">
                                        <option value="">ปี พ.ศ. *</option>
                                        <?php 
                                        for ($i=date('Y'); $i >= (date('Y')-5); $i--) { 
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($resData){ if($resData['p1_isolate_yy'] == $i){ echo "selected"; }} ?>><?php echo $i + 543; ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- . row  -->

                                <label for="" class="text-dark">
                                1.10.2 ความรู้สึกของท่านเมื่อ<u>ถูกกักตัวจากการสัมผัสผู้ติดเชื้อโควิด-19</u> <span class="text-danger">(เลือกตอบ 1-10 คะแนน โดยที่ 1 = ไม่รู้สึกอะไรเลย, 5 = พอรับได้ และ 10 = ทุกข์อย่างมาก) </span>
                                </label>
                                <div class="row mt-2">
                                    <div class="col-12 pb-3">
                                        <div class="my-3" id="slider-pips-1"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="txtQ10Slide" id="txtQ10Slide" value="<?php if($resData){ if($resData['p1_isolate'] == '2'){ if($resData['p1_isolate'] != null){ echo $resData['p1_isolate_score']; }} } ?>">
                                <!-- . row  -->

                            </div>
                        </div>

                    </div>
                    <!-- .row  -->
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">1.11 ท่านเคยได้รับการวินิจฉัยว่ามีการติดเชื้อโควิด-19 หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ11" class="form-check-input" type="radio" value="na" id="txtQ11_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio" value="1" id="txtQ11_1"  <?php if($resData){ if($resData['p1_diag'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ11_1">
                                ไม่เคย           
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio"  value="2"  id="txtQ11_2"  <?php if($resData){ if($resData['p1_diag'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ11_2">
                                เคย
                                </label>
                            </div>
                        </div>

                        <div class="col-12 pt-2">
                            <div id="q11hidden" class="<?php if($resData){ if($resData['p1_diag'] == '2'){ }else{ echo "dn"; }} else { echo "dn"; }?>" style="padding: 14px; border: dashed ; border-width: 1px 1px 1px 1px; border-radius: 10px; border-color: #ccc;">
                                <label for="" class="text-dark">
                                1.11.1 เมื่อใด
                                </label>
                                <div class="row mt-2 mb-4">
                                    <div class="col-3" style="padding-right: 0px;">
                                        <select name="txtQ11DD" id="txtQ11DD" class="form-control">
                                        <option value="">วันที่</option>
                                        <?php 
                                        for ($i=1; $i <= 31; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($resData){ if($resData['p1_diag_dd'] == $j){ echo "selected"; }} ?>><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-3" style="padding-right: 0px;">
                                        <select name="txtQ11MM" id="txtQ11MM" class="form-control">
                                            <option value="">เดือน</option>
                                            <?php 
                                            for ($i=1; $i <= 12; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($resData){ if($resData['p1_diag_mm'] == $j){ echo "selected"; }} ?>><?php echo $i; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select name="txtQ11YY" id="txtQ11YY" class="form-control">
                                        <option value="">ปี พ.ศ. *</option>
                                        <?php 
                                        for ($i=date('Y'); $i >= (date('Y')-5); $i--) { 
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($resData){ if($resData['p1_diag_yy'] == $i){ echo "selected"; }} ?>><?php echo $i + 543; ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- . row  -->

                                <label for="" class="text-dark">
                                1.11.2 ความรู้สึกของท่านเมื่อ<u>ติดเชื้อโควิด-19</u>  <span class="text-danger">(เลือกตอบ 1-10 คะแนน โดยที่ 1 = ไม่รู้สึกอะไรเลย, 5 = พอรับได้ และ 10 = ทุกข์อย่างมาก) </span>
                                </label>
                                <div class="row mt-2">
                                    <div class="col-12 pb-3">
                                        <div class="my-3" id="slider-pips-2"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="txtQ11Slide" id="txtQ11Slide" value="<?php if($resData){ if($resData['p1_diag'] == '2'){ if($resData['p1_diag_score'] != null){ echo $resData['p1_diag_score']; }} } ?>">
                                <!-- . row  -->

                            </div>
                        </div>

                    </div>
                    <!-- .row  -->
                </div>
            </div>

            <div class="row mt-3 mb-4">
                <div class="d-grid gap-2 col-lg-12 mx-auto">
                    <button class="btn btn-danger btn-lg" type="button" onclick="form_par.save_part_1()" 
                    <?php 
                                $strSQL = "SELECT ff_f1 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f1'] == 'Y')){
                                    echo "disabled";
                                }
                                ?>
                                >ถัดไป</button>
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

        if($('#txtQ10Slide').val() != ''){
            console.log($('#txtQ10Slide').val());
            sliderPips_1.noUiSlider.set(parseInt($('#txtQ10Slide').val()));
        }

        if($('#txtQ11Slide').val() != ''){
            $('#txtQ11Slide').val()
            sliderPips_2.noUiSlider.set(parseInt($('#txtQ11Slide').val()));
        }
      })

      $(function(){
            $("input[name='txtQ4']").click(function(){
                $data = $("input[name='txtQ4']:checked").val();
                if($data == '4'){
                    $('#q4hidden').removeClass('dn')
                }else{
                    $('#q4hidden').addClass('dn')
                }
            })

            $("input[name='txtQ7']").click(function(){
                $data = $("input[name='txtQ7']:checked").val();
                if($data == '11'){
                    $('#q7hidden').removeClass('dn')
                }else{
                    $('#q7hidden').addClass('dn')
                }
            })

            $("input[name='txtQ9']").click(function(){
                $data = $("input[name='txtQ9']:checked").val();
                if($data == '2'){
                    $('#q9hidden').removeClass('dn')
                }else{
                    $('#q9hidden').addClass('dn')
                }
            })

            $("input[name='txtQ10']").click(function(){
                $data = $("input[name='txtQ10']:checked").val();
                if($data == '2'){
                    $('#q10hidden').removeClass('dn')
                }else{
                    $('#q10hidden').addClass('dn')
                }
            })

            $("input[name='txtQ11']").click(function(){
                $data = $("input[name='txtQ11']:checked").val();
                if($data == '2'){
                    $('#q11hidden').removeClass('dn')
                }else{
                    $('#q11hidden').addClass('dn')
                }
            })
      })
    </script>
  </body>
</html>

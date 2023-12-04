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

$strSQL = "SELECT * FROM  rsf6x_form_p2 WHERE p2_code = '$rid' AND p2_delete = 'N'";
$resData = $db->fetch($strSQL, false, false);

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
            <h5 class="text-white">ตอนที่ 2 : ความคิดเห็นต่อการฉีดวัคซีนป้องกัน COVID-19</h5>

            <div class="row">
                <div class="col-12 mb-3">
                    <button class="btn btn-secondary" onclick="window.location='form-1?rid=<?php echo $rid; ?>&session_id=<?php echo $session_id; ?>&record_id=<?php echo $record_id; ?>'">ตอนที่ 1</button>
                    <button class="btn btn-primary">ตอนที่ 2</button>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <label for="" class="text-dark">2.1 ท่านได้รับการฉีดวัคซีนโควิด-19 หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ1" class="form-check-input" type="radio" value="na" id="txtQ1_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ1" class="form-check-input" type="radio" value="1" id="txtQ1_1" <?php if($resData){ if($resData['p2_q1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ1_1">
                                ฉีดแล้ว
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ1" class="form-check-input" type="radio"  value="2"  id="txtQ1_2" <?php if($resData){ if($resData['p2_q1'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ1_2">
                                ยังไม่ได้ฉีด 
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q2hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.2 ท่านได้รับการฉีดวัคซีนโควิด-19 แล้วกี่เข็ม :  <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ2" class="form-check-input" type="radio" value="na" id="txtQ2_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio" value="1" id="txtQ2_1"  <?php if($resData){ if($resData['p2_q2'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ2_1">
                                1 เข็ม 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio"  value="2"  id="txtQ2_2"  <?php if($resData){ if($resData['p2_q2'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ2_2">
                                2 เข็ม 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio"  value="3"  id="txtQ2_3"  <?php if($resData){ if($resData['p2_q2'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ2_3">
                                3 เข็ม 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ2" class="form-check-input" type="radio"  value="4"  id="txtQ2_4"  <?php if($resData){ if($resData['p2_q2'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ2_4">
                                มากกว่า 3 เข็ม 
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q3hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.3 ท่านได้รับการฉีดวัคซีนโควิด-19 ชนิดใด (ตอบได้มากกว่า 1) : </label>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_1" <?php if($resData){ if($resData['p2_q3_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox3_1">Sinovac (ซิโนแวค)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_2"  <?php if($resData){ if($resData['p2_q3_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox3_2">AstraZeneca (แอสตร้าเซเนก้า) </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_3"  <?php if($resData){ if($resData['p2_q3_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox3_3">Sinopharm (ซิโนฟาร์ม)  </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_4"  <?php if($resData){ if($resData['p2_q3_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox3_4"> Pfizer (ไฟเซอร์) </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_5" <?php if($resData){ if($resData['p2_q3_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox3_5"> mRNA (โมเดอร์นา)  </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox3_6"  <?php if($resData){ if($resData['p2_q3_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox3_6"> ไม่ทราบ </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q4hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.4 ท่านได้รับการฉีดวัคซีนโควิด-19 แล้ว อาการข้างเคียงหลังฉีดวัคซีน  (เลือกได้มากกว่า 1 ข้อ) : </label>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_1" <?php if($resData){ if($resData['p2_q4_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox4_1">ปวด บวม แดง ร้อนบริเวณที่ฉีด</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_2"  <?php if($resData){ if($resData['p2_q4_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_2">มีไข้</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_3"  <?php if($resData){ if($resData['p2_q4_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_3">ปวดศีรษะ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_4"  <?php if($resData){ if($resData['p2_q4_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_4">เหนื่อย อ่อนเพลีย</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_5" <?php if($resData){ if($resData['p2_q4_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox4_5">ปวดเมื่อยเนื้อตัว </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_6"  <?php if($resData){ if($resData['p2_q4_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_6">กล้ามเนื้ออ่อนแรง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_7"  <?php if($resData){ if($resData['p2_q4_7'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_7">ผื่น</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_8"  <?php if($resData){ if($resData['p2_q4_8'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_8">คลื่นไส้</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_9"  <?php if($resData){ if($resData['p2_q4_9'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_9">อาเจียน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_10"  <?php if($resData){ if($resData['p2_q4_10'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_10">ท้องเสีย</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_11"  <?php if($resData){ if($resData['p2_q4_11'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_11">หนาวสั่น </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox4_12"  <?php if($resData){ if($resData['p2_q4_12'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox4_12">ไม่มีอาการดังกล่าวข้างต้น</label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q5hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.5 เหตุผลที่ท่านฉีดวัคซีนโควิด-19 (เลือกได้มากกว่า 1 ข้อ) : </label>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_1" <?php if($resData){ if($resData['p2_q5_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox5_1">ฉันมีความเสี่ยงที่จะติดเชื้อโควิด-19</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_2"  <?php if($resData){ if($resData['p2_q5_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox5_2">เพื่อป้องกันการติดเชื้อโควิด-19</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_3"  <?php if($resData){ if($resData['p2_q5_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox5_3">ฉันอายุมาก 60 ปี มีโอกาส/ความเสี่ยงที่จะติดเชื้อโควิด</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_4"  <?php if($resData){ if($resData['p2_q5_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox5_4">ฉันมีโรคประจำตัวที่เป็นกลุ่มเสี่ยง ได้แก่ โรคทางเดินหายใจเรื้อรัง หัวใจและหลอดเลือด หลอดเลือดสมอง เบาหวาน มะเร็ง โรค ไตเรื้อรัง โรคอ้วน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_5" <?php if($resData){ if($resData['p2_q5_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox5_5">การฉีดวัคซีนโควิด-19 จะช่วยป้องกันการติดเชื้อโควิด-19 ได้ แม้ว่าจะไม่ถึง 100%  </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_6"  <?php if($resData){ if($resData['p2_q5_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox5_6">วัคซีนโควิด-19 จะช่วยลดความรุนแรงของอาการ ถ้าหากติดเชื้อโควิด </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox5_7"  <?php if($resData){ if($resData['p2_q5_7'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox5_7">เราทุกคนต้องฉีดวัคซีนโควิด-19 เพื่อให้ประเทศไทยเกิดภูมิคุ้มกันหมู่ </label>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <label for="" >เหตุผลอื่น ๆ : (ถ้ามี) <?php echo $resData['p2_q5_8_i']; ?></label>
                            <input type="text" class="form-control" id="txtQ5_other" name="txtQ5_other" 
                            value="<?php if($resData){ if($resData['p2_q5_8_i'] != null){ echo $resData['p2_q5_8_i']; }} ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q6hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.6 ท่านจะแนะนำคนอื่นให้ฉีดวัคซีนป้องกันโรคโควิด-19 หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ6" class="form-check-input" type="radio" value="na" id="txtQ6_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio" value="1" id="txtQ6_1"  <?php if($resData){ if($resData['p2_q6'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ6_1">
                                ไม่เคย           
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ6" class="form-check-input" type="radio"  value="2"  id="txtQ6_2" <?php if($resData){ if($resData['p2_q6'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ6_2">
                                เคย
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q7hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.7 ท่านมีความตั้งใจที่จะ<strong><u>ฉีดวัคซีนโควิด-19 เข็มกระตุ้น</u></strong> หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ7" class="form-check-input" type="radio" value="na" id="txtQ7_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio" value="1" id="txtQ7_1"  <?php if($resData){ if($resData['p2_q7'] == '1'){ echo "checked"; }} ?>  />
                                <label class="form-check-label" for="txtQ7_1">
                                ฉีดแน่นอน            
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="2"  id="txtQ7_2"  <?php if($resData){ if($resData['p2_q7'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_2">
                                อาจจะฉีด 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="3"  id="txtQ7_3"  <?php if($resData){ if($resData['p2_q7'] == '3'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_3">
                                อาจจะไม่ฉีด  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ7" class="form-check-input" type="radio"  value="4"  id="txtQ7_4"  <?php if($resData){ if($resData['p2_q7'] == '4'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ7_4">
                                ไม่ฉีดแน่นอน  
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- .row  -->
                </div>
            </div>

            <div class="card mb-2 <?php if($resData){ if($resData['p2_q1'] == '2'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q8hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.8 ท่านมีความตั้งใจที่จะ<strong><u>ฉีดวัคซีนโควิด-19</u></strong> หรือไม่ : <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-sm-12 pt-2">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ8" class="form-check-input" type="radio" value="na" id="txtQ8_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ8" class="form-check-input" type="radio" value="1" id="txtQ8_1"  <?php if($resData){ if($resData['p2_q8'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ8_1">
                                ฉีดแน่นอน            
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ8" class="form-check-input" type="radio"  value="2"  id="txtQ8_2"  <?php if($resData){ if($resData['p2_q8'] == '2'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ8_2">
                                อาจจะฉีด 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ8" class="form-check-input" type="radio"  value="3"  id="txtQ8_3"  <?php if($resData){ if($resData['p2_q8'] == '3'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ8_3">
                                อาจจะไม่ฉีด  
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ8" class="form-check-input" type="radio"  value="4"  id="txtQ8_4"  <?php if($resData){ if($resData['p2_q8'] == '4'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ8_4">
                                ไม่ฉีดแน่นอน  
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- .row  -->
                </div>
            </div>

            <div class="card mb-2  <?php if($resData){ if($resData['p2_q8'] == '1'){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q9hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.9 กรุณาบอกเหตุผลที่ท่านต้องการฉีดวัคซีนโควิด-19 (เลือกได้มากกว่า 1 ข้อ) : <span class="text-danger">*</span></label>
                    <hr>
                    <h6>1) ความเอื้ออำนวยของสภาพแวดล้อม</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_1" <?php if($resData){ if($resData['p2_q9_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox9_1">ไม่มีค่าใช้จ่าย</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_2"  <?php if($resData){ if($resData['p2_q9_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_2">สถานที่ฉีดวัคซีนโควิด-19 สะดวกและใกล้บ้าน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_3"  <?php if($resData){ if($resData['p2_q9_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_3">การนัดหมายฉีดวัคซีนง่าย</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_4"  <?php if($resData){ if($resData['p2_q9_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_4">นายจ้างให้ลางานมาฉีดโดยไม่หักเงิน</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mt-3">2) ผลและความปลอดภัยของวัคซีน</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_5" <?php if($resData){ if($resData['p2_q9_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox9_5">วัคซีนปลอดภัยและมีประสิทธิภาพ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_6"  <?php if($resData){ if($resData['p2_q9_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_6">ระยะเวลาตั้งแต่เริ่มมีการฉีดวัคซีนจนถึงปัจจุบันเพียงพอในการวัดผลของวัคซีน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_7"  <?php if($resData){ if($resData['p2_q9_7'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_7">ผู้เชี่ยวชาญกล่าวว่า ปลอดภัยและมีประสิทธิภาพ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_8"  <?php if($resData){ if($resData['p2_q9_8'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_8">แพทย์และบุคลากรทางการแพทย์แนะนำให้ฉีด</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_9"  <?php if($resData){ if($resData['p2_q9_9'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_9">คนใกล้ชิดแนะนำให้ฉีด</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_10"  <?php if($resData){ if($resData['p2_q9_10'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_10">คนที่รู้จักส่วนใหญ่ฉีดวัคซีน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_11"  <?php if($resData){ if($resData['p2_q9_11'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_11">ผู้นำที่นับถือไว้วางใจฉีดวัคซีน</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mt-3">3) การลดความเสี่ยงในการติดเชื้อ</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_12" <?php if($resData){ if($resData['p2_q9_12'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox9_12">กลัวที่จะติดเชื้อโควิค-19</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_13"  <?php if($resData){ if($resData['p2_q9_13'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_13">เสี่ยงที่จะติดเชื้อโควิด </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_14"  <?php if($resData){ if($resData['p2_q9_14'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_14">อายุ >60 ปี เสี่ยงสูงที่จะติดเชื้อโควิด </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_15"  <?php if($resData){ if($resData['p2_q9_15'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_15">มีโรคประจำตัวเสี่ยงสูงที่จะติดเชื้อโควิด </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_16"  <?php if($resData){ if($resData['p2_q9_16'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_16">วัคซีนช่วยทำให้คนที่รักปลอดภัยจากการติดเชื้อ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_17"  <?php if($resData){ if($resData['p2_q9_17'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_17">ทุกคนต้องฉีดวัคซีนโควิด-19 เพื่อให้ประเทศไทยเกิดภูมิคุ้มกันหมู่ </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">4) วิถีชีวิต</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_18" <?php if($resData){ if($resData['p2_q9_18'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox9_18">ช่วยให้การดำเนินชีวิตประจำวันกลับเป็นปกติ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_19"  <?php if($resData){ if($resData['p2_q9_19'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_19">สามารถไปโรงเรียนหรือที่ทำงานได้</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_20"  <?php if($resData){ if($resData['p2_q9_20'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_20">ธรรมเนียมปฏิบัติทางสังคม</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox9_21"  <?php if($resData){ if($resData['p2_q9_21'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox9_21">นายจ้างต้องการให้ฉีดวัคซีน</label>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            <label for="" >เหตุผลอื่น ๆ : (ถ้ามี)</label>
                            <input type="text" class="form-control" id="txtQ9_other" name="txtQ9_other" value="<?php if($resData){ echo $resData['p2_q9_22']; } ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>
            <!-- . card  -->

            <div class="card mb-2 <?php if($resData){ if(($resData['p2_q8'] == '2') || ($resData['p2_q8'] == '3')  || ($resData['p2_q8'] == '4') || ($resData['p2_q7'] == '2') || ($resData['p2_q7'] == '3') || ($resData['p2_q7'] == '4')){ }else{ echo "dn"; }} else { echo "dn"; }?>" id="q10hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.10 กรุณาบอกเหตุผลที่ท่าน ลังเล หรือ ไม่ต้องการฉีดวัคซีนโควิด-19 (เลือกได้มากกว่า 1 ข้อ) : <span class="text-danger">*</span></label>
                    <hr>
                    <h6>1) ความเอื้ออำนวยของสภาพแวดล้อม</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_1" <?php if($resData){ if($resData['p2_q10_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox10_1">ไม่ทราบว่าจะต้องไปรับวัคซีนที่ไหน และเมื่อไหร่ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_2"  <?php if($resData){ if($resData['p2_q10_2'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_2">ไม่สามารถหาวิธีการในการนัดหมายเพื่อฉีดวัคซีน </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_3"  <?php if($resData){ if($resData['p2_q10_3'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_3">ไม่สามารถรับวัคซีนนอกเวลาทำงานได้ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_4"  <?php if($resData){ if($resData['p2_q10_4'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_4">ไม่ไว้วางใจสถานที่ที่มีการให้บริการฉีดวัคซีน </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_5"  <?php if($resData){ if($resData['p2_q10_5'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_5">กลัวเข็มและการฉีดยา  </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_6"  <?php if($resData){ if($resData['p2_q10_6'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_6">ไม่มั่นใจในระบบการบริหารจัดการวัคซีน  </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mt-3">2) ผลและความปลอดภัยของวัคซีน</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_7" <?php if($resData){ if($resData['p2_q10_7'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox10_7">มีโอกาสเกิดอาการข้างเคียง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_8"  <?php if($resData){ if($resData['p2_q10_8'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_8">ไม่มีหลักฐานเพียงพอในการป้องกันการติดเชื้อโควิค </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_9"  <?php if($resData){ if($resData['p2_q10_9'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_9">ระยะเวลาในการพัฒนาและทดสอบวัคซีนโควิด 19 น้อยเกินไป </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_10"  <?php if($resData){ if($resData['p2_q10_10'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_10">ระยะเวลาตั้งแต่เริ่มมีการฉีดวัคซีนจนถึงปัจจุบันไม่เพียงพอในการวัดผลของวัคซีน </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_11"  <?php if($resData){ if($resData['p2_q10_11'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_11">จำนวนคนที่รับวัคซีนยังน้อยเกินไป </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_12"  <?php if($resData){ if($resData['p2_q10_12'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_12">วัคซีนไม่ปลอดภัยหรือไม่มีประสิทธิภาพ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_13"  <?php if($resData){ if($resData['p2_q10_13'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_13">กังวลเรื่องการเก็บรักษาวัคซีน </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_14"  <?php if($resData){ if($resData['p2_q10_14'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_14">วัคซีนมีองค์ประกอบของเซลล์อาจส่งผลระยะยาวต่อร่างกายมนุษย์ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_15"  <?php if($resData){ if($resData['p2_q10_15'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_15">การทดลองวัคซีนไม่ครอบคลุมเพียงพอ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_16"  <?php if($resData){ if($resData['p2_q10_16'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_16">กังวลเรื่องการเจริญพันธุ์และผลต่อการตั้งครรภ์ </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_17"  <?php if($resData){ if($resData['p2_q10_17'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_17">อายุ >60 ปี เสี่ยงสูงเกิดอาการข้างเคียง </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_18"  <?php if($resData){ if($resData['p2_q10_18'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_18">มีโรคประจำตัวเสี่ยงสูงเกิดอาการข้างเคียง </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mt-3">3) การลดความเสี่ยงในการติดเชื้อ</h6>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_19" <?php if($resData){ if($resData['p2_q10_19'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="confCheckbox10_19">ไม่กลัวที่จะติดเชื้อโควิด-19 </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_20"  <?php if($resData){ if($resData['p2_q10_20'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_20">เคยติดเชื้อโควิด-19 แล้ว </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_21"  <?php if($resData){ if($resData['p2_q10_21'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_21">ความเชื่อ/ข้อกังวลเกี่ยวกับศาสนา </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_22"  <?php if($resData){ if($resData['p2_q10_22'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_22">ต้องการให้ร่างกายสร้างภูมิคุ้นกันโควิด-19 ตามธรรมชาติ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="confCheckbox10_23"  <?php if($resData){ if($resData['p2_q10_23'] == '1'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="confCheckbox10_23">อาการของโควิดไม่น่ากลัวแล้ว </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">4) เหตุผลที่ท่าน ลังเล หรือ ไม่ต้องการฉีดวัคซีนโควิด-19 อื่น ๆ : (ถ้ามี)</h6>
                    <div class="row mt-2">
                        <div class="col-12 pt-0">
                            <input type="text" class="form-control" id="txtQ10_other" name="txtQ10_other" value="<?php if($resData){ echo $resData['p2_q10_24']; } ?>">
                        </div>
                    </div>
                    <!-- . row  -->
                </div>
            </div>
            <!-- .card  -->

            <div class="card mb-2" id="q11hidden">
                <div class="card-body">
                    <label for="" class="text-dark">2.<span id="num11">11</span> คำถามเพื่อประเมินระดับการรับรู้ความรุนแรงของโควิด-19 : <span class="text-danger">*</span></label>
                    <hr>
                    <h6>1) ท่านรู้สึกกังวลว่าตัวท่านหรือคนในครอบครัวจะติดเชื้อไวรัสโคโรน่า</h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ11" class="form-check-input" type="radio" value="na" id="txtQ11_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio" value="1" id="txtQ11_1"  <?php if($resData){ if($resData['p2_q11_1'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ11_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio"  value="2"  id="txtQ11_2"  <?php if($resData){ if($resData['p2_q11_1'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ11_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio"  value="3"  id="txtQ11_3"  <?php if($resData){ if($resData['p2_q11_1'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ11_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ11" class="form-check-input" type="radio"  value="4"  id="txtQ11_4"  <?php if($resData){ if($resData['p2_q11_1'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ11_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">2) ระหว่างที่โควิด-19 ระบาด บางครั้งท่านก็คิดว่า “บนของชิ้นนี้หรือบนพื้นผิวนี้จะมีเชื้อโควิดไหม” </h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ12" class="form-check-input" type="radio" value="na" id="txtQ12_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ12" class="form-check-input" type="radio" value="1" id="txtQ12_1"  <?php if($resData){ if($resData['p2_q11_2'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ12_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ12" class="form-check-input" type="radio"  value="2"  id="txtQ12_2"  <?php if($resData){ if($resData['p2_q11_2'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ12_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ12" class="form-check-input" type="radio"  value="3"  id="txtQ12_3"  <?php if($resData){ if($resData['p2_q11_2'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ12_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ12" class="form-check-input" type="radio"  value="4"  id="txtQ12_4"  <?php if($resData){ if($resData['p2_q11_2'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ12_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">3) ท่านเชื่อว่าจะต้องมีการระบาดระลอกใหม่เกิดขึ้น </h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ13" class="form-check-input" type="radio" value="na" id="txtQ13_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ13" class="form-check-input" type="radio" value="1" id="txtQ13_1"  <?php if($resData){ if($resData['p2_q11_3'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ13_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ13" class="form-check-input" type="radio"  value="2"  id="txtQ13_2"  <?php if($resData){ if($resData['p2_q11_3'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ13_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ13" class="form-check-input" type="radio"  value="3"  id="txtQ13_3"  <?php if($resData){ if($resData['p2_q11_3'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txt13_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ13" class="form-check-input" type="radio"  value="4"  id="txtQ13_4"  <?php if($resData){ if($resData['p2_q11_3'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ13_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">4) เหตุการณ์รอบตัวทำให้ท่านระลึกอยู่เสมอว่าการระบาดนั้นอยู่ไม่ไกล </h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ14" class="form-check-input" type="radio" value="na" id="txtQ14_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ14" class="form-check-input" type="radio" value="1" id="txtQ14_1"  <?php if($resData){ if($resData['p2_q11_4'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ14_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ14" class="form-check-input" type="radio"  value="2"  id="txtQ14_2"  <?php if($resData){ if($resData['p2_q11_4'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ14_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ14" class="form-check-input" type="radio"  value="3"  id="txtQ14_3"  <?php if($resData){ if($resData['p2_q11_4'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ14_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ14" class="form-check-input" type="radio"  value="4"  id="txtQ14_4"  <?php if($resData){ if($resData['p2_q11_4'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ14_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->
                    <hr>
                    <h6 class="mt-3">5) ท่านมักจะสงสัยว่าคนรอบข้างอาจจะติดเชื้อไวรัสโคโรน่า </h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ15" class="form-check-input" type="radio" value="na" id="txtQ15_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ15" class="form-check-input" type="radio" value="1" id="txtQ15_1"  <?php if($resData){ if($resData['p2_q11_5'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ15_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ15" class="form-check-input" type="radio"  value="2"  id="txtQ15_2"  <?php if($resData){ if($resData['p2_q11_5'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ15_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ15" class="form-check-input" type="radio"  value="3"  id="txtQ15_3"  <?php if($resData){ if($resData['p2_q11_5'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ15_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ15" class="form-check-input" type="radio"  value="4"  id="txtQ15_4"  <?php if($resData){ if($resData['p2_q11_5'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ15_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->

                    <hr>
                    <h6 class="mt-3">6) ท่านจะหลีกเลี่ยงการสัมผัสกับผู้อื่น เพราะเชื่อว่าการสัมผัสเพิ่มความเสี่ยงต่อการติดเชื้อ</h6>
                    <div class="row">
                        <div class="col-sm-12 pt-0">
                            <div class="form-check mb-0" style="display: none;">
                                <input name="txtQ16" class="form-check-input" type="radio" value="na" id="txtQ16_0" checked />
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ16" class="form-check-input" type="radio" value="1" id="txtQ16_1"  <?php if($resData){ if($resData['p2_q11_6'] == '1'){ echo "checked"; }} ?> />
                                <label class="form-check-label" for="txtQ16_1">
                                เป็นความจริงอย่างมาก
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ16" class="form-check-input" type="radio"  value="2"  id="txtQ16_2"  <?php if($resData){ if($resData['p2_q11_6'] == '2'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ16_2">
                                เป็นความจริง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ16" class="form-check-input" type="radio"  value="3"  id="txtQ16_3"  <?php if($resData){ if($resData['p2_q11_6'] == '3'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ16_3">
                                ก็มีบ้าง 
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input name="txtQ16" class="form-check-input" type="radio"  value="4"  id="txtQ16_4"  <?php if($resData){ if($resData['p2_q11_6'] == '4'){ echo "checked"; }} ?>/>
                                <label class="form-check-label" for="txtQ16_4">
                                ไม่เป็นความจริง
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- . row  -->

                </div>
            </div>
            <!-- .card  -->


            <div class="row mt-3 mb-4">
                <div class="d-grid gap-2 col-lg-12 mx-auto">
                    <button class="btn btn-danger btn-lg" type="button" <?php 
                                $strSQL = "SELECT ff_f2 FROM rsf6x_form_finish WHERE ff_code = '$rid'";
                                $res = $db->fetch($strSQL, false, false);
                                if(($res) && ($res['ff_f2'] == 'Y')){
                                    echo "disabled";
                                }
                                ?> onclick="form_par.save_part_2()">ถัดไป</button>
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

      $(function(){
            // Form 2
            $("input[name='txtQ1']").click(function(){
                $data = $("input[name='txtQ1']:checked").val();
                $('#q11hidden').removeClass('dn')
                if($data == '2'){
                    $('#q1hidden').addClass('dn')
                    $('#q2hidden').addClass('dn')
                    $('#q3hidden').addClass('dn')
                    $('#q4hidden').addClass('dn')
                    $('#q5hidden').addClass('dn')
                    $('#q6hidden').addClass('dn')
                    $('#q7hidden').addClass('dn')
                    $('#q8hidden').removeClass('dn')
                    $('#q9hidden').addClass('dn')

                    $('input:radio[name="txtQ2"][value="na"]').prop('checked',true);
                    $('input:radio[name="txtQ3"][value="na"]').prop('checked',true);
                    $('input:radio[name="txtQ6"][value="na"]').prop('checked',true);
                    $('input:radio[name="txtQ7"][value="na"]').prop('checked',true);
                    $('#confCheckbox3_1').prop('checked', '');
                    $('#confCheckbox3_2').prop('checked', '');
                    $('#confCheckbox3_3').prop('checked', '');
                    $('#confCheckbox3_4').prop('checked', '');
                    $('#confCheckbox3_5').prop('checked', '');
                    $('#confCheckbox3_6').prop('checked', '');

                    $('#confCheckbox4_1').prop('checked', '');
                    $('#confCheckbox4_2').prop('checked', '');
                    $('#confCheckbox4_3').prop('checked', '');
                    $('#confCheckbox4_4').prop('checked', '');
                    $('#confCheckbox4_5').prop('checked', '');
                    $('#confCheckbox4_6').prop('checked', '');
                    $('#confCheckbox4_7').prop('checked', '');
                    $('#confCheckbox4_8').prop('checked', '');
                    $('#confCheckbox4_9').prop('checked', '');
                    $('#confCheckbox4_10').prop('checked', '');
                    $('#confCheckbox4_11').prop('checked', '');
                    $('#confCheckbox4_12').prop('checked', '');

                    $('#confCheckbox5_1').prop('checked', '');
                    $('#confCheckbox5_2').prop('checked', '');
                    $('#confCheckbox5_3').prop('checked', '');
                    $('#confCheckbox5_4').prop('checked', '');
                    $('#confCheckbox5_5').prop('checked', '');
                    $('#confCheckbox5_6').prop('checked', '');
                    $('#confCheckbox5_7').prop('checked', '');
                    $('#txtQ5_other').val('')

                }else{
                    $('#q1hidden').removeClass('dn')
                    $('#q2hidden').removeClass('dn')
                    $('#q3hidden').removeClass('dn')
                    $('#q4hidden').removeClass('dn')
                    $('#q5hidden').removeClass('dn')
                    $('#q6hidden').removeClass('dn')
                    $('#q7hidden').removeClass('dn')
                    $('#q8hidden').addClass('dn')
                    $('#q9hidden').addClass('dn')
                    $('#q10hidden').addClass('dn')

                    $('input:radio[name="txtQ8"][value="na"]').prop('checked',true);
                    $('#confCheckbox9_1').prop('checked', '');
                    $('#confCheckbox9_2').prop('checked', '');
                    $('#confCheckbox9_3').prop('checked', '');
                    $('#confCheckbox9_4').prop('checked', '');
                    $('#confCheckbox9_5').prop('checked', '');
                    $('#confCheckbox9_6').prop('checked', '');
                    $('#confCheckbox9_7').prop('checked', '');
                    $('#confCheckbox9_8').prop('checked', '');
                    $('#confCheckbox9_9').prop('checked', '');
                    $('#confCheckbox9_10').prop('checked', '');
                    $('#confCheckbox9_11').prop('checked', '');
                    $('#confCheckbox9_12').prop('checked', '');
                    $('#confCheckbox9_13').prop('checked', '');
                    $('#confCheckbox9_14').prop('checked', '');
                    $('#confCheckbox9_15').prop('checked', '');
                    $('#confCheckbox9_16').prop('checked', '');
                    $('#confCheckbox9_17').prop('checked', '');
                    $('#confCheckbox9_18').prop('checked', '');
                    $('#confCheckbox9_19').prop('checked', '');
                    $('#confCheckbox9_20').prop('checked', '');
                    $('#confCheckbox9_21').prop('checked', '');
                    $('#txtQ9_other').val('')

                    $('#confCheckbox10_1').prop('checked', '');
                    $('#confCheckbox10_2').prop('checked', '');
                    $('#confCheckbox10_3').prop('checked', '');
                    $('#confCheckbox10_4').prop('checked', '');
                    $('#confCheckbox10_5').prop('checked', '');
                    $('#confCheckbox10_6').prop('checked', '');
                    $('#confCheckbox10_7').prop('checked', '');
                    $('#confCheckbox10_8').prop('checked', '');
                    $('#confCheckbox10_9').prop('checked', '');
                    $('#confCheckbox10_10').prop('checked', '');
                    $('#confCheckbox10_11').prop('checked', '');
                    $('#confCheckbox10_12').prop('checked', '');
                    $('#confCheckbox10_13').prop('checked', '');
                    $('#confCheckbox10_14').prop('checked', '');
                    $('#confCheckbox10_15').prop('checked', '');
                    $('#confCheckbox10_16').prop('checked', '');
                    $('#confCheckbox10_17').prop('checked', '');
                    $('#confCheckbox10_18').prop('checked', '');
                    $('#confCheckbox10_19').prop('checked', '');
                    $('#confCheckbox10_20').prop('checked', '');
                    $('#confCheckbox10_21').prop('checked', '');
                    $('#confCheckbox10_22').prop('checked', '');
                    $('#confCheckbox10_23').prop('checked', '');
                    $('#txtQ10_other').val('')
                }
            })

            $("input[name='txtQ7']").click(function(){
                $data = $("input[name='txtQ7']:checked").val();
                if($data == '1'){
                    $('#q9hidden').removeClass('dn')
                    $('#q10hidden').addClass('dn')
                }else{
                    $('#q9hidden').addClass('dn')
                    $('#q10hidden').removeClass('dn')
                }
            })

            $("input[name='txtQ8']").click(function(){
                $data = $("input[name='txtQ8']:checked").val();
                if($data == '1'){
                    $('#q9hidden').removeClass('dn')
                    $('#q10hidden').addClass('dn')
                }else{
                    $('#q9hidden').addClass('dn')
                    $('#q10hidden').removeClass('dn')
                }
            })

            
        })

    </script>
  </body>
</html>

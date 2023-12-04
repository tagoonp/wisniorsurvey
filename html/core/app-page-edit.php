<?php 
require('../../../config/config_database.php');
require('../../../config/inc_config_general.php');
require('../../../config/inc_database.php'); 
require('../../../config/inc_function.php');
require('../../../config/inc_user.php');
$page_name = basename(__FILE__) ;

if(!isset($_REQUEST['id'])){
  $db->close($conn);
  header('Location: app-page-list');
  die();
}

$content_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
$strSQL = "SELECT * FROM ecw_content WHERE con_id = '$content_id'";
$resContent = $db->fetch($strSQL, false, false);
if($resContent){
}else{
  $db->close($conn);
  header('Location: app-page-list');
  die();
}
?>

<input type="hidden" name="txtUid" id="txtUid" value="<?php echo $currentUser['uid']; ?>">
<input type="hidden" name="txtContentId" id="txtContentId" value="<?php echo $content_id; ?>">

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

    <title><?php echo SHORT_TITLE; ?> แก้ไขบทความ</title>

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
    <link rel="stylesheet" href="../../assets/vendor/preload.js/dist/css/preload.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/quill/editor.css" />

    <link href="../../assets/custom/css/style.css?v=<?php echo filemtime('../../assets/custom/css/style.css'); ?>" rel="stylesheet">
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
                    <h3>แก้ไขเพจ</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="javascript:void(0);">การจัดการ</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="app-page-list">เพจ</a>
                        </li>
                        <li class="breadcrumb-item active">แก้ไขเพจ</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-12">
                            <label for="">ชื่อเพจ / หัวข้อ : <span class="text-danger">*</span></label>
                            <input type="text" name="txtTitle" id="txtTitle" class="form-control" value="<?php echo $resContent['con_title']; ?>">
                          </div>
                          <div class="form-group col-12 col-sm-6">
                            <label for="">หมวดหมู่ : <span class="text-danger">*</span></label>
                            <select name="txtCategory" id="txtCategory" class="form-control">
                              <option value="">-- เลือก --</option>
                              <?php 
                              $strSQL = "SELECT * FROM ecw_category WHERE cat_status = 'Y' ORDER BY cat_id";
                              $res = $db->fetch($strSQL, true, true);
                              if(($res) && ($res['status'])){
                                foreach ($res['data'] as $row) {
                                  ?>
                                  <option value="<?php echo $row['cat_name'];?>"  <?php if($resContent['con_category'] == $row['cat_name']){ echo "selected"; }?>><?php echo $row['cat_name'];?></option>
                                  <?php
                                }
                              }
                              ?>
                            </select>
                          </div>

                          <div class="form-group col-12 col-sm-6">
                            <label for="">ประเภทเนื้อหา : <span class="text-danger">*</span></label>
                            <select name="txtRedirect" id="txtRedirect" class="form-control">
                              <option value="">-- เลือก --</option>
                              <option value="N" selected>แสดงในหน้าเดิม</option>
                              <option value="Y" <?php if($resContent['con_redirect'] == 'Y'){ echo "selected"; }?>>Redirect</option>
                            </select>
                          </div>
                          
                          <div class="form-group col-12" style="height: 580px;">
                            <label for="">เนื้อหา : <span class="text-danger">*</span></label>
                            <!-- <textarea name="txtContent" id="txtContent" cols="30" rows="10" class="form-control"></textarea> -->
                            <div id="full-editor" style="height: 500px;">
                            <?php echo $resContent['con_content']; ?>
                            </div>
                          </div>

                          <div class="form-group col-12 col-sm-6">
                            <label for="">คำสำคัญ (คั่นแต่ละคำด้วย comma) : </label>
                            <input type="text" name="txtTag" id="txtTag" class="form-control" value="<?php 
                            $strSQL = "SELECT tags_name FROM ecw_tags WHERE tags_content_id = '$content_id'";
                            $resTags = $db->fetch($strSQL, true, true);
                            if(($resTags) && ($resTags['status'])){
                              $tags = array();
                              $i = 0;
                              foreach ($resTags['data'] as $row) {
                                $tags[$i] = $row;
                                $i++;
                              }
                              $tags_merge = implode(',' , $tags);
                              echo $tags_merge;
                            }
                            ?>">
                          </div>

                          <div class="form-group col-12 col-sm-6">
                            <label for="">การแสดงผล : <span class="text-danger">*</span></label>
                            <select name="txtFullscreen" id="txtFullscreen" class="form-control">
                              <option value="Y" <?php if($resContent['con_fullscreen'] == 'Y'){ echo "selected"; }?>>เต็มหน้า (Full screen)</option>
                              <option value="N" selected>Block content</option>
                            </select>
                          </div>

                          <div class="form-group col-12">
                            <label for="">Embaded PDF : </label>
                            <input type="text" name="txtPdf" id="txtPdf" class="form-control" value="<?php echo $resContent['con_pdf_url']; ?>">
                            <div class="fw-300 fs-08 pt-1 pl-1">ให้นำ URL ของ PDF มาใส่ที่นี่ หรือ <a href="app-media" target="_blank">- คลิกที่นี่ -</a> เพื่อเลือกไฟล์</div>
                          </div>

                          <div class="form-group col-12">
                            <label for="">Figure image : </label>
                            <input type="text" name="txtImage" id="txtImage" class="form-control" value="<?php echo $resContent['con_index_figure']; ?>">
                            <div class="fw-300 fs-08 pt-1 pl-1">ให้นำ URL ของรูปภาพมาใส่ที่นี่ หรือ <a href="app-media" target="_blank">- คลิกที่นี่ -</a> เพื่อเลือกรูปภาพ</div>
                          </div>

                          <div class="form-group col-12">
                            <label for="">Redirect URL : </label>
                            <input type="text" name="txtRedirectUrl" id="txtRedirectUrl" class="form-control" value="<?php echo $resContent['con_redirect_url']; ?>">
                            <div class="fw-300 fs-08 pt-1 pl-1">กรอก URL ที่ต้องการ redirect ไป</div>
                          </div>

                          <div class="form-group col-12 text-right">
                            <button class="btn btn-primary" type="button" onclick="content.update('page')">บันทึก</button>
                          </div>

                        </div>
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
    <script src="../../assets/vendor/preload.js/dist/js/preload.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/quill/katex.js"></script>
    <script src="../../assets/vendor/libs/quill/quill.js"></script>
    <script src="../../assets/vendor/libs/quill-image-resize-module/image-resize.min.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-crm.js"></script>

    <script src="../../../config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/authen.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/content.js?v=<?php echo $dateu; ?>"></script>

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

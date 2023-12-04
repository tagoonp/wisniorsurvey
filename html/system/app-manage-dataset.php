<?php 
require('../../config/config_database.php');
require('../../config/inc_config_general.php');
require('../../config/inc_database.php'); 
require('../../config/inc_function.php');
require('../../config/inc_user.php');
$page_name = basename(__FILE__) ;

if(!isset($_REQUEST['id'])){
  mysqli_close($conn); 
  header('Location: ./aapp-qualitative');
  die();
}

$id = mysqli_real_escape_string($conn, $_REQUEST['id']);

$record_status = false;

$strSQL = "SELECT * FROM rsf6x_dataset WHERE ds_id = '$id' AND ds_delete = 'N'";
$resData = $db->fetch($strSQL, false, false);
if($resData){
  $record_status = true;
}

?>

<input type="hidden" name="txtUid" id="txtUid" value="<?php echo $currentUser['uid']; ?>">
<input type="hidden" name="txtRole" id="txtRole" value="<?php echo $role; ?>">
<input type="hidden" name="txtDataId" id="txtDataId" value="<?php echo $id; ?>">
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

    <title><?php echo SHORT_TITLE; ?> : Dataset ID <?php echo $id; ?></title>

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
    <link rel="stylesheet" href="../../assets/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

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
                  <div class="col-8">
                    <h3>ชุดข้อมูล</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <?php 
                        if($record_status){
                          ?>
                          <li class="breadcrumb-item"><a href="app-qualitative">ชุุดข้อมูล</a></li>
                          <li class="breadcrumb-item"><?php echo $id; ?></li>
                          <li class="breadcrumb-item active"><?php echo $resData['ds_title']; ?></li>
                          <?php
                        }else{
                          ?>
                          <li class="breadcrumb-item active"><?php echo $id; ?></li>
                          <?php
                        }
                        ?>
                        
                      </ol>
                    </nav>
                  </div>
                  <div class="col-4 text-right pt-4">
                    <!-- <button class="btn btn-primary dn" type="button" onclick="window.location='app-person-create'"><i class="bx bx-plus"></i> เพิ่มผู้ใช้งานระบบ</button> -->
                  </div>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        
                        <?php 
                        if(!$record_status){
                          ?>
                          <div class="text-center py-5">
                            No data found
                          </div>
                          <?php
                        }else{
                          ?>
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="nameWithTitle" class="form-label">ชื่อ / ID / KEY : <span class="text-danger">*</span></label>
                                <input type="text" id="txtKey" name="txtKey" class="form-control" value="<?php echo $resData['ds_title']; ?>" />
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label for="nameWithTitle" class="form-label">รายละเอียด : <span class="text-muted">(ถ้ามี)</span></label>
                                <textarea name="txtDetail" id="txtDetail" cols="30" rows="10" class="form-control"><?php echo $resData['ds_detail']; ?></textarea>
                              </div>
                            </div>
                            <div class="col-12">
                              <label for="nameWithTitle" class="form-label">ไฟล์ที่เกี่ยวข้อง : <span class="text-muted">(ถ้ามี)</span></label>

                              <form action="#" class="dropzone dropzone-area dropzone-previews" id="dpz-single-file-media" style="padding-top: 30px;">
                                <div class="dz-message" style="margin-bottom: 0px; margin-top: 0px;">Click ที่นี่เพื่ออัพโหลดรูปภาพหรือไฟล์<br><span class="text-danger" style="font-size: 0.8em;">ยอมรับไฟล์จำนวนไม่เกิน 1 ไฟล์</span></div>
                              </form>
                            
                              <div class="form-group">
                                
                                <table class="table table-border-top" id="table-1">
                                  <thead>
                                    <tr>
                                      <th>ลำดับที่</th>
                                      <th>ชื่อไฟล์</th>
                                      <th>วันที่อัพโหลด</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <?php 
                                  $strSQL = "SELECT * FROM rsf6x_media WHERE upload_use = 'Y' AND upload_ds_id = '$id'";
                                  $res = $db->fetch($strSQL, true, true);
                                  if(($res) && ($res['status'])){
                                    $c = 1;
                                    foreach ($res['data'] as $row) {
                                      ?>
                                      <tr>
                                        <td style="width: 40px;"><?php echo $c; ?></td>
                                        <td><?php echo $row['upload_file_name']; ?></td>
                                        <td><?php echo $row['upload_udatetime']; ?></td>
                                        <td class="text-right">
                                          <a href="<?php echo $row['upload_url_original']; ?>" target="_blank" class="btn btn-icon"><i class="bx bx-download"></i></a>
                                          <a href="Javascript:staff.delete_file('<?php echo $row['upload_id'];?>')" class="btn btn-icon"><i class="bx bx-trash text-danger"></i></a>
                                        </td>
                                      </tr>
                                      <?php
                                      $c++;
                                    }
                                  }
                                  ?>
                                </table>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="form-group text-right">
                                <button class="btn btn-primary" type="button" onclick="staff.update_dataset()">บันทึกการปรับปรุง</button>
                              </div>
                            </div>

                          </div>
                          <?php
                        }
                        ?>

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
    <script src="../../assets/vendor/libs/dropzone/dropzone2.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-crm.js"></script>

    <script src="../../config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/staff.js?v=<?php echo $dateu; ?>"></script>

    <script>

      Dropzone.autoDiscover = false;

      $(document).ready(function(){
        preload.hide()
        if($('#table-1').length){
          $('#table-1').dataTable({})
        }
      })

      

      if($('#dpz-single-file-media').length){
        upload_shop_doc = new Dropzone("#dpz-single-file-media", {
            url: api + 'upload_media?ds_id=' + $('#txtDataId').val(),
            previewsContainer: ".dropzone-previews",
            maxFilesize: 100,
            maxFile: 1,
            init: function(){
                this.on("complete", function(file) {
                  console.log(file);
                  preload.show()
                  if(file.xhr.responseText == "Success"){
                      setTimeout(function(){
                        window.location.reload()
                      }, 3000)
                  }else if(file.xhr.responseText == 'Fail x1001'){
                    preload.hide()
                    this.removeFile(file);
                    Swal.fire({
                              icon: "error",
                              title: 'Error',
                              text: 'Please enter you abstract title.',
                              confirmButtonClass: 'btn btn-danger',
                    })
                    $('#txtFilename').val('')
                  }else{
                    preload.hide()
                    this.removeFile(file);
                    Swal.fire({
                              icon: "error",
                              title: 'Error',
                              text: 'Can not upload file.',
                              confirmButtonClass: 'btn btn-danger',
                    })
                    $('#txtFilename').val('')
                  }
                });
            }
          });
      }
    </script>
  </body>
</html>

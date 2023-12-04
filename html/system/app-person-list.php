<?php 
require('../../config/config_database.php');
require('../../config/inc_config_general.php');
require('../../config/inc_database.php'); 
require('../../config/inc_function.php');
require('../../config/inc_user.php');
$page_name = basename(__FILE__) ;
?>

<input type="hidden" name="txtUid" id="txtUid" value="<?php echo $currentUser['uid']; ?>">
<input type="hidden" name="txtRole" id="txtRole" value="<?php echo $role; ?>">
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

    <title><?php echo SHORT_TITLE; ?> : บัญชีผู้ใช้งาน</title>

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
                    <h3>ผู้ใช้งานระบบ</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="javascript:void(0);">ผู้ใช้งานระบบ</a>
                        </li>
                        <li class="breadcrumb-item active">รายชื่อผู้ใช้งานระบบ</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-4 text-right pt-4">
                    <!-- <button class="btn btn-primary dn" type="button" onclick="window.location='app-person-create'"><i class="bx bx-plus"></i> เพิ่มผู้ใช้งานระบบ</button> -->
                  </div>
                  <div class="col-12">
                    <h5>ผู้ใช้งานระบบ</h5>
                    <div class="card">
                      <div class="card-header pt-4">
                        <h4>รายชื่อบุคลากร</h4>
                      </div>
                      <div class="card-body">
                        <table class="table table-border-top" id="table-1">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>บุคลากร</th>
                              <th>สิทธิ์หลัก</th>
                              <th>แอดมิน</th>
                              <th>เจ้าหน้าที่</th>
                              <th>ผู้บันทึกข้อมูล</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $strSQL = "SELECT * FROM rsf6x_account
                                       WHERE delete_status = 'N' ORDER BY fullname DESC";
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                              $c = 1;
                              foreach ($res['data'] as $row) {
                                ?>
                                <tr id="tbrow_<?php echo $c;?>" >
                                  <td class="text-top"  style="width: 50px; padding-top: 13px;"><?php echo $c ; ?> </td>
                                  <td class="text-top"  style=" padding-top: 13px;">
                                    <?php echo $row['fullname'] ; ?>
                                    <div>
                                        <small><?php echo $row['department'] ; ?></small>
                                    </div>
                                  </td>
                                  <td class="text-top" style="">
                                    <select name="" id="" class="form-control">
                                        <option value="admin">แอดมิน</option>
                                        <option value="staff">เจ้าหน้าที่</option>
                                        <option value="entry">ผู้บันทึกข้อมูล</option>
                                    </select>
                                  </td>
                                  <td class="text-top" style=" padding-top: 13px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" onclick="admin.toggle_role('role_admin', '<?php echo $row['uid'];?>')" <?php if($row['role_admin'] == 'Y'){ echo "checked"; } ?> />
                                    </div>
                                  </td>
                                  <td class="text-top" style=" padding-top: 13px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck3"  onclick="admin.toggle_role('role_staff', '<?php echo $row['uid'];?>')" <?php if($row['role_staff'] == 'Y'){ echo "checked"; } ?> />
                                    </div>
                                  </td>
                                  <td class="text-top" style=" padding-top: 13px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck3"  onclick="admin.toggle_role('role_entry', '<?php echo $row['uid'];?>')" <?php if($row['role_entry'] == 'Y'){ echo "checked"; } ?> />
                                    </div>
                                  </td>
                                  <td class="text-top"  style="text-align: right; padding-top: 13px;">
                                      <a href="app-person-edit?id=<?php echo $row['uid'];?>" class="btn btn-icon"><i class="bx bx-pencil"></i></a>
                                      <a href="Javascript:admin.delete_account('<?php echo $row['uid'];?>')" class="btn btn-icon"><i class="bx bx-trash text-danger"></i></a>
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
    <script src="../../assets/vendor/preload.js/dist/js/preload.js"></script>
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

    <script src="../../config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/admin.js?v=<?php echo $dateu; ?>"></script>

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

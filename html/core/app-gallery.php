<?php 
require('../../../config/config_database.php');
require('../../../config/inc_config_general.php');
require('../../../config/inc_database.php'); 
require('../../../config/inc_function.php');
require('../../../config/inc_user.php');
$page_name = basename(__FILE__) ;
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

    <title><?php echo SHORT_TITLE; ?> : อัลบั้มภาพ</title>

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
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" type="text/css">
    <link rel="stylesheet" href="../../assets/vendor/preload.js/dist/css/preload.css" rel="stylesheet">

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
                    <h3>อัลบั้มภาพ</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="./">หน้าแรก</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="javascript:void(0);">การจัดการ</a>
                        </li>
                        <li class="breadcrumb-item active">อัลบั้มภาพ</li>
                      </ol>
                    </nav>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="pt-3">
                      <div class="row mt-0" style="padding: 0px 10px;">
                        <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;" onclick="window.location='app-album-media'">
                          <div class="img-covering" style="background-color: white !important; border: dashed; border-width: 1px 1px 1px 1px; border-color: #ccc; border-radius: 20px;">
                            <div class="text-center" style="padding-top: 80px;">
                            <i class="bx bx-plus" style="font-size: 3em;"></i>
                            </div>
                          </div>
                          <div style="font-size: 12px; padding-top: 10px; line-height: 14px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"></div>
                        </div>

                        <?php 
                            $strSQL = "SELECT * FROM ecw_album WHERE album_delete = 'N' AND album_id IN (SELECT upload_album_id FROM ecw_album_media WHERE upload_album_id IS NOT NULL) ORDER BY album_id DESC";
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                              foreach ($res['data'] as $row) {
                                if(($row['album_figure'] != '') && ($row['album_figure'] != 'null')){
                                  ?>
                                  <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;">
                                    <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $row['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                    <div class="pt-2"><a href="Javascript:deleteAlbum('<?php echo $row['album_id'];?>')"><i class="bx bx-trash"></i></a></div>
                                  </div>
                                  <?php
                                }else{
      
                                  $strSQL = "SELECT * FROM ecw_album_media WHERE upload_album_id = '".$row['album_id']."' LIMIT 1";
                                  $res = $db->fetch($strSQL, false, false);
                                  if($res){
                                    ?>
                                    <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;" >
                                      <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $res['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                      <div class="pt-2"><a href="Javascript:deleteAlbum('<?php echo $row['album_id'];?>')"><i class="bx bx-trash"></i></a></div>
                                    </div>
                                    <?php
                                  }else{
                                    ?>
                                    <div class="col-4 col-sm-2 col-md-2 pl-0 pr-0" style="padding: 5px; cursor: pointer;">
                                      <div class="img-covering"  onclick="window.location='app-album-media?id=<?php echo $row['album_id'];?>'" style="background-image: url('<?php echo $row['upload_url_thumb']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                      <div class="pt-2"><a href="Javascript:deleteAlbum('<?php echo $row['album_id'];?>')"><i class="bx bx-trash"></i></a></div>
                                    </div>
                                    <?php
                                  }
                                }
                              }
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
    <script src="../../assets/vendor/libs/dropzone/dropzone2.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../../assets/vendor/preload.js/dist/js/preload.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../../config/config.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/authen.js?v=<?php echo $dateu; ?>"></script>
    <script src="../../assets/custom/js/content.js?v=<?php echo $dateu; ?>"></script>

    <script>
      Dropzone.autoDiscover = false;

      if($('#dpz-single-file-media').length){
        upload_shop_doc = new Dropzone("#dpz-single-file-media", {
            url: api + 'upload_media',
            previewsContainer: ".dropzone-previews",
            maxFilesize: 100,
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

    


      $(document).ready(function(){
        preload.hide()
      })
    </script>
  </body>
</html>
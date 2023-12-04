<?php 
require('../config/config_database.php');
require('../config/inc_config_general.php');
require('../config/inc_database.php'); 
// require('../config/inc_function.php'); 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$return = array();

if(isset($_FILES)){

    $file = $_FILES['file']['tmp_name'];
    $sourceProperties = getimagesize($file);
    $imagetype_check = false;
    if(@is_array(getimagesize($file))){
        $imagetype_check = true;
        $imagetype = $sourceProperties[2];
    }   

    $originalName = $_FILES['file']['name'];
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);

    $path_original = "../upload/original/";
    $path_thumbnail = "../upload/thumbnail/";
    $path_resize = "../upload/resize/";

    $generatedName = $dateu.'-'.time();
    $filePath = $path_original.$generatedName;

    $ds_id = mysqli_real_escape_string($conn, $_REQUEST['ds_id']);

    if($imagetype_check){
        switch ($imagetype) {
            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file);
                // Resize 
                $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], 'resize');
                imagepng($targetLayer, $path_resize.$generatedName.'_resize.'.$ext);
                // Thumbnail 
                $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], 'thumb');
                imagepng($targetLayer, $path_thumbnail.$generatedName.'_thump.'.$ext);
    
                if (move_uploaded_file($file, $filePath .'.' .$ext)) {
    
                    $uploadUri_original = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
                    $uploadUri_thumbnail = UPLOAD_DIR . 'thumbnail/'.$generatedName.'_thump.'.$ext;
                    $uploadUri_resize = UPLOAD_DIR . 'resize/'.$generatedName.'_resize.'.$ext;
            
                    $strSQL = "INSERT INTO rsf6x_media 
                              (`upload_file_name`, `upload_type`, `upload_url_original`, `upload_url_resize`, `upload_url_thumb`,  `upload_udatetime`, `upload_ds_id`) 
                              VALUES 
                              ('".$_FILES['file']['name']."', 'img', '$uploadUri_original', '$uploadUri_resize', '$uploadUri_thumbnail','$datetime', '$ds_id')";
                    $res = $db->insert($strSQL, false);
            
                    echo "Success";
                    $db->close(); 
                    die();
                }else{
                    echo "Can not upload";
                    $db->close(); 
                    die();
                }
    
                break;
            case IMAGETYPE_JPEG:
                // Resize 
                $imageResourceId = imagecreatefromjpeg($file);
                $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], 'resize');
                imagejpeg($targetLayer, $path_resize.$generatedName.'_resize.'.$ext);
                // Thumbnail 
                $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1], 'thumb');
                imagejpeg($targetLayer, $path_thumbnail.$generatedName.'_thump.'.$ext);

                if (move_uploaded_file($file, $filePath .'.' .$ext)) {
    
                    $uploadUri_original = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
                    $uploadUri_thumbnail = UPLOAD_DIR . 'thumbnail/'.$generatedName.'_thump.'.$ext;
                    $uploadUri_resize = UPLOAD_DIR . 'resize/'.$generatedName.'_resize.'.$ext;
            
                    $strSQL = "INSERT INTO rsf6x_media 
                              (`upload_file_name`, `upload_type`, `upload_url_original`, `upload_url_resize`, `upload_url_thumb`,`upload_udatetime`, `upload_ds_id`) 
                              VALUES 
                              ('".$_FILES['file']['name']."', 'img', '$uploadUri_original', '$uploadUri_resize', '$uploadUri_thumbnail', '$datetime', '$ds_id')";
                    $res = $db->insert($strSQL, false);
            
                    echo "Success";
                    $db->close(); 
                    die();
                }else{
                    echo "Can not upload";
                    $db->close(); 
                    die();
                }

                break;
            default:
                // Not image 
    
                if (move_uploaded_file($file, $filePath .'.' .$ext)) {
    
                    $uploadUri_original = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
                    $uploadUri_thumbnail = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
                    $uploadUri_resize = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
            
                    $strSQL = "INSERT INTO rsf6x_media 
                              (`upload_file_name`, `upload_type`, `upload_url_original`, `upload_url_resize`, `upload_url_thumb`, `upload_udatetime`, `upload_ds_id`) 
                              VALUES 
                              ('".$_FILES['file']['name']."', 'other', '$uploadUri_original', '$uploadUri_resize', '$uploadUri_thumbnail', '$datetime', '$ds_id')";
                    $res = $db->insert($strSQL, false);
            
                    echo "Success";
                    $db->close(); 
                    die();
                }else{
                    echo "Can not upload";
                    $db->close(); 
                    die();
                }
    
                break;
        }
    }else{
        if (move_uploaded_file($file, $filePath .'.' .$ext)) {
            $uploadUri_original = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
            $uploadUri_thumbnail = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
            $uploadUri_resize = UPLOAD_DIR . 'original/'.$generatedName.'.'.$ext;
    
            $strSQL = "INSERT INTO rsf6x_media 
                      (`upload_file_name`, `upload_type`, `upload_url_original`, `upload_url_resize`, `upload_url_thumb`, `upload_udatetime`, `upload_ds_id`) 
                      VALUES 
                      ('".$_FILES['file']['name']."', 'other', '$uploadUri_original', '$uploadUri_resize', '$uploadUri_thumbnail', '$datetime', '$ds_id')";
            $res = $db->insert($strSQL, false);
    
            echo "Success";
            $db->close(); 
            die();
        }else{
            echo "Can not upload";
            $db->close(); 
            die();
        }
    }
}else{
    echo "Fail x1002";
    $db->close(); 
    die();
}
function imageResize($imageResourceId, $width, $height, $retype){
    if($retype == 'resize'){
        $targetWidth = $width < 100 ? $width : 1280;
        $targetHeight = ($height/$width) * $targetWidth;
        $targetLaher = imagecreatetruecolor((int) $targetWidth, (int) $targetHeight);
        imagecopyresampled($targetLaher, $imageResourceId, 0, 0, 0, 0, (int) $targetWidth, (int) $targetHeight, $width, $height);
        return $targetLaher;
    }else{
        $targetWidth = 500;
        $targetHeight = ($height/$width) * $targetWidth;
        $targetLaher = imagecreatetruecolor((int) $targetWidth, (int) $targetHeight);
        imagecopyresampled($targetLaher, $imageResourceId, 0, 0, 0, 0, (int) $targetWidth, (int) $targetHeight, $width, $height);
        return $targetLaher;
    }
    
}
?>
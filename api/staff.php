<?php 
require('../config/config_database.php');
require('../config/inc_config_general.php');
require('../config/inc_database.php'); 
require('../config/inc_function.php'); 

require_once "./src/thaibulksms-api/sms.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$return = array();

if(!isset($_REQUEST['stage'])){
    $return['status'] = 'Fail';  $return['error_message'] = 'Invalid stage';
    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

switch ($stage) {
    case 'create_quali_record':
        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['role'])) ||  
            (!isset($_REQUEST['record_title'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $record_title = mysqli_real_escape_string($conn, $_REQUEST['record_title']);

        $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y' AND (role_admin = 'Y' OR role_staff = 'Y')";
        $res = $db->fetch($strSQL, false, false);

        if($res){

            $strSQL = "INSERT INTO rsf6x_dataset (`ds_title`, `ds_datetime`, `ds_udatetime`, `ds_uid`) VALUES ('$record_title', '$datetime', '$datetime', '$uid')";
            $resInsert = $db->insert($strSQL, true);
            if($resInsert){
                $record_id = $resInsert;

                $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'สร้างชุดข้อมูล Qualitative', 'ID $resInsert : ".$record_title."', '$datetime')";
                $resLog = $db->insert($strSQL, false);
    
                $return['status'] = 'Success'; 
                $return['return_id'] = $record_id; 
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();

            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Error';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }

        }else{
            $return['status'] = 'Fail';  $return['error_message'] = 'Permission denine';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        break;
    case 'update_dataset':

        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['role'])) ||
            (!isset($_REQUEST['ds_id'])) ||
            (!isset($_REQUEST['key'])) || 
            (!isset($_REQUEST['detail'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $ds_id = mysqli_real_escape_string($conn, $_REQUEST['ds_id']);
        $key = mysqli_real_escape_string($conn, $_REQUEST['key']);
        $detail = mysqli_real_escape_string($conn, $_REQUEST['detail']);

        $strSQL = "SELECT * FROM rsf6x_dataset WHERE ds_id = '$ds_id' ";
        $resCheck = $db->fetch($strSQL, false, false);
        if(!$resCheck){
            $return['status'] = 'Fail';  $return['error_message'] = 'Not found';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $strSQL = "UPDATE rsf6x_dataset 
                   SET
                   ds_title = '$key',
                   ds_detail = '$detail',
                   ds_udatetime = '$datetime'
                   WHERE 
                   ds_id = '$ds_id'
                  ";
        $resUpdate = $db->execute($strSQL);

        $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'แก้ไขรายละเอียดชุดข้อมูล Qualitative', 'ID $ds_id : ".$resCheck['ds_title']."', '$datetime')";
        $resLog = $db->insert($strSQL, false);

        $return['status'] = 'Success'; 
        echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        
        break ;
    case 'delete_file':

        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['role'])) ||
            (!isset($_REQUEST['ds_id'])) ||
            (!isset($_REQUEST['file_id']))
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $ds_id = mysqli_real_escape_string($conn, $_REQUEST['ds_id']);
        $file_id = mysqli_real_escape_string($conn, $_REQUEST['file_id']);

        $strSQL = "UPDATE rsf6x_media SET upload_use = 'N' WHERE upload_id = '$file_id' AND upload_ds_id = '$ds_id'";
        $res = $db->execute($strSQL);

        $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'ลบไฟล์ Qualitative', 'ID $file_id', '$datetime')";
        $resLog = $db->insert($strSQL, false);

        $return['status'] = 'Success'; 
        echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();

        break ;
    case 'delete_dataset':

        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['role'])) ||
            (!isset($_REQUEST['ds_id']))
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $ds_id = mysqli_real_escape_string($conn, $_REQUEST['ds_id']);

        $strSQL = "SELECT * FROM rsf6x_dataset WHERE ds_id = '$ds_id' ";
        $resCheck = $db->fetch($strSQL, false, false);
        if(!$resCheck){
            $return['status'] = 'Fail';  $return['error_message'] = 'Not found';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }
        $strSQL = "UPDATE rsf6x_dataset SET ds_delete = 'Y' WHERE ds_id = '$ds_id'";
        $res = $db->execute($strSQL);

        $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'ลบชุดข้อมูล Qualitative', 'ID $ds_id : ".$resCheck['ds_title']."', '$datetime')";
        $resLog = $db->insert($strSQL, false);

        $return['status'] = 'Success'; 
        echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();

        break; 
    default:
        # code...
        break;
}
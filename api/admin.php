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
    case 'toggle_param':

        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['role'])) || 
            (!isset($_REQUEST['target_uid'])) || 
            (!isset($_REQUEST['param_key'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $target_uid = mysqli_real_escape_string($conn, $_REQUEST['target_uid']);
        $param_key = mysqli_real_escape_string($conn, $_REQUEST['param_key']);

        $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y' AND role_admin = 'Y'";
        $res = $db->fetch($strSQL, false, false);
        if(($res) && ($role == 'admin')){

            $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$target_uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y'";
            $resCheck = $db->fetch($strSQL, false, false);
            if(!$resCheck){
                $return['status'] = 'Fail';  $return['error_message'] = 'Not found';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }

            $recent_status = $resCheck[$param_key];
            $new = 'N';
            if($recent_status == 'N'){
                $new = 'Y';
            }

            $strSQL = "UPDATE rsf6x_account SET $param_key = '$new' WHERE uid = '$uid'";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'ปรับปรุงบัญชีผู้ใช้งาน', 'ID $target_uid : $param_key เป็น ".$new."', '$datetime')";
            $resLog = $db->insert($strSQL, false);

            $return['status'] = 'Success'; 
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }else{
            $return['status'] = 'Fail';  $return['error_message'] = 'Permission denine';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        break ;

    case 'delete_account':
        if(
            (!isset($_REQUEST['uid'])) || 
            (!isset($_REQUEST['target_uid'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $role = mysqli_real_escape_string($conn, $_REQUEST['role']);
        $target_uid = mysqli_real_escape_string($conn, $_REQUEST['target_uid']);

        $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y' AND role_admin = 'Y'";
        $res = $db->fetch($strSQL, false, false);
        if(($res) && ($role == 'admin')){
            $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$target_uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y'";
            $resCheck = $db->fetch($strSQL, false, false);
            if(!$resCheck){
                $return['status'] = 'Fail';  $return['error_message'] = 'Not found';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }
            $strSQL = "UPDATE rsf6x_account SET delete_status = 'Y' WHERE uid = '$uid'";
            $res = $db->execute($strSQL);

            $strSQL = "INSERT INTO rsf6x_log_activity (`log_uid`, `log_ip`, `log_activity`, `log_detail`, `log_datetime`) VALUES ('$uid', '$ip', 'ลบบัญชีผู้ใช้งาน', 'ID $target_uid : ".$resCheck['fullname']."', '$datetime')";
            $resLog = $db->insert($strSQL, false);

            $return['status'] = 'Success'; 
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }else{
            $return['status'] = 'Fail';  $return['error_message'] = 'Permission denine';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        break;
    
    default:
        # code...
        break;
}
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
    case 'admin_login':
        if(
            (!isset($_REQUEST['email-username'])) || 
            (!isset($_REQUEST['password'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $username = mysqli_real_escape_string($conn, $_REQUEST['email-username']);
        $password = mysqli_real_escape_string($conn, $_REQUEST['password']);

        $username = base64_encode($username);
        $password = base64_encode($password);

        $strSQL = "SELECT * FROM rsf6x_account WHERE username = '$username' AND tmp_password = '$password' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y'";
        $resUser = $db->fetch($strSQL, false, false);

        if($resUser){

            mysqli_close($conn); 

            $_SESSION[TB_PREFIX . 'id'] = session_id();
            $_SESSION[TB_PREFIX . 'uid'] = $resUser['uid']; 
            $_SESSION[TB_PREFIX . 'role'] = $resUser['role_core'];

            header('Location: ../html/system/');

            // echo $_SESSION[TB_PREFIX . 'role'];
            die();              
        }else{
            ?>
            Account not found, click <a href="./">here</a> to login.
            <?php
            mysqli_close($conn); die();
        }

        break ;
    case 'login':
        if(
            (!isset($_REQUEST['email-username']))
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $username = mysqli_real_escape_string($conn, $_REQUEST['email-username']);
        
        $username = base64_encode($username);

        $strSQL = "SELECT * FROM rsf6x_account WHERE username = '$username' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y'";
        $res = $db->fetch($strSQL, false, false);
        if($res){
            // Generate otp 
            $uid = $res['uid'];
            $randomRef = generateRandomString(5);
            $randomNumber = generateRandomNumber(6);

            $strSQL = "INSERT INTO rsf6x_otp (`otp_ref`, `otp_code`, `otp_issue`, `otp_issue_uid`) VALUES ('$randomRef', '$randomNumber', '$datetime', '$uid')";
            $resInsert = $db->insert($strSQL, false);
            if($resInsert){


                $apiKey = SMS_API_KEY;
                $apiSecretKey = SMS_API_SECRET;

                $sms = new \THAIBULKSMS_API\SMS\SMS($apiKey, $apiSecretKey); 

                $phone = base64_decode($username);

                $body = [
                    'msisdn' => $phone,
                    'message' => 'รหัส OTP = ' . $randomNumber . ' < Ref. '.$randomRef.' > สำหรับเข้าระบบ COV-EPI',
                    'sender' => 'Commu.DB'
                ];
                $res = $sms->sendSMS($body);

                if ($res->httpStatusCode == 201) {
                    // echo "Succes";
                    // var_dump($res);
                    header('Location: ../otp?ref='.$randomRef.'&uid='.$uid.'&stage=confirmlogin');
                } else {
                    // echo "Error";
                    // var_dump($res);

                    $return['status'] = 'Fail';  $return['error_message'] = 'SMS API ERROR';
                    var_dump($res);
                    echo "<br>";
                    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                }

                
            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Command error';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }

        }else{
            // echo $strSQL;
            ?>
            ไม่พบบัญชีผู้ใช้งาน <a href="../register">คลิกที่นี่</a> เพื่อสมัครใช้งาน หรือ <a href="../login">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง
            <?php
        }
        break;
    case 'verify-otp':
        // echo "asd";
        if(
            (!isset($_REQUEST['txtUid'])) || 
            (!isset($_REQUEST['txtRef'])) || 
            (!isset($_REQUEST['txtStage'])) || 
            (!isset($_REQUEST['txtOtp'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $uid = mysqli_real_escape_string($conn, $_REQUEST['txtUid']);
        $reference = mysqli_real_escape_string($conn, $_REQUEST['txtRef']);
        $otp = mysqli_real_escape_string($conn, $_REQUEST['txtOtp']);
        $check_stage = mysqli_real_escape_string($conn, $_REQUEST['txtStage']);

        $strSQL = "SELECT * FROM rsf6x_otp WHERE otp_ref = '$reference' AND otp_issue_uid = '$uid' AND otp_activate = 'N'";
        $res = $db->fetch($strSQL, false, false);

        if($res){
            $strSQL = "UPDATE rsf6x_otp SET otp_activate = 'Y', otp_activate_datetime = '$datetime' WHERE otp_ref = '$reference' AND otp_issue_uid = '$uid' AND otp_activate = 'N'";
            $resUpdate = $db->execute($strSQL);

            $strSQL = "UPDATE rsf6x_account SET active_status = 'Y', allow_status = 'Y' WHERE uid = '$uid'";
            $resUpdate = $db->execute($strSQL);

            $strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$uid' AND active_status = 'Y' AND allow_status = 'Y' AND delete_status = 'N'";
            $resUser = $db->fetch($strSQL, false, false);
            if($resUser){

                mysqli_close($conn); 

                $_SESSION[TB_PREFIX . 'id'] = session_id();
                $_SESSION[TB_PREFIX . 'uid'] = $uid; 
                $_SESSION[TB_PREFIX . 'role'] = $resUser['role_core'];

                header('Location: ../html/system/');

                echo $_SESSION[TB_PREFIX . 'role'];
                die();              
            }else{
                ?>
                Account not found, click <a href="./">here</a> to login.
                <?php
                mysqli_close($conn); die();
            }
        }else{

            echo $strSQL;
        ?>
        OTP Session timeout, click <a href="./">here</a> to login.
        <?php
        mysqli_close($conn); die();
        }
        
        break;
    case 'logout':
        unset($_SESSION[TB_PREFIX . 'id']);
        unset($_SESSION[TB_PREFIX . 'uid']);
        unset($_SESSION[TB_PREFIX . 'role']);
        session_destroy();

        header('Location: '.ROOT_DOMAIN);
        break ;
    case 'common_signup':
        if(
            (!isset($_REQUEST['fullname'])) || 
            (!isset($_REQUEST['password'])) || 
            (!isset($_REQUEST['username'])) || 
            (!isset($_REQUEST['phone'])) 
        ){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }

        $fullname = mysqli_real_escape_string($conn, $_REQUEST['fullname']);
        $phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);
        $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
        $username = mysqli_real_escape_string($conn, $_REQUEST['username']);
        
        if($phone != ''){
            $phone = base64_encode($phone);
        }
        
        $password = base64_encode($password);

        $strSQL = "SELECT * FROM wz_username WHERE username = '$username' AND active_status = 'Y' AND delete_status = 'N'";
        $res = $db->fetch($strSQL, false, false);
        if($res){
            $uid = $res['uid'];
            $randomRef = generateRandomString(5);
            $randomNumber = generateRandomNumber(6);

            $strSQL = "INSERT INTO rsf6x_otp (`otp_ref`, `otp_code`, `otp_issue`, `otp_issue_uid`) VALUES ('$randomRef', '$randomNumber', '$datetime', '$uid')";
            $resInsert = $db->insert($strSQL, false);
            if($resInsert){
                // header('Location: ../otp?ref='.$randomRef.'&uid='.$uid.'&stage=confirmlogin');

                $apiKey = SMS_API_KEY;
                $apiSecretKey = SMS_API_SECRET;

                $sms = new \THAIBULKSMS_API\SMS\SMS($apiKey, $apiSecretKey); 

                $phone = base64_decode($phone);

                $body = [
                    'msisdn' => $phone,
                    'message' => 'รหัส OTP = ' . $randomNumber . ' < Ref. '.$randomRef.' > สำหรับเข้าระบบ COV-EPI',
                    'sender' => 'Commu.DB'
                ];
                $res = $sms->sendSMS($body);

                if ($res->httpStatusCode == 201) {
                    header('Location: ../otp?ref='.$randomRef.'&uid='.$uid.'&stage=confirmlogin');
                } else {
                    $return['status'] = 'Fail';  $return['error_message'] = 'SMS API ERROR';
                    var_dump($res);
                    echo "<br>";
                    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                }

            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Command error';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }
        }else{

            $strSQL = "INSERT INTO rsf6x_account (`username`, `fullname`, `department`, `role_core`, `rdatetime`, `udatetime`) VALUES ('$phone', '$fullname', '$department', 'common', '$datetime', '$datetime')";
            $resInsert = $db->insert($strSQL, true);

            if($resInsert){ 
                $uid = $resInsert;
                $randomRef = generateRandomString(5);
                $randomNumber = generateRandomNumber(6);

                $strSQL = "INSERT INTO rsf6x_otp (`otp_ref`, `otp_code`, `otp_issue`, `otp_issue_uid`) VALUES ('$randomRef', '$randomNumber', '$datetime', '$uid')";
                $resInsert = $db->insert($strSQL, false);
                if($resInsert){
                    // header('Location: ../otp?ref='.$randomRef.'&uid='.$uid.'&stage=confirmregister');

                    $apiKey = SMS_API_KEY;
                    $apiSecretKey = SMS_API_SECRET;

                    $sms = new \THAIBULKSMS_API\SMS\SMS($apiKey, $apiSecretKey); 

                    $phone = base64_decode($phone);

                    $body = [
                        'msisdn' => $phone,
                        'message' => 'รหัส OTP = ' . $randomNumber . ' < Ref. '.$randomRef.' > สำหรับเข้าระบบ COV-EPI',
                        'sender' => 'Commu.DB'
                    ];
                    $res = $sms->sendSMS($body);

                    if ($res->httpStatusCode == 201) {
                        header('Location: ../otp?ref='.$randomRef.'&uid='.$uid.'&stage=confirmregister');
                    } else {
                        $return['status'] = 'Fail';  $return['error_message'] = 'SMS API ERROR';
                        var_dump($res);
                        echo "<br>";
                        echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                    }
                    
                }else{
                    $return['status'] = 'Fail';  $return['error_message'] = 'Command error';
                    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                }
            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Command error';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }
        }
        mysqli_close($conn); die();
        break ;
    default:
        # code...
        break;
}
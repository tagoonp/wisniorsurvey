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
    case 'create_session':
        if(!isset($_REQUEST['user_id'])){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }
        
        $user_id = mysqli_real_escape_string($conn, $_REQUEST['user_id']);

        $strSQL = "SELECT * FROM rsf6x_form_p1 WHERE p1_code = '$user_id'";
        $res = $db->fetch($strSQL, false, false);

        $return['session_id'] = session_id();
        if($res){
            $return['status'] = 'Success';
            $return['record_id'] = $res['p1_id'];
            $return['record_code'] = $res['p1_code'];
            $strSQL = "SELECT * FROM rsf6x_form_finish WHERE ff_code = '$user_id'";
            $res2 = $db->fetch($strSQL, false, false);
            if(($res2) && ($res2['ff_f1'] == 'Y')){
                $return['return_page'] = 'form-index';
            }else{
                $return['return_page'] = 'form-1';
            }
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }else{
            $strSQL = "INSERT INTO rsf6x_form_p1 (`p1_code`, `p1_rdatetime`, `p1_udatetime`) VALUES ('$user_id', '$datetime', '$datetime')";
            $resInsert = $db->insert($strSQL, true);
            if($resInsert){ 
                $insert_id = $resInsert;
                $return['status'] = 'Success';
                $return['record_id'] = $resInsert;
                $return['return_page'] = 'form-1';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Error';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }
        }
        break;
    case 'save_part_1':

        if(!isset($_REQUEST['uid'])){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }
        
        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q1_o = mysqli_real_escape_string($conn, $_REQUEST['q1_o']);
        $q2 = mysqli_real_escape_string($conn, $_REQUEST['q2']);
        $q3 = mysqli_real_escape_string($conn, $_REQUEST['q3']);
        $q4 = mysqli_real_escape_string($conn, $_REQUEST['q4']);
        $q4_o = mysqli_real_escape_string($conn, $_REQUEST['q4_o']);
        $q5 = mysqli_real_escape_string($conn, $_REQUEST['q5']);
        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q7_o = mysqli_real_escape_string($conn, $_REQUEST['q7_o']);
        $q8_1 = mysqli_real_escape_string($conn, $_REQUEST['q8_1']);
        $q8_2 = mysqli_real_escape_string($conn, $_REQUEST['q8_2']);
        $q8_3 = mysqli_real_escape_string($conn, $_REQUEST['q8_3']);
        $q8_4 = mysqli_real_escape_string($conn, $_REQUEST['q8_4']);
        $q8_5 = mysqli_real_escape_string($conn, $_REQUEST['q8_5']);
        $q8_6 = mysqli_real_escape_string($conn, $_REQUEST['q8_6']);
        $q8_7 = mysqli_real_escape_string($conn, $_REQUEST['q8_7']);
        $q8_8 = mysqli_real_escape_string($conn, $_REQUEST['q8_8']);
        $q8_9 = mysqli_real_escape_string($conn, $_REQUEST['q8_9']);
        $q9 = mysqli_real_escape_string($conn, $_REQUEST['q9']);
        $q9_1 = mysqli_real_escape_string($conn, $_REQUEST['q9_1']);
        $q9_2 = mysqli_real_escape_string($conn, $_REQUEST['q9_2']);
        $q9_3 = mysqli_real_escape_string($conn, $_REQUEST['q9_3']);
        $q9_4 = mysqli_real_escape_string($conn, $_REQUEST['q9_4']);
        $q9_5 = mysqli_real_escape_string($conn, $_REQUEST['q9_5']);
        $q9_6 = mysqli_real_escape_string($conn, $_REQUEST['q9_6']);
        $q9_7 = mysqli_real_escape_string($conn, $_REQUEST['q9_7']);
        $q10 = mysqli_real_escape_string($conn, $_REQUEST['q10']);
        $q10_dd = mysqli_real_escape_string($conn, $_REQUEST['q10_dd']);
        $q10_mm = mysqli_real_escape_string($conn, $_REQUEST['q10_mm']);
        $q10_yy = mysqli_real_escape_string($conn, $_REQUEST['q10_yy']);
        $q10_score = mysqli_real_escape_string($conn, $_REQUEST['q10_score']);
        $q11 = mysqli_real_escape_string($conn, $_REQUEST['q11']);
        $q11_dd = mysqli_real_escape_string($conn, $_REQUEST['q11_dd']);
        $q11_mm = mysqli_real_escape_string($conn, $_REQUEST['q11_mm']);
        $q11_yy = mysqli_real_escape_string($conn, $_REQUEST['q11_yy']);
        $q11_score = mysqli_real_escape_string($conn, $_REQUEST['q11_score']);

        if($q4 != '4'){ $q4_o = ''; }
        if($q7 != '11'){ $q7_o = ''; }
        if($q9 == '1'){
            $q9_1 = 0;
            $q9_2 = 0;
            $q9_3 = 0;
            $q9_4 = 0;
            $q9_5 = 0;
            $q9_6 = 0;
            $q9_7 = 0;
        }

        if($q10 == '1'){
            $q10_dd = ''; $q10_mm = ''; $q10_yy = '';
            $q10_score = 'NA';
        }

        if($q11 == '1'){
            $q11_dd = ''; $q11_mm = ''; $q11_yy = '';
            $q11_score = 'NA';
        }

        $strSQL = "SELECT * FROM rsf6x_form_p1 WHERE p1_code = '$uid'";
        $res = $db->fetch($strSQL, false, false);
        if($res){
            $strSQL = "UPDATE rsf6x_form_p1 
                       SET 
                        p1_area = '$q1' ,
                        pt_tambon = '$q1_o' ,
                        p1_gender = '$q2' ,
                        p1_age = '$q3' ,
                        p1_rel = '$q4' ,
                        p1_rel_other = '$q4_o' ,
                        p1_edu = '$q5' ,
                        p1_healthstaff = '$q6' ,
                        p1_job = '$q7' ,
                        p1_job_other = '$q7_o' ,
                        p1_608_1 = '$q8_1' ,
                        p1_608_2 = '$q8_2',
                        p1_608_3 = '$q8_3',
                        p1_608_4 = '$q8_4',
                        p1_608_5 = '$q8_5',
                        p1_608_6 = '$q8_6',
                        p1_608_7 = '$q8_7',
                        p1_608_8 = '$q8_8',
                        p1_608_9 = '$q8_9',
                        p1_screen = '$q9',
                        p1_screen_1_1 = '$q9_1',
                        p1_screen_1_2 = '$q9_2',
                        p1_screen_1_3 = '$q9_3',
                        p1_screen_2_1 = '$q9_4',
                        p1_screen_2_2 = '$q9_5',
                        p1_screen_2_3 = '$q9_6',
                        p1_screen_2_4 = '$q9_6',
                        p1_isolate = '$q10',
                        p1_isolate_dd = '$q10_dd',
                        p1_isolate_mm = '$q10_mm',
                        p1_isolate_yy = '$q10_yy',
                        p1_isolate_score = '$q10_score',
                        p1_diag = '$q11',
                        p1_diag_dd = '$q11_dd',
                        p1_diag_mm = '$q11_mm',
                        p1_diag_yy = '$q11_yy',
                        p1_diag_score = '$q11_score',
                        p1_udatetime = '$datetime'
                        WHERE p1_code = '$uid'
                         ";
            $resUpdate = $db->execute($strSQL);

            $strSQL = "SELECT * FROM rsf6x_form_finish WHERE ff_code = '$uid'";
            $res = $db->fetch($strSQL, false, false);
            if($res){
                $strSQL = "UPDATE rsf6x_form_finish SET ff_f1 = 'Y', ff_udatetime = '$datetime' WHERE ff_code = '$uid'";
                $resUpdate = $db->execute($strSQL);
                $return['status'] = 'Success'; 
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }else{
                $strSQL = "INSERT INTO rsf6x_form_finish (`ff_code`, `ff_f1`, `ff_udatetime`) VALUES ('$uid', 'Y', '$datetime')";
                $resInsert = $db->insert($strSQL, false);
                $return['status'] = 'Success'; 
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }

        }else{
            $strSQL = "INSERT INTO rsf6x_form_p1 
                      (
                        `p1_code`, `p1_area`, `pt_tambon`, `p1_gender`, `p1_age`, 
                        `p1_rel`, `p1_rel_other`, `p1_edu`, `p1_healthstaff`, `p1_job`, `p1_job_other`, `p1_608_1`, 
                        `p1_608_2`, `p1_608_3`, `p1_608_4`, `p1_608_5`, `p1_608_6`, 
                        `p1_608_7`, `p1_608_8`, `p1_608_9`, `p1_screen`, `p1_screen_1_1`, 
                        `p1_screen_1_2`, `p1_screen_1_3`, `p1_screen_2_1`, `p1_screen_2_2`, `p1_screen_2_3`, 
                        `p1_screen_2_4`, `p1_isolate`, `p1_isolate_dd`, `p1_isolate_mm`, `p1_isolate_yy`, 
                        `p1_isolate_score`, `p1_diag`, `p1_diag_dd`, `p1_diag_mm`, `p1_diag_yy`, 
                        `p1_diag_score`, `p1_rdatetime`, `p1_udatetime`
                      )
                      VALUES (
                        '$uid', '$q1', '$q1_o', '$q2', '$q3', 
                        '$q4', '$q4_o', '$q5', '$q6', '$q7', '$q8_1', 
                        '$q8_2', '$q8_3', '$q8_4', '$q8_5', '$q8_6', 
                        '$q8_7', '$q8_8', '$q8_9', '$q9', '$q9_1', 
                        '$q9_2', '$q9_3', '$q9_4', '$q9_5', '$q9_6', 
                        '$q9_7', '$q10', '$q10_dd', '$q10_mm', '$q10_yy', 
                        '$q10_score', '$q11', '$q11_dd', '$q11_mm', '$q11_yy', 
                        '$q11_score', '$datetime', '$datetime'
                      )
                      ";
            $resInsert = $db->insert($strSQL, false);
            if($res){
                $strSQL = "SELECT * FROM rsf6x_form_finish WHERE ff_code = '$uid'";
                $res = $db->fetch($strSQL, false, false);
                if($res){
                    $strSQL = "UPDATE rsf6x_form_finish SET ff_f1 = 'Y', ff_udatetime = '$datetime' WHERE ff_code = '$uid'";
                    $resUpdate = $db->execute($strSQL);
                    $return['status'] = 'Success'; 
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                }else{
                    $strSQL = "INSERT INTO rsf6x_form_finish (`ff_code`, `ff_f1`, `ff_udatetime`) VALUES ('$uid', 'Y', '$datetime')";
                    $resInsert = $db->insert($strSQL, false);
                    $return['status'] = 'Success'; 
                    echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
                }
            }else{
                $return['status'] = 'Fail';  $return['error_message'] = 'Can not create record';
                echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
            }
        }
        break ;
    case 'save_part_2':
        if(!isset($_REQUEST['uid'])){
            $return['status'] = 'Fail';  $return['error_message'] = 'In-complete parameter';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }
        
        $uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
        $q1 = mysqli_real_escape_string($conn, $_REQUEST['q1']);
        $q2 = mysqli_real_escape_string($conn, $_REQUEST['q2']);
        $q3_1 = mysqli_real_escape_string($conn, $_REQUEST['q3_1']);
        $q3_2 = mysqli_real_escape_string($conn, $_REQUEST['q3_2']);
        $q3_3 = mysqli_real_escape_string($conn, $_REQUEST['q3_3']);
        $q3_4 = mysqli_real_escape_string($conn, $_REQUEST['q3_4']);
        $q3_5 = mysqli_real_escape_string($conn, $_REQUEST['q3_5']);
        $q3_6 = mysqli_real_escape_string($conn, $_REQUEST['q3_6']);
        $q4_1 = mysqli_real_escape_string($conn, $_REQUEST['q4_1']);
        $q4_2 = mysqli_real_escape_string($conn, $_REQUEST['q4_2']);
        $q4_3 = mysqli_real_escape_string($conn, $_REQUEST['q4_3']);
        $q4_4 = mysqli_real_escape_string($conn, $_REQUEST['q4_4']);
        $q4_5 = mysqli_real_escape_string($conn, $_REQUEST['q4_5']);
        $q4_6 = mysqli_real_escape_string($conn, $_REQUEST['q4_6']);
        $q4_7 = mysqli_real_escape_string($conn, $_REQUEST['q4_7']);
        $q4_8 = mysqli_real_escape_string($conn, $_REQUEST['q4_8']);
        $q4_9 = mysqli_real_escape_string($conn, $_REQUEST['q4_9']);
        $q4_10 = mysqli_real_escape_string($conn, $_REQUEST['q4_10']);
        $q4_11 = mysqli_real_escape_string($conn, $_REQUEST['q4_11']);
        $q4_12 = mysqli_real_escape_string($conn, $_REQUEST['q4_12']);
        $q5_1 = mysqli_real_escape_string($conn, $_REQUEST['q5_1']);
        $q5_2 = mysqli_real_escape_string($conn, $_REQUEST['q5_2']);
        $q5_3 = mysqli_real_escape_string($conn, $_REQUEST['q5_3']);
        $q5_4 = mysqli_real_escape_string($conn, $_REQUEST['q5_4']);
        $q5_5 = mysqli_real_escape_string($conn, $_REQUEST['q5_5']);
        $q5_6 = mysqli_real_escape_string($conn, $_REQUEST['q5_6']);
        $q5_7 = mysqli_real_escape_string($conn, $_REQUEST['q5_7']);
        $q5_other = mysqli_real_escape_string($conn, $_REQUEST['q5_other']);
        $q6 = mysqli_real_escape_string($conn, $_REQUEST['q6']);
        $q7 = mysqli_real_escape_string($conn, $_REQUEST['q7']);
        $q8 = mysqli_real_escape_string($conn, $_REQUEST['q8']);
        $q9_1 = mysqli_real_escape_string($conn, $_REQUEST['q9_1']);
        $q9_2 = mysqli_real_escape_string($conn, $_REQUEST['q9_2']);
        $q9_3 = mysqli_real_escape_string($conn, $_REQUEST['q9_3']);
        $q9_4 = mysqli_real_escape_string($conn, $_REQUEST['q9_4']);
        $q9_5 = mysqli_real_escape_string($conn, $_REQUEST['q9_5']);
        $q9_6 = mysqli_real_escape_string($conn, $_REQUEST['q9_6']);
        $q9_7 = mysqli_real_escape_string($conn, $_REQUEST['q9_7']);
        $q9_8 = mysqli_real_escape_string($conn, $_REQUEST['q9_8']);
        $q9_9 = mysqli_real_escape_string($conn, $_REQUEST['q9_9']);
        $q9_10 = mysqli_real_escape_string($conn, $_REQUEST['q9_10']);
        $q9_11 = mysqli_real_escape_string($conn, $_REQUEST['q9_11']);
        $q9_12 = mysqli_real_escape_string($conn, $_REQUEST['q9_12']);
        $q9_13 = mysqli_real_escape_string($conn, $_REQUEST['q9_13']);
        $q9_14 = mysqli_real_escape_string($conn, $_REQUEST['q9_14']);
        $q9_15 = mysqli_real_escape_string($conn, $_REQUEST['q9_15']);
        $q9_16 = mysqli_real_escape_string($conn, $_REQUEST['q9_16']);
        $q9_17 = mysqli_real_escape_string($conn, $_REQUEST['q9_17']);
        $q9_18 = mysqli_real_escape_string($conn, $_REQUEST['q9_18']);
        $q9_19 = mysqli_real_escape_string($conn, $_REQUEST['q9_19']);
        $q9_20 = mysqli_real_escape_string($conn, $_REQUEST['q9_20']);
        $q9_21 = mysqli_real_escape_string($conn, $_REQUEST['q9_21']);
        $q9_other = mysqli_real_escape_string($conn, $_REQUEST['q9_other']);
        $q10_1 = mysqli_real_escape_string($conn, $_REQUEST['q10_1']);
        $q10_2 = mysqli_real_escape_string($conn, $_REQUEST['q10_2']);
        $q10_3 = mysqli_real_escape_string($conn, $_REQUEST['q10_3']);
        $q10_4 = mysqli_real_escape_string($conn, $_REQUEST['q10_4']);
        $q10_5 = mysqli_real_escape_string($conn, $_REQUEST['q10_5']);
        $q10_6 = mysqli_real_escape_string($conn, $_REQUEST['q10_6']);
        $q10_7 = mysqli_real_escape_string($conn, $_REQUEST['q10_7']);
        $q10_8 = mysqli_real_escape_string($conn, $_REQUEST['q10_8']);
        $q10_9 = mysqli_real_escape_string($conn, $_REQUEST['q10_9']);
        $q10_10 = mysqli_real_escape_string($conn, $_REQUEST['q10_10']);
        $q10_11 = mysqli_real_escape_string($conn, $_REQUEST['q10_11']);
        $q10_12 = mysqli_real_escape_string($conn, $_REQUEST['q10_12']);
        $q10_13 = mysqli_real_escape_string($conn, $_REQUEST['q10_13']);
        $q10_14 = mysqli_real_escape_string($conn, $_REQUEST['q10_14']);
        $q10_15 = mysqli_real_escape_string($conn, $_REQUEST['q10_15']);
        $q10_16 = mysqli_real_escape_string($conn, $_REQUEST['q10_16']);
        $q10_17 = mysqli_real_escape_string($conn, $_REQUEST['q10_17']);
        $q10_18 = mysqli_real_escape_string($conn, $_REQUEST['q10_18']);
        $q10_19 = mysqli_real_escape_string($conn, $_REQUEST['q10_19']);
        $q10_20 = mysqli_real_escape_string($conn, $_REQUEST['q10_20']);
        $q10_21 = mysqli_real_escape_string($conn, $_REQUEST['q10_21']);
        $q10_22 = mysqli_real_escape_string($conn, $_REQUEST['q10_22']);
        $q10_23 = mysqli_real_escape_string($conn, $_REQUEST['q10_23']);
        $q10_other = mysqli_real_escape_string($conn, $_REQUEST['q10_other']);
        $q11_1 = mysqli_real_escape_string($conn, $_REQUEST['q11_1']);
        $q11_2 = mysqli_real_escape_string($conn, $_REQUEST['q11_2']);
        $q11_3 = mysqli_real_escape_string($conn, $_REQUEST['q11_3']);
        $q11_4 = mysqli_real_escape_string($conn, $_REQUEST['q11_4']);
        $q11_5 = mysqli_real_escape_string($conn, $_REQUEST['q11_5']);
        $q11_6 = mysqli_real_escape_string($conn, $_REQUEST['q11_6']);

        $q5_8 = '0';
        if($q1 == '1'){
            if($q5_other != ''){
                $q5_8 = '1';
            }

            $q8 = 'na';
        }

        if($q1 == '2'){
            $q2 = '';
            $q3_1 = '0';
            $q3_2 = '0';
            $q3_3 = '0';
            $q3_4 = '0';
            $q3_5 = '0';
            $q3_6 = '0';

            $q4_1 = '0';
            $q4_2 = '0';
            $q4_3 = '0';
            $q4_4 = '0';
            $q4_5 = '0';
            $q4_6 = '0';
            $q4_7 = '0';
            $q4_8 = '0';
            $q4_9 = '0';
            $q4_10 = '0';
            $q4_11 = '0';
            $q4_12 = '0';

            $q5_1 = '0';
            $q5_2 = '0';
            $q5_3 = '0';
            $q5_4 = '0';
            $q5_5 = '0';
            $q5_6 = '0';
            $q5_7 = '0';
            $q5_other = '';
            $q6 = '';
            $q7 = '';
        }

        $strSQL = "SELECT 1 FROM rsf6x_form_p2 WHERE p2_code = '$uid'";
        $res = $db->fetch($strSQL, false, false);
        if($res){
            $strSQL = "UPDATE rsf6x_form_p2 SET p2_delete = 'Y' WHERE p2_code = '$uid'";
            $resUpdate = $db->execute($strSQL);
        }

        $strSQL = "INSERT INTO rsf6x_form_p2 
                    (
                    `p2_q1`, `p2_q2`, `p2_q3_1`, `p2_q3_2`, `p2_q3_3`, 
                    `p2_q3_4`, `p2_q3_5`, `p2_q3_6`, `p2_q4_1`, `p2_q4_2`, 
                    `p2_q4_3`, `p2_q4_4`, `p2_q4_5`, `p2_q4_6`, `p2_q4_7`, 
                    `p2_q4_8`, `p2_q4_9`, `p2_q4_10`, `p2_q4_11`, `p2_q4_12`, 
                    `p2_q5_1`, `p2_q5_2`, `p2_q5_3`, `p2_q5_4`, `p2_q5_5`, 
                    `p2_q5_6`, `p2_q5_7`, `p2_q5_8`, `p2_q5_8_i`, `p2_q6`, 
                    `p2_q7`, `p2_q8`, `p2_q9_1`, `p2_q9_2`, `p2_q9_3`, 
                    `p2_q9_4`, `p2_q9_5`, `p2_q9_6`, `p2_q9_7`, `p2_q9_8`, 
                    `p2_q9_9`, `p2_q9_10`, `p2_q9_11`, `p2_q9_12`, `p2_q9_13`, 
                    `p2_q9_14`, `p2_q9_15`, `p2_q9_16`, `p2_q9_17`, `p2_q9_18`, 
                    `p2_q9_19`, `p2_q9_20`, `p2_q9_21`, `p2_q9_22`, `p2_q10_1`, 
                    `p2_q10_2`, `p2_q10_3`, `p2_q10_4`, `p2_q10_5`, `p2_q10_6`, 
                    `p2_q10_7`, `p2_q10_8`, `p2_q10_9`, `p2_q10_10`, `p2_q10_11`, 
                    `p2_q10_12`, `p2_q10_13`, `p2_q10_14`, `p2_q10_15`, `p2_q10_16`, 
                    `p2_q10_17`, `p2_q10_18`, `p2_q10_19`, `p2_q10_20`, `p2_q10_21`, 
                    `p2_q10_22`, `p2_q10_23`, `p2_q10_24`, `p2_q11_1`, `p2_q11_2`, 
                    `p2_q11_3`, `p2_q11_4`, `p2_q11_5`, `p2_q11_6`, `p2_code`, 
                    `p2_rdatetime`, `p2_udatetime`
                    )
                    VALUES 
                    (
                    '$q1', '$q2', '$q3_1', '$q3_2', '$q3_3', 
                    '$q3_4', '$q3_5', '$q3_6', '$q4_1', '$q4_2', 
                    '$q4_3', '$q4_4', '$q4_5', '$q4_6', '$q4_7', 
                    '$q4_8', '$q4_9', '$q4_10', '$q4_11', '$q4_12', 
                    '$q5_1', '$q5_2', '$q5_3', '$q5_4', '$q5_5', 
                    '$q5_6', '$q5_7', '$q5_8', '$q5_other', '$q6', 
                    '$q7', '$q8', '$q9_1', '$q9_2', '$q9_3', 
                    '$q9_4', '$q9_5', '$q9_6', '$q9_7', '$q9_8', 
                    '$q9_9', '$q9_10', '$q9_11', '$q9_12', '$q9_13', 
                    '$q9_14', '$q9_15', '$q9_16', '$q9_17', '$q9_18', 
                    '$q9_19', '$q9_20', '$q9_21', '$q9_other', '$q10_1', 
                    '$q10_2', '$q10_3', '$q10_4', '$q10_5', '$q10_6', 
                    '$q10_7', '$q10_8', '$q10_9', '$q10_10', '$q10_11', 
                    '$q10_12', '$q10_13', '$q10_14', '$q10_15', '$q10_16', 
                    '$q10_17', '$q10_18', '$q10_19', '$q10_20', '$q10_21', 
                    '$q10_22', '$q10_23', '$q10_other', '$q11_1', '$q11_2', 
                    '$q11_3', '$q11_4', '$q11_5', '$q11_6', '$uid', 
                    '$datetime', '$datetime'
                    )
                    ";
        $resInsert = $db->insert($strSQL, false);
        // $return['status'] = $strSQL; 
        // echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();

        if($resInsert){

            $strSQL = "UPDATE rsf6x_form_finish SET ff_f2 = 'Y', ff_udatetime = '$datetime' WHERE ff_code = '$uid'";
            $resUpdate = $db->execute($strSQL);

            $return['status'] = 'Success'; 
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }else{
            $return['status'] = 'Fail';  $return['error_message'] = 'Can not create record';
            echo json_encode($return, JSON_PRETTY_PRINT); mysqli_close($conn); die();
        }
        break ;
    default:
        # code...
        break;
}
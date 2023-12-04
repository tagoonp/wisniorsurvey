<?php 
$session_id = $_SESSION[TB_PREFIX . 'id'];
$uid = $_SESSION[TB_PREFIX . 'uid'];
$role = $_SESSION[TB_PREFIX . 'role'];

// echo $uid;
// die(); 

$strSQL = "SELECT * FROM rsf6x_account WHERE uid = '$uid' AND active_status = 'Y' AND delete_status = 'N' AND allow_status = 'Y'";
$currentUser = $db->fetch($strSQL, false, false);
if($currentUser){

}else{

    // echo $strSQL;
    // die();
    unset($_SESSION[TB_PREFIX . 'id']);
    unset($_SESSION[TB_PREFIX . 'uid']);
    unset($_SESSION[TB_PREFIX . 'role']);
    session_destroy();
    header('Location: ' . ROOT_DOMAIN . '/login');
    die();
}
?>
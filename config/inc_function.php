<?php 
function show_thaidatetime($inputdatetime, $input_date_only, $output_date_only){
    $output = $inputdatetime;
    if(($input_date_only == false) && ($output_date_only)){
        $strYear = date("Y",strtotime($inputdatetime))+543;
		$strMonth= date("n",strtotime($inputdatetime));
		$strDay= date("j",strtotime($inputdatetime));
		$strHour= date("H",strtotime($inputdatetime));
		$strMinute= date("i",strtotime($inputdatetime));
		$strSeconds= date("s",strtotime($inputdatetime));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
        $output = "$strDay $strMonthThai $strYear";
    }
    return $output;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
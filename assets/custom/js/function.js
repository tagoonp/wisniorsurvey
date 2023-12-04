function is_empty_input($input_arr){
    $check = 0;
    $('.form-control').removeClass('is-invalid')
    $input_arr.forEach(i => {
        if($('#' + i).val() == ''){ $check ++; $('#' + i).addClass('is-invalid') }
    });
    return $check;
}
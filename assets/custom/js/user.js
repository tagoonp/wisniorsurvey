var user = {
    create(){
        $input_arr = Array('txtFullname', 'txtEmail', 'txtPassword')
        $i = is_empty_input($input_arr);
        if($i != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            fullname: $('#txtFullname').val(),
            email: $('#txtEmail').val(),
            password: $('#txtPassword').val()
        }
        preload.show()
        var jxr = $.post(api + 'admin?stage=create_account', param, function(){}, 'json')
                     .always(function(snap){
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            if(snap.error_message == 'Duplicate'){
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'อีเมลนี้เคยถูกใช้งานแล้ว',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                            }else{
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                            }
                        }
                     })
    },
    delete(target_uid){
        var param = {
            uid: $('#txtUid').val(),
            target_uid: target_uid
        }
        preload.show()
        var jxr = $.post(api + 'admin?stage=delete_account', param, function(){}, 'json')
                     .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location.reload()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                     })
    },
    update(){

    },
    toggleStatus(target_uid, param_name){
        var param = {
            uid: $('#txtUid').val(),
            target_uid: target_uid,
            param_name: param_name
        }
        preload.show()
        var jxr = $.post(api + 'admin?stage=update_param', param, function(){}, 'json')
                     .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            preload.hide()
                        }else{
                            preload.hide()
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                        }
                     })
    }
}
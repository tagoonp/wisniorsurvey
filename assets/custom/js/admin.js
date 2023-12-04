var admin = {
    toggle_role(param_key, target_uid){
        var param = {
            uid: $("#txtUid").val(),
            role: $("#txtRole").val(),
            target_uid: target_uid,
            param_key: param_key
        }
        var jxr = $.post(api + 'admin?stage=toggle_param', param, function(){}, 'json')
                   .always(function(snap){ console.log(snap); })
    },
    delete_account(target_uid){
        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f24141',
            cancelButtonColor: '#dbdbdb',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            allowOutsideClick: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var param = {
                    uid: $("#txtUid").val(),
                    role: $("#txtRole").val(),
                    target_uid: target_uid
                }
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
            }
        })
    },
    openModal(menu_id, a, b, c, d){
        if(menu_id == 'modalUpdateMenu'){
            $('#' + menu_id).modal('show')
            $('#txtMenuIdU').val(a)
            $('#txtMenuTitleU').val(b)
            $('#txtUrlU').val(c)
            $('#txtTargetU').val(d)
        }else{
            $('#' + menu_id).modal('show')
        }
    },
    update_menu(){
        $input_arr = Array('txtMenuIdU', 'txtMenuTitleU', 'txtUrlU', 'txtTargetU')
        $i = is_empty_input($input_arr);
        if($i != 0){ return ;}
        var param = {
            uid: $('#txtUid').val(),
            menu_id: $('#txtMenuIdU').val(),
            title: $('#txtMenuTitleU').val(),
            url: $('#txtUrlU').val(),
            open_target: $('#txtTargetU').val()
        }
        preload.show()
        var jxr = $.post(api + 'admin?stage=update_menu', param, function(){}, 'json')
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
    delete_menu(menu_id){
        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "ท่านต้องการลบเมนูนี้ใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f24141',
            cancelButtonColor: '#dbdbdb',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            allowOutsideClick: false,
        }).then(function (result) {
            if (result.value) {
                var param = {
                    uid: $("#txtUid").val(),
                    menu_id: menu_id
                }
                preload.show()
                var jxr = $.post(api + 'admin?stage=delete_menu', param, function(){}, 'json')
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
            }
        })
    }
}
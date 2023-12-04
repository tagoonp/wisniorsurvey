var staff = {
    create_quali_record(){
        $('.form-control').removeClass('dn')
        if($('#txtKey').val() == ''){
            $('#txtKey').addClass('is-invalid')
            return ;
        }
        preload.show()
        var param = {
            uid: $("#txtUid").val(),
            role: $("#txtRole").val(),
            record_title: $('#txtKey').val()
        }
        var jxr = $.post(api + 'staff?stage=create_quali_record', param, function(){}, 'json')
                    .always(function(snap){
                        console.log(snap);
                        if(snap.status == 'Success'){
                            window.location = 'app-manage-dataset?id=' + snap.return_id
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
    update_dataset(){
        $('.form-control').removeClass('is-invalid')
        if($('#txtKey').val() == ''){
            Swal.fire({
                icon: "warning",
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            $('#txtKey').addClass('is-invalid');
            return ;
        }

        var param = {
            uid: $("#txtUid").val(),
            role: $("#txtRole").val(),
            ds_id: $('#txtDataId').val(),
            key: $('#txtKey').val(),
            detail: $('#txtDetail').val()
        }

        console.log(param);

        preload.show()

        var jxr = $.post(api + 'staff?stage=update_dataset', param, function(){}, 'json')
                           .always(function(snap){
                                console.log(snap);
                                if(snap.status == 'Success'){
                                    // window.location.reload()
                                    preload.hide()
                                    Swal.fire({
                                        title: 'สำเร็จ',
                                        text: "รายละเอียดชุดข้อมูลถูกบันทึกเรียบร้อยแล้ว",
                                        icon: 'success',
                                        showCancelButton: true,
                                        confirmButtonColor: '#f24141',
                                        cancelButtonColor: '#dbdbdb',
                                        confirmButtonText: 'กลับหน้ารายการ',
                                        cancelButtonText: 'อยู่หน้าเดิม',
                                        allowOutsideClick: false,
                                    }).then(function (result) {
                                        if (result.value) {
                                            window.location = './app-qualitative'
                                        }else{
                                            window.location.reload()
                                        }
                                    })
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
    delete_file(fid){
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
                    ds_id: $('#txtDataId').val(),
                    file_id: fid
                }
                var jxr = $.post(api + 'staff?stage=delete_file', param, function(){}, 'json')
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
    delete_dataset(ds_id){
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
                    ds_id: ds_id
                }
                var jxr = $.post(api + 'staff?stage=delete_dataset', param, function(){}, 'json')
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
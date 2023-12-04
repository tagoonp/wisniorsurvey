var authen = {
    form_start(){
        $check = 0;
        $('form-control').removeClass('is-invalid')
        if($("#txtId").val() == ''){
            $("#txtId").addClass('is-invalid')
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: 'กรุณากรอกหมายเลขที่ได้รับจากจุดลงทะเบียน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }
        var param = {
            user_id: $('#txtId').val()
        }
        preload.show()
        var jxr = $.post(api + 'form?stage=create_session', param, function(){}, 'json')
                    .always(function(snap){
                    if(snap.status == 'Success'){
                        window.location = snap.return_page + '?rid=' + $("#txtId").val() + '&session_id=' + snap.session_id + '&record_id=' + snap.record_id
                    }else{
                        preload.hide()
                        Swal.fire({
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถดำเนินการได้ กรุณาติดต่อเจ้าหน้าที่',
                            confirmButtonClass: 'btn btn-danger',
                        })
                    }
                    })
    },
    signup(){
        $check = 0; $('.form-control').removeClass('is-invalid')
        if($('#txtEmail').val() == ''){ $check++; $('#txtEmail').addClass('is-invalid')}
        if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid')}
        if($('#txtPassword2').val() == ''){ $check++; $('#txtPassword2').addClass('is-invalid')}
        if($('#txtFname').val() == ''){ $check++; $('#txtFname').addClass('is-invalid')}

        if($check != 0){
            Swal.fire({
                title: 'ไม่สามารถดำเนินการได้',
                text: "กรุณาข้อมูลให้ครบถ้วน",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#f24141',
                cancelButtonColor: '#dbdbdb',
                confirmButtonText: 'ลองใหม่',
                cancelButtonText: 'ยกเลิก',
                allowOutsideClick: false,
              }).then(function (result) {
                if (result.value) {

                }
              })
            return ;
        }
        if($('#txtPassword').val() != $('#txtPassword2').val()){ 
            $('#txtPassword2').addClass('is-invalid')
            Swal.fire({
                title: 'ไม่สามารถดำเนินการได้',
                text: "รหัสผ่านที่ตั้งไม่ตรงกัน",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#f24141',
                cancelButtonColor: '#dbdbdb',
                confirmButtonText: 'ลองใหม่',
                cancelButtonText: 'ยกเลิก',
                allowOutsideClick: false,
              }).then(function (result) {
                if (result.value) {

                }
              })
            return ;
        }
        var param = {
            username: $('#txtEmail').val(),
            password: $('#txtPassword').val(),
            fullname: $('#txtFname').val(),
            phone: $('#txtPhone').val() 
        }
        preload.show()
        var jxr = $.post(api + 'authen?stage=common_signup', param, function(){}, 'json')
                    .always(function(snap){
                    console.log(snap);
                    if(snap.status == 'Success'){
                        window.location = './'
                    }else{
                        preload.hide()
                        Swal.fire({
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่พบบัญชีผู้ใช้งานหรือบัญชีผู้ใช้งานไม่ถูกต้อง',
                            confirmButtonClass: 'btn btn-danger',
                        })
                    }
                    })
    },
    signin(){
        $check = 0; $('.form-control').removeClass('is-invalid')
        if($('#txtUsername').val() == ''){ $check++; $('#txtUsername').addClass('is-invalid')}
        if($('#txtPassword').val() == ''){ $check++; $('#txtPassword').addClass('is-invalid')}
        if($check != 0){
            Swal.fire({
                title: 'ไม่สามารถดำเนินการได้',
                text: "กรุณาข้อมูลให้ครบถ้วน",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#f24141',
                cancelButtonColor: '#dbdbdb',
                confirmButtonText: 'ลองใหม่',
                cancelButtonText: 'ยกเลิก',
                allowOutsideClick: false,
              }).then(function (result) {
                if (result.value) {
                  $('#txtUsername').focus()
                }else{
                  return ;
                }
              })
            return ;
        }
        var param = {
            username: $('#txtUsername').val(),
            password: $('#txtPassword').val()
        }
        preload.show()
        var jxr = $.post(api + 'authen?stage=signin', param, function(){}, 'json')
                    .always(function(snap){
                    console.log(snap);
                    if(snap.status == 'Success'){
                        window.location = './'
                    }else{
                        preload.hide()
                        Swal.fire({
                            icon: "error",
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่พบบัญชีผู้ใช้งานหรือบัญชีผู้ใช้งานไม่ถูกต้อง',
                            confirmButtonClass: 'btn btn-danger',
                        })
                    }
                    })
    },
    signout(){
        var param = {
            uid: $('#txtUid').val(), 
            sid: $('#txtSid').val(), 
            role: $('#txtRole').val()
        }
        var jxr = $.post(api + 'authen?stage=signout', param, function(){}, 'json')
        window.location = '../../'
    },
    switchrole(torole){
        var param = {
            uid: $('#txtUid').val(), 
            sid: $('#txtSid').val(), 
            role: torole
        }
        var jxr = $.post(api + 'authen?stage=switchrole', param, function(){}, 'json')
                   .always(function(snap){
                    if(snap.status == 'Success'){
                        window.location.reload()
                    }else{
                        alert('Error')
                    }
                   })


                
    }
}
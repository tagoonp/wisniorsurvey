var articleContent = ''
// Full Toolbar
// --------------------------------------------------------------------
const fullToolbar = [
    [
        {
        font: []
        },
        {
        size: []
        }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
        {
        color: []
        },
        {
        background: []
        }
    ],
    [
        {
        script: 'super'
        },
        {
        script: 'sub'
        }
    ],
    [
        {
        header: '1'
        },
        {
        header: '2'
        },
        {
        header: '3'
        },
        {
        header: '4'
        },
        'blockquote',
        'code-block'
    ],
    [
        {
        list: 'ordered'
        },
        {
        list: 'bullet'
        },
        {
        indent: '-1'
        },
        {
        indent: '+1'
        }
    ],
    [{ direction: 'rtl' }],
    ['link', 'image', 'video', 'formula'],
    [{ 'align': [] }],
    ['clean']
];

if($('#full-editor').length){
    articleContent = new Quill('#full-editor', {
        bounds: '#full-editor',
        placeholder: 'Type Something...',
        modules: {
            imageResize: {
            displaySize: true
            },
            formula: true,
            toolbar: fullToolbar,
        },
        theme: 'snow'
    });

}

var content = {
    create(content_type){
        if(content_type == 'page'){
            $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtTitle").val() == ''){ $("#txtTitle").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($("#txtRedirect").val() == ''){ $("#txtRedirect").addClass('is-invalid'); $check++; }
            if($("#txtFullscreen").val() == ''){ $("#txtFullscreen").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }
            if($("#txtRedirect").val() == 'Y'){
                if($("#txtRedirectUrl").val() == ''){ 
                    $("#txtRedirectUrl").addClass('is-invalid');
                    Swal.fire({
                        icon: "error",
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณากรอก URL',
                        confirmButtonClass: 'btn btn-danger',
                    })
                    return ;
                }
            }

            var param = {
                uid: $('#txtUid').val(),
                title: $('#txtTitle').val(),
                category: $('#txtCategory').val(),
                redirect_status: $('#txtRedirect').val(),
                redirect_url: $('#txtRedirectUrl').val(),
                fullscreen_status: $('#txtFullscreen').val(),
                tags: $('#txtTag').val(),
                pdf: $('#txtPdf').val(),
                figure: $('#txtImage').val(),
                content: articleContent.root.innerHTML,
                content_type: 'page'
            }

            preload.show()

            var hxr = $.post(api + 'content?stage=create', param, function(){}, 'json')
                       .always(function(snap){
                            console.log(snap);
                            if(snap.status == 'Success'){
                                window.location = './app-page-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
        }else{
            $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtTitle").val() == ''){ $("#txtTitle").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($("#txtRedirect").val() == ''){ $("#txtRedirect").addClass('is-invalid'); $check++; }
            if($("#txtFullscreen").val() == ''){ $("#txtFullscreen").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }
            if($("#txtRedirect").val() == 'Y'){
                if($("#txtRedirectUrl").val() == ''){ 
                    $("#txtRedirectUrl").addClass('is-invalid');
                    Swal.fire({
                        icon: "error",
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณากรอก URL',
                        confirmButtonClass: 'btn btn-danger',
                    })
                    return ;
                }
            }

            var param = {
                uid: $('#txtUid').val(),
                title: $('#txtTitle').val(),
                category: $('#txtCategory').val(),
                redirect_status: $('#txtRedirect').val(),
                redirect_url: $('#txtRedirectUrl').val(),
                fullscreen_status: $('#txtFullscreen').val(),
                tags: $('#txtTag').val(),
                pdf: $('#txtPdf').val(),
                figure: $('#txtImage').val(),
                content: articleContent.root.innerHTML,
                content_type: 'post',
                album_id: $('#txtAlbum').val()
            }

            preload.show()

            var hxr = $.post(api + 'content?stage=create', param, function(){}, 'json')
                       .always(function(snap){
                            console.log(snap);
                            if(snap.status == 'Success'){
                                window.location = './app-post-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
        }
    },
    update(content_type){
        if(content_type == 'page'){
            $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtTitle").val() == ''){ $("#txtTitle").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($("#txtRedirect").val() == ''){ $("#txtRedirect").addClass('is-invalid'); $check++; }
            if($("#txtFullscreen").val() == ''){ $("#txtFullscreen").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }
            if($("#txtRedirect").val() == 'Y'){
                if($("#txtRedirectUrl").val() == ''){ 
                    $("#txtRedirectUrl").addClass('is-invalid');
                    Swal.fire({
                        icon: "error",
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณากรอก URL',
                        confirmButtonClass: 'btn btn-danger',
                    })
                    return ;
                }
            }

            var param = {
                uid: $('#txtUid').val(),
                content_id: $('#txtContentId').val(),
                title: $('#txtTitle').val(),
                category: $('#txtCategory').val(),
                redirect_status: $('#txtRedirect').val(),
                redirect_url: $('#txtRedirectUrl').val(),
                fullscreen_status: $('#txtFullscreen').val(),
                tags: $('#txtTag').val(),
                pdf: $('#txtPdf').val(),
                figure: $('#txtImage').val(),
                content: articleContent.root.innerHTML,
                content_type: 'page',
                gallery_id: $('#txtAlbum').val()
            }

            preload.show()

            console.log(param);

            var hxr = $.post(api + 'content?stage=update', param, function(){}, 'json')
                       .always(function(snap){
                            console.log(snap);
                            // return ;
                            if(snap.status == 'Success'){
                                window.location = './app-page-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
        }else{ // Post
            $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtTitle").val() == ''){ $("#txtTitle").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($("#txtRedirect").val() == ''){ $("#txtRedirect").addClass('is-invalid'); $check++; }
            if($("#txtFullscreen").val() == ''){ $("#txtFullscreen").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }
            if($("#txtRedirect").val() == 'Y'){
                if($("#txtRedirectUrl").val() == ''){ 
                    $("#txtRedirectUrl").addClass('is-invalid');
                    Swal.fire({
                        icon: "error",
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณากรอก URL',
                        confirmButtonClass: 'btn btn-danger',
                    })
                    return ;
                }
            }

            var param = {
                uid: $('#txtUid').val(),
                content_id: $('#txtContentId').val(),
                title: $('#txtTitle').val(),
                category: $('#txtCategory').val(),
                redirect_status: $('#txtRedirect').val(),
                redirect_url: $('#txtRedirectUrl').val(),
                fullscreen_status: $('#txtFullscreen').val(),
                tags: $('#txtTag').val(),
                pdf: $('#txtPdf').val(),
                figure: $('#txtImage').val(),
                content: articleContent.root.innerHTML,
                content_type: 'post',
                gallery_id: $('#txtAlbum').val()
            }

            preload.show()

            console.log(param);

            var hxr = $.post(api + 'content?stage=update', param, function(){}, 'json')
                       .always(function(snap){
                            if(snap.status == 'Success'){
                                window.location = './app-post-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
        }
    },
    create_person(){
        $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtFullname").val() == ''){ $("#txtFullname").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }

        var param = {
            uid: $('#txtUid').val(),
            fullname: $('#txtFullname').val(),
            position: $('#txtPosition').val(),
            category: $('#txtCategory').val(),
            detail: articleContent.root.innerHTML,
            image: $('#txtImage').val()
        }
        console.log(param);
        preload.show()
        var hxr = $.post(api + 'content?stage=create_person', param, function(){}, 'json')
                       .always(function(snap){
                            console.log(snap);
                            // return ;
                            if(snap.status == 'Success'){
                                window.location = './app-person-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
    },
    delete(cont_id){
        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "ท่านต้องการสร้างรายการสินค้าที่คล้ายคลึงกับสินค้าชิ้นนี้ใช่หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f24141',
            cancelButtonColor: '#dbdbdb',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            allowOutsideClick: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var param = {
                    uid: $("#txtUid").val(),
                    content_id: cont_id
                }
                var jxr = $.post(api + 'content?stage=delete', param, function(){}, 'json')
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
    person_delete(per_id){
        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "ท่านต้องลบบุคคลนี้ใช่หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f24141',
            cancelButtonColor: '#dbdbdb',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก',
            allowOutsideClick: false,
        }).then(function (result) {
            if (result.value) {
                preload.show()
                var param = {
                    uid: $("#txtUid").val(),
                    per_id: per_id
                }
                var jxr = $.post(api + 'content?stage=person_delete', param, function(){}, 'json')
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
    update_person(){
        $check = 0
            $('.form-control').removeClass('is-invalid')
            if($("#txtFullname").val() == ''){ $("#txtFullname").addClass('is-invalid'); $check++; }
            if($("#txtCategory").val() == ''){ $("#txtCategory").addClass('is-invalid'); $check++; }
            if($check != 0){
                Swal.fire({
                    icon: "error",
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    confirmButtonClass: 'btn btn-danger',
                })
                return ;
            }

        var param = {
            uid: $('#txtUid').val(),
            per_id: $('#txtContentId').val(),
            fullname: $('#txtFullname').val(),
            position: $('#txtPosition').val(),
            category: $('#txtCategory').val(),
            detail: articleContent.root.innerHTML,
            image: $('#txtImage').val()
        }
        console.log(param);
        // return ;
        preload.show()
        var hxr = $.post(api + 'content?stage=update_person', param, function(){}, 'json')
                       .always(function(snap){
                            console.log(snap);
                            // return ;
                            if(snap.status == 'Success'){
                                window.location = './app-person-list'
                            }else{
                                preload.hide()
                                Swal.fire({
                                    icon: "error",
                                    title: 'เกิดข้อผิดพลาด',
                                    text: 'ไม่สามารถดำเนินการได้',
                                    confirmButtonClass: 'btn btn-danger',
                                })
                                return ;
                            }
                       })
    }
}

function deleteImage(id){
    Swal.fire({
          title: 'ยืนยันดำเนินการ',
          text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f24141',
          cancelButtonColor: '#dbdbdb',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก',
          allowOutsideClick: false,
      }).then(function (result) {
          if (result.value) {
              preload.show()
              var param = {
                  uid: $("#txtUid").val(),
                  image_id: id
              }
              var jxr = $.post(api + 'content?stage=delete_album_image', param, function(){}, 'json')
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

  function deleteAlbum(id){
    Swal.fire({
          title: 'ยืนยันดำเนินการ',
          text: "หากลบแล้วจะไม่สามารถนำกลับมาได้อีก",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#f24141',
          cancelButtonColor: '#dbdbdb',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก',
          allowOutsideClick: false,
      }).then(function (result) {
          if (result.value) {
              preload.show()
              var param = {
                  uid: $("#txtUid").val(),
                  album_id: id
              }
              var jxr = $.post(api + 'content?stage=delete_album', param, function(){}, 'json')
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

  function openModal(modal_id){
    console.log(modal_id);
    $('#' + modal_id).modal('show')
    return ;
  }

  function selectAlbum(){
    var q1 = $('input[name="imageAlbum"]:checked').val();
    $('#txtAlbum').val(q1)
    $('#modalAlbum').modal('hide')
  }
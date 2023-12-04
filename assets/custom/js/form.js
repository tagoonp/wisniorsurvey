
var sliderPips_1; var sliderPips_2;
if($('#slider-pips-1').length){
    sliderPips_1 = document.getElementById('slider-pips-1');
    if (sliderPips_1) {
        noUiSlider.create(sliderPips_1, {
        start: [5],
        behaviour: 'tap-drag',
        step: 1,
        tooltips: true,
        range: {
            min: 1,
            max: 10
        },
        pips: {
            mode: 'steps',
            stepped: true,
            density: 10
        },
        direction: isRtl ? 'rtl' : 'ltr'
        });
    }
    
    sliderPips_2 = document.getElementById('slider-pips-2');
    if (sliderPips_2) {
        noUiSlider.create(sliderPips_2, {
        start: [5],
        behaviour: 'tap-drag',
        step: 1,
        tooltips: true,
        range: {
            min: 1,
            max: 10
        },
        pips: {
            mode: 'steps',
            stepped: true,
            density: 10
        },
        direction: isRtl ? 'rtl' : 'ltr'
        });
    }
}



var form_par = {
    save_part_2(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')
        $err_arr = [];

        $q1 = $("input[name='txtQ1']:checked").val();
        $q2 = $("input[name='txtQ2']:checked").val();
        $q6 = $("input[name='txtQ6']:checked").val();
        $q7 = $("input[name='txtQ7']:checked").val();
        $q8 = $("input[name='txtQ8']:checked").val();
        $q11_1 = $("input[name='txtQ11']:checked").val();
        $q11_2 = $("input[name='txtQ12']:checked").val();
        $q11_3 = $("input[name='txtQ13']:checked").val();
        $q11_4 = $("input[name='txtQ14']:checked").val();
        $q11_5 = $("input[name='txtQ15']:checked").val();
        $q11_6 = $("input[name='txtQ16']:checked").val();

        if($q1 == 'na'){
            $check++;
            $err_arr.push('1')
        }else{
            if($q1 == '1'){
                if($q2 == 'na'){ $check++; $err_arr.push('2') }
                if($q6 == 'na'){ $check++;  $err_arr.push('6') }
                if($q7 == 'na'){ $check++;  $err_arr.push('7') }
            }

            if($q1 == '2'){
                if($q8 == 'na'){ $check++;  $err_arr.push('8') }
            }
        }

        if($q11_1 == 'na'){ $check++;  $err_arr.push('11.1') }
        if($q11_2 == 'na'){ $check++;  $err_arr.push('11.2') }
        if($q11_3 == 'na'){ $check++;  $err_arr.push('11.3') }
        if($q11_4 == 'na'){ $check++;  $err_arr.push('11.4') }
        if($q11_5 == 'na'){ $check++;  $err_arr.push('11.5') }
        if($q11_6 == 'na'){ $check++;  $err_arr.push('11.6') }

        if($check != 0){
            console.log($err_arr);
            $err_str = $err_arr.join(', ')
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: 'ไม่สามารถดำเนินการได้ กรุณากรอกข้อมูลให้ครบถ้วน (ข้อ ' + $err_str + ')',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        $q3_1 = 0;
        $q3_2 = 0;
        $q3_3 = 0;
        $q3_4 = 0;
        $q3_5 = 0;
        $q3_6 = 0;

        if($('#confCheckbox3_1').is(':checked')){ $q3_1 = 1; }
        if($('#confCheckbox3_2').is(':checked')){ $q3_2 = 1; }
        if($('#confCheckbox3_3').is(':checked')){ $q3_3 = 1; }
        if($('#confCheckbox3_4').is(':checked')){ $q3_4 = 1; }
        if($('#confCheckbox3_5').is(':checked')){ $q3_5 = 1; }
        if($('#confCheckbox3_6').is(':checked')){ $q3_6 = 1; }

        $q4_1 = 0;
        $q4_2 = 0;
        $q4_3 = 0;
        $q4_4 = 0;
        $q4_5 = 0;
        $q4_6 = 0;
        $q4_7 = 0;
        $q4_8 = 0;
        $q4_9 = 0;
        $q4_10 = 0;
        $q4_11 = 0;
        $q4_12 = 0;

        if($('#confCheckbox4_1').is(':checked')){ $q4_1 = 1; }
        if($('#confCheckbox4_2').is(':checked')){ $q4_2 = 1; }
        if($('#confCheckbox4_3').is(':checked')){ $q4_3 = 1; }
        if($('#confCheckbox4_4').is(':checked')){ $q4_4 = 1; }
        if($('#confCheckbox4_5').is(':checked')){ $q4_5 = 1; }
        if($('#confCheckbox4_6').is(':checked')){ $q4_6 = 1; }
        if($('#confCheckbox4_7').is(':checked')){ $q4_7 = 1; }
        if($('#confCheckbox4_8').is(':checked')){ $q4_8 = 1; }
        if($('#confCheckbox4_9').is(':checked')){ $q4_9 = 1; }
        if($('#confCheckbox4_10').is(':checked')){ $q4_10 = 1; }
        if($('#confCheckbox4_11').is(':checked')){ $q4_11 = 1; }
        if($('#confCheckbox4_12').is(':checked')){ $q4_12 = 1; }

        $q5_1 = 0;
        $q5_2 = 0;
        $q5_3 = 0;
        $q5_4 = 0;
        $q5_5 = 0;
        $q5_6 = 0;
        $q5_7 = 0;

        if($('#confCheckbox5_1').is(':checked')){ $q5_1 = 1; }
        if($('#confCheckbox5_2').is(':checked')){ $q5_2 = 1; }
        if($('#confCheckbox5_3').is(':checked')){ $q5_3 = 1; }
        if($('#confCheckbox5_4').is(':checked')){ $q5_4 = 1; }
        if($('#confCheckbox5_5').is(':checked')){ $q5_5 = 1; }
        if($('#confCheckbox5_6').is(':checked')){ $q5_6 = 1; }
        if($('#confCheckbox5_7').is(':checked')){ $q5_7 = 1; }

        $q9_1 = 0;
        $q9_2 = 0;
        $q9_3 = 0;
        $q9_4 = 0;
        $q9_5 = 0;
        $q9_6 = 0;
        $q9_7 = 0;
        $q9_8 = 0;
        $q9_9 = 0;
        $q9_10 = 0;
        $q9_11 = 0;
        $q9_12 = 0;
        $q9_13 = 0;
        $q9_14 = 0;
        $q9_15 = 0;
        $q9_16 = 0;
        $q9_17 = 0;
        $q9_18 = 0;
        $q9_19 = 0;
        $q9_20 = 0;
        $q9_21 = 0;

        if($('#confCheckbox9_1').is(':checked')){ $q9_1 = 1; }
        if($('#confCheckbox9_2').is(':checked')){ $q9_2 = 1; }
        if($('#confCheckbox9_3').is(':checked')){ $q9_3 = 1; }
        if($('#confCheckbox9_4').is(':checked')){ $q9_4 = 1; }
        if($('#confCheckbox9_5').is(':checked')){ $q9_5 = 1; }
        if($('#confCheckbox9_6').is(':checked')){ $q9_6 = 1; }
        if($('#confCheckbox9_7').is(':checked')){ $q9_7 = 1; }
        if($('#confCheckbox9_8').is(':checked')){ $q9_8 = 1; }
        if($('#confCheckbox9_9').is(':checked')){ $q9_9 = 1; }
        if($('#confCheckbox9_10').is(':checked')){ $q9_10 = 1; }
        if($('#confCheckbox9_11').is(':checked')){ $q9_11 = 1; }
        if($('#confCheckbox9_12').is(':checked')){ $q9_12 = 1; }
        if($('#confCheckbox9_13').is(':checked')){ $q9_13 = 1; }
        if($('#confCheckbox9_14').is(':checked')){ $q9_14 = 1; }
        if($('#confCheckbox9_15').is(':checked')){ $q9_15 = 1; }
        if($('#confCheckbox9_16').is(':checked')){ $q9_16 = 1; }
        if($('#confCheckbox9_17').is(':checked')){ $q9_17 = 1; }
        if($('#confCheckbox9_18').is(':checked')){ $q9_18 = 1; }
        if($('#confCheckbox9_19').is(':checked')){ $q9_19 = 1; }
        if($('#confCheckbox9_20').is(':checked')){ $q9_20 = 1; }
        if($('#confCheckbox9_21').is(':checked')){ $q9_21 = 1; }

        $q10_1 = 0;
        $q10_2 = 0;
        $q10_3 = 0;
        $q10_4 = 0;
        $q10_5 = 0;
        $q10_6 = 0;
        $q10_7 = 0;
        $q10_8 = 0;
        $q10_9 = 0;
        $q10_10 = 0;
        $q10_11 = 0;
        $q10_12 = 0;
        $q10_13 = 0;
        $q10_14 = 0;
        $q10_15 = 0;
        $q10_16 = 0;
        $q10_17 = 0;
        $q10_18 = 0;
        $q10_19 = 0;
        $q10_20 = 0;
        $q10_21 = 0;
        $q10_22 = 0;
        $q10_23 = 0;

        if($('#confCheckbox10_1').is(':checked')){ $q10_1 = 1; }
        if($('#confCheckbox10_2').is(':checked')){ $q10_2 = 1; }
        if($('#confCheckbox10_3').is(':checked')){ $q10_3 = 1; }
        if($('#confCheckbox10_4').is(':checked')){ $q10_4 = 1; }
        if($('#confCheckbox10_5').is(':checked')){ $q10_5 = 1; }
        if($('#confCheckbox10_6').is(':checked')){ $q10_6 = 1; }
        if($('#confCheckbox10_7').is(':checked')){ $q10_7 = 1; }
        if($('#confCheckbox10_8').is(':checked')){ $q10_8 = 1; }
        if($('#confCheckbox10_9').is(':checked')){ $q10_9 = 1; }
        if($('#confCheckbox10_10').is(':checked')){ $q10_10 = 1; }
        if($('#confCheckbox10_11').is(':checked')){ $q10_11 = 1; }
        if($('#confCheckbox10_12').is(':checked')){ $q10_12 = 1; }
        if($('#confCheckbox10_13').is(':checked')){ $q10_13 = 1; }
        if($('#confCheckbox10_14').is(':checked')){ $q10_14 = 1; }
        if($('#confCheckbox10_15').is(':checked')){ $q10_15 = 1; }
        if($('#confCheckbox10_16').is(':checked')){ $q10_16 = 1; }
        if($('#confCheckbox10_17').is(':checked')){ $q10_17 = 1; }
        if($('#confCheckbox10_18').is(':checked')){ $q10_18 = 1; }
        if($('#confCheckbox10_19').is(':checked')){ $q10_19 = 1; }
        if($('#confCheckbox10_20').is(':checked')){ $q10_20 = 1; }
        if($('#confCheckbox10_21').is(':checked')){ $q10_21 = 1; }
        if($('#confCheckbox10_22').is(':checked')){ $q10_22 = 1; }
        if($('#confCheckbox10_23').is(':checked')){ $q10_23 = 1; }

        var param = {
            uid: $('#txtUid').val(),
            q1: $q1,
            q2: $q2,
            q3_1: $q3_1,
            q3_2: $q3_2,
            q3_3: $q3_3,
            q3_4: $q3_4,
            q3_5: $q3_5,
            q3_6: $q3_6,
            q4_1: $q4_1, 
            q4_2: $q4_2, 
            q4_3: $q4_3, 
            q4_4: $q4_4, 
            q4_5: $q4_5, 
            q4_6: $q4_6, 
            q4_7: $q4_7, 
            q4_8: $q4_8, 
            q4_9: $q4_9, 
            q4_10: $q4_10, 
            q4_11: $q4_11, 
            q4_12: $q4_12, 
            q5_1: $q5_1, 
            q5_2: $q5_2, 
            q5_3: $q5_3, 
            q5_4: $q5_4, 
            q5_5: $q5_5, 
            q5_6: $q5_6, 
            q5_7: $q5_7, 
            q5_other: $('#txtQ5_other').val(), 
            q6: $q6,
            q7: $q7,
            q8: $q8,
            q9_1: $q9_1, 
            q9_2: $q9_2, 
            q9_3: $q9_3, 
            q9_4: $q9_4, 
            q9_5: $q9_5, 
            q9_6: $q9_6, 
            q9_7: $q9_7, 
            q9_8: $q9_8, 
            q9_9: $q9_9, 
            q9_10: $q9_10, 
            q9_11: $q9_11, 
            q9_12: $q9_12, 
            q9_13: $q9_13, 
            q9_14: $q9_14, 
            q9_15: $q9_15, 
            q9_16: $q9_16, 
            q9_17: $q9_17, 
            q9_18: $q9_18, 
            q9_19: $q9_19, 
            q9_20: $q9_20, 
            q9_21: $q9_21, 
            q9_other: $('#txtQ9_other').val(), 
            q10_1: $q10_1, 
            q10_2: $q10_2, 
            q10_3: $q10_3, 
            q10_4: $q10_4, 
            q10_5: $q10_5, 
            q10_6: $q10_6, 
            q10_7: $q10_7, 
            q10_8: $q10_8, 
            q10_9: $q10_9, 
            q10_10: $q10_10, 
            q10_11: $q10_11, 
            q10_12: $q10_12, 
            q10_13: $q10_13, 
            q10_14: $q10_14, 
            q10_15: $q10_15, 
            q10_16: $q10_16, 
            q10_17: $q10_17, 
            q10_18: $q10_18, 
            q10_19: $q10_19, 
            q10_20: $q10_20, 
            q10_21: $q10_21,
            q10_22: $q10_22,
            q10_23: $q10_23,
            q10_other: $('#txtQ10_other').val(),
            q11_1: $q11_1, 
            q11_2: $q11_2, 
            q11_3: $q11_3, 
            q11_4: $q11_4, 
            q11_5: $q11_5, 
            q11_6: $q11_6
        }

        console.log(param);

        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "หากบันทึกส่วนที่ 2 แล้วจะไม่สามารถแก้ไขส่วนนี้ได้อีก",
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

                var jxr = $.post(api + 'form?stage=save_part_2', param, function(){}, 'json')
                            .always(function(snap){
                                console.log(snap);
                                if(snap.status == 'Success'){
                                    window.location = 'form-index?rid=' + $("#txtUid").val() + '&session_id=' +$("#txtSid").val() + '&record_id=' + $("#txtRid").val()
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
            }
        })

    },
    save_part_1(){
        $check = 0;
        $('.form-control').removeClass('is-invalid')

        if($('#txtAge').val() == ''){ $check++; $('#txtAge').addClass('is-invalid')};
        if($('#txtTambon').val() == ''){ $check++; $('#txtTambon').addClass('is-invalid')};


        $area = $("input[name='txtQ1']:checked").val();
        $gender = $("input[name='txtQ2']:checked").val();
        $rel = $("input[name='txtQ4']:checked").val();
        $edu = $("input[name='txtQ5']:checked").val();
        $staff = $("input[name='txtQ6']:checked").val();
        $job = $("input[name='txtQ7']:checked").val();
        $screen = $("input[name='txtQ9']:checked").val();
        $isolate = $("input[name='txtQ10']:checked").val();
        $diag = $("input[name='txtQ11']:checked").val();

        if(
            ($area == 'na') || 
            ($gender == 'na') || 
            ($rel == 'na') || 
            ($edu == 'na') || 
            ($staff == 'na') || 
            ($job == 'na') || 
            ($screen == 'na') || 
            ($isolate == 'na') || 
            ($diag == 'na')
        ){
            $check++;
        }

        if($rel == '4'){
            if($('#txtOtherRel').val() == ''){
                $('#txtOtherRel').addClass('is-invalid');
                $check++;
            }
        }

        if($job == '11'){
            if($('#txtQ7Other').val() == ''){
                $('#txtQ7Other').addClass('is-invalid');
                $check++;
            }
        }
        
        if($check != 0){
            Swal.fire({
                icon: "error",
                title: 'ขออภัย',
                text: 'ไม่สามารถดำเนินการได้ กรุณากรอกข้อมูลให้ครบถ้วน',
                confirmButtonClass: 'btn btn-danger',
            })
            return ;
        }

        $q608_1 = 0;
        $q608_2 = 0;
        $q608_3 = 0;
        $q608_4 = 0;
        $q608_5 = 0;
        $q608_6 = 0;
        $q608_7 = 0;
        $q608_8 = 0;
        $q608_9 = 0;

        if($('#confCheckbox1').is(':checked')){ $q608_1 = 1; }
        if($('#confCheckbox2').is(':checked')){ $q608_2 = 1; }
        if($('#confCheckbox3').is(':checked')){ $q608_3 = 1; }
        if($('#confCheckbox4').is(':checked')){ $q608_4 = 1; }
        if($('#confCheckbox5').is(':checked')){ $q608_5 = 1; }
        if($('#confCheckbox6').is(':checked')){ $q608_6 = 1; }
        if($('#confCheckbox7').is(':checked')){ $q608_7 = 1; }
        if($('#confCheckbox8').is(':checked')){ $q608_8 = 1; }
        if($('#confCheckbox9').is(':checked')){ $q608_9 = 1; }

        $q9_1 = 0;
        $q9_2 = 0;
        $q9_3 = 0;
        $q9_4 = 0;
        $q9_5 = 0;
        $q9_6 = 0;
        $q9_7 = 0;

        if($('#confCheckbox9_1').is(':checked')){ $q9_1 = 1; }
        if($('#confCheckbox9_2').is(':checked')){ $q9_2 = 1; }
        if($('#confCheckbox9_3').is(':checked')){ $q9_3 = 1; }
        if($('#confCheckbox9_4').is(':checked')){ $q9_4 = 1; }
        if($('#confCheckbox9_5').is(':checked')){ $q9_5 = 1; }
        if($('#confCheckbox9_6').is(':checked')){ $q9_6 = 1; }
        if($('#confCheckbox9_7').is(':checked')){ $q9_7 = 1; }

        var param = {
            uid: $('#txtUid').val(),
            q1: $area,
            q1_o: $('#txtTambon').val(),
            q2: $gender,
            q3: $('#txtAge').val(),
            q4: $rel,
            q4_o: $('#txtOtherRel').val(),
            q5: $edu,
            q6: $staff,
            q7: $job,
            q7_o: $('#txtQ7Other').val(),
            q8_1: $q608_1, 
            q8_2: $q608_2, 
            q8_3: $q608_3, 
            q8_4: $q608_4, 
            q8_5: $q608_5, 
            q8_6: $q608_6, 
            q8_7: $q608_7, 
            q8_8: $q608_8, 
            q8_9: $q608_9, 
            q9: $screen,
            q9_1: $q9_1, 
            q9_2: $q9_2, 
            q9_3: $q9_3, 
            q9_4: $q9_4, 
            q9_5: $q9_5, 
            q9_6: $q9_6, 
            q9_7: $q9_7, 
            q10: $isolate,
            q10_dd: $('#txtQ10DD').val(), 
            q10_mm: $('#txtQ10MM').val(), 
            q10_yy: $('#txtQ10YY').val(), 
            q10_score: sliderPips_1.noUiSlider.get(),
            q11: $diag,
            q11_dd: $('#txtQ11DD').val(), 
            q11_mm: $('#txtQ11MM').val(), 
            q11_yy: $('#txtQ11YY').val(), 
            q11_score: sliderPips_2.noUiSlider.get()
        }

        console.log(param);

        Swal.fire({
            title: 'ยืนยันดำเนินการ',
            text: "หากบันทึกส่วนที่ 1 แล้วจะไม่สามารถแก้ไขส่วนนี้ได้อีก",
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

                var jxr = $.post(api + 'form?stage=save_part_1', param, function(){}, 'json')
                            .always(function(snap){
                                console.log(snap);
                                if(snap.status == 'Success'){
                                    window.location = 'form-2?rid=' + $("#txtUid").val() + '&session_id=' +$("#txtSid").val() + '&record_id=' + $("#txtRid").val()
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
            }
        })
        
    }
}
$(document).ready(function(){
    var host_url=$('#host_dir').val();
    //添加用户表单验证和提交
    $('#info_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            member_name:{
                required:true,
                minlength:8
            },
            email:{
                required: true,
                email:true
            },
            tel:{
                required: true
            },
            address:{
                required: true,
                minlength:6
            },
            question:{
                required: true,
                minlength:6
            },
            answer:{
                required: true,
                minlength:6
            }
        },
        messages:{
            password2:{
                equalTo:"密码不一致"
            }
        },
        submitHandler:function(form){
            $(form).ajaxSubmit({
                url:host_url+'Home/Member/updateInfo',
                type:"post",
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        location=location;
                    }
                },
                error:function(data){
                    console.log('updateInfo>error');
                    console.log(data.responseText);
                }
            });
        }
    });

    //电话号码验证
    jQuery.validator.addMethod("tel", function(value, element, param) {
        var patt=/([\d]{11})|(\d{3,4}-\d{7,8})/;
        return patt.test(value);
    }, $.validator.format("请输入正确的电话"));
});
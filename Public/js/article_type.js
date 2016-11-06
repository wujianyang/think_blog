$(document).ready(function(){
    //添加数据
    $('#add').click(function(){
        getMember();

        $('#list_div').hide();
        $('#add_div').show();
    });
    //批量删除
    $('#del').click(function(){
        var del=$('.id');
        var arr=new Array();
        for(var i=0;i<del.length;i++){
            if(del[i].checked){
                arr.push(del[i].value);
            }
        }
        if(arr.length==0){
            alert('请选择要删除的数据');
        }else{
            if(confirm('该用户文章类别的相关文章也会一起删除,确定删除？')){

                $.ajax({
                    url:"/blog/controller/article_type/articleTypeAction.php",
                    type:"post",
                    dataType:"json",
                    data:{act:"del",id:arr},
                    success:function(data){
                        if(data.status=='1'){
                            alert('删除成功');
                            showList(1,10,'','','eq');
                        }else{
                            alert('删除失败');
                        }
                    },
                    error:function(data){
                        console.log('delete>error');
                        showList(1,10,'','','eq');
                    }
                });
            }
        }
    });

    //添加表单验证和提交
    $('#add_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            article_type_name:{
                required:true,
                minlength:4
            },
            member_id:{
                required: true,
                minlength: 1
            }
        },
        submitHandler:function(form){
            $(form).ajaxSubmit({
                url:"/blog/controller/article_type/articleTypeAction.php",
                type:"post",
                data:{"act":"add"},
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#add_div').hide();
                        $('#add_form')[0].reset();
                    }
                },
                error:function(data){
                    console.log('add>error');
                    console.log(data.responseText);
                }
            });
        }
    });
    //编辑表单验证和提交
    $('#edit_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            article_type_name_edit:{
                required:true,
                minlength:4
            },
            member_id_edit:{
                required: true,
                minlength: 1
            }
        },
        submitHandler:function(form){
            $(form).ajaxSubmit({
                url:"/blog/controller/article_type/articleTypeAction.php",
                type:"post",
                data:{"act":"edit"},
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#edit_div').hide();
                        $('#edit_form')[0].reset();
                    }
                },
                error:function(data){
                    console.log('edit>error');
                    console.log(data.responseText);
                }
            });
        }
    });



    //查看用户信息
    $('.info').live('click', function(){
        var id= $(this).attr('value');
        if(/\d/.test(id)){
            getMember('edit');
            $.ajax({
                url:"/blog/controller/article_type/articleTypeAction.php",
                type:"post",
                data:{"act":"info","id":id},
                dataType:"json",
                success:function(result){
                    if(result.status==1){
                        var data=result.rows;
                        if(data.length!=0){
                            data=data[0];
                            for(var i in data){
                                console.log(data[i]);
                                $("#"+i+"_edit").val(data[i]);
                            }
                            $('#edit_div').show();
                            $('#list_div').hide();
                        }else{
                            alert('没有此数据');
                        }
                    }else if(result.status==0){
                        alert('请求用户信息错误');
                    }
                },
                error:function(data){
                    console.log(data);
                    alert('请求失败');
                    console.log('info>error');
                }
            });
        }else{
            alert('用户参数错误');
        }
    });

    //判断是否全部选中
    $('.id').live('click',function(){
        //选中添加背景色
        console.log($(this).attr('checked'));
        if($(this).attr('checked')){
            $(this).parents('.tr_line').addClass('sel');
        }else{
            $(this).parents('.tr_line').removeClass('sel');
        }
        var id_len=$('.id').length;
        var id_check_len=$(".id:checked").length;
        if(id_len == id_check_len){
            $('#all_id').attr('checked',true);
        }else{
            $('#all_id').attr('checked',false);
        }
    });
});

//列表显示
function showList(page,page_size,keyItem,key,com){
    page=page||1;
    page_size=page_size||10;
    keyItem=keyItem||'id';
    key=key||'';
    com=com||'eq';
    var sHtml_loading='<div class="loading"><img src="/think_blog/Public/images/loading.gif" width="100px"  /></div>';
    $('#list_table_tbody').html(sHtml_loading);
    $.ajax({
        url:"/think_blog/Admin/ArticleType/index",
        type:"post",
        data:{"page":page,"page_size":page_size,"keyItem":keyItem,"key":key,"com":com},
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var sHtml='';
                var rows=data.rows;
                if(rows.length>0) {
                    //拼接数据列表
                    for (var i = 0; i < rows.length; i++) {
                        sHtml += '<tr class="tr_line">';
                        sHtml += '<td><input type="checkbox" class="id" name="id[]" value="' + rows[i]["id"] + '" /></td>';
                        sHtml += '<td width="50">' + rows[i]["id"] + '</td>';
                        sHtml += '<td width="200"><a class="info" href="javascript:void(0);" value="' + rows[i]["id"] + '">' + rows[i]["article_type_name"] + '</a></td>';
                        sHtml += '<td width="100">' + rows[i]["member_id"] + '</td>';
                        sHtml += '<td width="200">' + rows[i]["member_name"] + '</td>';
                        sHtml += '</tr>';
                    }
                    $('#list_table_tbody').html(sHtml);
                    //生成分页条
                    getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                }else{
                    $('#list_table_tbody').html('<tr><td colspan="5" salign="center">没有数据</td></tr>');
                }

            }else{
                $('#list_table_tbody').html('<tr><td colspan="5" salign="center">没有数据</td></tr>');
            }
        },
        error:function(data){
            console.log('showList>error');
            console.log(data.responseText);
        }
    });
}

//获取用户信息
function getMember(flag) {
    flag = flag || '';
    //获取用户名信息
    $.ajax({
        url: "/blog/controller/member/memberAction.php",
        type: "post",
        dataType: "json",
        data: {act: "select_member"},
        success: function (data) {
            $('#member_id').html('');
            var rows = data.rows;
            if (rows.length > 0) {
                for (var i = 0; i < rows.length; i++) {
                    if (flag != 'edit') {
                        $('#member_id').append('<option value="' + rows[i]['id'] + '">' + rows[i]['member_name'] + '</option>');
                    } else {
                        $('#member_id_edit').append('<option value="' + rows[i]['id'] + '">' + rows[i]['member_name'] + '</option>');
                    }
                }
            } else {
                $('#member_id').html('<option>没有用户数据</option>');
            }
        },
        error: function (data) {
            console.log('clickAdd>error');
            console.log(data.responseText);
            showList(1,10,'','','eq');
        }
    });
}
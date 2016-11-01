$(document).ready(function(){
    showList(1);
    //添加用户
    $('#add').click(function(){
        getMember();
        $('#list_div').hide();
        $('#add_div').show();
    });
    //选择用户改变文章类别
    $('body').on('change','#member_id',function(){
        var member_id=$(this).val();
        getArticleTypeByMemberId(member_id);
    });
    $('body').on('change','#member_id_edit',function(){
        var member_id=$(this).val();
        getArticleTypeByMemberId(member_id,'edit');
    });


    //批量删除用户
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
            if(confirm('确定删除？')){

                $.ajax({
                    url:"/blog/controller/article/articleAction.php",
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
                        alert('error');
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
            title:{
                required:true,
                minlength:4
            },
            member_id:{
                required: true,
                minlength: 1
            },
            article_type_id:{
                required: true,
                minlength: 1
            },
            content:{
                required: true,
                minlength: 10
            }
        },
        submitHandler:function(form){
            var content=$('#content').html();   //获取文章内容
            $(form).ajaxSubmit({
                url:"/blog/controller/article/articleAction.php",
                type:"post",
                data:{"act":"add","article[content]":content},
                dataType:"json",
                success:function(data){
                    alert(data.msg);
                    if(data.status=='1'){
                        showList(1,10,'','','eq');
                        $('#list_div').show();
                        $('#add_div').hide();
                        $('#add_form')[0].reset();
                        $('#content').html(''); //清空文章内容
                    }
                },
                error:function(data){
                    console.log('add>error');
                    console.log(data);
                }
            });
        }
    });

    //编辑表单验证和提交
    $('#edit_form').validate({
        onsubmit:true,// 是否在提交是验证
        onfocusout:false,// 是否在获取焦点时验证
        rules:{
            title:{
                required:true,
                minlength:4
            },
            member_id:{
                required: true,
                minlength: 1
            },
            article_type_id:{
                required: true,
                minlength: 1
            },
            content:{
                required: true,
                minlength: 10
            }
        },
        submitHandler:function(form){
            var content=$('#content_edit').html();   //获取文章内容
            $(form).ajaxSubmit({
                url:"/blog/controller/article/articleAction.php",
                type:"post",
                data:{"act":"edit","article[content]":content},
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

    //查看信息
    $('body').on('click','.info',function(){
        console.log('info');
        getMember('edit');
        var id= $(this).attr('value');
        if(/\d/.test(id)){
            $.ajax({
                url:"/blog/controller/article/articleAction.php",
                type:"post",
                data:{"act":"info","id":id},
                dataType:"json",
                success:function(result){
                    if(result.status==1){
                        var data=result.rows;
                        if(data.length!=0){
                            data=data[0];
                            for(var i in data){
                                //console.log(i+','+data.id);
                                getArticleTypeByMemberId(data.member_id,'edit');
                                if(i!='content'){
                                    $("#"+i+"_edit").val(data[i]);
                                }else{
                                    $("#"+i+"_edit").html(data[i]);
                                }

                            }
                            $('#edit_div').show();
                            $('#list_div').hide();
                        }else{
                            alert('没有此用户');
                        }
                    }else if(result.status==0){
                        alert('请求用户信息错误');
                    }
                },
                error:function(data){
                    console.log(data.responseText);
                    alert('请求失败');
                    console.log('info>error');
                }
            });
        }else{
            alert('用户参数错误');
        }
    });


    function getMember(flag){
        flag=flag||'';
        //获取用户名信息
        $.ajax({
            url:"/blog/controller/member/memberAction.php",
            type:"post",
            dataType:"json",
            //async: false,
            data:{act:"select_member"},
            success:function(data){
                if(flag!='edit') {
                    $('#member_id').html('');
                }else{
                    $('#member_id_edit').html('');
                }
                var rows=data.rows;
                if(rows.length > 0){
                    for(var i=0;i<rows.length;i++){
                        if(flag!='edit'){
                            $('#member_id').append('<option value="'+rows[i]['id']+'">'+rows[i]['member_name']+'</option>');
                            getArticleTypeByMemberId(rows[0]['id']);
                        }else{
                            $('#member_id_edit').append('<option value="'+rows[i]['id']+'">'+rows[i]['member_name']+'</option>');
                            getArticleTypeByMemberId(rows[0]['id'],'edit');
                        }
                    }
                }else{
                    $('#member_id').html('<option>没有用户数据</option>');
                }
            },
            error:function(data){
                console.log('clickAdd>error');
                console.log(data.responseText);
                showList(1,10,'','','eq');
            }
        });
    }

    function getArticleTypeByMemberId(m_id,flag){
        m_id=m_id||'';
        flag=flag||'';
        if(m_id!='') {
            //根据用户名获取文章类别
            $.ajax({
                url: "/blog/controller/article_type/articleTypeAction.php",
                type: "post",
                dataType: "json",
                async: false,
                data: {act: "select_article_type",member_id:m_id},
                success: function (data) {
                    if(flag!='edit') {
                        $('#article_type_id').html('');
                    }else{
                        $('#article_type_id_edit').html('');
                    }
                    var rows = data.rows;
                    if (rows.length > 0) {
                        for (var i = 0; i < rows.length; i++) {
                            if(flag!='edit'){
                                $('#article_type_id').append('<option value="' + rows[i]['id'] + '">' + rows[i]['article_type_name'] + '</option>');
                            }else{
                                $('#article_type_id_edit').append('<option value="' + rows[i]['id'] + '">' + rows[i]['article_type_name'] + '</option>');
                            }
                        }
                    } else {
                        if(flag!='edit'){
                            $('#article_type_id').html('<option>没有数据</option>');
                        }else{
                            $('#article_type_id_edit').html('<option>没有数据</option>');
                        }
                    }
                },
                error: function (data) {
                    console.log('clickAdd>error');
                    console.log(data.responseText);
                    showList(1,10,'','','eq');
                }
            });
        }else{
            console.log('用户ID错误');
        }
    }
});
//列表显示
function showList(page,page_size,keyName,key,com){
    page=page||1;
    page_size=page_size||10;
    keyName=keyName||'id';
    key=key||'';
    com=com||'eq';
    var sHtml_loading='<div class="loading"><img src="/blog/images/loading.gif" width="100px" /></div>';
    $('#list_table_tbody').html(sHtml_loading);
    $.ajax({
        url:"/blog/controller/article/articleAction.php",
        type:"post",
        data:{"page":(page-1),"page_size":page_size,"keyName":keyName,"key":key,"com":com,"act":"select"},
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var sHtml='';
                var rows=data.rows;
                if(rows.length>0) {
                    //拼接数据列表
                    for (var i = 0; i < rows.length; i++) {
                        sHtml += '<tr>';
                        sHtml += '<td><input type="checkbox" class="id" name="id[]" value="' + rows[i]["id"] + '" /></td>';
                        sHtml += '<td width="50">' + rows[i]["id"] + '</td>';
                        sHtml += '<td width="200"><a class="info" href="javascript:void(0);" value="' + rows[i]["id"] + '">' + str_sub(rows[i]["title"],32) + '</a></td>';
                        sHtml += '<td width="150">' + rows[i]["member_name"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["article_type_name"] + '</td>';
                        sHtml += '<td width="50">' + rows[i]["hitnum"] + '</td>';
                        sHtml += '<td width="150">' + rows[i]["create_time"] + '</td>';
                        sHtml += '</tr>';
                    }
                    $('#list_table_tbody').html(sHtml);
                    //生成分页条
                    getPageBar(page,Math.ceil(data.count/page_size),data.count,page_size);
                }else{
                    $('#list_table_tbody').html('<tr><td colspan="7" salign="center">没有数据</td></tr>');
                }
            }else{
                $('#list_table_tbody').html('<tr><td colspan="7" salign="center">没有数据</td></tr>');
            }
        },
        error:function(data){
            console.log('showList>error');
            console.log(data.responseText);
        }
    });
}
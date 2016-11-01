$(document).ready(function(){
    showList(1);
    //添加数据
    $('#add').click(function(){
        getMember();

        $('#list_div').hide();
        $('#add_div').show();
    });
    //关闭添加用户窗口
    $('#close_div').click(function(){
        $('#list_div').show();
        $('#add_div').hide();
    });
    //关闭编辑用户窗口
    $('#close_edit_div').click(function(){
        $('#list_div').show();
        $('#edit_div').hide();
    });
    //搜索
    $('#search').click(function(){
        var key=$('#key').val();
        var keyName=$('#keyName').val();
        var com=keyName.split('+')[1];
        keyName=keyName.split('+')[0];
        showList(1,10,keyName,key,com);
    });
    //一页显示条数
    $('#toPageSize').live("change",function(){
        var key=$('#key').val();
        var keyName=$('#keyName').val();
        var com=keyName.split('+')[1];
        keyName=keyName.split('+')[0];
        var page_size=$(this).val();
        showList(1,page_size,keyName,key,com);
    });
    //页码跳转
    $('#toPage').live("click",function(){
        var p=$('#page_text').val();
        var key=$('#key').val();
        var keyName=$('#keyName').val();
        var com=keyName.split('+')[1];
        keyName=keyName.split('+')[0];
        showList(p,10,keyName,key,com);
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
            if(confirm('该相册的相关相片也会一起删除,确定删除？')){

                $.ajax({
                    url:"/blog/controller/photo/photoAction.php",
                    type:"post",
                    dataType:"json",
                    data:{act:"del",id:arr},
                    success:function(data){
                        alert(data.msg);
                        if(data.status=='1'){
                            showList(1,10,'','','eq');
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


    //获取多选框选中用户
    function radio_cheched(){
        var r=$('.id');
        var arr_r=new Array();
        for(var i=0;i<r.length;i++){
            if(r[i].checked){
                arr_r.push(r[i].value);
            }
        }
        return arr_r;
    }

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
                url:"/blog/controller/photo/photoAction.php",
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
                url:"/blog/controller/photo/photoAction.php",
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


    $('#all_id').click(function(){

        if($(this).attr('checked')=='checked'){
            $('.id').attr('checked',true);
        }else{
            $('.id').attr('checked',false);
        }
    });
    //列表显示
    function showList(page,page_size,keyName,key,com){
        page=page||1;
        page_size=page_size||10;
        keyName=keyName||'id';
        key=key||'';
        com=com||'eq';
        var sHtml_loading='<div class="loading"><img src="/blog/images/loading.gif" width="100px"  /></div>';
        $('#list_table_tbody').html(sHtml_loading);
        $.ajax({
            url:"/blog/controller/photo/photoAction.php",
            type:"post",
            data:{"page":(page-1),"page_size":page_size,"keyName":keyName,"key":key,"com":com,"act":"select"},
            dataType:"json",
            success:function(data){
                if(data.status==1){
                    var sHtml='';
                    var rows=data.rows;
                    console.log(rows);
                    if(rows.length>0) {
                        //拼接数据列表
                        for (var i = 0; i < rows.length; i++) {
                            sHtml += '<tr class="tr_line">';
                            sHtml += '<td><input type="checkbox" class="id" name="id[]" value="' + rows[i]["id"] + '" /></td>';
                            sHtml += '<td width="50">' + rows[i]["id"] + '</td>';
                            sHtml += '<td width="200"><a class="info" href="javascript:void(0);" value="' + rows[i]["id"] + '">' + rows[i]["photo_title"] + '</a></td>';
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

    //查看用户信息
    $('.info').live('click', function(){
        var id= $(this).attr('value');
        if(/\d/.test(id)){
            getMember('edit');
            //根据id信息
            $.ajax({
                url:"/blog/controller/photo/photoAction.php",
                type:"post",
                data:{"act":"info","id":id},
                dataType:"json",
                success:function(result){
                    if(result.status==1){
                        var data=result.rows;
                        if(data.length!=0){
                            data=data[0];
                            for(var i in data){
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

    //分页条
    function getPageBar(cur_page,page_count,total,page_size){
        cur_page=parseInt(cur_page);
        page_count=parseInt(page_count);
        total=parseInt(total);
        page_size=parseInt(page_size);
        var pageStr='';
        if(cur_page>page_count) //页码大于最大页数
            cur_page=page_count;
        if(cur_page<1)  //页码小于1
            cur_page=1;

        if(cur_page==1){    //如果是第一页
            pageStr+='<span class="page"><a href="javascript:void(0);">首页</a></span>';
            pageStr+='<span class="page"><a href="javascript:void(0);">上一页</a></span>';
        }else{
            pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="1">首页</a></span>';
            pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+(cur_page-1)+'">上一页</a></span>';
        }

        pageStr+='<label id="curpage">'+cur_page+'</label> / <label id="page_count">'+page_count+'</label>';

        if(cur_page>=page_count){   //如果是最后一页
            pageStr+='<span class="page"><a href="javascript:void(0);">下一页</a></span>';
            pageStr+='<span class="page"><a href="javascript:void(0);">末页</a></span>';
        }else{
            pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+(cur_page+1)+'">下一页</a></span>';
            pageStr+='<span class="page hov"><a href="javascript:void(0);" rel="'+page_count+'">末页</a></span>';
        }

        pageStr+='<span><select id="toPageSize">';
        for(var i=1;i<=5;i++){
            if(parseInt(page_size)/10==i){
                pageStr+='<option value="'+i*10+'" selected="selected">'+i*10+'</option>';
            }else{
                pageStr+='<option value="'+i*10+'">'+i*10+'</option>';
            }
        }
        pageStr+='</select></span>';
        pageStr+='<span><input type="text" id="page_text" class="page_text" /><input type="button" value="跳转" id="toPage" /></span>';
        $('#page_div').html(pageStr);
        $('#page_div').show();
    }
    //点击分页
    $('#page_div span a').live('click',function(){
        var rel=$(this).attr('rel');
        var p_size=$('#toPageSize').val();
        var k=$('#key').val();
        var keyName=$('#keyName').val();
        var com=keyName.split('+')[1];
        keyName=keyName.split('+')[0];
        console.log(p_size);
        if(rel){
            showList(rel,p_size,keyName,k,com);
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

    //获取用户信息
    function getMember(flag){
        flag=flag||'';
        //获取用户名信息
        $.ajax({
            url:"/blog/controller/member/memberAction.php",
            type:"post",
            dataType:"json",
            data:{act:"select_member"},
            success:function(data){
                if(flag!='edit'){
                    $('#member_id').html('');
                }else{
                    $('#member_id_edit').html('');
                }
                var rows=data.rows;
                if(rows.length > 0){
                    for(var i=0;i<rows.length;i++){
                        if(flag!='edit'){
                            $('#member_id').append('<option value="'+rows[i]['id']+'">'+rows[i]['member_name']+'</option>');
                        }else{
                            $('#member_id_edit').append('<option value="'+rows[i]['id']+'">'+rows[i]['member_name']+'</option>');
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
});
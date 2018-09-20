$(document).ready(function() {
    // $(".sele2").select2(); //单选
    
    $(".date_time").datetimepicker({
        autoclose: true, //自动关闭  
        format: 'yyyy-mm-dd',     //日期格式  
    });
    
    $(".dtpick").datetimepicker({
        language:  'cn',
        format: 'yyyy-mm-dd hh:ii:ss',
    });

    // 单选/多选样式
    $(".iccontrol").iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });
});
// confirm确认删除吗
function delfun(obj){
    if(confirm('确认删除吗?')){        
        return true;
    }else{
        return false;
    }
}
/**
 * 获取省份,城市,区域
 * @param t  省份select对象
 */
function get_region(t,em,level){
    var pid = $(t).val();
    var obj = "#"+em;
    if(!pid > 0){
        return;
    }
    var url = '/api/ajax/get_region/pid/'+ pid + '/level/' + level;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            $(obj).empty().html(v);
        }
    });
}
// 获取酒吧的打印机列表
function get_bprint(t){
    var bid = $(t).val();
    var obj = "#print_id";
    if(!bid > 0){
        return;
    }
    var url = '/api/ajax/get_bprint/bid/'+ bid ;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            $(obj).empty().html(v.html);
            $("#up_gimg").attr("barno",v.barno);
            if(v.barno==''){
                $("#up_gimg").next().attr("disabled", true);
            }else{
                $("#up_gimg").next().attr("disabled", false);
            }
        }
    });
}



/**
 * 后台JS主入口
 */


/**
 * 通用表单提交(AJAX方式)
 */
layui.use('form', function(){
    var form = layui.form;
    //各种基于事件的操作，下面会有进一步介绍
    form.on('submit(*)', function(data){
        $.ajax({
            url: data.form.action,
            type: data.form.method,
            data: $(data.form).serialize(),
            success: function (info) {
                if (info.code === 1) {
                    setTimeout(function () {
                        location.href = info.url;
                    }, 1000);
                }
                layer.msg(info.msg);
            }
        });
        return false;
    });

});

/*上传*/
layui.use('upload', function(){
    var upload = layui.upload;
    var barimg = $('.layui_upbarimg').attr('barno');
    var sjcode = $('.layui_upsjcode').attr('barno');
    // alert($(".layui_upfile").next().attr("accept"));
   
    //上传单图
    var uploadInst = upload.render({
        elem: '.layui_upimage', //绑定元素
        accept: 'images',
        exts: 'jpg|jpeg|png|gif|bmp',
        url: '/index.php/api/upload/upimgs', //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                
                $('.layui_upimage').prev().val(data.url);
                $('.layui_upimage').parent().find('img').attr("src","/"+data.url);
                $('.layui_upimage').parent().find('img').removeClass('imgh').addClass('imgb');

            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    }); 

    //上传单图2
    var uploadInst = upload.render({
        elem: '.layui_upimage2', //绑定元素
        accept: 'images',
        exts: 'jpg|jpeg|png|gif|bmp',
        url: '/index.php/api/upload/upimgs', //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                $('.layui_upimage2').prev().val(data.url);
                $('.layui_upimage2').parent().find('img').attr("src","/"+data.url);
                $('.layui_upimage2').parent().find('img').removeClass('imgh').addClass('imgb');

            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    }); 

    //上传单图3
    var uploadInst = upload.render({
        elem: '.layui_upimage3', //绑定元素
        accept: 'images',
        exts: 'jpg|jpeg|png|gif|bmp',
        url: '/index.php/api/upload/upimgs', //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                $('.layui_upimage3').prev().val(data.url);
                $('.layui_upimage3').parent().find('img').attr("src","/"+data.url);
                $('.layui_upimage3').parent().find('img').removeClass('imgh').addClass('imgb');

            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    }); 

    //上传单图4
    var uploadInst = upload.render({
        elem: '.layui_upimage4', //绑定元素
        accept: 'images',
        exts: 'jpg|jpeg|png|gif|bmp',
        url: '/index.php/api/upload/upimgs', //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                $('.layui_upimage4').prev().val(data.url);
                $('.layui_upimage4').parent().find('img').attr("src","/"+data.url);
                $('.layui_upimage4').parent().find('img').removeClass('imgh').addClass('imgb');

            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    }); 
 

    //上传单文件
    var uploadInst = upload.render({
        elem: '.layui_upfile', //绑定元素
        accept: 'file',
        exts: 'xls|xlsx',
        url: '/index.php/api/upload/upimgs/type/file', //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                $('.layui_upfile').prev().val(data.url);
            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    });
    upload.render({
        elem: '.layui_upbarimg', //绑定元素
        accept: 'images',
        exts: 'jpg|jpeg|png|gif|bmp',
        url: '/index.php/api/upload/upimgs/type/'+barimg, //上传接口
        done: function(data){
            //上传完毕回调
            if (data.error === 0) {
                $('.layui_upbarimg').prev().val(data.url);
                $('.layui_upbarimg').parent().find('img').attr("src","/"+data.url);
                $('.layui_upbarimg').parent().find('img').removeClass('imgh').addClass('imgb');

            } else {
                layer.msg(data.message);
            }
        }
        ,error: function(){
            //请求异常回调
            layer.msg('请求异常回调');
        }
    });
    //多图片上传
    upload.render({
        elem: '.layui_upimages',
        url: '/index.php/api/upload/upimgs/type/'+savep,
        exts: 'jpg|jpeg|png|gif|bmp',
        multiple: true,
        before: function(obj){
            layer.msg('图片上传中...', {icon: 16})
        }
        ,done: function(res){
            //上传完毕
            layer.close(layer.msg());//关闭上传提示窗口
            if(res.error == 1) {
                return layer.msg(res.message);
            }
            var str =   '<li class="item_img">'+
                        '<input type="text" size="40" class="input-text img1" name="imgs[]" value="' + res.url + '" > &nbsp;'+
                        '<input type="text" size="20" class="input-text imgname1" name="imgs_name[]" value="' + res.name + '" > &nbsp;'+
                        '<a class="btn btn-sm btn-info imghref1" target="_blank" href="/public' + res.url + '">查看</a> &nbsp;'+
                        '<a class="btn btn-sm btn-warning upclose1" >移除</a> &nbsp;'+
                        '<img class="th1_img imgb" src="/public' + res.url + '"> &nbsp;'+
                        '</li>';
            $('.layui_upimages').parent().find('.layui-upload-list').append(str);
        }
    });

});
//点击多图上传的X,删除当前的图片    
$("body").on("click",".upclose1",function(){
    $(this).closest("li").remove();
});
$('.ajax-action').on('click', function () {
    var _action = $(this).data('action');
    layer.open({
        shade: false,
        content: '确定执行此操作？',
        btn: ['确定', '取消'],
        yes: function (index) {
            $.ajax({
                url: _action,
                data: $('.ajax-form').serialize(),
                success: function (info) {
                    if (info.code === 1) {
                        setTimeout(function () {
                            location.href = info.url;
                        }, 1000);
                    }
                    layer.msg(info.msg);
                }
            });
            layer.close(index);
        }
    });

    return false;
});
/**
 * 清除缓存
 */
$('#clear-cache').on('click', function () {
    var _url = $(this).data('url');
    if (_url !== 'undefined') {
        $.ajax({
            url: _url,
            success: function (data) {
                if (data.code === 1) {
                    setTimeout(function () {
                        location.href = location.pathname;
                    }, 1000);
                }
                layer.msg(data.msg);
            }
        });
    }

    return false;
});



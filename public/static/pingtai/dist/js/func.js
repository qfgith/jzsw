$(document).ready(function() {
    $(".sele2").select2(); //单选
    
    $(".date_time").datepicker({
        autoclose: true, //自动关闭  
        format: 'yyyy-mm-dd',     //日期格式  
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
function get_bprint(t,em){
    var bid = $(t).val();
    var obj = "#"+em;
    if(!pid > 0){
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
            $(obj).empty().html(v);
        }
    });
}
/**
 * 后台JS主入口
 */

var layer = layui.layer,
    element = layui.element(),
    laydate = layui.laydate,
    form = layui.form();

/**
 * AJAX全局设置
 */
$.ajaxSetup({
    type: "post",
    dataType: "json"
});


/**
 * 通用单图上传
 */
layui.upload({
    url: "/index.php/api/upload/upload",
    type: 'image',
    ext: 'jpg|jpeg|png|gif|bmp',
    success: function (data,control) {
        if (data.error === 0) {
            // document.getElementById('bannerimg').value = data.url;

            if(control){
                $(control).parent().parent().prev().val(data.url);
            }

        } else {
            layer.msg(data.message);
        }
    }
});
layui.upload({
    url: "/index.php/api/upload/upload/type/image",
    elem: '.layui_upimage',
    type: 'image',
    title: '选择图片',
    ext: 'jpg|jpeg|png|gif|bmp',
    success: function (data,control) {
        if (data.error === 0) {
            console.log(control);
            alert(control);
            if(control){
                $(control).parent().parent().prev().val(data.url);
                $(control).parent().parent().next().attr("src","/public"+data.url);
                $(control).parent().parent().next().removeClass('imgh').addClass('imgb');
            }

        } else {
            layer.msg(data.message);
        }
    }
});




layui.upload({
    url: "/index.php/api/upload/upload/type/file",
    elem: '.layui_upfile',
    type: 'file',
    title: '选择文件',
    ext: 'jpg|jpeg|png|gif|txt|pdf|doc|docx|xls|rar|zip',
    success: function (data,control) {
        if (data.error === 0) {
            if(control){
                $(control).parent().parent().prev().val(data.url);
            }

        } else {
            layer.msg(data.message);
        }
    }
});


/**
 * 通用日期时间选择
 */
$('.datetime').on('click', function () {
    laydate({
        elem: this,
        istime: true,
        format: 'YYYY-MM-DD hh:mm:ss'
    })
});

/**
 * 通用表单提交(AJAX方式)
 */
form.on('submit(*)', function (data) {
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

/**
 * 通用批量处理（审核、取消审核、删除）
 */
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
 * 通用全选
 */
$('.check-all').on('click', function () {
    $(this).parents('table').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});

/**
 * 通用删除
 */
$('.ajax-delete').on('click', function () {
    var _href = $(this).attr('href');
    layer.open({
        shade: false,
        content: '确定删除？',
        btn: ['确定', '取消'],
        yes: function (index) {
            $.ajax({
                url: _href,
                type: "get",
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
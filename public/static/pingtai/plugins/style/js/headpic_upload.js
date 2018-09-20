/**
 * 获取城市
 * @param t  省份select对象
 */
function get_city(t){
    var parent_id = $(t).val();
    if(!parent_id > 0){
        return;
    }
    var url = '/index.php?m=Home&c=Ajax&a=getRegion&level=2&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
        	//alert(v);
            v = '<option value="0">请选择城市</option>'+ v;          
            $('#city').empty().html(v);
        }
    });
}

var oimghead="#head_image";
var ouplodehead="upload_head_img1";
var _editor_s_img1head = UE.getEditor(ouplodehead);
_editor_s_img1head.ready(
	function () {
		_editor_s_img1head.hide();
		_editor_s_img1head.addListener(
			"beforeInsertImage", 
			function (t, arg) {
				$(oimghead).attr("value", arg[0].src);
                $("#hpic").attr("src", arg[0].src);
				
			}
		);
	}
);
function upImage_s_img1head() {
	var myImage_s_img1head = _editor_s_img1head.getDialog("insertimage");
	myImage_s_img1head.open();
}
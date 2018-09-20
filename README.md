# 喜点娱乐

#### 项目文件说明

原型图：https://pro.modao.cc/app/q9CiSJ02LW3fQiV5SYxmI3AgMZ8zoRy#screen=s7663c20cb9056d0113b58d
xidian-0.sql ： 是项目的初始数据库。

to 刘文礼：如果你要添加新的函数的话，请将你的函数写在app/common/liuwenli.php文件中，并备注函数的使用说明。


#### 新操作备注
小邱----2018.7.24——2018.7.25：

1.建立了新表sys_param(参数表)
2.im_user表中的level_id是无用字段，删除。
3.im_user表中增加wx_headpic字段。
4.将im_money表名称改为sys_money_log，将其改为资金流动日志表（存储酒吧，用户，商城的资金变动）。
5.将bar_money表名称改为sys_recharge（酒吧，用户，商城充值表）。
6.将所有表中的Id改为id.
7.将部分表中以datetime存储时间的字段类型改为了int，将部分表的bit类型改为tinyint.
8.更改auth权限类，删除表 sys_auth_group_access，现在使用Sauth类进行权限控制。
9.单图上传：
<input type="text" id="eimg" name="eimg" value="" size="40" class="layui-input input-text">
<button type="button" class="layui-btn layui_upimage" >上传图片</button>
<img src="" class="th1_img imgh" style="max-width: 50px;">
10.多图/附件上传：
-多图：使用crx.php中的方法getUeditorImages();
-多附件：使用crx.php中的方法getUeditorFiles();


#### cathy更改说明
to 刘文礼：
1.改了你的控制器文件 ShopCategory.php、ShopOrder.php，更改的代码我用/*xxxx-xx-xx小邱修改*/注释起来了。
2.删除了shop_order表中的 优惠券相关字段，在shop_category中添加了child字段。
3.将你存放在 app/admin/config.php下的“订单状态”参数移动到 app/extra/sysparam.php中，并对其作出了部分修改
4.因为layui插件升级了，0.9版本的单图上传js已经失效了，所以更换了html中的商品分类，商品，商铺的图片上传代码
5.商城管理员的密码要加密，改了数据库pwd字段值，删减了一些商家，现在只有一个商家


<?php

return [
	//订单状态(商城商品订单)
    'SOSTATUS'      =>[
        '0' => [
			'id' 	=> 0,
			'name'	=> '待付款',
			'str' 	=> '<span class="btn btn-sm btn-warning">待付款</span>',
			'desc' 	=> '提交订单，等待付款',
		],
		'1' => [
			'id' 	=> 1,
			'name'	=> '待发货',
			'str' 	=> '<span class="btn btn-sm btn-info">待发货</span>',
			'desc' 	=> '已付款，待发货',
		],
		'2' => [
			'id' 	=> 2,
			'name'	=> '已发货',
			'str' 	=> '<span class="btn btn-sm btn-default">已发货</span>',
			'desc' 	=> '订单已发货',
		],
		'3' => [
			'id' 	=> 3,
			'name'	=> '已完成',
			'str' 	=> '<span class="btn btn-sm btn-success">已完成</span>',
			'desc' 	=> '订单已完成',
		],
		'4' => [
			'id' 	=> 4,
			'name'	=> '已取消',
			'str' 	=> '<span class="btn btn-sm btn-danger">已取消</span>',
			'desc' 	=> '订单已取消',
		],
		'5' => [
			'id' 	=> 5,
			'name'	=> '异常订单',
			'str' 	=> '<span class="btn btn-sm btn-danger">异常订单</span>',
			'desc' 	=> '异常订单',
		],
    ],

	'TVOSTATUS'	=> [
		'0' => [
			'id' 	=> 0,
			'name'	=> '待付款',
			'str' 	=> '<span class="btn btn-sm btn-warning">待付款</span>',
			'desc' 	=> '提交订单，等待付款',
		],
		'1' => [
			'id' 	=> 1,
			'name'	=> '待显示',
			'str' 	=> '<span class="btn btn-sm btn-danger">待显示</span>',
			'desc' 	=> '已付款，排队等待显示',
		],
		'2' => [
			'id' 	=> 2,
			'name'	=> '显示中',
			'str' 	=> '<span class="btn btn-sm btn-info">显示中</span>',
			'desc' 	=> '霸屏显示中',
		],
		'3' => [
			'id' 	=> 3,
			'name'	=> '已完成',
			'str' 	=> '<span class="btn btn-sm btn-success">已完成</span>',
			'desc' 	=> '霸屏显示已完成',
		],
	],
	'BOSTATUS'	=> [
		'0' => [
			'id' 	=> 0,
			'name'	=> '待付款',
			'str' 	=> '<span class="btn btn-sm btn-warning">待付款</span>',
			'desc' 	=> '提交订单，等待付款',
		],
		'1' => [
			'id' 	=> 1,
			'name'	=> '待确认',
			'str' 	=> '<span class="btn btn-sm btn-info">待确认</span>',
			'desc' 	=> '已付款，待确认',
		],
		'2' => [
			'id' 	=> 2,
			'name'	=> '已确认',
			'str' 	=> '<span class="btn btn-sm btn-success">已确认</span>',
			'desc' 	=> '订单已确认',
		],
		'3' => [
			'id' 	=> 3,
			'name'	=> '已取消',
			'str' 	=> '<span class="btn btn-sm btn-danger">已取消</span>',
			'desc' 	=> '订单已取消',
		],
	],
	'MTYPE' => [
		'0' => [
			'tname'=> 'sys_recharge',
			'lead' => 'user_id',
			'ptype'=> 1,
			'desc' => '用户充值',
		],
		'1' => [
			'tname'=> 'sys_recharge',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '酒吧充值',
		],
		'2' => [
			'tname'=> 'sys_recharge',
			'lead' => 'shop_id',
			'ptype'=> 1,
			'desc' => '商城充值',
		],
		'3' => [
			'tname'=> 'bar_order',
			'lead' => 'user_id',
			'ptype'=> 0,
			'desc' => '用户买酒扣除余额或金钱',
		],
		'4' => [
			'tname'=> 'bar_tv_order',
			'lead' => 'user_id',
			'ptype'=> 0,
			'desc' => '用户霸屏扣除余额或金钱',
		],
		'5' => [
			'tname'=> 'bar_order',
			'lead' => 'user_id',
			'ptype'=> 1,
			'desc' => '用户获得酒吧的返现积分',
		],
		'6' => [
			'tname'=> 'shop_order',
			'lead' => 'user_id',
			'ptype'=> 1,
			'desc' => '用户获得商城的返现积分',
		],
		'7' => [
			'tname'=> 'bar_order',
			'lead' => 'user_id',
			'ptype'=> 1,
			'desc' => '用户获得酒吧推荐盈利分成',
		],
		'8' => [
			'tname'=> 'im_moneyout',
			'lead' => 'user_id',
			'ptype'=> 1,
			'desc' => '用户提现扣除积分余额',
		],
		'9' => [
			'tname'=> 'bar_order',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '酒吧卖酒进账',
		],
		'10' => [
			'tname'=> 'bar_order',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '酒吧给用户的返现积分',
		],
		'11' => [
			'tname'=> 'bar_order',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '酒吧给平台的手续费',
		],
		'12' => [
			'tname'=> 'bar_tv_order',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '霸屏收入',
		],
		'13' => [
			'tname'=> 'bar_tv_order',
			'lead' => 'bar_id',
			'ptype'=> 1,
			'desc' => '酒吧给平台的霸屏收入手续费',
		],
		'14' => [
			'tname'=> 'shop_order',
			'lead' => 'shop_id',
			'ptype'=> 1,
			'desc' => '商城买卖进账',
		],
		'15' => [
			'tname'=> 'shop_order',
			'lead' => 'user_id',
			'ptype'=> 0,
			'desc' => '用户在商城购买支出',
		],
		'16' => [
			'tname'=> 'shop_order',
			'lead' => 'shop_id',
			'ptype'=> 1,
			'desc' => '商城给用户返现扣除积分余额',
		],
		'17' => [
			'tname'=> 'shop_order',
			'lead' => 'shop_id',
			'ptype'=> 1,
			'desc' => '商城给平台的手续费',
		],
		
	],
];
<?php
return array (//'配置项'=>'配置值'
'DB_TYPE' => 'mysql', // 数据库类型
'DB_HOST' => '127.0.0.1', // 服务器地址
'DB_NAME' => 'dzqc_xiaoqi', // 数据库名
'DB_USER' => 'root', // 用户名
'DB_PWD' => 'dgw1990', // 密码
'DB_PORT' => '3306', // 端口
'DB_PREFIX' => 'dzqc_', // 数据库表前缀


'TMPL_TEMPLATE_SUFFIX' => '.html', // 默认模板文件后缀


'URL_HTML_SUFFIX' => '', // URL伪静态后缀设置


'APP_AUTOLOAD_PATH' => '@.Core,@.Tool', // 自动载入


'VAR_PAGE' => 'nowPage',
'SESSION_AUTO_START' => true,

	/* RBAC 配置 */
	"RBAC_SUPERADMIN" => 'admin',              //超级管理员名称
	"ADMIN_AUTH_KEY" => 'superadmin',          //超级管理员识别号(必配)
    "USER_AUTH_ON" => true,                    //是否开启权限验证(必配)
    "USER_AUTH_TYPE" => 1,                     //验证方式（1、登录验证；2、实时验证）
    "USER_AUTH_KEY" => 'uid',                  //用户认证识别号(必配)
    
//    "USER_AUTH_MODEL" => 'User',               //验证用户表模型 dzqc_admin_user
    'USER_AUTH_GATEWAY'  =>  '/Login/index',  //用户认证失败，跳转URL
//   'AUTH_PWD_ENCODER'=>'md5',                 //默认密码加密方式
    
    "NOT_AUTH_MODULE" => 'Index,Login',       //无需认证的控制器
//    "NOT_AUTH_ACTION" => '',              //无需认证的方法
//    'REQUIRE_AUTH_MODULE' =>  '',              //默认需要认证的模块
//    'REQUIRE_AUTH_ACTION' =>  '',              //默认需要认证的动作
//    'GUEST_AUTH_ON'   =>  false,               //是否开启游客授权访问
//    'GUEST_AUTH_ID'   =>  0,                   //游客标记
	'RBAC_ROLE_TABLE' => 'dzqc_admin_role',
	'RBAC_USER_TABLE' => 'dzqc_admin_role_user',
	'RBAC_ACCESS_TABLE' => 'dzqc_admin_access',
	'RBAC_NODE_TABLE' => 'dzqc_admin_node',
    'URL_MODEL'             => 1, 

)//
;



?>
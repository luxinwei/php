//
//  MyURLS.h
//  DZQCStudent
//
//  Created by dazaoqiancheng on 16/5/16.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#ifndef MyURLS_h
#define MyURLS_h

#define  baseIP    @"http://192.168.1.189/dzqc_xiaoqi_svn/"//内网

//获得注册验证码接口
#define sendEmailCode  [NSString stringWithFormat:@"%@EmailCode/send",baseIP]

//校验邮箱验证码接口
#define chkEmailCode  [NSString stringWithFormat:@"%@EmailCode/chkEmailCode",baseIP]

//注册接口
#define reg  [NSString stringWithFormat:@"%@Company/reg",baseIP]

//登陆接口
#define login  [NSString stringWithFormat:@"%@Company/login",baseIP]

//第三方登陆接口
#define OAuth  [NSString stringWithFormat:@"%@User/OAuth",baseIP]

//修改密码接口
#define modifyPwd  [NSString stringWithFormat:@"%@User/modifyPwd",baseIP]


//忘记密码接口
#define forgetPwd  [NSString stringWithFormat:@"%@Company/forgetPwd",baseIP]

//获得注册验证码接口
#define sendSmsCode  [NSString stringWithFormat:@"%@SMSCode/sendSmsCode",baseIP]

//校验注册验证码接口
#define chkSmsCode  [NSString stringWithFormat:@"%@SMSCode/chkSmsCode",baseIP]


//七牛存储
#define getToken  [NSString stringWithFormat:@"%@Qiniu/getToken",baseIP]


//企业实名认证
#define realNameAuth  [NSString stringWithFormat:@"%@Comauth/realNameAuth",baseIP]

//企业实名认证信息
#define realNameAuthstatus  [NSString stringWithFormat:@"%@Comauth/realNameAuthstatus",baseIP]


//企业实名认证信息
#define myBaseData  [NSString stringWithFormat:@"%@Company/myBaseData",baseIP]

//发布任务
//获取河南的所有城市列表
#define henanCity  [NSString stringWithFormat:@"%@DicArea/henanCity",baseIP]

//根据城市ID获取大学列表
#define getListByCity  [NSString stringWithFormat:@"%@DicSchool/getListByCity",baseIP]

//根据大学获取专业列表
#define getListBySchool  [NSString stringWithFormat:@"%@DicMajor/getListBySchool",baseIP]


//根据专业ID获取专业信息列表
#define dicMajorGetListByIDS  [NSString stringWithFormat:@"%@DicMajor/getListByIDS",baseIP]


//根据大学ID获取大学信息列表
#define dicSchoolGetListByIDS  [NSString stringWithFormat:@"%@DicSchool/getListByIDS",baseIP]

//发布任务
#define publishTask  [NSString stringWithFormat:@"%@CompanyTask/publishTask",baseIP]


//企业自己发布的任务列表
#define myPublishList  [NSString stringWithFormat:@"%@CompanyTask/myPublishList",baseIP]


//任务详情
#define detail  [NSString stringWithFormat:@"%@Task/detail",baseIP]


//任务的参与学生列表
#define listJoinStudents  [NSString stringWithFormat:@"%@CompanyTask/listJoinStudents",baseIP]



//同意学生申请
#define agreeJoin  [NSString stringWithFormat:@"%@CompanyTask/agreeJoin",baseIP]


//拒绝学生申请
#define refuseJoin  [NSString stringWithFormat:@"%@CompanyTask/refuseJoin",baseIP]


//准备开始任务
#define startTask  [NSString stringWithFormat:@"%@CompanyTask/startTask",baseIP]



//结束任务
#define endTask  [NSString stringWithFormat:@"%@CompanyTask/endTask",baseIP]

//同意申请退出
#define withdrawal  [NSString stringWithFormat:@"%@CompanyTask/withdrawal",baseIP]



//查看单个学生详细信息
#define informAtion  [NSString stringWithFormat:@"%@Student/informAtion",baseIP]


//查看单个学生详细信息
#define myPublishList  [NSString stringWithFormat:@"%@CompanyTask/myPublishList",baseIP]


#endif /* MyURLS_h */

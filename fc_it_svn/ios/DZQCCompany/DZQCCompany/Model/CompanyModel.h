//
//  CompanyModel.h
//  DZQCCompany
//
//  Created by dazaoqiancheng on 16/5/30.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface CompanyModel : NSObject

@property(nonatomic,copy)NSString *capital;//注册资金
@property(nonatomic,copy)NSString *card_image;//身份证图片上传
@property(nonatomic,copy)NSString *card_name;//运营者身份证姓名
@property(nonatomic,copy)NSString *companyimage;//营业执照图片
@property(nonatomic,copy)NSString * companyname;//公司名称
@property(nonatomic,copy)NSString *id_card_number;//运营者身份证号
@property(nonatomic,copy)NSString *industry;//行业
@property(nonatomic,copy)NSString *lega_lperson;//公司法人
@property(nonatomic,copy)NSString *operators_phone;//运营者手机号
@property(nonatomic,copy)NSString *reg_number;//营业注册号
@property(nonatomic,copy)NSString *seal_picture;//合照盖章图片
@property(nonatomic,copy)NSString *seat_of;//总部所在地

@property(nonatomic,strong)NSString *regtime;//注册时间

//个人信息
@property(nonatomic,copy)NSString *audit;//个人信息


//发布信息
@property(nonatomic,copy)NSString *id;
@property(nonatomic,copy)NSString *title;
@property(nonatomic,copy)NSString *name;
@property(nonatomic,copy)NSString *logo;
@property(nonatomic,copy)NSString *address;
@property(nonatomic,copy)NSString *full_address;


//任务列表
@property(nonatomic,strong)NSString *addtime;//任务发布时间

@property(nonatomic,strong)NSString *content;//任务内容
@property(nonatomic,strong)NSString *end_pay_money;//任务酬劳尾款
@property(nonatomic,strong)NSString *endtime;//任务结束时间
@property(nonatomic,strong)NSString *first_pay_money;//任务酬劳首付
@property(nonatomic,strong)NSString *join_number;//任务当前已报名人数
@property(nonatomic,strong)NSString *pay_money;//任务酬劳
@property(nonatomic,strong)NSString *pay_type;//任务支付方式，1：全款，2：首付和尾款
@property(nonatomic,strong)NSString *state_text;//我的报名当前状态
@property(nonatomic,strong)NSString *state;//任务当前状态值
@property(nonatomic,strong)NSString *uid;//任务发布者ID
@property(nonatomic,strong)NSString *work_days;//任务周期

@property(nonatomic,strong)NSString *surplus_days;//任务剩余天数
@property(nonatomic,strong)NSDictionary *publisherData;//公司信息

@property(nonatomic,strong)NSDictionary *fileList;//任务附件列表

@property(nonatomic,strong)NSDictionary *my_join_data;//我的报名信息，没有报名则为空
@property(nonatomic,strong)NSDictionary *user_data;//个人信息

@property(nonatomic,copy)NSString *taskid;//任务ID

@end

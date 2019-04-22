//
//  DialogView.h
//  总结
//
//  Created by dazaoqiancheng on 16/4/14.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DialogView : UIView

@property(strong,nonatomic)UIButton *cancellButton;//取消
@property(nonatomic,strong)UIButton *sureButton;//确定



- (id)initWithSuperViewController:(UIViewController *)viewController caption:(NSString *)caption messsge:(NSString *)messsge cancellString:(NSString *)cancellString sureString:(NSString *)sureString;


- (id)initWithSuperViewController:(UIViewController *)viewController caption:(NSString *)caption messsge:(NSString *)messsge sureString:(NSString *)sureString;



-(void)show;

- (void)hideTheView;

@end

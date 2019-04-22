//
//  TabBarController.m
//  常用
//
//  Created by dazaoqiancheng on 16/3/31.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "TabBarController.h"
#import "TuijianController.h"
#import "RenWuController.h"
#import "WoDeController.h"
#import "FourController.h"
#import "NavController.h"
//1.颜色
#define UIColorFromRGB(rgbValue) [UIColor colorWithRed:((float)((rgbValue & 0xFF0000) >> 16))/255.0 green:((float)((rgbValue & 0xFF00) >> 8))/255.0 blue:((float)(rgbValue & 0xFF))/255.0 alpha:1.0]

@interface TabBarController ()<UITabBarControllerDelegate>


@end

@implementation TabBarController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    self.delegate = self;
    
    [self createViewController];
    [self createTabBar];
    
    
    
    // Do any additional setup after loading the view.
}



#pragma mark 创建ViewControllers
-(void)createViewController {
    
    //ProductsViewController
    TuijianController *vc1 = [[TuijianController alloc]init];
    RenWuController *vc2 = [[RenWuController alloc]init];
    WoDeController *vc3 = [[WoDeController alloc]init];
    //FourController *vc4 = [[FourController alloc]init];
    
    //    vc1.tabBarItem.title = @"首页";
    //    vc2.tabBarItem.title = @"消息";
    //    vc3.tabBarItem.title = @"购物车";
    //    vc4.tabBarItem.title = @"个人中心";
    
    vc1.title = @"推荐";
    vc2.title = @"任务";
    vc3.title = @"我的";
    //vc4.title = @"我的";
    
    NavController *nav1 = [[NavController alloc]initWithRootViewController:vc1];
    NavController *nav2 = [[NavController alloc]initWithRootViewController:vc2];
    NavController *nav3 = [[NavController alloc]initWithRootViewController:vc3];
    
   // NavController *nav4 = [[NavController alloc]initWithRootViewController:vc4];
    
    
    NSArray   *vcArray =[NSArray arrayWithObjects:nav1,nav2,nav3, nil];
    self.viewControllers=vcArray;
    
    // 改变UITabBar底部的颜色
    UIView *backView = [[UIView alloc] initWithFrame:CGRectMake(0, 0, SCREEN_WIDTH, 49)];
    backView.backgroundColor = [UIColor whiteColor];
    [self.tabBar insertSubview:backView atIndex:0];
    
    self.tabBar.opaque = YES;//是否透明
    
}



#pragma mark 设置tabBar
-(void)createTabBar{
    //存储未点选
    NSArray*unSelectArray=@[@"tab_push_icon_normal",@"tab_work_icon_normal",@"tab_main_icon_normal"];
    //存储点选
    
    NSArray*SelectArray=@[@"tab_push_icon_press",@"tab_work_icon_press",@"tab_main_icon_press"];
    
    
    //系统自带的选中第一个
    for (int i=0; i<self.tabBar.items.count; i++) {
        
        UITabBarItem *item=self.tabBar.items[i];
        [item setImage:[[UIImage imageNamed:unSelectArray[i]] imageWithRenderingMode:UIImageRenderingModeAlwaysOriginal]];
        
        item.tag=i+1;
        
        [item setSelectedImage:[[UIImage imageNamed:SelectArray[i]] imageWithRenderingMode:UIImageRenderingModeAlwaysOriginal]];
    }
    
    
    
    //改变TabBar顶部那条线的颜色
    CGRect rect = CGRectMake(0, 0, SCREEN_WIDTH, 0.5);
    UIGraphicsBeginImageContext(rect.size);
    CGContextRef context = UIGraphicsGetCurrentContext();
    CGContextSetFillColorWithColor(context,
                                   UIColorFromRGB(0x999999).CGColor);
    CGContextFillRect(context, rect);
    UIImage *img = UIGraphicsGetImageFromCurrentImageContext();
    UIGraphicsEndImageContext();
    
    //这两个很主要缺一不可
    [self.tabBar setShadowImage:img];
    
    [self.tabBar setBackgroundImage:[[UIImage alloc]init]];
    
    //UITabBar的底部字的位置
    [[UITabBarItem appearance] setTitlePositionAdjustment:UIOffsetMake(0.0, -3)];
    
    //UITabBar的未选中的颜色
    [[UITabBarItem appearance] setTitleTextAttributes:@{ NSForegroundColorAttributeName : GRB1 }
                                             forState:UIControlStateNormal];
    //UITabBar的选中的颜色
    [[UITabBarItem appearance] setTitleTextAttributes:@{ NSForegroundColorAttributeName :GRB2 }
                                             forState:UIControlStateSelected];
    
}



-(void)tabBarController:(UITabBarController *)tabBarController didSelectViewController:(UIViewController *)viewController{
    
    NSLog(@"%d",self.selectedIndex);
    
}


//-(BOOL)tabBarController:(UITabBarController *)tabBarController shouldSelectViewController:(UIViewController *)viewController {
//    
//    if ([viewController.title isEqualToString:@"我的"]||[viewController.title isEqualToString:@"消息"]||[viewController.title isEqualToString:@"购物车"]) {
//        
//        NSUserDefaults *userDefault=[NSUserDefaults standardUserDefaults];
//        NSDictionary *userDic=[userDefault objectForKey:@"UserModel"];
//        NSString *userid=[userDic objectForKey:@"user_id"];
//        
//        if (userid == nil) {
////            //跳到登录页面
////            LoginController *login = [[LoginController alloc] init];
////            //隐藏tabbar
////            login.hidesBottomBarWhenPushed = YES;
////            [((BaseNavController *)tabBarController.selectedViewController) pushViewController:login animated:YES];
//            
//            return NO;
//            
//        }else{
//            
//            return YES;
//            
//        }
//    }
//    return YES;
//}



- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end

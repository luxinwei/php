//
//  BaseController.m
//  DZQCStudent
//
//  Created by dazaoqiancheng on 16/4/22.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "BaseController.h"
#import<CoreText/CoreText.h>
@interface BaseController ()

@end

@implementation BaseController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    self.view.backgroundColor=GRB6;
    
    
    
    if (iOS7) {
        NavHeight = 64;
        
    }else{
        NavHeight = 44;
    }
    
    
    [self buildNavBar];
    
    //左部的返回按钮
    if(self.navigationController.viewControllers.count>1)
    {
        [self.navBar.imageLeft setImage:[UIImage imageNamed:@"back-line"] forState:UIControlStateNormal];
        [self.navBar.imageLeft setImage:[UIImage imageNamed:@"back-line"] forState:UIControlStateHighlighted];
        
        [self.navBar.imageLeft addTarget:self action:@selector(backBtnAction) forControlEvents:UIControlEventTouchUpInside];
    }
    
    
    // Do any additional setup after loading the view.
}


- (void)buildNavBar
{
    if (self.navBar==nil) {
        
        if (iOS7) {
            self.navBar = [[NavigationView alloc] initWithFrame:
                           CGRectMake(0,0,SCREEN_WIDTH,64)];
        }else{
            
            self.navBar = [[NavigationView alloc] initWithFrame:
                           CGRectMake(0,0,SCREEN_WIDTH,44)];
        }
        
        self.lineView=[[UIView alloc]initWithFrame:CGRectMake(0, self.navBar.bottom-0.5, SCREEN_WIDTH, 0.5)];
        [self.navBar addSubview:self.lineView];
        
    }
    
    
    self.navBar.backgroundColor=GRB8;
    
    [self.view addSubview:self.navBar];
    
    
}


#pragma mark - Life cycle

- (UIStatusBarStyle)preferredStatusBarStyle {
    return UIStatusBarStyleLightContent;
}



- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}



#pragma mark - 下一级
- (void)pushNewViewController:(UIViewController *)newViewController {
    [self.navigationController pushViewController:newViewController animated:YES];
}



#pragma mark - 返回一级
-(void)backBtnAction
{
    [self.navigationController popViewControllerAnimated:YES];
    
    
}


- (void)backRoot{
    
    [self.navigationController popToRootViewControllerAnimated:YES];
    
}


- (void)saveToken:(NSString *)saveToken{
    
    NSUserDefaults *save=[NSUserDefaults standardUserDefaults];
    [save setValue:saveToken forKey:@"saveToken"];
    [save synchronize];
    
}


-(NSMutableAttributedString *)stringLength:(NSString *)strings numbers :(long)number{
    
    NSMutableAttributedString *attributedString =[[NSMutableAttributedString alloc]initWithString:strings];
    CFNumberRef num = CFNumberCreate(kCFAllocatorDefault,kCFNumberSInt8Type,&number);
    [attributedString addAttribute:(id)kCTKernAttributeName value:(__bridge id)num range:NSMakeRange(0,[attributedString length])];
    CFRelease(num);
   
    return attributedString;
    
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

//
//  FirstController.m
//  常用
//
//  Created by dazaoqiancheng on 16/3/31.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "FirstController.h"
#import "TestController.h"
#import "LoginController.h"
#import "ReallyFirstController.h"
#import "ReallyShenController.h"
#import "ReallyThirdController.h"
#import "NavController.h"

@interface FirstController ()

@end

@implementation FirstController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    self.view.backgroundColor=[UIColor grayColor];
    
    
    UIButton *button=[[UIButton alloc]initWithFrame:CGRectMake(0, 100, 100, 50)];
    [button setTitle:@"dddd" forState:UIControlStateNormal];
    [button addTarget:self action:@selector(cccccc) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:button];
    
    
    UIButton *button1=[[UIButton alloc]initWithFrame:CGRectMake(0, button.bottom+20, 100, 50)];
    [button1 setTitle:@"实名认证" forState:UIControlStateNormal];
    [button1 addTarget:self action:@selector(reall) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:button1];

    UIButton *button2=[[UIButton alloc]initWithFrame:CGRectMake(0, button1.bottom+20, 100, 50)];
    [button2 setTitle:@"审核状态" forState:UIControlStateNormal];
    [button2 addTarget:self action:@selector(realldddd) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:button2];
    // Do any additional setup after loading the view.
}



- (void)cccccc{
    
//    LoginController *logins=[[LoginController alloc]init];
//    [self.navigationController pushViewController:logins animated:YES];
    
    LoginController *loginVC = [[LoginController alloc]init];
    
    NavController *asz=[[NavController alloc]initWithRootViewController:loginVC];
    
    [self presentViewController:asz animated:YES completion:nil];
}


- (void)reall{
    
    
    ReallyFirstController *really=[[ReallyFirstController alloc]init];
    
    [self.navigationController pushViewController:really animated:YES];
    
    
}



- (void)realldddd{
    ReallyShenController  *ggggg=[[ReallyShenController alloc]init];
    
    [self.navigationController pushViewController:ggggg animated:YES];
    
    
}
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

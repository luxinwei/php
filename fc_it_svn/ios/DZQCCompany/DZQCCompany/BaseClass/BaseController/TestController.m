//
//  TestController.m
//  常用
//
//  Created by dazaoqiancheng on 16/3/31.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "TestController.h"
#import "FiveController.h"

@interface TestController ()

@end

@implementation TestController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    
    self.view.backgroundColor=[UIColor greenColor];
    
    UIButton *button=[[UIButton alloc]initWithFrame:CGRectMake(0, 100, 100, 50)];
    [button setTitle:@"dddd" forState:UIControlStateNormal];
    [button addTarget:self action:@selector(cccccc) forControlEvents:UIControlEventTouchUpInside];
    [self.view addSubview:button];
    
    // Do any additional setup after loading the view.
}


- (void)cccccc{
    
    
    FiveController *test=[[FiveController alloc]init];
    
    [self.navigationController pushViewController:test animated:YES];
    
    
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

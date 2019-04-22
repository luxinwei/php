//
//  SecondController.m
//  常用
//
//  Created by dazaoqiancheng on 16/3/31.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "RenWuController.h"
#import "TaskCell.h"
#import "TaskDetailController.h"
#import "PushTaskController.h"

@interface RenWuController ()<UITableViewDelegate,UITableViewDataSource>

@property(nonatomic,strong)UITableView *myTableView;

@property(nonatomic,strong)NSMutableArray *taskArray;

@end

@implementation RenWuController

- (void)viewDidLoad {
    [super viewDidLoad];
    self.navBar.titleLabel.text=TitleRenText1;
    
    self.taskArray = [NSMutableArray array];
    
    
    [self.navBar.imageRight setImage:[UIImage imageNamed:@"company_release"] forState:UIControlStateNormal];
    [self.navBar.imageRight addTarget:self action:@selector(fabuAction) forControlEvents:UIControlEventTouchUpInside];
    
    
    self.myTableView=[[UITableView alloc]initWithFrame:CGRectMake(0, NavHeight, SCREEN_WIDTH, SCREEN_HEIGHT-NavHeight-49) style:UITableViewStyleGrouped];
    self.myTableView.separatorStyle = UITableViewCellSeparatorStyleNone;
    self.myTableView.rowHeight = 60;
    self.myTableView.delegate=self;
    self.myTableView.dataSource=self;
    [self.view addSubview:self.myTableView];
    

    
    // Do any additional setup after loading the view.
}

- (void)viewWillAppear:(BOOL)animated{
    [super viewWillAppear:animated];
    self.navBar.titleLabel.textAlignment = NSTextAlignmentCenter;
    
    [self getAllTaskList:@"1"];
    
}


- (void)viewWillDisappear:(BOOL)animated{
    [super viewWillDisappear:animated];
    
    self.navBar.titleLabel.textAlignment = NSTextAlignmentLeft;
}



- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView{
    return 1;
}


-(NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    
    return self.taskArray.count;
    
}



-(UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath{
    
    static NSString *indentifer = @"TaskCell";
    
    
    TaskCell *cell = [tableView dequeueReusableCellWithIdentifier:indentifer];
    
    if (cell == nil) {
        
        cell = [[[NSBundle mainBundle]loadNibNamed:@"TaskCell" owner:self options:nil]lastObject];
    }
    
    if (self.taskArray.count>0) {
        CompanyModel *model = [self.taskArray objectAtIndex:indexPath.row];
        
        cell.model = model;
        
        
    }
    
    
    cell.selectionStyle = UITableViewCellSelectionStyleNone;
    
    return cell;
    
}



-(CGFloat)tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section{
    
    return 0.000001;
    
}


-(CGFloat)tableView:(UITableView *)tableView heightForFooterInSection:(NSInteger)section{
    return 0.0000001;
    
}


- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath{
    
    if (self.taskArray.count>0) {
        
        CompanyModel *model = [self.taskArray objectAtIndex:indexPath.row];
        TaskDetailController * task = [[TaskDetailController alloc]init];
        task.taskId = model.id;
        
        [self pushNewViewController:task];
        
        
    }
    
  
}




- (void)fabuAction{
    PushTaskController *push = [[PushTaskController alloc]init];
    
    [self pushNewViewController:push];
    
    
}


#pragma mark - 网络请求
#pragma mark -获取所有的任务
- (void)getAllTaskList:(NSString *)pageNumber{
    
    
    [self.taskArray removeAllObjects];
    
    
    __weak typeof(self) weakSelf = self;
    
    
    CustomToastView *toast = [[CustomToastView alloc]initWithIndicatorWithView:self.view withText:TitleText55];
    
    [toast startTheView];
    
    
    NSString *md5 = @"nowPagedzqc2016yuimyPublishList";
    
    AFHTTPRequestOperationManager *manager = [AFHTTPRequestOperationManager manager];
    
    //传入的参数
    NSDictionary *parameters = [NSDictionary dictionaryWithObjectsAndKeys:pageNumber,@"nowPage",[md5 md5],@"secret_key",bundleToken,@"token", nil];
    
    
   
    //发送请求
    [manager GET:myPublishList parameters:parameters success:^(AFHTTPRequestOperation *operation, id responseObject) {
        
        [toast stopAndRemoveFromSuperView];
        
        
        NSLog(@"%@",responseObject);
        
        
        NSString *status = [responseObject objectForKey:@"status"];
        
        
        if ([status intValue] == 1) {
            NSString *saveToken = [responseObject objectForKey:@"token"];
            
            [self saveToken:saveToken];
            
            NSArray *infoArray = [[responseObject objectForKey:@"list"]objectForKey:@"rows"];
            
            
            for (id allDic in infoArray) {
                CompanyModel *model=[[CompanyModel alloc]init];
                [model setValuesForKeysWithDictionary:allDic];
                
                [weakSelf.taskArray addObject:model];
            }
            
            
            
        }else{
            
            CustomToastView *toast = [[CustomToastView alloc]initWithView:self.view text:@"获取失败" duration:KDuration];
            
            [toast show];
            
            
            
        }
        
        dispatch_async(dispatch_get_main_queue(), ^{
            [weakSelf.myTableView reloadData];
        });
        
        
        
    } failure:^(AFHTTPRequestOperation *operation, NSError *error) {
        
        NSLog(@"%@",error);
        
        [toast stopAndRemoveFromSuperView];
        
    }];
    
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

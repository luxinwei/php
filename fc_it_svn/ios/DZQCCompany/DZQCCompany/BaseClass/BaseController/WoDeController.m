//
//  ThirdController.m
//  常用
//
//  Created by dazaoqiancheng on 16/3/31.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "WoDeController.h"
#import "MyHeaderCell.h"
#import "PersonInfoController.h"
#import "MyCenterCell.h"

@interface WoDeController ()<UITableViewDelegate,UITableViewDataSource>
{
    NSArray *titleArray;
    
    NSArray *titleImageArray;
    
}
@property(nonatomic,strong)UITableView *myTableView;

@property(nonatomic,strong)NSMutableArray *userArray;


@end

@implementation WoDeController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    self.navBar.titleLabel.text=@"我的";
    
    self.userArray = [NSMutableArray array];
    
    titleArray = @[@[],@[TitleText57,TitleText58,TitleText59],@[TitleText60],@[TitleText61],@[TitleText62,TitleText63]];
    
    titleImageArray = @[@[],@[@"content_lanched_icon",@"content_ing_icon",@"content_over_icon"],@[@"content_message_icon"],@[@"content_money_icon"],@[@"content_set_icon",@"content_help_icon"]];
    
    
    
    self.myTableView=[[UITableView alloc]initWithFrame:CGRectMake(0, NavHeight, SCREEN_WIDTH, SCREEN_HEIGHT-NavHeight-49) style:UITableViewStylePlain];
    self.myTableView.separatorStyle=UITableViewCellStyleDefault;
    self.myTableView.delegate=self;
    self.myTableView.dataSource=self;
    self.myTableView.rowHeight=90;
    [self.view addSubview:self.myTableView];

    
    // Do any additional setup after loading the view.
}


- (void)viewWillAppear:(BOOL)animated{
    [super viewWillAppear:animated];
    self.navBar.titleLabel.textAlignment = NSTextAlignmentCenter;
    
    [self getInfo];
    
    
}

- (void)viewWillDisappear:(BOOL)animated{
    [super viewWillDisappear:animated];
    
    self.navBar.titleLabel.textAlignment = NSTextAlignmentLeft;
}



- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView{
    return 5;
}


-(NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    
    if (section == 1) {
        return 3;
    }else if (section == 4){
        return 2;
    }
    
    return 1;
}



-(UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath{
    
    if (indexPath.section == 0) {
        static NSString *indentifer = @"MyHeaderCell";
        
        
        MyHeaderCell *cell = [tableView dequeueReusableCellWithIdentifier:indentifer];
        
        if (cell == nil) {
            
            cell = [[[NSBundle mainBundle]loadNibNamed:@"MyHeaderCell" owner:self options:nil]lastObject];
        }
        
        
        cell.selectionStyle = UITableViewCellSelectionStyleNone;
        
        return cell;
    }else{
        
        static NSString *indentifer = @"MyCenterCell";
        
        
        MyCenterCell *cell = [tableView dequeueReusableCellWithIdentifier:indentifer];
        if (cell == nil) {
            
            cell = [[[NSBundle mainBundle]loadNibNamed:@"MyCenterCell" owner:self options:nil]lastObject];
            
            
            if (indexPath.section != 0) {
                
                if (indexPath.row == 0) {
                    UIView *lineView = [[UIView alloc]initWithFrame:CGRectMake(0, 0, SCREEN_WIDTH, 0.5)];
                    lineView.backgroundColor =  GRB1;
                    [cell.contentView addSubview:lineView];
                }
            }
        }
        
        cell.infoLabel.text = titleArray[indexPath.section][indexPath.row];
        cell.firstImage.image = [UIImage imageNamed:titleImageArray[indexPath.section][indexPath.row]];
        
        if (indexPath.section == 1) {
            cell.numberLabel.text = @"15";
            
        }else{
            cell.numberLabel.text = @"";
            
        }
        
        cell.selectionStyle = UITableViewCellSelectionStyleNone;
        
        return cell;
        
        
    }
    
    
}

- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath{
    if (indexPath.section == 0) {
        return 90;
    }else{
        return 44;
        
    }
}

-(CGFloat)tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section{
    if (section == 0) {
        return 0.000001;
    }else{
        return 10;
    }
}

-(CGFloat)tableView:(UITableView *)tableView heightForFooterInSection:(NSInteger)section{
    return 0.0000001;
    
}



- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath{
    
    
    if (self.userArray.count>0) {
        CompanyModel *model= [self.userArray objectAtIndex:0];
        
        PersonInfoController *person = [[PersonInfoController alloc]init];
        
        person.audios = model.audit;
        
        
        
        
        [self.navigationController pushViewController:person animated:YES];
    }
    
}






- (void)getInfo{
    
    [self.userArray removeAllObjects];
    
    
    CustomToastView *toast = [[CustomToastView alloc]initWithIndicatorWithView:self.view withText:TitleText55];
    
    [toast startTheView];
    
    
    NSString *md5 = @"dzqc2016yuimyBaseData";
    
    AFHTTPRequestOperationManager *manager = [AFHTTPRequestOperationManager manager];
    
    //传入的参数
    NSDictionary *parameters = [NSDictionary dictionaryWithObjectsAndKeys:[md5 md5],@"secret_key",bundleToken,@"token", nil];
    
    
    //发送请求
    [manager GET:myBaseData parameters:parameters success:^(AFHTTPRequestOperation *operation, id responseObject) {
        
        [toast stopAndRemoveFromSuperView];
        
        
        NSLog(@"%@",responseObject);
        
        
        NSString *status = [responseObject objectForKey:@"status"];
        
        if ([status intValue] == 1) {
            NSString *saveToken = [responseObject objectForKey:@"token"];
            
            [self saveToken:saveToken];
            
            
            CompanyModel *model=[[CompanyModel alloc]init];
            [model setValuesForKeysWithDictionary:[responseObject objectForKey:@"user"]];
            [self.userArray addObject:model];
            
            
        }else{
            
        }
        
        
        
        
        
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

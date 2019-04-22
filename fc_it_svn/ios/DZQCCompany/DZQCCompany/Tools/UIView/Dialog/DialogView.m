//
//  DialogView.m
//  总结
//
//  Created by dazaoqiancheng on 16/4/14.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "DialogView.h"

@implementation DialogView

{
    UIViewController *_superViewController;
    UIView *_view;
    float _height;
}


#pragma mark - 两个按钮
- (id)initWithSuperViewController:(UIViewController *)viewController caption:(NSString *)caption messsge:(NSString *)messsge cancellString:(NSString *)cancellString sureString:(NSString *)sureString
{
    CGRect rect ;
    rect.origin = CGPointMake((SCREEN_WIDTH-270)/2, (SCREEN_HEIGHT-64-167)/2);
    rect.size = CGSizeMake(270, 167);
    self = [super initWithFrame:rect];
    
    if (self) {
        
        _superViewController = viewController;
        _height = rect.size.height;
        
        _view = [[UIView alloc]initWithFrame:CGRectMake(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT)];
        
        
        _view.hidden = YES;
        
        //_view.backgroundColor = [UIColor colorWithRed:0 green:0 blue:0 alpha:0.5];
        [viewController.view addSubview:_view];
        [_view addSubview:self];
        
        
        //设置边框的圆角
        self.backgroundColor=[UIColor whiteColor];
        self.layer.cornerRadius = 8;
        self.layer.masksToBounds = YES;
        [_view addSubview:self];
        
        UILabel *capLabel = [[UILabel alloc]initWithFrame:CGRectMake(0, 0, self.frame.size.width, 44)];
        capLabel.text = caption;
        capLabel.font = [UIFont fontWithName:@"Helvetica-Bold" size:16];
        
        capLabel.textAlignment = NSTextAlignmentCenter;
        [self addSubview:capLabel];
        
        
        
//        UIView *linview=[[UIView alloc]initWithFrame:CGRectMake(0, self.titleLable.bottom, self.frame.size.width, 1)];
//        linview.backgroundColor=LineColor;
//        [self addSubview:linview];
        
        
        UILabel *messageLabel = [[UILabel alloc]initWithFrame:CGRectMake(10, 49, self.frame.size.width-20, 49)];
        messageLabel.text = messsge;
        messageLabel.numberOfLines = 0;
        messageLabel.font = [UIFont systemFontOfSize:14];
        messageLabel.textAlignment = NSTextAlignmentCenter;
        [self addSubview:messageLabel];
        
        
        self.cancellButton = [UIButton buttonWithType:UIButtonTypeSystem];
        [self.cancellButton setTitle:cancellString forState:UIControlStateNormal];
        
//        [self.cancellButton.layer setMasksToBounds:YES];//设置按钮的圆角半径不会被遮挡
//        [self.cancellButton.layer setCornerRadius:8];
//        [self.cancellButton.layer setBorderWidth:0.5];//设置边界的宽度
//        [self.cancellButton setTitleColor:UIColorFromRGB(0xf37221) forState:UIControlStateNormal];
        //self.cancellButton.layer.borderColor = UIColorFromRGB(0xf37221).CGColor;
        [self.cancellButton setTitleColor:[UIColor lightGrayColor] forState:UIControlStateNormal];
        self.cancellButton.frame = CGRectMake(0, 100, 270/2, 43);
        [self addSubview:self.cancellButton];
        
        
        
        self.sureButton= [UIButton buttonWithType:UIButtonTypeSystem];
        [self.sureButton setTitle:sureString forState:UIControlStateNormal];
//        [self.sureButton.layer setMasksToBounds:YES];//设置按钮的圆角半径不会被遮挡
//        [self.sureButton.layer setCornerRadius:8];
//        [self.sureButton.layer setBorderWidth:0.5];//设置边界的宽度
//        self.sureButton.backgroundColor =  UIColorFromRGB(0xf37221);
//        self.sureButton.layer.borderColor =UIColorFromRGB(0xf37221).CGColor;
        [self.sureButton setTitleColor:[UIColor redColor] forState:UIControlStateNormal];
        
        self.sureButton.frame = CGRectMake(270/2, 100, 270/2, 43);
        [self addSubview:self.sureButton];
        
        
    }
    
    return self;
    
}


#pragma mark - 一个按钮
- (id)initWithSuperViewController:(UIViewController *)viewController caption:(NSString *)caption messsge:(NSString *)messsge sureString:(NSString *)sureString{
    
    CGRect rect ;
    rect.origin = CGPointMake((SCREEN_WIDTH-270)/2, (SCREEN_HEIGHT-64-167)/2);
    rect.size = CGSizeMake(270, 167);
    self = [super initWithFrame:rect];
    
    if (self) {
        _superViewController = viewController;
        _height = rect.size.height;
        
        _view = [[UIView alloc]initWithFrame:CGRectMake(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT)];
        
        
        _view.hidden = YES;
        //_view.backgroundColor = [UIColor colorWithRed:0 green:0 blue:0 alpha:0.5];
        [viewController.view addSubview:_view];
        [_view addSubview:self];
        
        
        //设置边框的圆角
        self.backgroundColor=[UIColor whiteColor];
        self.layer.cornerRadius = 5;
        self.layer.masksToBounds = YES;
        [_view addSubview:self];
        
        UILabel *capLabel = [[UILabel alloc]initWithFrame:CGRectMake(10, 0, self.frame.size.width-20, 44)];
        capLabel.text = caption;
        capLabel.font = [UIFont systemFontOfSize:16];
        [self addSubview:capLabel];
        
        UILabel *messageLabel = [[UILabel alloc]initWithFrame:CGRectMake(10, 49, self.frame.size.width-20, 49)];
        messageLabel.text = messsge;
        messageLabel.numberOfLines = 0;
        messageLabel.font = [UIFont systemFontOfSize:14];
        [self addSubview:messageLabel];
        
        
        self.sureButton= [UIButton buttonWithType:UIButtonTypeSystem];
        [self.sureButton setTitle:sureString forState:UIControlStateNormal];
        [self.sureButton setTitleColor:[UIColor blueColor] forState:UIControlStateNormal];
        self.sureButton.frame = CGRectMake(self.frame.size.width-90, 100, 80, 43);
        self.sureButton.contentMode=UIViewContentModeRight;
        [self addSubview:self.sureButton];
        
        
    }
    
    return self;
    
}




-(void)show
{
    _view.hidden = NO;
    [_view setBackgroundColor:[UIColor colorWithRed:0 green:0 blue:0 alpha:0.3]];
    
    //    _view.backgroundColor = [UIColor whiteColor];
    //    _view.alpha = 0.6;
    
}




- (void)hideTheView
{
    [UIView animateWithDuration:0.2 animations:^{
        [self setOrigin:CGPointMake(0, SCREEN_HEIGHT)];
    } completion:^(BOOL finished) {
        _view.hidden = YES;
    }];
}



/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect {
    // Drawing code
}
*/

@end

//
//  AppDelegate.m
//  DZQCCompany
//
//  Created by dazaoqiancheng on 16/4/7.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "AppDelegate.h"
#import "TabBarController.h"
#import "WelcomeController.h"
#import "IQKeyboardManager.h"
#import <Bugly/Bugly.h>
#import "NavController.h"

@interface AppDelegate ()

@end

@implementation AppDelegate


- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
    
    WelcomeController *welcome = [[WelcomeController alloc]init];
    
    NavController *nav = [[NavController alloc]initWithRootViewController:welcome];
    
    self.window.rootViewController=nav;
    
    
    
   
    
    //键盘的自适应(贯穿全部)
    [self keyBoard];
    
    //崩溃日志
    [self crashList];
    // Override point for customization after application launch.
    return YES;
}


#pragma mark - 键盘的自适应(贯穿全部) 第三方
- (void)keyBoard{
    
    IQKeyboardManager *manager = [IQKeyboardManager sharedManager];
    manager.enable = YES;
    manager.shouldResignOnTouchOutside = YES;
    manager.shouldToolbarUsesTextFieldTintColor = YES;
    manager.enableAutoToolbar = YES;
    
}

#pragma mark - 崩溃日志
-(void)crashList{
    
    
    BuglyConfig * config = [[BuglyConfig alloc]init];
    
#if DEBUG
    config.debugMode = YES;//SDK Debug信息开关, 默认关闭
#endif
    config.reportLogLevel = BuglyLogLevelWarn;
    config.blockMonitorEnable = YES;//卡顿监控开关，默认关闭
    config.blockMonitorTimeout = 1.5;//卡顿监控判断间隔，单位为秒
    config.unexpectedTerminatingDetectionEnable=YES;//非正常退出事件记录开关，默认关闭
    config.channel = @"Bugly";
    
    [Bugly startWithAppId:BuglyAppID config:config];
    [Bugly setTag:1799];
    [Bugly setUserIdentifier:[NSString stringWithFormat:@"User: %@", [NSProcessInfo processInfo].hostName]];
    
    [Bugly setUserValue:[NSProcessInfo processInfo].processName forKey:@"App"];
}


- (void)applicationWillResignActive:(UIApplication *)application {
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationDidEnterBackground:(UIApplication *)application {
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
}

- (void)applicationWillEnterForeground:(UIApplication *)application {
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationDidBecomeActive:(UIApplication *)application {
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}

- (void)applicationWillTerminate:(UIApplication *)application {
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}

@end

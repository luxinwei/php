//
//  NSString+Judge.m
//  总结
//
//  Created by dazaoqiancheng on 16/4/21.
//  Copyright © 2016年 DZQC. All rights reserved.
//

#import "NSString+Judge.h"

@implementation NSString (Judge)

#pragma mark - 判断手机号
- (BOOL)validateMobile{
    
    NSString *phone=self;
    
    
    if (phone.length!=11) {
        return NO;
    }
    
    
    NSString *MOBILE = @"^1[34578]\\d{9}$";
    
    NSPredicate *regexTestMobile = [NSPredicate predicateWithFormat:@"SELF MATCHES %@",MOBILE];
    
    
    if ([regexTestMobile evaluateWithObject:self]) {
        
        return YES;
        
        
    }else {
        
        
        return NO;
        
    }
}


#pragma mark - 判断邮箱

- (BOOL) validateEmail
{
    NSString *emailRegex = @"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}";
    NSPredicate *emailTest = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", emailRegex];
    return [emailTest evaluateWithObject:self];
}


#pragma mark - 判断身份证号
- (BOOL) validateIdentityCard
{
    NSString *identityCard=self;
    
    BOOL flag;
    
    if (identityCard.length !=18) {
        flag = NO;
        return flag;
    }
    
    NSString *regex2 = @"^(\\d{14}|\\d{17})(\\d|[xX])$";
    NSPredicate *identityCardPredicate = [NSPredicate predicateWithFormat:@"SELF MATCHES %@",regex2];
    
    return [identityCardPredicate evaluateWithObject:identityCard];
}


#pragma mark - 判断银行卡号
- (BOOL) checkCardNo{
    int oddsum = 0;     //奇数求和
    int evensum = 0;    //偶数求和
    int allsum = 0;
    NSString *cardNo=self;
    int cardNoLength = (int)[cardNo length];
    int lastNum = [[cardNo substringFromIndex:cardNoLength-1] intValue];
    
    cardNo = [cardNo substringToIndex:cardNoLength - 1];
    
    for (int i = cardNoLength -1 ; i>=1;i--) {
        NSString *tmpString = [cardNo substringWithRange:NSMakeRange(i-1, 1)];
        int tmpVal = [tmpString intValue];
        if (cardNoLength % 2 ==1) {
            if((i % 2) == 0){
                tmpVal *= 2;
                if(tmpVal>=10)
                    tmpVal -= 9;
                evensum += tmpVal;
            }else{
                oddsum += tmpVal;
            }
        }else{
            if((i % 2) == 1){
                tmpVal *= 2;
                if(tmpVal>=10)
                    tmpVal -= 9;
                evensum += tmpVal;
            }else{
                oddsum += tmpVal;
            }
        }
    }
    
    allsum = oddsum + evensum;
    allsum += lastNum;
    if((allsum % 10) == 0)
        return YES;
    else
        return NO;
}

#pragma mark - 汉字获取首字母大写
-(NSString *)hanziPinYin{
    
    NSString *hanziText=self;
    
    NSString *upHanzi;

    if ([hanziText length]) {
        //转成了可变字符串
        NSMutableString *ms = [[NSMutableString alloc] initWithString:hanziText];
        
        //先转换为带声调的拼音 这是第一步，这两步一步都不能少
        CFStringTransform((CFMutableStringRef)ms,NULL, kCFStringTransformMandarinLatin,NO);
        //再转换为不带声调的拼音
        CFStringTransform((CFMutableStringRef)ms,NULL, kCFStringTransformStripDiacritics,NO);
        ////获取首字母
        upHanzi=[ms substringToIndex:1];
        //转化为大写拼音
        upHanzi=[upHanzi capitalizedString];
        
    }
    
    
    return upHanzi;
    
}
    
@end

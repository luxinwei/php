package com.dzqc.student.utils;

import android.content.Context;
import android.util.DisplayMetrics;

public class DensityUtils {

	public static DisplayMetrics getDisplayMetrics(Context context){
        return context.getResources().getDisplayMetrics();
	}
	
	public static int dp2Px(Context context, float dp) { 
	    final float scale = context.getResources().getDisplayMetrics().density;
	    return (int) (dp * scale + 0.5f); 
	} 
	 
	public static int px2Dp(Context context, float px) { 
	    final float scale = context.getResources().getDisplayMetrics().density;
	    return (int) (px / scale + 0.5f); 
	} 
}

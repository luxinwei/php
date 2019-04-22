package com.dzqc.enterprise.utils;

import android.view.ViewGroup;

public class ViewUtils {
	
	public static void setEnabledWithChild(ViewGroup viewGroup, boolean enabled){
		viewGroup.setEnabled(enabled);
		setChildEnabled(viewGroup, enabled);
    }

	public static void setChildEnabled(ViewGroup viewGroup, boolean enabled){
    	int count = viewGroup.getChildCount();
    	for(int i = 0; i < count; i++){
    		viewGroup.getChildAt(i).setEnabled(enabled);
    	}
    }
	
}

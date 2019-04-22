package com.dzqc.enterprise.ui.listener;

import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;

public class DelEditTextWatcher implements TextWatcher {
	
	private View delBtn;
	
	public DelEditTextWatcher(View delBtn){
		this.delBtn = delBtn;
		delBtn.setVisibility(View.GONE);
	}
	
	@Override
	public void onTextChanged(CharSequence s, int start, int before, int count) {}
	
	@Override
	public void beforeTextChanged(CharSequence s, int start, int count, int after) {}
	
	@Override
	public void afterTextChanged(Editable s) {
		delBtn.setVisibility(s.length() > 0 ? View.VISIBLE : View.GONE);
	}
}

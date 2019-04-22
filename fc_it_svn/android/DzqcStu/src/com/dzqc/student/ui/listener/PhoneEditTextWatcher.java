package com.dzqc.student.ui.listener;

import java.util.List;

import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;

public class PhoneEditTextWatcher implements TextWatcher {

	private TextView tvRegister;
	private List<EditText> listEdit;

	public PhoneEditTextWatcher(TextView tvRegister, List<EditText> list) {
		this.tvRegister = tvRegister;
		this.listEdit = list;
	}
	int count=0;//记录输入框不为空的个数
	
	@SuppressWarnings("deprecation")
	@Override
	public void afterTextChanged(Editable s) {
		// TODO Auto-generated method stub
		count=0;
		if (s.length() > 0) {
			for (EditText et : listEdit) {
				if (!et.getText().toString().equals("")) {
					count++;
				}
			}
			if (count==listEdit.size()) {
				tvRegister.setEnabled(true);
				tvRegister.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.user_login_btn));
			}
		} else {
			count=0;
			tvRegister.setEnabled(false);
			tvRegister.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
		}
	}

	@Override
	public void beforeTextChanged(CharSequence s, int start, int count,
			int after) {
		// TODO Auto-generated method stub

	}

	@Override
	public void onTextChanged(CharSequence s, int start, int before, int count) {
		// TODO Auto-generated method stub

	}
}

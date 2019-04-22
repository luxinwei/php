package com.dzqc.student.ui.listener;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;

import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;
import android.widget.TextView;

public class AccountEditTextWatcher implements TextWatcher {

	private TextView tvLogin;
	private EditText etInfo;

	public AccountEditTextWatcher(TextView tvlogin, EditText etinfo) {
		this.tvLogin = tvlogin;
		this.etInfo = etinfo;
	}

	@SuppressWarnings("deprecation")
	@Override
	public void afterTextChanged(Editable s) {
		// TODO Auto-generated method stub
		if (s.length() > 0) {
			if (!etInfo.getText().toString().equals("")) {
				tvLogin.setEnabled(true);
				tvLogin.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.user_login_btn));
			}
		} else {
			tvLogin.setEnabled(false);
			tvLogin.setBackgroundDrawable(DzqcStu.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
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

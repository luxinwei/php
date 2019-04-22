package com.dzqc.enterprise.ui.listener;


import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;

import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;
import android.widget.TextView;

public class PwdEditTextWatcher implements TextWatcher {

	private TextView tvLogin;
	private EditText etInfo;

	public PwdEditTextWatcher(TextView tvlogin, EditText etinfo) {
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
				tvLogin.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.user_login_btn));
			}
		} else {
			tvLogin.setEnabled(false);
			tvLogin.setBackgroundDrawable(DzqcEnterprise.getInstance().getResources().getDrawable(R.drawable.btn_disable_style));
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

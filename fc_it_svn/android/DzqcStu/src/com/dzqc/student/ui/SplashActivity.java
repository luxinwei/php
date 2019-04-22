package com.dzqc.student.ui;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.utils.AppManager;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

public class SplashActivity extends BaseActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.splash_layout);
		AppManager.getAppManager().addActivity(this);
		Handler x = new Handler();
		x.postDelayed(new splashhandler(), 2000);

	}

	class splashhandler implements Runnable {

		public void run() {
			int temp=UserInfoKeeper.getLoginState();
			String token=UserInfoKeeper.getToken(DzqcStu.getInstance());
			if (temp==1&&token!=null&&!token.equals("")&&!token.equals("-1")) {
				startActivity(new Intent(DzqcStu.getInstance(), MainActivity.class));
			}else {
				startActivity(new Intent(DzqcStu.getInstance(), UserLogin.class));
			}
			AppManager.getAppManager().finishActivity(SplashActivity.this);
		}
	}
}

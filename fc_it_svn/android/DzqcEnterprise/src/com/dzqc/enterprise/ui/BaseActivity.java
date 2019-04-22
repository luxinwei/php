package com.dzqc.enterprise.ui;

import com.dzqc.enterprise.R;

import android.app.Activity;
import android.media.AudioManager;
import android.os.Bundle;
import android.view.KeyEvent;

public class BaseActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setVolumeControlStream(AudioManager.STREAM_MUSIC);
	}

	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		// TODO Auto-generated method stub
		switch (keyCode) {
		case KeyEvent.KEYCODE_BACK:
			finish();
			overridePendingTransition(R.anim.in_from_left, R.anim.out_from_left);
			break;
		}
		return super.onKeyDown(keyCode, event);
	}

}

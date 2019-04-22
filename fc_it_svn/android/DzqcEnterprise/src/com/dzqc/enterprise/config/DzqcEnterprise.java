package com.dzqc.enterprise.config;

/*********
 * 框架基本方法实现类
 * *************/
import java.io.InputStream;
import java.util.HashMap;

import com.dzqc.enterprise.R;
import com.tencent.bugly.crashreport.CrashReport;

import android.annotation.SuppressLint;
import android.app.Application;
import android.content.Context;
import android.media.AudioManager;
import android.media.SoundPool;

public class DzqcEnterprise extends Application {
	// 是否打印log，发布的时候不现实，开发的时候显示
	public static boolean isDebug = true;
	private static DzqcEnterprise app;
	public static SoundPool soundPool = null;
	public final static int PAGESIZE = 20;

	@Override
	public void onCreate() {
		app = this;
		
		//Bugly初始化，会为自动检测环境并完成配置
		CrashReport.initCrashReport(getApplicationContext(), Constants.BUGLY_APPID, false);
		
	}

	public static DzqcEnterprise getInstance() {
		return app;
	}

	public static InputStream getKeyStore() {
		return null;
	}

	// 推送铃声提示
	@SuppressLint("UseSparseArrays")
	private static HashMap<Integer, Integer> hashMap = new HashMap<Integer, Integer>();;

	public static synchronized void initSound(Context c, int index) {
		if (soundPool == null || hashMap.size() == 0) {
			soundPool = new SoundPool(10, AudioManager.STREAM_MUSIC, 0);
			hashMap.put(1, soundPool.load(c, R.raw.ring, 1));
			// 停留200ms，否则不会立即执行声音播放动作
			try {
				Thread.sleep(200);
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		AudioManager mgr = (AudioManager) c.getSystemService(Context.AUDIO_SERVICE);
		float streamVolumeCurrent = mgr.getStreamVolume(AudioManager.STREAM_MUSIC);
		soundPool.play(hashMap.get(index), streamVolumeCurrent, streamVolumeCurrent, 1, 0, 1);
	}
}

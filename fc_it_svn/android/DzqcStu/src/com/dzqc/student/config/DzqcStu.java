package com.dzqc.student.config;

/*********
 * 框架基本方法实现类
 * *************/
import java.io.InputStream;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.List;

import cn.jpush.android.api.JPushInterface;

import com.dzqc.student.R;
import com.tencent.bugly.crashreport.CrashReport;
import com.umeng.socialize.PlatformConfig;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.Application;
import android.content.Context;
import android.media.AudioManager;
import android.media.SoundPool;

public class DzqcStu extends Application {
	// 是否打印log，发布的时候不现实，开发的时候显示
	public static boolean isDebug = true;
	private static DzqcStu app;
	public static SoundPool soundPool = null;
	public final static int PAGESIZE = 20;

	@Override
	public void onCreate() {
		app = this;

		// Bugly初始化，会为自动检测环境并完成配置
		CrashReport.initCrashReport(getApplicationContext(),
				Constants.BUGLY_APPID, false);

		// 极光推送初始化
		initJpush();

		// 友盟第三登录初始化
		initLoginByUmeng();
	}

	private void initJpush() {
		JPushInterface.setDebugMode(true); // 设置开启日志,发布时请关闭日志
		JPushInterface.init(this); // 初始化 JPush
	}

	// 各个平台的配置，建议放在全局Application或者程序入口
	private void initLoginByUmeng() {
		// 微信 wx12342956d1cab4f9,a5ae111de7d9ea137e88a5e02c07c94d
		// PlatformConfig.setWeixin("wx967daebe835fbeac",
		// "5bb696d9ccd75a38c8a0bfe0675559b3");
		PlatformConfig.setWeixin("wx2bcc19044354c9c0",
				"6453a95a5e3767146b3d6baf86630247");// 正式
		// 豆瓣RENREN平台目前只能在服务器端配置
		// 新浪微博
		PlatformConfig.setSinaWeibo("3921700954",
				"04b48b094faeb16683c32669824ebdad");

		PlatformConfig.setQQZone("100424468",
				"c7394704798a158208a74ab60104f0ba");
		PlatformConfig.setPinterest("1439206");
	}

	public static DzqcStu getInstance() {
		if (null == app) {
			app = new DzqcStu();
		}
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
		AudioManager mgr = (AudioManager) c
				.getSystemService(Context.AUDIO_SERVICE);
		float streamVolumeCurrent = mgr
				.getStreamVolume(AudioManager.STREAM_MUSIC);
		soundPool.play(hashMap.get(index), streamVolumeCurrent,
				streamVolumeCurrent, 1, 0, 1);
	}

	private List<Activity> activityList = new LinkedList<Activity>();

	// 单例模式中获取唯一的DzqcStu 实例
	// 添加Activity 到容器中
	public void addActivity(Activity activity) {
		activityList.add(activity);
	}

	// 遍历所有Activity 并finish
	public void exit() {

		for (Activity activity : activityList) {
			activity.finish();
		}

		System.exit(0);

	}
}

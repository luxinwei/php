package com.dzqc.student.ui.mine;


import java.io.File;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.Constants;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.DownloadThread;
import com.dzqc.student.http.DownloadThread.DownloadListener;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.UserLogin;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;

public class UserSetActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;


	private RelativeLayout rlUserExit;

	private LayoutInflater dialogflate;
	
	private RelativeLayout rlNewsApp,rlUserSafe;
	
	private String url="https://www.pgyer.com/dzqcStu";
	public ProgressDialog pBar;
	private Handler handler = new Handler();
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_setting);
		AppManager.getAppManager().addActivity(this);
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_user_setting));
	}

	private void initView() {
		dialogflate=LayoutInflater.from(this);
		
		rlUserExit = (RelativeLayout) findViewById(R.id.rl_userExit);
		rlUserExit.setOnClickListener(this);
		rlNewsApp=(RelativeLayout) findViewById(R.id.rl_NewsApp);
		rlNewsApp.setOnClickListener(this);
		rlUserSafe=(RelativeLayout) findViewById(R.id.rl_userSafe);
		rlUserSafe.setOnClickListener(this);
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(UserSetActivity.this);
			break;
		case R.id.rl_userExit:
			dialogShow("exit","提示","确认要退出应用吗");
			break;
		case R.id.rl_NewsApp://检查新版本
			dialogShow("app",getResources().getString(R.string.alert_title),getResources().getString(R.string.alert_content));
			break;
		case R.id.rl_userSafe://修改密码
			startActivity(new Intent(UserSetActivity.this, UserModifyPwd.class));
			break;
		default:
			break;
		}
	}
	
	public void dialogShow(final String type,String title,String content)
	{
		View view=dialogflate.inflate(R.layout.alert_dialog_layout,null);
		final AlertDialog alertDialog = new AlertDialog.Builder(this).create();  
		alertDialog.show();  
		Window window = alertDialog.getWindow();
		window.setContentView(view);
		TextView tv_title = (TextView) window.findViewById(R.id.tv_MessageTitle);  
		TextView tv_message = (TextView) window.findViewById(R.id.tv_MessageContent);  
		TextView tvCancer=(TextView) window.findViewById(R.id.tvCancer);
		TextView tvConfirm=(TextView) window.findViewById(R.id.tvConfirm);
		tv_message.setText(content);
		tv_title.setText(title);
		if (type.equals("exit")) {
			tvCancer.setText("取消");
			tvConfirm.setText("退出");
		}else if (type.equals("app")) {
			tvCancer.setText("暂不更新");
			tvConfirm.setText("立即更新");
		}
	    tvCancer.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				alertDialog.dismiss();
			}
		});
	    tvConfirm.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if (type.equals("exit")) {
					AppManager.getAppManager().AppExit(DzqcStu.getInstance());
					UserInfoKeeper.setLoginState(-1);
					UserInfoKeeper.updToken("");
					startActivity(new Intent(UserSetActivity.this, UserLogin.class));
				}else if (type.equals("app")) {
					File f=new File(Constants.apkPath);
					if (!f.exists()) {
						f.mkdirs();
					}
					String newFilename = Constants.apkPath+"/" + getResources().getString(R.string.app_name);
					File file = new File(newFilename);
					//如果目标文件已经存在，则删除。产生覆盖旧文件的效果
					if (file.exists()) {
						file.delete();
					}
					if (DzqcStu.isDebug) {
						Log.i("filePath--", file+"");
						Log.i("loadUrl--", url);
					}
					pBar = new ProgressDialog(UserSetActivity.this);
					pBar.setTitle("下载提示");
					pBar.setMessage("下载中");
					pBar.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
					new DownloadThread(file, url, new DownloadListener() {
						
						@Override
						public void success() {
							// TODO Auto-generated method stub
							down();
						}
						
						@Override
						public void failed() {
							// TODO Auto-generated method stub
							ToastUtils.showToast("下载失败");
						}
						
						@Override
						public void download(long downSize, long totalSize) {
							// TODO Auto-generated method stub
							ToastUtils.showToast(downSize+"下载进度");
							pBar.show();
							pBar.setMax((int) totalSize);
							pBar.setProgress((int) downSize);
						}
					}).start();
				}
				alertDialog.dismiss();
			}
		});
	}
	private void down() {

		handler.postDelayed(new Runnable() {

			@Override
			public void run() {
				pBar.cancel();
				update();
			}
		},500);
	}

	void update() {
		// 安装程序
		Intent intent = new Intent(Intent.ACTION_VIEW);
		intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
		intent.setDataAndType(Uri.fromFile(new File(Constants.apkPath, getResources().getString(R.string.app_name)+".apk")), "application/vnd.android.package-archive");
		this.startActivity(intent);
		/*if (!isLogin) {
			AppManager.getAppManager().finishAllActivity();
		}*/
	}

}

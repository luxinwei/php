package com.dzqc.student.ui.mine;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.PopupWindow;
import android.widget.TextView;
import android.widget.Toast;

import com.dzqc.student.R;
import com.dzqc.student.config.Constants;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpImage;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.model.UserBasicMode;
import com.dzqc.student.model.UserBasicMode.User;
import com.dzqc.student.qiniu.utils.FileUtils;
import com.dzqc.student.ui.BaseActivity;
import com.dzqc.student.ui.UserCertification;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.FilesUtils;
import com.dzqc.student.utils.SignUtils;
import com.dzqc.student.utils.SubmitDialog;
import com.dzqc.student.utils.ToastUtils;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.qiniu.android.http.ResponseInfo;
import com.qiniu.android.storage.UpCompletionHandler;
import com.qiniu.android.storage.UpProgressHandler;
import com.qiniu.android.storage.UploadManager;
import com.qiniu.android.storage.UploadOptions;
import com.qiniu.android.utils.AsyncRun;
import com.squareup.okhttp.OkHttpClient;
import com.squareup.okhttp.Request;
import com.squareup.okhttp.Response;

public class UserBasicActivity extends BaseActivity implements OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvUserName, tvSex, tvCardId;
	private ImageView imgUserPic;

	private PopupWindow popWindow;
	private LayoutInflater inflater;

	private static final int REQUEST_CODE = 8090;
	private static final int CAPTURE_IMAGE_CODE = 8091;
	private static final int CROP_CODE = 8092;

	private UploadManager uploadManager;
	private String uploadFilePath;
	private ProgressDialog pd;// 上传图片耗时操作框
	private File dirFile;
	private File tempFile;// 临时文件路径

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.personal_info);
		AppManager.getAppManager().addActivity(this);
		inflater = LayoutInflater.from(this);
		initHeader();
		initView();

	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.mine_basic_info));
	}

	private void initView() {
		imgUserPic = (ImageView) findViewById(R.id.img_userPic);
		imgUserPic.setOnClickListener(this);
		tvUserName = (TextView) findViewById(R.id.tv_userName);
		tvSex = (TextView) findViewById(R.id.tv_userSex);
		tvCardId = (TextView) findViewById(R.id.tv_userCardId);

		loadInfo();
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
	}

	/**
	 * 查询用户基本信息
	 */
	private void loadInfo() {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.myBaseData,
				Urls.MethodType.GET, Urls.function.myBaseData, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("用户基本信息返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<UserBasicMode>() {
						}.getType();
						UserBasicMode userBean = gson.fromJson(response, type);
						if (userBean.getStatus() == 1) {
							UserInfoKeeper.updToken(userBean.getToken());
							User user = userBean.getUser();
							String url = user.getAvatar();
							if (url != null) {
								HttpImage.loadImage(imgUserPic, url,
										R.drawable.mydefault,
										R.drawable.mydefault, 360);
								tvUserName.setText(user.getRealname());
								tvCardId.setText(user.getId_card());
							}
							if (user.getSex() != null) {
								tvSex.setText(user.getSex().equals("1") ? "男"
										: "女");
							}
						} else {
							ToastUtils.showToast(userBean.getInfo());
						}

					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			AppManager.getAppManager().finishActivity(UserBasicActivity.this);
			break;
		case R.id.img_userPic:// 头像上传
			showPopWindow(v);
			break;
		default:
			break;
		}
	}

	/**
	 * 判断popwindow隐藏与显示
	 */
	private void popCheck() {
		if (popWindow != null) {
			if (popWindow.isShowing()) {
				popWindow.dismiss();
				imgUserPic.setEnabled(true);
			}
		}
	}

	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		popCheck();
	}

	private void showPopWindow(View v) {
		View view = inflater.inflate(R.layout.popwindow_layout_media, null);
		TextView camera = (TextView) view.findViewById(R.id.tvCamera);
		TextView photos = (TextView) view.findViewById(R.id.tvPhotos);
		TextView cancer = (TextView) view.findViewById(R.id.tvCancer);
		popWindow = new PopupWindow(view,
				android.view.ViewGroup.LayoutParams.MATCH_PARENT,
				android.view.ViewGroup.LayoutParams.MATCH_PARENT);
		popWindow.setBackgroundDrawable(new BitmapDrawable());
		// 点击空白处时，隐藏掉pop窗口
		popWindow.setFocusable(true);
		popWindow.setOutsideTouchable(true);
		popWindow.setAnimationStyle(R.style.pop_window_style);
		popWindow.showAtLocation(v, Gravity.BOTTOM | Gravity.CENTER, 0, 0);
		cancer.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck();
			}
		});

		// 相册
		photos.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck();
				Intent selectIntent = new Intent(Intent.ACTION_PICK,
						MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
				selectIntent.setType("image/*");
				startActivityForResult(selectIntent, REQUEST_CODE);
			}
		});
		// 相机
		camera.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck();
				Intent photoIntent = new Intent(
						"android.media.action.IMAGE_CAPTURE");
				photoIntent.putExtra(MediaStore.EXTRA_OUTPUT,
						Uri.fromFile(createImageFile()));
				startActivityForResult(photoIntent, CAPTURE_IMAGE_CODE);
			}
		});
	}

	@SuppressLint("SimpleDateFormat")
	private File createImageFile() {
		String timestamp = new SimpleDateFormat("yyyyMMdd-HHmmss")
				.format(new Date());
		String imageFileName = "PIC-" + timestamp;
		dirFile = new File(Constants.userIcon);
		if (!dirFile.exists()) {
			dirFile.mkdirs();
		}
		try {
			tempFile = File.createTempFile(imageFileName, ".png", dirFile);
			this.uploadFilePath = tempFile.getAbsolutePath();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			tempFile = null;
		}
		return tempFile;
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		if (resultCode == RESULT_OK) {
			if (requestCode == CAPTURE_IMAGE_CODE) // 拍照
			{
				if (resultCode == RESULT_OK) {
					startPhotoZoom(Uri.fromFile(tempFile));
				} else if (resultCode == RESULT_CANCELED) {
					return;
				}
			} else if (requestCode == REQUEST_CODE) {// 相册
				Uri uri = data.getData();
				startPhotoZoom(uri);
			} else if (requestCode == CROP_CODE) // 照片裁剪后返回数据
			{
				if (data != null) {
					Bundle extras = data.getExtras();
					if (extras != null) {
						Bitmap photo = extras.getParcelable("data");
						saveBitmap(photo);
						this.uploadFilePath =tempFile.getAbsolutePath();
						uploadFile();
						Log.i("上传图片路径--》", uploadFilePath);
					}
				}
			}
		}
		super.onActivityResult(requestCode, resultCode, data);
	}

	/** 保存方法 */
	@SuppressLint("SimpleDateFormat") public void saveBitmap(Bitmap bitmap) {
		Log.e("保存图片-->", "保存图片");
		String timestamp = new SimpleDateFormat("yyyyMMddHHmmss")
				.format(new Date());
		String imageFileName = "user_" + timestamp;
		dirFile = new File(Constants.userIcon);
		if (!dirFile.exists()) {
			dirFile.mkdirs();
		}
		tempFile = new File(dirFile, imageFileName);
		if (tempFile.exists()) {
			tempFile.delete();
		}
		try {
			FileOutputStream out = new FileOutputStream(tempFile);
			bitmap.compress(Bitmap.CompressFormat.PNG, 90, out);
			out.flush();
			out.close();
			Log.i("已经保存-->", "已经保存");
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	/*
	 * 裁剪图片方法实现
	 * 
	 * @param uri
	 */
	public void startPhotoZoom(Uri uri) {
		/*
		 * 至于下面这个Intent的ACTION是怎么知道的，大家可以看下自己路径下的如下网页
		 * yourself_sdk_path/docs/reference/android/content/Intent.html
		 * 之前小马没仔细看过，其实安卓系统早已经有自带图片裁剪功能, 是直接调本地库的，
		 */
		Intent intent = new Intent("com.android.camera.action.CROP");
		intent.setDataAndType(uri, "image/*");
		// 下面这个crop=true是设置在开启的Intent中设置显示的VIEW可裁剪
		// intent.putExtra("crop", "true");//去除原因（不去除在infocusM560无法上传）

		// aspectX aspectY 是宽高的比例
		intent.putExtra("aspectX", 1);
		intent.putExtra("aspectY", 1);
		// outputX outputY 是裁剪图片宽高
		intent.putExtra("outputX", 150);
		intent.putExtra("outputY", 150);
		intent.putExtra("return-data", true);
		startActivityForResult(intent, CROP_CODE);
	}

	public void uploadFile() {
		if (this.uploadFilePath == null) {
			ToastUtils.showToast("请选择上传图片");
			return;
		}
		pd = SubmitDialog.getProgressDialog(UserBasicActivity.this, "请等待");
		pd.show();
		final StringBuilder sb = new StringBuilder();
		String sign = "";
		try {
			sign = SignUtils.signTopRequest(new HashMap<String, String>(),
					Constants.secret, Constants.SIGN_METHOD_MD5,
					Urls.function.getToken);
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		sb.append(Urls.ROOTURL + Urls.Method.getToken);
		String token = UserInfoKeeper.getToken(DzqcStu.getInstance());// token参数
		if (token.equals("-1")) {
			sb.append("?secret_key" + "=" + sign + "&token=");
		} else {
			sb.append("?secret_key" + "=" + sign + "&token=" + token);
		}
		if (DzqcStu.isDebug) {
			Log.i("---》》拼接参数结果", sb.toString());
		}
		new Thread(new Runnable() {
			@Override
			public void run() {
				final OkHttpClient httpClient = new OkHttpClient();
				Request req = new Request.Builder().url(sb.toString())
						.method("GET", null).build();
				Response resp = null;
				try {
					resp = httpClient.newCall(req).execute();
					JSONObject jsonObject = new JSONObject(resp.body().string());
					String uploadToken = jsonObject.getString("qiniu_token");
					upload(uploadToken);
				} catch (Exception e) {
					AsyncRun.run(new Runnable() {
						@Override
						public void run() {
							Toast.makeText(UserBasicActivity.this, "获取token失败",
									Toast.LENGTH_LONG).show();
						}
					});
					if (pd.isShowing()) {
						pd.cancel();
					}
				} finally {
					if (resp != null) {
						try {
							resp.body().close();
						} catch (IOException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}
				}
			}
		}).start();
	}

	private void upload(String uploadToken) {
		if (this.uploadManager == null) {
			this.uploadManager = new UploadManager();
		}
		File uploadFile = new File(this.uploadFilePath);
		UploadOptions uploadOptions = new UploadOptions(null, null, false,
				new UpProgressHandler() {
					@Override
					public void progress(String key, double percent) {

					}
				}, null);
		final long startTime = System.currentTimeMillis();
		final long fileLength = uploadFile.length();

		this.uploadManager.put(uploadFile, null, uploadToken,
				new UpCompletionHandler() {
					@Override
					public void complete(String key, ResponseInfo respInfo,
							JSONObject jsonData) {
						// reset status
						AsyncRun.run(new Runnable() {
							@Override
							public void run() {

							}
						});
						long lastMillis = System.currentTimeMillis()
								- startTime;
						if (respInfo.isOK()) {
							try {
								String fileKey = jsonData.getString("key");
								if (DzqcStu.isDebug) {
									Log.i("获取七牛key值--->", fileKey);
								}
								submitUserPic(fileKey);
							} catch (JSONException e) {
								Toast.makeText(UserBasicActivity.this, "无响应",
										Toast.LENGTH_LONG).show();
							}
						} else {
							Toast.makeText(UserBasicActivity.this, "图片上传失败", Toast.LENGTH_LONG)
									.show();
							if (pd.isShowing()) {
								pd.cancel();
							}
						}
					}

				}, uploadOptions);
	}

	// 图片上传方法
	private void submitUserPic(String qiniuKey) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("avatar_key", qiniuKey);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.saveStudentAvatar,
				Urls.MethodType.GET, Urls.function.saveStudentAvatar, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("图片上传结果输出----》", response);
						}
						if (pd.isShowing()) {
							pd.cancel();
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<NormalResultModel>() {
						}.getType();
						NormalResultModel resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							ToastUtils.showToast(resultBean.getInfo());
							File file = new File(uploadFilePath);
							if (file.exists()) {
								Bitmap bm = BitmapFactory
										.decodeFile(uploadFilePath);
								imgUserPic.setImageBitmap(FilesUtils
										.toRoundBitmap(bm));
							} else {
								imgUserPic
										.setImageResource(R.drawable.mydefault);
							}
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("httpFail----》", response);
						}
					}

				});
	}

}

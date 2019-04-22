package com.dzqc.enterprise.ui;

import java.io.File;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.Constants;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.http.Urls.MethodType;
import com.dzqc.enterprise.json.JsonToStrUtils;
import com.dzqc.enterprise.json.ResultUtils;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.qiniu.utils.FileUtils;
import com.dzqc.enterprise.qiniu.utils.QiniuLabConfig;
import com.dzqc.enterprise.qiniu.utils.Tools;
import com.dzqc.enterprise.utils.EncodeUtf8;
import com.dzqc.enterprise.utils.SignUtils;
import com.dzqc.enterprise.utils.SubmitDialog;
import com.dzqc.enterprise.utils.ToastUtils;
import com.google.gson.Gson;
import com.qiniu.android.http.ResponseInfo;
import com.qiniu.android.storage.UpCompletionHandler;
import com.qiniu.android.storage.UpProgressHandler;
import com.qiniu.android.storage.UploadManager;
import com.qiniu.android.storage.UploadOptions;
import com.qiniu.android.utils.AsyncRun;
import com.squareup.okhttp.OkHttpClient;
import com.squareup.okhttp.Request;
import com.squareup.okhttp.Response;

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
import android.widget.LinearLayout;
import android.widget.PopupWindow;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

public class UserCertificationSubmitActivity extends BaseActivity implements
		OnClickListener {
	private static final int REQUEST_CODE_RUN = 8090;
	private static final int REQUEST_CODE_CARD = 8001;
	private static final int REQUEST_CODE_SIGN = 8002;
	private static final int CAPTURE_IMAGE_CODE_RUN = 8091;
	private static final int CAPTURE_IMAGE_CODE_CARD = 8092;
	private static final int CAPTURE_IMAGE_CODE_SIGN = 8093;
	private UserCertificationSubmitActivity context;
	
	private UploadManager uploadManager;
	private File picFile = null;//照相图片存储路径
	
	private long uploadLastTimePoint;
	private long uploadLastOffset;
	private long uploadFileLength;
	
	private String uploadRunPhotoPath;// runPhoto 营业执照路径
	private String uploadCardPhotoPath;// 运行者身份证图片路径
	private String uploadSignPhotoPath;// 盖章协议图片路径
	private ProgressDialog pd;// 耗时操作框

	private ResultMode resultMode;//返回json mode参数
	
	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvSubmit;
	private LinearLayout liCompanyPhoto, liOwnerPhoto, liCompanySign;

	private Bundle bundleOne, bundleTwo;
	private String comName, comLegalPerson, comRegNo, comMoney,
			comLocation, comCardName, comCardId, comPhone
			, comIndustry, phoneCode;

	private Map<String, String> mapKey = new HashMap<String, String>();
	int upLoadIndex=0;//上传图片索引
	private String uploadTokenTemp="";//上传七牛时需要的token
	
	
	private LayoutInflater inflater;
	private PopupWindow popWindow;
	
	private ImageView imgRun,imgCard,imgSign;//图片缩图
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_certification_submit);

		Intent intent = getIntent();
		bundleOne = intent.getBundleExtra("bundleOne");
		bundleTwo = intent.getBundleExtra("bundleTwo");
		if (bundleOne != null) {
			comName = bundleOne.getString("comName");
			comRegNo = bundleOne.getString("comNo");
			comMoney = bundleOne.getString("comMoney");
			comLegalPerson = bundleOne.getString("comOwnerName");
		}
		if (bundleTwo != null) {
			comIndustry = bundleTwo.getString("industry");
			comLocation = bundleTwo.getString("comLocation");
			comCardName = bundleTwo.getString("comOwnerCardName");
			comCardId = bundleTwo.getString("comOwnerCardId");
			comPhone = bundleTwo.getString("comOwnerPhone");
			phoneCode = bundleTwo.getString("phoneCheckCode");
		}

		initView();
	}

	private void initView() {
		inflater = LayoutInflater.from(this);
		
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(
				R.string.certification_company_title));

		tvSubmit = (TextView) findViewById(R.id.tv_certification_submit);
		tvSubmit.setOnClickListener(this);

		imgRun=(ImageView) findViewById(R.id.img_comRunPhoto);
		imgCard=(ImageView) findViewById(R.id.img_comCardPhoto);
		imgSign=(ImageView) findViewById(R.id.img_comSignPhoto);
		
		liCompanyPhoto = (LinearLayout) findViewById(R.id.li_companyPhoto);
		liOwnerPhoto = (LinearLayout) findViewById(R.id.li_companyOwnerPhoto);
		liCompanySign = (LinearLayout) findViewById(R.id.li_companySign);
		liCompanyPhoto.setOnClickListener(this);
		liOwnerPhoto.setOnClickListener(this);
		liCompanySign.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.li_companyPhoto:
			liCompanyPhoto.setEnabled(false);//防止多次点击
			showPopWindow(v, "run");
			break;
		case R.id.li_companyOwnerPhoto:
			liOwnerPhoto.setEnabled(false);//防止多次点击
			showPopWindow(v, "card");
			break;
		case R.id.li_companySign:
			liCompanySign.setEnabled(false);//防止多次点击
			showPopWindow(v, "sign");
			break;
		case R.id.tv_certification_submit:
			//上传
			uploadFile(v);
			break;
		case R.id.img_registerBack:
			this.finish();
			break;
		default:
			break;
		}
	}

	private void showPopWindow(final View vi, final String type) {
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
		popWindow.showAtLocation(vi, Gravity.BOTTOM | Gravity.CENTER, 0, 0);
		cancer.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck(vi);
			}
		});

		// 相册
		photos.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck(vi);
				Intent selectIntent = new Intent(Intent.ACTION_PICK,
						MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
				selectIntent.setType("image/*");
				if (type.equals("run")) {
					startActivityForResult(selectIntent, REQUEST_CODE_RUN);
				} else if (type.equals("card")) {
					startActivityForResult(selectIntent, REQUEST_CODE_CARD);
				} else if (type.equals("sign")) {
					startActivityForResult(selectIntent, REQUEST_CODE_SIGN);
				}
			}
		});
		// 相机
		camera.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				popCheck(vi);
				Intent intent = new Intent();
				intent.setAction(MediaStore.ACTION_IMAGE_CAPTURE);
				intent.addCategory(Intent.CATEGORY_DEFAULT);
				if (intent.resolveActivity(getPackageManager()) != null) {
					
					try {
						picFile = createImageFile(type);
					} catch (Exception ex) {
						Log.e("QiniuLab",
								"create file "
										+ UserCertificationSubmitActivity.this.uploadRunPhotoPath
										+ " failed");
					}
					if (picFile != null) {
						intent.putExtra(MediaStore.EXTRA_OUTPUT,
								Uri.fromFile(picFile));
						if (type.equals("run")) {
							UserCertificationSubmitActivity.this
									.startActivityForResult(intent,
											CAPTURE_IMAGE_CODE_RUN);
						} else if (type.equals("card")) {
							UserCertificationSubmitActivity.this
									.startActivityForResult(intent,
											CAPTURE_IMAGE_CODE_CARD);
						} else if (type.equals("sign")) {
							UserCertificationSubmitActivity.this
									.startActivityForResult(intent,
											CAPTURE_IMAGE_CODE_SIGN);
						}

					}
				}
			}
		});
	}

	private File createImageFile(String type) throws IOException {
		String timestamp = new SimpleDateFormat("yyyyMMdd-HHmmss")
				.format(new Date());
		String imageFileName = "PIC-" + timestamp;
		File storageDir = Environment
				.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
		File image = File.createTempFile(imageFileName, ".png", storageDir);
		if (type.equals("run")) {
			this.uploadRunPhotoPath = image.getAbsolutePath();
		} else if (type.equals("card")) {
			this.uploadCardPhotoPath = image.getAbsolutePath();
		} else if (type.equals("sign")) {
			this.uploadSignPhotoPath = image.getAbsolutePath();
		}

		
		return image;
	}

	/**
	 * 判断popwindow隐藏与显示
	 */
	private void popCheck(View v) {
		if (popWindow.isShowing()) {
			popWindow.dismiss();
			v.setEnabled(true);
		}
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		switch (requestCode) {
		case REQUEST_CODE_RUN:
			// If the file selection was successful
			if (resultCode == RESULT_OK) {
				if (data != null) {
					// Get the URI of the selected file
					final Uri uri = data.getData();
					try {
						// Get the file path from the URI
						final String path = FileUtils.getPath(this, uri);
						this.uploadRunPhotoPath = path;
						File file = new File(path);
						if (file.exists()) {
							Bitmap bm = BitmapFactory.decodeFile(path);
							imgRun.setImageBitmap(bm);
						}
					} catch (Exception e) {
						Toast.makeText(context, "上传失败", Toast.LENGTH_LONG)
								.show();
					}
				}
			}
			break;
		case REQUEST_CODE_CARD:
			// If the file selection was successful
			if (resultCode == RESULT_OK) {
				if (data != null) {
					// Get the URI of the selected file
					final Uri uri = data.getData();
					try {
						// Get the file path from the URI
						final String path = FileUtils.getPath(this, uri);
						this.uploadCardPhotoPath = path;
						File file = new File(path);
						if (file.exists()) {
							Bitmap bm = BitmapFactory.decodeFile(path);
							imgCard.setImageBitmap(bm);
						}
					} catch (Exception e) {
						Toast.makeText(context, "上传失败", Toast.LENGTH_LONG)
								.show();
					}
				}
			}
			break;
		case REQUEST_CODE_SIGN:
			// If the file selection was successful
			if (resultCode == RESULT_OK) {
				if (data != null) {
					// Get the URI of the selected file
					final Uri uri = data.getData();
					try {
						// Get the file path from the URI
						final String path = FileUtils.getPath(this, uri);
						this.uploadSignPhotoPath = path;
						File file = new File(path);
						if (file.exists()) {
							Bitmap bm = BitmapFactory.decodeFile(path);
							imgSign.setImageBitmap(bm);
						}
					} catch (Exception e) {
						Toast.makeText(context, "上传失败", Toast.LENGTH_LONG)
								.show();
					}
				}
			}
			break;
		case CAPTURE_IMAGE_CODE_RUN:
			if (resultCode==RESULT_OK) {
				Bitmap bm = BitmapFactory.decodeFile(picFile.getPath());
				imgRun.setImageBitmap(bm);
			}
			break;
		case CAPTURE_IMAGE_CODE_CARD:
			if (resultCode==RESULT_OK) {
				Bitmap bm = BitmapFactory.decodeFile(picFile.getPath());
				imgCard.setImageBitmap(bm);
			}
			break;
		case CAPTURE_IMAGE_CODE_SIGN:
			if (resultCode==RESULT_OK) {
				Bitmap bm = BitmapFactory.decodeFile(picFile.getPath());
				imgSign.setImageBitmap(bm);
			}
			break;
		}
		super.onActivityResult(requestCode, resultCode, data);
	}

	public void uploadFile(View view) {
		pd = SubmitDialog.getProgressDialog(
				UserCertificationSubmitActivity.this, "请等待");
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
		String token = UserInfoKeeper.getToken(DzqcEnterprise.getInstance());// token参数
		if (token.equals("null")) {
			sb.append("?secret_key" + "=" + sign + "&token=");
		} else {
			sb.append("?secret_key" + "=" + sign + "&token=" + token);
		}
		if (DzqcEnterprise.isDebug) {
			Log.i("--------》》》》》拼接参数结果", sb.toString());
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
					uploadTokenTemp = jsonObject.getString("qiniu_token");
					upload(uploadRunPhotoPath,upLoadIndex);
				} catch (Exception e) {
					AsyncRun.run(new Runnable() {
						@Override
						public void run() {
							Toast.makeText(context, "获取token失败",
									Toast.LENGTH_LONG).show();
						}
					});
					Log.e(QiniuLabConfig.LOG_TAG, e.getMessage());
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

	private void upload(String path,int index) {
		if (path == null) {
			ToastUtils.showToast("图片路径为空");
			return;
		}
		if (this.uploadManager == null) {
			this.uploadManager = new UploadManager();
		}
		File uploadFile = new File(path);
		UploadOptions uploadOptions = new UploadOptions(null, null, false,
				new UpProgressHandler() {
					@Override
					public void progress(String key, double percent) {
					
					}
				}, null);
		final long startTime = System.currentTimeMillis();
		final long fileLength = uploadFile.length();
		this.uploadFileLength = fileLength;
		this.uploadLastTimePoint = startTime;
		this.uploadLastOffset = 0;
		
		this.uploadManager.put(uploadFile, null, uploadTokenTemp,
				new UpCompletionHandler() {
					@Override
					public void complete(String key, ResponseInfo respInfo,
							JSONObject jsonData) {
						
						long lastMillis = System.currentTimeMillis()
								- startTime;
						if (respInfo.isOK()) {
							try {
								String fileKey = jsonData.getString("key");
								if (upLoadIndex==0) {
									mapKey.put("0", fileKey);
								}
								if (upLoadIndex==1) {
									mapKey.put("1", fileKey);
								}
								if (upLoadIndex==2) {
									mapKey.put("2", fileKey);
								}
								if (DzqcEnterprise.isDebug) {
									Log.i("获取七牛key值--->", fileKey);
								}
								upLoadIndex++;
								if (upLoadIndex==1) {
									upload(uploadCardPhotoPath,upLoadIndex);//身份证图片
								}
								if (upLoadIndex==2) {
									upload(uploadSignPhotoPath,upLoadIndex);//签章图片
								}
								if (upLoadIndex==3) {
									submitCertificationInfo(mapKey);//提交信息
								} 
							} catch (JSONException e) {
								Toast.makeText(context, "无响应",
										Toast.LENGTH_LONG).show();
								Log.e(QiniuLabConfig.LOG_TAG, e.getMessage());
								if (pd.isShowing()) {
									pd.cancel();
								}
							}
							
						} else {
							Toast.makeText(context, "图片上传失败", Toast.LENGTH_LONG)
									.show();
							Log.e(QiniuLabConfig.LOG_TAG, respInfo.toString());
							if (pd.isShowing()) {
								pd.cancel();
							}
						}
					}

				}, uploadOptions);
	}
	
	// 提交认证信息方法
		private void submitCertificationInfo(Map<String, String> mapskey) {
			Map<String, String> map=new HashMap<String, String>();
			map.put("companyname", EncodeUtf8.toUtf8Format(comName));
			map.put("lega_lperson",EncodeUtf8.toUtf8Format(comLegalPerson));
			map.put("companyimage", mapskey.get("0"));
			map.put("reg_number", comRegNo);
			map.put("capital", comMoney);
			map.put("seat_of", comLocation);
			map.put("card_name", EncodeUtf8.toUtf8Format(comCardName));
			map.put("id_card_number", comCardId);
			map.put("operators_phone", comPhone);
			map.put("card_image", mapskey.get("1"));
			map.put("seal_picture", mapskey.get("2"));
			map.put("industry", comIndustry);
			map.put("code",phoneCode);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.realNameAuth,
					Urls.MethodType.GET, Urls.function.realNameAuth, map,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							if (DzqcEnterprise.isDebug) {
								Log.i("企业认证结果输出----------》》", response);
							}
							if (pd.isShowing()) {
								pd.cancel();
							}
							Gson gson=new Gson();
							resultMode=gson.fromJson(response, ResultMode.class);
							if(resultMode.getStatus().equals("0"))
							{
								ToastUtils.showToast(resultMode.getInfo().toString());
								return;
							}
							boolean status=ResultUtils.setToken(resultMode);
							if (status) {
								startActivity(new Intent(UserCertificationSubmitActivity.this, UserCertificationNoticeActivity.class));
								ToastUtils.showToast(resultMode.getInfo().toString());
							}
						}

						@Override
						public void httpFail(String response) {
							// TODO Auto-generated method stub
							
						}

					});
		}

}

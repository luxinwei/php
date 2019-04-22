package com.dzqc.enterprise.ui.work;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.RadioGroup.OnCheckedChangeListener;
import android.widget.TextView;
import android.widget.Toast;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.SpIndustryAdapter;
import com.dzqc.enterprise.config.Constants;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.http.Urls.MethodType;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.qiniu.utils.QiniuLabConfig;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.utils.SignUtils;
import com.dzqc.enterprise.utils.SubmitDialog;
import com.dzqc.enterprise.utils.ToastUtils;
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

public class WorkOtherInfoActivity extends BaseActivity implements
		OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private TextView tvWorkDate, tvComplete;
	private EditText etWorkMoney;
	private ImageView imgDateSel, imgMoneyDel;
	private RadioButton rbAllPay, rbPartPay;
	private RadioGroup rgGroup;

	Bundle bundle2;// 推送范围参数
	Bundle bundle1;// 发布内容参数

	private String schools="", majors="", grades="", title="", content="", appendFile="";
	private String payType="";
	private String personNum="1",firstPayMoney="",endPayMoney="";
	
	private LayoutInflater inflater;// 任务周期布局
	private ArrayList<Object> listdate;

	private ProgressDialog pd;

	int upLoadIndex=0;//上传图片索引
	private String uploadTokenTemp="";//上传七牛时需要的token
	private UploadManager uploadManager;
	private String[] fileArry;//上传附件参数数组
	private String[] pathArry;//上传附件路径数组
	private String uploadResult;//文件上传后结果字符串
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_other_info_layout);

		initHeader();
		initView();

		Intent intent = getIntent();
		if (intent != null) {
			bundle2 = intent.getBundleExtra("bundle2");
			bundle1 = intent.getBundleExtra("bundle1");
			if (bundle1 == null || bundle2 == null) {
				return;
			}
			schools = bundle2.getString("schools");
			majors = bundle2.getString("majors");
			grades = bundle2.getString("grades");
			personNum=bundle2.getString("sendNum");

			title = bundle1.getString("title");
			content = bundle1.getString("content");
			appendFile = bundle1.getString("appendFile");
		}
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_school_already));
	}

	private void initView() {
		tvWorkDate = (TextView) findViewById(R.id.tv_workDate);
		etWorkMoney = (EditText) findViewById(R.id.et_workMoney);
		imgDateSel = (ImageView) findViewById(R.id.img_dateCheck);
		imgMoneyDel = (ImageView) findViewById(R.id.img_moneyDel);
		tvComplete = (TextView) findViewById(R.id.tvComplete);
		rgGroup = (RadioGroup) findViewById(R.id.rg_group);
		rbAllPay = (RadioButton) findViewById(R.id.rb_allPay);
		rbPartPay = (RadioButton) findViewById(R.id.rb_PartPay);

		rgGroup.setOnCheckedChangeListener(new OnCheckedChangeListener() {

			@Override
			public void onCheckedChanged(RadioGroup group, int checkedId) {
				// TODO Auto-generated method stub
				// 获取变更后的选中项的ID
				int radioButtonId = group.getCheckedRadioButtonId();
				// 根据ID获取RadioButton的实例
				RadioButton rb = (RadioButton) WorkOtherInfoActivity.this
						.findViewById(radioButtonId);
				payType=rb.getText().toString();
				if (payType.trim().equals("一次支付")) {
					payType="1";
				}else if (payType.trim().equals("收尾款支付")) {
					payType="2";
				}
			}
		});

		imgDateSel.setOnClickListener(this);
		imgMoneyDel.setOnClickListener(this);
		tvComplete.setOnClickListener(this);

		rbAllPay = (RadioButton) findViewById(R.id.rb_allPay);
		rbPartPay = (RadioButton) findViewById(R.id.rb_PartPay);

		inflater = LayoutInflater.from(this);
		listdate = new ArrayList<Object>();
		listdate.add("5");
		listdate.add("10");	
		listdate.add("15");
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			this.finish();
			break;
		case R.id.img_dateCheck:// 任务周期
			final AlertDialog dlg = new AlertDialog.Builder(this).create();
			View view = inflater.inflate(R.layout.work_over_data_layout, null);
			ListView mlist = (ListView) view.findViewById(R.id.mListDate);
			mlist.setAdapter(new SpIndustryAdapter(this, listdate));
			mlist.setOnItemClickListener(new OnItemClickListener() {

				@Override
				public void onItemClick(AdapterView<?> arg0, View arg1,
						int arg2, long arg3) {
					// TODO Auto-generated method stub
					if (DzqcEnterprise.isDebug) {
						Log.i("Item索引值---》", arg3+"");
					}
					String date = listdate.get(arg2).toString();
					tvWorkDate.setText(date);
					if (dlg.isShowing()) {
						dlg.dismiss();
					}
				}
			});
			dlg.setView(view);
			dlg.show();
			break;
		case R.id.img_moneyDel:// 任务酬劳
			etWorkMoney.setText("");
			break;
		case R.id.tvComplete:// 完成操作
			pd = SubmitDialog.getProgressDialog(
					WorkOtherInfoActivity.this, "请等待");
			pd.show();
			uploadFile(v); 
			break;
		default:
			break;
		}
	}

	/**
	 * 提交信息，发布
	 */
	public void submitInfo() {
		Map<String, String> map = new HashMap<String, String>();
		map.put("title", title);
		map.put("content", content);
		map.put("work_days", tvWorkDate.getText().toString());
		map.put("join_number", "2");
		map.put("pay_type", payType);
		map.put("pay_money", etWorkMoney.getText().toString());
		map.put("first_pay_money", firstPayMoney);
		map.put("end_pay_money", endPayMoney);
		map.put("fname", uploadResult.substring(0, uploadResult.lastIndexOf("*")));
		map.put("university", schools);
		map.put("major", majors);
		map.put("grade", grades);
		map.put("number", personNum);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.publishTask, MethodType.GET,
				Urls.function.publishTask, map, new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<ResultMode>() {
						}.getType();
						ResultMode submitBean = gson.fromJson(response,
								type);
						if (submitBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(submitBean.getToken());
							ToastUtils.showToast(submitBean.getInfo().toString());
						}else {
							ToastUtils.showToast(submitBean.getInfo().toString());
						}
						if (pd.isShowing()) {
							pd.cancel();
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}
				});
	}

	//上传附件
	public void uploadFile(View view) {
		
		if (!appendFile.equals("")) {
			fileArry=appendFile.split("[*]");//上传附件参数
			if (upLoadIndex<fileArry.length) {
				pathArry=fileArry[upLoadIndex].split("[$]");
			}
		}
		if (DzqcEnterprise.isDebug) {
			Log.i("上传路径值-----》", pathArry[0]+"|||||"+pathArry[1]);
		}
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
					upload(upLoadIndex);
				} catch (Exception e) {
					AsyncRun.run(new Runnable() {
						@Override
						public void run() {
							Toast.makeText(WorkOtherInfoActivity.this, "获取token失败",
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

	private void upload(int index) {
		if (!appendFile.equals("")) {
			fileArry=appendFile.split("[*]");//上传附件参数
			if (index<fileArry.length) {
				pathArry=fileArry[upLoadIndex].split("[$]");
			}
			if (DzqcEnterprise.isDebug) {
				Log.i("上传路径及名字===", pathArry[0]+"``````"+pathArry[1]);
			}
		}
		if (pathArry[0] == null) {
			ToastUtils.showToast("图片路径为空");
			return;
		}
		if (this.uploadManager == null) {
			this.uploadManager = new UploadManager();
		}
		File uploadFile = new File(pathArry[0]);
		UploadOptions uploadOptions = new UploadOptions(null, null, false,
				new UpProgressHandler() {
					@Override
					public void progress(String key, double percent) {
					
					}
				}, null);
		final long startTime = System.currentTimeMillis();
		final long fileLength = uploadFile.length();
		
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
								uploadResult=fileKey+"$"+pathArry[1]+"*"+uploadResult;
								if (DzqcEnterprise.isDebug) {
									Log.i("获取七牛key值--->", fileKey);
								}
								upLoadIndex++;
								if (upLoadIndex>=fileArry.length) {
									submitInfo();//提交信息
								}else {
									upload(upLoadIndex);
								}
							} catch (JSONException e) {
								Toast.makeText(WorkOtherInfoActivity.this, "无响应",
										Toast.LENGTH_LONG).show();
								Log.e(QiniuLabConfig.LOG_TAG, e.getMessage());
								if (pd.isShowing()) {
									pd.cancel();
								}
							}
							
						} else {
							Toast.makeText(WorkOtherInfoActivity.this, "文件上传失败", Toast.LENGTH_LONG)
									.show();
							Log.e(QiniuLabConfig.LOG_TAG, respInfo.toString());
							if (pd.isShowing()) {
								pd.cancel();
							}
						}
					}

				}, uploadOptions);
	}
	
}

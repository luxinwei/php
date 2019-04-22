package com.dzqc.enterprise.ui;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.JSONException;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.SpIndustryAdapter;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.http.Urls.MethodType;
import com.dzqc.enterprise.json.JsonToStrUtils;
import com.dzqc.enterprise.ui.listener.PhoneEditTextWatcher;
import com.dzqc.enterprise.utils.EncodeUtf8;
import com.dzqc.enterprise.utils.ToastUtils;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.AdapterView.OnItemSelectedListener;

public class UserCertificationStepActivity extends BaseActivity implements
		OnClickListener {

	private ImageView imgBack;
	private TextView tvHeader;

	private EditText etCompanyLocation, etOwnerName, etOwnerNo, etCompanyPhone,
			etCheckCode;
	private TextView tvIndusty, tvCheck, tvStep;
	private LinearLayout liIndustry;

	Bundle oneBundle;// 暂存企业认证第一步信息;

	private String industry, comLocation, comOwnerCardId, comOwnerCardName,
			comOwnerPhone, phoneCheckCode;

	private JsonToStrUtils jsonToStr;
	private boolean timerThread = true;// 倒计时线程标示
	private int timeNum = 60;// 短信倒计时总时间
	private LayoutInflater inflaterSp;
	private ArrayList<Object> listIndustry;// 行业列表
	private String selectValue;// 选择行业值

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_certification_step);
		Intent oneIntent = getIntent();
		oneBundle = oneIntent.getBundleExtra("bundleOne");
		initView();
	}

	private void initView() {
		inflaterSp = LayoutInflater.from(this);
		listIndustry = new ArrayList<Object>();
		listIndustry.add("教育类");
		listIndustry.add("工业类");

		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(
				R.string.certification_company_title));

		etCompanyLocation = (EditText) findViewById(R.id.et_companyLocation);
		etOwnerName = (EditText) findViewById(R.id.et_ownerName);
		etOwnerNo = (EditText) findViewById(R.id.et_ownerNo);
		etCompanyPhone = (EditText) findViewById(R.id.et_companyPhone);
		etCheckCode = (EditText) findViewById(R.id.et_checkCode);

		tvIndusty = (TextView) findViewById(R.id.tv_industry);

		tvCheck = (TextView) findViewById(R.id.tv_sendCode);
		tvStep = (TextView) findViewById(R.id.tv_certification_step2);
		tvCheck.setOnClickListener(this);
		tvStep.setOnClickListener(this);

		liIndustry = (LinearLayout) findViewById(R.id.li_chooseIndustry);
		liIndustry.setOnClickListener(this);

		addEditTextListener();
	}

	/**
	 * 给EditText添加监听事件，判断注册按钮能否点击
	 */
	private void addEditTextListener() {
		List<EditText> listName = new ArrayList<EditText>();
		listName.add(etOwnerName);
		listName.add(etOwnerNo);
		listName.add(etCompanyPhone);
		listName.add(etCheckCode);
		etCompanyLocation.addTextChangedListener(new PhoneEditTextWatcher(
				tvStep, listName));
		List<EditText> listNo = new ArrayList<EditText>();
		listNo.add(etCompanyLocation);
		listNo.add(etOwnerNo);
		listNo.add(etCompanyPhone);
		listNo.add(etCheckCode);
		etOwnerName.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listNo));

		List<EditText> listMoney = new ArrayList<EditText>();
		listMoney.add(etCompanyLocation);
		listMoney.add(etOwnerName);
		listMoney.add(etCompanyPhone);
		listMoney.add(etCheckCode);
		etOwnerNo.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listMoney));

		List<EditText> listOwner = new ArrayList<EditText>();
		listOwner.add(etCompanyLocation);
		listOwner.add(etOwnerName);
		listOwner.add(etOwnerNo);
		listOwner.add(etCheckCode);
		etCompanyPhone.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listOwner));

		List<EditText> listCheck = new ArrayList<EditText>();
		listCheck.add(etCompanyLocation);
		listCheck.add(etCompanyPhone);
		listCheck.add(etOwnerName);
		listCheck.add(etOwnerNo);
		listCheck.add(etCheckCode);
		etCheckCode.addTextChangedListener(new PhoneEditTextWatcher(tvStep,
				listCheck));
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tv_sendCode:
			comOwnerPhone = etCompanyPhone.getText().toString();
			Map<String, String> phonemap = new HashMap<String, String>();
			phonemap.put("mobile", comOwnerPhone);
			phonemap.put("type", Urls.type_certification);
			HttpRequest.HttpPost(Urls.ROOTURL, Method.SendSmsCode,
					MethodType.GET, Urls.function.sendSmsCode, phonemap,
					new HttpCallback() {

						@Override
						public void httpSuccess(String response) {
							// TODO Auto-generated method stub
							jsonToStr = new JsonToStrUtils(response);
							try {
								ToastUtils.showToast(jsonToStr.getJsonContent());
								if (jsonToStr.getResultStatus().equals("1")) {
									new Thread(new smsTimeThread()).start();
									tvCheck.setEnabled(false);
								}
							} catch (JSONException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
						}

						@Override
						public void httpFail(String response) {
							// TODO Auto-generated method stub

						}
					});
			break;
		case R.id.tv_certification_step2:// 下一步
			industry = tvIndusty.getText().toString();
			industry=EncodeUtf8.toUtf8Format(industry);
			comLocation = etCompanyLocation.getText().toString();
			comOwnerCardName = etOwnerName.getText().toString();
			comOwnerCardId = etOwnerNo.getText().toString();
			comOwnerPhone = etCompanyPhone.getText().toString();
			phoneCheckCode = etCheckCode.getText().toString();
			// 校验短信验证码
			smsCodeValidate();
			break;
		case R.id.li_chooseIndustry:// 行业选择事件
			AlertDialog dialogSch = null;
			final Builder builder = new AlertDialog.Builder(
					UserCertificationStepActivity.this);
			View viewSp = inflaterSp.inflate(R.layout.industry_spinner_layout,
					null);
			final Spinner spindustry = (Spinner) viewSp
					.findViewById(R.id.sp_industry);
			builder.setNegativeButton("取消",
					new DialogInterface.OnClickListener() {

						@Override
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub

						}
					});
			builder.setPositiveButton("确定",
					new DialogInterface.OnClickListener() {

						@Override
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
							tvIndusty.setText(spindustry.getSelectedItem()
									.toString());
						}
					});
			spindustry.setAdapter(new SpIndustryAdapter(
					UserCertificationStepActivity.this, listIndustry));
			spindustry.setOnItemSelectedListener(new OnItemSelectedListenerImpl());
			builder.setView(viewSp);
			dialogSch = builder.create();
			dialogSch.show();

			break;
		case R.id.img_registerBack:
			this.finish();
			break;
		default:
			break;
		}
	}

	// 监听器实现类
	private class OnItemSelectedListenerImpl implements OnItemSelectedListener {
		@Override
		public void onItemSelected(AdapterView<?> parent, View view,
				int position, long id) {// 选项改变的时候触发
			switch (parent.getId()) {
			case R.id.sp_industry:// 行业
				selectValue = listIndustry.get(position).toString();
				break;
			default:
				break;
			}

		}
		@Override
		public void onNothingSelected(AdapterView<?> arg0) {// 没有选项的时候触发

		}

	}

	/**
	 * 短信验证码有效性判断
	 * 
	 * @return
	 */
	private void smsCodeValidate() {
		Map<String, String> checkemap = new HashMap<String, String>();
		checkemap.put("code", phoneCheckCode);
		checkemap.put("type", Urls.type_certification);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.CheckSmsCode, MethodType.GET,
				Urls.function.chkSmsCode, checkemap, new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						jsonToStr = new JsonToStrUtils(response);
						try {
							if (DzqcEnterprise.isDebug) {
								Log.i("httpSuccess------->",
										jsonToStr.getResultStatus());
							}
							ToastUtils.showToast(jsonToStr.getJsonContent());
							if (jsonToStr.getResultStatus().equals("1")) {// 验证码有效跳转至下一页面
								timerThread = false;
								Bundle bundleTwo = new Bundle();
								bundleTwo.putString("industry", industry);
								bundleTwo.putString("comLocation", comLocation);
								bundleTwo.putString("comOwnerCardName",
										comOwnerCardName);
								bundleTwo.putString("comOwnerCardId",
										comOwnerCardId);
								bundleTwo.putString("comOwnerPhone",
										comOwnerPhone);
								bundleTwo.putString("phoneCheckCode",
										phoneCheckCode);
								Intent intentTwo = new Intent(
										UserCertificationStepActivity.this,
										UserCertificationSubmitActivity.class);
								intentTwo.putExtra("bundleOne", oneBundle);
								intentTwo.putExtra("bundleTwo", bundleTwo);
								startActivity(intentTwo);
							} else {
							}
						} catch (JSONException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
						if (DzqcEnterprise.isDebug) {
							Log.i("httpFail------->", response);
						}
					}
				});
	}

	/**
	 * 发送短信倒计时提醒
	 * 
	 * @author Administrator
	 * 
	 */
	class smsTimeThread implements Runnable {

		@Override
		public void run() {
			// TODO Auto-generated method stub
			while (timeNum > 0 && timerThread) {
				timeNum--;
				mHandler.post(new Runnable() {// 通过它在UI主线程中修改显示的剩余时间

					@Override
					public void run() {
						// TODO Auto-generated method stub
						tvCheck.setText(timeNum + "s后重新发送");
						if (DzqcEnterprise.isDebug) {
							Log.i("倒计时时间为=========》", timeNum + "s后重新发送");
						}
					}
				});
				try {
					Thread.sleep(1000);// 线程休眠一秒钟
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			mHandler.sendEmptyMessage(0x001);
		}

	};

	@SuppressLint("HandlerLeak")
	private Handler mHandler = new Handler() {
		public void handleMessage(android.os.Message msg) {
			switch (msg.what) {
			case 0x001:
				tvCheck.setText("发送验证码");
				tvCheck.setEnabled(true);
				break;

			default:
				break;
			}
		};
	};
}

package com.dzqc.enterprise.ui;

import java.util.HashMap;
import java.util.Map;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.http.HttpImage;
import com.dzqc.enterprise.http.HttpRequest;
import com.dzqc.enterprise.http.HttpRequest.HttpCallback;
import com.dzqc.enterprise.http.Urls;
import com.dzqc.enterprise.http.Urls.Method;
import com.dzqc.enterprise.model.CertificationMode;
import com.dzqc.enterprise.model.ResultMode;
import com.dzqc.enterprise.utils.SubmitDialog;
import com.google.gson.Gson;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

public class UserCertificationState extends BaseActivity{

	private TextView tvheader;
	private ImageView imgState,imgback;
	private TextView tvComName,tvComRegNo,tvComMoney,tvComOwner,tvComIndustry,tvComLoaction,tvComRunName,tvComCardId,
	tvComPhone;
	private ImageView imgRunPic,imgCardPic,imgSignPic;
	
	private ProgressDialog pd;// 耗时操作框
	private ResultMode resultMode;
	private CertificationMode certificationMode;
	private Gson gson;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_certification_status);
		initView();
	}
	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		getAuthenticationInfo();
	}
	/**
	 * 初始化组件
	 */
	private void initView()
	{
		tvheader=(TextView) findViewById(R.id.tvHeadInfo);
		tvheader.setText(getResources().getString(R.string.certification_company_title));
		imgback=(ImageView) findViewById(R.id.img_registerBack);
		imgback.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				UserCertificationState.this.finish();
			}
		});
		
		tvComName=(TextView) findViewById(R.id.tv_certificateComName);
		tvComRegNo=(TextView) findViewById(R.id.tv_certificateRegNo);
		tvComMoney=(TextView) findViewById(R.id.tv_certificateRegMoney);
		tvComOwner=(TextView) findViewById(R.id.tv_certificateFaRen);
		tvComIndustry=(TextView) findViewById(R.id.tv_certificateIndustry);
		tvComLoaction=(TextView) findViewById(R.id.tv_certificateLocation);
		tvComRunName=(TextView) findViewById(R.id.tv_certificateRunName);
		tvComCardId=(TextView) findViewById(R.id.tv_certificateRunCardId);
		tvComPhone=(TextView) findViewById(R.id.tv_certificateRunPhone);
		
		imgRunPic=(ImageView) findViewById(R.id.img_certificationRunPhoto);
		imgCardPic=(ImageView) findViewById(R.id.img_certificationCardPhoto);
		imgSignPic=(ImageView) findViewById(R.id.img_certificationSignPhoto);
		
		imgState=(ImageView) findViewById(R.id.img_certification_status);
	}

	public void getAuthenticationInfo()
	{
		pd = SubmitDialog.getProgressDialog(UserCertificationState.this, "请等待");
		pd.show();
		Map<String, String> map=new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.realNameAuthstatus, Urls.MethodType.GET,Urls.function.realNameAuthstatus, map, new HttpCallback() {
			
			@Override
			public void httpSuccess(String response) {
				// TODO Auto-generated method stub
				gson=new Gson();
				resultMode=gson.fromJson(response, ResultMode.class);
				if (DzqcEnterprise.isDebug) {
					Log.i("获取企业实名认证信息----------》》", response);
					Log.i("json解析内容------》", resultMode.getInfo().toString());
				}
				if (resultMode.getStatus().equals("10")||resultMode.getStatus().equals("20")) {
					certificationMode=gson.fromJson(resultMode.getInfo().toString(), CertificationMode.class);
					bindData(certificationMode);
				}
			}
			
			@Override
			public void httpFail(String response) {
				// TODO Auto-generated method stub
			
			}
			
		});
	}
	
	
	private void bindData(CertificationMode mode)
	{
		tvComName.setText(mode.getCompanyname());
		tvComRegNo.setText(mode.getReg_number());
		tvComMoney.setText(mode.getCapital());
		tvComOwner.setText(mode.getLega_lperson());
		tvComIndustry.setText(mode.getIndustry());
		tvComLoaction.setText(mode.getSeat_of());
		tvComRunName.setText(mode.getCard_name());
		tvComCardId.setText(mode.getId_card_number());
		tvComPhone.setText(mode.getOperators_phone());
		loadImage(imgRunPic,mode.getCompanyimage());
		loadImage(imgCardPic,mode.getCard_image());
		loadImage(imgSignPic,mode.getSeal_picture());
		if (mode.getAudit().equals("10")) {
			imgState.setBackgroundResource(R.drawable.check_icon2);
		}else if (mode.getAudit().equals("20")) {
			imgState.setBackgroundResource(R.drawable.check_icon1);
		}
	}
	
	/**
	 * 下载图片
	 */
	private void loadImage(ImageView img,String url){
		  HttpImage.loadImage(img, url, R.drawable.signsample, R.drawable.signsample);
		  if (pd.isShowing()) {
				pd.cancel();
			}
	}
}

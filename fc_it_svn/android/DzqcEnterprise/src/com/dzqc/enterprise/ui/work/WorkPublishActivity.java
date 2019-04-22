package com.dzqc.enterprise.ui.work;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.qiniu.utils.FileUtils;
import com.dzqc.enterprise.ui.BaseActivity;

public class WorkPublishActivity extends BaseActivity implements
		OnClickListener {
	private static final int REQUEST_CODE = 8090;
	private String uploadFilePath;//文件路径
	private String fileName;//文件名
	private String upFile;//文件拼接后参数
	private String appendFile="";//拼接后参数
	
	private ImageView imgBack;
	private TextView tvHeader;

	private EditText etPublishTitle, etPublishContent;
	private TextView tvPublishAds, tvNextStep;
	private ImageView imgAddFile;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_publish_layout);
		initHeader();
		initView();
	}

	private void initHeader() {
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader = (TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_publish_title));
	}

	private void initView() {
		etPublishTitle = (EditText) findViewById(R.id.et_publistTitle);
		etPublishContent = (EditText) findViewById(R.id.et_publistContent);

		imgAddFile = (ImageView) findViewById(R.id.img_addFile);
		imgAddFile.setOnClickListener(this);
		tvPublishAds = (TextView) findViewById(R.id.tvPublishAds);
		tvPublishAds.setOnClickListener(this);

		tvNextStep = (TextView) findViewById(R.id.tv_publish_Step);
		tvNextStep.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.tvPublishAds:// 发布说明
			startActivity(new Intent(WorkPublishActivity.this,
					WorkPublishAdsActivity.class));
			break;
		case R.id.img_addFile:// 上传附件选择
			Intent target = FileUtils.createGetContentIntent();
			Intent intent = Intent.createChooser(target, "选择文件");
			try {
				this.startActivityForResult(intent, REQUEST_CODE);
			} catch (ActivityNotFoundException ex) {
			}

			break;
		case R.id.img_registerBack:
			this.finish();
			break;
		case R.id.tv_publish_Step:
			Intent pubIntent=new Intent(this, WorkSendSelectActivity.class);
			Bundle bundle1=new Bundle();
			bundle1.putString("title", etPublishTitle.getText().toString());
			bundle1.putString("content", etPublishContent.getText().toString());
			bundle1.putString("appendFile", appendFile.substring(0, appendFile.lastIndexOf("*")));
			if (DzqcEnterprise.isDebug) {
				Log.i("拼接上传路径===",appendFile.substring(0, appendFile.lastIndexOf("*")));
			}
			pubIntent.putExtra("bundle1", bundle1);
			startActivity(pubIntent);
			break;
		default:
			break;
		}
	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		switch (requestCode) {
		case REQUEST_CODE:
			// If the file selection was successful
			if (resultCode == RESULT_OK) {
				if (data != null) {
					// Get the URI of the selected file
					final Uri uri = data.getData();
					try {
						// Get the file path from the URI
						final String path = FileUtils.getPath(this, uri);
						fileName=getFileName(path);
						this.uploadFilePath = path;
						appendFile=path+"$"+fileName+"*"+appendFile;
						if (DzqcEnterprise.isDebug) {
							Log.i("获取文件路径》》》》",uploadFilePath+"!!!!"+fileName);
						}
					} catch (Exception e) {
						Toast.makeText(this, "上传失败", Toast.LENGTH_LONG).show();
					}
				}
			}
			break;
		}
		super.onActivityResult(requestCode, resultCode, data);
	}
	
	//截取文件名称
	public String getFileName(String pathname){  
        
        int start=pathname.lastIndexOf("/");  
        int end=pathname.lastIndexOf(".");  
        if(start!=-1 && end!=-1){
            return pathname.substring(start+1,end);    
        }else{  
            return null;  
        }  
          
    }  
}

package com.dzqc.student.ui;

import java.io.File;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;

import com.dzqc.student.R;
import com.dzqc.student.adapter.WorkGradeAdapter;
import com.dzqc.student.adapter.WorkMajorAdapter;
import com.dzqc.student.adapter.WorkSchoolAdapter;
import com.dzqc.student.adapter.WorkSchoolAddAdapter;
import com.dzqc.student.adapter.YearAdapter;
import com.dzqc.student.config.AppInfoKeeper;
import com.dzqc.student.config.Constants;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.config.UserInfoKeeper;
import com.dzqc.student.http.HttpRequest;
import com.dzqc.student.http.Urls;
import com.dzqc.student.http.HttpRequest.HttpCallback;
import com.dzqc.student.http.Urls.Method;
import com.dzqc.student.json.JsonToStrUtils;
import com.dzqc.student.json.UserCertificationJson;
import com.dzqc.student.model.IndustryMode;
import com.dzqc.student.model.IndustryMode.DataList.Rows;
import com.dzqc.student.model.NormalResultModel;
import com.dzqc.student.model.WorkGradeListMode;
import com.dzqc.student.model.WorkSchoolAddMode;
import com.dzqc.student.model.WorkSchoolListMode;
import com.dzqc.student.model.WorkSchoolListMode.DataList.RowList;
import com.dzqc.student.qiniu.utils.FileUtils;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.EncodeUtf8;
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

import android.app.AlertDialog;
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
import android.view.Window;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class UserCertification extends BaseActivity implements OnClickListener {

	private static final int REQUEST_CODE = 8090;
	private static final int CAPTURE_IMAGE_CODE = 8091;
	private UserCertification context;
	private UploadManager uploadManager;
	private String uploadFilePath;
	private File picFile = null;// 照相图片存储路径
	private ImageView imgBack;
	private TextView tvheader, tvSubmit, tvSchool, tvMajor, tvCancer,tvGrade;
	private EditText etName, etNo, etStuNo;
	private LinearLayout li_addPhoto;
	private LayoutInflater inflater;
	private PopupWindow popWindow;

	private RelativeLayout rl_errorInfo;
	private ImageView imgError, imgShow;

	private ProgressDialog pd;// 耗时操作框

	private LinearLayout li_school, li_Major,li_grade;

	// 认证状态
	private String statusRes;

	// 下拉框选项布局
	private LayoutInflater inflaterSp;
	private ArrayList<Object> dateList;// 时间列表

	private Spinner spCity, spSchool, spDate;
	private String selectSchool, selectMajor;// 选择的值
	private String selectSchoolId="";
	private String selectCityId="";
	private String selectMajorId="";
	private String selectGrade="";
	private String selectGradeId="";
	private List<WorkGradeListMode> listGrade;
	private WorkGradeAdapter gradeAdapter;
	
	private List<com.dzqc.student.model.WorkSchoolAddMode.DataList.RowList> listSchool;// 学校列表
	List<RowList> rowLists; // 城市列表容器
	List<Rows> majorLists; // 专业列表容器

	public UserCertification() {
		this.context = this;
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.user_certification);
		AppManager.getAppManager().addActivity(this);
		
		initView();
		Intent intent = getIntent();
		if (intent != null) {
			statusRes = intent.getStringExtra("status");
			if (statusRes != null)
				if (statusRes.equals("30")) {
					rl_errorInfo.setVisibility(View.VISIBLE);
					tvCancer.setVisibility(View.GONE);
				} else if (statusRes.equals("0")) {
					tvCancer.setVisibility(View.VISIBLE);
				} else {
					rl_errorInfo.setVisibility(View.GONE);
					tvCancer.setVisibility(View.VISIBLE);
				}
		}
	}

	@Override
	protected void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		// 判断审核是否通过，未通过显示审核未通过提示框
	}

	/**
	 * 初始化组件
	 */
	private void initView() {
		inflater = LayoutInflater.from(this);
		inflaterSp = LayoutInflater.from(this);
		dateList = new ArrayList<Object>();

		rowLists = new ArrayList<WorkSchoolListMode.DataList.RowList>();
		majorLists=new ArrayList<IndustryMode.DataList.Rows>();
		listGrade=new ArrayList<WorkGradeListMode>();
		
		// 填充年份数据
		Calendar calendar = Calendar.getInstance();
		int year = calendar.get(Calendar.YEAR);
		for (int i = 0; i < 15; i++) {
			dateList.add(year--);
		}

		spDate = (Spinner) findViewById(R.id.spDate);
		spDate.setAdapter(new YearAdapter(UserCertification.this, dateList));

		li_school = (LinearLayout) findViewById(R.id.li_certification_school);
		li_Major = (LinearLayout) findViewById(R.id.li_certificationMajor);
		li_school.setOnClickListener(this);
		li_Major.setOnClickListener(this);
		li_grade=(LinearLayout) findViewById(R.id.li_certificationGrade);
		li_grade.setOnClickListener(this);
		
		imgBack = (ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvheader = (TextView) findViewById(R.id.tvHeadInfo);
		tvheader.setText(getResources().getString(
				R.string.certificate_header_title));

		imgError = (ImageView) findViewById(R.id.img_certification_error);
		imgError.setOnClickListener(this);
		rl_errorInfo = (RelativeLayout) findViewById(R.id.rl_errorInfo);

		imgShow = (ImageView) findViewById(R.id.certification_imgShow);

		etName = (EditText) findViewById(R.id.et_certificateName);
		etNo = (EditText) findViewById(R.id.et_certificateNo);
		etStuNo = (EditText) findViewById(R.id.et_certificateStuNo);

		tvSchool = (TextView) findViewById(R.id.tv_certificateSchool);
		tvMajor = (TextView) findViewById(R.id.tv_certificateMajor);
		tvCancer = (TextView) findViewById(R.id.tvRight);
		tvCancer.setOnClickListener(this);
		tvGrade=(TextView) findViewById(R.id.tv_certificateGrade);
		
		li_addPhoto = (LinearLayout) findViewById(R.id.li_certification_photo);
		li_addPhoto.setOnClickListener(this);
		tvSubmit = (TextView) findViewById(R.id.tv_certification_submit);
		tvSubmit.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			this.finish();
			break;
		case R.id.li_certification_photo:
			li_addPhoto.setEnabled(false);// 防止点击多次
			showPopWindow(v);
			break;
		case R.id.tv_certification_submit:
			uploadFile(v);
			break;

		case R.id.img_certification_error:
			rl_errorInfo.setVisibility(View.GONE);
			break;

		case R.id.li_certification_school:
			View view = inflaterSp
					.inflate(R.layout.school_spinner_layout, null);
			final AlertDialog alertDialog = new AlertDialog.Builder(this)
					.create();
			alertDialog.show();
			Window window = alertDialog.getWindow();
			window.setContentView(view);
			spCity = (Spinner) window.findViewById(R.id.sp_city);
			spSchool = (Spinner) window.findViewById(R.id.sp_school);
			TextView tvCancer = (TextView) window.findViewById(R.id.tvCancer);
			TextView tvConfirm = (TextView) window.findViewById(R.id.tvConfirm);
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
					alertDialog.dismiss();
					tvSchool.setText(selectSchool);
				}
			});
			loadCityInfo(spCity);
			spCity.setOnItemSelectedListener(new OnItemSelectedListenerImpl());
			spSchool.setOnItemSelectedListener(new OnItemSelectedListenerImpl());
			break;
		case R.id.li_certificationMajor:
			if (selectSchoolId.equals("")) {
				ToastUtils.showToast("请先选择学校");
				return;
			}
			View majorView = inflaterSp.inflate(R.layout.major_spinner_layout,
					null);
			final AlertDialog alertDialogs = new AlertDialog.Builder(this)
					.create();
			alertDialogs.show();
			Window window1 = alertDialogs.getWindow();
			window1.setContentView(majorView);
			// Spinner spType=(Spinner) majorView.findViewById(R.id.sp_type);
			final Spinner spMajor = (Spinner) majorView
					.findViewById(R.id.sp_major);
			TextView tvCancers = (TextView) window1.findViewById(R.id.tvCancer);
			TextView tvConfirms = (TextView) window1
					.findViewById(R.id.tvConfirm);
			tvCancers.setOnClickListener(new OnClickListener() {

				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					alertDialogs.dismiss();
				}
			});
			tvConfirms.setOnClickListener(new OnClickListener() {

				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					alertDialogs.dismiss();
					tvMajor.setText(selectMajor);
				}
			});
			loadMajorInfo(spMajor);
			spMajor.setOnItemSelectedListener(new OnItemSelectedListenerImpl());
			break;
		case R.id.li_certificationGrade://级别选择
			View gradeView = inflaterSp.inflate(R.layout.grade_list_layout,
					null);
			final AlertDialog gradeDialogs = new AlertDialog.Builder(this)
					.create();
			gradeDialogs.show();
			Window gradeWindow = gradeDialogs.getWindow();
			gradeWindow.setContentView(gradeView);
			// Spinner spType=(Spinner) majorView.findViewById(R.id.sp_type);
			ListView gradeListView=(ListView) gradeView.findViewById(R.id.mListGrade);
			setGradeData(gradeListView,gradeDialogs);
			break;
			
		case R.id.tvRight:
			startActivity(new Intent(UserCertification.this, MainActivity.class));
			UserCertification.this.finish();
			break;
		default:
			break;
		}
	}

	private void setGradeData(ListView gradeList,final AlertDialog gradeDialogs){
		listGrade.clear();
		WorkGradeListMode mode1=new WorkGradeListMode();
		mode1.setGradeName("大一");
		mode1.setGradeCode("1");
		listGrade.add(mode1);
		WorkGradeListMode mode2=new WorkGradeListMode();
		mode2.setGradeName("大一及以上");
		mode2.setGradeCode("2");
		listGrade.add(mode2);
		WorkGradeListMode mode3=new WorkGradeListMode();
		mode3.setGradeName("大二");
		mode3.setGradeCode("3");
		listGrade.add(mode3);
		
		WorkGradeListMode mode4=new WorkGradeListMode();
		mode4.setGradeName("大二及以上");
		mode4.setGradeCode("4");
		listGrade.add(mode4);
		
		WorkGradeListMode mode5=new WorkGradeListMode();
		mode5.setGradeName("大三");
		mode5.setGradeCode("5");
		listGrade.add(mode5);
		WorkGradeListMode mode6=new WorkGradeListMode();
		mode6.setGradeName("大三及以上");
		mode6.setGradeCode("6");
		listGrade.add(mode6);
		
		WorkGradeListMode mode7=new WorkGradeListMode();
		mode7.setGradeName("大四");
		mode7.setGradeCode("7");
		listGrade.add(mode7);
		
		WorkGradeListMode mode8=new WorkGradeListMode();
		mode8.setGradeName("大四及以上");
		mode8.setGradeCode("6");
		listGrade.add(mode8);
		
		gradeAdapter=new WorkGradeAdapter(this, listGrade,"");
		gradeList.setAdapter(gradeAdapter);
		gradeList.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				// TODO Auto-generated method stub
				ImageView img=(ImageView) arg1.findViewById(R.id.imgCheck);
				img.setBackgroundResource(R.drawable.confirm);
				selectGrade=listGrade.get((int) arg3).getGradeName();
				selectGradeId=listGrade.get((int) arg3).getGradeCode();
				tvGrade.setText(selectGrade);
				gradeDialogs.dismiss();
			}
		});
	}
	
	// 监听器实现类
	private class OnItemSelectedListenerImpl implements OnItemSelectedListener {
		@Override
		public void onItemSelected(AdapterView<?> parent, View view,
				int position, long id) {// 选项改变的时候触发
			switch (parent.getId()) {
			case R.id.sp_school:// 学校下拉框
				selectSchool = listSchool.get((int) id).getName();
				selectSchoolId = listSchool.get((int) id).getId();
				break;
			case R.id.sp_city:// 城市下拉框
				selectCityId = rowLists.get((int) id).getId();
				loadSchoolInfo(selectCityId);
				break;
			/*
			 * case R.id.sp_type://专业类别下拉框 break;
			 */
			case R.id.sp_major:// 专业下拉框
				selectMajorId = majorLists.get((int) id).getId();
				selectMajor=majorLists.get((int) id).getName();
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
	 * 加载城市列表信息
	 */
	public void loadCityInfo(final Spinner sp) {
		Map<String, String> map = new HashMap<String, String>();
		HttpRequest.HttpPost(Urls.ROOTURL, Method.henanCity,
				Urls.MethodType.GET, Urls.function.henanCity, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("加载城市列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkSchoolListMode>() {
						}.getType();
						WorkSchoolListMode resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							rowLists = resultBean.getList().getRows();
							sp.setAdapter(new WorkSchoolAdapter(
									UserCertification.this, rowLists, ""));
						} else {
							ToastUtils.showToast(resultBean.getInfo());
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	public void loadMajorInfo(final Spinner spMajor) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("school_ids", selectSchoolId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListBySchool,
				Urls.MethodType.GET, Urls.function.getListBySchool, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("加载专业列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<IndustryMode>() {
						}.getType();
						IndustryMode resultBean = gson.fromJson(response, type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							majorLists = resultBean.getList().getRows();
							spMajor.setAdapter(new WorkMajorAdapter(
									UserCertification.this, majorLists, ""));
						} else {
							ToastUtils.showToast(resultBean.getInfo());
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	public void loadSchoolInfo(String cityId) {
		Map<String, String> map = new HashMap<String, String>();
		map.put("city_id", cityId);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.getListByCity,
				Urls.MethodType.GET, Urls.function.getListByCity, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("加载学校列表返回结果----------》》", response);
						}
						Gson gson = new Gson();
						java.lang.reflect.Type type = new TypeToken<WorkSchoolAddMode>() {
						}.getType();
						WorkSchoolAddMode resultBean = gson.fromJson(response,
								type);
						if (resultBean.getStatus().equals("1")) {
							UserInfoKeeper.updToken(resultBean.getToken());
							listSchool = resultBean.getList().getRows();
							spSchool.setAdapter(new WorkSchoolAddAdapter(
									UserCertification.this, listSchool, ""));
						} else {
							ToastUtils.showToast(resultBean.getInfo());
						}
					}

					@Override
					public void httpFail(String response) {
						// TODO Auto-generated method stub
					}

				});
	}

	// 提交认证信息方法
	private void submitCertificationInfo(String qiniuKey) {
		String empName = etName.getText().toString();
		String idCard = etNo.getText().toString();
		String stuNo = etStuNo.getText().toString();
		String date = spDate.getSelectedItem().toString();
		Map<String, String> map = new HashMap<String, String>();
		map.put("realname", empName);
		map.put("user_no", stuNo);
		map.put("id_card", idCard);
		map.put("university", selectSchoolId);
		map.put("major", selectMajorId);
		//map.put("grade", selectGradeId);
		map.put("school_years", date);
		map.put("student_and_photo", qiniuKey);
		HttpRequest.HttpPost(Urls.ROOTURL, Method.realNameAuthentication,
				Urls.MethodType.GET, Urls.function.realNameAuthentication, map,
				new HttpCallback() {

					@Override
					public void httpSuccess(String response) {
						// TODO Auto-generated method stub
						if (DzqcStu.isDebug) {
							Log.i("认证结果输出----------》》", response);
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
							ToastUtils.showToast(resultBean.getInfo());
							UserInfoKeeper.updToken(resultBean.getToken());
							UserInfoKeeper.setAuditCode("10");// 更新本地认证状态
							startActivity(new Intent(
									UserCertification.this,
									UserCertificationNotice.class));
						}else {
							ToastUtils.showToast(resultBean.getInfo());
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
				Intent intent = new Intent();
				intent.setAction(MediaStore.ACTION_IMAGE_CAPTURE);
				intent.addCategory(Intent.CATEGORY_DEFAULT);
				if (intent.resolveActivity(getPackageManager()) != null) {
					try {
						picFile = createImageFile();
					} catch (Exception ex) {
						Log.e("QiniuLab", "create file "
								+ UserCertification.this.uploadFilePath
								+ " failed");
					}
					if (picFile != null) {
						intent.putExtra(MediaStore.EXTRA_OUTPUT,
								Uri.fromFile(picFile));
						UserCertification.this.startActivityForResult(intent,
								CAPTURE_IMAGE_CODE);
					}
				}
			}
		});
	}

	/**
	 * 判断popwindow隐藏与显示
	 */
	private void popCheck() {
		if (popWindow != null) {
			if (popWindow.isShowing()) {
				popWindow.dismiss();
				li_addPhoto.setEnabled(true);
			}
		}
	}

	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		popCheck();
	}

	private File createImageFile() throws IOException {
		String timestamp = new SimpleDateFormat("yyyyMMdd-HHmmss")
				.format(new Date());
		String imageFileName = "PIC-" + timestamp;
		File storageDir = Environment
				.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
		File image = File.createTempFile(imageFileName, ".png", storageDir);
		this.uploadFilePath = image.getAbsolutePath();
		return image;
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
						this.uploadFilePath = path;
						File file = new File(path);
						if (file.exists()) {
							Bitmap bm = BitmapFactory.decodeFile(path);
							imgShow.setImageBitmap(bm);
						}
					} catch (Exception e) {
						Toast.makeText(context, "上传失败", Toast.LENGTH_LONG)
								.show();
					}
				}
			}
			break;
		case CAPTURE_IMAGE_CODE:
			// 照相相片显示图片
			if (resultCode == RESULT_OK) {
				Bitmap bm = BitmapFactory.decodeFile(picFile.getPath());
				imgShow.setImageBitmap(bm);
			}
			break;
		}
		super.onActivityResult(requestCode, resultCode, data);
	}

	public void uploadFile(View view) {
		if (this.uploadFilePath == null) {
			return;
		}
		pd = SubmitDialog.getProgressDialog(UserCertification.this, "请等待");
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
					String uploadToken = jsonObject.getString("qiniu_token");
					upload(uploadToken);
				} catch (Exception e) {
					AsyncRun.run(new Runnable() {
						@Override
						public void run() {
							Toast.makeText(context, "获取token失败",
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
								submitCertificationInfo(fileKey);
							} catch (JSONException e) {
								Toast.makeText(context, "无响应",
										Toast.LENGTH_LONG).show();
							}
						} else {
							Toast.makeText(context, "图片上传失败", Toast.LENGTH_LONG)
									.show();
							if (pd.isShowing()) {
								pd.cancel();
							}
						}
					}

				}, uploadOptions);
	}
}

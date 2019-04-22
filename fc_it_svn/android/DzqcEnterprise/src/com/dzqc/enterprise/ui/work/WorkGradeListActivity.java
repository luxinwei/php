package com.dzqc.enterprise.ui.work;

import java.util.ArrayList;
import java.util.List;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.dzqc.enterprise.R;
import com.dzqc.enterprise.adapter.WorkGradeAdapter;
import com.dzqc.enterprise.model.WorkGradeListMode;
import com.dzqc.enterprise.ui.BaseActivity;
import com.dzqc.enterprise.utils.ToastUtils;

public class WorkGradeListActivity extends BaseActivity implements
		OnClickListener {
	private ImageView imgBack;
	private TextView tvHeader;
	
	private ListView mlistGrade;
	private List<WorkGradeListMode> listGrade;
	private WorkGradeAdapter gradeAdapter;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);

		setContentView(R.layout.work_school_list);
		initHeader();
		initView();
	}
	private void initHeader()
	{
		imgBack=(ImageView) findViewById(R.id.img_registerBack);
		imgBack.setOnClickListener(this);
		tvHeader=(TextView) findViewById(R.id.tvHeadInfo);
		tvHeader.setText(getResources().getString(R.string.work_grade_check));
	}
	
	private void initView() {
		listGrade=new ArrayList<WorkGradeListMode>();
		WorkGradeListMode mode=new WorkGradeListMode();
		mode.setGradeName("大四学生");
		mode.setGradeCode("004");
		listGrade.add(mode);
		WorkGradeListMode mode1=new WorkGradeListMode();
		mode1.setGradeName("大三学生");
		mode1.setGradeCode("003");
		listGrade.add(mode1);
		WorkGradeListMode mode2=new WorkGradeListMode();
		mode2.setGradeName("大二学生");
		mode2.setGradeCode("002");
		listGrade.add(mode2);
		
		mlistGrade=(ListView) findViewById(R.id.mListSchool);
		gradeAdapter=new WorkGradeAdapter(this, listGrade);
		mlistGrade.setAdapter(gradeAdapter);
		
		mlistGrade.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				// TODO Auto-generated method stub
				ImageView img=(ImageView) arg1.findViewById(R.id.imgCheck);
				img.setBackgroundResource(R.drawable.confirm);
				String gradeName=listGrade.get((int) arg3).getGradeName();
				Intent intent=new Intent();
			    intent.putExtra("grade", gradeName);
			    setResult(RESULT_OK, intent);
			    WorkGradeListActivity.this.finish();
			}
		});
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.img_registerBack:
			this.finish();
			break;
		default:
			break;
		}
	}
}

package com.dzqc.student.ui;

import java.util.ArrayList;
import java.util.List;

import com.dzqc.student.R;
import com.dzqc.student.config.DzqcStu;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;

/**
 * 起始页
 * @author Administrator
 *
 */

public class InitPager extends BaseActivity {

	private ViewPager loginPager;
	private List<ImageView> listImages;
	private int[] imgArry={R.drawable.one,R.drawable.two,R.drawable.three};
	
	private ImageView imgEnter;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		
		setContentView(R.layout.login_init_pager);
		
		listImages=new ArrayList<ImageView>();
		for (int i = 0; i < imgArry.length; i++) {
			ImageView img=new ImageView(DzqcStu.getInstance());
			img.setBackgroundResource(imgArry[i]);
			listImages.add(img);
		}
		imgEnter=(ImageView) findViewById(R.id.imgEnter);
		imgEnter.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				startActivity(new Intent(InitPager.this, MainActivity.class));
			}
		});
		
		loginPager=(ViewPager) findViewById(R.id.init_LoginPager);
		loginPager.setAdapter(new imageAdapter());
		loginPager.setOnPageChangeListener(new OnPageChangeListener() {
			
			@Override
			public void onPageSelected(int arg0) {
				// TODO Auto-generated method stub
				if (arg0==imgArry.length-1) {
					imgEnter.setVisibility(View.VISIBLE);
				}else {
					imgEnter.setVisibility(View.GONE);
				}
			}
			
			@Override
			public void onPageScrolled(int arg0, float arg1, int arg2) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void onPageScrollStateChanged(int arg0) {
				// TODO Auto-generated method stub
				
			}
		});
	}
	
	class imageAdapter extends PagerAdapter{

		@Override
		//获取当前窗体界面数
		public int getCount() {
			// TODO Auto-generated method stub
			return listImages.size();
		}

		@Override
		//断是否由对象生成界面
		public boolean isViewFromObject(View arg0, Object arg1) {
			// TODO Auto-generated method stub
			return arg0==arg1;
		}
		//是从ViewGroup中移出当前View
		@Override
		public void destroyItem(View container, int position, Object object) {
			// TODO Auto-generated method stub
			 ((ViewPager) container).removeView(listImages.get(position));  
		}
		
		//返回一个对象，这个对象表明了PagerAdapter适配器选择哪个对象放在当前的ViewPager中
		@Override
		public Object instantiateItem(View container, int position) {
			// TODO Auto-generated method stub
			((ViewPager)container).addView(listImages.get(position));
            return listImages.get(position);  
		}
	}
}

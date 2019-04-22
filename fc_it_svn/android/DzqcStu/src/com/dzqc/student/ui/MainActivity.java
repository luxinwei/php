package com.dzqc.student.ui;

import android.content.Intent;
import android.media.AudioManager;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;

import com.dzqc.student.R;
import com.dzqc.student.ui.index.IndexFragment;
import com.dzqc.student.ui.innovation.InnovationFragment;
import com.dzqc.student.ui.mine.MineFragment;
import com.dzqc.student.ui.work.WorkFragment;
import com.dzqc.student.utils.AppManager;
import com.dzqc.student.utils.ToastUtils;
import com.dzqc.student.utils.ViewUtils;

public class MainActivity extends FragmentActivity implements View.OnClickListener {

	private IndexFragment messageFragment;
	private WorkFragment contactsFragment;
	private MineFragment mineFragment;
	private InnovationFragment innovationFragment;
	private View item_message;
	public View item_works;
	private View item_innovation;
	private View item_mini;
	private ViewGroup lastItem;

	private String flag="";
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setVolumeControlStream(AudioManager.STREAM_MUSIC);
		setContentView(R.layout.activity_main);
		AppManager.getAppManager().addActivity(this);
		Intent intent=getIntent();
		if (intent!=null) {
			flag=intent.getStringExtra("flag")==null?"":intent.getStringExtra("flag");
		}
		
		// 初始化底部按钮
		initBottomMenu();
	}

	private void initBottomMenu() {
		item_message = findViewById(R.id.item_index);
		item_works = findViewById(R.id.item_wrok);
		item_innovation = findViewById(R.id.item_innovation);
		item_mini = findViewById(R.id.item_mine);
		item_message.setOnClickListener(this);
		item_works.setOnClickListener(this);
		item_innovation.setOnClickListener(this);
		item_mini.setOnClickListener(this);
		if (flag.equals("innovation")) {
			onClick(item_innovation);
		}else {
			onClick(item_message);
		}
	}

	@Override
	public void onClick(View v) {
		if (lastItem != null) {
			ViewUtils.setEnabledWithChild(lastItem, true);
		}
		lastItem = (RelativeLayout) v;
		ViewUtils.setEnabledWithChild(lastItem, false);
		changeFragment(v.getId());
	}

	@Override
	protected void onResume() {

		super.onResume();
	}

	@Override
	protected void onPause() {
		super.onPause();
	}

	@Override
	protected void onNewIntent(Intent intent) {
		super.onNewIntent(intent);
		if (intent.hasExtra("message"))
			ToastUtils.showToast(intent.getStringExtra("message"));
	}

	@Override
	protected void onDestroy() {

		super.onDestroy();
	}

	private void changeFragment(int itemId) {
		FragmentManager fm = getSupportFragmentManager();
		fm.executePendingTransactions();
		FragmentTransaction tran = fm.beginTransaction();
		if (fm.getFragments() != null) {
			for (Fragment fragment : fm.getFragments()) {
				tran.hide(fragment);
			}
		}
		switch (itemId) {
		case R.id.item_index:
			if (getMessageFragment().isAdded()) {
				tran.show(getMessageFragment());
			} else {
				tran.add(R.id.frame, getMessageFragment());
			}
			break;
		case R.id.item_wrok:
			if (getContactsFragment().isAdded()) {
				tran.show(getContactsFragment());
			} else {
				tran.add(R.id.frame, getContactsFragment());
			}
			break;
		case R.id.item_innovation:
			if (getWorkFragment().isAdded()) {
				tran.show(getWorkFragment());
			} else {
				tran.add(R.id.frame, getWorkFragment());
			}
			break;
		case R.id.item_mine:
			if (getMineFragment().isAdded()) {
				tran.show(getMineFragment());
			} else {
				tran.add(R.id.frame, getMineFragment());
			}
			break;
		}
		tran.commitAllowingStateLoss();
	}

	public IndexFragment getMessageFragment() {
		if (messageFragment == null) {
			messageFragment = new IndexFragment();
		}
		return messageFragment;
	}

	public WorkFragment getContactsFragment() {
		if (contactsFragment == null) {
			contactsFragment = new WorkFragment();
		}
		return contactsFragment;
	}

	public InnovationFragment getWorkFragment() {
		if (innovationFragment == null) {
			innovationFragment = new InnovationFragment();
		}
		return innovationFragment;
	}

	public MineFragment getMineFragment() {
		if (mineFragment == null) {
			mineFragment = new MineFragment();
		}
		return mineFragment;
	}

	
	private boolean isDouble = false;
	@Override
	public void onBackPressed() {
			if (isDouble) {
				AppManager.getAppManager().finishActivity(MainActivity.this);
			} else {
				ToastUtils.showToast(R.string.again_to_exit);
				isDouble = true;
				new Handler().postDelayed(new Runnable() {
					@Override
					public void run() {
						isDouble = false;
					}
				}, 1000);
			}
	}

}

package com.dzqc.student.adapter;

import java.io.File;
import java.util.List;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.dzqc.student.R;
import com.dzqc.student.config.Constants;
import com.dzqc.student.config.DzqcStu;
import com.dzqc.student.http.DownloadThread;
import com.dzqc.student.http.DownloadThread.DownloadListener;
import com.dzqc.student.model.WorkDetailRowMode;
import com.dzqc.student.utils.ToastUtils;

public class FileAdapter extends BaseAdapter {
	Context c;
	List<WorkDetailRowMode> arrayList;
	Holider holider;

	public FileAdapter(Context c,List<WorkDetailRowMode> listfile) {
		this.c = c;
		this.arrayList = listfile;
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return arrayList.size();
	}

	@Override
	public Object getItem(int index) {
		// TODO Auto-generated method stub
		return arrayList.get(index);
	}

	@Override
	public long getItemId(int index) {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public View getView(int index, View view, ViewGroup parent) {
		// TODO Auto-generated method stub
		if (view != null) {
			holider = (Holider) view.getTag();
		} else {
			holider = new Holider();
			view = LayoutInflater.from(c).inflate(R.layout.detail_file_item,
					parent, false);
			holider.tvFileName = (TextView) view.findViewById(R.id.tv_file1);
			view.setTag(holider);
		}
		final WorkDetailRowMode detailRowMode=arrayList.get(index);
		holider.tvFileName.setText(index+1+"，"+detailRowMode.getFname());
		final String fileName=detailRowMode.getFname();
		holider.tvFileName.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				File f=new File(Constants.filePath);
				if (!f.exists()) {
					f.mkdirs();
				}
				String newFilename = Constants.filePath+"/" + fileName;
				File file = new File(newFilename);
				//如果目标文件已经存在，则删除。产生覆盖旧文件的效果
				if (file.exists()) {
					file.delete();
				}
				if (DzqcStu.isDebug) {
					Log.i("filePath--", file+"");
					Log.i("loadUrl--", detailRowMode.getDownload_url());
				}
				new DownloadThread(file, detailRowMode.getDownload_url(),
						new DownloadListener() {

							@Override
							public void success() {
								// TODO Auto-generated
								// method stub
								ToastUtils.showToast("下载成功");
							}

							@Override
							public void failed() {
								// TODO Auto-generated
								// method stub
								ToastUtils.showToast("下载失败");
							}

							@Override
							public void download(
									long downSize,
									long totalSize) {
								// TODO Auto-generated
								// method stub

							}
						}).start();
			}
		});
		return view;
	}

	class Holider {
		TextView tvFileName;
	}

}

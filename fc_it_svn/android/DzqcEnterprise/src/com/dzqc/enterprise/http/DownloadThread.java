package com.dzqc.enterprise.http;

import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.RandomAccessFile;
import java.net.HttpURLConnection;
import java.net.URL;
import android.os.Handler;
import android.text.TextUtils;

public class DownloadThread extends Thread {

	File file;
	private String downloadUrl;
	private DownloadListener listener;
	private long size;
	private long compeleteSize;
	private Handler handler;

	public DownloadThread(File file, String downloadUrl, DownloadListener listener) {
		this.file = file;
		this.downloadUrl = downloadUrl;
		this.listener = listener;
		this.compeleteSize = 0;
		handler = new Handler();
	}

	@Override
	public void run() {
		HttpURLConnection connection = null;
		RandomAccessFile randomAccessFile = null;
		InputStream is = null;
		try {
			URL url = new URL(downloadUrl);
			connection = (HttpURLConnection) url.openConnection();
			connection.setConnectTimeout(5000);
			connection.setRequestMethod("GET");
			if (size == 0) {
				size = getFileSize(url);
			}
			connection.setRequestProperty("Range", "bytes=" + compeleteSize + "-" + size);

			String disposition = connection.getHeaderField("Content-Disposition");
			if (TextUtils.isEmpty(disposition)) {
				runOnUIThread(new Runnable() {
					@Override
					public void run() {
						listener.failed();
					}
				});
				return;
			}

			randomAccessFile = new RandomAccessFile(file, "rw");
			randomAccessFile.seek(compeleteSize);
			is = connection.getInputStream();
			byte[] buffer = new byte[4096];
			int length = -1;
			while ((length = is.read(buffer)) != -1) {
				randomAccessFile.write(buffer, 0, length);
				compeleteSize += length;
				runOnUIThread(new Runnable() {
					@Override
					public void run() {
						listener.download(compeleteSize, size);
					}
				});
			}
			runOnUIThread(new Runnable() {
				@Override
				public void run() {
					if (size == compeleteSize)
						listener.success();
					else
						listener.failed();
				}
			});
		} catch (Exception e) {
			runOnUIThread(new Runnable() {
				@Override
				public void run() {
					listener.failed();
				}
			});
			e.printStackTrace();
		} finally {
			try {
				is.close();
				randomAccessFile.close();
				connection.disconnect();
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	}

	private long getFileSize(URL url) throws IOException {
		HttpURLConnection connection = (HttpURLConnection) url.openConnection();
		connection.setConnectTimeout(5000);
		connection.setRequestMethod("GET");
		long fileSize = connection.getContentLength();
		connection.getInputStream();
		connection.disconnect();
		return fileSize;
	}

	private void runOnUIThread(Runnable r) {
		handler.post(r);
	}

	public static interface DownloadListener {
		// 下载过程回调
		public void download(long downSize, long totalSize);

		// 下载完毕并成功
		public void success();

		// 下载失败
		public void failed();
	}
}

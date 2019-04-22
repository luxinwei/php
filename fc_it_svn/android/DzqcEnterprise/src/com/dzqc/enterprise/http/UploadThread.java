package com.dzqc.enterprise.http;

/*****
 * 文件上传类
 * ******/
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.UUID;
import android.os.Handler;
import android.text.TextUtils;

public class UploadThread extends Thread {
	private File file;
	private UploadListener listener;
	private Handler handler;

	public UploadThread(File file, UploadListener listener) {
		this.file = file;
		this.listener = listener;
		handler = new Handler();
	}

	@Override
	public void run() {
		// TODO Auto-generated method stub
		super.run();
		try {
			final String twoHyphens = "--";
			final String boundary = "----WebKitFormBoundary" + UUID.randomUUID().toString().replace("-", "");
			final String end = "\r\n";
			URL url = new URL("");
			HttpURLConnection con = (HttpURLConnection) url.openConnection();
			con.setDoInput(true);
			con.setDoOutput(true);
			con.setUseCaches(false);
			con.setRequestMethod("POST");
			con.setRequestProperty("Connection", "Keep-Alive");
			con.setRequestProperty("Charset", "UTF-8");
			con.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
			DataOutputStream dos = new DataOutputStream(con.getOutputStream());
			dos.writeBytes(twoHyphens + boundary + end);
			dos.writeBytes("Content-Disposition: form-data; name=\"file\"; filename=\"");
			dos.write(file.getName().getBytes("UTF-8"));
			dos.writeBytes("\"" + end);
			dos.writeBytes(end);

			FileInputStream fStream = new FileInputStream(file);
			byte[] buffer = new byte[1024];
			int length = -1;
			while ((length = fStream.read(buffer)) != -1) {
				dos.write(buffer, 0, length);
			}
			dos.writeBytes(end);
			dos.writeBytes(twoHyphens + boundary + twoHyphens + end);
			if (con.getResponseCode() == 200) {
				BufferedReader reader = new BufferedReader(new InputStreamReader((con.getInputStream())));
				final StringBuffer result = new StringBuffer();
				String line = reader.readLine();
				while (!TextUtils.isEmpty(line)) {
					result.append(line);
					line = reader.readLine();
				}
				fStream.close();
				dos.flush();
				dos.close();
				con.disconnect();
				runOnUIThread(new Runnable() {

					@Override
					public void run() {
						// TODO Auto-generated method stub
						listener.uploaded(result.toString());
					}
				});
			} else
				runOnUIThread(new Runnable() {

					@Override
					public void run() {
						// TODO Auto-generated method stub
						listener.failed();
					}
				});

		} catch (Exception e) {
			runOnUIThread(new Runnable() {

				@Override
				public void run() {
					// TODO Auto-generated method stub
					listener.failed();
				}
			});
		}
	}

	private void runOnUIThread(Runnable r) {
		handler.post(r);
	}

	public static interface UploadListener {
		public void uploaded(String result);

		public void failed();
	}
}

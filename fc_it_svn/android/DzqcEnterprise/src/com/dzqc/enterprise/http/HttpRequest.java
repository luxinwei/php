package com.dzqc.enterprise.http;

import java.io.IOException;
import java.util.Iterator;
import java.util.Map;

import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.dzqc.enterprise.R;
import com.dzqc.enterprise.config.Constants;
import com.dzqc.enterprise.config.DzqcEnterprise;
import com.dzqc.enterprise.config.UserInfoKeeper;
import com.dzqc.enterprise.utils.SignUtils;
import com.dzqc.enterprise.utils.ToastUtils;
public class HttpRequest {
	/******
	 * 传递的参数： 接口目录，方法名称，参数列表，回调方法
	 * ********/
	public static RequestQueue requestQueue = null;
	
	@SuppressWarnings("rawtypes")
	public static void HttpPost(String url, String method, int methodType,String fun, final Map<String, String> params, final HttpCallback httpCallback) {
		String token=UserInfoKeeper.getToken(DzqcEnterprise.getInstance());//token参数
		if (requestQueue == null)
			requestQueue = Volley.newRequestQueue(DzqcEnterprise.getInstance());
		StringRequest stringRequest = null;
		switch (methodType) {
		case Urls.MethodType.POST:
			stringRequest = new StringRequest(Request.Method.POST, url + method, new Response.Listener<String>() {
				@Override
				public void onResponse(String response) {
					httpCallback.httpSuccess(response);
					httpCallback.httpFail(response);
				}
			}, new Response.ErrorListener() {
				@Override
				public void onErrorResponse(VolleyError error) {
					ToastUtils.showToast(R.string.network_error);
				}
			}) {
				@Override
				protected Map<String, String> getParams() throws AuthFailureError {
					return params;
				}
			};
			break;
		case Urls.MethodType.GET:
			StringBuilder sb = new StringBuilder(url + method + "?");
			Iterator it = params.entrySet().iterator();
			while (it.hasNext()) {
				Map.Entry entry = (Map.Entry) it.next();
				sb.append(entry.getKey() + "=" + entry.getValue() + "&");
			}
			String sign="";
			try {
				sign = SignUtils.signTopRequest(params, Constants.secret, Constants.SIGN_METHOD_MD5, fun);
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			if (token.equals("-1")) {
				sb.append("secret_key"+"="+sign+"&token=");
			}else {
				sb.append("secret_key"+"="+sign+"&token="+token);
			}
			if (DzqcEnterprise.isDebug) {
				Log.i("-----》》拼接参数结果", sb.toString());
			}
			stringRequest = new StringRequest(Request.Method.GET, sb.toString(), new Response.Listener<String>() {
				@Override
				public void onResponse(String response) {
					httpCallback.httpSuccess(response);
					httpCallback.httpFail(response);
				}
			}, new Response.ErrorListener() {
				@Override
				public void onErrorResponse(VolleyError error) {
					ToastUtils.showToast(R.string.network_error);
				}
			});
			break;
		}
		requestQueue.add(stringRequest);
	}

	public interface HttpCallback {

		public void httpSuccess(String response);

		public void httpFail(String response);

	}
}

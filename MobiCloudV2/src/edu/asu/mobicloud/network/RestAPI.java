package edu.asu.mobicloud.network;

import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.Reader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.HttpParams;

import com.google.gson.Gson;

import android.util.Log;

import edu.asu.mobicloud.rest.model.LoginResult;

public class RestAPI {

	private static final String URL = "localhost";

	public static LoginResult checkLogin(String email, String password) {
		Gson gson = new Gson();
		Map<String, String> map = new HashMap<String, String>();
		map.put("data[User][email]", email);
		map.put("data[User][password]", password);
		InputStream i = postStream("login", map);
		if (i != null) {
			Reader reader = new InputStreamReader(i);
			return gson.fromJson(reader, LoginResult.class);

		}
		return null;
	}

	private static InputStream getStream(String uri) {
		DefaultHttpClient client = new DefaultHttpClient();

		HttpGet getRequest = new HttpGet(URL);
		try {
			HttpResponse getResponse = client.execute(getRequest);
			final int statusCode = getResponse.getStatusLine().getStatusCode();

			if (statusCode != HttpStatus.SC_OK) {
				Log.w("RestAPI.class", "Error " + statusCode + " for URL "
						+ URL);
				return null;
			}

			HttpEntity getResponseEntity = getResponse.getEntity();
			return getResponseEntity.getContent();
		} catch (IOException e) {
			getRequest.abort();
			Log.w("RestAPI.class", "Error for URL " + URL, e);
		}

		return null;
	}

	private static InputStream postStream(String uri, Map<String, String> params) {
		DefaultHttpClient client = new DefaultHttpClient();

		HttpPost postRequest = new HttpPost(URL + "\\" + uri);
		List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(1);
		for (String s : params.keySet()) {

			nameValuePairs.add(new BasicNameValuePair(s, params.get(s)));

		}
		try {
			postRequest.setEntity(new UrlEncodedFormEntity(nameValuePairs));
		} catch (UnsupportedEncodingException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
			HttpResponse getResponse = client.execute(postRequest);
			final int statusCode = getResponse.getStatusLine().getStatusCode();

			if (statusCode != HttpStatus.SC_OK) {
				Log.w("RestAPI.class", "Error " + statusCode + " for URL "
						+ URL);
				return null;
			}

			HttpEntity getResponseEntity = getResponse.getEntity();
			return getResponseEntity.getContent();
		} catch (IOException e) {
			postRequest.abort();
			Log.w("RestAPI.class", "Error for URL " + URL, e);
		}

		return null;
	}

}

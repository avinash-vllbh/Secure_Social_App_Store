package edu.asu.mobicloud;

import java.io.IOException;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.gcm.GoogleCloudMessaging;

import android.app.ActionBar;
import android.app.ActionBar.Tab;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager.NameNotFoundException;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import edu.asu.mobicloud.fragments.MobiListFragment;
import edu.asu.mobicloud.interfaces.ListFragmentDataProvider;
import edu.asu.mobicloud.listeners.TabListener;

public class MainActivity extends BaseActivity implements
		ListFragmentDataProvider {
	private SharedPreferences prefs;
	private final static int PLAY_SERVICES_RESOLUTION_REQUEST = 9000;
	private static final String TAG = "MainActivity";
	public static final String EXTRA_MESSAGE = "message";
	public static final String PROPERTY_REG_ID = "registration_id";
	private static final String PROPERTY_APP_VERSION = "appVersion";
	String SENDER_ID = "584047778741";

	GoogleCloudMessaging gcm;
	String regId;
	Context context;

	@Override
	protected void onCreate(Bundle savedInstanceState) {

		prefs = getSharedPreferences("edu.asu.mobicloud", Context.MODE_PRIVATE);
		super.onCreate(savedInstanceState);
		// setContentView(R.layout.activity_main);
		getActionBar().setDisplayHomeAsUpEnabled(false);
		ActionBar actionBar = getActionBar();
		actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_TABS);
		actionBar.setDisplayShowTitleEnabled(true);

		Tab tab = actionBar
				.newTab()
				.setText(R.string.title_applications_tab)
				.setTabListener(
						new TabListener<MobiListFragment>(this, "apps",
								MobiListFragment.class));
		actionBar.addTab(tab);

		tab = actionBar
				.newTab()
				.setText(R.string.title_friends_tab)
				.setTabListener(
						new TabListener<MobiListFragment>(this, "friends",
								MobiListFragment.class));
		actionBar.addTab(tab);

		tab = actionBar
				.newTab()
				.setText(R.string.title_developers_tab)
				.setTabListener(
						new TabListener<MobiListFragment>(this, "developers",
								MobiListFragment.class));
		actionBar.addTab(tab);

		tab = actionBar
				.newTab()
				.setText(R.string.title_groups_tab)
				.setTabListener(
						new TabListener<MobiListFragment>(this, "groups",
								MobiListFragment.class));
		actionBar.addTab(tab);
		context = getApplicationContext();
		if (checkPlayServices()) {
			gcm = GoogleCloudMessaging.getInstance(this);
			regId = getRegistrationId(context);
			Log.i(TAG, "Registration Id is:" + regId);
			if (regId.isEmpty()) {
				registerInBackground();
			}
		} else {
			Log.i(TAG, "No valid Google Play Services APK found.");
		}

	}

	/*
	 * @Override public boolean onCreateOptionsMenu(Menu menu) { // Inflate the
	 * menu; this adds items to the action bar if it is present.
	 * getMenuInflater().inflate(R.menu.main, menu); // Get the SearchView and
	 * set the searchable configuration SearchManager searchManager =
	 * (SearchManager) getSystemService(Context.SEARCH_SERVICE); SearchView
	 * searchView = (SearchView) menu.findItem(R.id.action_search)
	 * .getActionView(); searchView.setSearchableInfo(searchManager
	 * .getSearchableInfo(getComponentName()));
	 * 
	 * // Do not iconify the widget;expand it by default
	 * searchView.setIconifiedByDefault(false);
	 * 
	 * return super.onCreateOptionsMenu(menu);
	 * 
	 * }
	 */

	/*
	 * @Override public boolean onOptionsItemSelected(MenuItem item) { switch
	 * (item.getItemId()) { case R.id.action_search: onSearchRequested(); return
	 * true;
	 * 
	 * } return super.onOptionsItemSelected(item); }
	 */

	@Override
	protected void onResume() {
		super.onResume();
		checkPlayServices();
	}

	private boolean checkPlayServices() {
		int resultCode = GooglePlayServicesUtil
				.isGooglePlayServicesAvailable(this);
		if (resultCode != ConnectionResult.SUCCESS) {
			if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {
				GooglePlayServicesUtil.getErrorDialog(resultCode, this,
						PLAY_SERVICES_RESOLUTION_REQUEST).show();
			} else {
				Log.i(TAG, "This device is not supported.");
				finish();
			}
			return false;
		}
		return true;

	}

	@Override
	public Bundle getData() {
		Bundle bundle = new Bundle();
		bundle.putString("user_id", prefs.getString("user_id", null));
		return bundle;
	}

	private String getRegistrationId(Context context) {
		final SharedPreferences prefs = getGCMPreferences(context);
		String registrationId = prefs.getString(PROPERTY_REG_ID, "");
		if (registrationId.isEmpty()) {
			Log.i(TAG, "Registration not found.");
			return "";
		}
		// Check if app was updated; if so, it must clear the registration ID
		// since the existing regID is not guaranteed to work with the new
		// app version.
		int registeredVersion = prefs.getInt(PROPERTY_APP_VERSION,
				Integer.MIN_VALUE);
		int currentVersion = getAppVersion(context);
		if (registeredVersion != currentVersion) {
			Log.i(TAG, "App version changed.");
			return "";
		}
		return registrationId;
	}

	/**
	 * @return Application's {@code SharedPreferences}.
	 */
	private SharedPreferences getGCMPreferences(Context context) {

		return getSharedPreferences(MainActivity.class.getSimpleName(),
				Context.MODE_PRIVATE);
	}

	private static int getAppVersion(Context context) {
		try {
			PackageInfo packageInfo = context.getPackageManager()
					.getPackageInfo(context.getPackageName(), 0);
			return packageInfo.versionCode;
		} catch (NameNotFoundException e) {
			// should never happen
			throw new RuntimeException("Could not get package name: " + e);
		}
	}

	private void registerInBackground() {
		new AsyncTask<Void, String, String>() {
			@Override
			protected String doInBackground(Void... params) {
				String msg = "";
				try {
					if (gcm == null) {
						gcm = GoogleCloudMessaging.getInstance(context);
					}
					regId = gcm.register(SENDER_ID);
					msg = "Device registered, registration ID=" + regId;

					System.out.println("RegId:" + regId);
					// sendRegistrationIdToBackend();
					storeRegistrationId(context, regId);
				} catch (IOException ex) {
					msg = "Error :" + ex.getMessage();

				}
				return msg;
			}

			private void storeRegistrationId(Context context, String regId) {
				final SharedPreferences prefs = getGCMPreferences(context);
				int appVersion = getAppVersion(context);
				Log.i(TAG, "Saving regId on app version " + appVersion);
				SharedPreferences.Editor editor = prefs.edit();
				editor.putString(PROPERTY_REG_ID, regId);
				editor.putInt(PROPERTY_APP_VERSION, appVersion);
				editor.commit();

			}

			@Override
			protected void onPostExecute(String msg) {

			}
		}.execute(null, null, null);

	}

}

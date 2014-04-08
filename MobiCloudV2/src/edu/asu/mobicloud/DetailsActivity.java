package edu.asu.mobicloud;

import java.io.File;

import android.app.ListActivity;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.content.res.Resources;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.view.Menu;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnTouchListener;
import android.widget.Button;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;
import edu.asu.mobicloud.adapters.ListAdapter;
import edu.asu.mobicloud.fragments.CommentDialogFragment;
import edu.asu.mobicloud.model.Application;

public class DetailsActivity extends ListActivity {
	private RatingBar editRating;
	private Application application;
	Button b;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_details);

		Bundle extras = getIntent().getExtras();
		if (extras != null) {
			application = extras.getParcelable("application");
			System.out.println("Application ID:" + application.getId());
		}
		TextView appName = (TextView) findViewById(R.id.tvAppName);
		appName.setText(application.getName());
		TextView devName = (TextView) findViewById(R.id.tvDevName);
		devName.setText(application.getDeveloper());
		Resources res = getResources();
		String downloads = res.getQuantityString(R.plurals.downloads,
				application.getDownloads(), application.getDownloads());

		TextView downloadCount = (TextView) findViewById(R.id.tvDownloadCt);
		downloadCount.setText(downloads);

		TextView description = (TextView) findViewById(R.id.description);
		description.setText(application.getDescription());

		RatingBar r = (RatingBar) findViewById(R.id.pop_ratingbar);
		r.setRating(application.getRating());

		ListAdapter adapter = new ListAdapter(getApplicationContext(),
				application.getComments());
		b = (Button) findViewById(R.id.btnDownload);

		b.setOnClickListener(new View.OnClickListener() {

			@Override
			public void onClick(View arg0) {
				if (b.getText().equals("UnInstall")) {

					promptUninstall();
					b.setText("Install");
				} else {
					promptInstall();
					b.setText("UnInstall");
				}

			}
		});
		setListAdapter(adapter);
		editRating = (RatingBar) findViewById(R.id.ratingInput);
		editRating.setOnTouchListener(new OnTouchListener() {

			@Override
			public boolean onTouch(View v, MotionEvent event) {
				if (event.getAction() == MotionEvent.ACTION_UP) {
					CommentDialogFragment commentFragement = new CommentDialogFragment();
					float touchPositionX = event.getX();
					float width = editRating.getWidth();
					float starsf = (touchPositionX / width) * 5.0f;
					int stars = (int) starsf + 1;
					editRating.setRating(stars);
					commentFragement.setRating(stars);
					commentFragement.show(getFragmentManager(),
							"commentFragment");
					v.setPressed(false);
				}
				if (event.getAction() == MotionEvent.ACTION_DOWN) {
					v.setPressed(true);
				}

				if (event.getAction() == MotionEvent.ACTION_CANCEL) {
					v.setPressed(false);
				}
				return true;
			}
		});
		getActionBar().setDisplayHomeAsUpEnabled(true);

	}

	@Override
	protected void onResume() {
		super.onResume();
		boolean installed = false;

		installed = isPackageInstalled("com.example.android.samplesync",
				getApplicationContext());
		if (installed) {
			b = (Button) findViewById(R.id.btnDownload);
			b.setText("UnInstall");
			Toast.makeText(this, "App installed", Toast.LENGTH_SHORT).show();

		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.details, menu);
		return true;
	}

	private void promptInstall() {
		Intent promptInstall = new Intent(Intent.ACTION_VIEW).setDataAndType(
				Uri.fromFile(new File(Environment.getExternalStorageDirectory()
						+ "/Download/" + "AuthenticatorActivity.apk")),
				"application/vnd.android.package-archive");
		startActivity(promptInstall);
	}

	private boolean isPackageInstalled(String packagename, Context context) {
		PackageManager pm = context.getPackageManager();
		try {
			pm.getPackageInfo(packagename, PackageManager.GET_ACTIVITIES);
			return true;
		} catch (NameNotFoundException e) {
			return false;
		}
	}

	private void promptUninstall() {
		Intent intent = new Intent(Intent.ACTION_DELETE, Uri.fromParts(
				"package", "com.example.android.samplesync", null));
		startActivity(intent);
	}

}

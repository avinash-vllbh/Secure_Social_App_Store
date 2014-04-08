package edu.asu.mobicloud;

import java.util.List;

import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Parcelable;
import android.view.Menu;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import edu.asu.mobicloud.adapters.ListAdapter;
import edu.asu.mobicloud.dataproviders.ApplicationDataProvider;
import edu.asu.mobicloud.model.Application;

public class DeveloperDetailsActivity extends ListActivity {
	String developerId;
	List<Application> list;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		Bundle extras = getIntent().getExtras();
		if (extras != null) {
			developerId = extras.getString("name");
			System.out.println("Developer ID:" + developerId);

		}

		setContentView(R.layout.activity_developer_details);
		TextView name = (TextView) findViewById(R.id.developerName);
		name.setText(developerId);
		populateData();
		ListAdapter adapter = new ListAdapter(getApplicationContext(), list);
		setListAdapter(adapter);
		getActionBar().setDisplayHomeAsUpEnabled(true);

	}

	private void populateData() {
		// TODO Call the api method which returns list of applications
		list = ApplicationDataProvider.getInstance().getApps(developerId);

	}

	@Override
	public void onListItemClick(ListView l, View v, int position, long id) {
		Intent intent = new Intent(this.getBaseContext(), DetailsActivity.class);
		intent.putExtra("application", (Parcelable) list.get((int) id));
		this.startActivity(intent);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.developer_details, menu);
		return true;
	}

}

package edu.asu.mobicloud;

import java.util.ArrayList;
import java.util.List;

import edu.asu.mobicloud.adapters.ListAdapter;
import edu.asu.mobicloud.model.Group;
import edu.asu.mobicloud.model.User;
import android.app.ListActivity;
import android.os.Bundle;
import android.view.Menu;
import android.widget.TextView;

public class GroupDetailsActivity extends ListActivity {
	String groupId;
	Group group;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		
		setContentView(R.layout.activity_group_details);
		super.onCreate(savedInstanceState);
		Bundle extras = getIntent().getExtras();
		if (extras != null) {
			group = extras.getParcelable("name");
			System.out.println("Group ID:" + group.getId());
		}
		fillData();
		ListAdapter adapter = new ListAdapter(getApplicationContext(),
				group.getMembers());
		setListAdapter(adapter);
		TextView groupName = (TextView) findViewById(R.id.groupName);
		TextView ownerName = (TextView) findViewById(R.id.ownerName);
		groupName.setText(group.getTitle());
		ownerName.setText(group.getOwner().getUserName());
		getActionBar().setDisplayHomeAsUpEnabled(true);

	}

	private void fillData() {
		// TODO Auto-generated method stub
		group.setImageUri("");
		User u = new User();
		u.setUserName("swaroop");
		group.setOwner(u);
		List<User> l = new ArrayList<User>();
		l.add(u);l.add(u);l.add(u);l.add(u);l.add(u);l.add(u);l.add(u);l.add(u);l.add(u);
		group.setMembers(l);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.group_details, menu);
		return true;
	}

}

package edu.asu.mobicloud.fragments;

import java.util.List;

import android.app.Activity;
import android.app.ListFragment;
import android.content.Intent;
import android.os.Bundle;
import android.os.Parcelable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import edu.asu.mobicloud.DetailsActivity;
import edu.asu.mobicloud.DeveloperDetailsActivity;
import edu.asu.mobicloud.GroupDetailsActivity;
import edu.asu.mobicloud.UserDetailsActivity;
import edu.asu.mobicloud.adapters.ListAdapter;
import edu.asu.mobicloud.dataproviders.ApplicationDataProvider;
import edu.asu.mobicloud.dataproviders.DeveloperDataProvider;
import edu.asu.mobicloud.dataproviders.FriendsDataProvider;
import edu.asu.mobicloud.dataproviders.GroupDataProvider;
import edu.asu.mobicloud.interfaces.ListFragmentDataProvider;
import edu.asu.mobicloud.model.ListData;

public class MobiListFragment extends ListFragment {
	ListFragmentDataProvider provider;
	List<? extends ListData> data = null;
	ApplicationDataProvider appProvider = ApplicationDataProvider.getInstance();
	DeveloperDataProvider devProvider = DeveloperDataProvider.getInstance();
	FriendsDataProvider fProvider = FriendsDataProvider.getInstance();
	GroupDataProvider groupProvider = GroupDataProvider.getInstance();

	/*
	 * static ListData[] numbers_text = new ListData[10]; static int i = 0;
	 * static { for (int i = 0; i < 10; i++) { numbers_text[i] = new ListData();
	 * numbers_text[i].setImageUri(""); numbers_text[i].setData("" + i);
	 * 
	 * } }
	 */
	@Override
	public void onAttach(Activity activity) {
		provider = (ListFragmentDataProvider) activity;
		super.onAttach(activity);
	}

	@Override
	public void onListItemClick(ListView l, View v, int position, long id) {
		String tag = this.getTag();
		if (tag.equalsIgnoreCase("apps")) {
			Intent intent = new Intent(this.getActivity().getBaseContext(),
					DetailsActivity.class);
			intent.putExtra("application", (Parcelable) data.get((int) id));
			this.getActivity().startActivity(intent);

		}
		if (tag.equalsIgnoreCase("friends")) {
			Intent intent = new Intent(this.getActivity().getBaseContext(),
					UserDetailsActivity.class);
			intent.putExtra("name", data.get((int) id).getData());
			this.getActivity().startActivity(intent);

		}
		if (tag.equalsIgnoreCase("developers")) {
			Intent intent = new Intent(this.getActivity().getBaseContext(),
					DeveloperDetailsActivity.class);
			intent.putExtra("name", data.get((int) id).getData());
			this.getActivity().startActivity(intent);

		}

		if (tag.equalsIgnoreCase("groups")) {
			Intent intent = new Intent(this.getActivity().getBaseContext(),
					GroupDetailsActivity.class);
			intent.putExtra("name", (Parcelable) data.get((int) id));
			this.getActivity().startActivity(intent);

		}
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {

		String tag = this.getTag();
		if (tag.equalsIgnoreCase("apps")) {
			data = appProvider.getApps(provider.getData().getString("user_id"));
		} else if (tag.equalsIgnoreCase("friends")) {
			data = fProvider
					.getFriends(provider.getData().getString("user_id"));
		} else if (tag.equalsIgnoreCase("developers")) {
			data = devProvider.getDevelopers(provider.getData().getString(
					"user_id"));
		} else if (tag.equalsIgnoreCase("groups")) {
			data = groupProvider.getGroups(provider.getData().getString(
					"user_id"));
		}
		ListAdapter adapter = new ListAdapter(inflater.getContext(), data);
		setListAdapter(adapter);
		return super.onCreateView(inflater, container, savedInstanceState);
	}
}

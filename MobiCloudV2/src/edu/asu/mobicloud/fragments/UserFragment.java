/**
 * 
 */
package edu.asu.mobicloud.fragments;

import edu.asu.mobicloud.R;
import edu.asu.mobicloud.listeners.TabDefinition;
import edu.asu.mobicloud.listeners.UserTabDefinition;
import android.app.Fragment;
import android.app.FragmentManager;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TabHost;
import android.widget.TabHost.OnTabChangeListener;
import android.widget.TabHost.TabSpec;
import android.widget.TabWidget;

/**
 * @author satyaswaroop
 * 
 */
public class UserFragment extends Fragment implements OnTabChangeListener {

	private final TabDefinition[] TAB_DEFINITIONS = new TabDefinition[] {
			new UserTabDefinition(R.id.friends, R.layout.user_fragment,
					R.string.title_friends_tab, R.id.tabTitle, new Fragment()),
			new UserTabDefinition(R.id.applications, R.layout.user_fragment,
					R.string.title_applications_tab, R.id.tabTitle,
					new Fragment()),
			new UserTabDefinition(R.id.developers, R.layout.user_fragment,
					R.string.title_developers_tab, R.id.tabTitle,
					new Fragment()), };

	//
	// Fields
	//
	private View _viewRoot;
	private TabHost _tabHost;

	//
	// Exposed Members
	//
	@Override
	public void onTabChanged(String tabId) {
		for (TabDefinition tab : TAB_DEFINITIONS) {
			if (tabId != tab.getId()) {
				continue;
			}

			updateTab(tabId, tab.getFragment(), tab.getTabContentViewId());
			System.out.println(tab.getTabContentViewId()+""+tabId);
			return;
		}

		throw new IllegalArgumentException("The specified tab id '" + tabId
				+ "' does not exist.");
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		_viewRoot = inflater.inflate(R.layout.fragment_tabs, null);

		_tabHost = (TabHost) _viewRoot.findViewById(android.R.id.tabhost);
		_tabHost.setup();

		for (TabDefinition tab : TAB_DEFINITIONS) {
			_tabHost.addTab(createTab(inflater, _tabHost, _viewRoot, tab));
		}
		TabWidget tabWidget = _tabHost.getTabWidget();
		_tabHost.getTabWidget().setDividerDrawable(R.drawable.tab_divider);
		for(int i=0; i<tabWidget.getChildCount(); i++)
		  tabWidget.getChildAt(i).setBackgroundResource(R.drawable.tab_background);
		return _viewRoot;
	}

	@Override
	public void onActivityCreated(Bundle savedInstanceState) {
		super.onActivityCreated(savedInstanceState);
		setRetainInstance(true);

		_tabHost.setOnTabChangedListener(this);

		if (TAB_DEFINITIONS.length > 0) {
			onTabChanged(TAB_DEFINITIONS[0].getId());
		}
	}

	//
	// Internal Members
	//
	/**
	 * Creates a {@link TabSpec} based on the specified parameters.
	 * 
	 * @param inflater
	 *            The {@link LayoutInflater} responsible for creating
	 *            {@link View}s.
	 * @param tabHost
	 *            The {@link TabHost} used to create new {@link TabSpec}s.
	 * @param root
	 *            The root {@link View} for the {@link Fragment}.
	 * @param tabDefinition
	 *            The {@link TabDefinition} that defines what the tab will look
	 *            and act like.
	 * @return A new {@link TabSpec} instance.
	 */
	private TabSpec createTab(LayoutInflater inflater, TabHost tabHost,
			View root, TabDefinition tabDefinition) {
		ViewGroup tabsView = (ViewGroup) root.findViewById(android.R.id.tabs);
		View tabView = tabDefinition.createTabView(inflater, tabsView);

		TabSpec tabSpec = tabHost.newTabSpec(tabDefinition.getId());
		tabSpec.setIndicator(tabView);
		tabSpec.setContent(tabDefinition.getTabContentViewId());
		ListView v = (ListView)getActivity().findViewById(R.id.friends);

        String[] values = new String[] { "Android", "iPhone", "WindowsMobile",
             "Blackberry", "WebOS", "Ubuntu", "Windows7", "Max OS X",
        "Linux", "OS/2" };

        ArrayAdapter<String> files = new ArrayAdapter<String>(getActivity(), 
                 android.R.layout.simple_list_item_1, 
                 values);

         v.setAdapter(files);
		return tabSpec;
	}

	/**
	 * Called when switching between tabs.
	 * 
	 * @param tabId
	 *            The unique identifier for the tab.
	 * @param fragment
	 *            The {@link Fragment} to swap in for the tab.
	 * @param containerId
	 *            The layout ID for the {@link View} that houses the tab's
	 *            content.
	 */
	private void updateTab(String tabId, Fragment fragment, int containerId) {
		final FragmentManager manager = getFragmentManager();
		if (manager.findFragmentByTag(tabId) == null) {
			manager.beginTransaction().replace(containerId, fragment, tabId)
					.commit();
		}
	}

}

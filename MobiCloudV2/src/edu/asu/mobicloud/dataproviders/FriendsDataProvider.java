/**
 * 
 */
package edu.asu.mobicloud.dataproviders;

import java.util.ArrayList;
import java.util.List;

import edu.asu.mobicloud.model.Group;
import edu.asu.mobicloud.model.User;

/**
 * @author satyaswaroop
 * 
 */
public class FriendsDataProvider {

	private static FriendsDataProvider fProvider;

	private FriendsDataProvider() {

	}

	public static FriendsDataProvider getInstance() {
		if (fProvider == null) {
			fProvider = new FriendsDataProvider();
		}

		return fProvider;
	}

	public List<User> getFriends(String userId) {
		List<User> list = new ArrayList<User>();

		for (int i = 0; i < 10; i++) {
			User a = new User();
			a.setUserName("swaroop");
			a.setFriends(list);
			a.setGroups(new ArrayList<Group>());
			a.setImageUrl("");
			a.setApps(ApplicationDataProvider.getInstance().getApps(""));
			list.add(a);
		}
		return list;
	}

}

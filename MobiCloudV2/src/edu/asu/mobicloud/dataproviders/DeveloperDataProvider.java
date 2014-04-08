/**
 * 
 */
package edu.asu.mobicloud.dataproviders;

import java.util.ArrayList;
import java.util.List;

import edu.asu.mobicloud.model.Developer;

/**
 * @author satyaswaroop
 * 
 */
public class DeveloperDataProvider {
	private static DeveloperDataProvider devProvider;

	private DeveloperDataProvider() {

	}

	public static DeveloperDataProvider getInstance() {
		if (devProvider == null) {
			devProvider = new DeveloperDataProvider();
		}

		return devProvider;
	}

	public List<Developer> getDevelopers(String userId) {
		List<Developer> list = new ArrayList<Developer>();

		for (int i = 0; i < 10; i++) {
			Developer a = new Developer();
			a.setUserName("swaroop");
			a.setImageUrl("");
			a.setApps(ApplicationDataProvider.getInstance().getApps(""));
			list.add(a);
		}
		return list;
	}
}

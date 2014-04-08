/**
 * 
 */
package edu.asu.mobicloud.dataproviders;

import java.util.ArrayList;
import java.util.List;

import edu.asu.mobicloud.model.Application;
import edu.asu.mobicloud.model.Comment;
import edu.asu.mobicloud.model.User;

/**
 * @author satyaswaroop
 * 
 */
public class ApplicationDataProvider {
	private static ApplicationDataProvider appProvider;

	private ApplicationDataProvider() {

	}

	public static ApplicationDataProvider getInstance() {
		if (appProvider == null) {
			appProvider = new ApplicationDataProvider();
		}

		return appProvider;
	}

	public List<Application> getApps(String userId) {
		List<Application> list = new ArrayList<Application>();
		List<Comment> cList = new ArrayList<Comment>();
		Comment c = new Comment();
		c.setMessage("Awesome App");

		String name = ("Tommy");
		c.setUser(name);
		cList.add(c);
		Comment c1 = new Comment();
		c1.setMessage("Awesome App - good one");
		c1.setUser("Gimmy");
		cList.add(c1);

		for (int i = 0; i < 10; i++) {
			Application a = new Application();
			a.setComments(cList);
			a.setDescription("This is a sample Application");
			a.setDeveloper("user1");
			a.setImageUri("");
			a.setName("SampleApp" + i);
			a.setRating(3);
			a.setDownloads(2);
			list.add(a);
		}
		return list;
	}

}

/**
 * 
 */
package edu.asu.mobicloud.model;

import java.util.List;

/**
 * @author satyaswaroop
 *
 */
public class User implements ListData{
	String userId;
	String userName;
	String imageUrl;
	List<Application> apps;
	List<User> friends;
	List<Group> groups;
	List<Developer> developers;
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getImageUrl() {
		return imageUrl;
	}
	public void setImageUrl(String imageUrl) {
		this.imageUrl = imageUrl;
	}
	public List<Application> getApps() {
		return apps;
	}
	public void setApps(List<Application> apps) {
		this.apps = apps;
	}
	public List<User> getFriends() {
		return friends;
	}
	public void setFriends(List<User> friends) {
		this.friends = friends;
	}
	public List<Group> getGroups() {
		return groups;
	}
	public void setGroups(List<Group> groups) {
		this.groups = groups;
	}
	@Override
	public String getData() {
		return this.userName;
	}
	
	@Override
	public String getImageUri() {
		return imageUrl;
	}
	public String getUserId() {
		return userId;
	}
	public void setUserId(String userId) {
		this.userId = userId;
	}
	public List<Developer> getDevelopers() {
		return developers;
	}
	public void setDevelopers(List<Developer> developers) {
		this.developers = developers;
	}
	
	

}

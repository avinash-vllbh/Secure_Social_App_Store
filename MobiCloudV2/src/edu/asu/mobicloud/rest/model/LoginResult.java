package edu.asu.mobicloud.rest.model;

import java.io.Serializable;
import java.util.List;

public class LoginResult implements Serializable{
	/**
	 * 
	 */
	private static final long serialVersionUID = -875835892027124478L;
	User user;
	List<Application> apps;
	List<User> friends;
	List<User> followers;
	List<Group> groups;
	public User getUser() {
		return user;
	}
	public void setUser(User user) {
		this.user = user;
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
	public List<User> getFollowers() {
		return followers;
	}
	public void setFollowers(List<User> followers) {
		this.followers = followers;
	}
	public List<Group> getGroups() {
		return groups;
	}
	public void setGroups(List<Group> groups) {
		this.groups = groups;
	}

}

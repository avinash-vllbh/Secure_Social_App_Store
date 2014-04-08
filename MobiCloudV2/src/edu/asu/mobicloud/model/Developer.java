package edu.asu.mobicloud.model;

import java.util.List;

public class Developer implements ListData{
	String userName;
	String imageUrl;
	List<Application> apps;

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

	@Override
	public String getData() {
		// TODO Auto-generated method stub
		return userName;
	}

	@Override
	public String getImageUri() {
		// TODO Auto-generated method stub
		return imageUrl;
	}
}

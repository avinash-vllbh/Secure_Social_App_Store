/**
 * 
 */
package edu.asu.mobicloud.model;

import java.util.List;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * @author satyaswaroop
 * 
 */
public class Group implements ListData, Parcelable {
	String title;
	String id;
	String imageUri;
	List<User> members;
	User owner;
	String discription;

	public Group() {

	}

	public Group(Parcel input) {
		title = input.readString();
		id=input.readString();
	}

	public String getDiscription() {
		return discription;
	}

	public void setDiscription(String discription) {
		this.discription = discription;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public List<User> getMembers() {
		return members;
	}

	public void setMembers(List<User> members) {
		this.members = members;
	}

	public User getOwner() {
		return owner;
	}

	public void setOwner(User owner) {
		this.owner = owner;
	}

	@Override
	public String getData() {
		return title;
	}

	@Override
	public String getImageUri() {
		return imageUri;
	}

	public void setImageUri(String imageUri) {
		this.imageUri = imageUri;
	}

	@Override
	public int describeContents() {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public void writeToParcel(Parcel dest, int flags) {
		dest.writeString(title);
		dest.writeString(this.id);
		dest.writeString(imageUri);

		dest.writeString(discription);

	}

	public static final Parcelable.Creator<Group> CREATOR = new Parcelable.Creator<Group>() {

		@Override
		public Group createFromParcel(Parcel input) {
			// TODO Auto-generated method stub
			return new Group(input);
		}

		@Override
		public Group[] newArray(int size) {
			// TODO Auto-generated method stub
			return new Group[size];
		}

	};

}

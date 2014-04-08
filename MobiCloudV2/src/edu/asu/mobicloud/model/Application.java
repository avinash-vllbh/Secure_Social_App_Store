/**
 * 
 */
package edu.asu.mobicloud.model;

import java.util.ArrayList;
import java.util.List;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * @author satyaswaroop
 * 
 */
public class Application implements ListData, Parcelable {

	String name;
	String id;
	String developer;
	String description;
	String imageUri;
	int rating;

	public void setRating(int rating) {
		this.rating = rating;
	}

	int downloads;
	List<Comment> comments;

	public int getDownloads() {
		return downloads;
	}

	public void setDownloads(int downloads) {
		this.downloads = downloads;
	}

	public Application() {

	}

	public Application(Parcel input) {
		this.name = input.readString();
		this.id = input.readString();
		this.developer = input.readString();
		this.description = input.readString();
		this.imageUri = input.readString();
		comments = new ArrayList<Comment>();
		input.readTypedList(comments, Comment.CREATOR);
		rating = input.readInt();
		downloads = input.readInt();
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getDeveloper() {
		return developer;
	}

	public void setDeveloper(String developer) {
		this.developer = developer;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public List<Comment> getComments() {
		return comments;
	}

	public void setComments(List<Comment> comments) {
		this.comments = comments;
	}

	@Override
	public String getData() {
		return name;
	}

	public void setImageUri(String imageUri) {
		this.imageUri = imageUri;
	}

	@Override
	public String getImageUri() {
		return imageUri;
	}

	@Override
	public int describeContents() {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public void writeToParcel(Parcel dest, int flags) {
		dest.writeString(this.name);
		dest.writeString(id);
		
		dest.writeString(developer);
		dest.writeString(description);
		dest.writeString(imageUri);
		dest.writeTypedList((comments));
		dest.writeInt(rating);
		dest.writeInt(downloads);

	}

	public static final Parcelable.Creator<Application> CREATOR = new Parcelable.Creator<Application>() {

		@Override
		public Application createFromParcel(Parcel input) {
			// TODO Auto-generated method stub
			return new Application(input);
		}

		@Override
		public Application[] newArray(int size) {
			// TODO Auto-generated method stub
			return new Application[size];
		}

	};

	public float getRating() {
		// TODO Auto-generated method stub
		return rating;
	}

}

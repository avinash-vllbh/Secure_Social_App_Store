/**
 * 
 */
package edu.asu.mobicloud.model;

import android.os.Parcel;
import android.os.Parcelable;

/**
 * @author satyaswaroop
 * 
 */
public class Comment implements ListData, Parcelable {
	String user;
	String message;

	public Comment() {
		// TODO Auto-generated constructor stub
	}

	public Comment(Parcel input) {
		message = input.readString();
		user = input.readString();

	}

	public String getUser() {
		return user;
	}

	public void setUser(String user) {
		this.user = user;
	}

	public String getMessage() {
		return message;
	}

	public void setMessage(String message) {
		this.message = message;
	}

	@Override
	public String getData() {
		// TODO Auto-generated method stub
		return user + ": \n" + message;
	}

	@Override
	public String getImageUri() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public int describeContents() {
		// TODO Auto-generated method stub
		return 0;
	}

	@Override
	public void writeToParcel(Parcel dest, int flags) {
		dest.writeString(this.message);
		dest.writeString((this.user));

	}

	public static final Parcelable.Creator<Comment> CREATOR = new Parcelable.Creator<Comment>() {

		@Override
		public Comment createFromParcel(Parcel input) {
			// TODO Auto-generated method stub
			return new Comment(input);
		}

		@Override
		public Comment[] newArray(int size) {
			// TODO Auto-generated method stub
			return new Comment[size];
		}

	};

}

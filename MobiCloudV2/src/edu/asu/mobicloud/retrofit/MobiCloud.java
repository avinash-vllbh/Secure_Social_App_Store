package edu.asu.mobicloud.retrofit;

import retrofit.http.Field;
import retrofit.http.FormUrlEncoded;
import retrofit.http.POST;
import edu.asu.mobicloud.rest.model.LoginResult;

interface MobiCloud {
	@FormUrlEncoded
	@POST("users/mobile_login")
	LoginResult tryLogin(@Field("data[User][email]") String email,
			@Field("data[User][password]") String password);
	
	@FormUrlEncoded
	@POST("webapp/users/add.json")
	LoginResult register(@Field("data[User][first_name]") String firstName, @Field("data[User][last_name]") String lastName, @Field("data[User][email]") String email, @Field("data[User][password]") String password, @Field("data[User][password_confirmation]") String confirmation, @Field("data[User][phone]") String phone);
}

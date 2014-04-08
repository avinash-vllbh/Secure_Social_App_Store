package edu.asu.mobicloud;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.Activity;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class RegistrationActivity extends Activity {

	private EditText mEmailView;
	private EditText mPasswordView;
	private EditText mNameView;
	private EditText mConfirmPasswordView;
	private EditText mDateOfBirthView;
	private EditText mMobileNumberView;
	private TextView mRegistrationStatusMessageView;
	private UserRegistrationTask mUserRegistrationTask;
	private View mRegistrationStatusView;
	private View mRegistrationFormView;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_registration);
		mEmailView = (EditText) findViewById(R.id.emailId);
		mPasswordView = (EditText) findViewById(R.id.password);
		mNameView = (EditText) findViewById(R.id.name);
		mConfirmPasswordView = (EditText) findViewById(R.id.confirmPassword);
		mDateOfBirthView = (EditText) findViewById(R.id.dateOfBirth);
		mMobileNumberView = (EditText) findViewById(R.id.contact);
		mRegistrationStatusView = findViewById(R.id.registration_status);
		mRegistrationFormView = findViewById(R.id.registration_form);
		mRegistrationStatusMessageView = (TextView)findViewById(R.id.registration_status_message);
		findViewById(R.id.signUp).setOnClickListener(
				new View.OnClickListener() {
					@Override
					public void onClick(View view) {
						attemptRegister();
					}
				});
		
	}

	protected void attemptRegister() {
		String email = mEmailView.getText().toString();
		String password = mPasswordView.getText().toString();
		String confirmPassword = mConfirmPasswordView.getText().toString();
		String name = mNameView.getText().toString();
		String mobile = mMobileNumberView.getText().toString();
		String dob = mMobileNumberView.getText().toString();
		View focusView = null;
		boolean cancel =false;
		if(TextUtils.isEmpty(email))
		{
			mEmailView.setError(getString(R.string.error_field_required));
			focusView = mEmailView;
			cancel = true;
		}
		else if (!email.contains("@")) {
			mEmailView.setError(getString(R.string.error_invalid_email));
			focusView = mEmailView;
			cancel = true;
		}
		else if(TextUtils.isEmpty(password))
		{
			mPasswordView.setError(getString(R.string.error_field_required));
			focusView = mPasswordView;
			cancel = true;
		}
		else if(TextUtils.isEmpty(confirmPassword))
		{
			mConfirmPasswordView.setError(getString(R.string.error_field_required));
			focusView = mConfirmPasswordView;
			cancel = true;
		}
		else if(confirmPassword.equals(password))
		{
			mConfirmPasswordView.setError(getString(R.string.error_field_required));
			focusView = mConfirmPasswordView;
			cancel = true;
		}
		else if(TextUtils.isEmpty(name))
		{
			mNameView.setError(getString(R.string.error_field_required));
			focusView = mNameView;
			cancel = true;
		}
		else if(TextUtils.isEmpty(mobile))
		{
			mMobileNumberView.setError(getString(R.string.error_field_required));
			focusView = mMobileNumberView;
			cancel = true;
		}
		else if(TextUtils.isEmpty(dob))
		{
			mDateOfBirthView.setError(getString(R.string.error_field_required));
			focusView = mDateOfBirthView;
			cancel = true;
		}
		if (cancel) {
			// There was an error; don't attempt login and focus the first
			// form field with an error.
			focusView.requestFocus();
		} else {
			// Show a progress spinner, and kick off a background task to
			// perform the user login attempt.
			mRegistrationStatusMessageView.setText(R.string.registrationProgress);
			showProgress(true);
			mUserRegistrationTask = new UserRegistrationTask();
			mUserRegistrationTask.execute((Void) null);
		}
		
		
	}
	@TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
	private void showProgress(final boolean show) {
		// On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
		// for very easy animations. If available, use these APIs to fade-in
		// the progress spinner.
		if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2) {
			int shortAnimTime = getResources().getInteger(
					android.R.integer.config_shortAnimTime);

			mRegistrationStatusView.setVisibility(View.VISIBLE);
			mRegistrationStatusView.animate().setDuration(shortAnimTime)
					.alpha(show ? 1 : 0)
					.setListener(new AnimatorListenerAdapter() {
						@Override
						public void onAnimationEnd(Animator animation) {
							mRegistrationStatusView.setVisibility(show ? View.VISIBLE
									: View.GONE);
						}
					});

			mRegistrationFormView.setVisibility(View.VISIBLE);
			mRegistrationFormView.animate().setDuration(shortAnimTime)
					.alpha(show ? 0 : 1)
					.setListener(new AnimatorListenerAdapter() {
						@Override
						public void onAnimationEnd(Animator animation) {
							mRegistrationFormView.setVisibility(show ? View.GONE
									: View.VISIBLE);
						}
					});
		} else {
			// The ViewPropertyAnimator APIs are not available, so simply show
			// and hide the relevant UI components.
			mRegistrationStatusView.setVisibility(show ? View.VISIBLE : View.GONE);
			mRegistrationFormView.setVisibility(show ? View.GONE : View.VISIBLE);
		}
	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.registration, menu);
		return true;
	}
	
	/**
	 * Represents an asynchronous login/registration task used to authenticate
	 * the user.
	 */
	public class UserRegistrationTask extends AsyncTask<Void, Void, Boolean> {
		@Override
		protected Boolean doInBackground(Void... params) {
			// TODO: attempt authentication against a network service.

			try {
				// Simulate network access.
				Thread.sleep(2000);
			} catch (InterruptedException e) {
				return false;
			}
			return true;
		}

		@Override
		protected void onPostExecute(final Boolean success) {
			mUserRegistrationTask = null;
			showProgress(false);

			if (success) {
				finish();
			} else {
				mPasswordView
						.setError(getString(R.string.error_incorrect_password));
				mPasswordView.requestFocus();
			}
		}

		@Override
		protected void onCancelled() {
			mUserRegistrationTask = null;
			showProgress(false);
		}
	}

}

/**
 * 
 */
package edu.asu.mobicloud.fragments;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.View;
import android.widget.RatingBar;
import edu.asu.mobicloud.R;

/**
 * @author satyaswaroop
 * 
 */
public class CommentDialogFragment extends DialogFragment {

	private int stars;
	private RatingBar mRatingBar;

	@Override
	public Dialog onCreateDialog(Bundle savedInstanceState) {
		// Use the Builder class for convenient dialog construction

		AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());

		View view = getActivity().getLayoutInflater().inflate(
				R.layout.comment_dailog, null);
		mRatingBar = (RatingBar) view.findViewById(R.id.editRating);
		mRatingBar.setRating(stars);
		builder.setView(view)

				.setMessage(R.string.comment)
				.setPositiveButton(R.string.submit,
						new DialogInterface.OnClickListener() {
							public void onClick(DialogInterface dialog, int id) {

							}
						})
				.setNegativeButton(R.string.cancel,
						new DialogInterface.OnClickListener() {
							public void onClick(DialogInterface dialog, int id) {

							}
						});
		// Create the AlertDialog object and return it

		return builder.create();
	}

	public void setRating(int stars) {
		// TODO Auto-generated method stub
		this.stars = stars;
	}

}

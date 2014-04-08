package edu.asu.mobicloud.adapters;

import java.io.IOException;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import edu.asu.mobicloud.R;
import edu.asu.mobicloud.model.ListData;

public class ListAdapter extends ArrayAdapter<ListData> {
	private final Context context;
	private final List<? extends ListData> values;

	@SuppressWarnings("unchecked")
	public ListAdapter(Context context, List<? extends ListData> numbers_text) {

		super(context, R.layout.fragement_listview,
				(List<ListData>) numbers_text);
		this.context = context;
		this.values = numbers_text;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		LayoutInflater inflater = (LayoutInflater) context
				.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

		View rowView = inflater.inflate(R.layout.fragement_listview, parent,
				false);
		TextView textView = (TextView) rowView.findViewById(R.id.label);
		ImageView imageView = (ImageView) rowView.findViewById(R.id.logo);
		textView.setText(values.get(position).getData());

		// Change icon based on name
		ListData s = values.get(position);
		if (s.getImageUri() != null && !s.getImageUri().isEmpty()) {
			URL url = null;
			try {
				url = new URL(s.getImageUri());
			} catch (MalformedURLException e) {
				e.printStackTrace();
			}
			Bitmap pic = null;
			try {
				pic = BitmapFactory.decodeStream(url.openConnection()
						.getInputStream());
			} catch (IOException e) {
				e.printStackTrace();
			}
			imageView.setImageBitmap(pic);

		}
		return rowView;
	}

}

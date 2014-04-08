package edu.asu.mobicloud.dataproviders;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.ObjectInputStream;

import android.content.Context;

public class SerializationUtil {
	public static Object readObjectFromFile(Context context, String filename) {

		ObjectInputStream objectIn = null;
		Object object = null;
		try {

			FileInputStream fileIn = context.getApplicationContext()
					.openFileInput(filename);
			objectIn = new ObjectInputStream(fileIn);
			object = objectIn.readObject();

		} catch (FileNotFoundException e) {
			// Do nothing
		} catch (IOException e) {
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} finally {
			if (objectIn != null) {
				try {
					objectIn.close();
				} catch (IOException e) {
					// do nowt
				}
			}
		}

		return object;
	}
}

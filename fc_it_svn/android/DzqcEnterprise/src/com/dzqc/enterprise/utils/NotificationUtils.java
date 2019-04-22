package com.dzqc.enterprise.utils;

import com.dzqc.enterprise.R;

import android.app.Notification;
import android.app.Notification.Builder;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.graphics.BitmapFactory;
import android.media.AudioManager;
import android.net.Uri;
import android.os.Build;

public class NotificationUtils {

	public static void showNotification(Context context, int id, CharSequence title, CharSequence text, Intent intent) {
		PendingIntent resultPendingIntent = PendingIntent.getActivity(context, 0, intent, 0);
		if (Build.VERSION.SDK_INT > Build.VERSION_CODES.HONEYCOMB) {
			showNotificationNew(context, id, title, text, resultPendingIntent);
		} else {
			showNotificationOld(context, id, title, text, resultPendingIntent);
		}
	}

	@SuppressWarnings("deprecation")
	private static void showNotificationNew(Context context, int id, CharSequence title, CharSequence text, PendingIntent intent) {
		NotificationManager notificationManager = (NotificationManager) context.getSystemService(android.content.Context.NOTIFICATION_SERVICE);
		Builder builder = new Builder(context);
		builder.setLargeIcon(BitmapFactory.decodeResource(context.getResources(), R.drawable.ws_launcher));
		builder.setSmallIcon(R.drawable.ic_notification);
		builder.setContentTitle(title);
		builder.setContentText(text);
		builder.setContentIntent(intent);
		Uri soundUri = Uri.parse("android.resource://" + context.getPackageName() + "/" + R.raw.ring);
		builder.setSound(soundUri, AudioManager.STREAM_MUSIC);
		builder.setVibrate(new long[] { 0, 300, 500, 400 });
		Notification notification = builder.getNotification();
		notificationManager.notify(id, notification);
	}

	@SuppressWarnings("deprecation")
	private static void showNotificationOld(Context context, int id, CharSequence title, CharSequence text, PendingIntent intent) {
		NotificationManager notificationManager = (NotificationManager) context.getSystemService(android.content.Context.NOTIFICATION_SERVICE);
		Notification notification = new Notification();
		notification.icon = R.drawable.ic_notification;
		notification.largeIcon = BitmapFactory.decodeResource(context.getResources(), R.drawable.ws_launcher);
		notification.flags = Notification.FLAG_AUTO_CANCEL;
		notification.setLatestEventInfo(context, title, text, intent);
		Uri soundUri = Uri.parse("android.resource://" + context.getPackageName() + "/" + R.raw.ring);
		notification.sound = soundUri;
		notification.vibrate = new long[] { 0, 300, 500, 400 };
		notificationManager.notify(R.string.app_display_name, notification);
	}
}

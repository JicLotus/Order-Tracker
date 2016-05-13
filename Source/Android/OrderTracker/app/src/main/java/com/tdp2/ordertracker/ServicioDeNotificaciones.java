package com.tdp2.ordertracker;

import android.app.NotificationManager;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.os.IBinder;
import android.support.v4.app.NotificationCompat;
import android.util.Log;

public class ServicioDeNotificaciones extends Service {
    private static final String TAG = "MyService";

    @Override
    public IBinder onBind(Intent i) {
        // TODO Auto-generated method stub
        return null;
    }

    @Override
    public int onStartCommand(final Intent intent, int flags, int startId) {

        new Thread(new Runnable() {

            @Override
            public void run() {
                Log.d(TAG, "FirstService started");
                // El servicio se finaliza a sí mismo cuando finaliza su
                // trabajo.
                try {
                    // Simulamos trabajo de 10 segundos.
                    Thread.sleep(1000);

                    // Instanciamos e inicializamos nuestro manager.
                    NotificationManager nManager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);

                    NotificationCompat.Builder builder = new NotificationCompat.Builder(
                            getBaseContext())
                            .setSmallIcon(android.R.drawable.ic_dialog_info)
                            .setContentTitle("MyService")
                            .setSmallIcon(R.drawable.ic_label_verde)
                            .setContentText("Terminó el servicio!")
                            .setWhen(System.currentTimeMillis());
                    nManager.notify(12345, builder.build());

                    Log.d(TAG, "sleep finished");
                } catch (InterruptedException e) {
                    // TODO Auto-generated catch block
                    e.printStackTrace();
                }

            }
        }).start();

        this.stopSelf();
        return super.onStartCommand(intent, flags, startId);
    }
}
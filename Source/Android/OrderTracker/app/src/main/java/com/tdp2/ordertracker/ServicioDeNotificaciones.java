package com.tdp2.ordertracker;

import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.IBinder;
import android.support.v4.app.NotificationCompat;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class ServicioDeNotificaciones extends Service {
    private static final String TAG = "MyService";
    private boolean corriendo;

    @Override
    public IBinder onBind(Intent i) {
        // TODO Auto-generated method stub
        return null;
    }

    @Override
    public void onCreate() {
        corriendo = true;
    }

    @Override
    public int onStartCommand(final Intent intent, int flags, int startId) {
        Log.i("service", "Service onStartCommand");

        new Thread(new Runnable() {
            @Override
            public void run() {

                while(corriendo) {
                    try {
                        Thread.sleep(20000);
                    } catch (Exception e) {
                    }

                    notificar();
                }

                //stopSelf();
            }
        }).start();

        return Service.START_STICKY;

    }


    public void notificar(){
        Request request = new Request("GET", "GetNotificaciones.php?id_usuario=" +
        ManejadorPersistencia.obtenerIdVendedor(this));

        Response resp = new RequestHandler().sendRequest(request);

        JSONArray notificaciones = resp.getJsonArray();
        Intent intent = new Intent(this, MainActivity.class);
        PendingIntent contentIntent = PendingIntent.getActivity(this, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);

        NotificationManager notificationManager = (NotificationManager) this.getSystemService(Context.NOTIFICATION_SERVICE);
        NotificationCompat.Builder b = new NotificationCompat.Builder(this);
        b.setAutoCancel(true)
                .setDefaults(Notification.DEFAULT_ALL)
                .setLights(Color.GRAY, 500, 500)
                .setWhen(System.currentTimeMillis())
                .setDefaults(Notification.DEFAULT_SOUND)
                .setContentIntent(contentIntent)
                .setContentInfo("Info");

        if (notificaciones!=null){
            for (int i = 0; i < notificaciones.length(); i++) {

                String titulo="";
                String subtitulo="";
                try {
                    switch (notificaciones.getJSONObject(i).getString(APIConstantes.TIPO_NOTIFICACION)){
                        case APIConstantes.TIPO_AGENDA:{
                            titulo = "El día " + notificaciones.getJSONObject(i).getString(APIConstantes.VALOR)
                                    + " ha sido reprogramado";
                            b.setSmallIcon(R.drawable.ic_agenda);
                            break;
                        }
                        case APIConstantes.TIPO_CATEGORIA:{
                            double porcentaje = notificaciones.getJSONObject(i).getDouble(APIConstantes.DESCUENTOS_PORCENTAJE);
                            porcentaje = porcentaje*100;
                            titulo = String.valueOf((int)porcentaje)
                                    +"% de Descuento";
                            subtitulo = "Descuento aplica a "+ notificaciones.getJSONObject(i).getString(APIConstantes.VALOR);
                            b.setSmallIcon(R.drawable.ic_descuento_blanco);
                            break;
                        }
                        case APIConstantes.TIPO_MARCA:{
                            double porcentaje = notificaciones.getJSONObject(i).getDouble(APIConstantes.DESCUENTOS_PORCENTAJE);
                            porcentaje = porcentaje*100;
                            titulo = String.valueOf((int)porcentaje)
                                    +"% de Descuento";
                            subtitulo = "Descuento aplica a productos "+ notificaciones.getJSONObject(i).getString(APIConstantes.VALOR);
                            b.setSmallIcon(R.drawable.ic_descuento_blanco);
                            break;
                        }
                        case APIConstantes.TIPO_CANTIDAD:{
                            double porcentaje =  notificaciones.getJSONObject(i).getDouble(APIConstantes.DESCUENTOS_PORCENTAJE);
                            porcentaje = porcentaje*100;
                            titulo = String.valueOf((int)porcentaje)
                                    + "% de Descuento";
                            subtitulo = "Llevando " + notificaciones.getJSONObject(i).getString(APIConstantes.VALOR)
                                    + " o más productos iguales";
                            b.setSmallIcon(R.drawable.ic_descuento_blanco);
                            break;
                        }

                    }
                    b.setContentTitle(titulo);
                    b.setContentText(subtitulo);
                    notificationManager.notify(notificaciones.getJSONObject(i).getInt(APIConstantes.ID_NOTIFICACION), b.build());

                } catch (JSONException e) {
                    e.printStackTrace();
                }



            }
        }

    }
}
package com.tdp2.ordertracker;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class Estadisticas extends AppCompatActivity{
    String vendedor;
    private String fechaActual;
    JSONObject datosDelDia;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        vendedor = ManejadorPersistencia.obtenerIdVendedor(this);
        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();
        fechaActual = dateFormat.format(date).toString();

        setContentView(R.layout.activity_estadisticas);
//        pedirEstadisticas();

    }

    private void pedirEstadisticas() {
        try {
            Request request = new Request("GET", "GetEstadisticas.php?id=" + vendedor + "&fecha=" + fechaActual);
            Log.e("Request", "GetEstadisticas.php?id=" + vendedor + "&fecha=" + fechaActual);
            Response resp = new RequestHandler().sendRequest(request);
            datosDelDia = resp.getJsonArray().getJSONObject(0);

            ((TextView)findViewById(R.id.cant_atrazadas)).setText(datosDelDia.getString("cant_atrazadas"));
            ((TextView)findViewById(R.id.cant_visitados)).setText(datosDelDia.getString("cant_visitados"));
            ((TextView)findViewById(R.id.cant_visitados_fuera_ruta)).setText(datosDelDia.getString("cant_visitados_fuera_ruta"));
            ((TextView)findViewById(R.id.cant_visitar_hoy)).setText(datosDelDia.getString("cant_visitar_hoy"));
            ((TextView)findViewById(R.id.precio_vendido_fuera_ruta)).setText("$ " + datosDelDia.getString("precio_vendido_fuera_ruta"));
            ((TextView)findViewById(R.id.precio_vendidos)).setText("$ " + datosDelDia.getString("precio_vendidos"));
            ((TextView)findViewById(R.id.precio_vendidos_del_dia)).setText("$ " + datosDelDia.getString("precio_vendidos_del_dia"));

        } catch (Exception e) {
        }
    }
}

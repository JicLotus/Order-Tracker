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

    }

    @Override
    public void onResume(){
        super.onResume();
        pedirEstadisticas();
    }
    private void pedirEstadisticas() {
        try {
            Request request = new Request("GET", "GetEstadisticas.php?id_usuario=" + vendedor);
            Log.e("Request", "GetEstadisticas.php?id=" + vendedor + "&fecha=" + fechaActual);
            Response resp = new RequestHandler().sendRequest(request);

            if (resp.getJsonArray() != null){
                datosDelDia = resp.getJsonArray().getJSONObject(0);
                int atrasadosHoy = datosDelDia.getInt(APIConstantes.ESTADISTICAS_A_VISITAR)
                        - datosDelDia.getInt(APIConstantes.ESTADISTICAS_VISITADOS_HOY);

                int totalVendidoHoy = datosDelDia.getInt(APIConstantes.ESTADISTICAS_VENDIDO_FUERA_RUTA)
                        + datosDelDia.getInt(APIConstantes.ESTADISTICAS_VENDIDO_CLIENTES);

                ((TextView)findViewById(R.id.cant_atrazadas)).setText(String.valueOf(atrasadosHoy));
                ((TextView)findViewById(R.id.cant_visitados)).setText(datosDelDia.getString(APIConstantes.ESTADISTICAS_VISITADOS_HOY));
                ((TextView)findViewById(R.id.cant_visitados_fuera_ruta)).setText(datosDelDia.getString(APIConstantes.ESTADISTICAS_FUERA_RUTA));
                ((TextView)findViewById(R.id.cant_visitar_hoy)).setText(datosDelDia.getString(APIConstantes.ESTADISTICAS_A_VISITAR));
                ((TextView)findViewById(R.id.precio_vendido_fuera_ruta)).setText("$ " + datosDelDia.getString(APIConstantes.ESTADISTICAS_VENDIDO_FUERA_RUTA));
                ((TextView)findViewById(R.id.precio_vendidos)).setText("$ " + String.valueOf(totalVendidoHoy));
                ((TextView)findViewById(R.id.precio_vendidos_del_dia)).setText("$ " + datosDelDia.getString(APIConstantes.ESTADISTICAS_VENDIDO_CLIENTES));

            }

        } catch (Exception e) {
        }
    }
}

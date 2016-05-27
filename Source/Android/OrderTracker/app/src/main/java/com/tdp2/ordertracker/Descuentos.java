package com.tdp2.ordertracker;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class Descuentos extends AppCompatActivity {
    private RecyclerView rv;
    private JSONArray descuentos;
    private String idVendedor;
    private String fechaActual;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        idVendedor = ManejadorPersistencia.obtenerIdVendedor(this);
        String str_descuentos = ManejadorPersistencia.obtenerDescuentos(this);
        try {
            descuentos = new JSONArray(str_descuentos);
        } catch (JSONException e) {
            descuentos = new JSONArray();
        }


        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();

        fechaActual = dateFormat.format(date).toString();


        setContentView(R.layout.activity_descuentos);

        ((TextView) findViewById(R.id.email_drawer)).setText(ManejadorPersistencia.obtenerNombreVendedor(this));

        rv = (RecyclerView)findViewById(R.id.recycler_view_descuentos);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);
        DescuentosAdapter adapter = new DescuentosAdapter(obtenerDescuentos());
        adapter.setJsonArray(descuentos);
        rv.setAdapter(adapter);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_detalles_agenda, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        return true;
    }

    private List<DescuentosItem> obtenerDescuentos() {

        List<DescuentosItem> items = new ArrayList<>();
        try {
            for (int i = 0; i < descuentos.length(); i++) {
                int cantidad = Integer.parseInt(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_CANTIDAD));
                double porcentaje = 100 * Double.parseDouble(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_PORCENTAJE));
                String marca = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_MARCA);
                String categoria = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_CATEGORIA);
                String fecha_in = descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_FECHA_INICIO);
                String fecha_fin = descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_FECHA_FIN);
                items.add(new DescuentosItem(cantidad, porcentaje, marca, categoria, fecha_in, fecha_fin));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }

    @Override
    protected void onResume(){
        super.onResume();

        String str_descuentos = ManejadorPersistencia.obtenerDescuentos(this);
        try {
            descuentos = new JSONArray(str_descuentos);
        } catch (JSONException e) {
            descuentos = new JSONArray();
        }
        DescuentosAdapter adapter = new DescuentosAdapter(obtenerDescuentos());
        adapter.setJsonArray(descuentos);
        rv.setAdapter(adapter);

    }

}

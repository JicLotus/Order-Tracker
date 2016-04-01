package com.tdp2.ordertracker;

import android.support.design.widget.CollapsingToolbarLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DetallesProducto extends AppCompatActivity {

    private JSONObject producto;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles);

        try {
            producto = new JSONObject(getIntent().getStringExtra("jsonArray"));
        }catch(Exception e){}


        this.setAdaptador(this.getListaDetalles());

        Toolbar toolbar = (Toolbar) findViewById(R.id.app_toolbar_producto);
        try {
            toolbar.setTitle(producto.getString("nombre"));
        }
        catch(Exception e){}

        setSupportActionBar(toolbar);

    }

    public ArrayList<String> getListaDetalles()
    {
        ArrayList<String> datos = new ArrayList<String>();

        try {
            datos.add("Precio: " + producto.getString("precio"));
            datos.add("Codigo: " + producto.getString("codigo"));
            datos.add("Caracteristicas: " + producto.getString("caracteristicas"));
            datos.add("Stock: " + producto.getString("stock"));
            datos.add("Marca: " + producto.getString("marca"));
            datos.add("Estado: " + producto.getString("estado"));
            datos.add("Categoria: " + producto.getString("categoria"));
        }
        catch(Exception e){}

        return datos;
    }

    public void setAdaptador(ArrayList<String> datos)
    {
        ArrayAdapter<String> adaptador = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,datos);
        ListView listado = (ListView) findViewById(R.id.list);
        listado.setAdapter(adaptador);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_detalles_producto, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

}

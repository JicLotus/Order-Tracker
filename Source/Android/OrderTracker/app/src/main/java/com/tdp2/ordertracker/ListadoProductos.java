package com.tdp2.ordertracker;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.List;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class ListadoProductos extends AppCompatActivity {
    private RecyclerView rv;
    private JSONArray productos;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_listado_productos);

        Toolbar toolbar = (Toolbar) findViewById(R.id.app_toolbar_productos);
        setSupportActionBar(toolbar);
        this.pedirProductos();

        rv = (RecyclerView)findViewById(R.id.recycler_view_productos);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);
        RecyclerViewAdapter adapter = new RecyclerViewAdapter(obtenerProductos(), DetallesProducto.class);
        rv.setAdapter(adapter);
    }


    private void pedirProductos()
    {
        Request request = new Request("GET", "GetProductos.php");
        Response resp = new RequestHandler().sendRequest(request);

        if (resp.getStatus())
            productos = resp.getJsonArray();
        else
            productos = new JSONArray();

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_listado_productos, menu);
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

    public List<RecyclerViewItem> obtenerProductos() {
        //TODO: cambiar a get php
        List<RecyclerViewItem> items = new ArrayList<>();
        try {
            for (int i = 0; i < productos.length(); i++) {
                items.add(new RecyclerViewItem(productos.getJSONObject(i).getString("precio"),productos.getJSONObject(i).getString("nombre"), R.drawable.launcher_icon));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }

}

package com.tdp2.ordertracker;

import android.support.design.widget.CollapsingToolbarLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;

import java.util.ArrayList;
import java.util.List;

public class DetallesProducto extends AppCompatActivity {
    private RecyclerView recyclerView;
    private CollapsingToolbarLayout ctlLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles);

        Toolbar toolbar = (Toolbar) findViewById(R.id.app_bar_layout);
        setSupportActionBar(toolbar);

        ctlLayout = (CollapsingToolbarLayout)findViewById(R.id.collapsing_toolbar);
        ctlLayout.setTitle("Nombre Producto");  //TODO: cambiar por el nombre del producto

        recyclerView = (RecyclerView)findViewById(R.id.detalles_producto_recycler_view);
        recyclerView.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(llm);
        RecyclerViewAdapter adapter = new RecyclerViewAdapter(obtenerDetalles(), null);
        recyclerView.setAdapter(adapter);
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

    private List<RecyclerViewItem> obtenerDetalles() {
        //TODO: cambiar a get php
        List<RecyclerViewItem> items = new ArrayList<>();
        items.add(new RecyclerViewItem("Marca", "Desc1", R.drawable.launcher_icon));
        items.add(new RecyclerViewItem("Precio", "Desc2", R.drawable.launcher_icon));
        items.add(new RecyclerViewItem("Codigo", "Desc3", R.drawable.launcher_icon));
        return items;
    }
}

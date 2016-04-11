package com.tdp2.ordertracker;

import android.content.Intent;
import android.content.res.TypedArray;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;

import java.util.ArrayList;

public class MenuInicial extends AppCompatActivity {

    JSONArray vendedor;

    private ArrayList<NavDrawerItem> navDrawerItems;
    private DrawerLayout mDrawerLayout;
    private ListView mDrawerList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        try {
            vendedor = new JSONArray(getIntent().getStringExtra("vendedor"));
        }catch(Exception e){}

        setContentView(R.layout.activity_menu_inicial);

        navDrawerItems = new ArrayList();
        cargarNavDrawerItems();

        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);



        mDrawerList = (ListView) findViewById(R.id.drawer_izquierdo);

        // Set the adapter for the list view
        mDrawerList.setAdapter(new NavDrawerAdapter(this, navDrawerItems));
        // Set the list's click listener
        mDrawerList.setOnItemClickListener(new DrawerItemClickListener());

    }

    private void cargarNavDrawerItems() {
        String[] titulosSecciones = getResources().getStringArray(R.array.titulos_nav_drawer);
        TypedArray idIconosSecciones = getResources().obtainTypedArray(R.array.id_iconos_nav_drawer);

        for (int i=0; i < titulosSecciones.length; i++) {
            navDrawerItems.add(new NavDrawerItem(titulosSecciones[i], idIconosSecciones.getResourceId(i, -1)));
        }
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_menu_inicial, menu);
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

    public void verProductos(View view) {
        Intent documentsActivity = new Intent(this, ListadoProductos.class);
        startActivity(documentsActivity);
    }
    public void verAgenda(View view) {
        Intent documentsActivity = new Intent(this, AgendaActivity.class);
        startActivity(documentsActivity);
    }

    public void verClientes(View view) {
        Intent documentsActivity = new Intent(this, ListadoClientes.class);
        try {
            documentsActivity.putExtra("id", vendedor.getJSONObject(0).get("id").toString());
        }catch(Exception e){}
        startActivity(documentsActivity);
    }


    private class DrawerItemClickListener implements android.widget.AdapterView.OnItemClickListener {
        @Override
        public void onItemClick(AdapterView parent, View view, int position, long id) {
            switch (position) { //TODO: cambiar por algo mas bello y menos hardcodeado
                case 0:
                    verProductos(view);
                    break;
                case 1: verClientes(view);
                    break;
                case 2: verAgenda(view);
            }
        }
    }
}

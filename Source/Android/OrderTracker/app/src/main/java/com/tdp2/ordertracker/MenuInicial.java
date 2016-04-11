package com.tdp2.ordertracker;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import org.json.JSONArray;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class MenuInicial extends AppCompatActivity {

    //JSONArray vendedor;
    String vendedor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.vendedor = ManejadorPersistencia.obtenerVendedor(this);
        setContentView(R.layout.activity_menu_inicial);
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
        startActivity(documentsActivity);
    }
}

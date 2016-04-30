package com.tdp2.ordertracker;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;

import org.json.JSONArray;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class ListadoClientes extends AppCompatActivity {
    private RecyclerView rv;
    private JSONArray clientes;
    private String idVendedor;
    private String fechaActual;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        idVendedor = ManejadorPersistencia.obtenerIdVendedor(this);

        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();

        fechaActual = dateFormat.format(date).toString();


        setContentView(R.layout.activity_listado_clientes);

        ((TextView) findViewById(R.id.email_drawer)).setText(ManejadorPersistencia.obtenerNombreVendedor(this));

        this.pedirClientes();

        rv = (RecyclerView)findViewById(R.id.recycler_view_clientes);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);
        ClienteAdapter adapter = new ClienteAdapter(obtenerClientes(), DetallesCliente.class);
        adapter.setJsonArray(clientes);
        rv.setAdapter(adapter);
    }


    private void pedirClientes()
    {
        Request request = new Request("GET", "GetFueraRuta.php?id="+idVendedor+"&fecha="+fechaActual);
        Log.e("Request", "GetFueraRuta.php?id="+idVendedor+"&fecha="+fechaActual);
        Response resp = new RequestHandler().sendRequest(request);

        if (resp.getStatus())
            clientes = resp.getJsonArray();
        else
            clientes = new JSONArray();

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_listado_clientes, menu);
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

    private List<RecyclerViewItem> obtenerClientes() {

        List<RecyclerViewItem> items = new ArrayList<>();
        try {
            for (int i = 0; i < clientes.length(); i++) {
                items.add(new RecyclerViewItem(clientes.getJSONObject(i).getString("nombre"),clientes.getJSONObject(i).getString("direccion"), R.drawable.perfil_vacio));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }

}

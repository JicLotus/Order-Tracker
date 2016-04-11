package com.tdp2.ordertracker;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

/**
 * Created by juan on 06/04/16.
 */
public class AgendaActivity extends AppCompatActivity{

    RecyclerView rv;
    String vendedor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_agenda);

        this.vendedor = ManejadorPersistencia.obtenerVendedor(this);


        rv = (RecyclerView)findViewById(R.id.recycler_view_agenda);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);
        AgendaAdapter adapter = new AgendaAdapter(getUsuariosAgenda());
        //AgendaAdapter adapter = new AgendaAdapter(initializeData());
        //adapter.setJsonArray(clientes);
        rv.setAdapter(adapter);
    }

    private ArrayList<Agenda> initializeData(){
        ArrayList<Agenda> usuarios = new ArrayList<>();
        usuarios.add(new Agenda("Emma Wilson", "Superi 3683, CABA", "19.00pm"));
        usuarios.add(new Agenda("Lavery Maiss", "Madero 205, Vicente Lopez", "17.00pm"));
        usuarios.add(new Agenda("Lillie Watts", "Libertador 2430, CABA", "19.00pm"));
        return usuarios;

    }

    public ArrayList<Agenda> getUsuariosAgenda(){
        ArrayList<Agenda> listaUsuarios= new ArrayList<Agenda>();
        Date cDate = new Date();
        String fDate = new SimpleDateFormat("yyyy-MM-dd").format(cDate);

        DateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.ENGLISH);


        try {
            Request request = new Request("GET", "GetClientes.php?id="+vendedor);
            Response resp = new RequestHandler().sendRequest(request);
            for (int i=0;i<resp.getJsonArray().length();i++){
                JSONObject agenda = resp.getJsonArray().getJSONObject(i);
                Date date = format.parse(agenda.getString("fecha"));
                String hora = new SimpleDateFormat("HH:mm").format(date);

                Agenda unaAgenda = new Agenda(agenda.getString("nombre"),
                        agenda.getString("direccion"), hora);
                listaUsuarios.add(unaAgenda);
            }
        }
        catch(Exception e){}

        return listaUsuarios;
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
            for (int i = 0; i < 10; i++) {
                items.add(new RecyclerViewItem("Juan Perez","Superi 3683", 0));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }

}

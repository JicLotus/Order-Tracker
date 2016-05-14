package com.tdp2.ordertracker;

import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.SupportMapFragment;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

import GoogleMaps.GMPolyline;
import Model.Request;
import Model.RequestHandler;
import Model.Response;

/**
 * Created by juan on 06/04/16.
 */


public class AgendaActivity extends AppCompatActivity {

    RecyclerView rv;
    String vendedor;
    AgendaAdapter.AgendaViewHolder usuarioSeleccionado;
    JSONArray clientesDelDia;
    private DrawerLayout mDrawerLayout;
    private RelativeLayout mDrawerList;
    private GoogleMap mMap;
    private String[] mPlanetTitles;

    private CharSequence mTitle;
    private ActionBarDrawerToggle mDrawerToggle;
    private CharSequence mDrawerTitle;

    private String fechaActual;
    private GMPolyline map;

    ArrayList<Agenda> usuarios;
    ArrayList<TextView> items;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_agenda);

        this.vendedor = ManejadorPersistencia.obtenerIdVendedor(this);
        this.items = new ArrayList<TextView>();
        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();

        fechaActual = dateFormat.format(date).toString();
        usuarios = getUsuariosAgenda();

        rv = (RecyclerView) findViewById(R.id.recycler_view_agenda);
        rv.setHasFixedSize(true);


        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        AgendaAdapter adapter = new AgendaAdapter(usuarios);
        rv.setAdapter(adapter);


        mPlanetTitles = getResources().getStringArray(R.array.dias_array);
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerList = (RelativeLayout) findViewById(R.id.left_drawer);

        ((TextView) findViewById(R.id.email_drawer)).setText(ManejadorPersistencia.obtenerNombreVendedor(this));
        cargarItems();
        mTitle = mDrawerTitle = getTitle();

        Calendar calendar = Calendar.getInstance();
        int day = calendar.get(Calendar.DAY_OF_WEEK);

        switch (day) {
            case Calendar.MONDAY:{
                ((TextView) findViewById(R.id.lunes)).setTypeface(null, Typeface.BOLD);
                fechaActual="Lunes";
                break;
            }

            case Calendar.TUESDAY:{
                ((TextView) findViewById(R.id.martes)).setTypeface(null, Typeface.BOLD);
                fechaActual="Martes";
                break;
                }
            case Calendar.WEDNESDAY:{
                ((TextView) findViewById(R.id.miercoles)).setTypeface(null, Typeface.BOLD);
                fechaActual="Miercoles";
                break;
                }
            case Calendar.THURSDAY:{
                ((TextView) findViewById(R.id.jueves)).setTypeface(null, Typeface.BOLD);
                fechaActual="Jueves";
                break;
                }
            case Calendar.FRIDAY:{
                ((TextView) findViewById(R.id.viernes)).setTypeface(null, Typeface.BOLD);
                fechaActual="Viernes";
                break;
            }
            case Calendar.SATURDAY:{
                fechaActual="Lunes";
                break;
            }
            case Calendar.SUNDAY:{
                fechaActual="Lunes";
                break;
            }
        }

        mostrarAgendaDelDia();

        this.crearDraweToggle();
    }


    private void cargarItems() {
        TextView unDia = (TextView) findViewById(R.id.itemDia);
        unDia = new TextView(this);

        unDia.setText("Lunes");
        items.add(unDia);
    }


    private void crearDraweToggle() {
        mDrawerToggle = new ActionBarDrawerToggle(
                this,
                mDrawerLayout,
                R.drawable.monitor,
                R.string.action_settings,
                R.string.action_settings
        ) {
            public void onDrawerClosed(View view) {

            }

            public void onDrawerOpened(View drawerView) {
                mDrawerList.bringToFront();
                mDrawerLayout.requestLayout();
            }
        };

        mDrawerLayout.setDrawerListener(mDrawerToggle);
    }

    private void selectItem(int position) {
        //mDrawerList.setItemChecked(position, true);
        mDrawerLayout.closeDrawer(mDrawerList);
    }

    public ArrayList<Agenda> getUsuariosAgenda() {
        ArrayList<Agenda> listaUsuarios = new ArrayList<Agenda>();
        Date cDate = new Date();

        DateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.ENGLISH);

        try {
            Request request = new Request("GET", "GetClientes.php?id=" + vendedor + "&fecha=" + fechaActual);
            Log.e("Reuqest","GetClientes.php?id=" + vendedor + "&fecha=" + fechaActual );
            Response resp = new RequestHandler().sendRequest(request);

            clientesDelDia = resp.getJsonArray();
            for (int i = 0; i < clientesDelDia.length(); i++) {
                JSONObject agenda = clientesDelDia.getJSONObject(i);
                Date date = format.parse(agenda.getString("fecha"));
                String hora = new SimpleDateFormat("HH:mm").format(date);
                Agenda unaAgenda = new Agenda(agenda.getString("nombre"), agenda.getString("direccion"), hora,
                        agenda.getString("id"), agenda.getString(APIConstantes.AGENDA_ESTADO), agenda.getString(APIConstantes.ID_AGENDA));
                listaUsuarios.add(unaAgenda);
            }
        } catch (Exception e) {
        }

        return listaUsuarios;
    }


    public void verDia(View view) {
        int id = view.getId();
        String diaSeleccionado = "";
        selectItem(id);

        switch (id) {

            //Fuera de ruta
            case R.id.fueraDeRuta:

                Intent documentsActivity = new Intent(view.getContext(), ListadoClientes.class);
                startActivity(documentsActivity);
                break;
            case R.id.lunes:

                diaSeleccionado = "Lunes";
                fechaActual = diaSeleccionado;

                mostrarAgendaDelDia();
                break;
            case R.id.martes:

                diaSeleccionado = "Martes";
                fechaActual = diaSeleccionado;

                mostrarAgendaDelDia();

                break;
            case R.id.miercoles:

                diaSeleccionado = "Miercoles";
                fechaActual = diaSeleccionado;
                mostrarAgendaDelDia();

                break;
            case R.id.jueves:
                diaSeleccionado = "Jueves";
                fechaActual = diaSeleccionado;
                mostrarAgendaDelDia();
                break;
            case R.id.viernes:
                diaSeleccionado = "Viernes";
                fechaActual = diaSeleccionado;
                mostrarAgendaDelDia();

                break;
            case R.id.estadisticas:
                Intent estadisticasActivity = new Intent(view.getContext(), Estadisticas.class);
                startActivity(estadisticasActivity);
                break;
        }


    }

    private void mostrarAgendaDelDia(){
        usuarios = getUsuariosAgenda();

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        map = new GMPolyline(usuarios, mapFragment, this);
        AgendaAdapter adapter = new AgendaAdapter(usuarios);
        rv.setAdapter(adapter);

    }

    public void onActivityResult(int requestCode, int resultCode, Intent intent) {

        if (requestCode == 0) {
            if (resultCode == RESULT_OK) {
                String contents = intent.getStringExtra("SCAN_RESULT");
                if (contents.equals(usuarioSeleccionado.id)){
                    Toast.makeText(this, "Bienvenido, "+ usuarioSeleccionado.nombre.getText(), Toast.LENGTH_LONG).show();
                    intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                    marcarUsuarioComoVisitado();
                    Intent documentsActivity = new Intent(this, ListadoProductos.class);
                    documentsActivity.putExtra("cliente", jsonCliente(usuarioSeleccionado.id));
                    startActivity(documentsActivity);
                }else{
                    Toast.makeText(this, "QR Inválido", Toast.LENGTH_LONG).show();
                }
            } else if (resultCode == RESULT_CANCELED) {
                Toast.makeText(this, "No valido", Toast.LENGTH_LONG).show();
                // Handle cancel
            }
        }

    }



    private void marcarUsuarioComoVisitado(){
        usuarioSeleccionado.ponerVerde();
        try {
            String requestString = "SetEstadoAgenda.php?id_agenda=" + usuarioSeleccionado.id_agenda+"&estado="
                    + APIConstantes.ESTADO_VISITADO;
            Log.e("Request", requestString);
            Request request = new Request("GET", requestString);


            Response resp = new RequestHandler().sendRequest(request);
        } catch (Exception e) {
        }
    }


    private String jsonCliente(String id) {

        for (int i = 0; i < clientesDelDia.length(); i++) {
            try {
                JSONObject cliente = clientesDelDia.getJSONObject(i);

                if (cliente.getString("id") == id) {
                    return cliente.toString();
                }
            } catch (JSONException e) {
                return "";
            }
        }

        return "";

    }

}
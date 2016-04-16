package com.tdp2.ordertracker;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.app.FragmentActivity;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;

import org.json.JSONArray;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import GoogleMaps.GMPolyline;
import Model.Request;
import Model.RequestHandler;
import Model.Response;

/**
 * Created by juan on 06/04/16.
 */


public class AgendaActivity extends AppCompatActivity  {

    RecyclerView rv;
    String vendedor;

    private DrawerLayout mDrawerLayout;
    private ListView mDrawerList;

    private String[] mPlanetTitles;

    private CharSequence mTitle;
    private ActionBarDrawerToggle mDrawerToggle;
    private CharSequence mDrawerTitle;

    private String fechaActual;
    private GMPolyline map;

    ArrayList<Agenda> usuarios;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_agenda);

        this.vendedor = ManejadorPersistencia.obtenerVendedor(this);

        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        Date date = new Date();

        fechaActual = dateFormat.format(date).toString();
        usuarios = getUsuariosAgenda();
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);

        map = new GMPolyline(usuarios,mapFragment);

        rv = (RecyclerView)findViewById(R.id.recycler_view_agenda);
        rv.setHasFixedSize(true);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        AgendaAdapter adapter = new AgendaAdapter(usuarios);
        rv.setAdapter(adapter);


        mPlanetTitles = getResources().getStringArray(R.array.dias_array);
        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerList = (ListView) findViewById(R.id.left_drawer);

        mTitle = mDrawerTitle = getTitle();

        Calendar calendar = Calendar.getInstance();
        int day = calendar.get(Calendar.DAY_OF_WEEK);

        switch (day) {
            case Calendar.MONDAY:
                mPlanetTitles[1] += " (HOY)";
            case Calendar.TUESDAY:
                mPlanetTitles[2] += " (HOY)";
            case Calendar.WEDNESDAY:
                mPlanetTitles[3] += " (HOY)";
            case Calendar.THURSDAY:
                mPlanetTitles[4] += " (HOY)";
            case Calendar.FRIDAY:
                mPlanetTitles[5] += " (HOY)";
        }

        mDrawerList.setAdapter(new ArrayAdapter<String>(this, R.layout.drawer_list_item, mPlanetTitles));
        this.setearDrawerListener();
        this.crearDraweToggle();
    }


    private void crearDraweToggle()
    {
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
            }};

        mDrawerLayout.setDrawerListener(mDrawerToggle);
    }

    private void selectItem(int position) {
        mDrawerList.setItemChecked(position, true);
        mDrawerLayout.closeDrawer(mDrawerList);
    }

    public ArrayList<Agenda> getUsuariosAgenda(){
        ArrayList<Agenda> listaUsuarios= new ArrayList<Agenda>();
        Date cDate = new Date();
        String fDate = new SimpleDateFormat("yyyy-MM-dd").format(cDate);

        DateFormat format = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.ENGLISH);

        try {
            Request request = new Request("GET", "GetClientes.php?id="+vendedor+"&fecha="+fechaActual);
            Response resp = new RequestHandler().sendRequest(request);

            for (int i=0;i<resp.getJsonArray().length();i++){
                JSONObject agenda = resp.getJsonArray().getJSONObject(i);
                Date date = format.parse(agenda.getString("fecha"));
                String hora = new SimpleDateFormat("HH:mm").format(date);

                Agenda unaAgenda = new Agenda(agenda.getString("nombre"),agenda.getString("direccion"), hora,agenda.getString("id"));
                listaUsuarios.add(unaAgenda);
            }
        }
        catch(Exception e){}

        return listaUsuarios;
    }


    public void setearDrawerListener()
    {
        mDrawerList.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {

                selectItem(position);
                int diaSeleccionado=0;

                switch (position) {

                    //Fuera de ruta
                    case 0:
                        Intent documentsActivity = new Intent(view.getContext(), ListadoClientes.class);
                        startActivity(documentsActivity);
                        break;
                    case 1:
                        diaSeleccionado = Calendar.MONDAY;
                        break;
                    case 2:
                        diaSeleccionado = Calendar.TUESDAY;
                        break;
                    case 3:
                        diaSeleccionado = Calendar.WEDNESDAY;
                        break;
                    case 4:
                        diaSeleccionado = Calendar.THURSDAY;
                        break;
                    case 5:
                        diaSeleccionado = Calendar.FRIDAY;
                        break;
                }

                Calendar c = Calendar.getInstance();
                c.set(Calendar.DAY_OF_WEEK, diaSeleccionado);
                DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                fechaActual = dateFormat.format(c.getTime()).toString();
                usuarios = getUsuariosAgenda();
                SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                        .findFragmentById(R.id.map);
                map = new GMPolyline(usuarios,mapFragment);
                AgendaAdapter adapter = new AgendaAdapter(usuarios);
                rv.setAdapter(adapter);

            }
        });
    }

}
package com.tdp2.ordertracker;

import android.content.Context;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class DetallesCliente extends AppCompatActivity{

    private JSONObject cliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles_cliente);



        try {
            cliente = new JSONObject(getIntent().getStringExtra("jsonArray"));
            setTitle(cliente.getString("nombre"));
        }catch(Exception e){}


        this.setAdaptador(this.getListaDetalles());

//        MapFragment mapFragment = (MapFragment) getFragmentManager()
//                .findFragmentById(R.id.mapa_fragmento);
//        mapFragment.getMapAsync(this);
    }

    public ArrayList<String> getListaDetalles()
    {
        ArrayList<String> datos = new ArrayList<String>();

        try {

            datos.add("Nombre: " + cliente.getString("nombre"));
            datos.add("Dirección: " + cliente.getString("direccion"));
            datos.add("Razón Social: " + cliente.getString("razon_social"));
            datos.add("Teléfono Móvil: " + cliente.getString("telefono_movil"));
            datos.add("Teléfono Laboral: " + cliente.getString("telefono_laboral"));
            datos.add("E-mail: " + cliente.getString("email"));
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


//    @Override
//    public void onMapReady(GoogleMap googleMap) {
//        googleMap.addMarker(new MarkerOptions().position(new LatLng(0, 0)).title("Marker")); //TODO: cuando este segura de que anda, borrar esto y descomentar lo de abajo

//        String direccionStr = null, nombreCliente = null;
//        try {
//            direccionStr = cliente.getString("direccion");
//            nombreCliente = cliente.getString("nombre");
//        } catch (JSONException e) {
//            e.printStackTrace();
//        }
//        Geocoder geoCoder = new Geocoder(this);
//        List<Address> direcciones = null;
//
//        try {
//            direcciones = geoCoder.getFromLocationName(direccionStr, 1);
//        } catch (IOException e) {
//            e.printStackTrace();
//        }
//        Address direccion = direcciones.get(0);
//        LatLng latLng = new LatLng(direccion.getLatitude(), direccion.getLongitude());
//
//        googleMap.addMarker(new MarkerOptions().position(latLng).title(nombreCliente));
//        googleMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));

//    }

    public void verMapa(View v) {
        Context contexto = v.getContext();
        Intent mapActivity = new Intent(contexto, MapsActivity.class);
        try {
            String direccion = cliente.getString("direccion"), nombre = cliente.getString("nombre");
            mapActivity.putExtra("direccion", direccion);
            mapActivity.putExtra("nombre", nombre);
        } catch(Exception e) {
            return;
        }

        contexto.startActivity(mapActivity);
    }
}

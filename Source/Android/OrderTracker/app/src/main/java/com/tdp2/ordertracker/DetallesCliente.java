package com.tdp2.ordertracker;

import android.content.Context;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class DetallesCliente extends AppCompatActivity implements OnMapReadyCallback{

    private JSONObject cliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles_cliente);

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map_cliente);
        mapFragment.getMapAsync(this);


        try {
            cliente = new JSONObject(getIntent().getStringExtra("jsonArray"));
            setTitle(cliente.getString("nombre"));
        }catch(Exception e){}

        ((TextView) findViewById(R.id.email_drawer)).setText(ManejadorPersistencia.obtenerNombreVendedor(this));


        this.getListaDetalles();

    }

    private void scanQRCode() {
        Intent intent = new Intent("com.google.zxing.client.android.SCAN");
        intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
        startActivityForResult(intent, 0);
    }


    public void onActivityResult(int requestCode, int resultCode, Intent intent) {

        if (requestCode == 0) {
            if (resultCode == RESULT_OK) {
                String contents = intent.getStringExtra("SCAN_RESULT");
                String format = intent.getStringExtra("SCAN_RESULT_FORMAT");
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                // Handle successful scan
            } else if (resultCode == RESULT_CANCELED) {
                // Handle cancel
            }
        }
    }



    public ArrayList<String> getListaDetalles()
    {

        ArrayList<String> datos = new ArrayList<String>();

        try {

            ((TextView)findViewById(R.id.direccion_detalleC)).setText(cliente.getString("direccion"));
            ((TextView)findViewById(R.id.razonSocial_detalleC)).setText("Razón Social: "+cliente.getString("razon_social"));
            ((TextView)findViewById(R.id.telMovil_detalleC)).setText("Tel. Móvil: "+cliente.getString("telefono_movil"));
            ((TextView)findViewById(R.id.telLaboral_detalleC)).setText("Tel. Laboral: "+cliente.getString("telefono_laboral"));
            ((TextView)findViewById(R.id.email_detalleC)).setText(cliente.getString("email"));

        }
        catch(Exception e){}

        return datos;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_detalles_agenda, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle item selection
        switch (item.getItemId()) {
            case R.id.estadisticas:
                Intent estadisticasActivity = new Intent(this, Estadisticas.class);
                startActivity(estadisticasActivity);
                return true;
            case R.id.descuentos:
                Intent descuentosActivity = new Intent(this, Descuentos.class);
                startActivity(descuentosActivity);
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }


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

    @Override
    public void onMapReady(GoogleMap googleMap) {

        // Add a marker in Sydney and move the camera
        Geocoder geoCoder = new Geocoder(this);
        List<Address> direcciones = null;

        try {
            String direccionStr = cliente.getString("direccion"), nombre = cliente.getString("nombre");
            direcciones = geoCoder.getFromLocationName(direccionStr, 1);
            LatLng latLng = new LatLng(-34.55343001093603, -58.47850725000001);
            if (direcciones != null){
                Address direccion = direcciones.get(0);
                latLng = new LatLng(direccion.getLatitude(),  direccion.getLongitude());
            }

            googleMap.addMarker(new MarkerOptions().position(latLng).title(nombre));


            googleMap.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 15.0f));

        } catch (IOException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }



    }

}

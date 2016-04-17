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
import android.widget.TextView;

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

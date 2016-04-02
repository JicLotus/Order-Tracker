package com.tdp2.ordertracker;

import android.location.Address;
import android.location.Geocoder;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONObject;

import java.io.IOException;
import java.util.List;

public class MapsActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    String direccionStr, nombre;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        try {
            direccionStr = getIntent().getStringExtra("direccion");
            nombre = getIntent().getStringExtra("nombre");
        }catch(Exception e){}

    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in Sydney and move the camera
        Geocoder geoCoder = new Geocoder(this);
        List<Address> direcciones = null;

        try {
            direcciones = geoCoder.getFromLocationName(direccionStr, 1);
        } catch (IOException e) {
            e.printStackTrace();
        }
        Address direccion = direcciones.get(0);
        LatLng latLng = new LatLng(direccion.getLatitude(), direccion.getLongitude());

        googleMap.addMarker(new MarkerOptions().position(latLng).title(nombre));
        googleMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));
    }
}

package GoogleMaps;

import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.support.v4.app.FragmentActivity;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;
import com.tdp2.ordertracker.Agenda;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by lotus on 15/04/16.
 */

public class GMPolyline extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private ArrayList<Agenda> agendas;

    public GMPolyline(ArrayList<Agenda> agendasParam,SupportMapFragment mapFragment)
    {
        agendas= agendasParam;
        mapFragment.getMapAsync(this);
    }


    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        LatLng latLng;
        PolylineOptions rectOptions = new PolylineOptions();

        if (agendas.size()>0) {
            // Add a marker in Sydney and move the camera
            Geocoder geoCoder = new Geocoder(this);
            List<Address> direcciones = null;

            for (int i = 0; i < agendas.size(); i++) {

                try {
                    direcciones = geoCoder.getFromLocationName(agendas.get(i).direccion, 1);
                } catch (IOException e) {
                    e.printStackTrace();
                }

                Address direccion = direcciones.get(0);
                latLng = new LatLng(direccion.getLatitude(), direccion.getLongitude());

                googleMap.addMarker(new MarkerOptions().position(latLng).title(agendas.get(i).nombre));
                rectOptions.add(latLng);

            }

            rectOptions.color(Color.RED);
            googleMap.addPolyline(rectOptions);
            googleMap.animateCamera(CameraUpdateFactory.newLatLngZoom(rectOptions.getPoints().get(0), 15.0f));
        }
    }
}

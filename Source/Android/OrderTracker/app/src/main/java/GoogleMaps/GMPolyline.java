package GoogleMaps;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.os.AsyncTask;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.util.Log;
import android.view.Menu;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;
import com.tdp2.ordertracker.Agenda;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;

/**
 * Created by lotus on 15/04/16.
 */

public class GMPolyline extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap map;
    private ArrayList<Agenda> agendas;
    private Context context;
    private ArrayList<LatLng> markerPoints;

    public GMPolyline(ArrayList<Agenda> agendasParam, SupportMapFragment mapFragment, Context context) {
        agendas = agendasParam;
        mapFragment.getMapAsync(this);
        this.context = context;
    }


    @Override
    public void onMapReady(GoogleMap unMap) {

        ArrayList<LatLng> puntos = new ArrayList<LatLng>();

        if (agendas.size()>0) {
            // Add a marker in Sydney and move the camera
            Geocoder geoCoder = new Geocoder(this.context);
            List<Address> direcciones = null;

            for (int i = 0; i < agendas.size(); i++) {

                try {
                    direcciones = geoCoder.getFromLocationName(agendas.get(i).direccion, 1);
                } catch (IOException e) {
                    e.printStackTrace();
                }
                if (direcciones!=null){
                    Address direccion = direcciones.get(0);
                    puntos.add(new LatLng(direccion.getLatitude(), direccion.getLongitude()));
                }

            }
        }

        this.map = unMap;
        markerPoints = new ArrayList<LatLng>();// Enable MyLocation Button in the Map


        if (ActivityCompat.checkSelfPermission(this.context, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this.context, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }

        if (puntos.size()>=2){

            markerPoints.clear();
            map.clear();
            map.setMyLocationEnabled(true);



            LatLng latLng = puntos.remove(0);
            LatLng latLng2 = puntos.remove(puntos.size()-1);

            // Creating MarkerOptions
            MarkerOptions options = new MarkerOptions();
            // Adding new item to the ArrayList

            markerPoints.add(latLng);
            options.position(latLng);
            options.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_GREEN));
            map.addMarker(options);


            options = new MarkerOptions();

            markerPoints.add(latLng2);
            options.position(latLng2);
            options.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED));
            map.addMarker(options);


            for (int i = 0; i < puntos.size(); i++){
                options = new MarkerOptions();
                markerPoints.add(puntos.get(i));
                options.position(puntos.get(i));
                options.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_YELLOW));
                map.addMarker(options);
            }


            LatLng origin = markerPoints.get(0);
            LatLng dest = markerPoints.get(1);


            map.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 15.0f));
            // Getting URL to the Google Directions API
            String url = getDirectionsUrl(origin, dest, puntos);

            Log.i("Request", url);

            DownloadTask downloadTask = new DownloadTask();

            // Start downloading json data from Google Directions API
            downloadTask.execute(url);


        }



    }

    private String getDirectionsUrl(LatLng origin,LatLng dest, ArrayList<LatLng> waypoints){

        // Origin of route
        String str_origin = "origin="+origin.latitude+","+origin.longitude;

        // Destination of route
        String str_dest = "destination="+dest.latitude+","+dest.longitude;

        String waypoint = "waypoints=";

        for (int i = 0; i < waypoints.size(); i++){
            if (waypoints.size()==1){
                waypoint = waypoint + waypoints.get(i).latitude+","+waypoints.get(i).longitude;
            }else if (i==waypoints.size()){
                waypoint = waypoint + waypoints.get(i).latitude+","+waypoints.get(i).longitude;
            }else{
                waypoint = waypoint + waypoints.get(i).latitude+","+waypoints.get(i).longitude+"|";
            }
        }
        // Sensor enabled
        String sensor = "sensor=false";

        // Building the parameters to the web service
        String parameters = str_origin+"&"+str_dest+"&"+waypoint+"&"+sensor;

        // Output format
        String output = "json";

        // Building the url to the web service
        String url = "https://maps.googleapis.com/maps/api/directions/"+output+"?"+parameters;

        return url;
    }
    /** A method to download json data from url */
    private String downloadUrl(String strUrl) throws IOException{
        String data = "";
        InputStream iStream = null;
        HttpURLConnection urlConnection = null;
        try{
            URL url = new URL(strUrl);

            // Creating an http connection to communicate with url
            urlConnection = (HttpURLConnection) url.openConnection();

            // Connecting to url
            urlConnection.connect();

            // Reading data from url
            iStream = urlConnection.getInputStream();

            BufferedReader br = new BufferedReader(new InputStreamReader(iStream));

            StringBuffer sb = new StringBuffer();

            String line = "";
            while( ( line = br.readLine()) != null){
                sb.append(line);
            }

            data = sb.toString();

            br.close();

        }catch(Exception e){
            Log.d("Exception while", e.toString());
        }finally{
            iStream.close();
            urlConnection.disconnect();
        }
        return data;
    }

    // Fetches data from url passed
    private class DownloadTask extends AsyncTask<String, Void, String> {

        // Downloading data in non-ui thread
        @Override
        protected String doInBackground(String... url) {

            // For storing data from web service
            String data = "";

            try{
                // Fetching the data from web service
                data = downloadUrl(url[0]);
            }catch(Exception e){
                Log.d("Background Task",e.toString());
            }
            return data;
        }

        // Executes in UI thread, after the execution of
        // doInBackground()
        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);

            ParserTask parserTask = new ParserTask();

            // Invokes the thread for parsing the JSON data
            parserTask.execute(result);
        }
    }

    /** A class to parse the Google Places in JSON format */
    private class ParserTask extends AsyncTask<String, Integer, List<List<HashMap<String,String>>> >{

        // Parsing the data in non-ui thread
        @Override
        protected List<List<HashMap<String, String>>> doInBackground(String... jsonData) {

            JSONObject jObject;
            List<List<HashMap<String, String>>> routes = null;

            try{
                jObject = new JSONObject(jsonData[0]);
                DirectionsJSONParser parser = new DirectionsJSONParser();

                // Starts parsing data
                routes = parser.parse(jObject);
            }catch(Exception e){
                e.printStackTrace();
            }
            return routes;
        }

        // Executes in UI thread, after the parsing process
        @Override
        protected void onPostExecute(List<List<HashMap<String, String>>> result) {
            ArrayList<LatLng> points = null;
            PolylineOptions lineOptions = null;
            MarkerOptions markerOptions = new MarkerOptions();

            // Traversing through all the routes
            for(int i=0;i<result.size();i++){
                points = new ArrayList<LatLng>();
                lineOptions = new PolylineOptions();

                // Fetching i-th route
                List<HashMap<String, String>> path = result.get(i);

                // Fetching all the points in i-th route
                for(int j=0;j<path.size();j++){
                    HashMap<String,String> point = path.get(j);

                    double lat = Double.parseDouble(point.get("lat"));
                    double lng = Double.parseDouble(point.get("lng"));
                    LatLng position = new LatLng(lat, lng);

                    points.add(position);
                }

                // Adding all the points in the route to LineOptions
                lineOptions.addAll(points);
                lineOptions.width(2);
                lineOptions.color(Color.RED);
            }

            // Drawing polyline in the Google Map for the i-th route
            map.addPolyline(lineOptions);
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        return true;
    }
}

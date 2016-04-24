package com.tdp2.ordertracker;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;

import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.ByteArrayEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.URI;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import Files.FileHandler;
import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class DetallesPedido extends AppCompatActivity {

    JSONArray pedidos;
    PedidoAdapter adapter;
    private RecyclerView rv;
    TextView precioTotal;
    String vendedor;
    JSONObject jsonCliente;
    private FileHandler fileHandler;
    private List<String> firstIdImagenes;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles_pedido);

        try {
            pedidos = new JSONArray(getIntent().getStringExtra("jsonArray"));
            String cliente = getIntent().getStringExtra("cliente");
            jsonCliente = new JSONObject(cliente);
        }catch(Exception e){}

        vendedor = ManejadorPersistencia.obtenerVendedor(this);

        rv = (RecyclerView)findViewById(R.id.recycler_view_productos);

        rv.setHasFixedSize(true);

        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        adapter = new PedidoAdapter(obtenerProductos(),pedidos);
        rv.setAdapter(adapter);
        precioTotal = (TextView) findViewById(R.id.totalPedido);
        precioTotal.setText(calcularPrecioTotal());
        settearDetalleCliente();

    }

    private void settearDetalleCliente(){
        try {
            ((TextView)findViewById(R.id.direccion_detalleC)).setText(jsonCliente.getString("direccion"));
            ((TextView)findViewById(R.id.razonSocial_detalleC)).setText("Razón Social: "+jsonCliente.getString("razon_social"));
        } catch (JSONException e) {
            e.printStackTrace();
        }


    }
    public void downloadImagenesProductos()
    {
        fileHandler = new FileHandler();
        firstIdImagenes = new ArrayList<>();

        for (int i=0;i<pedidos.length();i++) {

            try {
                String idProducto = pedidos.getJSONObject(i).getString("id");
                String idFirstImagen = fileHandler.downloadFile("/mnt/sdcard/Download/", idProducto);

                firstIdImagenes.add(idFirstImagen);

            }catch(Exception e){}

        }
    }



    public List<RecyclerViewItem> obtenerProductos() {

        downloadImagenesProductos();

        List<RecyclerViewItem> items = new ArrayList<>();
        try {
            for (int i = 0; i < pedidos.length(); i++) {
                int idProducto = pedidos.getJSONObject(i).getInt("id");
                int idImagen;
                try {
                    if (firstIdImagenes.get(i)=="") idImagen=0;
                    else idImagen = Integer.parseInt(firstIdImagenes.get(i));
                }catch(Exception e)
                {
                    idImagen = 0;
                }

                items.add(new RecyclerViewItem(pedidos.getJSONObject(i).getString("nombre"),"$ " + pedidos.getJSONObject(i).getString("precio"),idImagen));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }


    public String calcularPrecioTotal()
    {
        int precioTotal=0,precio=0,cantidad=0,precioParcial=0;

        for(int i=0;i<pedidos.length();i++) {

            try {
                JSONObject producto = pedidos.getJSONObject(i);
                cantidad = Integer.parseInt(producto.getString("cantidad"));
                precio = Integer.parseInt(producto.getString("precio"));
                precioParcial = precio*cantidad;
                precioTotal+=precioParcial;
            }
            catch(Exception e){}
        }

        return "$" +Integer.toString(precioTotal);
    }

    /*
            int TIMEOUT_MILLISEC = 10000;  // = 10 seconds
            HttpParams httpParams = new BasicHttpParams();
            HttpConnectionParams.setConnectionTimeout(httpParams, TIMEOUT_MILLISEC);
            HttpConnectionParams.setSoTimeout(httpParams, TIMEOUT_MILLISEC);
            HttpClient client = new DefaultHttpClient(httpParams);

            HttpPost request = new HttpPost("http://10.0.2.2:8080/");
            request.setEntity(new ByteArrayEntity(
                    requestString.toString().getBytes("UTF8")));
            HttpResponse response = client.execute(request);
*/


    public void confirmarPedido(View view)
    {
        try {
            //pedidos.getJSONObject(i);

            String requestString = "SetPedido.php?id_usuario="+vendedor+"&id_cliente="+jsonCliente.getString("id")+"&productos="+pedidos.toString();


            JSONObject object = new JSONObject();
            object.put("pedidos", pedidos);
            object.put("id_usuario", vendedor);
            object.put("id_cliente", jsonCliente.getString("id"));

            Request request = new Request("POST", "SetPedido.php/",object);

            Response resp = new RequestHandler().sendRequest(request);

            if (resp.getStatus()){
                mostrarDialogOK(view.getContext());
            }else{
                mostrarDialogError(view.getContext());
            }

        }
        catch(Exception e){
            mostrarDialogError(view.getContext());

        }

        mostrarDialogOK(view.getContext());

    }

    private void mostrarDialogOK(final Context contexto){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Su pedido ha sido realizado correctamente");
        builder.setMessage("Que tenga un buen día!");
        builder.setIcon(R.drawable.button_ok);
        builder.setCancelable(true);

        final AlertDialog closedialog= builder.create();

        closedialog.show();

        final Timer timer2 = new Timer();
        timer2.schedule(new TimerTask() {
            public void run() {
                closedialog.dismiss();
                Intent documentsActivity = new Intent(contexto, AgendaActivity.class);
                startActivity(documentsActivity);

                timer2.cancel(); //this will cancel the timer of the system
            }
        }, 3000); // the timer will count 5 seconds....
    }

    private void mostrarDialogError(final Context contexto){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Su pedido no se ha podido concretar");
        builder.setMessage("Intente nuevamente");
        builder.setIcon(R.drawable.button_error);
        builder.setCancelable(true);

        final AlertDialog closedialog= builder.create();

        closedialog.show();

        final Timer timer2 = new Timer();
        timer2.schedule(new TimerTask() {
            public void run() {
                closedialog.dismiss();
                timer2.cancel(); //this will cancel the timer of the system
            }
        }, 3000); // the timer will count 5 seconds....
    }

}

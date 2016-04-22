package com.tdp2.ordertracker;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

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

    public void confirmarPedido(View view)
    {
        for(int i=0;i<pedidos.length();i++) {

            try {
                JSONObject producto = pedidos.getJSONObject(i);
                String cantidad = producto.getString("cantidad");
                String precio = producto.getString("precio");
                String id_producto = producto.getString("id");

                Request request = new Request("GET", "SetPedido.php?id_usuario="+vendedor+"&id_cliente="+jsonCliente.getString("id")+"&id_producto="+id_producto+"&cant="+cantidad+"&precio="+precio);
                Response resp = new RequestHandler().sendRequest(request);

            }
            catch(Exception e){}
        }
        Intent documentsActivity = new Intent(view.getContext(), AgendaActivity.class);
        startActivity(documentsActivity);

    }



}

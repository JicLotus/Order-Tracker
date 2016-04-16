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
import org.json.JSONObject;

import java.util.ArrayList;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class DetallesPedido extends AppCompatActivity {

    JSONArray pedidos;
    PedidoAdapter adapter;
    private RecyclerView rv;
    TextView precioTotal;
    String vendedor;
    String cliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles_pedido);

        try {
            pedidos = new JSONArray(getIntent().getStringExtra("jsonArray"));
            cliente = getIntent().getStringExtra("cliente");
        }catch(Exception e){}

        vendedor = ManejadorPersistencia.obtenerVendedor(this);

        rv = (RecyclerView)findViewById(R.id.recycler_view_productos);

        rv.setHasFixedSize(true);

        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        adapter = new PedidoAdapter(pedidos);
        rv.setAdapter(adapter);
        precioTotal = (TextView) findViewById(R.id.totalPedido);
        precioTotal.setText(calcularPrecioTotal());

    }



    public String calcularPrecioTotal()
    {
        int precioTotal=0,precio=0,cantidad=0,precioParcial=0;

        for(int i=0;i<pedidos.length();i++) {

            try {
                JSONObject producto = pedidos.getJSONObject(i);
                cantidad = Integer.parseInt(producto.getString("cant"));
                precio = Integer.parseInt(producto.getString("precio"));
                precioParcial = precio*cantidad;
                precioTotal+=precioParcial;
            }
            catch(Exception e){}
        }

        return "Total: $" +Integer.toString(precioTotal);
    }

    public void confirmarPedido(View view)
    {
        for(int i=0;i<pedidos.length();i++) {

            try {
                JSONObject producto = pedidos.getJSONObject(i);
                String cantidad = producto.getString("cant");
                String precio = producto.getString("precio");
                String id_producto = producto.getString("id_producto");

                Request request = new Request("GET", "SetPedido.php?id_usuario="+vendedor+"&id_cliente="+cliente+"&id_producto="+id_producto+"&cant="+cantidad+"&precio="+precio);
                Response resp = new RequestHandler().sendRequest(request);

            }
            catch(Exception e){}
        }
        Intent documentsActivity = new Intent(view.getContext(), AgendaActivity.class);
        startActivity(documentsActivity);

    }


}

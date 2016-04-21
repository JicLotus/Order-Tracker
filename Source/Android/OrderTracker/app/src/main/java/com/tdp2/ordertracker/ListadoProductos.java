package com.tdp2.ordertracker;


import android.app.Activity;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;

import android.view.View;
import android.widget.NumberPicker;




import org.json.JSONArray;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.List;

import Files.FileHandler;
import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class ListadoProductos extends AppCompatActivity implements NumberPicker.OnValueChangeListener{
    private RecyclerView rv;
    private JSONArray productos;
    private FileHandler fileHandler;
    private List<String> firstIdImagenes;

    ProductoAdapter adapter;
    private String jsonCliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_listado_productos);

        try {
            jsonCliente = getIntent().getStringExtra("cliente");
        }catch(Exception e){}


        this.pedirProductos();

        rv = (RecyclerView)findViewById(R.id.recycler_view_productos);

        rv.setHasFixedSize(true);

        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        adapter = new ProductoAdapter(obtenerProductos(), DetallesProducto.class, this);
        adapter.setJsonArray(productos);
        rv.setAdapter(adapter);
    }


    private void pedirProductos()
    {
        Request request = new Request("GET", "GetProductos.php");
        Response resp = new RequestHandler().sendRequest(request);

        if (resp.getStatus())
            productos = resp.getJsonArray();
        else
            productos = new JSONArray();

    }



    public void downloadImagenesProductos()
    {
        fileHandler = new FileHandler();
        firstIdImagenes = new ArrayList<>();

        for (int i=0;i<productos.length();i++) {

            try {
                String idProducto = productos.getJSONObject(i).getString("id");
                String idFirstImagen = fileHandler.downloadFile("/mnt/sdcard/Download/", idProducto);

                firstIdImagenes.add(idFirstImagen);

            }catch(Exception e){}

        }
    }


    public List<RecyclerViewItem> obtenerProductos() {

        downloadImagenesProductos();

        List<RecyclerViewItem> items = new ArrayList<>();
        try {
            for (int i = 0; i < productos.length(); i++) {
                int idProducto = productos.getJSONObject(i).getInt("id");
                int idImagen;
                try {
                    if (firstIdImagenes.get(i)=="") idImagen=0;
                    else idImagen = Integer.parseInt(firstIdImagenes.get(i));
                }catch(Exception e)
                {
                    idImagen = 0;
                }

                items.add(new RecyclerViewItem(productos.getJSONObject(i).getString("nombre"),"$ " + productos.getJSONObject(i).getString("precio"),idImagen));
            }
        }
        catch(Exception e)
        {
            return null;
        }

        return items;
    }

    @Override
    public void onValueChange(NumberPicker picker, int oldVal, int newVal) {

    }

    public void finalizarPedido(View v) {

        Hashtable<Integer, JSONObject> pedidos = adapter.getPedidos();
        JSONArray productos = new JSONArray();

        Enumeration<Integer> enumKey = pedidos.keys();

        while(enumKey.hasMoreElements()) {
            Integer key = enumKey.nextElement();
            JSONObject producto = pedidos.get(key);
            productos.put(producto);
        }

        Intent documentsActivity = new Intent(this, DetallesPedido.class);
        try {
            documentsActivity.putExtra("jsonArray", productos.toString());
            documentsActivity.putExtra("cliente", jsonCliente);
        }
        catch(Exception e)
        {   return;
        }

        startActivity(documentsActivity);
    }

    @Override
    public void onBackPressed() {

        new AlertDialog.Builder(this)
                .setTitle("¿Desea Cancelar su visita?")
                .setMessage("Presiona Si para finalizar su visita")
                .setPositiveButton("SI", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }
                })
                .setNegativeButton("NO", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        //no hace nada
                    }
                })
                .setIcon(android.R.drawable.ic_dialog_alert)
                .show();
    }


}

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

import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.NumberPicker;
import android.widget.TextView;


import org.json.JSONArray;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import Files.FileHandler;
import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class ListadoProductos extends AppCompatActivity implements NumberPicker.OnValueChangeListener{
    private RecyclerView rv;
    private JSONArray productos;
    private FileHandler fileHandler;
    private List<String> firstIdImagenes;
    JSONArray descuentos;

    ProductoAdapter adapter;
    private String jsonCliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_listado_productos);

        try {
            jsonCliente = getIntent().getStringExtra("cliente");
        }catch(Exception e){}


        ((TextView) findViewById(R.id.email_drawer)).setText(ManejadorPersistencia.obtenerNombreVendedor(this));

        this.pedirProductos();
        this.pedirDescuentos();
        this.obtenerDescuentos();
        this.aplicarDescuentos();


        rv = (RecyclerView)findViewById(R.id.recycler_view_productos);

        rv.setHasFixedSize(true);

        LinearLayoutManager llm = new LinearLayoutManager(this);
        rv.setLayoutManager(llm);

        adapter = new ProductoAdapter(obtenerProductos(), DetallesProducto.class, this);
        adapter.setJsonArray(productos);

        rv.setAdapter(adapter);

    }
    private void obtenerDescuentos(){
        String json = ManejadorPersistencia.obtenerDescuentos(this);

        if (json ==  null){
            descuentos = new JSONArray();
        }else{
            try {
                descuentos = new JSONArray(json);
            } catch (JSONException e) {
                e.printStackTrace();
                descuentos = new JSONArray();
            }
        }
    }

    @Override
    protected void onResume(){
        super.onResume();
        this.obtenerDescuentos();
        this.aplicarDescuentos();
    }



    private void aplicarDescuentos(){

        double porcentaje;
        double precio;
        String marcaProducto, marcaDescuento;
        String categoriaProducto, categoriaDescuento;

        for (int i=0;i<descuentos.length();i++) {

            try {
                int cantidadDescuento = Integer.parseInt(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_CANTIDAD));
                porcentaje = Double.parseDouble(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_PORCENTAJE));
                marcaDescuento = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_MARCA);
                categoriaDescuento = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_CATEGORIA);

                for(int j=0;j<productos.length();j++) {
                    try {
                        JSONObject producto = productos.getJSONObject(j);
                        precio = Double.parseDouble(producto.getString(APIConstantes.PRODUCTO_PRECIO));
                        marcaProducto = producto.getString(APIConstantes.PRODUCTO_MARCA);
                        categoriaProducto = producto.getString(APIConstantes.PRODUCTO_CATEGORIA);

                        if (marcaProducto!=null && marcaProducto.equals(marcaDescuento)){
                            double precio_final = Double.parseDouble(producto.getString(APIConstantes.PRODUCTO_PRECIO_FINAL));
                            if (precio*porcentaje < precio_final)
                                producto.put(APIConstantes.PRODUCTO_PRECIO_FINAL, String.valueOf(precio*porcentaje));
                        }
                        if (categoriaProducto!=null && categoriaProducto.equals(categoriaDescuento)){
                            double precio_final = Double.parseDouble(producto.getString(APIConstantes.PRODUCTO_PRECIO_FINAL));
                            if (precio*porcentaje < precio_final)
                                producto.put(APIConstantes.PRODUCTO_PRECIO_FINAL, String.valueOf(precio*porcentaje));
                        }

                    }
                    catch(Exception e){}
                }

            }catch(Exception e){}

        }

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
                //showHelp();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
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

    private void mostrarAlertaDeProductosNoSeleccionados(){
        new AlertDialog.Builder(this)
                .setTitle("No ha seleccionado ningun producto")
                .setMessage("¿Desea finalizar su visita?")
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


    private void pedirDescuentos()
    {
        Request request = new Request("GET", "GetDescuentos.php");
        Response resp = new RequestHandler().sendRequest(request);

        if (resp.getStatus())
            ManejadorPersistencia.persistirDescuentos(this,resp.getJsonArray().toString());
        else{
            ManejadorPersistencia.persistirDescuentos(this, new JSONArray().toString());
        }

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

                items.add(new RecyclerViewItem(productos.getJSONObject(i).getString(APIConstantes.PRODUCTO_NOMBRE),"$ " + productos.getJSONObject(i).getString(APIConstantes.PRODUCTO_PRECIO),idImagen,
                        productos.getJSONObject(i).getString(APIConstantes.PRODUCTO_PRECIO_FINAL)));
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

        if (productos.length()>0){

            Intent documentsActivity = new Intent(this, DetallesPedido.class);
            try {
                documentsActivity.putExtra("jsonArray", productos.toString());
                documentsActivity.putExtra("cliente", jsonCliente);
            }
            catch(Exception e)
            {   return;
            }

            startActivity(documentsActivity);

        }else{
            mostrarAlertaDeProductosNoSeleccionados();
        }
    }

    @Override
    public void onBackPressed() {

        new AlertDialog.Builder(this)
                .setTitle("Está a punto de perder su pedido")
                .setMessage("¿Desea cancelar el pedido?")
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

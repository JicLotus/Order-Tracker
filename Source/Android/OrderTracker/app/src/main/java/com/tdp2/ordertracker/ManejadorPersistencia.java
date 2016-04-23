package com.tdp2.ordertracker;

import android.content.Context;
import android.content.SharedPreferences;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by juan on 10/04/16.
 */


public class ManejadorPersistencia {

    public static void persistirVendedor(Context context, String valor) {
        SharedPreferences settings = context.getSharedPreferences(APIConstantes.PERSISTENCIA_DATOS, 0);
        SharedPreferences.Editor editor = settings.edit();
        editor.putString(APIConstantes.PERSISTENCIA_VENDEDOR, valor);
        editor.commit();
    }

    public static String obtenerVendedor(Context context) {
        SharedPreferences settings = context.getSharedPreferences(APIConstantes.PERSISTENCIA_DATOS, 0);
        return settings.getString(APIConstantes.PERSISTENCIA_VENDEDOR, null);
    }

    public static String obtenerProductosDelCarro(Context context) {
        SharedPreferences settings = context.getSharedPreferences(APIConstantes.PERSISTENCIA_DATOS, 0);
        return settings.getString(APIConstantes.PERSISTENCIA_CARRO, null);
    }

    private static void persistirProductos(Context context, String productos){
        SharedPreferences settings = context.getSharedPreferences(APIConstantes.PERSISTENCIA_DATOS, 0);
        SharedPreferences.Editor editor = settings.edit();
        editor.putString(APIConstantes.PERSISTENCIA_CARRO, productos);
        editor.commit();
    }

    public static void agregarAlCarro(Context context, String prod, int cantidad){
        try {
            JSONObject producto = new JSONObject(prod);
            producto.put(APIConstantes.PRODUCTO_CANTIDAD, cantidad);
            JSONArray carro;
            String productosDelCarro = obtenerProductosDelCarro(context);
            if (productosDelCarro != null){
                carro = new JSONArray(productosDelCarro);
            }else{
                carro = new JSONArray();
            }
            carro.put(producto);
            persistirProductos(context, carro.toString());
            Log.e("Resultado: ", carro.toString());

        } catch (JSONException e) {
            e.printStackTrace();
        }
        //persistirlo al carro
    }

    public static void persistirCliente(Context context, String id, String nombre, String direccion, String hora){
        SharedPreferences settings = context.getSharedPreferences(APIConstantes.PERSISTENCIA_DATOS, 0);
        SharedPreferences.Editor editor = settings.edit();

        editor.commit();

    }



}

package com.tdp2.ordertracker;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by juan on 10/04/16.
 */
public class ManejadorJSONProductos {



    public static String obtenerId(String unProducto){

        JSONObject producto;
        try {
            producto = new JSONObject(unProducto);
            return producto.getString(APIConstantes.PRODUCTO_ID);

        } catch (JSONException e) {
            e.printStackTrace();
            return null;
        }

    }
    public static int obtenerStock(String unProducto){

        JSONObject producto;
        try {
            producto = new JSONObject(unProducto);
            return producto.getInt(APIConstantes.PRODUCTO_STOCK);

        } catch (JSONException e) {
            e.printStackTrace();
            return 0;
        }

    }
}

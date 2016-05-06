package com.tdp2.ordertracker;


import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;

import java.io.File;
import java.io.FileInputStream;
import java.util.ArrayList;
import java.util.List;

import Files.FileHandler;

/**
 * Created by lotus on 15/04/16.
 */


public class PedidoAdapter extends RecyclerView.Adapter<PedidoAdapter.ViewHolder> {

    JSONArray pedidos;
    private FileHandler fileHandler;
    private List<String> firstIdImagenes;
    private List<RecyclerViewItem> datos;

    public PedidoAdapter(List<RecyclerViewItem> datos, JSONArray pedidosParam) {


        pedidos = pedidosParam;
        this.datos = datos;
    }


    @Override
    public PedidoAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.recycler_view_pedido, parent, false);

        ViewHolder viewHolder = new ViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(PedidoAdapter.ViewHolder holder, int position)
    {
        RecyclerViewItem datoActual = datos.get(position);

        try {
            holder.titulo.setText(pedidos.getJSONObject(position).getString("nombre"));
            holder.precio.setText("$ " + pedidos.getJSONObject(position).getString(APIConstantes.PRODUCTO_PRECIO_FINAL));
            holder.cantidad.setText("Cantidad: " + pedidos.getJSONObject(position).getString("cantidad"));

            int cant = Integer.parseInt(pedidos.getJSONObject(position).getString("cantidad"))*
                        Integer.parseInt(pedidos.getJSONObject(position).getString(APIConstantes.PRODUCTO_PRECIO_FINAL));
            holder.subtotal.setText("Subtotal: $"+String.valueOf(cant));
        }catch(Exception e){}


    }

    @Override
    public int getItemCount() {
        return pedidos.length();
    }

    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
        TextView titulo;
        TextView precio;
        TextView cantidad;
        TextView subtotal;
       // ImageView icono;

        public ViewHolder(View view) {
            super(view);
            titulo = (TextView) itemView.findViewById(R.id.nombreProducto);
            precio = (TextView) itemView.findViewById(R.id.precio);
            subtotal = (TextView) itemView.findViewById(R.id.subtotal);
            cantidad = (TextView) itemView.findViewById(R.id.cantidad);
        }

        @Override
        public void onClick(View v) {

        }
    }

}

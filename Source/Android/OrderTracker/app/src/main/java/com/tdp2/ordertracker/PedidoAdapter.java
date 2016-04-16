package com.tdp2.ordertracker;


import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import org.json.JSONArray;

/**
 * Created by lotus on 15/04/16.
 */


public class PedidoAdapter extends RecyclerView.Adapter<PedidoAdapter.ViewHolder> {

    JSONArray pedidos;

    public PedidoAdapter(JSONArray pedidosParam) {
        pedidos = pedidosParam;
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
        try {
            holder.titulo.setText(pedidos.getJSONObject(position).getString("titulo"));
            holder.precio.setText("$ " + pedidos.getJSONObject(position).getString("precio"));
            holder.cantidad.setText("x " + pedidos.getJSONObject(position).getString("cant"));
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

        public ViewHolder(View view) {
            super(view);
            titulo = (TextView) itemView.findViewById(R.id.nombreProducto);
            precio = (TextView) itemView.findViewById(R.id.precio);
            cantidad = (TextView) itemView.findViewById(R.id.cantidad);
        }

        @Override
        public void onClick(View v) {

        }
    }

}

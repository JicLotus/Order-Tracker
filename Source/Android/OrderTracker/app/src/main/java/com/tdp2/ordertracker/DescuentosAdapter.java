package com.tdp2.ordertracker;

import android.content.Context;
import android.content.Intent;
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
import java.util.List;

public class DescuentosAdapter extends RecyclerView.Adapter<DescuentosAdapter.DescuentosViewHolder> {
    private List<DescuentosItem> datos;
    private JSONArray jsonArray;

    public DescuentosAdapter(List<DescuentosItem> descuentosItems) {
        this.datos = descuentosItems;
    }

    public void setJsonArray(JSONArray descuentos) {
        jsonArray = descuentos;
    }

    @Override
    public DescuentosAdapter.DescuentosViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.recycler_view_descuentos, parent, false);

        DescuentosViewHolder viewHolder = new DescuentosViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(DescuentosViewHolder holder, int position) {
        DescuentosItem datoActual = datos.get(position);
        holder.posicion = position;
        holder.descripcion.setText(datoActual.descripcion);
    }

    @Override
    public int getItemCount() {
        return datos.size();
    }

    public class DescuentosViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
        TextView descripcion;
        int posicion;

        public DescuentosViewHolder(View view) {
            super(view);
            descripcion = (TextView) itemView.findViewById(R.id.descripcion_descuento);
        }

        @Override
        public void onClick(View v) {

        }
    }
}

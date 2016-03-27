package com.tdp2.ordertracker;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.Collections;
import java.util.List;


public class RecyclerViewAdapter extends RecyclerView.Adapter<RecyclerViewAdapter.ViewHolder> {
    private List<InformacionItem> datos;

    // Provide a suitable constructor (depends on the kind of dataset)
    public RecyclerViewAdapter(List<InformacionItem> datos) {
        this.datos = datos;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public RecyclerViewAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.recycler_view_item, parent, false);

        ViewHolder viewHolder = new ViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        InformacionItem datoActual = datos.get(position);
        holder.titulo.setText(datoActual.titulo);
        holder.icono.setImageResource(datoActual.idIcono);
        holder.descripcion.setText(datoActual.descripcion);
    }

    @Override
    public int getItemCount() {
        return datos.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        ImageView icono;
        TextView titulo;
        TextView descripcion;

        public ViewHolder(View view) {
            super(view);
            icono = (ImageView) itemView.findViewById(R.id.iconoItem);
            titulo = (TextView) itemView.findViewById(R.id.tituloItem);
            descripcion = (TextView) itemView.findViewById(R.id.descripcionItem);
        }
    }
}
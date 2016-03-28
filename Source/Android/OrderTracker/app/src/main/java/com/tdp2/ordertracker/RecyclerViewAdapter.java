package com.tdp2.ordertracker;

import android.content.Context;
import android.location.GpsStatus;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

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
    public void onBindViewHolder(ViewHolder holder, final int position) {
        InformacionItem datoActual = datos.get(position);
        holder.titulo.setText(datoActual.titulo);
        holder.icono.setImageResource(datoActual.idIcono);
        holder.descripcion.setText(datoActual.descripcion);

        View.OnClickListener listener = new View.OnClickListener() {
            @Override
            public void onClick(View v){
                //TODO: cambiar a detalle
                Toast.makeText(v.getContext(), "Click en el item "+position, Toast.LENGTH_SHORT).show();
            }
        };
        holder.titulo.setOnClickListener(listener);
        holder.icono.setOnClickListener(listener);
        holder.descripcion.setOnClickListener(listener);

        holder.titulo.setTag(holder);
        holder.icono.setTag(holder);
        holder.descripcion.setTag(holder);
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
package com.tdp2.ordertracker;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.List;


public class RecyclerViewAdapter extends RecyclerView.Adapter<RecyclerViewAdapter.ViewHolder> {
    private List<RecyclerViewItem> datos;

    // Provide a suitable constructor (depends on the kind of dataset)
    public RecyclerViewAdapter(List<RecyclerViewItem> datos) {
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
        RecyclerViewItem datoActual = datos.get(position);
        holder.titulo.setText(datoActual.titulo);
        holder.icono.setImageResource(datoActual.idIcono);
        holder.descripcion.setText(datoActual.descripcion);
    }

    @Override
    public int getItemCount() {
        return datos.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
        ImageView icono;
        TextView titulo;
        TextView descripcion;

        public ViewHolder(View view) {
            super(view);
            icono = (ImageView) itemView.findViewById(R.id.iconoItem);
            titulo = (TextView) itemView.findViewById(R.id.tituloItem);
            descripcion = (TextView) itemView.findViewById(R.id.descripcionItem);

            icono.setOnClickListener(this);
            titulo.setOnClickListener(this);
            descripcion.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {
            //TODO: cambiar a detalle
            Toast.makeText(v.getContext(), "Click en el item "+getAdapterPosition(), Toast.LENGTH_SHORT).show();
        }
    }
}
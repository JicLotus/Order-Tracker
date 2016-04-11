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


public class ClienteAdapter extends RecyclerView.Adapter<ClienteAdapter.ViewHolder> {
    private List<RecyclerViewItem> datos;
    private JSONArray jsonArray;
    Class claseOnClick;

    // Provide a suitable constructor (depends on the kind of dataset)
    public ClienteAdapter(List<RecyclerViewItem> datos, Class claseOnClick) {
        this.datos = datos;
        this.claseOnClick = claseOnClick;
    }

    public void setJsonArray(JSONArray jsonArrayParam)
    {
        jsonArray = jsonArrayParam;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public ClienteAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.recycler_view_cliente, parent, false);

        ViewHolder viewHolder = new ViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        RecyclerViewItem datoActual = datos.get(position);
        holder.posicion = position;
        holder.nombre.setText(datoActual.titulo);

        try {
            File f = new File("/mnt/sdcard/Download/", datoActual.idIcono + ".jpg");
            Bitmap b = BitmapFactory.decodeStream(new FileInputStream(f));
            holder.imagen.setImageBitmap(b);

        }
        catch(Exception e){
            holder.imagen.setImageResource(R.drawable.perfil_vacio);
        }


        holder.direccion.setText(datoActual.descripcion);
    }

    @Override
    public int getItemCount() {
        return datos.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
        ImageView imagen;
        TextView nombre;
        TextView direccion;
        int posicion;

        public ViewHolder(View view) {
            super(view);
            imagen = (ImageView) itemView.findViewById(R.id.imagenCliente);
            nombre = (TextView) itemView.findViewById(R.id.nombreCliente);
            direccion = (TextView) itemView.findViewById(R.id.direccionCliente);

            imagen.setOnClickListener(this);
            nombre.setOnClickListener(this);
            direccion.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {
            if (claseOnClick == null) return;

            Context contexto = v.getContext();
            Intent documentsActivity = new Intent(contexto, claseOnClick);
            try {
                documentsActivity.putExtra("jsonArray", jsonArray.getJSONObject(posicion).toString());
            }
            catch(Exception e)
            {   return;
            }

            contexto.startActivity(documentsActivity);
        }
    }
}
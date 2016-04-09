package com.tdp2.ordertracker;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;

import java.io.File;
import java.io.FileInputStream;
import java.util.List;


public class RecyclerViewAdapter extends RecyclerView.Adapter<RecyclerViewAdapter.ViewHolder> {
    private List<RecyclerViewItem> datos;
    private JSONArray jsonArray;
    Class claseOnClick;

    // Provide a suitable constructor (depends on the kind of dataset)
    public RecyclerViewAdapter(List<RecyclerViewItem> datos, Class claseOnClick) {
        this.datos = datos;
        this.claseOnClick = claseOnClick;
    }

    public void setJsonArray(JSONArray jsonArrayParam)
    {
        jsonArray = jsonArrayParam;
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
        holder.posicion = position;
        holder.titulo.setText(datoActual.titulo);

        try {
            File f = new File("/mnt/sdcard/Download/", datoActual.idIcono + ".jpg");
            Bitmap b = BitmapFactory.decodeStream(new FileInputStream(f));
            holder.icono.setImageBitmap(b);

        }
        catch(Exception e){
            holder.icono.setImageResource(R.drawable.perfil_vacio);
        }


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
        int posicion;

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
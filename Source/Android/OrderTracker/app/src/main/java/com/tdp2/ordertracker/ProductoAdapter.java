package com.tdp2.ordertracker;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.NumberPicker;
import android.widget.TextView;

import org.json.JSONArray;

import java.io.File;
import java.io.FileInputStream;
import java.util.List;

/**
 * Created by juan on 10/04/16.
 */
public class ProductoAdapter extends RecyclerView.Adapter<ProductoAdapter.ViewHolder>{

    private List<RecyclerViewItem> datos;
    private JSONArray jsonArray;
    Context contexto;
    Class claseOnClick;


    // Provide a suitable constructor (depends on the kind of dataset)
    public ProductoAdapter(List<RecyclerViewItem> datos, Class claseOnClick, Context context) {
        this.datos = datos;
        this.contexto = context;
        this.claseOnClick = claseOnClick;
    }

    public void setJsonArray(JSONArray jsonArrayParam)
    {
        jsonArray = jsonArrayParam;
    }

    // Create new views (invoked by the layout manager)
    @Override
    public ProductoAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
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
        FloatingActionButton agregarAlCarro;
        int posicion;

        public ViewHolder(View view) {
            super(view);
            icono = (ImageView) itemView.findViewById(R.id.imagenProducto);
            titulo = (TextView) itemView.findViewById(R.id.nombreProducto);
            descripcion = (TextView) itemView.findViewById(R.id.caracteristicasProductos);
            agregarAlCarro = (FloatingActionButton) itemView.findViewById(R.id.iconoCarro);
            this.accionCarroDeCompras();

            icono.setOnClickListener(this);

//            agregarAlCarro.setOnClickListener(this);
//            titulo.setOnClickListener(this);
 //           descripcion.setOnClickListener(this);
        }

        private void accionCarroDeCompras(){

            agregarAlCarro.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Context contexto = v.getContext();
                    Intent documentsActivity = new Intent(contexto, NumberPickerActivity.class);
                    try {
                        documentsActivity.putExtra("jsonArray", jsonArray.getJSONObject(posicion).toString());
                    }
                    catch(Exception e)
                    {   return;
                    }

                    contexto.startActivity(documentsActivity);
                }
            });
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

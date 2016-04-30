package com.tdp2.ordertracker;


import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.NumberPicker;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileInputStream;
import java.util.Hashtable;
import java.util.List;


public class ProductoAdapter extends RecyclerView.Adapter<ProductoAdapter.ViewHolder>{

    private List<RecyclerViewItem> datos;
    private JSONArray jsonArray;
    Hashtable<Integer, JSONObject> pedidos;

    Context contexto;
    Class claseOnClick;

    public ProductoAdapter(List<RecyclerViewItem> datos, Class claseOnClick, Context context) {
        this.datos = datos;
        this.contexto = context;
        this.claseOnClick = claseOnClick;
        pedidos = new Hashtable<Integer, JSONObject>();
    }

    public Hashtable<Integer, JSONObject> getPedidos()
    {
        return pedidos;
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

        try {
            holder.itemId = jsonArray.getJSONObject(position).getInt("id");
        }catch(Exception e){}

        try {
            holder.np.setMaxValue(jsonArray.getJSONObject(position).getInt("stock"));
            holder.np.setWrapSelectorWheel(false);

        }catch(Exception e){}

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

        try {

            holder.precio = jsonArray.getJSONObject(position).getInt("precio");
        }
        catch(Exception e)
        {
        }

    }

    @Override
    public int getItemCount() {
        return datos.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
        ImageView icono;
        TextView titulo;
        TextView descripcion;
        TextView subtotal;
        int posicion;
        int itemId;
        int precio;

        NumberPicker np;

        public ViewHolder(View view) {
            super(view);


            icono = (ImageView) itemView.findViewById(R.id.imagenProducto);
            titulo = (TextView) itemView.findViewById(R.id.nombreProducto);
            descripcion = (TextView) itemView.findViewById(R.id.caracteristicasProductos);
            subtotal = (TextView)itemView.findViewById(R.id.subtotal);
            subtotal.setText("");

            np = (NumberPicker) itemView.findViewById(R.id.nPicker);

            np.setMinValue(0);
            np.setValue(0);
            np.setWrapSelectorWheel(false);

            np.setOnValueChangedListener(new NumberPicker.OnValueChangeListener() {
                @Override
                public void onValueChange(NumberPicker picker, int oldVal, int newVal) {
                    if (newVal == 0){
                        pedidos.remove(itemId);
                        subtotal.setText("");
                    } else {
                        try {
                            JSONObject producto = new JSONObject();
                            producto.put("id", itemId);
                            producto.put("cantidad", newVal);
                            producto.put("nombre", titulo.getText().toString());
                            producto.put("precio",precio);
                            pedidos.put(itemId, producto);

                            subtotal.setText("Subtotal: $"+String.valueOf(precio*newVal));
                        } catch (JSONException e) {
                        }

                    }
                }
            });

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

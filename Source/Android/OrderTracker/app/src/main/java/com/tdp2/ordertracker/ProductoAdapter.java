package com.tdp2.ordertracker;


import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Paint;
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
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileInputStream;
import java.util.Hashtable;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;


public class ProductoAdapter extends RecyclerView.Adapter<ProductoAdapter.ViewHolder>{

    private List<RecyclerViewItem> datos;
    private JSONArray jsonArray;
    Hashtable<Integer, JSONObject> pedidos;
    Timer t;
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
        int valorNP = 0;

        try {
            holder.np.setDisplayedValues(null);
            holder.np.setMinValue(0);
            holder.np.setMaxValue(jsonArray.getJSONObject(position).getInt("stock"));
//            holder.np.setWrapSelectorWheel(false);

//
//              holder.np.setValue()

            if (pedidos.get(holder.itemId)!= null){
                valorNP = pedidos.get(holder.itemId).getInt(APIConstantes.PRODUCTO_CANTIDAD);
            }
            holder.np.setValue(valorNP);

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

            holder.precio = jsonArray.getJSONObject(position).getDouble(APIConstantes.PRODUCTO_PRECIO);
            holder.precio_final = jsonArray.getJSONObject(position).getDouble(APIConstantes.PRODUCTO_PRECIO_FINAL);
            holder.marca = jsonArray.getJSONObject(position).getString(APIConstantes.PRODUCTO_MARCA);
            holder.leyendaDescuento.setText(jsonArray.getJSONObject(position).getString("leyenda"));
            if (valorNP==0){
                holder.subtotal.setText("");
            }else{
                holder.subtotal.setText("Subtotal: $"+String.format("%.2f", holder.precio_final*valorNP));
            }
            holder.categoria = jsonArray.getJSONObject(position).getString(APIConstantes.PRODUCTO_CATEGORIA);
        }
        catch(Exception e)
        {
        }

        if (holder.precio_final<holder.precio){
            holder.precioFinal.setText("$" + String.format("%.2f", holder.precio_final));
            holder.descripcion.setPaintFlags(holder.precioFinal.getPaintFlags() | Paint.STRIKE_THRU_TEXT_FLAG);
        }else{
            holder.precioFinal.setText("");
            holder.descripcion.setPaintFlags(holder.precioFinal.getPaintFlags());

        }
//        holder.aplicarDescuentos(0);

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
        TextView leyendaDescuento;
        TextView precioFinal;
        int posicion;
        int itemId;
        double precio;
        String marca;
        String categoria;
        double precio_final;

        NumberPicker np;

        public ViewHolder(View view) {
            super(view);


            icono = (ImageView) itemView.findViewById(R.id.imagenProducto);
            titulo = (TextView) itemView.findViewById(R.id.nombreProducto);
            precioFinal = (TextView) itemView.findViewById(R.id.precioFinal);
            descripcion = (TextView) itemView.findViewById(R.id.caracteristicasProductos);
            leyendaDescuento = (TextView) itemView.findViewById(R.id.descuento);
            subtotal = (TextView)itemView.findViewById(R.id.subtotal);
            subtotal.setText("");

            np = (NumberPicker) itemView.findViewById(R.id.nPicker);

            np.setMinValue(0);
            np.setValue(0);
            np.setMaxValue(1);
            np.setWrapSelectorWheel(true);

            np.setOnValueChangedListener(new NumberPicker.OnValueChangeListener() {
                @Override
                public void onValueChange(NumberPicker picker, int oldVal, int newVal) {
                    if (newVal == 0){
                        pedidos.remove(itemId);
                        subtotal.setText("");
                    } else {
                        try {
                            JSONObject producto = new JSONObject();
                            aplicarDescuentos(newVal);
                            producto.put(APIConstantes.PRODUCTO_ID, itemId);
                            producto.put(APIConstantes.PRODUCTO_CANTIDAD, newVal);
                            producto.put(APIConstantes.PRODUCTO_NOMBRE, titulo.getText().toString());
                            producto.put(APIConstantes.PRODUCTO_PRECIO,precio);
                            producto.put(APIConstantes.PRODUCTO_PRECIO_FINAL,precio_final);
                            pedidos.put(itemId, producto);
                            descripcion.setText("$" + String.format("%.2f", precio));
                            subtotal.setText("Subtotal: $" + String.format("%.2f", precio_final * newVal));
//                            notifyItemChanged(posicion);
                            if (precio_final<precio){
                                precioFinal.setText("$"+String.format( "%.2f", precio_final));
                                descripcion.setPaintFlags(descripcion.getPaintFlags() | Paint.STRIKE_THRU_TEXT_FLAG);

                            }else{
   //                             precioFinal.setText("");
   //                             descripcion.setPaintFlags(precioFinal.getPaintFlags());

                            }

                        } catch (JSONException e) {
                        }
  //                      notifyDataSetChanged();
                    }
                }
            });


            icono.setOnClickListener(this);
            titulo.setOnClickListener(this);
            descripcion.setOnClickListener(this);

        }


        public void aplicarDescuentos(int cantidadComprada){
            JSONArray descuentos = obtenerDescuentos();

            double porcentaje;
            String marcaProducto, marcaDescuento;
            String categoriaProducto, categoriaDescuento;

            for (int i=0;i<descuentos.length();i++) {

                try {
                    int cantidadDescuento = Integer.parseInt(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_CANTIDAD));
                    porcentaje = Double.parseDouble(descuentos.getJSONObject(i).getString(APIConstantes.DESCUENTOS_PORCENTAJE));
                    marcaDescuento = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_MARCA);
                    categoriaDescuento = descuentos.getJSONObject(i).getString(APIConstantes.PRODUCTO_CATEGORIA);

                    try {
                        marcaProducto = marca;
                        categoriaProducto = categoria;

                        if ((cantidadDescuento>0)&&(cantidadComprada >= cantidadDescuento)){
                            if (precio*porcentaje <= precio_final){
                                precio_final = (precio*porcentaje);
                                jsonArray.getJSONObject(posicion).put(APIConstantes.PRODUCTO_PRECIO_FINAL, precio*porcentaje);
                                jsonArray.getJSONObject(posicion).put("leyenda", String.valueOf(100-(int)(porcentaje*100))
                                        +"% llevando más de "+String.valueOf(cantidadDescuento)
                                        +" unidades");

                                leyendaDescuento.setText(String.valueOf(100-(int)(porcentaje*100))
                                            +"% llevando más de "+String.valueOf(cantidadDescuento)
                                            +" unidades");
                            }
                        }else if (cantidadComprada<cantidadDescuento){
                                precio_final = precio;
                                leyendaDescuento.setText("");
                                jsonArray.getJSONObject(posicion).put(APIConstantes.PRODUCTO_PRECIO_FINAL, precio);
                                jsonArray.getJSONObject(posicion).put("leyenda", "");
                        }
                        if (marcaProducto!=null && marcaProducto.equals(marcaDescuento)){
                            if (precio*porcentaje <= precio_final){
                                precio_final = (precio*porcentaje);
                                jsonArray.getJSONObject(posicion).put(APIConstantes.PRODUCTO_PRECIO_FINAL, (precio*porcentaje));
                                jsonArray.getJSONObject(posicion).put("leyenda", String.valueOf(100 - (int) (porcentaje * 100))
                                        + "% en productos de la marca " + marcaProducto);

                                leyendaDescuento.setText(String.valueOf(100 - (int) (porcentaje * 100))
                                        + "% en productos de la marca " + marcaProducto);
                            }
                        }
                        if (categoriaProducto!=null && categoriaProducto.equals(categoriaDescuento)){
                            if (precio*porcentaje <= precio_final){
                                precio_final = (precio*porcentaje);
                                leyendaDescuento.setText(String.valueOf(100-(int)(porcentaje*100))
                                        +"% en productos de la categoría "+ categoriaProducto);
                                jsonArray.getJSONObject(posicion).put(APIConstantes.PRODUCTO_PRECIO_FINAL, (precio * porcentaje));
                                jsonArray.getJSONObject(posicion).put("leyenda", String.valueOf(100-(int)(porcentaje*100))
                                        +"% en productos de la categoría "+ categoriaProducto);
                            }
                        }

                    } catch(Exception e){}


                }catch(Exception e){}

            }
        }

        private JSONArray obtenerDescuentos(){
            String json = ManejadorPersistencia.obtenerDescuentos(contexto);

            if (json ==  null){
                return new JSONArray();
            }else{
                try {
                    return new JSONArray(json);
                } catch (JSONException e) {
                    e.printStackTrace();
                    return new JSONArray();
                }
            }
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

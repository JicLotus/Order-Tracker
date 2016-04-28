package com.tdp2.ordertracker;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

public class AgendaAdapter extends RecyclerView.Adapter<AgendaAdapter.AgendaViewHolder> {

    private List<Agenda> usuarios;


    AgendaAdapter(List<Agenda> usuarios)
    {
        this.usuarios = usuarios;


    }

    @Override
    public AgendaAdapter.AgendaViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.recycle_view_agenda, parent, false);
        AgendaViewHolder pvh = new AgendaViewHolder(v);

        return pvh;
    }

    @Override
    public void onBindViewHolder(AgendaAdapter.AgendaViewHolder holder, int position) {
        holder.nombre.setText(usuarios.get(position).nombre);
        holder.direccion.setText(usuarios.get(position).direccion);
        holder.horario.setText(usuarios.get(position).hora);
        holder.id = usuarios.get(position).id;

        switch (usuarios.get(position).estadoVisita){
            case APIConstantes.ESTADO_VISITADO: {
                holder.iconoEstado.setImageResource(R.drawable.ic_label_verde);
                break;
            }
            case APIConstantes.ESTADO_PENDIENTE: {
                holder.iconoEstado.setImageAlpha(R.drawable.ic_label_amarillo);
                break;
            }
            case APIConstantes.ESTADO_NOVISITADO: {
                
                break;
            }
        }
    }

    @Override
    public int getItemCount() {
        return usuarios.size();
    }

    public class AgendaViewHolder extends RecyclerView.ViewHolder  {

        TextView nombre;
        TextView direccion;
        TextView horario;
        ImageView iconoEstado;
        String id;
        View view;
        AgendaViewHolder selfHolder;
        RelativeLayout holder_agenda;
        FloatingActionButton agregarAlCarro;
        int posicion;

        AgendaViewHolder(View itemView) {
            super(itemView);
            selfHolder = this;
            view = itemView;
            nombre = (TextView)itemView.findViewById(R.id.nombre_agenda);
            direccion = (TextView)itemView.findViewById(R.id.direccion_agenda);
            horario = (TextView)itemView.findViewById(R.id.hora_agenda);
            iconoEstado = (ImageView) itemView.findViewById(R.id.icono_estado);
            ponerAmarillo();
            holder_agenda = (RelativeLayout)itemView.findViewById(R.id.holder_agenda);
            agregarAlCarro = (FloatingActionButton) itemView.findViewById(R.id.iconoCarro);
            this.accionCarroDeCompras();

        }

        public void ponerVerde(){
            iconoEstado.setImageResource(R.drawable.ic_label_verde);
        }


        public void ponerAmarillo(){
            iconoEstado.setImageResource(R.drawable.ic_label_amarillo);
        }

        private void accionCarroDeCompras(){

            agregarAlCarro.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Context contexto = v.getContext();
/*
                    Intent documentsActivity = new Intent(contexto, ListadoProductos.class);
                    documentsActivity.putExtra("cliente", id);
                    contexto.startActivity(documentsActivity);

*/
                   ((AgendaActivity)contexto).usuarioSeleccionado = selfHolder;
                    Intent intent = new Intent("com.google.zxing.client.android.SCAN");
                    intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
                    ((Activity) contexto).startActivityForResult(intent, 0);

                }
            });
        }


    }




}


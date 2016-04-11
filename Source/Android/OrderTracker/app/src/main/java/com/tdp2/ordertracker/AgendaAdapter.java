package com.tdp2.ordertracker;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

/**
 * Created by juan on 06/04/16.
 */
public class AgendaAdapter extends RecyclerView.Adapter<AgendaAdapter.AgendaViewHolder> {

    List<Agenda> usuarios;

    @Override
    public AgendaAdapter.AgendaViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext()).inflate(R.layout.recycle_view_agenda, parent, false);
        AgendaViewHolder pvh = new AgendaViewHolder(v);

        Date cDate = new Date();
        String fDate = new SimpleDateFormat("yyyy-MM-dd").format(cDate);

        return pvh;
    }

    @Override
    public void onBindViewHolder(AgendaAdapter.AgendaViewHolder holder, int position) {
        holder.nombre.setText(usuarios.get(position).nombre);
        holder.direccion.setText(usuarios.get(position).direccion);
        holder.horario.setText(usuarios.get(position).hora);
    }

    @Override
    public int getItemCount() {
        return usuarios.size();
    }

    public static class AgendaViewHolder extends RecyclerView.ViewHolder {

        TextView nombre;
        TextView direccion;
        TextView horario;
        RelativeLayout holder_agenda;

        AgendaViewHolder(View itemView) {
            super(itemView);
            nombre = (TextView)itemView.findViewById(R.id.nombre_agenda);
            direccion = (TextView)itemView.findViewById(R.id.direccion_agenda);
            horario = (TextView)itemView.findViewById(R.id.hora_agenda);
            holder_agenda = (RelativeLayout)itemView.findViewById(R.id.holder_agenda);
        }
    }

    AgendaAdapter(List<Agenda> usuarios){
        this.usuarios = usuarios;
    }
}


package com.tdp2.ordertracker;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

public class NavDrawerAdapter extends ArrayAdapter<NavDrawerItem> {

    public NavDrawerAdapter(Context context, ArrayList<NavDrawerItem> navDrawerItems) {
        super(context, 0, navDrawerItems);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        NavDrawerItem item = getItem(position);

        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.nav_drawer_item, parent, false);
        }

        TextView titulo = (TextView) convertView.findViewById(R.id.nav_drawer_titulo);
        ImageView icono = (ImageView) convertView.findViewById(R.id.nav_drawer_icono);

        titulo.setText(item.getTitulo());
        icono.setImageResource(item.getIdIcono());

        return convertView;
    }
}

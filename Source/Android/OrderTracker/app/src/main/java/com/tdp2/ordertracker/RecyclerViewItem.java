package com.tdp2.ordertracker;

public class RecyclerViewItem {
    String titulo;
    int idIcono;
    String precio_final;
    String descripcion;

    public RecyclerViewItem(String titulo, String precio, int idIcono, String precio_final){
        this.titulo = titulo;
        this.precio_final = precio_final;
        this.descripcion = precio;
        this.idIcono = idIcono;
    }
}

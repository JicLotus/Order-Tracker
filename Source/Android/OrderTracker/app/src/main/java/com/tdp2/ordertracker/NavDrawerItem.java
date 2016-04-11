package com.tdp2.ordertracker;

public class NavDrawerItem {
    String titulo;
    int idIcono;

    public NavDrawerItem(String titulo, int idIcono){
        this.titulo = titulo;
        this.idIcono = idIcono;
    }

    public String getTitulo() {
        return titulo;
    }

    public int getIdIcono() {
        return idIcono;
    }
}

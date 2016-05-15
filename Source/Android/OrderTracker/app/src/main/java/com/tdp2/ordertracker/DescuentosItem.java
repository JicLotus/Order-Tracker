package com.tdp2.ordertracker;


public class DescuentosItem {
    String descripcion;

    public DescuentosItem(int cantidad, double porcentaje, String marca, String categoria){
        descripcion = porcentaje + "% de descuento";
        if (cantidad > 0) {
            descripcion += " llevando " + cantidad + " productos";
        } if (categoria != null && ! categoria.isEmpty()) {
            descripcion += " de " + categoria;
        } if (marca != null && ! marca.isEmpty()) {
            descripcion += " marca " + marca;
        }
    }
}

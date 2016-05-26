package com.tdp2.ordertracker;


public class DescuentosItem {
    String descripcion;
    String validez;

    public DescuentosItem(int cantidad, double porcentaje, String marca, String categoria, String fecha_inicial, String fecha_final){
        descripcion = porcentaje + "% de descuento";
        if (cantidad > 0) {
            descripcion += " llevando " + cantidad + " productos";
        } if (categoria != null && ! categoria.isEmpty()) {
            descripcion += " de " + categoria;
        } if (marca != null && ! marca.isEmpty()) {
            descripcion += " marca " + marca;
        }
        validez = "Valido desde el " + fecha_inicial + " hasta el " + fecha_final;
    }
}

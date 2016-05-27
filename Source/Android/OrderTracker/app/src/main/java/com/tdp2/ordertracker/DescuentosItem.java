package com.tdp2.ordertracker;


public class DescuentosItem {
    String descripcion;
    String validez;

    public DescuentosItem(int cantidad, double porcentaje, String marca, String categoria, String fecha_inicial, String fecha_final){
        descripcion = String.valueOf(100-(int)porcentaje) + "% de descuento";
        if (cantidad > 0) {
            descripcion += " llevando " + cantidad + " productos";
        }else if (!categoria.equals("null") && ! categoria.isEmpty()) {
            descripcion += " de " + categoria;
        } else if (!marca.equals("null")&& ! marca.isEmpty()) {
            descripcion += " marca " + marca;
        }
        validez = "Valido desde el " + fecha_inicial + " hasta el " + fecha_final;
    }
}

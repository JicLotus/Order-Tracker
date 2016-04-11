package com.tdp2.ordertracker;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by juan on 06/04/16.
 */
public class Agenda {
    String nombre;
    String hora;
    String direccion;
    private List<Agenda> persons;

    Agenda(String unNombre, String unaDireccion, String unaHora){
        this.nombre=unNombre;
        this.hora=unaHora;
        this.direccion=unaDireccion;
    }

    private void initializeData(){
        persons = new ArrayList<>();
        persons.add(new Agenda("Emma Wilson", "Superi 3683", "19.00pm" ));
        persons.add(new Agenda("Lavery Maiss", "Superi 3683", "19.00pm"));
        persons.add(new Agenda("Lillie Watts", "Superi 3683", "19.00pm"));
    }

}


package com.tdp2.ordertracker;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.NumberPicker;
import android.widget.NumberPicker.OnValueChangeListener;
import android.widget.TextView;

import org.json.JSONArray;

/**
 * Created by juan on 10/04/16.
 */
public class NumberPickerActivity extends AppCompatActivity {
    NumberPicker np;
    Button b1,b2;
    String jsonArray;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.number_picker);

        jsonArray = getIntent().getStringExtra("jsonArray");
        np = (NumberPicker) findViewById(R.id.number_picker);
        b1 = (Button) findViewById(R.id.button1);
        b2 = (Button) findViewById(R.id.button2);

        np.setMinValue(0);
        np.setMaxValue(ManejadorJSONProductos.obtenerStock(jsonArray));
        np.setWrapSelectorWheel(false);

        np.setOnValueChangedListener(new OnValueChangeListener() {

            @Override
            public void onValueChange(NumberPicker picker, int oldVal, int newVal) {
                // TODO Auto-generated method stub
                String Old = "Old Value : ";
                String New = "New Value : ";

                //tv1.setText(Old.concat(String.valueOf(oldVal)));
                //tv2.setText(New.concat(String.valueOf(newVal)));
            }
        });
    }


    public void cancelar(View view) {
        finish();
    }
    public void aceptar(View view) {
        ManejadorPersistencia.agregarAlCarro(this, jsonArray, np.getValue());
        finish();
    }

        @Override

    public boolean onCreateOptionsMenu(Menu menu) {
        //getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
}

package com.tdp2.ordertracker;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONArray;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

public class MainActivity extends AppCompatActivity {

    private EditText username;
    private EditText password;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        username = (EditText) findViewById(R.id.username);
        password = (EditText) findViewById(R.id.password);
    }



    public void login(View view) {
        try {

            if (username.getText().toString().matches("") || password.getText().toString().matches("")) {
                Toast.makeText(this, "Usuario a contraseña invalida", Toast.LENGTH_LONG).show();
                return;
            }

            Request request = new Request("GET", "GetUsuarios.php?nombre="+username.getText().toString()+"&pass="+password.getText().toString());
            Response resp = new RequestHandler().sendRequest(request);

            if (resp.getStatus()) {
                JSONArray vendedor = resp.getJsonArray();
                Intent documentsActivity = new Intent(this, MenuInicial.class);
                documentsActivity.putExtra("vendedor",vendedor.toString());
                startActivity(documentsActivity);
            } else {
                Toast.makeText(this, "Contraseña o usuario invalido", Toast.LENGTH_LONG).show();
            }

        } catch (Exception e) {
            e.printStackTrace();
        }



    }



    public void testQr(View view) {
        Intent intent = new Intent("com.google.zxing.client.android.SCAN");
        intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
        startActivityForResult(intent, 0);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}

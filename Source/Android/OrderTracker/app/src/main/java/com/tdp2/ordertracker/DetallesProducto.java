package com.tdp2.ordertracker;

import android.app.ActionBar;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.tdp2.ordertracker.R;

import org.json.JSONObject;

import java.io.File;
import java.io.FileInputStream;
import java.util.ArrayList;
import java.util.logging.Logger;

import Model.Request;
import Model.RequestHandler;
import Model.Response;
import DialogImage.DialogImage;
import DialogImage.DialogImageListener;

public class DetallesProducto extends AppCompatActivity {

    private JSONObject producto;
    private DialogImage dialogImage;
    private DialogImageListener dialogImageListener;

    boolean isImageFitToScreen;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalles_productos);

        try {
            producto = new JSONObject(getIntent().getStringExtra("jsonArray"));
            setTitle(producto.getString("nombre"));
        }catch(Exception e){}


        this.setAdaptador(this.getListaDetalles());

        ArrayList<String> imagenes = getListaImagenes();

        this.createDialogImage(imagenes);
        this.createListImages(imagenes);

    }

    private void createListImages(ArrayList<String> imagenes)
    {
        LinearLayout layout = (LinearLayout) findViewById(R.id.linear_imagenes);

        for (int i = 0; i < imagenes.size(); i++) {

            ImageView imageView = new ImageView(this);

            imageView.setTag(i);
            imageView.setOnClickListener(dialogImageListener);

            imageView.setId(i);
            imageView.setPadding(2, 2, 2, 2);

            try {
                File f = new File("/mnt/sdcard/Download/", imagenes.get(i) + ".jpg");
                Bitmap b = BitmapFactory.decodeStream(new FileInputStream(f));
                agregarImagen(imageView, b);
            }
            catch(Exception e){
                Toast.makeText(this, e.getMessage(), Toast.LENGTH_LONG).show();
            }
            imageView.setScaleType(ImageView.ScaleType.CENTER_CROP);
            layout.addView(imageView);
        }
    }


    private void createDialogImage(ArrayList<String> imagenes)
    {
        dialogImage = new DialogImage(DetallesProducto.this);
        dialogImage.setLayoutInflater(this.getLayoutInflater());
        dialogImage.setImagenes(imagenes);
        dialogImageListener = new DialogImageListener();
        dialogImageListener.setDialogImage(dialogImage);
    }

    private void agregarImagen(ImageView imageView, Bitmap bitMap){

        int currentBitmapWidth = bitMap.getWidth();
        int currentBitmapHeight = bitMap.getHeight();

        int ivWidth = imageView.getWidth();
        int ivHeight = imageView.getHeight();
        System.out.print(ivHeight);
        int newHeigth = 90;

        int newWidth = (int) Math.floor((double) currentBitmapWidth * ((double) newHeigth / (double) currentBitmapHeight));

        Bitmap newbitMap = Bitmap.createScaledBitmap(bitMap, newWidth, newHeigth, true);

        imageView.setImageBitmap(newbitMap);

    }


    public ArrayList<String> getListaImagenes(){
        ArrayList<String> listaImagenes = new ArrayList<String>();
        try {
            Request request = new Request("GET", "GetListaImagenes.php?id_producto=" + producto.getString("id"));
            Response resp = new RequestHandler().sendRequest(request);
            for (int i=0;i<resp.getJsonArray().length();i++)
                listaImagenes.add(resp.getJsonArray().getJSONObject(i).getString("id_mapeo"));
        }
        catch(Exception e){}

        return listaImagenes;
    }

    public ArrayList<String> getListaDetalles()
    {
        ArrayList<String> datos = new ArrayList<String>();

        try {
            datos.add("$" + producto.getString("precio"));
            datos.add(producto.getString("nombre"));
            datos.add("Caracteristicas: " + producto.getString("caracteristicas"));
            datos.add("Stock: " + producto.getString("stock"));
            datos.add("Marca: " + producto.getString("marca"));
            datos.add("Categoria: " + producto.getString("categoria"));
            datos.add("Codigo: " + producto.getString("codigo"));
            //datos.add("Estado: " + producto.getString("estado"));

        }
        catch(Exception e){}

        return datos;
    }

    public void setAdaptador(ArrayList<String> datos)
    {
        ArrayAdapter<String> adaptador = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,datos);
        ListView listado = (ListView) findViewById(R.id.list);
        listado.setAdapter(adaptador);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_detalles_producto, menu);
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

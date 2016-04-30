package DialogImage;

import android.app.AlertDialog;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;

import com.tdp2.ordertracker.R;

import java.io.File;
import java.io.FileInputStream;
import java.util.ArrayList;

/**
 * Created by lotus on 11/04/16.
 */
public class DialogImage {

    LayoutInflater mLayoutInflater;
    ImageView mImgOriginal;
    View view;
    ArrayList<String> imagenes;
    Context ctx;

    public DialogImage(Context ctxParam){
        ctx = ctxParam;
    }


    public void setLayoutInflater(LayoutInflater layoutInflaterParam)
    {
        mLayoutInflater = layoutInflaterParam;
    }

    public void setImagenes(ArrayList<String> imagenesParam)
    {
        imagenes = imagenesParam;
    }

    public void showZoomImage(View v)
    {
        view = mLayoutInflater.inflate(R.layout.image_dialog_layout, null);
        mImgOriginal = (ImageView) view.findViewById(R.id.imgOriginal);
        try {
            File f = new File("/mnt/sdcard/Download/", imagenes.get((Integer)v.getTag()) + ".jpg");

            Bitmap b = BitmapFactory.decodeStream(new FileInputStream(f));

            mImgOriginal.setImageBitmap(agrandarBitmap(b));
            mImgOriginal.setAdjustViewBounds(true);


            AlertDialog.Builder builder = new AlertDialog.Builder(ctx);

            builder.setView(view);
            builder.create();
            builder.show();

        }catch(Exception e)
        {
            Toast.makeText(ctx, e.getMessage(), Toast.LENGTH_LONG).show();
        }


    }

    private Bitmap agrandarBitmap(Bitmap bitMap){


        int currentBitmapWidth = bitMap.getWidth();
        int currentBitmapHeight = bitMap.getHeight();

        int newHeigth = 500;

        int newWidth = (int) Math.floor((double) currentBitmapWidth * ((double) newHeigth / (double) currentBitmapHeight));

        Bitmap newbitMap = Bitmap.createScaledBitmap(bitMap, newWidth, newHeigth, true);

        return newbitMap;

    }

}

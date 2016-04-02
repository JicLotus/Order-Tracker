package Files;

import android.util.Base64;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import Model.Request;
import Model.RequestHandler;
import Model.Response;

/**
 * Created by lotus on 2/04/16.
 */
public class FileHandler {

    public FileHandler()
    {
    }

    public void downloadFile(String path,String indentifierFile)
    {
        try {
            File file = new File(path);
            Request request = new Request("GET", "GetImagen.php?id_producto=" + indentifierFile);
            Response resp = new RequestHandler().sendRequest(request);

            saveFile(file,resp.getJsonArray().getJSONObject(0).getString("imagen_base64"));
        }
        catch(Exception e)
        {
        }
    }

    private void saveFile(File file,String textoBytes) throws IOException {
        byte[] bytes = Base64.decode(textoBytes, Base64.DEFAULT);
        FileOutputStream fop = new FileOutputStream(file);
        fop.write(bytes);
        fop.flush();
        fop.close();
    }


}

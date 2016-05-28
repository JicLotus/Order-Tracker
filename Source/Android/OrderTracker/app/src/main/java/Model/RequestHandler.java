package Model;

import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.client.HttpClient;
import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpDelete;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.methods.HttpPut;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.protocol.BasicHttpContext;
import org.apache.http.protocol.HttpContext;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONTokener;

import java.io.BufferedReader;
import java.io.InputStreamReader;


public class RequestHandler {
    private Model.Response response;

 //   private String ip = "http://192.168.1.102:8080/";

   // private String ip = "http://192.168.100.114:8080/";
    private String ip = "http://10.0.2.2:8080/";
//    private String ip = "http://10.31.88.8:8080/";

    public Model.Response sendRequest(final Request request) {
        Thread thread = new Thread(new Runnable(){
            public void run() {
                try {
                    HttpClient httpclient = new DefaultHttpClient();
                    HttpContext contexto = new BasicHttpContext();
                    HttpResponse resp = null;
                    if (request.getMethod().equals("GET")) {
                        resp = httpclient.execute(new HttpGet(ip + request.getPath()),contexto);

                    } else {                        if (request.getMethod().equals("DELETE")) {
                            resp = httpclient.execute(new HttpDelete(ip + request.getPath()));

                        }else if (request.getMethod().equals("POST")) {

                            HttpPost req = new HttpPost(ip + request.getPath());

                            JSONObject data = request.getArgs();
                            req.setEntity(new StringEntity(data.toString()));

                            resp = httpclient.execute(req);

                        }else if (request.getMethod().equals("PUT")) {

                            HttpPut req = new HttpPut(ip + request.getPath());

                            JSONObject data = request.getArgs();
                            req.setEntity(new StringEntity(data.toString()));

                            resp = httpclient.execute(req);
                        }

                    }

                    String respuesta = EntityUtils.toString(resp.getEntity(),"UTF-8");
                    JSONArray finalResult = new JSONArray(respuesta);
                    response = new Response(finalResult);

                } catch (Exception e) {
                    response =  new Response(null);
                }
            }
        });
        try {
            thread.start();
            thread.join();
            return response;
        } catch (Exception e) {
            return null;
        }
    }

}

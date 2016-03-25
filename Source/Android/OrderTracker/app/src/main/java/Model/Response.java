package Model;

import org.json.JSONArray;

public class Response {
    private JSONArray jsonResponse;

    public Response(JSONArray response) {
        this.jsonResponse = response;

    }

    public boolean getStatus() {
        if (jsonResponse==null)return false;
        return true;
    }


    public JSONArray getJsonArray(){return jsonResponse;}

}

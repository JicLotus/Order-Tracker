package Model;

import org.json.JSONObject;


public class Response {
    private boolean status;
    private JSONObject jsonResponse;

    public Response(JSONObject response) {
        this.jsonResponse = response;
        try {
            this.status = response.getString("result").equals("OK");
        } catch (Exception e) {
            this.status = false;
        }
    }

    public boolean getStatus() {
        return status;
    }

    public String get(String key) {
        try {
            return (String) jsonResponse.get(key);
        } catch (Exception e) {
            return null;
        }
    }

    public JSONObject getJsonObject(){return jsonResponse;}

}

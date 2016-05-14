package com.tdp2.ordertracker;

import android.app.IntentService;
import android.content.Intent;
import android.util.Log;

/**
 * Created by juan on 13/05/16.
 */

public class RSPullService extends IntentService {


    // Must create a default constructor
    public RSPullService() {
        // Used to name the worker thread, important only for debugging.
        super("test-service");
    }

    @Override
    public void onCreate() {
        super.onCreate(); // if you override onCreate(), make sure to call super().
        // If a Context object is needed, call getApplicationContext() here.
    }

    @Override
    protected void onHandleIntent(Intent intent) {
        // This describes what will happen when service is triggered
        Log.i("Servicio", " comenzo");
    }

}
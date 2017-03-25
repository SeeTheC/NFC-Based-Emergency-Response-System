package org.iitb.nfc;

import  android.nfc.FormatException;
import android.nfc.NdefRecord;
import android.nfc.tech.Ndef;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;
import android.nfc.NfcAdapter;
import android.nfc.Tag;
import android.app.PendingIntent;
import android.content.IntentFilter;
import 	android.content.Intent;
import android.nfc.NdefMessage;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.concurrent.ExecutionException;

import android.content.Context;
import android.annotation.SuppressLint;

import org.iitb.common.Crypto;
import org.json.JSONException;
import org.json.JSONObject;

@SuppressLint({ "ParserError", "ParserError" })
public class MainActivity extends AppCompatActivity {
    private String className = "MainActivity";
    NfcAdapter adapter;
    PendingIntent pendingIntent;
    IntentFilter writeTagFilters[];
    boolean writeMode;
    Tag mytag;
    Context ctx;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        registerNFCToAndroid();
        Button writeToNFC = (Button) findViewById(R.id.writeToNFC);
        ctx = this;


    }

    /**
     * Register NFC
     */
    public void registerNFCToAndroid() {

        adapter = NfcAdapter.getDefaultAdapter(this);
        pendingIntent = PendingIntent.getActivity(this, 0, new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP), 0);
        IntentFilter tagDetected = new IntentFilter(NfcAdapter.ACTION_TAG_DISCOVERED);
        tagDetected.addCategory(Intent.CATEGORY_DEFAULT);
        writeTagFilters = new IntentFilter[]{tagDetected};
    }

    public void writeToNFCClick(View v) {

        Button b = (Button) v;

        Log.d(className, "Button Clicked:" + b.getText());
        TextView uniqueId = (TextView) findViewById(R.id.uniqueId);
        TextView name = (TextView) findViewById(R.id.name);
        TextView number = (TextView) findViewById(R.id.number);
        RadioGroup rGroup = (RadioGroup) findViewById(R.id.radiogroup);
        int rID = radioButtonId(rGroup);

        String data = getEncrptID(uniqueId,rID) + "|" + name.getText() + "|" + number.getText() + "|" + rID;

        Log.d(className, "data: " + data);
        Log.d(className, "size: " + data.length());

        try {
            if (mytag == null) {
                Toast.makeText(ctx, "Error: No NFC Detected", Toast.LENGTH_LONG).show();
            } else {
                write(data, mytag);
                Toast.makeText(ctx, "Successfully Written ", Toast.LENGTH_LONG).show();
            }
        } catch (IOException e) {
            Log.d(className, e.getMessage());
            Toast.makeText(ctx, "Error: code 1", Toast.LENGTH_LONG).show();
            e.printStackTrace();
        } catch (FormatException e) {
            Log.d(className, e.getMessage());
            Toast.makeText(ctx, "Error: code 2", Toast.LENGTH_LONG).show();
            e.printStackTrace();
        }
    }

    public int radioButtonId(RadioGroup rGroup) {
        int selectedId = rGroup.getCheckedRadioButtonId();
        RadioButton rButton = (RadioButton) findViewById(selectedId);
        String rtext = rButton.getText() + "";
        int rID = 0;
        switch (rtext){
            case "Vehical" :
                rID = 1;
            break;
            case "Person"  :
                rID = 2;
            break;
        }
        return rID;
    }


    public String getEncrptID(TextView id,int rID) {
        String data = id.getText() + "";
        Crypto crypt = null;
        String encrptText = "" ;
        try {
            crypt = new Crypto();
            encrptText = crypt.encrypt(data + "@" + rID);

        } catch (Exception e) {
            Log.d(className,e.getMessage());
        }
        return encrptText;
    }

    public void encrptBtnClick(View v) {
        /*
        OpenGetHttpConnection connection = (OpenGetHttpConnection) new OpenGetHttpConnection().execute("http://10.196.12.74:9000/callEmergencyService?nfc_type_id=1&nfc_type=1");
        try {
            InputStream in = connection.get();
            System.out.println(getDataFromInputStream(in));

        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        */

        //JsonPostRequest jp= (JsonPostRequest) new JsonPostRequest().execute();
        TextView uniqueId = (TextView) findViewById(R.id.uniqueId);
        String data = uniqueId.getText() + "";
        Log.d(className, "data: " + data);
        Crypto crypt = null;
        try {
          crypt = new Crypto();
        String encrptText = crypt.encrypt(data);
        Log.d(className,"encrpytText: "+encrptText);
        String decryptText = crypt.decrypt(encrptText);
        Log.d(className,"encrypText: "+decryptText);

        } catch (Exception e) {
          Log.d(className,e.getMessage());
        }

    }

    public String getDataFromInputStream(InputStream in){

        BufferedReader reader = new BufferedReader(new InputStreamReader(in));
        StringBuilder out = new StringBuilder();
        String line;
        try {
            while ((line = reader.readLine()) != null) {
                out.append(line);
            }
            reader.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return out.toString();
    }

    @Override
    protected void onNewIntent(Intent intent){
        if(NfcAdapter.ACTION_TAG_DISCOVERED.equals(intent.getAction())){
            mytag = intent.getParcelableExtra(NfcAdapter.EXTRA_TAG);
            Toast.makeText(this, "NFC Detected:" + mytag.toString(), Toast.LENGTH_LONG ).show();
        }
    }



    private void write(String text, Tag tag) throws IOException, FormatException {

        NdefRecord[] records = { createRecord(text) };
        NdefMessage  message = new NdefMessage(records);
        // Get an instance of Ndef for the tag.
        Ndef ndef = Ndef.get(tag);
        // Enable I/O
        ndef.connect();
        // Write the message
        ndef.writeNdefMessage(message);
        // Close the connection
        ndef.close();
    }



    private NdefRecord createRecord(String text) throws UnsupportedEncodingException {
        String lang       = "en";
        byte[] textBytes  = text.getBytes();
        byte[] langBytes  = lang.getBytes("US-ASCII");
        int    langLength = langBytes.length;
        int    textLength = textBytes.length;
        byte[] payload    = new byte[1 + langLength + textLength];

        // set status byte (see NDEF spec for actual bits)
        payload[0] = (byte) langLength;

        // copy langbytes and textbytes into payload
        System.arraycopy(langBytes, 0, payload, 1,              langLength);
        System.arraycopy(textBytes, 0, payload, 1 + langLength, textLength);

        NdefRecord recordNFC = new NdefRecord(NdefRecord.TNF_WELL_KNOWN,  NdefRecord.RTD_TEXT,  new byte[0], payload);

        return recordNFC;
    }

    @Override
    public void onPause(){
        super.onPause();
        WriteModeOff();
    }

    @Override
    public void onResume(){
        super.onResume();
        WriteModeOn();
    }

    private void WriteModeOn(){
        writeMode = true;
        adapter.enableForegroundDispatch(this, pendingIntent, writeTagFilters, null);
    }

    private void WriteModeOff(){
        writeMode = false;
        adapter.disableForegroundDispatch(this);
    }
}

class OpenGetHttpConnection extends AsyncTask<String, Void, InputStream> {

    @Override
    protected InputStream doInBackground(String... params) {
        String urlstring = params[0];
        InputStream in = null;
        int response = 01;

        URL url = null;
        try {
            url = new URL(urlstring);
        } catch (MalformedURLException e) {
            e.printStackTrace();
        }
        URLConnection conn = null;
        try {
            conn = url.openConnection();
        } catch (IOException e) {
            e.printStackTrace();
        }

        if (!(conn instanceof HttpURLConnection))
            try {
                throw new IOException("Not an HTTP connection");
            } catch (IOException e) {
                e.printStackTrace();
            }
        try{
            HttpURLConnection httpConn = (HttpURLConnection) conn;
            httpConn.setAllowUserInteraction(false);
            httpConn.setInstanceFollowRedirects(true);
            httpConn.setRequestMethod("GET");
            httpConn.connect();
            response = httpConn.getResponseCode();
            if (response == HttpURLConnection.HTTP_OK){
                in = httpConn.getInputStream();
            }
        }
        catch (Exception ex)
        {
            Log.d("GET","Error");
            ex.printStackTrace();
        }
        return in;

    }

}



class JsonPostRequest extends AsyncTask<Void, Void, String> {

    @Override
    protected String doInBackground(Void... voids) {
        try {
            String address = "http://10.196.12.74:9000/callEmergencyServicePost";
            JSONObject json = new JSONObject();
            json.put("nfc_type_id", 1);
            json.put("nfc_type", 1);
            String requestBody = json.toString();
            URL url = new URL(address);
            HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.setDoOutput(true);
            urlConnection.setRequestProperty("Content-Type", "application/json");
            OutputStream outputStream = new BufferedOutputStream(urlConnection.getOutputStream());
            BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(outputStream, "utf-8"));
            writer.write(requestBody);
            writer.flush();
            writer.close();
            outputStream.close();
            Log.d("S","Start1");

            InputStream inputStream;
            // get stream
            if (urlConnection.getResponseCode() < HttpURLConnection.HTTP_BAD_REQUEST) {
                inputStream = urlConnection.getInputStream();
                Log.d("S","Start2");
            } else {
                inputStream = urlConnection.getErrorStream();
                Log.d("S","Start3");
            }
            // parse stream
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
            String temp, response = "";
            while ((temp = bufferedReader.readLine()) != null) {
                System.out.println(temp);
                response += temp;
            }
            //System.out.println(response);
            System.out.println(urlConnection.getResponseMessage());
            // put into JSONObject
            JSONObject jsonObject = new JSONObject();
            jsonObject.put("Content", response);
            jsonObject.put("Message", urlConnection.getResponseMessage());
            jsonObject.put("Length", urlConnection.getContentLength());
            jsonObject.put("Type", urlConnection.getContentType());
            return jsonObject.toString();
        } catch (IOException | JSONException e) {
            return e.toString();
        }
    }

    @Override
    protected void onPostExecute(String result) {
        System.out.println(result);
        super.onPostExecute(result);
        Log.d("aaa", "POST RESPONSE: " + result);
    }
}
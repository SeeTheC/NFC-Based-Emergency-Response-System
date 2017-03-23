package org.iitb.nfc;

import  android.nfc.FormatException;
import android.nfc.NdefRecord;
import android.nfc.tech.Ndef;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import android.nfc.NfcAdapter;
import android.nfc.Tag;
import android.app.PendingIntent;
import android.content.IntentFilter;
import 	android.content.Intent;
import android.nfc.NdefMessage;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import android.content.Context;
import android.annotation.SuppressLint;

@SuppressLint({ "ParserError", "ParserError" })
public class MainActivity extends AppCompatActivity {
    private String className="MainActivity";
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
        Button writeToNFC=(Button)findViewById(R.id.writeToNFC);
        ctx=this;


    }
    /**
     * Register NFC
     */
    public void registerNFCToAndroid(){

        adapter = NfcAdapter.getDefaultAdapter(this);
        pendingIntent = PendingIntent.getActivity(this, 0, new Intent(this, getClass()).addFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP), 0);
        IntentFilter tagDetected = new IntentFilter(NfcAdapter.ACTION_TAG_DISCOVERED);
        tagDetected.addCategory(Intent.CATEGORY_DEFAULT);
        writeTagFilters = new IntentFilter[] { tagDetected };
    }
    public void writeToNFCClick(View v){

        Button b=(Button)v;

        Log.d(className,"Button Clicked:"+b.getText());
        TextView uniqueId=(TextView)findViewById(R.id.uniqueId);
        TextView name=(TextView)findViewById(R.id.name);
        TextView number=(TextView)findViewById(R.id.number);
        String data=uniqueId.getText()+"|"+name.getText()+"|"+number.getText();
        Log.d(className,"data: "+data);
        Log.d(className,"size: "+data.length());
        try {
            if(mytag==null){
                Toast.makeText(ctx, "Error: No NFC Detected", Toast.LENGTH_LONG ).show();
            }else{
                write(data,mytag);
                Toast.makeText(ctx, "Successfully Written ", Toast.LENGTH_LONG ).show();
            }
        } catch (IOException e) {
            Log.d(className,e.getMessage());
            Toast.makeText(ctx, "Error: code 1", Toast.LENGTH_LONG ).show();
            e.printStackTrace();
        } catch (FormatException e) {
            Log.d(className,e.getMessage());
            Toast.makeText(ctx, "Error: code 2" , Toast.LENGTH_LONG ).show();
            e.printStackTrace();
        }
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
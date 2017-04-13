package com.example.abhishek.vehisafe;

import android.Manifest;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.os.Build;
import android.os.Bundle;
import android.os.Parcelable;
import android.support.annotation.NonNull;
import android.support.annotation.RequiresApi;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v4.widget.TextViewCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.List;
import java.util.Locale;

public class NFC_Handler extends AppCompatActivity {

    private static String emergencyName = null;
    private static String emergencyPhone = null;
    private static String UID = null;
    private static String payload = null;
    private static Location location = null;
    private static boolean auth=false;
    private FirebaseAuth mAuth;
    private FirebaseAuth.AuthStateListener mAuthListener;
    private FirebaseUser user=null;
    private Context context;
    List<Address> address = null;

    @Override
    protected void onStart(){
        super.onStart();
        mAuth.addAuthStateListener(mAuthListener);
    }
    @Override
    protected void onStop(){
        super.onStop();
        mAuth.removeAuthStateListener(mAuthListener);
    }
    @RequiresApi(api = Build.VERSION_CODES.M)
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nfc__handler);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setVisibility(View.INVISIBLE);
        context=this;
        mAuth = FirebaseAuth.getInstance();
        mAuthListener=new FirebaseAuth.AuthStateListener() {
            @Override
            public void onAuthStateChanged(@NonNull FirebaseAuth firebaseAuth) {
                Log.d("Listener working","Authstate" + firebaseAuth.getCurrentUser().getDisplayName());
                user=firebaseAuth.getCurrentUser();
                if(user!=null){
                    displaySuccess();
                    sendData();
                }
                else{
                    displayFail();
                    Intent startIntent=new Intent(getApplicationContext(),MainActivity.class);
                    getApplicationContext().startActivity(startIntent);
                }
            }
        };
        ReadNFCData(this.getIntent());
        getGPS();
        sendData();
        fab.setVisibility(View.VISIBLE);
        //        PrintData("Latitude" + location.getLatitude() + "Longitude" + location.getLongitude());
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(final View view) {
                //
                new AlertDialog.Builder(view.getContext())
                        .setTitle("Place a call?")
                        .setMessage("Are you sure you want to place a call?")
                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                                // continue with delete
                                Intent intent = new Intent(Intent.ACTION_CALL);
                                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

                                intent.setData(Uri.parse("tel:" + emergencyPhone));
                                if (ActivityCompat.checkSelfPermission(view.getContext(), Manifest.permission.CALL_PHONE) != PackageManager.PERMISSION_GRANTED) {
                                    // TODO: Consider calling
                                    //    ActivityCompat#requestPermissions
                                    // here to request the missing permissions, and then overriding
                                    //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
                                    //                                          int[] grantResults)
                                    // to handle the case where the user grants the permission. See the documentation
                                    // for ActivityCompat#requestPermissions for more details.
                                    return;
                                }
                                view.getContext().startActivity(intent);
                            }
                        })
                        .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                            }
                        })
                        .setIcon(android.R.drawable.ic_dialog_alert)
                        .show();

            }
        });


    }

    private void displayFail() {
        Log.d("Dispfail", "Failde User= ");
    }



    private void displaySuccess() {
        Log.d("DIspsuccess","USer "+user.getDisplayName());
        TextView tv =(TextView)findViewById(R.id.info_text);
        tv.setText("Welcome user: "+user.getDisplayName()+"\n Emergency Contact Name: "+emergencyName+"\n Emergency phone: "+emergencyPhone);
    }



    @RequiresApi(api = Build.VERSION_CODES.M)
    private void getGPS() {
        final LocationManager locManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
//        requestPermissions(new String[]{Manifest.permission.ACCESS_FINE_LOCATION},1337);
        ContextCompat.checkSelfPermission(this,Manifest.permission.ACCESS_FINE_LOCATION);
        location = locManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        location = locManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
        if(location==null)
        {
            location=locManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
        }
        if(location==null){
            location=locManager.getLastKnownLocation(LocationManager.PASSIVE_PROVIDER);
        }

        }


    private void PrintData(String s)
    {
//        Snackbar.make(findViewById(R.id.content_nfc__handler), s, Snackbar.LENGTH_LONG)
//                .setAction("Action", null).show();
        Log.v("LOG Value",s);
    }
    private void ReadNFCData(Intent intent) {
        Parcelable[] rawMessages =
                intent.getParcelableArrayExtra(NfcAdapter.EXTRA_NDEF_MESSAGES);
        if (rawMessages != null) {
            NdefMessage[] messages = new NdefMessage[rawMessages.length];
            for (int i = 0; i < rawMessages.length; i++) {
                messages[i] = (NdefMessage) rawMessages[i];
                NdefRecord[] record = messages[i].getRecords();

                try {
                    payload = new String(record[i].getPayload(),"US-ASCII");
                } catch (UnsupportedEncodingException e) {
                    e.printStackTrace();
                }
                PrintData("Payload : "+ payload);
                ExtractFields();
            }}
    }

    private void ExtractFields() {
        String[] temp=payload.split("\\|");
        UID=temp[0].replace("en","");
        emergencyName=temp[1];
        emergencyPhone=temp[2];
        PrintData(UID+emergencyName+emergencyPhone);
    }
    private void sendData() {
        String Pdata= new String("User: "+emergencyName+"\nEmergency Contact: "+emergencyPhone+"\nUnique ID: "+UID);
        String latt=""+location.getLatitude();
        String longtitude=""+location.getLongitude();
        JsonPostRequest jp= (JsonPostRequest) new JsonPostRequest().execute("1",latt,longtitude,UID);
        Log.d("SS","sss");

    }


}

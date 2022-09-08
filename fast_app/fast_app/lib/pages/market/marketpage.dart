import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'dart:typed_data';

import 'dart:convert';
import 'dart:math';

import 'package:device_info/device_info.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/gestures.dart';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:path_provider/path_provider.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'package:webview_flutter_plus/webview_flutter_plus.dart';

import 'package:fastapp/pages/analysis/analysispage.dart';
import 'package:fastapp/pages/market/marketpage.dart';
import 'package:fastapp/pages/forex/forexpage.dart';
import 'package:fastapp/pages/login/loginpage.dart';
import 'package:fastapp/pages/crypto/cryptopage.dart';
import 'package:fastapp/pages/tmessage/tmessagepage.dart';
import 'package:fastapp/pages/closedsignal/closedsignalpage.dart';
import 'package:fastapp/pages/profile/profilepage.dart';
import 'package:fastapp/pages/home/homepage.dart';


import 'package:flutter/services.dart';
import 'package:provider/provider.dart';

import 'package:http/http.dart' as http;



class MarketPage extends StatelessWidget {

  dynamic email = '';

  double  _drawerIconSize = 24;
  double _drawerFontSize = 17;


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(

        title: Text("Market"),
        elevation: 0.5,
        //iconTheme: IconThemeData(color: Colors.white),
        flexibleSpace:Container(
          decoration: BoxDecoration(
              gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: <Color>[Color.fromRGBO(39, 50, 80, 1), Theme.of(context).accentColor,]
              )
          ),
        ),
        actions: [

        ],
      ),

      drawer: Drawer(
        child: Container(
          decoration:BoxDecoration(
              gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  stops: [0.0, 1.0],
                  colors: [
                    Color.fromRGBO(39, 50, 80, 1).withOpacity(0.2),
                    Color.fromRGBO(39, 50, 80, 1).withOpacity(0.5),
                  ]
              )
          ) ,
          child: ListView(
            children: [
              DrawerHeader(

                decoration: BoxDecoration(
                  image: DecorationImage(
                    image: AssetImage('assets/images/android-drawer-bg.jpeg'),
                    fit: BoxFit.fill,
                  ),
                  color: Color.fromRGBO(97, 201, 200, 1),
                  gradient: LinearGradient(
                    begin: Alignment.topLeft,
                    end: Alignment.bottomRight,
                    stops: [0.0, 1.0],
                    colors: [ Color.fromRGBO(39, 50, 80, 1),Theme.of(context).accentColor,],
                  ),
                ),
                child: Container(
                  alignment: Alignment.bottomLeft,
                  child: Text("FAST\n\nFinancial Analysis Systems for Trading",
                    style: TextStyle(fontSize: 16,color: Colors.white, fontWeight: FontWeight.bold),
                  ),
                ),
              ),

              ListTile(
                leading: Icon(Icons.dashboard, size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Dashboard',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),

              Divider(color: Theme.of(context).primaryColor, height: 1,),
              ListTile(
                leading: Icon(Icons.attach_money_outlined, size: _drawerIconSize, color: Theme.of(context).accentColor,),
                title: Text('Market', style: TextStyle(fontSize: 17, color: Color.fromRGBO(98, 108, 139, 1)),),
                onTap: (){
                  Navigator.push(context, MaterialPageRoute(builder: (context) => MarketPage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_wifi_4_bar_outlined, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Active Forex Signals',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),

                onTap: () async {

                  SharedPreferences prefs = await SharedPreferences.getInstance();

                  if ((prefs.getString("email") == null) || (prefs.getString("email") == '')) {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => LoginPage()),);
                  } else {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => ForexPage()),);
                  }
                },

              ),


              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_cellular_alt, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Active Crypto Signals',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),

                onTap: () async {

                  SharedPreferences prefs = await SharedPreferences.getInstance();

                  if ((prefs.getString("email") == null) || (prefs.getString("email") == '')) {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => LoginPage()),);
                  } else {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => CryptoPage()),);
                  }
                },

              ),


              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_cellular_no_sim_rounded,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Closed Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => ClosedsignalPage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),


              ListTile(
                leading: Icon(Icons.batch_prediction,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Analysis', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => AnalysisPage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.bar_chart, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Trader\'s Messages',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),

                onTap: () async {

                  SharedPreferences prefs = await SharedPreferences.getInstance();

                  if ((prefs.getString("email") == null) || (prefs.getString("email") == '')) {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => LoginPage()),);
                  } else {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => TmessagePage()),);
                  }
                },

              ),

              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.account_box_outlined, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('My Profile',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),

                onTap: () async {

                  SharedPreferences prefs = await SharedPreferences.getInstance();

                  if ((prefs.getString("email") == null) || (prefs.getString("email") == '')) {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => LoginPage()),);
                  } else {

                    Navigator.push(context, MaterialPageRoute(builder: (context) => ProfilePage()),);
                  }
                },

              ),

            ],
          ),
        ),
      ),

      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),


        child: Container(
          color: Colors.white,
          height: MediaQuery.of(context).size.height,
          child: Column(
            children: [
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: Container(
                  color: Color.fromRGBO(98, 108, 139, 1),
                  width: MediaQuery.of(context).size.width,
                  height: MediaQuery.of(context).size.height * 0.4,
                  child: WebViewPlus(
                    zoomEnabled: true,
                    gestureNavigationEnabled: true,
                    javascriptMode: JavascriptMode.unrestricted,
                    onWebViewCreated: (controller){
                      controller.loadUrl('assets/files/market1.html');
                    },
                  ),


                ),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: Container(
                  width: MediaQuery.of(context).size.width,
                  height: MediaQuery.of(context).size.height * 0.4,
                  color: Color.fromRGBO(98, 108, 139, 1),
                  child:WebViewPlus(
                    zoomEnabled: true,
                    javascriptMode: JavascriptMode.unrestricted,
                    onWebViewCreated: (controller){
                      controller.loadUrl('assets/files/market2.html');
                    },
                  ),

                ),
              ),
            ],
          ),
        ),





      ),
    );
  }

  Future<void> loadHtmlfromAssets(String filename,  controller)async {
    String filetext = await rootBundle.loadString(filename);
    controller.loadUrl(Uri.dataFromString(filetext,mimeType: 'text/html', encoding:Encoding.getByName('utf-8')).toString());
  }

}

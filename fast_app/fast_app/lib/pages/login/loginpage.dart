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
import 'package:modal_progress_hud_nsn/modal_progress_hud_nsn.dart';
import 'package:onesignal_flutter/onesignal_flutter.dart';
import 'package:path_provider/path_provider.dart';

import 'package:webview_flutter_plus/webview_flutter_plus.dart';

import 'package:firebase_messaging/firebase_messaging.dart';

import 'package:fastapp/pages/analysis/analysispage.dart';
import 'package:fastapp/pages/market/marketpage.dart';
import 'package:fastapp/pages/forex/forexpage.dart';
import 'package:fastapp/pages/crypto/cryptopage.dart';
import 'package:fastapp/pages/tmessage/tmessagepage.dart';
import 'package:fastapp/pages/closedsignal/closedsignalpage.dart';
import 'package:fastapp/pages/home/homepage.dart';
import 'package:fastapp/pages/theme_helper.dart';
import 'package:fastapp/pages/header_widget.dart';

import 'package:device_info/device_info.dart';

import 'package:http/http.dart' as http;

import 'package:shared_preferences/shared_preferences.dart';

import 'package:firebase_core/firebase_core.dart';


class LoginPage extends StatefulWidget{
  const LoginPage({Key? key}): super(key:key);

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage>{

  final DeviceInfoPlugin deviceInfo = DeviceInfoPlugin();

  getModel() async {

    if (Platform.isAndroid) {
      AndroidDeviceInfo androidInfo = await deviceInfo.androidInfo;
      
      deviceid=androidInfo.model;

     // String? dtoken = await FirebaseMessaging.instance.getToken();

      //print(dtoken);

      print(androidInfo.model);
    } else if (Platform.isIOS) {
      IosDeviceInfo iosInfo = await deviceInfo.iosInfo;
      print(iosInfo.utsname.machine);
      deviceid=iosInfo.utsname.machine;

    }

    WidgetsFlutterBinding.ensureInitialized();

    OneSignal.shared.setAppId('5db9b19b-f857-4806-b304-14b2efd45ebc');

    OneSignal.shared.getDeviceState().then((deviceState) {
      print("OneSignal: device state: ${deviceState!.jsonRepresentation()}");

      playerId = deviceState.userId !;

      print('Howdy, $playerId!');

    });

    OneSignal.shared.setPermissionObserver((OSPermissionStateChanges changes) {
      // will be called whenever the permission changes

      if (changes.to.status == OSNotificationPermission.authorized) {
        //tells you that the user has fully authorized push permissions
      }
    });

  }

  double  _drawerIconSize = 24;
  double _drawerFontSize = 17;

  double _headerHeight = 250;
  Key _formKey = GlobalKey<FormState>();

  static const String ROOT="https://appadmin1.xyz/api/login";

  late String email, password, deviceid, dtoken, playerId;

  bool isLoading=false;

  TextEditingController _emailController=new TextEditingController();

  TextEditingController _passwordController=new TextEditingController();

  GlobalKey<ScaffoldState>_scaffoldKey=GlobalKey();

  late ScaffoldMessengerState scaffoldMessenger ;

  TextStyle style = TextStyle(fontFamily: 'Montserrat', fontSize: 20.0);

  @override
  void initState() {
    getModel();
    super.initState();

  }

  @override
  Widget build(BuildContext context) {

    scaffoldMessenger = ScaffoldMessenger.of(context);

    return Scaffold(
      backgroundColor: Colors.white,

      appBar: AppBar(

        title: Text("Login"),
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
                leading: Icon(Icons.signal_wifi_4_bar_outlined,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Active Forex Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => ForexPage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_cellular_alt,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Active Crypto Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => CryptoPage()),);
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
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => TmessagePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.logout_rounded, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Login',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),
                onTap: () {
                  //SystemNavigator.pop();
                  Navigator.push(context, MaterialPageRoute(builder: (context) => LoginPage()),);
                },
              ),
            ],
          ),
        ),
      ),

      body: ModalProgressHUD(
      inAsyncCall:isLoading,
        child: SingleChildScrollView(
          child: Column(
            children: [
              Container(
                height: _headerHeight,
                child: HeaderWidget(_headerHeight, true, Icons.login_rounded), //let's create a common header widget
              ),
              SafeArea(
                child: Container(
                    padding: EdgeInsets.fromLTRB(20, 10, 20, 10),
                    margin: EdgeInsets.fromLTRB(20, 10, 20, 10),// This will be the login form
                    child: Column(
                      children: [
                        Text(
                          'FAST',
                          style: TextStyle(fontSize: 60, fontWeight: FontWeight.bold),
                        ),
                        Text(
                          'Financial Analysis Systems for Trading',
                          style: TextStyle(color: Colors.grey),
                        ),
                        SizedBox(height: 30.0),
                        Form(
                            key: _formKey,
                            child: Column(
                              children: [
                                Container(
                                  child: TextField(
                                    decoration: ThemeHelper().textInputDecoration('Email', 'Enter your email'),
                                    controller: _emailController,
                                  ),
                                  decoration: ThemeHelper().inputBoxDecorationShaddow(),

                                ),
                                SizedBox(height: 30.0),
                                Container(
                                  child: TextField(
                                    obscureText: true,
                                    decoration: ThemeHelper().textInputDecoration('Password', 'Enter your password'),
                                    controller: _passwordController,

                                  ),
                                  decoration: ThemeHelper().inputBoxDecorationShaddow(),
                                ),
                                SizedBox(height: 25.0),

                                Container(
                                  decoration: ThemeHelper().buttonBoxDecoration(context),
                                  child: ElevatedButton(
                                    style: ThemeHelper().buttonStyle(),
                                    child: Padding(
                                      padding: EdgeInsets.fromLTRB(40, 10, 40, 10),
                                      child: Text('Sign In'.toUpperCase(), style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Colors.white),),
                                    ),
                                    onPressed: (){
                                      //After successful login we will redirect to profile page. Let's create profile page now
                                      //Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) => ProfilePage()));

                                      login(_emailController.text,_passwordController.text, deviceid, playerId);
                                      setState(() {
                                        isLoading=true;
                                      });

                                    },
                                  ),
                                ),

                              ],
                            )
                        ),
                      ],
                    )
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  login(email,password, deviceid,playerId) async
  {
setState(() {
  isLoading=true;
});
    Map data = {
      'email': email,
      'password': password,
      'device_key': deviceid,
      'playerId': playerId,

    };

    print(data.toString());

    final  responsebody= await http.post(
        Uri.parse(ROOT),
        headers: {
          "User-Agent":deviceid,
          "Accept": "application/json",
          "Content-Type": "application/x-www-form-urlencoded"
        },

        body: data,
        encoding: Encoding.getByName("utf-8")
    )  ;
    setState(() {
      isLoading=false;
    });
    print(responsebody.body.toString());
    Map<String,dynamic>resposne=jsonDecode(responsebody.body);
    if (responsebody.statusCode == 200) {

      print(resposne.toString());

        Map<String,dynamic>user=resposne['data'];
        print(" User name ${user['id']}");
        savePref(user['id'].toString(),user['name'],user['email'],user['isLoggedIn'].toString(),user['token'].toString());
        //Navigator.pushReplacementNamed(context, "/home");

        Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) => HomePage()));


      // scaffoldMessenger.showSnackBar(SnackBar(content:Text("${resposne['message']}")));

    } else {
      scaffoldMessenger.showSnackBar(SnackBar(content:Text(resposne['message'].toString())));
    }


  }
  savePref(String id, String name, String email, String isLoggedIn,String tokken) async {

    SharedPreferences preferences = await SharedPreferences.getInstance();
   print(tokken);
    preferences.setString("id", id.toString());
    preferences.setString("name", name.toString());
    preferences.setString("email", email.toString());
    preferences.setString("tokken", tokken.toString());

    preferences.setString("isLoggedIn", isLoggedIn.toString());
    preferences.commit();

  }

}

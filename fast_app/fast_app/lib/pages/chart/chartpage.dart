import 'package:flutter/material.dart';
import 'package:fastapp/pages/home/homepage.dart';
import 'package:fastapp/pages/analysis/analysispage.dart';

import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';

import 'package:http/http.dart' as http;

import 'package:shared_preferences/shared_preferences.dart';


class ChartPage extends StatefulWidget {

  //const ChartPage({Key? key}) : super(key: key);

  @override
  State<ChartPage> createState() => _ChartPageState();
}

class _ChartPageState extends State<ChartPage> {

  double  _drawerIconSize = 24;

  double _drawerFontSize = 17;

  @override
  Widget build(BuildContext context) {


    return Scaffold(
      appBar: AppBar(

        title: Text('Trader\'s Messages'),
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
                  child: Text("FAST Trading App",
                    style: TextStyle(fontSize: 25,color: Colors.white, fontWeight: FontWeight.bold),
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
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_wifi_4_bar_outlined,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Active Forex Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_cellular_alt,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Active Crypto Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.signal_cellular_no_sim_rounded,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Closed Signals', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),


              ListTile(
                leading: Icon(Icons.batch_prediction,size: _drawerIconSize,color: Theme.of(context).accentColor),
                title: Text('Analysis', style: TextStyle(fontSize: _drawerFontSize, color: Color.fromRGBO(98, 108, 139, 1)),
                ),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.bar_chart, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Trader\'s Messages',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => ChartPage()),);
                },
              ),
              Divider(color: Theme.of(context).primaryColor, height: 1,),

              ListTile(
                leading: Icon(Icons.logout_rounded, size: _drawerIconSize,color: Theme.of(context).accentColor,),
                title: Text('Login',style: TextStyle(fontSize: _drawerFontSize,color: Color.fromRGBO(98, 108, 139, 1)),),
                onTap: () {
                  //SystemNavigator.pop();
                  Navigator.push(context, MaterialPageRoute(builder: (context) => HomePage()),);
                },
              ),
            ],
          ),
        ),
      ),


      body: Container(

     ),
    );
  }
}

import 'package:fastapp/pages/home/homepage.dart';
import 'package:fastapp/utils/constants.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:onesignal_flutter/onesignal_flutter.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<void> main() async {

  WidgetsFlutterBinding.ensureInitialized();
  Firebase.initializeApp();

  OneSignal.shared.setAppId('5db9b19b-f857-4806-b304-14b2efd45ebc');

  OneSignal.shared.setNotificationWillShowInForegroundHandler((OSNotificationReceivedEvent event) {
    /// Display Notification, send null to not display, send notification to display
    event.complete(event.notification);
  });

  SharedPreferences prefs = await SharedPreferences.getInstance();
  var email = prefs.getString('isLoggedIn');
  print(email);

  runApp(MyApp());

}




class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return ScreenUtilInit(
      designSize: Size(375, 812),
      builder: () {
        return MaterialApp(
          debugShowCheckedModeBanner: false,
          title: "FAST\n\nFinancial Analysis Systems for Trading",
          themeMode: ThemeMode.dark,
          darkTheme: ThemeData(
            visualDensity: VisualDensity.adaptivePlatformDensity,
            textTheme: GoogleFonts.poppinsTextTheme().copyWith(
              caption: TextStyle(
                color: kCaptionColor,
                fontSize: 16.0,
              ),
            ),
            scaffoldBackgroundColor: kPrimaryColor,
            appBarTheme: AppBarTheme(
              elevation: 0.0,
              color: kPrimaryColor,
            ),
          ),
          home: HomePage(),
        );
      },
    );
  }
}

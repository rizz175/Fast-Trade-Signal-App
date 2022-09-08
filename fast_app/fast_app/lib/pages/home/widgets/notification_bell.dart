import 'package:fastapp/utils/constants.dart';
import 'package:flutter/material.dart';

class NotificationBell extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.only(right: 16.0),
      child: GestureDetector(
        onTap: () {},
        child: Stack(
          alignment: Alignment.topRight,
          children: [

            Container(
              width: 8.0,
              height: 8.0,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: kDangerColor,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

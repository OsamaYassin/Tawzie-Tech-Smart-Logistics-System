

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/DisplaySalesReport.dart';
import 'package:tawzie/screen/DisplaySalesToday.dart';
import 'package:tawzie/screen/add_customer.dart';
import 'package:tawzie/screen/orderProduct.dart';
import 'package:tawzie/screen/pricreProduct.dart';
import 'package:tawzie/screen/productDistribution.dart';
import 'package:tawzie/screen/showmap.dart';
import 'package:tawzie/screen/viewAllCustomer.dart';

import 'home_screen.dart';
// import 'package:tawzie/screen/DisplaySalesReport.dart';
// import 'package:tawzie/screen/add_customer.dart';
// import 'package:tawzie/screen/home_screen.dart';
// import 'package:tawzie/screen/orderProduct.dart';
// import 'package:tawzie/screen/showmap.dart';
// import 'package:tawzie/screen/viewAllCustomer.dart';

class DrawerDesign extends StatefulWidget {

  @override
  _drawerState createState() => _drawerState();

}

class _drawerState extends State<DrawerDesign> {

  var textStyle = TextStyle(fontSize: 17,color: Colors.black, fontFamily: "Almarai",);
  String _userName = "";
  String _email = "";



  @override
  void initState()  {
    // TODO: implement initState
    super.initState();

    loadedLocalSaveData();
  }

  loadedLocalSaveData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _userName =  prefs.getString("username")!;
      _email =  prefs.getString("email")!;

    });
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return  Container(
      color: Colors.white,
      width: 255.0,
      child: Drawer(
        child: ListView(
          children: [
            //Drawer Header
            Container(
              height: 165,
              child: DrawerHeader(
                decoration: BoxDecoration(color: Colors.white),
                child: Column(
                  children: [
                    Image.asset("images/userimg.jpg" ,height: 75, width: 75,),
                    SizedBox(height: 16,width: 16),
                    Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Text(_userName ,style: TextStyle(fontSize: 16,fontFamily: "Almarai"),),
                        SizedBox(height: 6,),
                        // Text("Visit Profile" ,),
                      ],
                    )
                  ],
                ),
              ),
            ),

            SizedBox(height: 16,),

            //Drawer Body

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("الرئيسية" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.home, color: Palette.iconColor,)),
              onTap: (){
                Navigator.pop(context);
                Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );

              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("اسعار المنتجات" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.add_shopping_cart, color: Palette.iconColor,)),
              onTap: (){
                Navigator.push(context,MaterialPageRoute(builder: (context) => ProductPrice()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("طلب المنتج" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.add_shopping_cart, color: Palette.iconColor,)),
                onTap: (){
                  Navigator.push(context,MaterialPageRoute(builder: (context) => OrderProduct()), );
                },
            ),
            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("اضافة العميل" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.add_circle_outline, color: Palette.iconColor, )),
              onTap: (){
               Navigator.push(context,MaterialPageRoute(builder: (context) => AddCustomerScreen()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("نقاط البيع" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.person_pin, color: Palette.iconColor, )),
              onTap: (){
                Navigator.push(context,MaterialPageRoute(builder: (context) => ViewCustomerScreen()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("الخريطة" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.map,  color: Palette.iconColor,)),
              onTap: (){
                Navigator.push(context,MaterialPageRoute(builder: (context) => ShowMapScreen()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("مبيعات اليوم" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.autorenew, color: Palette.iconColor,)),
              onTap: (){
                Navigator.push(context,MaterialPageRoute(builder: (context) => DisplaySalesToday()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("المبيعات" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.autorenew, color: Palette.iconColor,)),
              onTap: (){
                Navigator.push(context,MaterialPageRoute(builder: (context) => DisplaySalesReport()), );
              },
            ),

            ListTile(
              title: Container(
                  alignment: Alignment.centerRight,
                  child: Text("خروج" ,style: textStyle,)),
              trailing: Container(
                  margin: EdgeInsets.only(right: 15),
                  child: Icon(Icons.power_settings_new, color: Palette.iconColor,)),
              onTap: () async {
               //
                showSuccess("خروج من التطبيق");
              },
            ),



          ],
        ),
      ),
    );
  }


  void showSuccess(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(child: Icon(Icons.error, color: Colors.redAccent,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[

            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                TextButton(
                  child: const Text("NO"),
                  onPressed: () async {
                    Navigator.of(context).pop();
                    // Only works on Android.
                  },
                ),

               // SizedBox(width: 50,),
                TextButton(
                  child: const Text("OK"),
                  onPressed: () async {
                    SharedPreferences prefs = await SharedPreferences.getInstance();
                    if(prefs.containsKey("username")) {
                      prefs.remove("distribut_id");
                      prefs.remove("username");
                      prefs.remove("email");
                      prefs.remove("allpoint");
                      prefs.remove("yesvisit");
                      prefs.remove("allpoint");
                      SystemNavigator.pop();
                    }// Only works on Android.
                  },
                ),


              ],
            ),


          ],
        );
      },
    );
  }


}



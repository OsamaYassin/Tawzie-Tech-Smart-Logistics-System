import 'dart:convert';
import 'dart:math';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/providers/cards1.dart';
import 'package:tawzie/providers/orders.dart';
import 'package:tawzie/providers/products.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:http/http.dart' as http;
import '../config/getSetData.dart';
import '../configUrl.dart';
import '../models/card1.dart';
import '../widgets/card_widget.dart';
import 'home_screen.dart';

class OrderDetails extends StatefulWidget {
  @override
  _OrderDetailsState createState() => _OrderDetailsState();
}

class _OrderDetailsState extends State<OrderDetails> {


  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();


  List listOrdered = [];



  getOrdered() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();

    final String myString =
    await sharedPreferences.getString('orderedProducts')!;
    setState(() {
      listOrdered = json.decode(myString);
    });

  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    getOrdered();
  }






  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: scaffoldKey,
      endDrawer: DrawerDesign(),
      appBar: AppBar(
        title: Text(
          "طلب المنتجات  ",
          style: TextStyle(
              color: Colors.white,
              fontSize: 20,
              fontFamily: "Almarai",
              fontWeight: FontWeight.bold),
        ),
        backgroundColor: Palette.mycolor,
        centerTitle: true,
      ),
      body:
           Directionality(
                textDirection: TextDirection.rtl,
                child:  ListView.builder(
                      itemCount: listOrdered.length,
                      itemBuilder: (context, i) {
                        return PaymentMethods(
                            listOrdered[i]["name"].toString(),
                            listOrdered[i]["quantity"].toString());
                      }),
                ),
    );
  }
  PaymentMethods(String name, String quantity) {
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        width: double.maxFinite,
        height: 90,
        padding: EdgeInsets.only(top: 10, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart
            Row(
              children: [Text("اسم المنتج"), Text(" : "), Text(name)],
            ),
            Row(
              children: [Text("الكمية المأخوذة "), Text(" : "), Text(quantity)],
            )
          ],
        ),
      ),
    );
  }

}

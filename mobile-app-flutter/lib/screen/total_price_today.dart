
import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:location/location.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/configUrl.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/screen/showmap.dart';
import '../config/getSetData.dart';
import '../widgets/ProgressDialog.dart';


class TotalPriceWorkDay extends StatefulWidget {
  @override
  _TotalPriceWorkDayState createState() => _TotalPriceWorkDayState();
}

class _TotalPriceWorkDayState extends State<TotalPriceWorkDay> {

  String getCurrentTime = DateFormat("yyyy-MM-dd").format(DateTime.now());

  //var sizeWidth =MediaQuery.of(context).size.width;
  //ONclick in mune icon dsplay mune
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState> ();
  var textStyle = TextStyle(fontSize: 20,color: Colors.black, fontFamily: "Almarai",);

  String cash = "0";
  String bnkakk = "0";
  String sheak = "0";
  String agel = "0";
  String dateToday = "000-00-00";
  String remander = "0";
  String totalDay = "0";


  @override
  void initState()  {
    // TODO: implement initState
    super.initState();

    /**************************************************
     *  if SharedPreferences Have not any of this go to database and get data count of point and visit yes
     ******************************************/
   // displayReportSalesToday();
    DisplayPriceToday();
  }

  void ShowPreLoad(BuildContext context) {

    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
    );
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: scaffoldKey,
      endDrawer:DrawerDesign(),
      appBar: AppBar(
        title: Text(
          " اجمالي المبيعات  ",
          style: TextStyle(
              color: Colors.white,
              fontSize: 20,
              fontFamily: "Almarai",
              fontWeight: FontWeight.bold),
        ),
        backgroundColor: Palette.mycolor,
        centerTitle: true,
      ),
      body: Container(
        child: SingleChildScrollView(
          child: Column(
            children: [

              SizedBox(height: 20,),
              _buildFirstCard("$totalDay" ),

           Container(
            height:  650,
            child: GridView.count(
              padding: EdgeInsets.all(0),

              mainAxisSpacing: 0,
              crossAxisSpacing: 1,
              crossAxisCount: 2,
              children: [

                _cardPriceDesgin("كاش" , "$cash"  , Colors.lightBlue),
                _cardPriceDesgin("بنكك" , "$bnkakk"  , Colors.lightBlue),
                _cardPriceDesgin("أجل" , "$agel"  , Colors.lightBlue),
                _cardPriceDesgin("شيك" , "$sheak"  , Colors.lightBlue),
                _cardPriceDesgin("اليوم" , "$dateToday"  , Colors.black26),
                _cardPriceDesgin("تحصيل" , "$remander"  , Colors.lightBlue),

                SizedBox(height: 20,)
              ],
            ),
          ),


              SizedBox(height: 10,),
             // _buildThreetCard(),


            ],
          ),
        ),
      ),
    );
  }


  Future<void> DisplayPriceToday() async {
    Future.delayed(Duration.zero, () => ShowPreLoad(context));
    //Show Dialog)
    //   showDialog(
    //     barrierDismissible: false,
    //     context: context,
    //     builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
    // );

    //check network availabilty
    // var connectivityResult = await Connectivity().checkConnectivity();
    // if(connectivityResult != ConnectivityResult.mobile && connectivityResult != ConnectivityResult.wifi  ){
    //  // showError("لا يوجد اتصال بالانترنت");
    //   //showSnackBar('لا يوجد اتصال بالانترنت');
    //   print("لا يوجد اتصال بالانترنت");
    //   return ;
    // }

    //-today

    print("---***************---");

    DateTime todays = DateTime.now();
    String datetoyear = todays.year.toString();
    String datetomonth = todays.month.toString();
    String datetoday = todays.day.toString();
     var url = dbUrl + "total-work-today";
    var dataStore = {
      "distributer_id": distribut_id,
      "year":  datetoyear,
      "months":datetomonth ,
      "day":  datetoday , // datetoday ,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['ShowSalesReport'];

      print("---------------------------------------");
      print(getDataInfo);
      setState(() {
          totalDay =   getDataInfo[0]['s_total_price'].toString();
        cash =   getDataInfo[0]['s_chash'].toString();
        bnkakk =   getDataInfo[0]['s_banckk'].toString();
        sheak =   getDataInfo[0]['s_sheck'].toString();
        agel =   getDataInfo[0]['s_agel'].toString();
        remander =   getDataInfo[0]['created_at'].toString();
        dateToday =datetoyear+'-'+datetomonth +'-'+datetoday;

        Navigator.pop(context);
      });


    } else {
      //showError("معلومات اضافة خطأ!!");
      //  return ;
    }

    // return ;
  }


  void AlertshowMessage(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(child: Icon(Icons.new_releases, color: Colors.lightBlue,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[

            MaterialButton(
              child: const Text("NO"),
              onPressed: () async {
                Navigator.of(context).pop();
                // Only works on Android.
              },
            ),
            SizedBox(width: 100,),
            MaterialButton(
              child: const Text("OK"),
              onPressed: ()  {
                //Function code here

              },
            ),


          ],
        );
      },
    );
  }

  void showError(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(child: Icon(Icons.error, color: Colors.redAccent,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[
            MaterialButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                return ;
                //Navigator.push(context,MaterialPageRoute(builder: (context) => TotalPriceWorkDay()), );
              },
            ),
          ],
        );
      },
    );
  }

  void showSuccess(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(child: Icon(Icons.verified_user, color: Colors.green,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[
            MaterialButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                return ;
                // Navigator.of(context).pop();
                //Navigator.push(context,MaterialPageRoute(builder: (context) => TotalPriceWorkDay()), );
              },
            ),
          ],
        );
      },
    );
  }




}



Widget _buildFirstCard(String totalPrice ) {
  return Card(
    elevation: 4.0,
    shadowColor: Colors.blueAccent,
    color: Colors.white,
    margin: EdgeInsets.all(10),
    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
    child: Container(
      height: 100,
      padding: EdgeInsets.only(top: 20, left: 20, right: 30),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [

              Container(
                padding: EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: Colors.blue,
                  borderRadius: BorderRadius.circular(10.0),
                ),
                child: Image.asset("images/linechart.png"),
              ),

              Column(
                children: [
                  Text(
                    "اجمالي  اليوم",
                    style: TextStyle(color: Colors.blueAccent, fontFamily: "Almarai",fontSize: 18, fontWeight: FontWeight.bold),
                  ),
                  SizedBox(height: 10,),
                  Text(totalPrice,
                      style: TextStyle(
                          color: Colors.black87,
                          fontSize: 25,
                          fontWeight: FontWeight.bold)),
                ],
              ),

            ],
          ),
        ],
      ),
    ),
  );
}



Widget _cardPriceDesgin(String name , String numbers , Color myclor){
  return   Card(
    elevation: 4.0,
    shadowColor: Colors.blueAccent,
    color: Colors.white,
    margin: EdgeInsets.all(10),
    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
    child: Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Container(
          width: 100,
          padding: EdgeInsets.all(15),
          decoration: BoxDecoration(
            color: myclor,
            borderRadius: BorderRadius.circular(50.0),
          ),
          child: Center(
            child: Text("$name" , style: TextStyle(
                color: Colors.white,fontFamily: "Almarai",fontSize: 18, fontWeight: FontWeight.bold)),
          ),
        ),
        SizedBox(height: 5,),

        SizedBox(height: 5,),
        Text("$numbers" , style: TextStyle(
            color: Colors.black87,
            fontSize: 15, fontWeight: FontWeight.bold)),
      ],
    ),
  );
}






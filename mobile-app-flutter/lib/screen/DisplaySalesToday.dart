import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/customerLocation.dart';
import 'package:tawzie/screen/drawer_design.dart';

import 'package:tawzie/widgets/ProgressDialog.dart';
import '../configUrl.dart';

class DisplaySalesToday extends StatefulWidget {
  const DisplaySalesToday();
  @override
  _DisplaySalesTodayState createState() => _DisplaySalesTodayState();
}

class _DisplaySalesTodayState extends State<DisplaySalesToday> {
  List _myList = [];


  late String codeDialog;
  late String valueText;



  TextEditingController yearController = TextEditingController();
  TextEditingController monthController = TextEditingController();
  TextEditingController dayController = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();

    displayAllPintsToday();
    setDate();
  }

  void setDate(){

    DateTime todays = DateTime.now();
    String datetoyear = todays.year.toString();
    String datetomonth = todays.month.toString();
    String datetoday = todays.day.toString();//"${today.day}-${today.month}-${today.year}";

    yearController.text=datetoyear;
    monthController.text = datetomonth;
    dayController.text = datetoday;

  }

  void ShowPreLoad(BuildContext context) {
    showDialog(
            barrierDismissible: false,
            context: context,
            builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
        );
  }

  var _selected ="";

  var _formKey = GlobalKey<FormState>();
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {

    return Scaffold(
        key: scaffoldKey,
        endDrawer: DrawerDesign(),
        appBar: AppBar(
          title: Text(
            " مبيعات اليوم",
            style: TextStyle(
                color: Colors.white,
                fontSize: 20,
                fontFamily: "Almarai",
                fontWeight: FontWeight.bold),
          ),
          backgroundColor: Palette.mycolor,
          centerTitle: true,
        ),

        floatingActionButton: Container(
          margin: EdgeInsets.only(left: 23),
          child: Align(
            alignment: Alignment.bottomLeft,
            child: FloatingActionButton(
              child: Icon(Icons.search, color: Colors.white),
              onPressed: (){

                _displayTextInputDialog(context);
               // _displayDialog(context);

                print("================");
               // SearchItmes("message");
               /* LatLng newlatlang = LatLng(double.parse(latitude),  double.parse(longitude));
                mapController?.animateCamera(
                    CameraUpdate.newCameraPosition(
                        CameraPosition(target: newlatlang, zoom: 17)
                      //17 is new zoom level
                    )
                );*/
                //move position of map camera to new location
              },
            ),
          ),
        ),
        body: ListView.builder(
            itemCount: _myList.length,
            itemBuilder: (context, index) {
              return Card(
                elevation: 0,
                child: Container(
                  height: 120,
                  child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      // textDirection: TextDirection.ltr,
                      children: [
                        Container(
                          height: 80,
                          child: ListTile(
                            title: Row(
                              crossAxisAlignment: CrossAxisAlignment.center,
                              mainAxisAlignment: MainAxisAlignment.end,
                              children: [
                                Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.end,
                                  children: [
                                    Container(
                                        width:
                                            MediaQuery.of(context).size.width /
                                                1.5,
                                        child: Row(
                                          mainAxisAlignment:
                                              MainAxisAlignment.spaceBetween,
                                          children: [
                                            Text(
                                              _myList[index]["total_price"]
                                                      .toString() +
                                                  " ج ",
                                              style: TextStyle(
                                                  fontSize: 16,
                                                  fontFamily: "Almarai",
                                                  color: Colors.deepOrange,
                                                  fontWeight: FontWeight.bold),
                                              textDirection: TextDirection.rtl,
                                            ),
                                            Expanded(
                                              child: Text(
                                                _myList[index]["point_name"],
                                                style: TextStyle(
                                                  fontSize: 14,
                                                  fontFamily: "Almarai",
                                                ),
                                                textDirection:
                                                    TextDirection.rtl,
                                              ),
                                            ),
                                          ],
                                        )),
                                    SizedBox(
                                      height: 25,
                                    ),
                                    Row(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.center,
                                      mainAxisAlignment:
                                          MainAxisAlignment.center,
                                      children: [
                                        Icon(
                                          Icons.calendar_today,
                                          //size: 50,
                                          color: Colors.black26,
                                          textDirection: TextDirection.ltr,
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text(
                                          _myList[index]["year"].toString() +"-"+ _myList[index]["months"].toString() +"-"+ _myList[index]["day"].toString() +" "+ _myList[index]["hour"].toString() ,
                                          style: TextStyle(
                                              fontSize: 15,
                                              fontFamily: "Almarai",
                                              color: Colors.black26),
                                        ),
                                      ],
                                    ),
                                  ],
                                ),
                                Container(
                                    margin: EdgeInsets.only(left: 5),
                                    child: Icon(
                                      Icons.add_shopping_cart,
                                      size: 50,
                                      color: Colors.lightBlue,
                                      textDirection: TextDirection.ltr,
                                    )),
                              ],
                            ),
                            onTap: () {
                              print("==============================");
                              print('fruitDataModel : ' +  _myList[index]["point_name"]);
                              // displayAllPints();
                             // print(_myList);
                              // Navigator.push(context,MaterialPageRoute(builder: (context) =>  CustomerLocation() ), );
                              // Navigator.of(context).push(MaterialPageRoute(builder: (context)=>FruitDetail(fruitDataModel: Fruitdata[index],)));
                            },
                          ),
                        ),
                      ]),
                ),
              );
            }));
  }

  Future<void> displayAllPintsBydate() async {
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
    print(yearController.text);
    var url = dbUrl + "display-sales-report-today/display";
    var dataStore = {
      "distributer_id": distribut_id,
      "year":  yearController.text.toString(),
      "months": monthController.text.toString() ,
      "day":  dayController.text.toString() ,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['ShowSalesReport'];

      print("---------------------------------------");
       print(getDataInfo);
      // showSuccess("تم اضافة بنجاح");

      setState(() {
        _myList = getDataInfo;
        Navigator.pop(context);
      });
    } else {
      //showError("معلومات اضافة خطأ!!");
      //  return ;
    }

    // return ;
  }



  Future<void> displayAllPintsToday() async {
    Future.delayed(Duration.zero, () => ShowPreLoad(context));



    //check network availabilty
    // var connectivityResult = await Connectivity().checkConnectivity();
    // if(connectivityResult != ConnectivityResult.mobile && connectivityResult != ConnectivityResult.wifi  ){
    //  // showError("لا يوجد اتصال بالانترنت");
    //   //showSnackBar('لا يوجد اتصال بالانترنت');
    //   print("لا يوجد اتصال بالانترنت");
    //   return ;
    // }

    //-today

    DateTime todays = DateTime.now();
    String datetoyear = todays.year.toString();
    String datetomonth = todays.month.toString();
    String datetoday = todays.day.toString();

    var url = dbUrl + "display-sales-report-today/display";
    var dataStore = {
      "distributer_id": distribut_id,
      "year":  datetoyear,
      "months": datetomonth ,
      "day": datetoday ,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['ShowSalesReport'];

      print("---------------------------------------");
      print(getDataInfo);
      // showSuccess("تم اضافة بنجاح");

      setState(() {
        _myList = getDataInfo;
        Navigator.pop(context);
      });
    } else {
      //showError("معلومات اضافة خطأ!!");
      //  return ;
    }

    // return ;
  }






  Future<void> _displayTextInputDialog(BuildContext context) async {
    return showDialog(
        context: context,

        builder: (context) {
          return AlertDialog(

            title: Align(
              alignment: Alignment.center,
                child: Text('التاريخ' ,style: TextStyle(fontSize: 16, color: Colors.black87,fontFamily: "Almarai",),)),

            content: Container(
              height: 180,
              child: ListView(
                children: [

                  FormTextFeildDesign("السنة" ,yearController ,TextInputType.phone),
                  SizedBox(height: 15,),
                  FormTextFeildDesign("الشهر" ,monthController ,TextInputType.phone),
                  SizedBox(height: 15,),
                  FormTextFeildDesign("اليوم" ,dayController ,TextInputType.phone),

                ],
              ),
            ),
            actions: <Widget>[
              MaterialButton(
                color: Colors.red,
                textColor: Colors.white,
                child: Text('CANCEL'),
                onPressed: () {
                  setState(() {
                    Navigator.pop(context);
                  });
                },
              ),
              //SizedBox(width: 20,),
              MaterialButton(
                color: Colors.green,
                textColor: Colors.white,
                child: Text('OK'),
                onPressed: () {
                  setState(() {
                    displayAllPintsBydate();
                    Navigator.pop(context);
                  });
                },
              ),
            ],
          );
        });
  }


  Widget FormTextFeildDesign(String namelable , TextEditingController nameController ,TextInputType typeInput){

    return  Container(
      height: 50,
      padding: EdgeInsets.all(0),
      child: Directionality(
        textDirection: TextDirection.rtl,
        child: TextFormField(
          controller: nameController,
          keyboardType: typeInput,
          textAlign: TextAlign.right,
          validator: (var value){
            if(value!.isEmpty)
              return "الرجاء ملء الحقل";
            else
              return null;
          },
          decoration: InputDecoration(
            hintText: namelable,
            labelText:  namelable,
            border: OutlineInputBorder(),
            labelStyle: TextStyle(fontSize: 16, color: Colors.black87,fontFamily: "Almarai",),

          ),
        ),
      ),
    );
  }


  void showSuccess(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(
            child: Icon(
              Icons.verified_user,
              color: Colors.green,
              size: 60,
            ),
          ),
          content: Text(
            message,
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: "Almarai",
            ),
          ),
          actions: <Widget>[
            TextButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                return;
                // Navigator.of(context).pop();
                //Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
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
          title: Container(
            child: Icon(
              Icons.error,
              color: Colors.redAccent,
              size: 60,
            ),
          ),
          content: Text(
            message,
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: "Almarai",
            ),
          ),
          actions: <Widget>[
            TextButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                return;
                //Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
              },
            ),
          ],
        );
      },
    );
  }
}

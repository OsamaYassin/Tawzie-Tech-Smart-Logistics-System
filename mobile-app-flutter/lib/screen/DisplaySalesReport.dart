import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/customerLocation.dart';
import 'package:tawzie/screen/drawer_design.dart';

import '../configUrl.dart';
import '../widgets/ProgressDialog.dart';

class DisplaySalesReport extends StatefulWidget {
  const DisplaySalesReport();
  @override
  _DisplaySalesReportState createState() => _DisplaySalesReportState();
}

class _DisplaySalesReportState extends State<DisplaySalesReport> {

  List _myList = [];


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    displayAllPints();

  }

  void ShowPreLoad(BuildContext context) {
 
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
    );
  }

  var _formKey = GlobalKey<FormState>();
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        key: scaffoldKey,
        endDrawer: DrawerDesign(),
        appBar: AppBar(
          title: Text(
            "    اجمالي الكميات المباعة",
            style: TextStyle(
                color: Colors.white,
                fontSize: 20,
                fontFamily: "Almarai",
                fontWeight: FontWeight.bold),
          ),
          backgroundColor: Palette.mycolor,
          centerTitle: true,
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
                              print('fruitDataModel : ' +
                                  _myList[index]["point_name"]);
                              // displayAllPints();
                              print(_myList);
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

  Future<void> displayAllPints() async {
    Future.delayed(Duration.zero, () => ShowPreLoad(context));

    //check network availabilty
    // var connectivityResult = await Connectivity().checkConnectivity();
    // if(connectivityResult != ConnectivityResult.mobile && connectivityResult != ConnectivityResult.wifi  ){
    //  // showError("لا يوجد اتصال بالانترنت");
    //   //showSnackBar('لا يوجد اتصال بالانترنت');
    //   print("لا يوجد اتصال بالانترنت");
    //   return ;
    // }

    var url = dbUrl + "display-sales-report/display";
    var dataStore = {
      "distributer_id": distribut_id,
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

  Widget _buildTitleSection(String title) {
    return Column(
      children: [
        Container(
          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.only(top: 40, bottom: 15, left: 10, right: 20),
          decoration: BoxDecoration(
            color: Colors.orange,
            borderRadius: BorderRadius.circular(3),
            boxShadow: [
              BoxShadow(
                  color: Color(0xff0049e0).withOpacity(0.0),
                  blurRadius: 15,
                  spreadRadius: 5),
            ],
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              //Start design icon mnue
              Text(
                '$title',
                style: TextStyle(
                    color: Colors.white,
                    fontSize: 20,
                    fontFamily: "Almarai",
                    fontWeight: FontWeight.bold),
              ),

              GestureDetector(
                onTap: () {
                  scaffoldKey.currentState?.openEndDrawer();
                },
                child: CircleAvatar(
                  backgroundColor: Colors.white,
                  child: Icon(
                    Icons.menu,
                    color: Colors.black87,
                  ),
                ),
              ),
            ],
          ),
        ),
      ],
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

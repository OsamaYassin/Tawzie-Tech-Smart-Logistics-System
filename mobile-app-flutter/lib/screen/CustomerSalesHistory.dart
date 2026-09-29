import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/customerLocation.dart';
import 'package:tawzie/screen/drawer_design.dart';

import 'package:tawzie/screen/payDebt.dart';
import 'package:tawzie/screen/productDistribution.dart';
import '../configUrl.dart';
import '../widgets/ProgressDialog.dart';

class CustomerSalesHistory extends StatefulWidget {

  final String titleName ;
  final String descrip ;
  final String pointId ;
  final String distribut_id ;

    CustomerSalesHistory({ required this.titleName, required this.descrip, required this.pointId, required this.distribut_id});
  @override
  _CustomerSalesHistoryState createState() => _CustomerSalesHistoryState(this.titleName, this.descrip, this.pointId , this.distribut_id);
}

class _CustomerSalesHistoryState extends State<CustomerSalesHistory> {

  String titleName ;
  String descrip ;
  String pointId ;
  String distribut_id;

  _CustomerSalesHistoryState(this.titleName, this.descrip,this.pointId ,this.distribut_id);


  List _myList = [];
  
  var textStyle =  TextStyle( fontSize: 15,  fontFamily: "Almarai", color: Colors.black26 ,);


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
            "  تاريخ المبيعات",
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
                elevation: 1,
                child: Container(
                  height: 160,
                 // color: Colors.orange.shade200,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(5),
                    color:  _myList[index]["agel"] > 0 ?  Colors.indigo.shade200 : Colors.white,
                  ),

                  child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      // textDirection: TextDirection.ltr,
                      children: [
                        Container(
                          height: 160,
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
                                        Container(
                                          width: 60,
                                          child: Text(
                                            _myList[index]["banckk"].toString()
                                            ,
                                       style: textStyle,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text("بنكك"
                                          ,
                                        style: textStyle,
                                        ),
                                        SizedBox(
                                          width: 25,
                                        ),

                                        Container(
                                          width: 60,
                                          child: Text(
                                              _myList[index]["chash"].toString()
                                            ,
                                       style: textStyle,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text("كاش"
                                          ,
                                       style: textStyle,
                                        ),

                                      ],
                                    ),
                                    SizedBox(  height: 15, ),
                                    Row(
                                      crossAxisAlignment:
                                      CrossAxisAlignment.center,
                                      mainAxisAlignment:
                                      MainAxisAlignment.center,
                                      children: [
                                        Container(
                                          width: 60,
                                          child: Text(
                                            _myList[index]["agel"].toString()
                                            ,
                                       style: textStyle,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text("  أجل"
                                          ,
                                       style: textStyle,
                                        ),
                                        SizedBox(
                                          width: 25,
                                        ),
                                        Container(
                                          width: 60,
                                          child: Text(
                                            _myList[index]["sheck"].toString()
                                            ,
                                       style: textStyle,
                                          ),
                                        ),
                                        SizedBox(
                                          width: 5,
                                        ),
                                        Text("شيك"
                                          ,
                                       style: textStyle,
                                        ),

                                      ],
                                    ),
                                    SizedBox(  height: 15, ),
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
                                         style: textStyle,
                                        ),
                                      ],
                                    ),
                                  ],
                                ),
                                Container(
                                    margin: EdgeInsets.only(left: 5),
                                    child: Icon(
                                      Icons.point_of_sale,
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

                              if(_myList[index]["agel"] == 0){
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                      builder: (context) => ProductDistribution(
                                          titleName: titleName,
                                          descrip: descrip,
                                          pointId: pointId,
                                          distribut_id: distribut_id)),
                                );

                              }else{

                              Navigator.push(context,MaterialPageRoute(builder: (context) =>  PayDebt(
                                titleName:  _myList[index]["point_name"].toString(), salesId: _myList[index]["sales_id"].toString(),
                                pointId:  _myList[index]["point_id"].toString(), distribut_id:  _myList[index]["distributer_id"].toString(),
                                totalPrice: _myList[index]["total_price"].toString(), chash:  _myList[index]["chash"].toString(),
                                banckk:  _myList[index]["banckk"].toString(),
                                sheck:  _myList[index]["sheck"].toString(), agel:  _myList[index]["agel"].toString(),
                              )
                              ),
                              );

                              }
                              // Navigator.push(context,MaterialPageRoute(builder: (context) =>  CustomerLocation() ), );
                            },
                          ),
                        ),
                      ]),
                ),
              );
            }),

      floatingActionButton: Container(
        margin: EdgeInsets.only(left: 23),
        child: Align(
          alignment: Alignment.bottomLeft,
          child: FloatingActionButton(
            child: Icon(Icons.shopping_basket, color: Colors.white),
            onPressed: (){
              Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) => ProductDistribution(
                        titleName: titleName,
                        descrip: descrip,
                        pointId: pointId,
                        distribut_id: distribut_id)),
              );

              //move position of map camera to new location
            },
          ),
        ),
      ),
    );
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

    var url = dbUrl + "display-customer-sales-history/display";
    var dataStore = {
      "distributer_id": distribut_id,
      "point_id": pointId,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['ShowSalesCustomerReport'];

      print("---------------------------------------");
      print(getDataInfo);
      // showSuccess("تم اضافة بنجاح");

      setState(() {
        _myList = getDataInfo;

        print(_myList);
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

import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/providers/sale_points.dart';
import 'package:tawzie/screen/customerLocation.dart';
//import 'package:tawzie/screen/customerLocation.dart';
import 'package:tawzie/screen/drawer_design.dart';
//import 'package:flutter_slidable/flutter_slidable.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import '../configUrl.dart';
import '../models/sale_point.dart';

class ViewCustomerScreen extends StatefulWidget {
  const ViewCustomerScreen({Key? key}) : super(key: key);
  @override
  _ViewCustomerScreenState createState() => _ViewCustomerScreenState();
}

class _ViewCustomerScreenState extends State<ViewCustomerScreen> {
  // List _myList = [];

  TextEditingController _searchController = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    // displayAllPints();
  }

  var _isInit = true;

  // ignore: unused_field
  var _isLoading = false;

  @override
  void didChangeDependencies() {
    if (_isInit) {
      setState(() {
        _isLoading = true;
      });
      Provider.of<SalePoints>(context).fetchSalepoints().then((rr) {
        setState(() {
          _isLoading = false;
        });
      });
    }
    _isInit = false;
    super.didChangeDependencies();
  }

  void ShowPreLoad(BuildContext context) {
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(
              status: 'Logging...',
            ));
  }

  var _formKey = GlobalKey<FormState>();
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    final salePoints =
        Provider.of<SalePoints>(context, listen: true).salePoints;
    return Scaffold(
        key: scaffoldKey,
        endDrawer: DrawerDesign(),
        appBar: AppBar(
          backgroundColor: Palette.mycolor,
          title: Text(
            " عرض نقاط البيع",
            style: TextStyle(
                color: Colors.white,
                fontSize: 20,
                fontFamily: "Almarai",
                fontWeight: FontWeight.bold),
          ),
          centerTitle: true,
        ),
        body: ListView.builder(
            itemCount: salePoints.length,
            itemBuilder: (context, index) {
              return Card(
                elevation: 1,
                child: Container(
                  height: 80,
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
                                                1.2,
                                        child: Row(
                                          children: [
                                            Text(
                                              salePoints[index].type!,
                                              style: TextStyle(
                                                  fontSize: 12,
                                                  fontFamily: "Almarai",
                                                  color: Colors.deepOrange),
                                            ),
                                            Expanded(
                                              child: Text(
                                                salePoints[index].point_name!,
                                                style: TextStyle(
                                                  fontSize: 14,
                                                  fontFamily: "Almarai",
                                                ),
                                                textDirection:
                                                    TextDirection.rtl,
                                              ),
                                            ),
                                            SizedBox(
                                              width: 10,
                                            ),
                                            Icon(
                                              Icons.add_business_outlined,
                                              color: Palette.mycolor,
                                            ),
                                          ],
                                        )),
                                    SizedBox(
                                      height: 25,
                                    ),
                                  ],
                                ),
                              ],
                            ),
                            onTap: () {
                              print("==============================");

                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => CustomerLocation(
                                          salePoints[index].point_name!,
                                          salePoints[index].type!,
                                          salePoints[index].point_id!,
                                          salePoints[index].latitude!,
                                          salePoints[index]
                                              .longitude!
                                              .toString(),
                                        )),
                              );
                            },
                          ),
                        ),
                      ]),
                ),
              );
            }));
  }

  /* Future<void> displayAllPints() async {
    Future.delayed(Duration.zero, () => ShowPreLoad(context));
    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if (connectivityResult != ConnectivityResult.mobile &&
        connectivityResult != ConnectivityResult.wifi) {
      showError("لا يوجد اتصال بالانترنت");
      print("لا يوجد اتصال بالانترنت");
      return;
    }
    var url = dbUrl + "point/distributor-point";
    var dataStore = {
      "distribut_id": distribut_id,
    };
    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);
    // Navigator.pop(context); // show progress Dialog
    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['distributionPoint'];
      // print(getDataInfo);
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
  }*/

  Future<void> DeActiveDistributorPoint(String point_id) async {
    Future.delayed(Duration.zero, () => ShowPreLoad(context));

    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if (connectivityResult != ConnectivityResult.mobile &&
        connectivityResult != ConnectivityResult.wifi) {
      showError("لا يوجد اتصال بالانترنت");
      //showSnackBar('لا يوجد اتصال بالانترنت');
      print("لا يوجد اتصال بالانترنت");
      return;
    }

    var url = dbUrl + "point/deactive-point";
    var dataStores = {
      "point_id": point_id,
    };

    var response = await http.post(Uri.parse(url), body: dataStores);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      print("===================================");
      showSuccess("تم حذف بنجاح");
    } else {
      //showError("معلومات اضافة خطأ!!");
      //  return ;
    }

    // return ;
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
            MaterialButton(
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

  void ConformationDelete(String message, String point_id) {
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
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                MaterialButton(
                  child: const Text("NO"),
                  onPressed: () async {
                    Navigator.of(context).pop();
                    return;
                    // Only works on Android.
                  },
                ),

                MaterialButton(
                  child: const Text("OK"),
                  onPressed: () {
                    //  DeActiveDistributorPoint(point_id);
                    Navigator.of(context).pop();
                    //return ;
                    //Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                  },
                ),
                // SizedBox(width: 50,),
              ],
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
            MaterialButton(
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

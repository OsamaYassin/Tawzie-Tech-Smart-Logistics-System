import 'dart:convert';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:location/location.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/configUrl.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/screen/order_details.dart';
import 'package:tawzie/screen/showmap.dart';
import 'package:tawzie/screen/total_price_today.dart';
import '../config/getSetData.dart';

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  String getCurrentTime = DateFormat("yyyy-MM-dd").format(DateTime.now());

  //var sizeWidth =MediaQuery.of(context).size.width;
  //ONclick in mune icon dsplay mune
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();
  var textStyle = TextStyle(
    fontSize: 20,
    color: Colors.black,
    fontFamily: "Almarai",
  );

  String _fullName = "";
  String _userName = "";
  String _email = "";
  String _distributorId = "";
  String _countAllpoint = "";
  String totalPrice='';
  String _countYesVisit = "";
 int totalPrice1=0;
  List listOrdered = [];
  getOrdered() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();

    final String myString =
    await sharedPreferences.getString('orderedProducts')!;
    setState(() {
      listOrdered = json.decode(myString);
    });
    for(int i=0;i<listOrdered.length;i++){
        totalPrice1=totalPrice1+int.parse(listOrdered[i]['price'].toString()
        );
    }
  }
  @override
  void initState() {
    // TODO: implement initState

    super.initState();
    getOrdered();
    loadedSaveData();
    StoreUserLocation();
    /**************************************************
     *  if SharedPreferences Have not any of this go to database and get data count of point and visit yes
     ******************************************/
    CheckgetCountPointAndCountVisit();
  }

  CheckgetCountPointAndCountVisit() async {
    /**************************************************
     *  if SharedPreferences Have not any of this go to database and get data count of point and visit yes
     ******************************************/
    SharedPreferences prefs = await SharedPreferences.getInstance();
    if (!prefs.containsKey("allpoint") || !prefs.containsKey("yesvisit")) {
      getCountPointAndCountVisit();
    }
  }

  Future<void> getCountPointAndCountVisit() async {
    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if (connectivityResult != ConnectivityResult.mobile &&
        connectivityResult != ConnectivityResult.wifi) {
      showError("لا يوجد اتصال بالانترنت");
      //showSnackBar('لا يوجد اتصال بالانترنت');
      print("لا يوجد اتصال بالانترنت");
      return;
    }

    var url = dbUrl + "dashboard/dashboard-data-count-point";
    var dataStore = {
      "distribut_id": distribut_id,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      //save count of all point and visit or not visit point
      prefs.setString('allpoint', responseBody['allpoint'].toString());
      prefs.setString('yesvisit', responseBody['yesvisit'].toString());

      print("--------------------------");
      print(responseBody['allpoint'].toString());

      setState(() {
        _countAllpoint = prefs.getString("allpoint")!;
        _countYesVisit = prefs.getString("yesvisit")!;
      });
    } else {
      //showError("معلومات اضافة خطأ!!");
      return;
    }

    // return ;
  }

  loadedSaveData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    distribut_id = prefs.getString("distribut_id")!;
    /***************************
    ** Display Last Order Product
    ** And Check id he has new order
     **************************/
    if (prefs.containsKey("total_price")) {
    //  _totalPrice = prefs.getString("total_price")!;
    } else {
     // _totalPrice = "000";
    }

    /*******************************
    **  get count of all point
     *****************************/

    setState(() {
      if (prefs.containsKey("allpoint")) {
        _countAllpoint = prefs.getString("allpoint")!;
      } else {
        _countAllpoint = "0";
      }
    });

    /*******************************
     **  get count of all visit yes point
     *****************************/
    setState(() {
      if (prefs.containsKey("yesvisit")) {
        _countYesVisit = prefs.getString("yesvisit")!;
      } else {
        _countYesVisit = "0";
      }
    });

/*
    setState(() {
      _fullName =  prefs.getString("fullName")!;
      _userName =  prefs.getString("username")!;
      _email =  prefs.getString("email")!;
      _distributorId =  prefs.getString("distribut_id")!;
      distribut_id = _distributorId ;

    });*/
  }

  //Sore User Location

  Future<void> StoreUserLocation() async {
    //get and set data lat and lang to pass in another class
    // GetSetData getSetData = new GetSetData();

    Location location = await new Location();

    //  DatabaseReference _db = FirebaseDatabase(databaseURL: 'https://tawziedahiy-default-rtdb.firebaseio.com/').reference();

    location.onLocationChanged.listen((LocationData currentLocation) async {
      // Real track system  update location when change location user
      var currentTime = DateTime.now();
      /* final UserData userData = UserData( name: _fullName, latitude: currentLocation.latitude.toString() , longitude: currentLocation.longitude.toString(),currentTime: currentTime.toString());
      await _db.child('location/'+_distributorId)
          .set(userData.toMap()); //, priority: 444 */

      //Use current location
      // print("------------------------------------------------");
      //Get the current date and time.
      // print(currentTime.toString());
      //print("latitude"+currentLocation.latitude.toString() + " :  longitude"+ currentLocation.longitude.toString());

      latitude = currentLocation.latitude.toString();
      longitude = currentLocation.longitude.toString();

      //Use this variable to get my current location and compare with distance between two location
      MyCurrentLocationLatitude = currentLocation.latitude!;
      MyCurrentLocationLongitude = currentLocation.longitude!;
    });
  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      key: scaffoldKey,
      endDrawer: DrawerDesign(),
      body: Container(
        child: SingleChildScrollView(
          child: Column(
            children: [
              _buildTitleSection("   الرئيسية  "),
              SizedBox(
                height: 20,
              ),
              InkWell(
                  onTap: (){
                    Navigator.push(context,MaterialPageRoute(builder: (context) => OrderDetails()), );
                  },
                  child: _buildFirstCard(totalPrice1.toString())),

              _buildSecondCard(_countYesVisit, _countAllpoint, context),

              _buildThredSection(context),
              SizedBox(
                height: 10,
              ),
              // _buildThreetCard(),
              Card(
                elevation: 4.0,
                shadowColor: Colors.blueAccent,
                color: Colors.white,
                margin: EdgeInsets.only(left: 10, right: 10, bottom: 20),
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(14)),
                child: Container(
                  height: 100,
                  padding: EdgeInsets.only(top: 30, left: 20, right: 20),
                  child: Column(
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
                            children: [
                              Text("اعادة الضبط",
                                  style: TextStyle(
                                      color: Colors.red,
                                      fontFamily: "Almarai",
                                      fontSize: 18,
                                      fontWeight: FontWeight.bold)),
                              SizedBox(
                                height: 10,
                              ),
                              Text(getCurrentTime,
                                  style: TextStyle(
                                      color: Colors.black87,
                                      fontSize: 15,
                                      fontWeight: FontWeight.bold)),
                            ],
                          ),
                          GestureDetector(
                            onTap: () async {
                              //check network availabilty
                              var connectivityResult =
                                  await Connectivity().checkConnectivity();
                              if (connectivityResult !=
                                      ConnectivityResult.mobile &&
                                  connectivityResult !=
                                      ConnectivityResult.wifi) {
                                showError("لا يوجد اتصال بالانترنت");
                                return;
                              }
                              AlertshowMessage("اعادة ضبط البيانات");
                            },
                            child: Container(
                              padding: EdgeInsets.all(10),
                              decoration: BoxDecoration(
                                color: Colors.red,
                                borderRadius: BorderRadius.circular(10.0),
                              ),
                              child: Icon(
                                Icons.forward_5,
                                color: Colors.white,
                              ), // Image.asset("images/linechart.png"),
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              )
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTitleSection(String title) {
    return Column(
      children: [
        Container(
          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.only(top: 40, bottom: 15, left: 10, right: 20),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(3),
            boxShadow: [
              BoxShadow(
                  color: Color(0xff3161c4).withOpacity(0.3),
                  blurRadius: 15,
                  spreadRadius: 5),
            ],
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            mainAxisAlignment: MainAxisAlignment.end,
            //padding:  EdgeInsets.only(left: 8, top: 16),
            children: [
              //Start design icon mnue
              Text(
                '$title',
                style: TextStyle(
                    color: Colors.black87,
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

  void AlertshowMessage(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(
            child: Icon(
              Icons.new_releases,
              color: Colors.lightBlue,
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
                    //Function code here
                    SharedPreferences prefs = await SharedPreferences.getInstance();
                  if(prefs.containsKey("orderedProducts")) {
          prefs.remove("orderedProducts");
        }
                  Navigator.of(context).pop();
                    UpdateVisitYesToNoOfDistrubuter();
                  },
                ),
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

  Future<void> UpdateVisitYesToNoOfDistrubuter() async {
    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if (connectivityResult != ConnectivityResult.mobile &&
        connectivityResult != ConnectivityResult.wifi) {
      showError("لا يوجد اتصال بالانترنت");
      return;
    }

    var url = dbUrl + "point/distributor-point-update-no";
    var dataStore = {
      "distribut_id": distribut_id,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      print(responseBody);
      //Navigator.of(context).pop();
      showSuccess("تم  اعادة تهيئة بنجاح");
      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.setString('yesvisit', "0");
      prefs.setString('total_price', "0");

      setState(() {
      //  _totalPrice = "0";
        _countYesVisit = "0";
      });
    } else {
      showError("  هنالك خطأ قم بأعادة المحاولة");
      //  return ;
    }

    // return ;
  }
}

Widget _buildFirstCard(String totalPrice1) {
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
                    "اجمالي الطلب",
                    style: TextStyle(
                        color: Colors.blueAccent,
                        fontFamily: "Almarai",
                        fontSize: 18,
                        fontWeight: FontWeight.bold),
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Text(totalPrice1.toString(),
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

Widget _buildSecondCard(
    String _countYesVisit, String countAllpoint, BuildContext context) {
  return Container(
    height: 190,
    child: GridView.count(
      padding: EdgeInsets.all(0),
      mainAxisSpacing: 0,
      crossAxisSpacing: 1,
      crossAxisCount: 2,
      children: [
        GestureDetector(
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => ShowMapScreen()),
            );
          },
          child: Card(
            elevation: 4.0,
            shadowColor: Colors.blueAccent,
            color: Colors.white,
            margin: EdgeInsets.all(10),
            shape:
                RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Container(
                  padding: EdgeInsets.all(15),
                  decoration: BoxDecoration(
                    color: Colors.green,
                    borderRadius: BorderRadius.circular(50.0),
                  ),
                  child: Icon(
                    Icons.location_on,
                    color: Colors.white,
                    size: 30,
                  ),
                ),
                SizedBox(
                  height: 5,
                ),
                Text("  تم تغطيتها",
                    style: TextStyle(
                        color: Colors.green,
                        fontFamily: "Almarai",
                        fontSize: 18,
                        fontWeight: FontWeight.bold)),
                SizedBox(
                  height: 5,
                ),
                Text(_countYesVisit,
                    style: TextStyle(
                        color: Colors.black87,
                        fontSize: 15,
                        fontWeight: FontWeight.bold)),
              ],
            ),
          ),
        ),
        GestureDetector(
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => ShowMapScreen()),
            );
          },
          child: Card(
            elevation: 4.0,
            shadowColor: Colors.blueAccent,
            color: Colors.white,
            margin: EdgeInsets.all(10),
            shape:
                RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Container(
                  padding: EdgeInsets.all(15),
                  decoration: BoxDecoration(
                    color: Colors.orange,
                    borderRadius: BorderRadius.circular(50.0),
                  ),
                  child: Icon(
                    Icons.location_on,
                    color: Colors.white,
                    size: 30,
                  ),
                ),
                SizedBox(
                  height: 5,
                ),
                Text("نقاط البيع",
                    style: TextStyle(
                        color: Colors.orange,
                        fontFamily: "Almarai",
                        fontSize: 18,
                        fontWeight: FontWeight.bold)),
                SizedBox(
                  height: 5,
                ),
                Text(countAllpoint,
                    style: TextStyle(
                        color: Colors.black87,
                        fontSize: 15,
                        fontWeight: FontWeight.bold)),
              ],
            ),
          ),
        ),
      ],
    ),
  );
}

Widget _buildThredSection(BuildContext context) {
  return GestureDetector(
    onTap: () {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => TotalPriceWorkDay()),
      );
    },
    child: Card(
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
                    color: Colors.green.shade400,
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  child: Image.asset("images/linechart.png"),
                ),
                Column(
                  children: [
                    Text(
                      "اجمالي مبيعات اليوم",
                      style: TextStyle(
                          color: Colors.green.shade400,
                          fontFamily: "Almarai",
                          fontSize: 18,
                          fontWeight: FontWeight.bold),
                    ),
                    SizedBox(
                      height: 10,
                    ),
                  ],
                ),
              ],
            ),
          ],
        ),
      ),
    ),
  );
}





 /*Widget _buildThreetCard() {
  return AnimatedContainer(
    duration: Duration(milliseconds: 700),
    curve: Curves.bounceInOut,
    child: Card(
      elevation: 4.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10,right: 10 , bottom: 20),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
      child: Container(
        height: 100,
        padding: EdgeInsets.only(top: 30, left: 20, right: 20),
        child: Column(
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Column(
                  children: [
                    Text(
                      "تاريخ اليوم",
                        style: TextStyle(
                            color: Colors.red,fontFamily: "Almarai",fontSize: 18, fontWeight: FontWeight.bold)),
                    SizedBox(height: 5,),
                    Text("2021-9-1",
                        style: TextStyle(
                            color: Colors.black87,
                            fontSize: 15,
                            fontWeight: FontWeight.bold)),
                  ],
                ),
                GestureDetector(
                  onTap: (){
                   //ffffffffffffff
                  },
                  child: Container(
                    padding: EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      color: Colors.red,
                      borderRadius: BorderRadius.circular(10.0),
                    ),
                    child: Icon(Icons.forward_5 ,color: Colors.white,) ,  // Image.asset("images/linechart.png"),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    ),
  );


}*/






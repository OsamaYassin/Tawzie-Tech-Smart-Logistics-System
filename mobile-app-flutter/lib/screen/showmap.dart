import 'dart:async';
import 'dart:collection';
import 'dart:convert';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/UserData.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/productDistribution.dart';
import 'package:location/location.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/widgets/ProgressDialog.dart';

import '../configUrl.dart';
import '../models/sale_point.dart';
import '../providers/sale_points.dart';

class ShowMapScreen extends StatefulWidget {
  @override
  _ShowMapScreenState createState() => _ShowMapScreenState();
}

class _ShowMapScreenState extends State<ShowMapScreen> {
  static const dd = "ddd";

  Completer<GoogleMapController> _controllerGoogleMap = Completer();

  late GoogleMapController newGoogleMapController;

  late Position currentPosition;
  var geoLocator = Geolocator();

  double _originLatitude = 15.5292869, _originLongitude = 32.5609372;
  Map<MarkerId, Marker> markers = {};

  //List data from database
  //List _myList = [];
  List<SalePoint> salePoints = [];
  @override
  void initState() {
    displayAllPints();
    super.initState();
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

/*
  void DisplayAllLocationOnMap(){
    /// origin marker
    _addMarker(LatLng(_originLatitude, _originLongitude), "1",
        BitmapDescriptor.defaultMarker , "system one location" ,"Description one location");

    _addMarker(LatLng(15.527881,32.5501225), "2",
        BitmapDescriptor.defaultMarker ,  "system two location" ,"Description two location");
  }*/

  //تأكد من خدمة ال GPS تعمل في الهاتف  او لا
  // bool _serviceEnabled;
  // Future<void> checkLocationServiceInDevice() async {
  //
  //   Location location = new Location();
  //
  // ////  _serviceEnabled = await location.serviceEnabled();
  //
  //   location.onLocationChanged.listen((LocationData currentLocation) {
  //     // Use current location
  //      print("object---------------- say hi 000000");
  //     print(currentLocation.longitude.toString() + " :  "+ currentLocation.longitude.toString());
  //      print("object---------------- say hi 000000");
  //   });
  // }

  Future<void> setUserData(String userId, String name, String status,
      double priority, String currentTime) async {}

/*
  void RunBackground(){
     Workmanager().executeTask((taskName, inputData) {

       Workmanager().registerPeriodicTask(
         "3",
         "simplePeriodicTask",
         initialDelay: Duration(seconds: 1),
       );
       return ;
     });
  }*/

  //Get current Location method
  void locationPosition() async {
    // distance Between two point location
    // I can use this method in
    //  اذا لم يصل الموزع النقطة البيع لايمكن بيع المنتج
    // double distanceInMeters = await Geolocator().distanceBetween(15.527881,32.5501225, 15.5292869,32.5609372);
    // print("object---------------- say hi 000000");
    // print("object---------------- say hi 000000");
    //Position position = await geoLocator.getCurrentPosition(desiredAccuracy: LocationAccuracy.high); // make error
    Position position = await Geolocator.getCurrentPosition();
    currentPosition = position;

    LatLng latLanPosition = new LatLng(position.latitude, position.longitude);

    CameraPosition cameraPosition =
        new CameraPosition(target: latLanPosition, zoom: 14);
    newGoogleMapController
        .animateCamera(CameraUpdate.newCameraPosition(cameraPosition));
  }

  static final CameraPosition _kGooglePlex = CameraPosition(
    target: LatLng(37.42796133580664, -122.085749655962),
    zoom: 14.4746,
  );

  _addMarker(
      LatLng position,
      String id,
      BitmapDescriptor NotVisitColor,
      BitmapDescriptor VisitColor,
      String titleName,
      String descrip,
      String pointId,
      String distribut_id,
      String visit) {
    // Check if distribute visit point or Not
    bool checkVisting = false;
    if (visit == "yes") {
      checkVisting = true;
    } else {
      checkVisting = false;
    }

    MarkerId markerId = MarkerId(id);
    Marker marker = Marker(
      markerId: markerId,
      icon: checkVisting ? VisitColor : NotVisitColor,
      position: position,
      infoWindow: InfoWindow(
        title: titleName,
        snippet: descrip,
        onTap: () async {
          Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) => ProductDistribution(
                    titleName: titleName,
                    descrip: descrip,
                    pointId: pointId,
                    distribut_id: distribut_id,
                ),
            ),
          );

          // اذا لم يصل الموزع النقطة البيع لايمكن بيع المنتج
          /*  double distanceInMeters = await Geolocator.distanceBetween(
              MyCurrentLocationLatitude,
              MyCurrentLocationLongitude,
              position.latitude ,
              position.longitude);
          // showError(distanceInMeters.toString());

          if (distanceInMeters > 200) {
            showError(" خارج حدود المنطقة"   ); //+ distanceInMeters.toString()
          } else {
            //showError("   حدود المنطقة"  );
            // print("***************distribut_id*****************"+ distribut_id);
            Navigator.push(context,MaterialPageRoute(builder: (context) => ProductDistribution(
                titleName : titleName , descrip: descrip, pointId:pointId ,distribut_id:distribut_id)), );

          }*/

          // print("***************distribut_id*****************"+ distribut_id);
          //    Navigator.push(context,MaterialPageRoute(builder: (context) => ProductDistribution(
          //      titleName : titleName , descrip: descrip, pointId:pointId ,distribut_id:distribut_id)), );
          //
        },
      ),

      // onTap: (){
      //   Navigator.push(context,MaterialPageRoute(builder: (context) => OrderProduct()), );
      // },
    );
    markers[markerId] = marker;
  }

  @override
  Widget build(BuildContext context) {
    var myMarkers = HashSet<Marker>(); //add marker  , this is array

    return Scaffold(
      appBar: AppBar(
        shadowColor: Colors.blue,
        title: Text(
          "مواقع نقاط البيع",
          style: TextStyle(
            fontFamily: "Almarai",
          ),
        ),
        backgroundColor: Palette.mycolor,
        elevation: 4.0,
        centerTitle: true,
      ),
      body: Stack(
        children: [
          GoogleMap(
            mapType: MapType.normal,
            myLocationButtonEnabled: true,
            myLocationEnabled: true,
            zoomGesturesEnabled: true,
            zoomControlsEnabled: true,
            initialCameraPosition: CameraPosition(
              target: LatLng(15.5292869, 32.5609372),
              zoom: 14.4746,
            ),
            onMapCreated: (GoogleMapController controller) {
              _controllerGoogleMap.complete(controller);
              newGoogleMapController = controller;
              //Get Current Location
              //  locationPosition();
            },
            markers: Set<Marker>.of(markers.values),
          ),
        ],
      ),
    );
  }

  Future<void> displayAllPints() async {
   // Future.delayed(Duration.zero, () => ShowPreLoad(context));
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    final dist = sharedPreferences.getString("distribut_id");
    salePoints = Provider.of<SalePoints>(context, listen: false).salePoints;

    if (salePoints.isNotEmpty) {
      int numbercount = 1;
      for (var salePoint in salePoints) {
        numbercount++;
        // print('Hello======== ' + n['point_name']);
        _addMarker(
            LatLng(double.parse(salePoint.latitude!),
                double.parse(salePoint.longitude!)),
            numbercount.toString(),
            BitmapDescriptor.defaultMarker, //Not Visit Point
            BitmapDescriptor.defaultMarkerWithHue(
                BitmapDescriptor.hueGreen), // Visit Point,
            salePoint.point_name!,
            salePoint.type!,
            salePoint.point_id!,
            dist!,
            salePoint.visit!);
      }
      
    
    } else {
      //showError("معلومات اضافة خطأ!!");
      //  return ;
    }

    // return ;
  }

  void showError(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(
            child: Icon(
              Icons.error_outline,
              color: Colors.redAccent,
              size: 80,
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



/*

import 'dart:async';
import 'dart:collection';
import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/UserData.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/productDistribution.dart';
import 'package:location/location.dart';
import 'package:http/http.dart' as http;
import 'package:tawzie/widgets/ProgressDialog.dart';

import '../configUrl.dart';

class ShowMapScreen extends StatefulWidget {
  @override
  _ShowMapScreenState createState() => _ShowMapScreenState();
}

class _ShowMapScreenState extends State<ShowMapScreen> {
  static const dd = "ddd";

  Completer<GoogleMapController> _controllerGoogleMap = Completer();

  late GoogleMapController newGoogleMapController;

  late Position currentPosition;
  var geoLocator = Geolocator();

  double _originLatitude = 15.5292869, _originLongitude = 32.5609372;
  Map<MarkerId, Marker> markers = {};

  //List data from database
  List _myList = [];

  @override
  void initState() {
    super.initState();

    // DisplayAllLocationOnMap();
    displayAllPints();
    // checkLocationServiceInDevice();

    // StoreUserLocation();
  }

  void ShowPreLoad(BuildContext context) {
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(
              status: 'Logging...',
            ));
  }

/*
  void DisplayAllLocationOnMap(){
    /// origin marker
    _addMarker(LatLng(_originLatitude, _originLongitude), "1",
        BitmapDescriptor.defaultMarker , "system one location" ,"Description one location");

    _addMarker(LatLng(15.527881,32.5501225), "2",
        BitmapDescriptor.defaultMarker ,  "system two location" ,"Description two location");
  }*/

  //تأكد من خدمة ال GPS تعمل في الهاتف  او لا
  // bool _serviceEnabled;
  // Future<void> checkLocationServiceInDevice() async {
  //
  //   Location location = new Location();
  //
  // ////  _serviceEnabled = await location.serviceEnabled();
  //
  //   location.onLocationChanged.listen((LocationData currentLocation) {
  //     // Use current location
  //      print("object---------------- say hi 000000");
  //     print(currentLocation.longitude.toString() + " :  "+ currentLocation.longitude.toString());
  //      print("object---------------- say hi 000000");
  //   });
  // }

  Future<void> setUserData(String userId, String name, String status,
      double priority, String currentTime) async {}

/*
  void RunBackground(){
     Workmanager().executeTask((taskName, inputData) {

       Workmanager().registerPeriodicTask(
         "3",
         "simplePeriodicTask",
         initialDelay: Duration(seconds: 1),
       );
       return ;
     });
  }*/

  //Get current Location method
  void locationPosition() async {
    // distance Between two point location
    // I can use this method in
    //  اذا لم يصل الموزع النقطة البيع لايمكن بيع المنتج
    // double distanceInMeters = await Geolocator().distanceBetween(15.527881,32.5501225, 15.5292869,32.5609372);
    // print("object---------------- say hi 000000");
    // print("object---------------- say hi 000000");
    //Position position = await geoLocator.getCurrentPosition(desiredAccuracy: LocationAccuracy.high); // make error
    Position position = await Geolocator.getCurrentPosition();
    currentPosition = position;

    LatLng latLanPosition = new LatLng(position.latitude, position.longitude);

    CameraPosition cameraPosition =
        new CameraPosition(target: latLanPosition, zoom: 14);
    newGoogleMapController
        .animateCamera(CameraUpdate.newCameraPosition(cameraPosition));
  }

  static final CameraPosition _kGooglePlex = CameraPosition(
    target: LatLng(37.42796133580664, -122.085749655962),
    zoom: 14.4746,
  );

  _addMarker(
      LatLng position,
      String id,
      BitmapDescriptor NotVisitColor,
      BitmapDescriptor VisitColor,
      String titleName,
      String descrip,
      String pointId,
      String distribut_id,
      String visit) {
    // Check if distribute visit point or Not
    bool checkVisting = false;
    if (visit == "yes") {
      checkVisting = true;
    } else {
      checkVisting = false;
    }

    MarkerId markerId = MarkerId(id);
    Marker marker = Marker(
      markerId: markerId,
      icon: checkVisting ? VisitColor : NotVisitColor,
      position: position,
      infoWindow: InfoWindow(
        title: titleName,
        snippet: descrip,
        onTap: () async {
          Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) => ProductDistribution(
                    titleName: titleName,
                    descrip: descrip,
                    pointId: pointId,
                    distribut_id: distribut_id)),
          );

          // اذا لم يصل الموزع النقطة البيع لايمكن بيع المنتج
          /*  double distanceInMeters = await Geolocator.distanceBetween(
              MyCurrentLocationLatitude,
              MyCurrentLocationLongitude,
              position.latitude ,
              position.longitude);
          // showError(distanceInMeters.toString());

          if (distanceInMeters > 200) {
            showError(" خارج حدود المنطقة"   ); //+ distanceInMeters.toString()
          } else {
            //showError("   حدود المنطقة"  );
            // print("***************distribut_id*****************"+ distribut_id);
            Navigator.push(context,MaterialPageRoute(builder: (context) => ProductDistribution(
                titleName : titleName , descrip: descrip, pointId:pointId ,distribut_id:distribut_id)), );

          }*/

          // print("***************distribut_id*****************"+ distribut_id);
          //    Navigator.push(context,MaterialPageRoute(builder: (context) => ProductDistribution(
          //      titleName : titleName , descrip: descrip, pointId:pointId ,distribut_id:distribut_id)), );
          //
        },
      ),

      // onTap: (){
      //   Navigator.push(context,MaterialPageRoute(builder: (context) => OrderProduct()), );
      // },
    );
    markers[markerId] = marker;
  }

  @override
  Widget build(BuildContext context) {
    var myMarkers = HashSet<Marker>(); //add marker  , this is array

    return Scaffold(
      appBar: AppBar(
        shadowColor: Colors.blue,
        title: Text(
          "مواقع نقاط البيع",
          style: TextStyle(
            fontFamily: "Almarai",
          ),
        ),
        backgroundColor: Palette.mycolor,
        elevation: 4.0,
        centerTitle: true,
      ),
      body: Stack(
        children: [
          GoogleMap(
            mapType: MapType.normal,
            myLocationButtonEnabled: true,
            myLocationEnabled: true,
            zoomGesturesEnabled: true,
            zoomControlsEnabled: true,
            initialCameraPosition: CameraPosition(
              target: LatLng(15.5292869, 32.5609372),
              zoom: 14.4746,
            ),
            onMapCreated: (GoogleMapController controller) {
              _controllerGoogleMap.complete(controller);
              newGoogleMapController = controller;
              //Get Current Location
              //  locationPosition();
            },
            markers: Set<Marker>.of(markers.values),
          ),
        ],
      ),
    );
  }

  Future<void> displayAllPints() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    final dist = sharedPreferences.getString("distribut_id");
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

    var url = dbUrl + "point/distributor-point";
    var dataStore = {
      "distribut_id": dist,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['distributionPoint'];

      int numbercount = 1;
      for (var n in getDataInfo) {
        numbercount++;
        // print('Hello======== ' + n['point_name']);
        _addMarker(
            LatLng(double.parse(n['latitude']), double.parse(n['longitude'])),
            numbercount.toString(),
            BitmapDescriptor.defaultMarker, //Not Visit Point
            BitmapDescriptor.defaultMarkerWithHue(
                BitmapDescriptor.hueGreen), // Visit Point,
            n['point_name'],
            n['type'],
            n['point_id'].toString(),
            n['distribut_id'].toString(),
            n['visit'].toString());
      }

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

  void showError(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(
            child: Icon(
              Icons.error_outline,
              color: Colors.redAccent,
              size: 80,
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

*/
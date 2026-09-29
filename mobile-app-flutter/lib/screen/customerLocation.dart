import 'dart:async';
import 'dart:collection';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:tawzie/config/UserData.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/CustomerSalesHistory.dart';
import 'package:tawzie/screen/productDistribution.dart';
import 'package:location/location.dart';

class CustomerLocation extends StatefulWidget {
  final String name;
  final String type;
  final String pointId;
  final String latitude;
  final String longitude;

  const CustomerLocation(
      this.name, this.type, this.pointId, this.latitude, this.longitude);

  @override
  _CustomerLocationState createState() => _CustomerLocationState(name ,type , pointId , latitude ,longitude);
}

class _CustomerLocationState extends State<CustomerLocation> {



    String name;
    String type;
    String pointId;
    String latitude;
    String longitude;

  _CustomerLocationState(this.name, this.type, this.pointId, this.latitude, this.longitude);


  var  mymarkers = HashSet<Marker>();

  String googleApikey = "AIzaSyDX-KFjK_08NWJedzIcioQEV4HAST-U3nM";
  GoogleMapController? mapController; //contrller for Google map
  LatLng startLocation = LatLng(27.6602292, 85.308027);


  @override
  void initState() {
    // TODO: implement initState
    super.initState();

  }


  _addMarker(LatLng position, String id, BitmapDescriptor descriptor,
      String titleName, String descrip) {
    MarkerId markerId = MarkerId(id);
    Marker marker = Marker(
      markerId: markerId, icon: descriptor, position: position,
      infoWindow: InfoWindow(
        title: titleName,
        snippet: descrip,
        onTap: () {

          // Navigator.push(
          //   context,
          //   MaterialPageRoute(
          //       builder: (context) => ProductDistribution(
          //           titleName: titleName,
          //           descrip: descrip,
          //           pointId: pointId,
          //           distribut_id: distribut_id)),
          // );
        },
      ),

      // onTap: (){
      //   Navigator.push(context,MaterialPageRoute(builder: (context) => OrderProduct()), );
      // },
    );
    //markers[markerId] = marker;
  }

  @override
  Widget build(BuildContext context) {
    return  Scaffold(
        appBar: AppBar(
          backgroundColor: Palette.mycolor,
          centerTitle: true,
          title: Text(
            "نقطة بيع",
            style: TextStyle(
                color: Colors.white,
                fontSize: 20,
                fontFamily: "Almarai",
                fontWeight: FontWeight.bold),
          ),
        ),
        floatingActionButton: Container(
          margin: EdgeInsets.only(left: 23),
          child: Align(
            alignment: Alignment.bottomLeft,
            child: FloatingActionButton(
              child: Icon(Icons.location_on_rounded, color: Colors.white),
              onPressed: (){
                LatLng newlatlang = LatLng(double.parse(latitude),  double.parse(longitude));
                mapController?.animateCamera(
                    CameraUpdate.newCameraPosition(
                        CameraPosition(target: newlatlang, zoom: 17)
                      //17 is new zoom level
                    )
                );
                //move position of map camera to new location
              },
            ),
          ),
        ),
        body: Container(
          child:GoogleMap( //Map widget from google_maps_flutter package
            zoomGesturesEnabled: true, //enable Zoom in, out on map
            initialCameraPosition: CameraPosition(
              //innital position in map
              target: LatLng(double.parse(latitude),  double.parse(longitude)), //initial position
              zoom: 14.0, //initial zoom level
            ),
            mapType: MapType.normal, //map type
            onMapCreated: (controller) { //method called when map is created
              setState(() {
                mapController = controller;
                
                mymarkers.add(
                  Marker(markerId:MarkerId('$pointId') , position:LatLng(double.parse(latitude),  double.parse(longitude)) ,
                  infoWindow: InfoWindow(
                  title: "$name",
                  snippet: "$type",
                  onTap: () {
                    Navigator.push(context,MaterialPageRoute(builder: (context) =>  CustomerSalesHistory(
                        titleName: name,
                        descrip: type,
                        pointId: pointId,
                        distribut_id: distribut_id
                    ) ));
                   /* Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => ProductDistribution(
                              titleName: name,
                              descrip: type,
                              pointId: pointId,
                              distribut_id: distribut_id)),
                    );
                    */
                  }
                  )
                  ),
                );

              });
            },
            markers: mymarkers,
          ),
        )
    );
  }
}
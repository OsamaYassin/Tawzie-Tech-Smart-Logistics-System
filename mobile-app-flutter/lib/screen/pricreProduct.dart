import 'dart:convert';
import 'dart:math';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:tawzie/screen/login_signup.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:http/http.dart' as http;
import '../configUrl.dart';
import '../providers/products.dart';
import 'home_screen.dart';

class ProductPrice extends StatefulWidget {
  @override
  _ProductPriceState createState() => _ProductPriceState();
}

class _ProductPriceState extends State<ProductPrice> {
  //List data from database
  List _myList = [];
  //ONclick in mune icon dsplay mune
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();


  var textStyle = TextStyle(
    fontSize: 20,
    color: Colors.black,
    fontFamily: "Almarai",
  );

  var _isInit = true;

  // ignore: unused_field
  var _isLoading = false;

  @override
  void didChangeDependencies() {
    if (_isInit) {
      setState(() {
        _isLoading = true;
      });
      Provider.of<Products>(context).fetchProducts().then((rr) {
        setState(() {
          _isLoading = false;
        });
      });
    }
    _isInit = false;
    super.didChangeDependencies();
  }

  @override
  Widget build(BuildContext context) {
    final products = Provider.of<Products>(
        context,listen: true
    ).products;

    return Scaffold(
      key: scaffoldKey,
      endDrawer: DrawerDesign(),
      appBar: AppBar(
        title: Text(
          "اسعار المنتجات",
          style: TextStyle(
              color: Colors.white,
              fontSize: 20,
              fontFamily: "Almarai",
              fontWeight: FontWeight.bold),
        ),
        backgroundColor: Palette.mycolor,
        centerTitle: true,
      ),

      body: Column(
        children: [
          //Call method title and icon mune
        //  _buildTitleSection("طلب المنتجات        \t "),

          Expanded(
            child: products.isNotEmpty
                ? ListView.builder(
              padding: const EdgeInsets.all(15.0),
              itemCount: products.length,
              itemBuilder: (ctx, i) =>
                  CallAllItemInCard(
                      products[i].name.toString(),
                      products[i].price.toString()),

            ): const Center(
                child: Text("لا توجد منتجات ")),
          ),
        ],
      ),
    );
  }

  Widget CallAllItemInCard(
      String name,
      String price,) {
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        height: 90,
        padding: EdgeInsets.only(top: 10, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart

            SizedBox(
              height: 15,
            ),
              CardItemInput(name, price),
          ],
        ),
      ),
    );
  }



  Widget CardItemInput(String name, String price) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Container(
          width: 150,
          height: 40,
          child:Center(
            child: Text(
              "$priceج ",
              style: TextStyle(
                fontSize: 20,
                color: Colors.black,
                fontFamily: "Almarai",
              ),
        ),
          )),
        Text(
          name,
          style: TextStyle(
            fontSize: 20,
            color: Colors.black,
            fontFamily: "Almarai",
          ),
        ),
      ],
    );
  }


  Widget _buildTitleSection(String title) {
    return Column(
      children: [
        Container(
          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.only(top: 40, bottom: 15, left: 10, right: 20),
          decoration: BoxDecoration(
            color: Colors.orange.shade900,
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

  // ignore: non_constant_identifier_names


  //NotWorking
  Future<void> GetProductPriceNotWorking() async {
    // Future.delayed(Duration.zero, () => showAlert(context));
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

    var url = dbUrl + "product/price";
    var dataStore = {
      "distribut_id": distribut_id,
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    SharedPreferences prefs = await SharedPreferences.getInstance();

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['productPrice'];

      prefs.setString('kasbra50', getDataInfo[0]['price'].toString(),);
      prefs.setString('kasbra100', getDataInfo[1]['price'].toString(),);
      prefs.setString('shmar50', getDataInfo[2]['price'].toString(),);
      prefs.setString('shmar100', getDataInfo[3]['price'].toString(),);
      prefs.setString('weaka50', getDataInfo[4]['price'].toString(),);
      prefs.setString('weaka100', getDataInfo[5]['price'].toString(),);
      prefs.setString('ganzabel50', getDataInfo[6]['price'].toString(),);
      prefs.setString('ganzabel100', getDataInfo[7]['price'].toString(),);
      prefs.setString('falfal50', getDataInfo[8]['price'].toString(),);
      prefs.setString('falfal100', getDataInfo[9]['price'].toString(),);
      //========================================================
      prefs.setString('qurfa50', getDataInfo[10]['price'].toString(),);
      prefs.setString('qurfa100', getDataInfo[11]['price'].toString(),);
      prefs.setString('quranful50', getDataInfo[12]['price'].toString(),);
      prefs.setString('quranful100', getDataInfo[13]['price'].toString(),);
      prefs.setString('kari', getDataInfo[14]['price'].toString(),);
      prefs.setString('aqashi', getDataInfo[15]['price'].toString(),);
      prefs.setString('mindi', getDataInfo[16]['price'].toString(),);
      prefs.setString('alkarsabi', getDataInfo[17]['price'].toString(),);
      prefs.setString('alburust', getDataInfo[18]['price'].toString(),);
      prefs.setString('alsimsam', getDataInfo[19]['price'].toString(),);


      print("******************************");
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
          title: Container(child: Icon(Icons.verified_user, color: Colors.green,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[
            MaterialButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                return ;
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
               // Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                return ;

              },
            ),
          ],
        );
      },
    );
  }


}

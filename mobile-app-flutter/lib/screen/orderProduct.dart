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
import 'order_details.dart';

class OrderProduct extends StatefulWidget {
  @override
  _OrderProductState createState() => _OrderProductState();
}

class _OrderProductState extends State<OrderProduct> {
  TextEditingController buildTextEditingController(String text) {
    TextEditingController text = TextEditingController();
    return text;
  }

  //ONclick in mune icon dsplay mune
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();

  String _distributerId = "";
  var quantity = 1;
   List listOrdered=[];

  getOrdered()async{

    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();

    final String myString = await sharedPreferences.getString('orderedProducts')!;
     setState(() {
       listOrdered = json.decode(myString);
     });

  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    getOrdered();
    loadedLocalSaveData();
  }



  loadedLocalSaveData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _distributerId = prefs.getString("distribut_id")!;
    });
  }

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
    final ordersProducts = Provider.of<Cards1>(context, listen: false).cards1;
    final products = Provider.of<Products>(context, listen: true).products;


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
      body: Column(
        children: [

          //Call method title and icon mune
          //  _buildTitleSection("طلب المنتجات        \t "),

           Expanded(
              child: products.isNotEmpty
                  ? ListView.builder(
                      padding: const EdgeInsets.all(15.0),
                      itemCount: products.length,
                      itemBuilder: (ctx, i) {
                        return CardWidget(id:products[i].id!);
                      })
                  : const Center(child: Text("لا توجد منتجات ")),

          ),

       ButtonTheme(
              minWidth: 300.0,
              height: 50.0,
              child: MaterialButton(
                textColor: Colors.white,
                color: Palette.mycolor,
                child: Text("طلب المنتجات",
                    style: TextStyle(
                      fontSize: 20,
                      fontFamily: "Almarai",
                    )),
                onPressed: () async {
                 await Provider.of<Orders>(context, listen: false)
                      .addOrder(ordersProducts).then((value) {
                        if(value==true){

                          Navigator.push(context,MaterialPageRoute(builder: (context) => OrderDetails()), );

                        }
                  }

                  );


                  // SaveDataToDB();
                },
                shape: new RoundedRectangleBorder(
                  borderRadius: new BorderRadius.circular(30.0),
                ),
              ),
            ),



          SizedBox(
            height: 30,
          )
        ],
      ),
    );
  }

   PaymentMethods(String name,) {
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        width: double.maxFinite,
        height: 400,
        padding: EdgeInsets.only(top: 10, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart
            Text(listOrdered[0]['quantity'].toString()),
            SizedBox(
              height: 15,
            ),
          ],
        ),
      ),
    );
  }

  // ignore: non_constant_identifier_names

/*
  Future<void> SaveDataToDB() async {

    var rng = new Random();
    var rand1 = rng.nextInt(90000) + 10000;
    var rand2 = rng.nextInt(90000) + 10000;
    var getIDGenerater = rand1 + rand2;

    //Show Dialog)
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(
              status: 'Logging...',
            ));

    var url = dbUrl + "order-product/save";
    var dataStore = {
      "distributer_id": distribut_id,
      "order_id": getIDGenerater.toString(),

      "kasbra100": kasbra100.text.toString(),
      "kasbra50": kasbra50.text.toString(),

      "shmar100": shmar100.text.toString(),
      "shmar50": shmar50.text.toString(),

      "weaka100": weaka100.text.toString(),
      "weaka50": weaka50.text.toString(),

      "ganzabel100": ganzabel100.text.toString(),
      "ganzabel50": ganzabel50.text.toString(),

      "falfal100": falfal100.text.toString(),
      "falfal50": falfal50.text.toString(),

      //
      "qurfa100": qurfa100.text.toString(),
      "qurfa50": qurfa50.text.toString(),

      "quranful100": quranful100.text.toString(),
      "quranful50": quranful50.text.toString(),

      "kari": kari.text.toString(),
      "aqashi": aqashi.text.toString(),

      "mindi": mindi.text.toString(),
      "alkarsabi": alkarsabi.text.toString(),

      "alburust": alburust.text.toString(),
      "alsimsam": alsimsam.text.toString(),


    };


    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    Navigator.pop(context); // show progress Dialog

    if(responseBody['status'] == true){

      if(responseBody['orderReport']['total_price'] == 0){
        showError("معلومات الطلب خطأ الرجاء التحقق من كميات الطلب ");
        return ;
      }

      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.setString('total_price', responseBody['orderReport']['total_price'].toString());

      print(responseBody);
      showSuccess("تم الطلب بنجاح");
      print("تم الطلب بنجاح");


    }else{
      showError("معلومات الطلب خطأ!!");
      print("معلومات الطلب خطأ!!");
    }

  }


 */

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
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => HomeScreen()),
                );
                return;
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
                // Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                return;
              },
            ),
          ],
        );
      },
    );
  }
}

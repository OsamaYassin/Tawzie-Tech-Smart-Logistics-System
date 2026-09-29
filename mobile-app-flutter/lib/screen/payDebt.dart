import 'dart:convert';
import 'dart:math';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:tawzie/screen/login_signup.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:http/http.dart' as http;

import '../configUrl.dart';
import 'home_screen.dart';

class PayDebt extends StatefulWidget {

  final String titleName ;
  final String pointId ;
  final String distribut_id ;
  final String salesId ;
  final String totalPrice ;
  final String chash ;
  final String banckk ;
  final String sheck ;
  final String agel ;

   PayDebt({required this.titleName,  required this.pointId, required this.distribut_id, required this.salesId, required this.chash, required this.agel, required this.totalPrice,  required this.banckk, required this.sheck }) ;


  @override
  _PayDebtState createState() => _PayDebtState(this.titleName,  this.pointId , this.distribut_id ,this.salesId ,this.totalPrice , this.chash , this.banckk , this.sheck , this.agel ,);
}

class _PayDebtState extends State<PayDebt> {

  String ptitleName ;
  String ppointId ;
  String pdistribut_id , psalesId , ptotalPrice ,pchash  ,pbanckk ,psheck  ,pagel;

  _PayDebtState(this.ptitleName, this.ppointId ,this.pdistribut_id, this.psalesId, this.ptotalPrice, this.pchash, this.pbanckk, this.psheck, this.pagel);



  String totalOfOrder = "0";
  bool paymentVisiable = false;
  bool buttonGetTotalVisiable = true;
  bool cardItemsVisiable = true;
  bool buttonSalesVisiable = false;


  TextEditingController chash = TextEditingController()..text="0";
  TextEditingController banckk = TextEditingController()..text="0";
  TextEditingController sheck = TextEditingController()..text="0";
  TextEditingController agel = TextEditingController();



  //ONclick in mune icon dsplay mune
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState> ();

  var textStyle = TextStyle(
    fontSize: 20,
    color: Colors.black,
    fontFamily: "Almarai",
  );



  @override
  Widget build(BuildContext context) {


    //حسب القيم الباقي من السداد القديم
    int valuebuy =  int.parse(pchash) + int.parse(pbanckk) + int.parse(psheck);
    int remainder = int.parse(ptotalPrice)  - valuebuy  ;
    totalOfOrder =  remainder.toString();

    return Scaffold(
      key: scaffoldKey,
      endDrawer: DrawerDesign(),
      appBar: AppBar(
        title: Text(
          "توزيع المنتجات للنقاط ",
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
         // _buildTitleSection("توزيع المنتجات للنقاط  "),
          InfoOfCustomer(ptitleName  ,ptotalPrice ,valuebuy ,remainder),
          
          Expanded(
            child: SingleChildScrollView(
              child: Column(
                children: [

                  PaymentMethods(
                      "كاش",
                      "بنكك",
                      "شيك",
                      "الآجل",
                      chash,
                      banckk,
                      sheck ,
                      agel),




                   Column(
                     children: [
                       ButtonDesign(" سداد تحصيل  " , "sales"),
                       SizedBox( height: 40,),

                       GestureDetector(
                         onTap: (){

                           //Change total of item that get
                           setState(() {
                             paymentVisiable = false;
                             buttonGetTotalVisiable = true;
                             cardItemsVisiable = true;
                             buttonSalesVisiable = false;
                           });

                         },
                         child: GestureDetector(
                           onTap: (){
                             Navigator.pop(context);
                           },
                           child: Row(
                             mainAxisAlignment: MainAxisAlignment.center,
                             children: [
                               Icon(Icons.arrow_back ,color: Colors.blue,),
                               Text("  رجوع " , style: TextStyle( fontSize: 20, color: Colors.blue, fontFamily: "Almarai", ),),

                             ],
                           ),
                         ),
                       ) ,
                     ],
                   ),

                  SizedBox( height: 40,),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }



  Widget CardItemInput(String name, TextEditingController nameController ,[ String payment = "no"]) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Container(
          width: 130,
          height: 55,
          child: TextField(
            controller: nameController,
            textAlign: TextAlign.center,
            keyboardType: TextInputType.phone,
            onChanged: (text) {
              if(payment == "okay"){
                _doSomething(text);
              }

            },
            decoration: InputDecoration(
              enabledBorder: OutlineInputBorder(
                borderSide: BorderSide(color: Palette.textColor1),
                borderRadius: BorderRadius.all(Radius.circular(10.0)),
              ),
              focusedBorder: OutlineInputBorder(
                borderSide: BorderSide(color: Palette.textColor1),
                borderRadius: BorderRadius.all(Radius.circular(10.0)),
              ),
              contentPadding: EdgeInsets.all(10),
              hintText: "000",
              hintStyle: TextStyle(fontSize: 14, color: Palette.textColor1),
            ),
          ),
        ),
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




  // ignore: non_constant_identifier_names
  Widget InfoOfCustomer(String name, String ptotalPrice, int valuebuy, int remainder ){
    var mystyle = TextStyle( color: Colors.black,  fontSize: 17,  fontFamily: "Almarai", fontWeight: FontWeight.bold);
    return Container(
      color: Colors.white,
      width: MediaQuery.of(context).size.width ,
      padding: EdgeInsets.only(right: 30 , top: 10, bottom: 15 ,left: 10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.end,
        mainAxisAlignment: MainAxisAlignment.end,
        children: [

          Row(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Text('$name', style:mystyle,textDirection: TextDirection.rtl,),
              Text('اسم :', style:mystyle,textDirection: TextDirection.rtl,),
            ],
          ),
          SizedBox(height: 10,),

          Row(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Text('$ptotalPrice', style:mystyle,textDirection: TextDirection.rtl,),
              Text(' الاجمالي   :    ', style:mystyle,textDirection: TextDirection.rtl,),
            ],
          ),
          SizedBox(height: 10,),

          Row(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Text('$valuebuy', style:mystyle,textDirection: TextDirection.rtl,),
              Text(' المدفوع   :    ', style:mystyle,textDirection: TextDirection.rtl,),
            ],
          ),
          SizedBox(height: 10,),

          Row(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              Text('$remainder', style:mystyle,textDirection: TextDirection.rtl,),
              Text(' الباقي         :    ', style:mystyle,textDirection: TextDirection.rtl,),
            ],
          ),
          SizedBox(height: 10,),



        ],
      ),
    );
  }


  //show total of sales items

  Widget PaymentMethods(
      String name1,
      String name2,
      String name3,
      String name4,
      TextEditingController edit1,
      TextEditingController edit2,
      TextEditingController edit3,
      TextEditingController edit4) {
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        height: 290,
        padding: EdgeInsets.only(top: 10, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart

            TotalOfOrders(),
            SizedBox(
              height: 15,
            ),

            CardItemInput(name1, edit1 , "okay"),
            CardItemInput(name2, edit2 , "okay"),
            CardItemInput(name3, edit3 , "okay"),
            CardItemInput(name4, edit4 , "okay"),
          ],
        ),
      ),
    );
  }

  Widget TotalOfOrders() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Container(
          child: Text(  totalOfOrder,
            style: TextStyle(
                fontSize: 20, color: Colors.orange, fontFamily: "Almarai"),
          ),
        ),

        SizedBox(width: 5,),
        Text(
        " الباقي  ",
          style: TextStyle(
              fontSize: 20, color: Colors.orange, fontFamily: "Almarai"),
        ),
      ],
    );
  }



  Widget ButtonDesign(String  name ,String type){
    return ButtonTheme(
      minWidth: 300.0,
      height: 50.0,
      child: MaterialButton(
        textColor: Colors.white,
        color: Palette.mycolor,

        child: Text("$name",style: TextStyle( fontSize: 20,
          fontFamily: "Almarai",)),
        onPressed: () async {

          SaveDataToDB();



          //print("**********pointId*********"+ this.pointId);
          // print("**********distribut_id*********"+ this.distribut_id);
          //SaveDataToDB();
        },
        shape: new RoundedRectangleBorder(
          borderRadius: new BorderRadius.circular(30.0),
        ),
      ),
    );
  }

   ProcessOfCalculator(var itme1 , var itme2, double pricr1 , double price2){

     var getItme1 = (itme1.trim().toString().isEmpty)? 0 : double.parse( itme1)  ;
     var getItme2 = (itme2.trim().toString().isEmpty)? 0 : double.parse( itme2)  ;

     double sum = getItme1 * pricr1  + getItme2 * price2 ;

    return sum;
  }

  void _doSomething(String text) {
    setState(() {

      var getItme1 = (chash.text.trim().toString().isEmpty)? 0 : double.parse( chash.text)  ;
      var getItme2 = (banckk.text.trim().toString().isEmpty)? 0 : double.parse( banckk.text)  ;
      var getItme3 = (sheck.text.trim().toString().isEmpty)? 0 : double.parse( sheck.text)  ;

      num sumtiem =  getItme1  + getItme2  + getItme3  ;

      double getAgel = double.parse(totalOfOrder) -  sumtiem ;

      agel.text = getAgel.toString();

    });
  }


  // ignore: non_constant_identifier_names

  Future<void> SaveDataToDB() async {

    print("===========================");


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

    var url = dbUrl + "pay-dept-sales/update";
    var dataStore = {
      "point_id" : ppointId,// pointId,
      "distributer_id": distribut_id,//distribut_id,
      "sales_id":   psalesId,

      "chash": chash.text.trim().toString().isEmpty ? 0 : chash.text.toString(),
      "banckk": chash.text.trim().toString().isEmpty ? 0 : banckk.text.toString(),
      "sheck": chash.text.trim().toString().isEmpty ? 0 : sheck.text.toString(),
      "agel": chash.text.trim().toString().isEmpty ? 0 : agel.text.toString(),

      "oldchash": pchash.toString(),
      "oldbanckk": pbanckk.toString(),
      "oldsheck": psheck.toString(),
      "oldagel": pagel.toString(),


    };

    try{
    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    Navigator.pop(context); // show progress Dialog

    if(responseBody['status'] == true){


      showSuccess("تم الطلب بنجاح");

    }else{
      showError("معلومات الطلب خطأ!!");
      return ;
    }

    }catch(e){
      showError("معلومات الطلب خطأ!!"+e.toString());
    }


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
            TextButton(
              child: const Text("OK"),
              onPressed: () {
                Navigator.of(context).pop();
                return ;
                //Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
              },
            ),
          ],
        );
      },
    );
  }

}






















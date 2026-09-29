import 'dart:convert';
import 'dart:math';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:http/http.dart' as http;
import '../configUrl.dart';
import '../providers/cards1.dart';
import '../providers/orders.dart';
import '../providers/products.dart';
import '../widgets/card_widget.dart';
import 'home_screen.dart';
class ProductDistribution extends StatefulWidget {
  final String titleName ;
  final String descrip ;
  final String pointId ;
  final String distribut_id ;
   ProductDistribution({required this.titleName, required this.descrip, required this.pointId, required this.distribut_id}) ;
  @override
  _ProductDistributionState createState() => _ProductDistributionState(this.titleName, this.descrip, this.pointId , this.distribut_id);
}

class _ProductDistributionState extends State<ProductDistribution> {

  String totalOfOrder = "0";
  bool paymentVisiable = false;
  bool buttonGetTotalVisiable = true;
  bool cardItemsVisiable = true;
  bool buttonSalesVisiable = false;

  TextEditingController kasbra100 = TextEditingController();
  TextEditingController kasbra50 = TextEditingController();

  TextEditingController shmar100 = TextEditingController();
  TextEditingController shmar50 = TextEditingController();

  TextEditingController weaka100 = TextEditingController();
  TextEditingController weaka50 = TextEditingController();

  TextEditingController ganzabel100 = TextEditingController();
  TextEditingController ganzabel50 = TextEditingController();

  TextEditingController falfal100 = TextEditingController();
  TextEditingController falfal50 = TextEditingController();

  ////

  //========================================================

  TextEditingController qurfa100 = TextEditingController();
  TextEditingController qurfa50 = TextEditingController();

  TextEditingController quranful100 = TextEditingController();
  TextEditingController quranful50 = TextEditingController();

  TextEditingController kari = TextEditingController();
  TextEditingController aqashi = TextEditingController();

  TextEditingController mindi = TextEditingController();
  TextEditingController alkarsabi = TextEditingController();

  TextEditingController alburust = TextEditingController();
  TextEditingController alsimsam = TextEditingController();

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

  String titleName ;
  String descrip ;
  String pointId ;
  String distribut_id;

  _ProductDistributionState(this.titleName, this.descrip,this.pointId ,this.distribut_id);

  @override
  Widget build(BuildContext context) {
    print("1111111111111111111111111111111111111111111111111111");
    print(pointId);
    final destProducts = Provider.of<Cards1>(context, listen: false).cards1;
    final products = Provider.of<Products>(context, listen: true).products;

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
          InfoOfCustomer(titleName, descrip),

          Expanded(
            child: SingleChildScrollView(
              child: Column(
                children: [
                 Visibility(
                  visible: cardItemsVisiable,
                  child:
                    Container(
                      height: 550,
                      child: Expanded(
                        child: products.isNotEmpty
                            ? ListView.builder(
                            padding: const EdgeInsets.all(15.0),
                            itemCount: products.length,
                            itemBuilder: (ctx, i) {
                              return CardWidget(id:products[i].id!);
                            })
                            : const Center(child: Text("لا توجد منتجات ")),
                      ),
                    ),),

                  SizedBox(
                    height: 10,
                  ),

                  Visibility(
                    visible: paymentVisiable,
                    //maintainAnimation: true,
                    child: PaymentMethods(
                        "كاش",
                        "بنكك",
                        "شيك",
                        "الآجل",
                        chash,
                        banckk,
                        sheck ,
                        agel),
                  ),
                  Visibility(
                    visible: buttonGetTotalVisiable,
                      child: ButtonDesign(" ارسال" , "getTotal",destProducts)
                  ),

                   Visibility(
                     visible: buttonSalesVisiable,
                     child: Column(
                       children: [
                         ButtonDesign(" بيع المنتجات" , "sales",destProducts),
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
                           child: Row(
                             mainAxisAlignment: MainAxisAlignment.center,
                             children: [
                               Icon(Icons.arrow_back ,color: Colors.blue,),
                               Text("  رجوع " , style: TextStyle( fontSize: 20, color: Colors.blue, fontFamily: "Almarai", ),),

                             ],
                           ),
                         ) ,
                       ],
                     ),
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

  Widget CallAllItemInCard(
      String kasbra100,
      String kasbra50,
      TextEditingController size100,
      TextEditingController size50) {
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        height: 150,
        padding: EdgeInsets.only(top: 10, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart

            SizedBox(
              height: 15,
            ),

            CardItemInput(kasbra100, size100),
            CardItemInput(kasbra50, size50),
          ],
        ),
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




  Widget _buildTitleSection(String title) {
    return Column(

      children: [
        Container(

          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.only(top: 40, bottom: 15, left: 10, right: 20),
          decoration: BoxDecoration(
            color: Palette.mycolor,
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
                onTap:(){
                  scaffoldKey.currentState?.openEndDrawer();
                },
                child: CircleAvatar(
                  backgroundColor: Colors.white,
                  child:Icon(Icons.menu ,color: Colors.black87,) ,
                ),
              ),

            ],

          ),
        ),
      ],
    );
  }


  // ignore: non_constant_identifier_names
  Widget InfoOfCustomer(String name ,String type){
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
              Text('$type', style:mystyle,textDirection: TextDirection.rtl,),
              Text('النوع :', style:mystyle,textDirection: TextDirection.rtl,),
            ],
          ),



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
        " الاجمالي ",
          style: TextStyle(
              fontSize: 20, color: Colors.orange, fontFamily: "Almarai"),
        ),
      ],
    );
  }



  Widget ButtonDesign(String  name ,String type,var productDest){
    return ButtonTheme(
      minWidth: 300.0,
      height: 50.0,
      child: MaterialButton(
        textColor: Colors.white,
        color: Palette.mycolor,

        child: Text("$name",style: TextStyle( fontSize: 20,
          fontFamily: "Almarai",)),
        onPressed: () async {
          if(type == "getTotal"){
            //Change total of item that get
           setState(() {
             totalOfOrder = "99";
             paymentVisiable = true;
              buttonGetTotalVisiable = false;
              cardItemsVisiable = false;
             buttonSalesVisiable = true;
           });
           // print("**********$getTotal*********");
          }else if(type ==  "sales"){
            await Provider.of<Orders>(context, listen: false)
                .productDest(productDest,pointId,chash.text,banckk.text,agel.text,sheck.text).then((value) {
              if(value==true){

               // Navigator.push(context,MaterialPageRoute(builder: (context) => OrderDetails()), );

              }
            }

            );
          }
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

    var url = dbUrl + "sales-product/save";
    var dataStore = {
      "point_id" : pointId,// pointId,
      "distributer_id": distribut_id,//distribut_id,
      "sales_id":  getIDGenerater.toString(),

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

      "chash": chash.text.trim().toString().isEmpty ? 0 : chash.text.toString(),
      "banckk": chash.text.trim().toString().isEmpty ? 0 : banckk.text.toString(),
      "sheck": chash.text.trim().toString().isEmpty ? 0 : sheck.text.toString(),
      "agel": chash.text.trim().toString().isEmpty ? 0 : agel.text.toString(),


    };

    try{
    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    Navigator.pop(context); // show progress Dialog

    if(responseBody['status'] == true){



      if(responseBody['SalesReport']['total_price'] == 0){
        showError("معلومات الطلب خطأ الرجاء التحقق من كميات الطلب ");
        return ;
      }

      SharedPreferences prefs = await SharedPreferences.getInstance();
      //save count of all point and visit or not visit point
      prefs.setString('yesvisit', responseBody['yesvisit'].toString());
      print('-----------========================----------------------------');
      print('count is :  '+responseBody['yesvisit'].toString());

      showSuccess("تم الطلب بنجاح");




    }else{
      showError("معلومات الطلب خطأ!!");
      print("معلومات الطلب خطأ!!");
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
            MaterialButton(
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






















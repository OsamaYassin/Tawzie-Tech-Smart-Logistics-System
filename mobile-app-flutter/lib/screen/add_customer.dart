
import 'dart:convert';
import 'dart:math';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/configUrl.dart';
import 'package:tawzie/screen/drawer_design.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:http/http.dart' as http;



class AddCustomerScreen extends StatefulWidget {
  @override
  _AddCustomerScreenState createState() => _AddCustomerScreenState();
}

class _AddCustomerScreenState extends State<AddCustomerScreen> {

  var _formKey = GlobalKey<FormState>();
  GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState> ();


  // Initial Selected Value
  String dropdownvalue = 'دكان عادي';

  // List of items in our dropdown menu
  var items = ["دكان عادي", "سبرماركت","هايبر ماركت","مطاعم", "مؤسسة", "مدرسة", "كشك",];

  //Register Screen
  TextEditingController nameController = TextEditingController();
  TextEditingController phoneController = TextEditingController();
  TextEditingController areaController = TextEditingController();


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    //loaded Local Save Data Area
    loadedLocalSaveDataArea();
  }

  loadedLocalSaveDataArea() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    distribut_id =  prefs.getString("distribut_id")!;

    if (prefs.containsKey("areaOfPoint")) {
      setState(() {
        areaController.text =  prefs.getString("areaOfPoint")!;
      });
    }

  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      key: scaffoldKey,
      endDrawer:DrawerDesign(),
      appBar: AppBar(
        title: Text(
          "اضافة نقطة بيع جديدة",
          style: TextStyle(
              color: Colors.white,
              fontSize: 20,
              fontFamily: "Almarai",
              fontWeight: FontWeight.bold),
        ),
        backgroundColor: Palette.mycolor,
        centerTitle: true,
      ),

      body: SingleChildScrollView(
        child: Column(
          children: [
            //Call method title and icon mune

            SizedBox(height: 20,),
            Form(
              key: _formKey,
              child: Column(
                children: [
                  FormTextFeildDesign("ادخل اسم النقطة البيع" ,nameController ,TextInputType.text),
                  FormTextFeildDesign("رقم الهاتف" ,phoneController ,TextInputType.phone),
                  FormTextFeildDesign(" المنطقة  " ,areaController ,TextInputType.text),
                ],
              ),
            ),

         /*  Padding(
              padding: const EdgeInsets.all(16.0),
              child: Directionality(
                textDirection: TextDirection.rtl,
                child: Container(
                  alignment: Alignment.centerRight,
                  padding: EdgeInsets.only(left: 16, right: 16, top: 5,bottom: 5),
                  decoration: BoxDecoration(
                      border: Border.all(color: Colors.black26,width: 1),
                      borderRadius: BorderRadius.circular(5)
                  ),
                  child: DropdownButton(
                    value: _valueChose,
                    hint: Text("نوع  نقطة البيع", style: TextStyle( fontFamily: "Almarai",fontSize: 15),),
                    isExpanded: true,
                    underline: SizedBox(),
                    style:TextStyle(
                      color: Colors.black87,
                      fontSize: 22,

                    ),
                    onChanged: (newValue){
                      setState(() {
                        _valueChose = newValue.toString();
                      });
                    },
                    items:listItem.map((e) {
                      return DropdownMenuItem(
                        value: e,
                        child: Container(
                          alignment: Alignment.centerRight,
                            child: Text(e ,  textDirection: TextDirection.rtl,style: TextStyle( fontFamily: "Almarai",fontSize: 15),)),
                      );
                    }).toList(),
                  ),
                ),
              ),
            ),*/

              Padding(
              padding: const EdgeInsets.all(16.0),
              child: Directionality(
                textDirection: TextDirection.rtl,
                child: Container(
                  alignment: Alignment.centerRight,
                  padding: EdgeInsets.only(left: 16, right: 16, top: 5,bottom: 5),
                  decoration: BoxDecoration(
                      border: Border.all(color: Colors.black26,width: 1),
                      borderRadius: BorderRadius.circular(5)
                  ),
                  child:DropdownButton(

                    // Initial Value
                    value: dropdownvalue,
                    isExpanded: true,
                    underline: SizedBox(),
                    style:TextStyle(
                      color: Colors.black87,
                      fontSize: 22,),

                    // Down Arrow Icon
                    icon: const Icon(Icons.keyboard_arrow_down),

                    // Array list of items
                    items: items.map((String items) {
                      return DropdownMenuItem(
                        value: items,
                        child: Container(
                            alignment: Alignment.centerRight,
                            child: Text(items ,  textDirection: TextDirection.rtl,style: TextStyle( fontFamily: "Almarai",fontSize: 15))
                        ),
                      );
                    }).toList(),
                    // After selecting the desired option,it will
                    // change button value to selected value
                    onChanged: (String? newValue) {
                      setState(() {
                        dropdownvalue = newValue!;
                      });
                    },
                  ),
                ),
              ),
            ),


            SizedBox(height: 20,),

           // LatLang(),

            SizedBox(height: 30,),

            ButtonDesign(),

            SizedBox(height: 20,),
          ],
        ),
      ),
    );
  }


  Widget FormTextFeildDesign(String namelable , TextEditingController nameController ,TextInputType typeInput){

    return  Container(
      padding: EdgeInsets.all(20),
      child: Directionality(
        textDirection: TextDirection.rtl,
        child: TextFormField(
          controller: nameController,
          keyboardType: typeInput,
          textAlign: TextAlign.right,
          validator: (var value){
            if(value!.isEmpty)
              return "الرجاء ملء الحقل";
            else
              return null;
          },
          decoration: InputDecoration(
            hintText: namelable,
            labelText:  namelable,
            border: OutlineInputBorder(),
            labelStyle: TextStyle(fontSize: 16, color: Colors.black87,fontFamily: "Almarai",),

          ),
        ),
      ),
    );
  }

  Widget LatLang(){
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceAround,
      children: [
        Text("Latitude : "+latitude ,style: TextStyle(color: Colors.black12),),
        Text("Longitude : "+ longitude,style: TextStyle(color: Colors.black12))
      ],
    );
  }

  Widget ButtonDesign(){
    return ButtonTheme(
      minWidth: 300.0,
      height: 50.0,
      child: MaterialButton(
        textColor: Colors.white,
        color: Palette.mycolor,

        child: Text("اضافة نقطة البيع",style: TextStyle( fontSize: 20,
          fontFamily: "Almarai",)),
        onPressed: () {
          setState(()   {


            if(nameController.text.isEmpty ){
              showSnackBar(' ادخل اسم نقطة البيع ');
              return ;
            }
            if(phoneController.text.isEmpty ){
              showSnackBar(' ادخل  رقم الهاتف ');
              return ;
            }

            addNewSellPoint();


          });
        },
        shape: new RoundedRectangleBorder(
          borderRadius: new BorderRadius.circular(30.0),
        ),
      ),
    );
  }


  Future<void> addNewSellPoint() async {

    var rng = new Random();
    var rand1 = rng.nextInt(90000) + 10000;
    var rand2 = rng.nextInt(90000) + 10000;
    var getIDGenerater = rand1 + rand2;

    //Show Dialog
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
    );

    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if(connectivityResult != ConnectivityResult.mobile && connectivityResult != ConnectivityResult.wifi  ){
      showError("لا يوجد اتصال بالانترنت");
      return ;
    }


    var url = dbUrl + "point/save";

    var dataStore = {
      "point_id": getIDGenerater.toString(),
      "point_name":   nameController.text.toString(),
      "phone":   phoneController.text.toString(),
      "type":  dropdownvalue,
      "area":  areaController.text.toString(),
      "distribut_id":  distribut_id,
      "latitude":   latitude,
      "longitude":longitude,
    };

    var response = await http.post(Uri.parse(url) ,body: dataStore);
    var responseBody = jsonDecode(response.body);

    Navigator.pop(context); // show progress Dialog

    if(responseBody['status'] == true){

      SharedPreferences prefs = await SharedPreferences.getInstance();
      //save count of all point and visit or not visit point
      prefs.setString('allpoint', responseBody['allpoint'].toString());
      prefs.setString('yesvisit', responseBody['yesvisit'].toString());

      print('---------------------------');
    //  print(responseBody['distributionPoint'].toString());

      // save area in local device for next adding new point of sales
      prefs.setString('areaOfPoint', areaController.text.toString());

      showSuccess("تم اضافة بنجاح");
      nameController.clear();
      phoneController.clear();


    }else{
      showError("معلومات اضافة خطأ!!");
    }

  }



  void showSnackBar(String title){
    final snackbar = SnackBar(
      backgroundColor: Colors.red,
      content: Text(title, textAlign: TextAlign.center, style: TextStyle(fontSize: 15 ,fontFamily: "Almarai"),),
    );

    ScaffoldMessenger.of(context).showSnackBar(snackbar);
  }


  void showSuccess(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Container(child: Icon(Icons.verified_user, color: Colors.green,size: 60,),  ),
          content: Text(message ,textAlign: TextAlign.center, style: TextStyle( fontFamily: "Almarai",),),
          actions: <Widget>[
            TextButton(
              child: const Text("OK"),
              onPressed: () {
                 Navigator.of(context).pop();
              //  Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
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
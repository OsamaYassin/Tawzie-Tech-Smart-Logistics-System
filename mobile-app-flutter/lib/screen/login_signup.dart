import 'dart:convert';
import 'dart:math';
import 'package:provider/provider.dart';
import 'package:tawzie/providers/sale_points.dart';
import 'package:tawzie/screen/home_screen.dart';
import 'package:tawzie/widgets/ProgressDialog.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
//import 'package:flutter_icons/flutter_icons.dart';
import 'package:tawzie/config/palette.dart';
import 'package:tawzie/configMap.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/configUrl.dart';

import 'package:connectivity/connectivity.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import '../providers/products.dart';

class LoginSignupScreen extends StatefulWidget {
  @override
  _LoginSignupScreenState createState() => _LoginSignupScreenState();
}

class _LoginSignupScreenState extends State<LoginSignupScreen> {
  bool isSignupScreen = false;
  bool isMale = true;
  bool isRememberMe = false;

  //Register Screen
  TextEditingController fullNameController = TextEditingController();
  TextEditingController emailController = TextEditingController();
  TextEditingController userNameController = TextEditingController();
  TextEditingController phoneController = TextEditingController();
  TextEditingController carNumberController = TextEditingController();
  TextEditingController areaDistributerController = TextEditingController();

  //Login Screen
  TextEditingController loginUserNameController = TextEditingController();
  TextEditingController loginEmailController = TextEditingController();

  @override
  void initState() {
    // TODO: implement initState
    super.initState();

    Provider.of<Products>(context, listen: false).fetchProducts();
    Provider.of<SalePoints>(context, listen: false).fetchSalepoints();

    checkLoginExist();
  }

  checkLoginExist() async {
    //check if he/she Login before
    SharedPreferences prefs = await SharedPreferences.getInstance();
    if (prefs.containsKey("username")) {
      Navigator.of(context).pushReplacement(new MaterialPageRoute(
          builder: (BuildContext context) => HomeScreen()));

      GetProductPrice();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: scaffoldKey,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
      ),
      backgroundColor: Colors.white, // Palette.backgroundColor,
      resizeToAvoidBottomInset: true,

      body: SingleChildScrollView(
        child: Column(
          children: [
            SizedBox(
              height: 3,
            ),
            Container(
              height: 160,
              width: MediaQuery.of(context).size.width,
              // color: Colors.deepOrange,
              child: Center(
                  child: Image.asset(
                "images/logotawz.png",
                height: 150,
                width: 300,
              )),

              //Image.asset("images/TawzieTech.jpg" , height: 600,width: 600,)
            ),
            SizedBox(
              height: 20,
            ),
            AnimatedContainer(
              duration: Duration(milliseconds: 700),
              curve: Curves.bounceInOut,
              padding: EdgeInsets.all(20),
              // margin: EdgeInsets.all(20),
              height: isSignupScreen ? 510 : 310,
              width: MediaQuery.of(context).size.width - 40,
              margin: EdgeInsets.symmetric(horizontal: 20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(15),
                boxShadow: [
                  BoxShadow(
                      color: Colors.grey.withOpacity(0.3),
                      blurRadius: 15,
                      spreadRadius: 2),
                ],
              ),
              child: SingleChildScrollView(
                child: Column(
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        GestureDetector(
                          onTap: () {
                            setState(() {
                              isSignupScreen = false;
                            });
                          },
                          child: Column(
                            children: [
                              Text(
                                "تسجيل الدخول",
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                  fontFamily: "Almarai",
                                  color: isSignupScreen
                                      ? Palette.textColor1
                                      : Palette.activeColor,
                                ),
                              ),
                              if (!isSignupScreen)
                                Container(
                                  margin: EdgeInsets.only(top: 3),
                                  height: 2,
                                  width: 65,
                                  color: Colors.orange,
                                ),
                            ],
                          ),
                        ),
                        GestureDetector(
                          onTap: () {
                            setState(() {
                              isSignupScreen = true;
                            });
                          },
                          child: Column(
                            children: [
                              Text(
                                "التسجيل",
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                  fontFamily: "Almarai",
                                  color: isSignupScreen
                                      ? Palette.activeColor
                                      : Palette.textColor1,
                                ),
                              ),
                              if (isSignupScreen)
                                Container(
                                  margin: EdgeInsets.only(top: 3),
                                  height: 2,
                                  width: 55,
                                  color: Colors.orange,
                                ),
                            ],
                          ),
                        ),
                      ],
                    ),

                    //Start textField desgin
                    //check if is screen sign up
                    if (isSignupScreen) buildSignUpSection(),
                    //check if is screen does not sign up
                    if (!isSignupScreen)
                      Container(
                        margin: EdgeInsets.only(top: 20),
                        child: Column(
                          children: [
                            buildTextField(
                                Icons.perm_identity,
                                "اسم المستخدم",
                                false,
                                false,
                                loginUserNameController,
                                TextInputType.text),
                            SizedBox(
                              height: 10,
                            ),
                            buildTextField(
                                Icons.password_outlined,
                                "رمز الدخول",
                                false,
                                true,
                                loginEmailController,
                                TextInputType.text),
                            Center(
                              child: Container(
                                height: 90,
                                width: 90,
                                padding: EdgeInsets.all(15),
                                decoration: BoxDecoration(
                                  color: Colors.white,
                                  borderRadius: BorderRadius.circular(50),
                                ),
                                child: GestureDetector(
                                  onTap: () async {
                                    // Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                                    //check network availabilty
                                    var connectivityResult =
                                        await Connectivity()
                                            .checkConnectivity();
                                    if (connectivityResult !=
                                            ConnectivityResult.mobile &&
                                        connectivityResult !=
                                            ConnectivityResult.wifi) {
                                      showError("لا يوجد اتصال بالانترنت");
                                      //showSnackBar('لا يوجد اتصال بالانترنت');
                                      return;
                                    }

                                    if (!isSignupScreen) {
                                      if (loginUserNameController
                                          .text.isEmpty) {
                                        showSnackBar(' ادخل   اسم المستخدم');
                                        return;
                                      }
                                      if (loginEmailController.text.isEmpty) {
                                        showSnackBar(
                                            ' ادخل رمز الدخول بطريقة صحيحة ');
                                        return;
                                      }

                                      CheckLogin();
                                    }

                                    if (isSignupScreen) {
                                      if (fullNameController.text.isEmpty) {
                                        showSnackBar(' ادخل الاسم كامل');
                                        return;
                                      }
                                      if (userNameController.text.isEmpty) {
                                        showSnackBar(' ادخل    اسم المستخدم');
                                        return;
                                      }
                                      if (emailController.text.isEmpty) {
                                        showSnackBar(
                                            ' ادخل رمز الدخول بطريقة صحيحة ');
                                        return;
                                      }
                                      if (phoneController.text.isEmpty) {
                                        showSnackBar(' ادخل الهاتف ');
                                        return;
                                      }
                                      if (carNumberController.text.isEmpty) {
                                        showSnackBar(' ادخل رقم العربة ');
                                        return;
                                      }
                                      if (areaDistributerController
                                          .text.isEmpty) {
                                        showSnackBar(' ادخل منطقة التوزيع ');
                                        return;
                                      }

                                      addDataRegister();
                                    }
                                  },
                                  child: Container(
                                    decoration: BoxDecoration(
                                      gradient: LinearGradient(
                                        colors: [
                                          Color.fromARGB(255, 70, 91, 169),
                                          Color.fromARGB(255, 7, 45, 187)
                                        ],
                                      ),
                                      borderRadius: BorderRadius.circular(30),
                                    ),
                                    child: Icon(Icons.arrow_back,
                                        color: Colors.white),
                                  ),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                  ],
                ),
              ),
            ),
            SizedBox(
              height: 30,
            ),
            Text("version 1.0"),
          ],
        ),
      ),
    );
  }

  Container buildSignUpSection() {
    return Container(
      margin: EdgeInsets.only(top: 20),
      child: Column(
        children: [
          buildTextField(Icons.perm_identity, "اسم كامل", false, false,
              fullNameController, TextInputType.text),
          buildTextField(Icons.verified_user, "اسم المستخدم", false, false,
              userNameController, TextInputType.text),
          buildTextField(Icons.password_outlined, "رمز الدخول", false, true,
              emailController, TextInputType.text),
          buildTextField(Icons.phone, "رقم الهاتف", false, false,
              phoneController, TextInputType.phone),
          buildTextField(Icons.car_crash, "رقم العربية", false, false,
              carNumberController, TextInputType.phone),
          buildTextField(Icons.area_chart_rounded, "منطقة التوزيع", false,
              false, areaDistributerController, TextInputType.text),
          Center(
            child: Container(
              height: 90,
              width: 90,
              padding: EdgeInsets.all(15),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(50),
              ),
              child: GestureDetector(
                onTap: () async {
                  // Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
                  //check network availabilty
                  var connectivityResult =
                      await Connectivity().checkConnectivity();
                  if (connectivityResult != ConnectivityResult.mobile &&
                      connectivityResult != ConnectivityResult.wifi) {
                    showError("لا يوجد اتصال بالانترنت");
                    //showSnackBar('لا يوجد اتصال بالانترنت');
                    return;
                  }

                  if (!isSignupScreen) {
                    if (loginUserNameController.text.isEmpty) {
                      showSnackBar(' ادخل   اسم المستخدم');
                      return;
                    }
                    if (loginEmailController.text.isEmpty) {
                      showSnackBar(' ادخل رمز الدخول بطريقة صحيحة ');
                      return;
                    }

                    // CheckLogin();
                  }

                  if (isSignupScreen) {
                    if (fullNameController.text.isEmpty) {
                      showSnackBar(' ادخل الاسم كامل');
                      return;
                    }
                    if (userNameController.text.isEmpty) {
                      showSnackBar(' ادخل    اسم المستخدم');
                      return;
                    }
                    if (emailController.text.isEmpty) {
                      showSnackBar(' ادخل رمز الدخول بطريقة صحيحة ');
                      return;
                    }
                    if (phoneController.text.isEmpty) {
                      showSnackBar(' ادخل الهاتف ');
                      return;
                    }
                    if (carNumberController.text.isEmpty) {
                      showSnackBar(' ادخل رقم العربة ');
                      return;
                    }
                    if (areaDistributerController.text.isEmpty) {
                      showSnackBar(' ادخل منطقة التوزيع ');
                      return;
                    }

                    addDataRegister();
                  }
                },
                child: Container(
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        Color.fromARGB(255, 70, 91, 169),
                        Color.fromARGB(255, 7, 45, 187)
                      ],
                    ),
                    borderRadius: BorderRadius.circular(30),
                  ),
                  child: Icon(Icons.arrow_back, color: Colors.white),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget buildTextField(
      IconData icon,
      String hintText,
      bool isPassword,
      bool isEmail,
      TextEditingController nameController,
      TextInputType typeInput) {
    return Padding(
      padding: EdgeInsets.only(bottom: 8.0),
      child: TextFormField(
        controller: nameController,
        textAlign: TextAlign.right,
        obscureText: isPassword,
        keyboardType: typeInput,
        // keyboardType: isEmail ? TextInputType.emailAddress : TextInputType.text,
        decoration: InputDecoration(
          suffixIcon: Icon(
            icon,
            color: Palette.iconColor,
          ),
          enabledBorder: OutlineInputBorder(
            borderSide: BorderSide(color: Palette.textColor1),
            borderRadius: BorderRadius.all(Radius.circular(35.0)),
          ),
          focusedBorder: OutlineInputBorder(
            borderSide: BorderSide(color: Palette.textColor1),
            borderRadius: BorderRadius.all(Radius.circular(35.0)),
          ),
          contentPadding: EdgeInsets.all(10),
          hintText: hintText,
          hintStyle: TextStyle(fontSize: 14, color: Palette.textColor1),
        ),
      ),
    );
  }

  final GlobalKey<ScaffoldState> scaffoldKey = new GlobalKey<ScaffoldState>();

  void showSnackBar(String title) {
    final snackbar = SnackBar(
      backgroundColor: Colors.red,
      content: Text(
        title,
        textAlign: TextAlign.center,
        style: TextStyle(fontSize: 15, fontFamily: "Almarai"),
      ),
    );

    ScaffoldMessenger.of(context).showSnackBar(snackbar);
  }

  Future<void> addDataRegister() async {
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

    var url = dbUrl + "save";
    var dataStore = {
      "distribut_id": getIDGenerater.toString(),
      "name": fullNameController.text.toString(),
      "username": userNameController.text.toString(),
      "phone": phoneController.text.toString(),
      "email": emailController.text.toString(),
      "vihicle_no": carNumberController.text.toString(),
      "admin_id": "0",
      "area_name": areaDistributerController.text.toString(),
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      prefs.setString(
        'distribut_id',
        getIDGenerater.toString(),
      );
      prefs.setString('username', userNameController.text.toString());
      prefs.setString('fullName', fullNameController.text.toString());
      prefs.setString('email', emailController.text.toString());
      print(responseBody);
      showSuccess("تم التسجيل بنجاح");

      setState(() {
        isSignupScreen = false;
      });
    } else {
      showError("معلومات التسجيل خطأ!!");
    }
  }

  Future<void> CheckLogin() async {
    //Show Dialog)
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (BuildContext context) => ProgressDialog(
              status: 'Logging...',
            ));

    var url = dbUrl + "login";
    var dataStore = {
      "username": loginUserNameController.text.toString(),
      "password": loginEmailController.text.toString(),
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    print("11111111111111111111111111111111111111111111111");
    print(response.body);
    print("11111111111111111111111111111111111111111111111");

    var responseBody = jsonDecode(response.body);
    Navigator.pop(context); // show progress Dialog

    if (responseBody['status'] == true) {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      List getDataInfo = responseBody['distributerInfo'];
      prefs.setString(
          'distribut_id', getDataInfo[0]['id'].toString());
          print(getDataInfo[0]['distribut_id'].toString());
      prefs.setString('username', getDataInfo[0]['username'].toString());
      prefs.setString('fullName', getDataInfo[0]['name'].toString());
      prefs.setString('email', getDataInfo[0]['email'].toString());

      print(getDataInfo);
      showSuccess("تم التسجيل بنجاح", "login");
      // Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );

    } else {
      showError("معلومات التسجيل خطأ!!");
      showSnackBar('خطأ في التسجيل');
      return;
    }
  }

  void showSuccess(String message, [String type = "register"]) {
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
                if (type == "login") {
                  Navigator.of(context).pushReplacement(new MaterialPageRoute(
                      builder: (BuildContext context) => HomeScreen()));
                }
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
                return;
                //  Navigator.push(context,MaterialPageRoute(builder: (context) => HomeScreen()), );
              },
            ),
          ],
        );
      },
    );
  }

  Future<void> GetProductPrice() async {
    // Future.delayed(Duration.zero, () => showAlert(context));
    //Show Dialog)
    //   showDialog(
    //     barrierDismissible: false,
    //     context: context,
    //     builder: (BuildContext context) => ProgressDialog(status: 'Logging...',)
    // );

    //check network availabilty
    var connectivityResult = await Connectivity().checkConnectivity();
    if (connectivityResult != ConnectivityResult.mobile &&
        connectivityResult != ConnectivityResult.wifi) {
      // showError("لا يوجد اتصال بالانترنت");
      //showSnackBar('لا يوجد اتصال بالانترنت');
      print("لا يوجد اتصال بالانترنت");
      return;
    }

    var url = dbUrl + "product/price";
    var dataStore = {
      "distribut_id": "distribut_id",
    };

    var response = await http.post(Uri.parse(url), body: dataStore);
    var responseBody = jsonDecode(response.body);

    // Navigator.pop(context); // show progress Dialog

    SharedPreferences prefs = await SharedPreferences.getInstance();

    if (responseBody['status'] == true) {
      List getDataInfo = responseBody['productPrice'];

      prefs.setString(
        'muqasharfalit1k',
        getDataInfo[0]['price'].toString(),
      );
      prefs.setString(
        'firishkirtun',
        getDataInfo[1]['price'].toString(),
      );
      prefs.setString(
        'muqashar10gm',
        getDataInfo[2]['price'].toString(),
      );
      prefs.setString(
        'muqashar100gm',
        getDataInfo[3]['price'].toString(),
      );
      prefs.setString(
        'mashuqfalit1k',
        getDataInfo[4]['price'].toString(),
      );
      prefs.setString(
        'mujafaffalit1k',
        getDataInfo[5]['price'].toString(),
      );
      prefs.setString(
        'basalmujafaf1k',
        getDataInfo[6]['price'].toString(),
      );
      prefs.setString(
        'mashuqfalit100gm',
        getDataInfo[7]['price'].toString(),
      );
      prefs.setString(
        'basalmujafafmashun100gm',
        getDataInfo[8]['price'].toString(),
      );
      prefs.setString(
        'basalmujafafmashun1k',
        getDataInfo[9]['price'].toString(),
      );

      print("******************************");
      print(getDataInfo[0]['price']);
    } else {
      //showError("معلومات اضافة خطأ!!");
      return;
    }

    // return ;
  }
}

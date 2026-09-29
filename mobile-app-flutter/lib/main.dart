import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:tawzie/providers/cards1.dart';
import 'package:tawzie/providers/orders.dart';
import 'package:tawzie/providers/products.dart';
import 'package:tawzie/providers/sale_points.dart';
import 'package:tawzie/screen/home_screen.dart';
import 'package:tawzie/screen/login_signup.dart';
void main() {
  runApp(LoginSignupUI());
}


class LoginSignupUI extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_)=>Products()),
        ChangeNotifierProvider(create: (_)=>Orders()),
        ChangeNotifierProvider(create: (_)=>Cards1()),
        ChangeNotifierProvider(create: (_)=>SalePoints()),
      ],
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: "Login Signup UI",
        // home: ViewCustomerScreen(),
        home:LoginSignupScreen(),
        // check internet
       //  home:HomeScreen() ,
        // home:OrderProduct() ,
      ),
    );
  }
}
import 'dart:convert';
import 'dart:io';
import 'dart:math';
import 'package:dio/dio.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/getSetData.dart';
import 'package:tawzie/models/order.dart';
import '../configUrl.dart';
import '../models/card1.dart';
import '../models/product.dart';
import 'package:flutter/material.dart';

class Orders with ChangeNotifier {
  bool success = false;
  String basicUrl = dbUrl;
  List<Order> _orders = [];

  List<Order> get orders {
    return [..._orders];
  }


bool result=false;

  Future<bool> addOrder(List<Card1> card) async {
    final sampleData=card.map((e) =>{
      "price":e.price,
      "name": e.product_name,
      "quantity": e.quantity
    } ).toList();
    List products = [];
    for (int i = 0; i < card.length; i++) {
      int total_price=int.parse(card[i].price)*card[i].quantity;
      products.add(
          {"total_price":total_price,  "product_id": card[i].product_id,"product_price": card[i].price,
            "quantity": card[i].quantity});
    }

    String myUrl = 'http://192.168.43.241/tawzie-project/tawzie-new-version/api/order-product/save';
    try {
      var rng = new Random();
      var rand1 = rng.nextInt(90000) + 10000;
      var rand2 = rng.nextInt(90000) + 10000;
      var getIDGenerater = rand1 + rand2;

      Dio dio = new Dio();
      dio.options.headers = {
      };
      FormData formData = FormData.fromMap({
        "order_id": getIDGenerater.toString(),
        "distributer_id": distribut_id.toString(),
        "productsitems": products
      });
      Response response = await dio.post(myUrl, data: formData);
      if(response.data['status']==true){
        result=true;
        print(response.data['status']);
        SharedPreferences prefs = await SharedPreferences.getInstance();
        prefs.setString('orderedProducts',json.encode(sampleData));
      }

    } catch (e) {
      print('exception: ' + e.toString());
      Future.error(e.toString());
    }
    return result;
  }

  Future<bool> productDest(List<Card1> card,String pointId, String chash ,String banckk,String agel,String sheck ) async {
    final sampleData=card.map((e) =>{
      "price":e.price,
      "name": e.product_name,
      "quantity": e.quantity
    } ).toList();
    List products = [];
    for (int i = 0; i < card.length; i++) {
      int total_price=int.parse(card[i].price)*card[i].quantity;
      products.add(
          {"total_price":total_price,  "product_id": card[i].product_id,"product_price": card[i].price,
            "quantity": card[i].quantity});
    }

    String myUrl = 'http://192.168.43.241/tawzie-project/tawzie-new-version/api/sales-product/save';
    try {
      var rng = new Random();
      var rand1 = rng.nextInt(90000) + 10000;
      var rand2 = rng.nextInt(90000) + 10000;
      var getIDGenerater = rand1 + rand2;

      Dio dio = new Dio();
      dio.options.headers = {
      };
      FormData formData = FormData.fromMap({
        "sales_id": getIDGenerater.toString(),
        "point_id":pointId,
        "chash":chash,
        "banckk":banckk,
        "sheck":sheck,
        "agel":agel,
        "distributer_id": distribut_id.toString(),
        "productsitems": products
      });

      Response response = await dio.post(myUrl, data: formData);
      print("777777777777777777777777777777777777777777777777777777777777777");
      print(response.data);
      print("777777777777777777777777777777777777777777777777777777777777777");

      if(response.data['status']==true){
        result=true;
        print(response.data['status']);

      }

    } catch (e) {
      print('exception: ' + e.toString());
      Future.error(e.toString());
    }
    return result;
  }
  /*Future<void> addOrder(List<Card1> card) async {
    print("******************************************************");
    for (int i = 0; i < card.length; i++) {
      print(card[i].quantity);
    }
    print("8888888888888888888888888888888888888888888888");
    try {
      var rng = new Random();
      var rand1 = rng.nextInt(90000) + 10000;
      var rand2 = rng.nextInt(90000) + 10000;
      var getIDGenerater = rand1 + rand2;

      List products = [];
      for (int i = 0; i < card.length; i++) {
        products.add(
            {"product_id": card[i].product_id, "quantity": card[i].quantity});
      }
      print("8888888888888888888888888888888888888888888888");

      final url = Uri.parse('$basicUrl' + 'order-product/save');
      final response = await http.post(url, headers: {
      }, body: {
        "order_id": getIDGenerater.toString(),
        "distributer_id": distribut_id.toString(),
        "productsitems": products
      });
      print("8888888888888888888888888888888888888888888888");

      final extractedData = json.decode(response.body) as Map<String, dynamic>;

      if (extractedData['status'] == true) {
        print('===================================================');
        print(extractedData);
      }
    } catch (error) {
      return;
    }
  }*/

  Future<void> fetchOrders() async {
    try {
        final url = Uri.parse('$basicUrl'+'display-orders/userId');
       final response = await http.get(url, headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      });
      final extractedData = json.decode(response.body) as Map<String, dynamic>;
      final List<Order> loadedData = [];

      for (int i = 0; i < extractedData["products"].length; i++) {
        loadedData.add(
          Order(
            id: extractedData["products"][i]["order_id"].toString(),
            user_id: extractedData["products"][i]["user_id"].toString(),
            products: [],
          ),
        );
      }
      _orders = loadedData;
      notifyListeners();
    } catch (error) {
      return;
    }
  }


}

import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:tawzie/models/order.dart';
import '../config/palette.dart';
import '../configUrl.dart';
import '../models/card1.dart';
import '../models/product.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class Cards1 with ChangeNotifier {
  List<Card1> cards1 = [];

  int? quantityExist(String id)
  {
    for (int i = 0; i < cards1.length; i++) {
      if (cards1[i].product_id.toString()==id.toString()) {
       return cards1[i].quantity;
        break;
      }
    }
  }

  addToCard(String id, String price, int quantity,String name) {
    if (chckIfExist(id) == true) {
      for (int i = 0; i < cards1.length; i++) {
      if (cards1[i].product_id.toString()==id.toString()) {
        cards1[i].quantity=quantity;
        break;
      }}
    } else {
      cards1.add(Card1(product_id: id, price: price, quantity: quantity,product_name: name));
    }
    notifyListeners();
  }

  bool chckIfExist(String id) {
    bool x = false;
    for (int i = 0; i < cards1.length; i++) {
      if (cards1[i].product_id.toString()==id.toString()) {
        x = true;
      }

    }
    return x;
  }

  var data = [
    {
      "user_id": "6",
      "products": [
        {"product_id": "1", "quantity": "9", "price": "200"},
        {"product_id": "2", "quantity": "6"},
        {"product_id": "3", "quantity": "7"}
      ]
    },
    {
      "order_id": "2",
      "user_id": "8",
      "products": [
        {"product_id": "3", "quantity": "5"},
        {"product_id": "2", "quantity": "6"},
        {"product_id": "3", "quantity": "7"}
      ]
    }
  ];
}

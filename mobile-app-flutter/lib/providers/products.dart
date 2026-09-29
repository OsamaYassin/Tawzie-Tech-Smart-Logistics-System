import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import '../configUrl.dart';
import '../models/product.dart';
import 'package:flutter/material.dart';

class Products with ChangeNotifier {
  bool success = false;
  String basicUrl = dbUrl;
  List<Product> _products = [];

  List<Product> get products {
    return [..._products];
  }

  Product findProductById(String id) {
    return _products.firstWhere((prod) => prod.id == id);
  }

  Future<void> fetchProducts() async {
    try {
        final url = Uri.parse('$basicUrl'+'display-prodeuct');
       final response1 = await http.get(url, headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      });
      final extractedData = json.decode(response1.body) as Map<String, dynamic>;
print(response1.body);
      final List<Product> loadedData = [];

      for (int i = 0; i < extractedData["products"].length; i++) {
        loadedData.add(
          Product(
            id: extractedData["products"][i]["id"].toString(),
            name: extractedData["products"][i]["product_name"],
            description: extractedData["products"][i]["descrip"],
            price: extractedData["products"][i]["price"].toString(),
          ),
        );
      }
      _products = loadedData;
      notifyListeners();
    } catch (error) {
      return;
    }
  }


}

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:tawzie/config/getSetData.dart';
import '../configUrl.dart';
import 'package:flutter/material.dart';
import '../models/sale_point.dart';

class SalePoints with ChangeNotifier {
  bool success = false;
  String basicUrl = dbUrl;
  List<SalePoint> _salePoints = [];

  List<SalePoint> get salePoints {
    return [..._salePoints];
  }

  Future<void> fetchSalepoints() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    final dist = sharedPreferences.getString("distribut_id");

    print("888888888888888888888888888888888888888");
    print(dist);
    print("888888888888888888888888888888888888888");
    try {
      final url = Uri.parse('$basicUrl' + 'point/distributor-point');
      final response1 = await http.post(url, headers: {
        "Accept": "application/json",
      }, body: {
        "distribut_id": dist,
      });
      print(response1.body);

      final extractedData = json.decode(response1.body) as Map<String, dynamic>;

      final List<SalePoint> loadedData = [];

      for (int i = 0; i < extractedData["distributionPoint"].length; i++) {
        loadedData.add(
          SalePoint(
              visit: extractedData["distributionPoint"][i]["visit"].toString(),
              point_name: extractedData["distributionPoint"][i]["point_name"].toString(),
              point_id: extractedData["distributionPoint"][i]["id"].toString(),
              latitude: extractedData["distributionPoint"][i]["latitude"].toString(),
              longitude: extractedData["distributionPoint"][i]["longitude"].toString(),
              type: extractedData["distributionPoint"][i]["type"].toString()),
        );
      }
      _salePoints = loadedData;
      notifyListeners();
    } catch (error) {
      print(error);
    }
  }
}

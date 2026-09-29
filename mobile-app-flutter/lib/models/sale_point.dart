import 'package:flutter/foundation.dart';

class SalePoint with ChangeNotifier {
  String? visit;
  String? point_name;
  String? point_id;
  String? type;
  String? latitude;
  String? longitude;

  SalePoint({
    this.visit,
    this.point_name,
    this.point_id,
    this.type,
    this.latitude,
    this.longitude,
  });
}

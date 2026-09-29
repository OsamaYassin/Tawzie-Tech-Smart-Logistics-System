
import 'package:flutter/foundation.dart';
import 'package:tawzie/models/product.dart';


class Card1 with ChangeNotifier {
   String product_id;
   String product_name;
   String price ;
   int quantity;

   Card1({
    required this.product_id,
     required this.price,
     required this.product_name,
    required this.quantity,
  });
}




import 'package:flutter/foundation.dart';
import 'package:tawzie/models/product.dart';


class Order with ChangeNotifier {

   String id;
   String user_id;
   List<Product> products;

   Order({
    required this.id,
    required this.user_id,
    required this.products,
  });
}

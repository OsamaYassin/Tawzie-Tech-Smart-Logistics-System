
import 'package:flutter/foundation.dart';


class Product with ChangeNotifier {

   String? id;
   String? name;
   String? size;
   String? description;
   String? price;
  String? available_amount;


  Product({
     this.id,
     this.name,
    this.size,
    this.available_amount,
     this.description,
     this.price,
  });



}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../config/palette.dart';
import '../models/product.dart';
import '../providers/cards1.dart';
import '../providers/products.dart';

class CardWidget extends StatefulWidget {
  final String id;

  const CardWidget({super.key, required this.id});

  @override
  State<CardWidget> createState() => _CardWidgetState();
}

class _CardWidgetState extends State<CardWidget> {
  late int quantity;
  TextEditingController text = TextEditingController();
  @override
  void initState() {
    if (Provider.of<Cards1>(context, listen: false).quantityExist(widget.id) !=
        null) {
      quantity =
          Provider.of<Cards1>(context, listen: false).quantityExist(widget.id)!;
    } else {
      quantity = 0;
    }
    text.text = quantity.toString();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    var products = Provider.of<Products>(context, listen: false)
        .findProductById(widget.id.toString());
    return Card(
      elevation: 3.0,
      shadowColor: Colors.blueAccent,
      color: Colors.white,
      margin: EdgeInsets.only(left: 10, right: 10, bottom: 10, top: 5),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
      child: Container(
        height: 70,
        padding: EdgeInsets.only(top: 0, left: 20, right: 20),
        child: Column(
          children: [
            // Tittel of Cart
            SizedBox(
              height: 15,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Container(
                    width: 130,
                    height: 50,
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.start,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            InkWell(
                                onTap: () {
                                  setState(() {
                                    quantity = quantity - 1;
                                    text.text = quantity.toString();
                                  });
                                  Provider.of<Cards1>(context, listen: false)
                                  .addToCard(products.id.toString(),
                                      products.price.toString(), quantity,products.name.toString());
                                },
                                child: Icon(
                                  (Icons.remove),
                                  size: 25,
                                )),
                            SizedBox(
                              width: 5,
                            ),
                            Container(
                              width: 66,
                              height: 35,
                              child: TextField(
                                controller: text,
                                textAlign: TextAlign.center,
                                keyboardType: TextInputType.phone,
                                decoration: InputDecoration(
                                  enabledBorder: OutlineInputBorder(
                                    borderSide:
                                        BorderSide(color: Palette.textColor1),
                                    borderRadius:
                                        BorderRadius.all(Radius.circular(10.0)),
                                  ),
                                  focusedBorder: OutlineInputBorder(
                                    borderSide:
                                        BorderSide(color: Palette.textColor1),
                                    borderRadius:
                                        BorderRadius.all(Radius.circular(10.0)),
                                  ),
                                  contentPadding: EdgeInsets.all(10),
                                  hintText: "000",
                                  hintStyle: TextStyle(
                                      fontSize: 14, color: Palette.textColor1),
                                ),
                                onChanged: (value) {
                                  setState(() {
                                    quantity = int.parse(text.text);
                                  });
                                  Provider.of<Cards1>(context, listen: false)
                                  .addToCard(products.id.toString(),
                                      products.price.toString(), quantity,products.name.toString());
                                },
                              ),
                            ),
                            SizedBox(
                              width: 5,
                            ),
                            InkWell(
                                onTap: () {
                                  setState(() {
                                    quantity = quantity + 1;
                                    text.text = quantity.toString();
                                  });
                                  Provider.of<Cards1>(context, listen: false)
                                  .addToCard(products.id.toString(),
                                      products.price.toString(), quantity,products.name.toString());
                                },
                                child: Icon(
                                  (Icons.add),
                                  size: 25,
                                )),
                          ],
                        ),
                       
                      ],
                    )

                    /*TextField(
            controller: nameController,
            textAlign: TextAlign.center,
            keyboardType: TextInputType.phone,
            onChanged: (text) {
              Provider.of<Cards1>(context, listen: false)
                  .addToCard(id, price,int.parse(text));
            },
            decoration: InputDecoration(
              enabledBorder: OutlineInputBorder(
                borderSide: BorderSide(color: Palette.textColor1),
                borderRadius: BorderRadius.all(Radius.circular(10.0)),
              ),
              focusedBorder: OutlineInputBorder(
                borderSide: BorderSide(color: Palette.textColor1),
                borderRadius: BorderRadius.all(Radius.circular(10.0)),
              ),
              contentPadding: EdgeInsets.all(10),
              hintText: "000",
              hintStyle: TextStyle(fontSize: 14, color: Palette.textColor1),
            ),
          ),*/
                    ),
                Text(
                  products.name.toString(),
                  style: TextStyle(
                    fontSize: 20,
                    color: Colors.black,
                    fontFamily: "Almarai",
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

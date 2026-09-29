@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
منتجات  الباكج
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
منتجات  الباكج  - {{$pacname}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class=" " action="{{ route('order.package.product.request') }}" method="POST">
                        @csrf
                    <div class="row text-center">

                        <!-- Start Hidden Value -->
                        <input type="hidden" name="packageid" type="text"  value="{{$packageId}}">
                        <input type="hidden" name="customerID" type="text"  value="{{$userId}}">
                        <input id="totalorder" type="hidden" name="totalorder" type="text"  value="0">
                        <!-- End Hidden Value -->

                        <div class="col-md-3">
                                <label for="benefactor"
                                class="mr-sm-2">مكان التوصيل
                            :</label>
                        <select class="custom-select mr-sm-2" name="addressDelivery">
                            <option value="الخرطوم">الخرطوم</option>
                            <option value="بحري">بحري</option>
                            <option value="امدرمان">الخرطوم</option>
                            <option value="الولايات">الولايات</option>
                        </select>
                        </div>

                        <div class="col-md-3 ">
                            <label for="discription"
                            class="mr-sm-2"> ادخل سعر التوصيل
                        :</label>
                    <input class="custom-select_b" type="number" name="pricedelivery"
                            id="inputdelivery"  required="required"  placeholder=" ادخل سعر التوصيل"/>
                        </div>

                        <div style="margin-top:25px;">
                            <button type="submit" style="height: 35px;"
                            class="btn btn-success  btn-small">{{ trans('ارسال الطلبية للتجهيز') }}</button>
                        </div>


                    </div>
                </form>


                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th> الوصف </th>
                                <th>    السعر </th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @if ($products[0] ->package_product_id != "")

                            @foreach($products as $product)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $product -> name }}</td>
                                    <td>{{  $product -> descrip }}</td>


                                    @if($product -> totalSum == NULL)
                                            <td> 0 </td>
                                        @else
                                            <td class="countable"> {{$product -> totalSum  + $getPricingProduct}}</td>
                                    @endif




                                </tr>



                            @endforeach

                            <tr  style="background: #DDD;font-size: 17px;">
                                <td colspan="1"> اجمالي السعر</td>
                                <td colspan="1"  id="totleprice">0</td>
                                <td colspan="1">     السعر بعد الخصم</td>
                                <td colspan="1" id="pacdscount"> 0</td>

                            </tr>

                            <tr  style="background: #DDD;font-size: 17px;">

                                <td colspan="2">       السعر  التوصيل + الاجمالي</td>
                                <td colspan="2" id="totldelivery"> 0</td>

                            </tr>

                            @endif

                        </table>
                    </div>

                    <div class="col-md-12">
                        <a  href="{{route('order.customer.show')}}" class="button x-small" style="background: red;">
                             cancel
                        </a>
                    </div>

                </div>

            </div>

        </div>





    </div>


    <script>
        var sum = 0;
var table = document.getElementById("datatable");
var ths = table.getElementsByTagName('th');
var tds = table.getElementsByClassName('countable');
for(var i=0;i<tds.length;i++){
	sum += isNaN(tds[i].innerText) ? 0 : parseInt(tds[i].innerText);
}

var row = table.insertRow(table.rows.length);
var cell = row.insertCell(0);
cell.setAttribute('colspan', ths.length);

//var totalBalance  = document.createTextNode('Total Balance ' + sum);  totleprice
//document.getElementById("totleprice").innetHTML = 45121;  pacdscount
document.getElementById("totleprice").innerHTML=sum;
document.getElementById("pacdscount").innerHTML=sum- {{$pacdscount}};
document.getElementById("totalorder").value = sum- {{$pacdscount}};

const message = document.querySelector('#inputdelivery');
const result = document.querySelector('#totldelivery');
document.getElementById("totldelivery").innerHTML= 0 ;
message.addEventListener('input', function () {
      result.textContent = this.value;

      document.getElementById("totldelivery").innerHTML=sum- {{$pacdscount}} + Number(this.value);
    });


cell.appendChild(totalBalance);

    </script>


<script>
    const message = document.querySelector('#inputdelivery');
    const result = document.querySelector('#delivery');
    message.addEventListener('input', function () {
        result.textContent = this.value;
     var endprice =   document.getElementById("pacdscount").innerHTML ;
      document.getElementById("totldelivery")  = endprice ;

    });

    //totalorder
</script>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

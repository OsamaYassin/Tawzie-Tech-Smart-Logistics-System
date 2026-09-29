@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تاكيد الطلبية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تاكيد الطلبية
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


                    <br><br>


                        <style>
                            tr{
                                font-size: 18px;
                            }
                        </style>

                        <div class="container text-center">
                            <h3 style="font-family: Cairo; margin-bottom: 20px"> اجمالي الطلبية </h3>
                            <div class="table-responsive">
                                <table  class="table  table-striped table-hover table-sm table-bordered p-0"

                                       style="text-align: center">
                                    <thead>
                                    <tr style="background: #2a2727; color: #FFF;">
                                        <th>    الطلبية </th>
                                        <th> التفاصيل </th>
                                    </tr>
                                    </thead>

                                    @foreach($detailOrder as $detailOrd)
                                    <tbody>

                                      <tr>
                                          <td> الباركود</td>
                                          <td> BarCode </td>
                                        </tr>
                                      <tr>
                                          <td> رقم الطلبية</td>
                                          <td> {{$detailOrd-> order_id}} </td>
                                      </tr>

                                      <tr>
                                          <td> العميل</td>
                                          <td> {{$detailOrd-> custmerName}} </td>
                                      </tr>
                                      <tr>
                                          <td>  رقم الهاتف</td>
                                          <td> {{$detailOrd-> phone_one}} - {{$detailOrd-> phone_two}} </td>
                                      </tr>

                                      <tr>
                                          <td>  سعر الطلبية</td>
                                          <td> {{ $detailOrd->total_order_price }} </td>
                                      </tr>
                                      <tr>
                                          <td>   سعر التوصيل</td>
                                          <td> {{$detailOrd-> price_delivery}} </td>
                                      </tr>

                                      <tr>
                                          <td>  مكان التوصيل</td>
                                          <td> {{$detailOrd-> address_delivery}} </td>
                                      </tr>
                                      <tr>
                                          <td>  اجمالي الطلبية + التوصيل</td>
                                          <td> {{$detailOrd-> price_delivery +  $detailOrd->total_order_price }} </td>
                                      </tr>
                                      <tr>
                                          <td>  التاريخ</td>
                                          <td style="direction: ltr;" > {{$detailOrd->created_at}} </td>
                                      </tr>

                                </table>
                                   @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('save.order.product.in.table.order', 0)}}"  class="button x-small bg-danger"  >
                                        تعليق الطلبية
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{route('save.order.product.in.table.order', 1)}}" class="button x-small bg-success"  >
                                         ارسال الطلبية للتجهيز
                                    </a>
                                </div>

                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>



    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

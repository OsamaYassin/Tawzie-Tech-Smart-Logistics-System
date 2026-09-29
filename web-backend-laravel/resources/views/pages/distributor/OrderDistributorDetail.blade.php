@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
      تفاصيل الطلبية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
تفاصيل الطلبية
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


                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        </div>
                    </div>



                    <br><br>

                    <div class="table-responsive" id="print">
                        <table id="datatable"  class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> المنتج   </th>
                                <th>  الكمية    </th>
                                <th> اجمالي السعر  </th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($OrdersDistributorDetail as $key => $ordDisDetail)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>


                                    <td>
                                        @if (isset($ordDisDetail -> product_order_detail))
                                        {{$ordDisDetail -> product_order_detail -> product_name  }}
                                        @endif
                                    </td>

                                    <td>{{$ordDisDetail -> order_amount}}</td>
                                    <td id="cardsum">{{$ordDisDetail -> total_price }}</td>

                                </tr>


                            @endforeach

                            <tr style="font-size: 19px;">
                                <td> التاريخ</td>
                                <td>  {{$OrdersDistributorDetail[0] -> order_date}} </td>
                                <td> الاجمالي</td>
                                <td id="total"> {{ $OrdersDistributorDetail ->sum('total_price')}} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>



    <!-- row closed -->
@endsection
@section('js')

<script type="text/javascript">
    function printDiv() {



         document.getElementById("datatable_filter").style.display = "none";
        document.getElementById("datatable_length").style.display = "none";
        document.getElementById("datatable_paginate").style.display = "none";


        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

</script>


    @toastr_js
    @toastr_render
@endsection

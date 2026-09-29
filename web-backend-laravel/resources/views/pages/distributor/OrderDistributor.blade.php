@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    ادارة الطلبيات
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
ادارة الطلبيات
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
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الطلبية المندوب </th>
                                <th> اجمالي الطلب  </th>
                                <th> التاريخ  </th>
                                <th class="protd">الإجراءات</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($OrdersDistributor as $key => $ordersDistribut)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>


                                    <td>
                                        @if (isset($OrdersDistributor[$key] -> distrubute_order))
                                        {{$OrdersDistributor[$key] -> distrubute_order -> name  }}
                                        @endif
                                    </td>

                                    <td>{{$ordersDistribut -> total_price}}</td>
                                    <td>{{$ordersDistribut -> year . '-' . $ordersDistribut -> months . '-' . $ordersDistribut -> day }}</td>
                                    <td class="protd">

                                        <a type="button" class="btn btn-info btn-sm"
                                                href="{{ route('distributor.orders.detail', $ordersDistribut->order_id ) }}"
                                                title=" تفاصيل"><i class="fa fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $ordersDistribut->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $ordersDistribut->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    حذف  الطلبية
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('ordersDistributor.destroy', ) }}" method="post">

                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $ordersDistribut->order_id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">حذف الطلبية
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

      //  document.getElementById("proth").style.display = "none";
       // document.getElementById("protd").style.display = "none";

        for (let element of document.getElementsByClassName("protd")){
             element.style.display="none";
         }


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

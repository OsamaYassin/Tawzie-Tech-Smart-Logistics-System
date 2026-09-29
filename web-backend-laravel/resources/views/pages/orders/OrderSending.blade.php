@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الطلبات تم ارسالها
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    الطلبات تم ارسالها
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



                    <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                        class="mdi mdi-printer ml-1"></i>طباعة</button>


                    <br><br>

                    <div class="table-responsive"   id="print">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الطلبية</th>
                                <th> اجمالي الطلب </th>
                                <th> سعر التوصيل </th>
                                <th>   مكان التوصيل </th>
                                <th>     التاريخ </th>
                                <th class="protd">الاجراءت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($orderSending as $orderSend)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $orderSend -> id }}</td>
                                    <td>{{$orderSend -> total_order  }}</td>
                                    <td> {{$orderSend -> price_delivery }}</td>
                                   <td> {{$orderSend -> address_delivery }}</td>
                                   <td> {{$orderSend -> created_at }}</td>

                                    <td class="protd">

                                        <a  href="{{route('order.detail.product.pending' , $orderSend->id)}}"   class="btn btn-info btn-sm"
                                            title="{{ trans(' تفاصيل ') }}"><i class="fa fa-info"></i>
                                            تفاصيل
                                        </a>

                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $orderSend->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    تعديل بيانات |  المنتج
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('customer.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf

                                                    <div class="row">

                                                        <div class="col d-none">
                                                            <label for="amount"
                                                                   class="mr-sm-2">number
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$orderSend -> id}}" type="text"
                                                                   name="id" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">الاسم
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$orderSend -> name}}" type="text"
                                                                   name="name" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">رقم الهاتف
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$orderSend -> phone_one}}" type="text"
                                                                   name="phoneone" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">الهاتف الثاني
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$orderSend -> phone_two}}" type="text"
                                                                   name="phonetwo" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2"> العنوان
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$orderSend -> address}}" type="text"
                                                                   name="address" required/>
                                                        </div>


                                                    </div>


                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $orderSend->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    حذف عميل
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('customer.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $orderSend->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">حذف العميل
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


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            اضافة  عميل
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('customer.create') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div>
                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label for="amount"
                                                           class="mr-sm-2">الاسم
                                                        :</label>
                                                    <input class="custom-select_b" type="text" name="name" required/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="discription"
                                                           class="mr-sm-2"> رقم الهاتف
                                                        :</label>
                                                    <input class="custom-select_b" type="text" name="phoneone"
                                                           required="required"/>
                                                </div>



                                                <div class="col-md-6 mt-2">
                                                    <label for="amount"
                                                           class="mr-sm-2"> الهاتف الثاني
                                                        :</label>
                                                    <input class="custom-select_b" type="text" name="phonetwo" required/>
                                                </div>

                                                <div class="col-md-6  mt-2">
                                                    <label for="discription"
                                                           class="mr-sm-2">   العنوان
                                                        :</label>
                                                    <input class="custom-select_b" type="text" name="address"
                                                           required="required"/>
                                                </div>

                                            </div>


                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
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


@endsection

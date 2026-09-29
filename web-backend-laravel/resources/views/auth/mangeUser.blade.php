@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    ادارة المستخدمين النظام
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
ادارة المستخدمين النظام
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

                        <a href="{{route('User.index')}}" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            اضافة مستخدم
                        </a>
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
                                <th>اسم </th>
                                <th>  البريد الالكتروني   </th>
                                <th> الصلاحيات </th>
                                <th class="protd">الاجراءت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($manageUsers as $user)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{$user -> name   }}</td>
                                    <td>{{$user -> email }} </td>

                                    <td>

                                        @if ($user -> part_acount == 1)   <span>  الحسابات </span> <span> - </span> @endif
                                        @if ($user -> part_materail == 1)   <span>  المواد الخام </span>  <span> - </span>  @endif
                                        @if ($user -> part_product == 1)   <span>  المنتجات </span>  <span> - </span>  @endif
                                        @if ($user -> part_inventor == 1)   <span>  المخزن </span>  <span> - </span>  @endif
                                        @if ($user -> part_hr == 1)   <span>  HR </span>  <span> - </span>  @endif
                                        @if ($user -> part_lab1 == 1)   <span>  لاب 1 </span>  <span> - </span>  @endif
                                        @if ($user -> part_lab2 == 1)   <span>  لاب 2 </span> <span> - </span>  @endif
                                       @if ($user -> part_lab3 == 1)   <span>  لاب 3 </span>  <span> - </span>  @endif
                                        @if ($user -> part_customer == 1)   <span>  العملاء </span>  <span> - </span>  @endif
                                        @if ($user -> part_aftersales == 1)   <span>  خدمات مابعد البيع </span>  <span> - </span>  @endif
                                        @if ($user -> part_delivery == 1)   <span>  التوصيل </span> <span> - </span>  @endif
                                        @if ($user -> part_redayorder == 1)   <span>  الحسابات </span>  <span> - </span>  @endif

                                    </td>

                                    <td class="protd">


                                        <a href="{{route('edit.users' ,$user -> id )}}" class="btn btn-info btn-sm"  title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                    </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $user->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>



                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    حذف المستخدم
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.destroy') }}" method="post">
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $user->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">حذف مستخدم
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

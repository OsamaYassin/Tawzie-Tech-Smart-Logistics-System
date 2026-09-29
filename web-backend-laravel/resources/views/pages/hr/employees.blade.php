@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   الموظفين
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
الموظفين
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
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        اضافة موظف
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                        class="mdi mdi-printer ml-1"></i>طباعة</button>
                </div>
            </div>

            <br><br>

            <div class="table-responsive"   id="print">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الايميل</th>
                            <th>القسم</th>
                            <th class="protd">السيرة الذاتية</th>
                            <th class="protd">الاجراءت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                        @foreach($employees as $employee)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$employee -> e_name}}</td>
                                <td>{{$employee -> e_email}}</td>

                                @foreach($department as $depart)
                                 @if ($employee -> e_department == $depart -> id)
                                 <td>{{$depart -> name}}</td>
                                 @endif
                                @endforeach

                                <td class="protd">{{$employee -> e_cv}}</td>


                                <td class="protd">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $employee-> id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $employee-> id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $employee-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               تعديل بيانات الموظف
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body  ">
                                            <!-- add_form -->
                                            <form action="{{route('employees.update', 'test')  }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf

                                     <div class="row">
                                        <div class="col-md-6">
                                            <label for="name"
                                                class="mr-sm-2">الاسم
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$employee -> e_name}}" type="text" name="name" required="required" />
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $employee-> id }}">
                                        </div>

                                        <div class="col">
                                            <label for="phone"
                                                class="mr-sm-2">الايميل
                                                :</label>
                                                <input class="custom-select_b" type="email" value= " {{$employee -> e_email}}" name="email" required="required" />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address"
                                                class="mr-sm-2">القسم
                                                :</label>

                                                <select class="custom-select mr-sm-2" name="department">
                                                    @foreach ($department as $depart)

                                                        @if($employee -> e_department == $depart->id)
                                                            <option value="{{ $depart->id }}" selected>{{ $depart-> name }}</option>
                                                        @else
                                                        <option value="{{ $depart->id }}">{{ $depart-> name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address"
                                                class="mr-sm-2">السيرة الذاتية
                                                :</label>
                                            <input class="custom-select_b" type="file" value= " {{$employee -> e_cv}}" name="cv" />
                                        </div>

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


                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $employee-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                            حذف الموظف
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('employees.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Grades_trans.Warning_Grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $employee-> id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">حذف الموظف</button>
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
                    اضافة موظف
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">الاسم
                                                :</label>
                                            <input class="custom-select_b" type="text" name="name" required />
                                        </div>
                                        <div class="col">
                                              <label for="phone"
                                                 class="mr-sm-2">الايميل
                                                       :</label>
                                              <input class="custom-select_b" type="email" name="email"  id="email"  required="required" />


                                        </div>
                                    </div>
                                    <br>
                                        <div class="row">
                                            <div class="col">
                                              <label for="address"
                                                 class="mr-sm-2">القسم
                                                       :</label>
                                                       <select class="custom-select mr-sm-2" name="department">
                                                        @foreach ($department as $depart)
                                                            <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                                        @endforeach
                                                    </select>

                                        </div>
                                    </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                      <label for="address"
                                         class="mr-sm-2">السيرة الذاتية
                                               :</label>
                                             <input  class="custom-select_b" type="file" name="cv" id="cv" />
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

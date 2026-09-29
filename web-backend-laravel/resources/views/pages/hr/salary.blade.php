@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   المرتبات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
مرتبات الموظفين
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


            <div class="table-responsive"  id="print">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>القسم</th>
                            <th>المرتب</th>
                            <th>الاجراءت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>


                        @foreach($salarys as $salary)

                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$salary-> e_name}}</td>
                                @foreach($department as $depart)
                                @if ($salary -> e_department == $depart -> id)
                                <td>{{$depart -> name}}</td>
                                @endif
                               @endforeach
                                <td>{{$salary -> salary}}</td>



                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $salary-> id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $salary-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               تعديل مرتب الموظف
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('salarys.update', 'test')  }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf

                                     <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">الاسم
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$salary -> e_name}}" type="text" name="name" required="required" />
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $salary-> id }}">
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2">القسم
                                                :</label>
                                                <select class="custom-select mr-sm-2" name="department">
                                                    @foreach ($department as $depart)

                                                        @if($salary -> e_department == $depart->id)
                                                            <option value="{{ $depart->id }}" selected>{{ $depart-> name }}</option>
                                                        @else
                                                        <option value="{{ $depart->id }}">{{ $depart-> name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2">المرتب
                                                :</label>
                                            <input class="custom-select_b" type="text" value= " {{$salary -> salary}}" name="salary" required="required"/>
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
@endsection

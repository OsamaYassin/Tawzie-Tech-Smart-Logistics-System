@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   العطلات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
العطلات
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

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                اضافة عطلة
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم العطلة</th>
                            <th>الفترة الزمنية</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>الاجراءت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                        @foreach($vications as $vication)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$vication -> v_name}}</td>
                                <td>{{$vication -> v_duration}}</td>
                                <td>{{$vication -> start_date}}</td>
                                <td>{{$vication -> end_date}}</td>


                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $vication-> id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $vication-> id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $vication-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               تعديل بيانات العطلة
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('vications.update', 'test')  }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf

                                     <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">اسم العطلة
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$vication -> v_name}}" type="text" name="name" required="required" />
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $vication-> id }}">
                                        </div>

                                        <div class="col">
                                            <label for="phone"
                                                class="mr-sm-2"> الفترة الزمنيه
                                                :</label>
                                                <input class="custom-select_b" type="text" value= " {{$vication -> v_duration}}" name="duration" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2">تاريخ البداية
                                                :</label>

                                            <input class="custom-select_b" type="date" value= " {{$vication -> start_date}}" name="start_date" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2"> تاريخ النهاية
                                                :</label>
                                            <input class="custom-select_b" type="date" value= " {{$vication -> end_date}}" name="end_date" required="required"/>
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
                            <div class="modal fade" id="delete{{ $vication-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                            حذف العطلة
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('vications.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Grades_trans.Warning_Grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $vication-> id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">حذف العطلة</button>
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
                    اضافة عطلة
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('vications.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">اسم العطلة
                                                :</label>
                                            <input class="custom-select_b" type="text" name="name" required />
                                        </div>
                                        <div class="col">
                                              <label for="phone"
                                                 class="mr-sm-2">فترة العطلة
                                                       :</label>
                                              <input class="custom-select_b" type="text" name="duration"  id="duration"  required="required" />


                                        </div>
                                    </div>
                                    <br>
                                        <div class="row">
                                            <div class="col">
                                              <label for="address"
                                                 class="mr-sm-2">تاريخ البداية
                                                       :</label>
                                                       <input  class="custom-select_b" type="date" name="start_date" id="start_date" />
                                        </div>
                                    </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                      <label for="address"
                                         class="mr-sm-2"> تاريخ النهاية
                                               :</label>
                                             <input  class="custom-select_b" type="date" name="end_date" id="end_date" />
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
@endsection

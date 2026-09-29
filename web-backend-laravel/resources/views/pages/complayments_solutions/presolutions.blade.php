@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   الحلول المعدة مسبقا
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
حلول معدة مسبقا
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
                اضافة شكوى
            </button>
            <br><br>

            <div class="table-responsive"  id="print">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>  الشكوى</th>
                            <th>  اسم المنتج</th>
                            <th> الحل المعد مسبقا</th>
                            <th>الاجراءت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                        @foreach($presolutions as $presolution)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$presolution -> complayment}}</td>
                                @foreach($products as $product)
                                @if ($presolution -> product_name == $product -> id)
                                <td>{{$product -> name}}</td>
                                @endif
                               @endforeach
                                <td>{{$presolution -> solution}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $presolution-> id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $presolution-> id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $presolution-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               تعديل الحلول المعده مسبقا
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('presolutions.update', 'test')  }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf

                                     <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">  الشكوى
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$presolution -> complayment}}" type="text" name="complayment" required="required" />
                                            <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $presolution-> id }}" />
                                        </div>

                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2"> اسم المنتج
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$presolution -> product_name}}" type="text" name="product_name" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="phone"
                                                class="mr-sm-2"> الحل المعد مسبقا
                                                :</label>
                                                <input class="custom-select_b" type="text" value= " {{$presolution -> solution}}" name="solution" required="required" />
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
                            <div class="modal fade" id="delete{{ $presolution-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                            حذف حل معد مسبقا
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('presolutions.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Grades_trans.Warning_Grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $presolution-> id }}" />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">حذف الحل المعد مسبقا</button>
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
                    اضافة حل
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('presolutions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name"
                                            class="mr-sm-2"> اسم المنتج
                                            :</label>
                                            <select class="custom-select mr-sm-2" name="product_name" data-live-search="true">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                <br>
                                <br>
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">  الشكوى
                                                :</label>
                                            <input class="custom-select_b" type="text" name="complayment" required />
                                        </div>

                                        <div class="col">
                                              <label for="phone"
                                                 class="mr-sm-2"> الحل المعد مسبقا
                                                       :</label>
                                              <input class="custom-select_b" type="text" name="solution"  id="solution"  required="required" />
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
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection

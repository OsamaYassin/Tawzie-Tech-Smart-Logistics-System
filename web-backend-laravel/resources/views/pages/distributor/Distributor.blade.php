@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    ادارة المناديب
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
ادارة المناديب
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

                    <button type="button" class="button x-small d-none" data-toggle="modal" data-target="#exampleModal">
                        اضافة   مندوب
                    </button>


                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>المنطقة التوزيع</th>
                                <th>رقم العربة</th>
                                <th>الهاتف</th>
                                <th>  الحالة </th>
                                <th>الإجراءات</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($distributor as $distribut)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $distribut -> name }}</td>
                                    <td>{{$distribut -> area_name}}</td>
                                    <td>{{$distribut -> vihicle_no}}</td>
                                    <td>{{$distribut -> phone}}</td>
                                    <td>
                                        @if ($distribut -> active == 1)
                                            مفعل
                                        @else
                                        غير مفعل
                                        @endif
                                     </td>

                                    <td>



                                        <button type="button" class="btn btn-info btn-sm mt-2" data-toggle="modal"
                                                data-target="#edit{{ $distribut->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                        </button>

                                        <a   class="btn btn-warning btn-sm mt-2"  href="{{route('sales.point.location.distributId' , $distribut->id  )}}" >
                                            <i class="fa fa-map-marker" style="color: #FFF;"></i>
                                       </a>

                                        <button type="button" class="btn btn-danger btn-sm mt-2" data-toggle="modal"
                                                data-target="#delete{{ $distribut->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $distribut->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    تعديل بيانات |  المندوب
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('distributor.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf

                                                    <div class="row">

                                                        <div class="col d-none">
                                                            <label for="amount"
                                                                   class="mr-sm-2">number
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$distribut -> id}}" type="text"
                                                                   name="id" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">الاسم
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="{{$distribut -> name}}" type="text"
                                                                   name="name" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">رقم الهاتف
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="{{$distribut -> phone}}" type="text"
                                                                   name="phone" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">  اسم مستخدم
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$distribut -> username}}" type="text"
                                                                   name="username" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2"> منطقة التوزيع
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="{{$distribut -> area_name}}" type="text"
                                                                   name="area_name" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">  رقم العربية
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="{{$distribut -> vihicle_no}}" type="text"
                                                                   name="vihicle_no" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">    رمز  الدخول
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="{{$distribut -> password}}" type="text"
                                                                   name="password" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2" style="margin-right: 20px;">

                                                                <input class="form-check-input" type="checkbox"   id="name"
                                                                style="width: 25px; height: 25px;"
                                                                @if ($distribut -> active ==1)
                                                                checked
                                                                @endif
                                                                name="active">
                                                                <label class="form-check-label" for="defaultCheck1"
                                                                style="    margin-right: 13px;font-size: 20px;">
                                                                 تفعيل
                                                               </label>
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
                                <div class="modal fade" id="delete{{ $distribut->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    حذف  مندوب
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('distributor.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $distribut->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">حذف المندوب
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
@endsection

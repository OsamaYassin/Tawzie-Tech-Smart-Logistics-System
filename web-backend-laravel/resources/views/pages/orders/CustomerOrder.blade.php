@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    ادارة العملاء
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    العملاء
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
                        اضافة  عميل
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
                                <th> الهاتف </th>
                                <th> العنوان </th>
                                <th>الاجراءت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($customers as $customer)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $customer -> name }}</td>
                                    <td>{{$customer -> phone_one ." - ". $customer -> phone_two }}</td>
                                    <td> {{$customer -> address }}</td>

                                    <td>

                                        <a  href="{{route('request.order.index' , $customer->id)}}"   class="btn btn-info btn-sm"
                                            title="{{ trans('اضافة طلبية ') }}"><i class="fa fa-plus"></i>
                                            اضافة طلبية
                                        </a>

                                        <a  href="{{route('order.package.index', $customer->id)}}"   class="btn btn-success btn-sm"
                                            title="{{ trans('  طلب باكج  ') }}"><i class="fa fa-plus"></i>
                                           طلب باكج
                                        </a>

                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $customer->id }}" tabindex="-1" role="dialog"
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
                                                                   value=" {{$customer -> id}}" type="text"
                                                                   name="id" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">الاسم
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$customer -> name}}" type="text"
                                                                   name="name" required/>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="amount"
                                                                   class="mr-sm-2">رقم الهاتف
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$customer -> phone_one}}" type="text"
                                                                   name="phoneone" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">الهاتف الثاني
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$customer -> phone_two}}" type="text"
                                                                   name="phonetwo" required/>
                                                        </div>

                                                        <div class="col-md-6 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2"> العنوان
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value=" {{$customer -> address}}" type="text"
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
                                <div class="modal fade" id="delete{{ $customer->id }}" tabindex="-1" role="dialog"
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
                                                           value="{{ $customer->id }}">
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

                        <form class=" row mb-30" action="{{ route('add.customer.dirct') }}" method="POST">
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
@endsection

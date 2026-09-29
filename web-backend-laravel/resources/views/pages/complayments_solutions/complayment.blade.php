@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   الشكاوى
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
الشكاوى
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
                            <th> معرف الطلب</th>
                            <th>اسم المنتج</th>
                            <th>اسم العميل</th>
                            <th> هاتف العميل</th>
                            <th>الشكوى</th>
                            <th>الحل المقترح</th>
                            <th> حالة الشكوى</th>
                            <th>الاجراءت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                        @foreach($complayments as $complayment)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$complayment -> o_id}}</td>

                                @foreach($products as $product)
                                @if ($complayment -> product_name == $product -> id)
                                <td>{{$product -> name}}</td>
                                @endif
                               @endforeach

                                <td>{{$complayment -> customer_name}}</td>
                                <td>{{$complayment -> customer_phone}}</td>
                                <td>{{$complayment -> complayment}}</td>
                                <td>{{$complayment -> solution}}</td>
                                <td>{{$complayment -> status}}</td>


                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $complayment-> id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $complayment-> id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $complayment-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               تعديل بيانات الشكوى
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('complayments.update', 'test')  }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf

                                     <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">معرف الطلب
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$complayment -> o_id}}" type="number" name="o_id" required="required" />
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $complayment-> o_id }}" />
                                        </div>

                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2"> اسم المنتج
                                                :</label>
                                            <input class="custom-select_b"   value= " {{$complayment -> product_name}}" type="text" name="product_name" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="phone"
                                                class="mr-sm-2">اسم العميل
                                                :</label>
                                                <input class="custom-select_b" type="text" value= "{{$complayment -> customer_name}}" name="customer_name" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2">هاتف العميل
                                                :</label>

                                            <input class="custom-select_b" type="number" value= "{{$complayment -> customer_phone}}" name="customer_phone" required="required" />
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2"> الشكوى
                                                :</label>
                                            <input class="custom-select_b" type="text" value= "{{$complayment -> complayment}}" name="complayment" required="required"/>
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2"> الحل المقترح
                                                :</label>
                                            <input class="custom-select_b" type="text" value= "{{$complayment -> solution}}" name="solution" required="required"/>
                                        </div>

                                        <div class="col">
                                            <label for="address"
                                                class="mr-sm-2">  حالة الشكوى
                                                :</label>
                                            <select  class="custom-select_b" name="status" id="status" required="required" value= "{{$complayment -> status}}" required="required">
                                                <option class="custom-select_b" value="تم حلها">تم حلها</option>
                                                <option class="custom-select_b" value="معلقه">معلقه</option>
                                            </select>
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
                            <div class="modal fade" id="delete{{ $complayment-> id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                            حذف شكوى
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('complayments.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Grades_trans.Warning_Grade') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $complayment-> id }}" />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">حذف الشكوى</button>
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
                    اضافة شكوى
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('complayments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">معرف الطلب
                                                :</label>
                                            <input class="custom-select_b" type="number" name="o_id" required />
                                        </div>

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

                                        <div class="col">
                                              <label for="phone"
                                                 class="mr-sm-2">اسم العميل
                                                       :</label>
                                              <input class="custom-select_b" type="text" name="customer_name"  id="customer_name"  required="required" />


                                        </div>
                                    </div>
                                    <br>
                                        <div class="row">
                                            <div class="col">
                                              <label for="address"
                                                 class="mr-sm-2">هاتف العميل
                                                       :</label>
                                                       <input class="custom-select_b" type="number" name="customer_phone" id="customer_phone" />
                                        </div>
                                    </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col">
                                      <label for="address"
                                         class="mr-sm-2"> الشكوى
                                               :</label>
                                               <input class="custom-select_b" type="text" name="complayment" id="customer_phone" />
                                     </div>
                                </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                          <label for="address"
                                             class="mr-sm-2">الحل المقترح
                                                   :</label>
                                                 <input  class="custom-select_b" type="text" name="solution" id="solution" />
                                    </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                     <div class="col">
                                        <label for="address"
                                            class="mr-sm-2">  حالة الشكوى
                                            :</label>
                                        <select lass="custom-select_b" name="status" id="status" required="required" >
                                            <option class="custom-select_b" value="تم حلها">تم حلها</option>
                                            <option class="custom-select_b" value="معلقه">معلقه</option>
                                        </select>
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

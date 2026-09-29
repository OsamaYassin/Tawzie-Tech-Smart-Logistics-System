@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
منتجات  الباكج
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
منتجات  الباكج
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

                    <div class="row text-center">
                        <div class="col-md-4">
                            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                اضافة  منتج
                            </button>
                        </div>
                        <div class="col-md-4"> <h4>{{$pacname}}</h4> </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-info x-small" data-toggle="modal"
                            data-target="#edit{{ $pacid }}"
                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                            تعديل  الخصم
                    </button>
                        </div>
                    </div>



                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th> الحجم </th>
                                <th> الوصف </th>

                                <th>    السعر </th>
                                <th>الاجراءت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @if ($products[0] ->package_product_id != "")

                            @foreach($products as $product)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $product -> name }}</td>
                                    <td>{{$product -> size}}</td>
                                    <td>{{  $product -> descrip }}</td>
                                    


                                    @if($product -> totalSum == NULL)
                                            <td> 0 </td>
                                        @else
                                            <td class="countable"> {{$product -> totalSum  + $getPricingProduct}}</td>
                                    @endif



                                    <td>

                                         <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $product->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                  <!-- edit_modal_Grade -->
                                  <div class="modal fade" id="edit{{ $pacid }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                   id="exampleModalLabel">
                                                   تعديل بيانات |  الباكيج
                                               </h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                                       aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <!-- add_form -->
                                               <form action="{{ route('package.update', 'test') }}" method="post">
                                                   {{ method_field('patch') }}
                                                   @csrf

                                                   <div class="row">

                                                       <div class="col d-none">
                                                           <label for="amount"
                                                                  class="mr-sm-2">number
                                                               :</label>
                                                           <input class="custom-select_b"
                                                                  value=" {{$pacid}}" type="text"
                                                                  name="id" required/>
                                                       </div>

                                                       <div class="col-md-6">
                                                           <label for="amount"
                                                                  class="mr-sm-2">اسم الباكيج
                                                               :</label>
                                                           <input class="custom-select_b"
                                                                  value=" {{$pacname}}" type="text"
                                                                  name="name" required/>
                                                       </div>


                                                       <div class="col-md-6 mt-2">
                                                           <label for="amount"
                                                                  class="mr-sm-2"> خصم
                                                               :</label>
                                                           <input class="custom-select_b"
                                                                  value=" {{$pacdscount}}" type="number"
                                                                  name="discount" required/>
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
                                <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    حذف المنتج
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('package.product.destroy' ) }}" method="post">

                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input type="hidden" name="productid" class="form-control"
                                                           value="{{ $product->id }}">
                                                           <input  type="hidden" name="packageid" class="form-control"
                                                           value="{{ $product->packageid }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">حذف المنتج
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <tr  style="background: #DDD;font-size: 17px;">
                                <td colspan="1"> اجمالي السعر</td>
                                <td colspan="2"  id="totleprice">0</td>
                                <td colspan="1">     السعر بعد الخصم</td>
                                <td colspan="2" id="pacdscount"> 0</td>
                            </tr>

                            @endif

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
                            اضافة  منتج
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('package.product.create') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div>
                                        <div>

                                            <div class="row">
                                                <div class="col-md-6 d-none">
                                                    <label for="benefactor"
                                                           class="mr-sm-2">رقم الباكجز
                                                        :</label>
                                                    <input value="{{$packageId}}" name="package_id">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="benefactor"
                                                           class="mr-sm-2">المنتج
                                                        :</label>
                                                    <select class="custom-select mr-sm-2" name="product_id">
                                                        @foreach ($producstItems as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                        @endforeach
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


    <script>
        var sum = 0;
var table = document.getElementById("datatable");
var ths = table.getElementsByTagName('th');
var tds = table.getElementsByClassName('countable');
for(var i=0;i<tds.length;i++){
	sum += isNaN(tds[i].innerText) ? 0 : parseInt(tds[i].innerText);
}

var row = table.insertRow(table.rows.length);
var cell = row.insertCell(0);
cell.setAttribute('colspan', ths.length);

//var totalBalance  = document.createTextNode('Total Balance ' + sum);  totleprice
//document.getElementById("totleprice").innetHTML = 45121;  pacdscount
document.getElementById("totleprice").innerHTML=sum;
document.getElementById("pacdscount").innerHTML=sum- {{$pacdscount}};
cell.appendChild(totalBalance);

    </script>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

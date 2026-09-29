@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    استقبال الطلبيات
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    استقبال الطلبيات
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
                                <th>    كمية في المخزن </th>
                                <th>    السعر </th>
                                <th>الاجراءت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($products as $product)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{  $product -> name }}</td>
                                    <td>{{$product -> size}}</td>
                                    <td>{{  $product -> descrip }}</td>
                                    <td>{{$product -> quantity}}</td>


                                    <td> {{$product -> totalSum  + $getPricingProduct}}</td>


                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $product->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                            اضافة منتج
                                        </button>

                                </tr>

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                     اضافة الكمية
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('request.order.add.product') }}" method="post">
                                                    @csrf

                                                    <div class="row">

                                                        <!-- Start hidding itme from users -->
                                                        <div class="d-none">
                                                        <input class="custom-select_b "
                                                               value=" {{$product -> id}}" type="text"
                                                               name="productID" required/>

                                                        <input class="custom-select_b"
                                                               value=" {{$customerID}}" type="text"
                                                               name="customerID" required/>

                                                        <input class="custom-select_b"
                                                               value=" {{$product -> totalSum  + $getPricingProduct}}" type="text"
                                                               name="priceProduct" required/>

                                                            <input class="custom-select_b"
                                                            value=" {{$product ->quantity}}" type="text"
                                                            name="quantityStore" required/>
                                                        </div>
                                                        <!-- End hidding itme from users -->



                                                        <div class="col-md-12 mt-2">
                                                            <label for="amount"
                                                                   class="mr-sm-2">  الكمية المطلوبة
                                                                :</label>
                                                            <input class="custom-select_b"
                                                                   value="1" type="number"
                                                                   name="quantity" required/>
                                                        </div>


                                                    </div>


                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('اضافة المنتج') }}</button>
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
                                                <form action="{{ route('products.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $product->id }}">
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
                        </table>
                    </div>

                        <hr>
                        <div class="mt-3 mb-3 row" >
                            <div class="col-md-3"> <h3 style="font-family: Cairo;"> المنتجات المطلوبة </h3>  </div>
                            <div class="col-md-3"> <h3 style="font-family: Cairo;">      سعر التوصيل
                                    <span style="background: #84ba3f;border-radius: 10px; padding: 1px 15px 1px 15px;color: #FFF;">
                                       @if(isset($priceDelivery)) {{$priceDelivery}} @else 0 @endif
                                    </span>
                                </h3> </div>
                            <div class="col-md-3"> <h3 style="font-family: Cairo;">    اجمالي الطلب
                                    <span style="background: #84ba3f;border-radius: 10px; padding: 1px 15px 1px 15px;color: #FFF;">
                                     @if(isset($totalOrderPrice)) {{$totalOrderPrice +  $priceDelivery}} @else 0 @endif
                                    </span>
                                </h3> </div>
                            <div class="col-md-3">
                                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                    اضافة  سعر التوصيل
                                </button>

                            </div>

                        </div>

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
                                    <th>   الكمية   </th>
                                    <th>    السعر </th>
                                    <th>الاجراءت</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>

                                @isset($customerRequest)
                                @foreach($customerRequest as $customerReq)
                                    <tr>

                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{  $customerReq -> productName }}</td>
                                        <td>{{$customerReq -> size}}</td>
                                        <td>{{  $customerReq -> descrip }}</td>
                                        <td>{{$customerReq -> product_quantity}}</td>
                                        <td> {{$customerReq -> total_price}}</td>


                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $customerReq->customerOrderId }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $customerReq->customerOrderId }}"
                                                    title="{{ trans('Grades_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $customerReq->customerOrderId }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل بيانات | كمية  المنتج
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('request.update.product.customer.quantity') }}" method="post">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col d-none">
                                                                <label for="amount"
                                                                       class="mr-sm-2">رقم الطلبية
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value=" {{$customerReq->customerOrderId}}" type="text"
                                                                       name="customerOrderId" required/>
                                                            </div>

                                                            <div class="col d-none">
                                                                <label for="amount"
                                                                       class="mr-sm-2">رقم العميل
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value=" {{$customerReq->customer_id}}" type="text"
                                                                       name="customerID" required/>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="amount"
                                                                       class="mr-sm-2">الاسم
                                                                    :</label>
                                                                <input class="custom-select_b" disabled
                                                                       value=" {{$customerReq->productName}}" type="text"
                                                                       name="name" required/>
                                                            </div>

                                                            <div class="col-md-6 d-none">
                                                                <label for="amount"
                                                                       class="mr-sm-2">رقم المنتج
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value="{{$customerReq->productId}}" type="text"
                                                                       name="productId" required/>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="amount"
                                                                       class="mr-sm-2">الكمية القديمة
                                                                    :</label>
                                                                <input class="custom-select_b" disabled
                                                                       value="{{$customerReq -> product_quantity}}" type="number"
                                                                       name="oldQuantity" required/>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <label for="amount"
                                                                       class="mr-sm-2">الكمية جديدة
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value="1" type="number"
                                                                       name="newQuantity" required/>
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
                                    <div class="modal fade" id="delete{{ $customerReq->customerOrderId }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                       حذف طلبية المنج
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('request.delete.product.customer') }}" method="post">
                                                        @csrf
                                                        {{ trans('Grades_trans.Warning_Grade') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $customerReq->customerOrderId }}">
                                                        <input id="id" type="hidden" name="customerId" class="form-control"
                                                               value="{{ $customerReq-> customer_id }}">
                                                        <input  type="hidden" name="productId" class="form-control"
                                                               value="{{ $customerReq -> productId  }}">
                                                        <input id="id" type="hidden" name="productQuantity" class="form-control"
                                                               value="{{ $customerReq->product_quantity }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">   حذف طلبية المنتج
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endisset
                            </table>
                        </div>


                        <div class="col-md-12 " style="text-align: end;">
                            <a  href="{{route('request.confirm.product.customer')}}" class="button x-small" style="background: #08c;">
                                تأكيد الطلبية
                            </a>
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
                            اضافة  سعر التوصيل
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('request.price.delivery.product.customer') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div>
                                        <div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label for="benefactor"
                                                           class="mr-sm-2">مكان التوصيل
                                                        :</label>
                                                    <select class="custom-select mr-sm-2" name="addressDelivery">
                                                        @foreach ($priceDeliveries as $priceDeliv)

                                                        <option value="{{$priceDeliv->name}}">{{$priceDeliv-> name}}</option>

                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="discription"
                                                           class="mr-sm-2"> تكلفة التوصيل
                                                        :</label>
                                                    <input class="custom-select_b" type="number" name="priceDelivery"
                                                         value="{{$priceDeliveries[0]->price}}"  required="required"/>
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

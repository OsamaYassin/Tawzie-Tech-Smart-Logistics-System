@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
     تفاصيل الطلبية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تفاصيل الطلبية
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
                                                                <input class="custom-select_b"
                                                                       value=" {{$customerReq->productName}}" type="text"
                                                                       name="name" required/>
                                                            </div>

                                                            <div class="col-md-6 d-none">
                                                                <label for="amount"
                                                                       class="mr-sm-2">رقم المنتج
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value=" {{$customerReq->productId}}" type="text"
                                                                       name="productId" required/>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="amount"
                                                                       class="mr-sm-2">الكمية القديمة
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value=" {{$customerReq -> product_quantity}}" type="text"
                                                                       name="oldQuantity" required/>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="amount"
                                                                       class="mr-sm-2">الكمية جديدة
                                                                    :</label>
                                                                <input class="custom-select_b"
                                                                       value="1" type="text"
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
                                                               value="{{ $customerReq->customer_id }}">
                                                        <input id="id" type="hidden" name="productId" class="form-control"
                                                               value="{{ $customerReq->productId }}">
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


                        @if($showStutas == 0)
                        <div class="col-md-12 " style="text-align: center;">
                            <a  href="{{route('send.order.update.status.to.one', $showorderId)}}" class="button x-small" style="background: #08c;">
                                ارسال الطلبية للتجهيز
                            </a>
                        </div>
                        @endif
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
                                                         <option value="الخرطوم">الخرطوم</option>
                                                        <option value="بحري">بحري</option>
                                                        <option value="امدرمان">الخرطوم</option>
                                                        <option value="الولايات">الولايات</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="discription"
                                                           class="mr-sm-2"> تكلفة التوصيل
                                                        :</label>
                                                    <input class="custom-select_b" type="text" name="priceDelivery"
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

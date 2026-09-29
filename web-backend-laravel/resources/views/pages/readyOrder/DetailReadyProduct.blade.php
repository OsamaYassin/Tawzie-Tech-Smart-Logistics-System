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

    <div class="" style="    margin-top: 16px;font-size: 30px;font-family: cairo;">
        <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()" style="font-size: 18px;"> <i
                class="mdi mdi-printer ml-1"></i>طباعة  الطلبية</button>
    </div>

@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30" id="print">
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
                        <div class="col-md-12 mb-3 text-center">
                            <h3 style="font-family: Cairo; margin-bottom: 30px;"> الطلبية رقم ({{$showorderId}})</h3>
                        </div>
                            <div class="col-md-6"> <h3 style="font-family: Cairo;">      {{$customerName}}  </h3>  </div>
                            <div class="col-md-6 mb-3 " style="direction: ltr;"> <?php echo DNS1D::getBarcodeSVG("$showorderId", 'C39');?></div>

                        </div>

                        <div class="table-responsive" >
                            <table  class="table  table-hover table-sm table-bordered p-0"

                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم المنتج</th>
                                    <th>   الكمية   </th>
                                    <th> السعر المنتج     </th>
                                    <th>    اجمالي السعر </th>

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
                                        <td>{{$customerReq -> product_quantity}}</td>
                                        <td> {{$customerReq -> total_price / $customerReq -> product_quantity}}</td>
                                            <td> {{$customerReq -> total_price}}</td>
                                    </tr>
                                    <!-- delete_modal_Grade -->
                                @endforeach

                                <tr style="font-size: 20px;font-weight: bold;">
                                    <td colspan="3">      رقم الهاتف</td>
                                    <td colspan="2">   {{$customerReq -> phone_one}} - {{$customerReq -> phone_two}}  </td>
                                </tr>

                                <tr style="font-size: 20px;font-weight: bold;">
                                    <td colspan="3">  مكان التوصيل</td>
                                    <td colspan="2">   {{$customerReq ->address_delivery}}   </td>
                                </tr>

                                <tr style="font-size: 20px;font-weight: bold;">
                                    <td colspan="3"> سعر التوصيل</td>
                                    <td colspan="2">  @if(isset($priceDelivery)) {{$priceDelivery}} @else 0 @endif</td>
                                </tr>

                                <tr style="font-size: 20px;font-weight: bold;">
                                    <td colspan="3"> اجمالي الطلب  </td>
                                    <td colspan="2">
                                        @if(isset($totalOrderPrice)) {{$totalOrderPrice }} @else 0 @endif
                                    </td>
                                </tr>

                                <tr style="font-size: 20px;font-weight: bold;">
                                    <td colspan="3"> اجمالي الطلب +  التوصيل</td>
                                    <td colspan="2">
                                        @if(isset($totalOrderPrice)) {{$totalOrderPrice +  $priceDelivery}} @else 0 @endif
                                    </td>
                                </tr>


                                @endisset
                            </table>
                        </div>


                        @if($showStutasDelivery == 0)
                        <div class="col-md-12 " id="senddelivery" style="text-align: center;">
                            <a  href="{{route('send.order.to.delivery', $showorderId)}}" class="button x-small" style="background: #08c;">
                                ارسال الطلبية لقسم التوصيل
                            </a>
                        </div>
                        @endif
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
     </div>



    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection


    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {

            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>



<!DOCTYPE html>
<html lang="ar">
@section('title')
توزيع تك
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">



      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @include('layouts.head')
    @livewireStyles
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

 <div id="pre-loader">
     <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
 </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0 text-center " style="font-family: 'Cairo', sans-serif">   </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row" >
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-success">
                                        <i class="fa fa fa-product-hunt highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left" style="font-size: 25px;">
                                    <p class="card-text text-dark mb-2">  المنتجات</p>
                                    <h4>{{\App\Models\Products::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('products.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-primary">
                                        <i class="fa fa-users   highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left"  style="font-size: 25px;">
                                    <p class="card-text text-dark mb-2"> المناديب  </p>
                                    <h4>{{\App\Models\Distributor::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('distributor.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-warning">
                                        <i class="fa fa-map highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left"  style="font-size: 25px;">
                                    <p class="card-text text-dark mb-2" >  نقاط البيع </p>
                                    <h4>{{\App\Models\SalesPoints::count()}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('sales.point.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-success">
                                        <i class="fa fa-bar-chart highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left"  style="font-size: 25px;">
                                    <p class="card-text text-dark"> التقارير  </p>
                                    <h4> - -</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('admin.report.one')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Orders Status widgets-->


            <div class="row">



                <div  style="height: 400px;" class="col-xl-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">اخر العمليات علي النظام</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                   href="#students" role="tab" aria-controls="students"
                                                   aria-selected="true">  المبيعات </a>
                                            </li>



                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{--students Table--}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th> رقم العملية  </th>
                                                    <th>  الاجمالي  </th>
                                                    <th> أجل  </th>
                                                    <th> كاش  </th>
                                                    <th>التاريخ</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse(\App\Models\SalesDistributor::latest()->take(5)->get() as $order)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$order->sales_id}}</td>
                                                        <td>{{$order->total_price  }}</td>
                                                        <td>{{$order->agel}}</td>

                                                        <td class="text-success">{{$order->chash}}</td>
                                                        <td class="text-success">{{$order->year .'-'.$order->months.'-'.$order->day}}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
                </div>




                <div  style="height: 400px;" class="col-xl-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">   المنتجات      </h5>
                                    </div>

                                </div>

                               <div class="row">
                                <div class="col-md-12">

                                        <a href="{{route('dashbord.collec.debet')}}" class="card btn btn-outline-info" style="border-top: 5px solid #465ba9;">
                                          <div class="card-body">
                                            <div class="d-flex justify-content-between px-md-1">
                                              <div class="align-self-center">
                                                <p style="font-size: 20px;"> تحصيل اليوم</p>
                                                <p style="font-size: 20px;">  <i class="fas fa-chart-line   fa-3x"></i></p>
                                              </div>
                                              <div class="text-end">
                                                <p style="font-size: 20px;"> {{$sumTypeOfDebet}} </p>

                                              </div>
                                            </div>
                                          </div>
                                        </a>

                                </div>

                                <div class="col-md-12 mt-2">

                                    <a href="{{route('dashbord.agel.display')}}" class="card  btn btn-outline-primary" style="border-top: 5px solid #007bff;">
                                      <div class="card-body">
                                        <div class="d-flex justify-content-between px-md-1">
                                          <div class="align-self-center">
                                            <p style="font-size: 20px;"> اجمالي الاجل  </p>
                                            <p style="font-size: 20px;">  <i class="fas fa-chart-line   fa-3x"></i></p>
                                          </div>
                                          <div class="text-end">
                                            <p style="font-size: 20px;">  {{$showDebetTotal}} </p>

                                          </div>
                                        </div>
                                      </div>
                                    </a>

                            </div>



                               </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')


</body>

</html>

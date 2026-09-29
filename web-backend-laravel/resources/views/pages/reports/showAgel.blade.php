@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    عرض الااجل
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
عرض الااجل
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

                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        </div>
                    </div>



                    <br><br>

                    <div class="table-responsive"  id="print">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>  تقطة البيع</th>
                                <th>   الاجل</th>
                                <th> التاريخ</th>
                                <th> الوقت</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>

                            @foreach($showAgelPrice as $showAgelPrice)
                                <tr>

                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td >  <a href="{{ route('sales.point.location' ,$showAgelPrice -> point_id) }}">
                                        @if (isset($showAgelPrice->distrubute_sales))
                                        {{$showAgelPrice->distrubute_sales -> point_name}}
                                        @endif
                                     </a> </td>

                                     <td id="cardsum">{{$showAgelPrice -> agel}}</td>
                                     <td>{{$showAgelPrice -> year .'-'.$showAgelPrice -> months.'-'.$showAgelPrice -> day }}</td>
                                     <td>{{$showAgelPrice -> hour}}</td>

                                </tr>




                                </tr>


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

    <script type="text/javascript">




        function printDiv() {

          //  document.getElementById("proth").style.display = "none";
           // document.getElementById("protd").style.display = "none";

            for (let element of document.getElementsByClassName("protd")){
                 element.style.display="none";
             }


             document.getElementById("datatable_filter").style.display = "none";
             document.getElementById("datatable_length").style.display = "none";
             document.getElementById("datatable_paginate").style.display = "none";


            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection

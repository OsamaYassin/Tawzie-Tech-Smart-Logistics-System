@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تقارير المبيعات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تقارير المبيعات
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<!-- row -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20" >


            <div class="card-header pb-0">

                <form action="{{ route('distributor.report.sales.one.show') }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


                   <br><br>

                    <div class="row">

                    <!-- col-4 -->




                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1" style="font-family: 'Cairo', sans-serif;color: green">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                    </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="date" required>
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1" style="font-family: 'Cairo', sans-serif;color: green">الي تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                               </div><input class="form-control fc-datepicker" value="{{ $end_at ?? '' }}"
                                    name="end_at" placeholder="YYYY-MM-DD" type="date" required>
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-primary btn-block">بحث</button>
                        </div>
                    </div>
                    <br>
             </form>

            </div>
            <div class="card-body" id="print">
                <div class="table-responsive"  style="overflow:hidden">
                    @if (isset($details))
                    <div class="col-sm-12 col-md-12">

                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                                    class="mdi mdi-printer ml-1"></i>طباعة</button>

                            </div>

                            <div class="col-md-6 mt-2 " id="ExportToExcel">
                                <button class="btn btn-primary btn-sm ExportToExcel" id="print_Button" onclick="ExportToExcel('xlsx')"> <i
                                    class="mdi mdi-printer ml-1"></i> Export Excel  </button>

                            </div>


                            <div class="col-md-12 text-center   " id="logoShow" style="display: none;">

                                <h2><img src="{{ URL::asset('assets/images/logo-dark.png') }}"  style="height: 100px;    width: 100px;" alt=""></h2>
                            </div>
                        </div>



                        </div>
                        <br>
                        <table id="tbl_exporttable_to_xls" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"   style="text-align: center ;">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">المندوب </th>
                                    <th class="border-bottom-0"> نقطة البيع  </th>
                                    <th class="border-bottom-0"> أجل</th>
                                    <th class="border-bottom-0"> الاجمالي</th>
                                    <th class="border-bottom-0">  التاريخ</th>
                                    <th class="border-bottom-0 protd"  >الاجراءت</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($details as $key => $invoice)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>

                                        <td>
                                            @if (isset($details[$key] -> distrubuter_points))
                                            {{$details[$key] -> distrubuter_points -> name  }}
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($details[$key] -> distrubute_sales))
                                            {{$details[$key] -> distrubute_sales -> point_name  }}
                                            @endif
                                        </td>

                                        <td>{{ $invoice->agel }}</td>
                                        <td>{{ $invoice->total_price }}</td>
                                        <td>{{ $invoice->year .'-'. $invoice->months .'-'.$invoice->day  }}</td>


                                         <td class="protd">
                                            <a class="btn btn-warning btn-sm" href="{{route('distributor.sales.detail' , $invoice-> sales_id )}}"><i
                                              class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                            الفاتورة
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h7 style="font-family: 'Cairo', sans-serif;color: green"> مجموع الفواتير : {{$sum}} </h7>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <h7 style="font-family: 'Cairo', sans-serif;color: green">  عدد الفواتير  : {{$count}}</h7>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
<!-- row closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {

            // مسح عمود الاجراءات
            for (let element of document.getElementsByClassName("protd")){
             element.style.display="none";
         }

            document.getElementById("ExportToExcel").style.display="none";
            document.getElementById("logoShow").style.display="block";


            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

<script>

    function ExportToExcel(type, fn, dl) {
           // مسح عمود الاجراءات
        for (let element of document.getElementsByClassName("protd")){
             element.style.display="none";
         }

        var elt = document.getElementById('tbl_exporttable_to_xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }

</script>

@endsection

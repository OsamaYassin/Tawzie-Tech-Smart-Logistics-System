@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   تقارير المنصرفات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تقارير المنصرفات
@stop
<!-- breadcrumb -->
@endsection
@section('content')
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

                <form action="{{ route('Report.Search.expenses') }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


                   <br><br>

                    <div class="row">

                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="student_name">
                    <label for="student_name">  نوع المنصرف: </label>
                                    <input  type="text" name="name" class="custom-select_b"  required>
                    </div><!-- col-4 -->




                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">

                                    </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="date">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                               </div><input class="form-control fc-datepicker" value="{{ $end_at ?? '' }}"
                                    name="end_at" placeholder="YYYY-MM-DD" type="date">
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
                <div class="table-responsive">
                    @if (isset($expensesReports))
                    <div class="col-sm-1 col-md-1">


                            <button class="btn btn-warning btn-sm" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                        </div>
                        <br>
                        <table id="example" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"   style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">الاسم  </th>
                                    <th class="border-bottom-0"> القيمة</th>
                                    <th class="border-bottom-0">تعليق </th>
                                    <th class="border-bottom-0">التاريخ</th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($expensesReports as $expensesReport)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $expensesReport->name }} </td>
                                        <td>{{ $expensesReport->value }} </td>
                                        <td>{{ $expensesReport->comment }}</td>
                                        <td>{{ $expensesReport->created_at }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection

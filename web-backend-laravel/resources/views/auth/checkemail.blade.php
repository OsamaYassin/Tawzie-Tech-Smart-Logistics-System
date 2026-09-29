@extends('layouts.master')
@section('css')
 @section('title')
     ادخل الايميل
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
   تحقق من الايميل
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post"  action="{{ route('check.email') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">   الايميل</h6><br>
                 <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الايميل : <span class="text-danger">*</span></label >
                            <div class="col-md-11">
                                <input id="email" type="email" class="form-control"  name="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> </strong>
                                    </span>
                                @enderror
                            </div>
                                </div>
                            </div>
                        </div>



                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">   تحقق</button>
                </form>

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

@extends('layouts.master')
@section('css')
 @section('title')
    اعادة تعين كلمة المرور
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اعادة تعين كلمة المرور
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post"  action="{{ route('rest.password') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">   اعادة تعين كلمة المرور</h6><br>
                 <div class="row">


                            <div class="col-md-6 d-none">
                                <div class="form-group">
                                    <label>الايميل : <span class="text-danger"> </span></label >
                            <div class="col-md-11">
                                <input id="email"  value="{{$emails}}" type="email" class="form-control"  name="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> </strong>
                                    </span>
                                @enderror
                            </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>كلمة المرور :<span class="text-danger">*</span></label>
                                <div class="col-md-11">
                                    <input id="password" type="password" class="form-control  " name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password-confirm">تاكيد كلمة المرور : <span class="text-danger">*</span></label >
                                <div class="col-md-11">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>



                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">    اعادة التعين كلمة المرور</button>
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

@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
      تعديل بيانات الملف الشخصي
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تعديل بيانات الملف الشخصي
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@foreach ($manageUsers as $user)
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post"  action="{{ route('update.user.profile') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات المستخدم</h6><br>
                 <div class="row">

                    <input  type="text"  class="d-none" name="id" value="{{$user->id}}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الاسم : <span class="text-danger">*</span></label >
                            <div class="col-md-11">
                                <input type="text" class="form-control " name="name" value="{{$user->name}}" required >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الايميل : <span class="text-danger">*</span></label >
                            <div class="col-md-11">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>كلمة المرور  الجديدة: <span class="text-danger">*</span></label >
                            <div class="col-md-11">
                                <input type="text" class="form-control"  placeholder="اخل كلمة المرور الجديدة" name="password" value="" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                </div>
                            </div>


                        </div>






                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">تعديل  البيانات</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endforeach
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render



    <script>
        function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
 </script>

@endsection


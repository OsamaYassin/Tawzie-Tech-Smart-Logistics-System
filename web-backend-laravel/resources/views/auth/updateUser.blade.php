@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل معلومات  مستحدم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
  تعديل معلومات  مستخدم
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

                <form method="post"  action="{{ route('update.user') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات المستخدم</h6><br>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                    <label>الاسم :<span class="text-danger">*</span></label>
                             <div class="col-md-11">
                                <select class="custom-select mr-sm-2" name="name">
                                    @foreach ($employee as $empl)
                                        <option value="{{ $empl->e_name }}"  @if ($empl->e_name == $user->name)   selected   @endif >{{ $empl->e_name }}</option>
                                    @endforeach
                                </select>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input  type="text"  class="d-none" name="id" value="{{$user->id}}">

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
                        </div>

                        <div class="row">


                            <hr>

                           <div class="col-md-12 mt-3 mb-3">
                                <h3>  الطلاحيات</h3>
                           </div>




                        </div>


                        <div class="row">


                           <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_acount"   @if ($user->part_acount == 1)   checked   @endif  id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم الحسابات
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_materail" @if ($user->part_materail == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم المواد الخام
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_product" @if ($user->part_product == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم المنتجات
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_inventor" @if ($user->part_inventor == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم   المخازن
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_hr" @if ($user->part_hr == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم الموارد البشرية
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab1" @if ($user->part_lab1 == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                 المعمل الاول
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab2" @if ($user->part_lab2 == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                   المعمل الثاني
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab3" @if ($user->part_lab3 == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    المعمل الثالث
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_customer" @if ($user->part_customer == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                 استقبال الطلبات وادارة العملاء
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_aftersales" @if ($user->part_aftersales == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                خدمات مابعد البيع
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_delivery" @if ($user->part_delivery == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    قسم التوصيل
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_redayorder" @if ($user->part_redayorder == 1)   checked   @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    قسم التجهيز الطلبات
                                </label>
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


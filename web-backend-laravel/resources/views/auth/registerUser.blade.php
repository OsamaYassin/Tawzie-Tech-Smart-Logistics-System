@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة مستحدم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
  اضافة مستخدم
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post"  action="{{ route('register.store') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات المستخدم</h6><br>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                    <label>الاسم :<span class="text-danger">*</span></label>
                             <div class="col-md-11">
                                <select class="custom-select mr-sm-2" name="name">
                                    @foreach ($employee as $empl)
                                        <option value="{{ $empl->e_name }}">{{ $empl->e_name }}</option>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الايميل : <span class="text-danger">*</span></label >
                            <div class="col-md-11">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                            <div class="col-md-6">
                                <div class="form-group">
                                            <label>كلمة السر :<span class="text-danger">*</span></label>
                                    <div class="col-md-11">
                                        <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                                <div class="col-md-6  " style="margin-top: 30px;">
                                    <div class="form-check">
                                        <input class="form-check-input"  type="checkbox" onclick="myFunction()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            عرض   كلمة المرور
                                        </label>
                                      </div>
                                  </div>

                            <hr>

                           <div class="col-md-12 mt-3 mb-3">
                                <h3>  الطلاحيات</h3>
                           </div>




                        </div>


                        <div class="row">


                           <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_acount" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم الحسابات
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_materail" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم المواد الخام
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_product" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم المنتجات
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_inventor" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم   المخازن
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_hr" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  قسم الموارد البشرية
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                 المعمل الاول
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab2" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                   المعمل الثاني
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_lab3" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    المعمل الثالث
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_customer" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                 استقبال الطلبات وادارة العملاء
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_aftersales" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                خدمات مابعد البيع
                                </label>
                              </div>
                          </div>


                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_delivery" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    قسم التوصيل
                                </label>
                              </div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  name="part_redayorder" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    قسم التجهيز الطلبات
                                </label>
                              </div>
                          </div>



                        </div>


                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
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


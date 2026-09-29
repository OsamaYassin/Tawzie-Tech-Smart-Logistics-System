<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->

                    @if (Auth::user()->admin == 1)
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                   </li>
                   @endif
                    <!-- menu title -->


                       <!-- Manage Product-->

                       @if (Auth::user()->part_product == 1)
                       <li>
                           <a href="javascript:void(0);" data-toggle="collapse" data-target="#manageProduct-menu">
                               <div class="pull-left"><i class=" fa fa-product-hunt"></i><span
                                       class="right-nav-text">  ادارة المنتجات </span></div>
                               <div class="pull-right"><i class="ti-plus"></i></div>
                               <div class="clearfix"></div>
                           </a>
                           <ul id="manageProduct-menu" class="collapse" data-parent="#sidebarnav">
                               <li><a href="{{route('products.index')}}">بيانات   المنتجات</a></li>
                            </ul>

                       </li>

                       @endif
                       <!-- Manage Product-->

                         <!-- Manage managedistributor -->

                         @if (Auth::user()->part_customer == 1)
                         <li>
                             <a href="javascript:void(0);" data-toggle="collapse" data-target="#managedistributor-menu">
                                 <div class="pull-left"><i class="fa fa-users "></i><span
                                         class="right-nav-text">       اداراة المناديب  </span></div>
                                 <div class="pull-right"><i class="ti-plus"></i></div>
                                 <div class="clearfix"></div>
                             </a>
                             <ul id="managedistributor-menu" class="collapse" data-parent="#sidebarnav">
                                 <li><a href="{{route('distributor.index')}}">     المناديب    </a></li>
                             </ul>

                         </li>
                         @endif
                         <!--  Manage managedistributor-->




                    <!--  salse point -->
                    @if (Auth::user()->part_materail == 1)
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#point-menu">
                            <div class="pull-left"><i class=" fas fa-crosshairs"></i><span
                                    class="right-nav-text"> ادراة نقاط البيع  </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="point-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('sales.point.table')}}">   جدول  </a></li>
                            <li><a href="{{route('sales.point.index')}}"> خريطة    </a></li>
                        </ul>

                    </li>

                    @endif
                    <!-- salse point -->

                       <!-- Start OrdersDistributor -->
                       @if (Auth::user()->part_materail == 1)
                       <li>
                           <a href="javascript:void(0);" data-toggle="collapse" data-target="#OrdersDistributor-menu">
                               <div class="pull-left"><i class=" fas fa-bookmark"></i><span
                                       class="right-nav-text"> ادراة  الطلبيات  </span></div>
                               <div class="pull-right"><i class="ti-plus"></i></div>
                               <div class="clearfix"></div>
                           </a>
                           <ul id="OrdersDistributor-menu" class="collapse" data-parent="#sidebarnav">
                               <li><a href="{{route('distributor.orders.index')}}">   الطلبيات  </a></li>
                               <li><a href="{{route('distributor.orders.report')}}"> تقرير    </a></li>
                           </ul>

                       </li>

                       @endif
                       <!-- End OrdersDistributor -->



                       <!-- Start SalesDistributor -->
                       @if (Auth::user()->part_materail == 1)
                       <li>
                           <a href="javascript:void(0);" data-toggle="collapse" data-target="#SalesDistributor-menu">
                               <div class="pull-left"><i class=" fas fa-shopping-cart"></i><span
                                       class="right-nav-text"> ادراة المبيعات  </span></div>
                               <div class="pull-right"><i class="ti-plus"></i></div>
                               <div class="clearfix"></div>
                           </a>
                           <ul id="SalesDistributor-menu" class="collapse" data-parent="#sidebarnav">
                               <li><a href="{{route('distributor.sales.index')}}">   المبيعات  </a></li>
                               <li><a href="{{route('distributor.sales.report')}}"> تقرير    </a></li>
                           </ul>

                       </li>

                       @endif
                       <!-- End SalesDistributor -->





                      <!-- part  of expenses-->
                      @if (Auth::user()->part_acount == 1)

                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#expenses-menu">
                            <div class="pull-left"><i class="fas fa-calculator"></i><span
                                    class="right-nav-text"> اقسم الحسابات  </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="expenses-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('expenses.index')}}">  المنصرفات</a></li>
                           <!--   <li><a href="{{route('expenses.report')}}">  تقرير المنصرفات</a></li>-->
                        </ul>

                    </li>

                      @endif

                    <!-- part  of expenses--->



                    <!-- material-->
                    @if (Auth::user()->part_materail == 1)
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Material-menu">
                            <div class="pull-left"><i class="fas fa-list-alt"></i><span
                                    class="right-nav-text">المواد الخام</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Material-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('material.index')}}">بيانات المواد الخام</a></li>
                        </ul>

                    </li>

                    @endif
                    <!-- material-->

                    <!-- Manage inventory -->
                    @if (Auth::user()->part_inventor == 1)
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#inventory-menu">
                            <div class="pull-left"><i class="fas fa-warehouse"></i><span
                                    class="right-nav-text">        ادارة المخزن </span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="inventory-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('inventory.index')}}">    المنتجات    </a></li>
                            <li><a href="{{route('inventory.material.index')}}">    المواد الخام    </a></li>


                        </ul>

                    </li>

                    @endif
                    <!--  Manage inventory-->


   		        <!-- HR-->
                   @if (Auth::user()->part_hr == 1)
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#HR-menu">
                                <div class="pull-left"><i class="far fa-address-book"></i><span
                                        class="right-nav-text">قسم الموارد البشرية</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="HR-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('departments.index')}}">بيانات الأقسام</a></li>
                                <li><a href="{{route('employees.index')}}">بيانات الموظفين</a></li>
                                <li><a href="{{route('salarys.index')}}">المرتبات</a></li>
                                <li><a href="{{route('vications.index')}}">العطلات</a></li>
                            </ul>

                        </li>
                     @endif


                         <!-- complayments -->
                         @if (Auth::user()->part_aftersales == 1)
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#complayments-menu">
                                <div class="pull-left"><i class="far fa-handshake"></i><span
                                        class="right-nav-text">  خدمات بعد البيع</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="complayments-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('complayments.index')}}"> مشاكل العملاء</a></li>
                                <li><a href="{{route('presolutions.index')}}"> الحلول المعدة مسبقا</a></li>

                            </ul>

                        </li>

                        @endif









                    <!-- library-->



                    <!-- Onlinec lasses-->


                    @if (Auth::user()->admin == 1)

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon2">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span class="right-nav-text">التقارير</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon2" class="collapse" data-parent="#sidebarnav">

                             <li> <a   target="_blank" href="{{route('admin.report.one')}}"> تقرير 1 </a> </li>
                            <li> <a  target="_blank" href="{{route('admin.report.two')}}"> تقرير 2 </a> </li>
                            <li> <a  target="_blank" href="{{route('admin.show.monitoring')}}">  Monitoring</a> </li>

                        </ul>
                    </li>

                    @endif

                @if (Auth::user()->admin == 1)

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon1">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('main_trans.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon1" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{route('manage.users')}}"> ادارة مستخدمين    </a> </li>
                            <li> <a href="{{route('User.index')}}">اضافة مستخدم </a> </li>
                            <li> <a href="{{route('check.email.index')}}">اعادة تعين كلمة السر</a> </li>

                        </ul>
                    </li>

                    @endif




                </ul>
            </div>
        </div>
    </div>
</div>

        <!-- Left Sidebar End-->

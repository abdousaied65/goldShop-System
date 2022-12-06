<style>

</style>
<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">

    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/supervisor/' . $page='home') }}"><img
                src="{{URL::asset('admin-assets/img/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/supervisor/' . $page='home') }}"><img
                src="{{URL::asset('admin-assets/img/logo.png')}}" class="logo-icon" alt="logo"></a>
    </div>

    <div class="main-sidemenu" style="overflow: auto!important;">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <a href="{{route('supervisor.home')}}">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround"
                             src="{{URL::asset('admin-assets/img/logo.png')}}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        <h4 style="color: #000!important;" class="mt-3 pt-0 pb-0 pr-4 pl-4 mb-0">
                            مجوهرات العقاب
                        </h4>
                    </div>
                </a>

            </div>
        </div>
        <ul class="side-menu" style="padding-bottom: 50px !important;" id="main-menu-navigation"
            data-menu="menu-navigation">
            <li class="slide {{ Request::is('home*') ? 'active' : '' }}">
                <a class="side-menu__item" href="{{ url('/supervisor/' . $page='home') }}">
                    <i class="fa fa-home side-menu__icon"></i>
                    <span class="side-menu__label"> الرئيسية </span></a>
            </li>

            @can('اضافة فرع','عرض فرع')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-code-branch side-menu__icon"></i>
                        <span class="side-menu__label">
                        الفروع
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة فرع')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.branches.create') }}">
                                    اضافة فرع جديد
                                </a>
                            </li>
                        @endcan
                        @can('عرض فرع')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.branches.index') }}">
                                    قائمة الفروع
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة موظف','عرض موظف')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-code-branch side-menu__icon"></i>
                        <span class="side-menu__label">
                        الموظفين
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة موظف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.employees.create') }}">
                                    اضافة موظف جديد
                                </a>
                            </li>
                        @endcan
                        @can('عرض موظف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.employees.index') }}">
                                    قائمة الموظفين
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة مستخدم','عرض مستخدم','اضافة صلاحية','عرض صلاحية')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-users side-menu__icon"></i>
                        <span class="side-menu__label">
                         الصلاحيات والمستخدمين
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة صلاحية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.roles.create') }}">
                                    اضافة صلاحية جديد
                                </a>
                            </li>
                        @endcan
                        @can('عرض صلاحية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.roles.index') }}">
                                    قائمة صلاحيات المستخدمين
                                </a>
                            </li>
                        @endcan
                        @can('اضافة مستخدم')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.supervisors.create') }}">
                                    اضافة مستخدم جديد
                                </a>
                            </li>
                        @endcan
                        @can('عرض مستخدم')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.supervisors.index') }}">
                                    قائمة المستخدمين
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan



            @can('اضافة صنف','عرض صنف')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-pie-chart side-menu__icon"></i>
                        <span class="side-menu__label">
                        الأصناف
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة صنف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.products.create') }}">
                                    اضافة صنف جديد
                                </a>
                            </li>
                        @endcan
                        @can('عرض صنف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.products.index') }}">
                                    قائمة الأصناف
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة فاتورة مبسطة','عرض فاتورة مبسطة')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-copy side-menu__icon"></i>
                        <span class="side-menu__label">
                        الفواتير الضريبية المبسطة
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة فاتورة مبسطة')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.simplified.create') }}">
                                    اضافة فاتورة ضريبية مبسطة
                                </a>
                            </li>
                        @endcan
                        @can('عرض فاتورة مبسطة')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.simplified.index') }}">
                                    عرض الفواتير الضريبية المبسطة
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة فاتورة ضريبية','عرض فاتورة ضريبية')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-building side-menu__icon"></i>
                        <span class="side-menu__label">
                        الفواتير الضريبية للشركات
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة فاتورة ضريبية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.tax.create') }}">
                                    اضافة فاتورة ضريبية لشركة
                                </a>
                            </li>
                        @endcan
                        @can('عرض فاتورة ضريبية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.tax.index') }}">
                                    عرض الفواتير الضريبية للشركات
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة فاتورة مشتريات','عرض فاتورة مشتريات')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-shopping-cart side-menu__icon"></i>
                        <span class="side-menu__label">
                        فواتير المشتريات
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة فاتورة مشتريات')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.purchases.create') }}">
                                    اضافة فاتورة مشتريات
                                </a>
                            </li>
                        @endcan
                        @can('عرض فاتورة مشتريات')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.purchases.index') }}">
                                    عرض فواتير المشتريات
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة مرتجع فاتورة مبسطة','عرض مرتجع فاتورة مبسطة')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-copy side-menu__icon"></i>
                        <span class="side-menu__label">
                        مرتجع الفواتير الضريبية المبسطة
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة مرتجع فاتورة مبسطة')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.simplified_return.create') }}">
                                    اضافة مرتجع فاتورة ضريبية مبسطة
                                </a>
                            </li>
                        @endcan
                        @can('عرض مرتجع فاتورة مبسطة')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.simplified_return.index') }}">
                                    عرض مرتجع الفواتير الضريبية المبسطة
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة مرتجع فاتورة ضريبية','عرض مرتجع فاتورة ضريبية')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-copy side-menu__icon"></i>
                        <span class="side-menu__label">
                        مرتجع الفواتير الضريبية للشركات
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة مرتجع فاتورة ضريبية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.tax_return.create') }}">
                                    اضافة مرتجع فاتورة ضريبية للشركات
                                </a>
                            </li>
                        @endcan
                        @can('عرض مرتجع فاتورة ضريبية')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.tax_return.index') }}">
                                    عرض مرتجع الفواتير الضريبية للشركات
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('اضافة مصروف ثابت','عرض مصروف ثابت')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-list side-menu__icon"></i>
                        <span class="side-menu__label">
                        المصروفات الثابتة
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة مصروف ثابت')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.fixed.create') }}">
                                    اضافة مصروف ثابت
                                </a>
                            </li>
                        @endcan
                        @can('عرض مصروف ثابت')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.fixed.index') }}">
                                    قائمة المصروفات الثابتة
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('اضافة مصروف','عرض مصروف')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-money-bill side-menu__icon"></i>
                        <span class="side-menu__label">
                            المصروفات
                        </span>
                        <i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                        @can('اضافة مصروف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.expense.create') }}">
                                    اضافة مصروف
                                </a>
                            </li>
                        @endcan
                        @can('عرض مصروف')
                            <li>
                                <a class="slide-item" href="{{ route('supervisor.expense.index') }}">
                                    قائمة المصروفات
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('التقارير')
                <li class="slide {{ Request::is('reports*') ? 'active' : '' }}">
                    <a class="side-menu__item" href="{{ url('/supervisor/' . $page='reports') }}">
                        <i class="fa fa-copy side-menu__icon"></i>
                        <span class="side-menu__label"> التقارير </span></a>
                </li>
            @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->

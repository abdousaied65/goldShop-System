<style>

</style>
<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">

    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="#"><img
                src="{{URL::asset('admin-assets/img/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="#"><img
                src="{{URL::asset('admin-assets/img/logo.png')}}" class="logo-icon" alt="logo"></a>
    </div>

    <div class="main-sidemenu" style="overflow: auto!important;">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <a href="#">
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
                <a class="side-menu__item" href="#">
                    <i class="fa fa-home side-menu__icon"></i>
                    <span class="side-menu__label"> الرئيسية </span></a>
            </li>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa fa-copy side-menu__icon"></i>
                        <span class="side-menu__label">
                        الفواتير الضريبية المبسطة
                    </span><i class="angle fe fe-chevron-down"></i>
                    </a>
                    <ul class="slide-menu">
                            <li>
                                <a class="slide-item" href="{{ route('simplified.create') }}">
                                    اضافة فاتورة ضريبية مبسطة
                                </a>
                            </li>
                            <li>
                                <a class="slide-item" href="{{ route('simplified.index') }}">
                                    عرض الفواتير الضريبية المبسطة
                                </a>
                            </li>
                    </ul>
                </li>
        </ul>
    </div>
</aside>
<!-- main-sidebar -->

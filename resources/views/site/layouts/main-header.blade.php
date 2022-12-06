<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="#">
                    <img src="{{URL::asset('admin-assets/img/logo.png')}}"
                         class="logo-1" alt="logo"></a>
                <a href="#">
                    <img src="{{URL::asset('admin-assets/img/logo.png')}}"
                         class="logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
        </div>
        <div class="main-header-right">

            <div class="nav nav-item  navbar-nav-right ml-auto">

                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="#">
                        <img src="{{asset('admin-assets/img/guest.png')}}" alt="avatar"><i></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user">
                                    <img src="{{asset('admin-assets/img/guest.png')}}" alt="avatar"><i></i>

                                </div>
                                <div class="mr-3 my-auto">
                                    <?php
                                    $admin = \App\Models\Supervisor::FindOrFail(1);
                                    ?>
                                    <h6>{{$admin->name}}</h6><span>
                                        {{$admin->role_name}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->

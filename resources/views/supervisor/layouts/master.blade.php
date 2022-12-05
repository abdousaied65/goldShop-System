<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="مجوهرات العقاب">
    <meta name="Author" content="مجوهرات العقاب">
    <link rel="icon" href="{{asset('admin-assets/img/logo.png')}}" type="image/png">
    <meta name="Keywords" content=""/>
    @include('supervisor.layouts.head')

    <style type="text/css" media="print">
        @media print {
            .app-content, .content {
                margin-right: 0 !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                print-color-adjust: exact;
                -o-print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }

            .printy {
                display: block !important;
            }
        }
    </style>
    <style>
        @font-face {
            font-family: 'Almarai';
            src: url("{{asset('fonts/Almarai.ttf')}}");
        }

        label {
            font-size: 14px !important;
        }

        table {
            font-size: 14px !important;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Almarai' !important;
        }

        .dropdown-menu.dropdown-menu-right.show {
            width: 200px !important;
        }

        body, html {
            font-family: 'Almarai' !important;
            font-size: 14px !important;
        }

        .navigation.navigation-main {
            padding-bottom: 200px !important;
        }

        .btn-md, .badge {
            font-family: 'Almarai' !important;
            font-size: 14px !important;
        }

        .btn.dropdown-toggle.bs-placeholder, .btn.dropdown-toggle {
            height: 40px !important;
        }
        .select2-selection__rendered {
            line-height: 40px !important; border-radius: 0!important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;border-radius: 0!important;
        }
        .select2-selection__arrow {
            height: 40px !important;border-radius: 0!important;
        }
        .select2-search__field{
            height: 40px!important;
            line-height: 40px!important;
            outline: 0!important;
        }
        .dropdown-menu.show{
            right: 0!important;
            left: auto!important;
        }
        .side-menu__icon {
            font-size: 14px !important;
        }
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #fff!important;
            border-radius: 5px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #444!important;
            border-radius: 5px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #444!important;
        }
    </style>
</head>

<body dir="rtl" class=" app sidebar-mini">
@include('supervisor.layouts.main-sidebar')
<!-- main-content -->
<div class="main-content app-content" style="margin-right: 280px!important;">
@include('supervisor.layouts.main-header')
<!-- container -->
    <div class="container-fluid">
        @yield('page-header')
        @yield('content')
    </div>
</div>
@include('supervisor.layouts.footer')
@include('supervisor.layouts.footer-scripts')
</body>
</html>

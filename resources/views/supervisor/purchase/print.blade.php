<!DOCTYPE html>
<html>
<head>
    <title> طباعة فواتير المشتريات </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/admin-assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Almarai';
            src: url({{asset('fonts/Almarai.ttf')}});
        }

        span.badge {
            padding: 10px !important;
        }

        body, html {
            font-family: 'Almarai' !important;
        }

        .table-container {
            width: 70%;
            margin: 10px auto;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            right: 10px;
            border-radius: 0;
            z-index: 9999;
        }
    </style>
    <style type="text/css" media="print">
        body, html {
            font-family: 'Almarai' !important;
        }

        span.badge {
            padding: 10px !important;
        }

        * {
            font-size: 14px !important;
            color: #000 !important;
            font-weight: bold !important;
        }

        .no-print, .noprint {
            display: none;
        }
    </style>
</head>
<body style="background: #fff">
<table class="table table-bordered table-container">
    <tbody>
    <tr>
        <td class="text-center">
            <img style="width: 100px!important; height: 100px!important;" src="{{asset('admin-assets/img/logo.png')}}"
                 alt="">
            <h1 style="color: black !important;">
                مجوهرات العقاب
            </h1>
        </td>
    </tr>
    <tr>
        <td>
            <h4 class="text-center mt-2 mb-4">طباعة كل فواتير المشتريات</h4>
            <table dir="rtl" class="table table-condensed display table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">رقم الفاتورة</th>
                    <th class="border-bottom-0 text-center">التاريخ</th>
                    <th class="border-bottom-0 text-center">اسم الفرع</th>
                    <th class="border-bottom-0 text-center">الموظف</th>
                    <th class="border-bottom-0 text-center"> اجمالى الضريبة</th>
                    <th class="border-bottom-0 text-center"> اجمالى الفاتورة</th>
                    <th class="border-bottom-0 text-center"> صورة الفاتورة</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->invoice_number }}</td>
                        <td>{{ $purchase->date}}</td>
                        <td>
                            @if(empty($purchase->branch_id))
                                كل الفروع
                            @else
                                {{ $purchase->branch->branch_name }}
                            @endif
                        </td>
                        <td>{{ $purchase->supervisor->name }}</td>
                        <td>{{ $purchase->tax_total }}</td>
                        <td>{{ $purchase->final_total }}</td>
                        <td>
                            <img data-toggle="modal" href="#modaldemo9"
                                 src="{{asset($purchase->attachment)}}"
                                 style="width: 100px!important;cursor: pointer; height: 100px!important;
                                         border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<button onclick="window.print();" class="no-print btn btn-md btn-success text-white">اضغط للطباعة</button>
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
</body>
</html>

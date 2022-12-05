<!DOCTYPE html>
<html>
<head>
    <title> طباعة المصروفات </title>
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
            <h4 class="text-center mt-2 mb-4">طباعة المصروفات </h4>
            <table dir="rtl" class="table table-condensed display table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">#</th>
                    <th class="border-bottom-0 text-center"> الفرع</th>
                    <th class="border-bottom-0 text-center">المصروف الثابت</th>
                    <th class="border-bottom-0 text-center">بيان المصروف</th>
                    <th class="border-bottom-0 text-center">الرقم التسلسلى</th>
                    <th class="border-bottom-0 text-center">التاريخ</th>
                    <th class="border-bottom-0 text-center">المبلغ</th>
                    <th class="border-bottom-0 text-center">ملاحظات</th>
                    <th class="border-bottom-0 text-center">صورة المصروف</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $expense->branch->branch_name }} </td>
                        <td>{{ $expense->fixed->fixed_expense }} </td>
                        <td>{{ $expense->expense_details }} </td>
                        <td>{{ $expense->unified_serial_number }} </td>
                        <td>{{ $expense->date }} </td>
                        <td>{{ $expense->amount }} </td>
                        <td>{{ $expense->notes }} </td>
                        <td>
                            <img data-toggle="modal" href="#modaldemo9"
                                 src="{{asset($expense->expense_pic)}}"
                                 style="width: 50px!important;cursor: pointer; height: 50px!important;
                                         border-radius: 100%; padding: 1px; border: 1px solid #aaa;">
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

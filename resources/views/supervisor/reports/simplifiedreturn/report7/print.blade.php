<!DOCTYPE html>
<html>
<head>
    <title>
        <?php echo " تقرير مرتجعات سعر الجرام ( الفواتير الضريبية المبسطة )"; ?>
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/admin-assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Almarai';
            src: url("{{asset('fonts/Almarai.ttf')}}");
        }

        * {
            color: #000 !important;
        }

        body, html {
            color: #000;
            font-family: 'Almarai' !important;
            font-size: 13px !important;
            font-weight: bold;
            margin: 0;
            padding: 10px;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            color: #fff !important;
            left: 30px;
            height: 40px !important;
            border-radius: 0;
            padding-top: 10px;
            z-index: 9999;
        }

        table thead tr, table tbody tr {
            border-bottom: 1px solid #aaa;
        }

        table {
            text-align: center;
            width: 100% !important;
            margin-top: 10px !important;
        }

        table tbody tr td{
            padding: 5px!important;
        }

        table tbody tr td:first-child{
            text-align: right!important;
        }
        table tbody tr td:nth-child(2){
            text-align: left!important;
        }
    </style>
    <style type="text/css" media="print">
        .above-table {
            width: 100% !important;
        }

        table {
            text-align: center;
            width: 100% !important;
            margin-top: 10px !important;
        }

        table thead tr, table tbody tr {
            border-bottom: 1px solid #aaa;
        }

        table tbody tr td{
            padding: 5px!important;
        }
        * {
            color: #000 !important;
        }

        body, html {
            color: #000;
            padding: 0px;
            margin: 0;
            font-family: 'Almarai' !important;
            font-size: 11px !important;
            font-weight: bold !important;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .pos_details {
            width: 100% !important;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .no-print {
            display: none;
        }

        table tbody tr td:first-child{
            text-align: right!important;
        }
        table tbody tr td:nth-child(2){
            text-align: left!important;
        }
    </style>
</head>
<body dir="rtl" style="background: #fff;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;" class="text-center">
<div class="pos_details justify-content-center text-center">
    <div class="text-center">
        <img class="text-center" src="{{asset('admin-assets/img/logo.png')}}"
             style="width:80px!important;height:80px!important;"/>
        <h3 class="text-center" style="font-weight: bold;">
            مجوهرات العقاب
        </h3>
        <?php
        $branch_id = $_POST['branch_id'];
        if ($branch_id == "all") {
            $branch_name = "كل الفروع";
        } else {
            $branch = \App\Models\Branch::FindOrFAil($branch_id);
            $branch_name = $branch->branch_name;
        }
        $payment_method = $_POST['payment_method'];
        if ($payment_method == "all") {
            $payment_method = "مختلف طرق الدفع";
        } elseif ($payment_method == "cash") {
            $payment_method = "كاش فقط";
        } elseif ($payment_method == "visa") {
            $payment_method = "فيزا فقط";
        } elseif ($payment_method == "mixed") {
            $payment_method = "كاش + فيزا";
        }
        ?>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            تقرير مرتجعات سعر الجرام
            <br>
            ( الفواتير الضريبية المبسطة )
        </h6>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            من
            {{$_POST['min_gram_price']}}
            الى
            {{$_POST['max_gram_price']}}
        </h6>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            للفرع
            ( {{$branch_name}} )
        </h6>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            من يوم
            {{$_POST['from_date']}}
        </h6>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            الى يوم
            {{$_POST['to_date']}}
        </h6>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            (
            {{$payment_method}}
            )
        </h6>
    </div>
    <div class="above-table w-25 text-center mt-3  justify-content-center" style="margin: 10px auto!important;">
        <hr style="border-top: 1px solid #000;">
        <table dir="rtl">
            <tr>
                <td>
                    مجموع المبلغ ( بدون ضريبة )
                </td>
                <td>{{$sum_amount_total}}</td>
            </tr>
            <tr>
                <td>
                    مجموع الذهب
                    ( مجموع الاوزان )
                </td>
                <td>{{$sum_total_weight}}</td>
            </tr>
            <tr>
                <td>
                    الأجمالي للمبلغ ( شامل الضريبة )
                </td>
                <td>{{$sum_final_total}}</td>
            </tr>
            <tr>
                <td>
                    اجمالى الضريبة
                </td>
                <td>{{$sum_tax_total}}</td>
            </tr>
            <tr>
                <td>
                    سعر الجرام
                </td>
                <td>{{$sum_gram_price}}</td>
            </tr>
        </table>
    </div>
</div>
<button onclick="window.print();" class="no-print btn btn-md btn-success">اضغط للطباعة</button>
<a href="{{route('supervisor.home')}}" class="no-print btn btn-md btn-danger"
   style="left:150px!important;">
    العودة الى النظام
</a>
</body>
</html>

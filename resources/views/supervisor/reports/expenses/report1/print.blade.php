<!DOCTYPE html>
<html>
<head>
    <title>
        <?php echo " تقرير المصروفات "; ?>
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
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        if ($branch_id == "all") {
            $branch_name = "كل الفروع";
        } else {
            $branch = \App\Models\Branch::FindOrFAil($branch_id);
            $branch_name = $branch->branch_name;
        }
        ?>
        <h6 class="text-center mt-3" style="font-weight: bold;">
            تقرير المصروفات للفرع
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
    </div>
    <div class="above-table w-25 text-center mt-3  justify-content-center" style="margin: 10px auto!important;">
        <hr style="border-top: 1px solid #000;">



        <table dir="rtl">
            @php
                $i = 0; $total = 0;
            @endphp
            @foreach ($expenses as $key => $expense)
                <?php $total = $total + $expense->amount ?>
            @endforeach
            @foreach ($fixed as $item)
                <?php
                if ($branch_id == "all") {
                    $expenses = \App\Models\Expense::where('fixed_id',$item->id)
                        ->whereBetween('date', [$from_date, $to_date])
                        ->get();
                } else {
                    $expenses = \App\Models\Expense::where('fixed_id',$item->id)
                        ->where('branch_id', $branch_id)
                        ->whereBetween('date', [$from_date, $to_date])
                        ->get();
                }
                $total_fix = 0;
                foreach ($expenses as $expense) {
                    $total_fix = $total_fix + $expense->amount;
                }
                ?>
                <tr>
                    <td>{{$item->fixed_expense}}</td>
                    <td>{{$total_fix}}</td>
                </tr>
            @endforeach

            <tr>
                <td>اجمالى المصروفات</td>
                <td>{{ $total }} </td>
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

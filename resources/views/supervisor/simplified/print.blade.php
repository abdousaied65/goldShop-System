<!DOCTYPE html>
<html>
<head>
    <title>
        فاتورة ضريبية مبسطة رقم
        {{$simplified->unified_serial_number}}
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('admin-assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Almarai';
            src: url({{asset('fonts/Almarai.ttf')}});
        }

        * {
            color: #000 !important;
            font-size: 15px !important;
            font-weight: bold !important;
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
            font-size: 12px !important;
        }

        a.no-print {
            bottom: 35px !important;
        }
    </style>
    <style type="text/css" media="print">
        body, html {
            font-family: 'Almarai' !important;
        }

        * {
            font-size: 15px !important;
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
        <td class="thisTD">
            <center style="margin:20px auto;">
                <span style="font-size:18px;font-weight:bold;border:1px dashed #333; padding: 5px 30px;">
                   فاتورة ضريبية مبسطة
                </span>
            </center>

            <hr style="border-bottom:1px solid #000;margin:5px auto; width: 90%;"/>
            <div class="row" dir="rtl">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:10px auto;">

                    <table class="table  table-bordered text-right" dir="rtl" style="font-size:12px;">
                        <tr>
                            <td style="width:40%;">رقم الفاتورة</td>
                            <td>{{$simplified->unified_serial_number}}</td>
                            <td style="width:40%;"> تاريخ الفاتورة</td>
                            <td>{{$simplified->date}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @if(!$simplified->elements->isEmpty())
                <div class="table-responsive hoverable-table mb-5">
                    <table dir="rtl" class="display w-100  text-nowrap table-bordered" id="example-table"
                           style="text-align: center;">
                        <thead>
                        <tr>
                            <th class="border-bottom-0 text-center">#</th>
                            <th class="border-bottom-0 text-center">النوع</th>
                            <th class="border-bottom-0 text-center">العيار</th>
                            <th class="border-bottom-0 text-center">العدد</th>
                            <th class="border-bottom-0 text-center">الوزن</th>
                            <th class="border-bottom-0 text-center">الاجمالى</th>
                            <th class="border-bottom-0 text-center">سعر الجرام</th>
                            <th class="border-bottom-0 text-center"> المبلغ</th>
                            <th class="border-bottom-0 text-center"> الضريبة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach($simplified->elements as $element)
                            <tr>
                                <td>
                                    {{++$i}}
                                </td>
                                <td>
                                    {{$element->product->product_name}}
                                </td>
                                <td>
                                    {{$element->karat}}
                                </td>
                                <td>
                                    {{$element->count}}
                                </td>
                                <td>
                                    {{$element->weight}}
                                </td>
                                <td>
                                    {{$element->total}}
                                </td>
                                <td>
                                    {{$element->gram_price}}
                                </td>
                                <td>
                                    {{$element->amount}}
                                </td>
                                <td>
                                    {{$element->tax}}
                                </td>

                            </tr>
                        @endforeach

                        <tr class="text-center">
                            <td colspan="3">
                                الاجمالى
                            </td>
                            <td>{{$simplified->total_count}}</td>
                            <td>{{$simplified->total_weight}}</td>
                            <td>{{$simplified->final_total}}</td>
                            <td>{{$simplified->gram_total_price}}</td>
                            <td>{{$simplified->amount_total}}</td>
                            <td>{{$simplified->tax_total}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            @endif
            <table class="table table-bordered text-right" dir="rtl" style="font-size:12px;">
                <tbody>
                <tr>
                    <td>الاجمالى قبل الخصم والضريبة :
                        {{$simplified->amount_total}}
                        ريال سعودى
                    </td>
                    <td> خصم 0 ريال سعودى<span style="margin-right:30px;"> مصاريف شحن 0 ريال سعودى</span></td>
                </tr>
                <tr>
                    <td>ضريبة القيمة المضافة : ( 15% )</td>
                    <td>قيمة ضريبة القيمة المضافة :
                        {{$simplified->tax_total}}
                        ريال سعودى
                    </td>
                </tr>
                <tr>
                    <td>اجمالى الفاتورة بعد الخصم والضريبة :
                        {{$simplified->final_total}}
                        ريال سعودى
                    </td>
                    <td>المبلغ المدفوع :
                        {{$simplified->final_total}}
                        ريال سعودى
                    </td>
                </tr>
                <tr style="text-align:center;">
                    <td style="text-align:center;" colspan="2"> المبلغ المتبقى : 0 ريال سعودى</td>
                </tr>
                </tbody>
            </table>

            <div class="clearfix"></div>

            <div class="text-center mt-2 mb-2">
                <?php
                use Salla\ZATCA\GenerateQrCode;
                use Salla\ZATCA\Tags\InvoiceDate;
                use Salla\ZATCA\Tags\InvoiceTaxAmount;
                use Salla\ZATCA\Tags\InvoiceTotalAmount;
                use Salla\ZATCA\Tags\Seller;
                use Salla\ZATCA\Tags\TaxNumber;
                $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                    new Seller("مؤسسة الذهب للتجارة"), // seller name
                    new TaxNumber('12345678900003'), // seller tax number
                    new InvoiceDate($simplified->date . " " . $simplified->time), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                    new InvoiceTotalAmount(round($simplified->final_total, 2)), // invoice total amount
                    new InvoiceTaxAmount(round($simplified->tax_total, 2)) // invoice tax amount
                    // TODO :: Support others tags
                ])->render();
                ?>
                <img src="{{$displayQRCodeAsBase64}}" style="width: 150px; height: 150px;" alt="QR Code"/>

            </div>
        </td>
    </tr>
    </tbody>
</table>
<a href="{{route('supervisor.simplified.create')}}" class="no-print btn btn-md btn-danger text-white">
    العودة الى الفاتورة
</a>

<button onclick="window.print();" class="no-print btn btn-md btn-success text-white">
    طباعة الفاتورة
</button>
</body>
</html>

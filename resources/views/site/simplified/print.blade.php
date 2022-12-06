<!DOCTYPE html>
<html>
<head>
    <title>
        <?php echo " فاتورة ضريبية مبسطة رقم " . $simplified->unified_serial_number;  ?>
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
    </style>
</head>
<body dir="rtl" style="background: #fff;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;" class="text-center">
<div class="pos_details  justify-content-center text-center">
    <div class="text-center">
        <img class="text-center" src="{{asset('admin-assets/img/logo.png')}}"
             style="width:80px!important;height:80px!important;" />
        <h3 class="text-center" style="font-weight: bold;">
            مجوهرات العقاب
        </h3>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            {{$simplified->branch->branch_address}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            {{$simplified->branch->branch_name}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            هاتف :
            {{$simplified->branch->branch_phone}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            Snap :
            {{$simplified->branch->snap}}
        </h6>
        <h5 class="text-center mt-1" style="font-weight: bold;">
            فاتورة ضريبية مبسطة
        </h5>
        <div class="clearfix"></div>
        <div class="visible-print text-center mt-1">
            <?php
            use Salla\ZATCA\GenerateQrCode;
            use Salla\ZATCA\Tags\InvoiceDate;
            use Salla\ZATCA\Tags\InvoiceTaxAmount;
            use Salla\ZATCA\Tags\InvoiceTotalAmount;
            use Salla\ZATCA\Tags\Seller;
            use Salla\ZATCA\Tags\TaxNumber;
            $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                new Seller("مجوهرات العقاب"), // seller name
                new TaxNumber(302063352400003), // seller tax number
                new InvoiceDate($simplified->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                new InvoiceTotalAmount($simplified->final_total), // invoice total amount
                new InvoiceTaxAmount($simplified->tax_total) // invoice tax amount
                // TODO :: Support others tags
            ])->render();
            ?>
            <img src="{{$displayQRCodeAsBase64}}" style="width: 150px; height: 150px;" alt="QR Code"/>
        </div>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            الرقم الضريبى :
            302063352400003
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            س . ت :
            {{$simplified->branch->commercial_record}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            رقم الترخيص :
            <span dir="ltr">
                {{$simplified->branch->license_number}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            رقم الفاتورة :
            <span dir="ltr">
                {{$simplified->unified_serial_number}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            التاريخ :
            <span dir="ltr">
                {{$simplified->date}}
                {{date('H:i:s a',strtotime($simplified->time))}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            المباع على المكرم :
            <span dir="ltr">
                -----------------------------------
            </span>
        </h6>
    </div>

    <div class="above-table w-25 text-center mt-3  justify-content-center" style="margin: 10px auto!important;">
        <table dir="rtl" class="text-center justify-content-center">
            <thead>
            <tr style="border: 1px solid #aaa">
                <td style='border: 1px solid #aaa'>
                    النوع
                </td>
                <td style='border: 1px solid #aaa'>
                    العيار
                </td>
                <td style='border: 1px solid #aaa'>
                    الوزن
                </td>
                <td style='border: 1px solid #aaa'>
                    العدد
                </td>
                <td style='border: 1px solid #aaa'>
                    المبلغ
                </td>
                <td style='border: 1px solid #aaa'>
                    TAX
                </td>
            </tr>
            <tr style="border: 1px solid #aaa">
                <td style='border: 1px solid #aaa'>
                    Type
                </td>
                <td style='border: 1px solid #aaa'>
                    Carat
                </td>
                <td style='border: 1px solid #aaa'>
                    Weight
                </td>
                <td style='border: 1px solid #aaa'>
                    No
                </td>
                <td style='border: 1px solid #aaa'>
                    Amount
                </td>
                <td style='border: 1px solid #aaa'>
                    TAX
                </td>
            </tr>
            </thead>
            <tbody>
            <?php $simplified_elements = $simplified->elements; ?>
            @if(isset($simplified) && isset($simplified_elements) && !$simplified_elements->isEmpty())
                <?php
                foreach ($simplified_elements as $element) {
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->product->product_name . "</td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->karat . "</td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->weight . "</td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->count . "</td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->amount . "</td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'>" . $element->tax . "</td>";
                    echo "</tr>";
                }
                ?>
            @endif
            </tbody>
        </table>
        <hr style="border-top: 1px solid #000;">
        <div class="clearfix"></div>
        <table dir="rtl">
            <tr>
                <td>
                    مجموع الذهب
                </td>
                <td>
                    {{$simplified->total_weight}}
                </td>
                <td>
                    Weight Sum
                </td>
            </tr>
            <tr>
                <td>
                    المجموع
                </td>
                <td>
                    {{$simplified->amount_total}}
                </td>
                <td>
                    Sub Total
                </td>
            </tr>
            <tr>
                <td>
                    الضريبة 15%
                </td>
                <td>
                    {{$simplified->tax_total}}
                </td>
                <td>
                    VAT 15%
                </td>
            </tr>
            <tr>
                <td>
                    قيمة الفاتورة
                </td>
                <td>
                    {{$simplified->final_total}}
                </td>
                <td>
                    Total
                </td>
            </tr>
        </table>
        <hr style="border-top: 1px solid #000;">
        <h6 class="text-center mt-1" style="font-weight: bold;">
            التوقيع :
            <span dir="ltr">
                ---------------------
            </span>
        </h6>
        <h6 class="text-center mt-1 p-2" style="font-weight: bold;border: 1px solid #000">
            البضاعة لا ترجع
        </h6>
    </div>
</div>
<button onclick="window.print();" class="no-print btn btn-md btn-success">اضغط للطباعة</button>
<a href="{{route('simplified.index')}}" class="no-print btn btn-md btn-danger"
   style="left:150px!important;">
    العودة الى الفاتورة الضريبية المبسطة
</a>
</body>
</html>

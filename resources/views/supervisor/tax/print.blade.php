<!DOCTYPE html>
<html>
<head>
    <title>
        <?php echo " فاتورة ضريبية للشركات والمؤسسات رقم " . $tax->unified_serial_number;  ?>
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
<div class="pos_details justify-content-center text-center">
    <div class="text-center">
        <img class="text-center" src="{{asset('admin-assets/img/logo.png')}}"
             style="width:80px!important;height:80px!important;" />
        <h3 class="text-center" style="font-weight: bold;">
            مجوهرات العقاب
        </h3>
        <h6 class="text-center" style="font-weight: bold;">
            مؤسسة نايف بن محمد العقاب للمعادن
            <br/>
            الثمينة والاحجار الكريمة 
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            {{$tax->branch->branch_address}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            {{$tax->branch->branch_name}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            هاتف :
            {{$tax->branch->branch_phone}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            Snap :
            {{$tax->branch->snap}}
        </h6>
        <h5 class="text-center mt-1" style="font-weight: bold;">
            فاتورة ضريبية للشركات والمؤسسات
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
                new InvoiceDate($tax->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                new InvoiceTotalAmount($tax->final_total), // invoice total amount
                new InvoiceTaxAmount($tax->tax_total) // invoice tax amount
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
            {{$tax->branch->commercial_record}}
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            رقم الترخيص :
            <span dir="ltr">
                {{$tax->branch->license_number}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            رقم الفاتورة :
            <span dir="ltr">
                {{$tax->unified_serial_number}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            التاريخ :
            <span dir="ltr">
                {{$tax->date}}
                {{date('H:i:s a',strtotime($tax->time))}}
            </span>
        </h6>

        <h6 class="text-center mt-1" style="font-weight: bold;">
            اسم الشركة او المؤسسة :
            <span dir="ltr">
                {{$tax->company_name}}
            </span>
        </h6>
        <h6 class="text-center mt-1" style="font-weight: bold;">
            الرقم الضريبى للشركة :
            <span dir="ltr">
                {{$tax->company_tax_number}}
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
            <?php $tax_elements = $tax->elements; ?>
            @if(isset($tax) && isset($tax_elements) && !$tax_elements->isEmpty())
                <?php
                foreach ($tax_elements as $element) {
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
                    {{$tax->total_weight}}
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
                    {{$tax->amount_total}}
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
                    {{$tax->tax_total}}
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
                    {{$tax->final_total}}
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
<a href="{{route('supervisor.home')}}" class="no-print btn btn-md btn-danger"
   style="left:150px!important;">
    العودة الى النظام
</a>
</body>
</html>

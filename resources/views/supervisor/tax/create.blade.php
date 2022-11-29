@extends('supervisor.layouts.master')
<style>
    div.product {
        font-size: 11px;
        width: 100% !important;
        border: 1px solid #0A3551;
        color: #0A3551;
        border-radius: 10px;
        height: auto;
        padding: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    tbody tr td, tfoot tr th {
        padding: 10px !important;
    }

    div.product:hover {
        cursor: pointer;
        box-shadow: 1px 1px 5px red !important;
        border: 1px solid red !important;

    }

    div.product:hover span {
        color: red !important;
        font-weight: bold;
    }

    select option {
        font-size: 15px !important;
    }


</style>
@section('content')
    <!-- main-content closed -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="alert alert-md alert-warning text-center text-white"
                        style="font-weight: bold!important;text-shadow: 1px 1px 5px #000;">
                        اضافة فاتورة ضريبية لشركة او مؤسسة
                        <div style="margin-top: 10px;">
                            رقم الفاتورة
                            [
                            @if(isset($open_invoice) && !empty($open_invoice))
                                {{$open_invoice->unified_serial_number}}
                            @else
                                {{$unified_serial_number}}
                            @endif
                            ]
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{route('supervisor.tax.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}"/>
                        <input type="hidden" name="unified_serial_number"
                               @if(isset($open_invoice) && !empty($open_invoice))
                               value="{{$open_invoice->unified_serial_number}}"
                               @else
                               value="{{$unified_serial_number}}"
                            @endif
                        >
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        طريقة الدفع
                                    </label>
                                    <select required
                                            @if(isset($open_invoice) && !empty($open_invoice))
                                            disabled
                                            @endif
                                            name="payment_method" class="form-control">
                                        <option value="">
                                            اختر طريقة الدفع
                                        </option>
                                        <option
                                            @if(isset($open_invoice) && !empty($open_invoice) && $open_invoice->payment_method == "cash" )
                                            selected
                                            @endif
                                            value="cash">كاش
                                        </option>
                                        <option
                                            @if(isset($open_invoice) && !empty($open_invoice) && $open_invoice->payment_method == "visa" )
                                            selected
                                            @endif
                                            value="visa">فيزا
                                        </option>
                                        <option
                                            @if(isset($open_invoice) && !empty($open_invoice) && $open_invoice->payment_method == "mixed" )
                                            selected
                                            @endif
                                            value="mixed">كاش + فيزا
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        التاريخ
                                    </label>
                                    <input class="form-control" type="date" name="date"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->date}}" readonly
                                           @else
                                           value="{{date('Y-m-d')}}"
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الوقت
                                    </label>
                                    <input class="form-control" type="time" name="time"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->time}}" readonly
                                           @else
                                           value="{{date('H:i:s')}}"
                                        @endif

                                    />
                                </div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اسم الفرع
                                    </label>
                                    <input class="form-control" type="text" readonly
                                           value="{{Auth::user()->branch->branch_name}}"/>
                                </div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الموظف
                                    </label>
                                    <input class="form-control" type="text" readonly value="{{Auth::user()->name}}"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row text-center justify-content-center">

                            <div class="col-lg-6 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اسم الشركة او المؤسسة
                                    </label>
                                    <input class="form-control" required type="text" name="company_name"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->company_name}}" readonly
                                           @else
                                           value=""
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الرقم الضريبى للشركة او المؤسسة
                                    </label>
                                    <input class="form-control" required
                                           minlength="15"
                                           maxlength="15"
                                           type="text" dir="ltr" name="company_tax_number"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->company_tax_number}}" readonly
                                           @else
                                           value=""
                                        @endif
                                    />
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <hr/>
                        <div class="row text-center justify-content-center">
                            @if(isset($products) && !$products->isEmpty())
                                @foreach($products as $product)
                                    <div class='col-lg-2 pull-right text-center'>
                                        @if($product->tax == 0)
                                            <div class='product'
                                                 style='box-shadow: 1px 1px 5px darkcyan;border:1px solid darkcyan;'
                                                 product_id='{{$product->id}}'>
                                                <span
                                                    style='font-size:14px;font-weight:bold;color: darkcyan;'> {{$product->product_name}} </span>
                                            </div>
                                        @else
                                            <div class='product'
                                                 style='box-shadow: 1px 1px 1px #444;border:1px solid #444;'
                                                 product_id='{{$product->id}}'>
                                                <span
                                                    style='font-size:14px;font-weight:normal;color: #444;'> {{$product->product_name}} </span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <hr/>
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اختر النوع
                                    </label>
                                    <select required class="js-example-basic-single w-100" name="product_id"
                                            id="product_id">
                                        <option value="">
                                            اختر
                                        </option>
                                        @if(isset($products) && !$products->isEmpty())
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">
                                                    {{$product->product_name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اختر العيار
                                    </label>
                                    <select required class="form-control" name="karat"
                                            id="karat">
                                        <option value="">
                                            اختر
                                        </option>
                                        <option value="18">
                                            18
                                        </option>
                                        <option selected value="21">
                                            21
                                        </option>
                                        <option value="24">
                                            24
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        العدد
                                    </label>
                                    <input dir="ltr" min="1" type="number" value="0" name="count" id="count"
                                           class="form-control"/>
                                </div>
                            </div>

                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الوزن
                                    </label>
                                    <input dir="ltr" min="1" type="number" value="0" name="weight"
                                           class="form-control" id="weight"/>
                                </div>
                            </div>

                            <div class="col-lg-2 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الاجمالى
                                    </label>
                                    <input dir="ltr" min="1" type="number" id="total" value="0" name="total"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <button id="add" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus"></i>
                                    اضافة الى الفاتورة
                                </button>
                                @if(isset($open_invoice) && !empty($open_invoice))
                                    <a target="_blank" href="{{route('supervisor.tax.print',$open_invoice->id)}}" id="print"
                                       role="button" class="btn btn-md btn-info">
                                        <i class="fa fa-print"></i>
                                        معاينة وطباعة الفاتورة
                                    </a>
                                @endif
                            </div>
                        </div>
                        <hr/>
                        @if(isset($open_invoice) && !empty($open_invoice))
                            <div class="row text-center">
                                <h5 class="w-100 alert alert-warning text-center">
                                    <i class="fa fa-info-circle"></i>
                                    عرض تفاصيل الفاتورة
                                    <<<<<<<
                                    رقم الفاتورة
                                    [
                                    {{$open_invoice->unified_serial_number}}
                                    ]
                                </h5>
                                @if(!$open_invoice->elements->isEmpty())
                                    <div class="table-responsive hoverable-table">
                                        <table class="display w-100  text-nowrap table-bordered" id="example-table"
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
                                                <th class="border-bottom-0 text-center"> حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($open_invoice->elements as $element)
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
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-md btn-danger delete_element"
                                                                element_id="{{$element->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3">
                                                    الاجمالى
                                                </th>
                                                <th>{{$open_invoice->total_count}}</th>
                                                <th>{{$open_invoice->total_weight}}</th>
                                                <th>{{$open_invoice->final_total}}</th>
                                                <th>{{$open_invoice->gram_total_price}}</th>
                                                <th>{{$open_invoice->amount_total}}</th>
                                                <th>{{$open_invoice->tax_total}}</th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-lg-3 pull-right mt-3">
                                        <h5 class="badge badge-light p-3 w-100">
                                            المجموع :
                                            {{$open_invoice->final_total}}
                                        </h5>
                                    </div>
                                    <div class="col-lg-3 pull-right mt-3">
                                        <button id="cancel" tax_id={{$open_invoice->id}} type="button"
                                                class="btn btn-md btn-danger w-100">
                                            <i class="fa fa-cancel"></i>
                                            الغاء الفاتورة
                                        </button>
                                    </div>
                                    <div class="col-lg-6 pull-right mt-3">
                                        @if($open_invoice->payment_method == "mixed")
                                            <div class="row">
                                                <div class="col-lg-4 pull-right">
                                                    <input id="cash_amount" type="number" min="1" class="form-control"
                                                           dir="ltr" value="" placeholder="المبلغ كاش"/>
                                                </div>
                                                <div class="col-lg-4 pull-right">
                                                    <input id="visa_amount" type="number" min="1" class="form-control"
                                                           dir="ltr" value="" placeholder="المبلغ فيزا"/>
                                                </div>
                                                <div class="col-lg-4 pull-right">
                                                    <button id="save" final_total="{{$open_invoice->final_total}}"
                                                            payment_method="mixed"
                                                            tax_id={{$open_invoice->id}} type="button"
                                                            class="btn btn-md btn-success w-100">
                                                        <i class="fa fa-check"></i>
                                                        حفظ الفاتورة
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <button id="save" final_total="{{$open_invoice->final_total}}"
                                                    payment_method="{{$open_invoice->payment_method}}"
                                                    tax_id={{$open_invoice->id}} type="button"
                                                    class="btn btn-md btn-success w-100">
                                                <i class="fa fa-check"></i>
                                                حفظ الفاتورة
                                            </button>
                                        @endif
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.product').on('click', function () {
                let product_id = $(this).attr('product_id');
                $('#product_id').val(product_id).trigger('change');
                $('#count').val(1);
                $('#weight').val(1);
                $('#total').val(1);
            });
            $('.delete_element').on('click', function () {
                let element_id = $(this).attr('element_id');
                $.post("{{route('delete.element.tax')}}", {
                    element_id: element_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    window.location.reload();
                });
            });
            $('#cancel').on('click', function () {
                let tax_id = $(this).attr('tax_id');
                $.post("{{route('delete.tax')}}", {
                    tax_id: tax_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    window.location.reload();
                });
            });

            $('#save').on('click', function () {

                let tax_id = $(this).attr('tax_id');
                let payment_method = $(this).attr('payment_method');
                let final_total = $(this).attr('final_total');

                if (payment_method == "mixed") {
                    let cash_amount = $('#cash_amount').val();
                    let visa_amount = $('#visa_amount').val();
                    if (cash_amount == "" || visa_amount == "") {
                        alert('لا تترك خانات المبالغ فارغة');
                    } else {
                        let total_amount = parseFloat(cash_amount) + parseFloat(visa_amount);
                        if (total_amount != final_total) {
                            alert('لابد ان يكون مجموع المبلغين مساويا لاجمالى الفاتورة');
                        } else {
                            $.post("{{route('save.tax')}}", {
                                tax_id: tax_id,
                                cash_amount: cash_amount,
                                visa_amount: visa_amount,
                                "_token": "{{ csrf_token() }}"
                            }, function (data) {
                                window.location.reload();
                            });
                        }
                    }

                } else {
                    $.post("{{route('save.tax')}}", {
                        tax_id: tax_id,
                        "_token": "{{ csrf_token() }}"
                    }, function (data) {
                        window.location.reload();
                    });
                }

            });


        });
    </script>
@endsection

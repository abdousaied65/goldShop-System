@extends('supervisor.layouts.master')
<style>
    span.float-right > i.fa {
        font-size: 40px !important;
    }

    h3 {
        font-size: 15px !important;
    }
</style>
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                    لوحة تحكم المستخدمين (الادارة)
                </h2>
                <hr>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row mt-3 mb-3">
        <div class="col-lg-12 text-right">
            <h2 class="mt-2">
                احصائيات النظام
            </h2>
        </div>
        @if(empty(Auth::user()->branch_id))
            <?php
            $today = date('Y-m-d');
            $today_simplified_invoices = \App\Models\SimplifiedInvoice::where('date', $today)
                ->where('status', 'done')
                ->get();
            $today_tax_invoices = \App\Models\TaxInvoice::where('date', $today)
                ->where('status', 'done')
                ->get();
            $sum_final_total = 0;
            foreach ($today_simplified_invoices as $simplified_invoice) {
                $sum_final_total = round(($sum_final_total + $simplified_invoice->final_total), 2);
            }
            foreach ($today_tax_invoices as $tax_invoice) {
                $sum_final_total = round(($sum_final_total + $tax_invoice->final_total), 2);
            }

            $today_simplified_return_invoices = \App\Models\SimplifiedInvoice::where('date', $today)
                ->where('status', 'return')
                ->get();
            $today_tax_return_invoices = \App\Models\TaxInvoice::where('date', $today)
                ->where('status', 'return')
                ->get();

            $sum_return_final_total = 0;
            foreach ($today_simplified_return_invoices as $invoice) {
                $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
            }
            foreach ($today_tax_return_invoices as $invoice) {
                $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
            }

            $today_purchases_invoices = \App\Models\PurchaseInvoice::where('date', $today)
                ->get();
            $sum_purchases_final_total = 0;
            foreach ($today_purchases_invoices as $invoice) {
                $sum_purchases_final_total = round(($sum_purchases_final_total + $invoice->final_total), 2);
            }

            ?>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <a class="get_details" data-toggle="modal"
                       href="#modaldemo8">
                        <div class="card overflow-hidden sales-card bg-secondary-gradient">

                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">

                                <div class="">
                                    <h3 class="mb-3 text-white">اجمالى مبيعات اليوم</h3>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_final_total}}</h1>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-money-bill fa-2x text-white"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">اجمالى مرتجعات اليوم</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_return_final_total}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">اجمالى مشتريات اليوم</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_purchases_final_total}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        @else
            <?php
            $branch_id = Auth::user()->branch_id;
            $today = date('Y-m-d');
            $today_simplified_invoices = \App\Models\SimplifiedInvoice::where('date', $today)
                ->where('status', 'done')
                ->where('branch_id', $branch_id)
                ->get();
            $today_tax_invoices = \App\Models\TaxInvoice::where('date', $today)
                ->where('status', 'done')
                ->where('branch_id', $branch_id)
                ->get();
            $sum_final_total = 0;
            foreach ($today_simplified_invoices as $simplified_invoice) {
                $sum_final_total = round(($sum_final_total + $simplified_invoice->final_total), 2);
            }
            foreach ($today_tax_invoices as $tax_invoice) {
                $sum_final_total = round(($sum_final_total + $tax_invoice->final_total), 2);
            }

            $today_simplified_return_invoices = \App\Models\SimplifiedInvoice::where('date', $today)
                ->where('status', 'return')
                ->where('branch_id', $branch_id)
                ->get();
            $today_tax_return_invoices = \App\Models\TaxInvoice::where('date', $today)
                ->where('status', 'return')
                ->where('branch_id', $branch_id)
                ->get();

            $sum_return_final_total = 0;
            foreach ($today_simplified_return_invoices as $invoice) {
                $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
            }
            foreach ($today_tax_return_invoices as $invoice) {
                $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
            }

            $today_purchases_invoices = \App\Models\PurchaseInvoice::where('date', $today)
                ->where('branch_id', $branch_id)
                ->get();
            $sum_purchases_final_total = 0;
            foreach ($today_purchases_invoices as $invoice) {
                $sum_purchases_final_total = round(($sum_purchases_final_total + $invoice->final_total), 2);
            }
            ?>
            {{--            branch--}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">اجمالى مبيعات اليوم</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_final_total}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">اجمالى مرتجعات اليوم</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_return_final_total}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="javascript:;">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">اجمالى مشتريات اليوم</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-30 font-weight-bold mb-1 text-white">{{$sum_purchases_final_total}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        @endif
    </div>

    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class=" card-header p-0 d-flex justify-content-between">
                    <h4 class="card-title mb-1">
                        احدث الفواتير الضريبية المبسطة
                    </h4>
                </div>
                <span class="tx-12 tx-muted mb-3 ">سجل لاخر واحدث عمليات اضافة الفواتير الضريبية المبسطة</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0 text-center">
                                رقم الفاتورة
                            </th>
                            <th class="border-bottom-0 text-center">
                                تاريخ - وقت
                            </th>
                            <th class="border-bottom-0 text-center">
                                طريقة الدفع
                            </th>
                            <th class="border-bottom-0 text-center">
                                الفرع
                            </th>
                            <th class="border-bottom-0 text-center">
                                الموظف
                            </th>
                            <th class="border-bottom-0 text-center">
                                الضريبة
                            </th>
                            <th class="border-bottom-0 text-center">
                                الاجمالى
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_simplified_invoices as $simplified)
                            <tr>
                                <td>{{ $simplified->unified_serial_number }}</td>
                                <td>{{ $simplified->date}} - {{ $simplified->time}} </td>
                                <td>
                                    @if($simplified->payment_method == "cash")
                                        {{$simplified->cash_amount}} كاش
                                    @elseif($simplified->payment_method == "visa")
                                        {{$simplified->visa_amount}} فيزا
                                    @else
                                        {{$simplified->cash_amount}} كاش
                                        +
                                        {{$simplified->visa_amount}} فيزا
                                    @endif
                                </td>
                                <td>
                                    @if(empty($simplified->branch_id))
                                        كل الفروع
                                    @else
                                        {{ $simplified->branch->branch_name }}
                                    @endif
                                </td>
                                <td>{{ $simplified->employee->name }}</td>
                                <td>{{ $simplified->tax_total }}</td>
                                <td>{{ $simplified->final_total }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->role_name == "مدير النظام" || empty(Auth::user()->branch_id))
    <div class="row row-sm">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-2">
                        احصائيات المبيعات والمرتجعات
                    </h3>
                    <p class="tx-12 mb-0 text-muted">
                        فى العداد التالى يوضح النسبة المئوية للمرتجعات بالنسبة للمبيعات
                    </p>
                </div>
                <?php
                $sales_count = $simplified_invoices->count() + $tax_invoices->count();
                $return_count = $simplified_return_invoices->count() + $tax_return_invoices->count();
                $total_count = $return_count + $sales_count;
                if ($total_count == 0) {
                    $ratio = 0;
                } else {
                    $ratio = ($return_count / $total_count) * 100;
                    $ratio = round($ratio, 2);
                }
                $sum_sales_final_total = 0;
                foreach ($simplified_invoices as $invoice) {
                    $sum_sales_final_total = round(($sum_sales_final_total + $invoice->final_total), 2);
                }
                foreach ($tax_invoices as $invoice) {
                    $sum_sales_final_total = round(($sum_sales_final_total + $invoice->final_total), 2);
                }

                $sum_return_final_total = 0;
                foreach ($simplified_return_invoices as $invoice) {
                    $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
                }
                foreach ($tax_return_invoices as $invoice) {
                    $sum_return_final_total = round(($sum_return_final_total + $invoice->final_total), 2);
                }
                $purchases_invoices = \App\Models\PurchaseInvoice::all();
                $sum_purchases_final_total = 0;
                foreach ($purchases_invoices as $invoice) {
                    $sum_purchases_final_total = round(($sum_purchases_final_total + $invoice->final_total), 2);
                }

                ?>
                <div class="card-body sales-info ot-0 pb-0 pt-0">
                    <div id="chart" class="ht-150" style="min-height: 150px;">
                        <div class="progress-pie-chart" data-percent="{{$ratio}}">
                            <div class="ppc-progress">
                                <div class="ppc-progress-fill"></div>
                            </div>
                            <div class="ppc-percents">
                                <div class="pcc-percents-wrapper">
                                    <span>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p mb-3">
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex">
                                <span class="legend bg-primary brround"></span>
                                عدد الفواتير المباعة
                            </p>
                            <h3 class="mb-1 text-center">
                                {{$sales_count}}
                                فواتير
                            </h3>
                        </div>
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex">
                                <span class="legend bg-info brround"></span>
                                عدد الفواتير المرتجعة
                            </p>
                            <h3 class="mb-1 text-center">
                                {{$return_count}}
                                فواتير
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center pb-2"><p class="mb-0">
                                    اجمالى المبيعات
                                </p></div>
                            <h4 class="fw-bold mb-2">
                                {{$sum_sales_final_total}}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-primary-gradient wd-90p" role="progressbar"
                                     aria-valuenow="90" aria-valuemin="0" aria-valuemax="90"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2"><p class="mb-0">
                                    اجمالى المرتجعات
                                </p></div>
                            <h4 class="fw-bold mb-2">
                                {{$sum_return_final_total}}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="25"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2"><p class="mb-0">
                                    اجمالى المشتريات
                                </p></div>
                            <h4 class="fw-bold mb-2">
                                {{$sum_purchases_final_total}}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-success w-50" role="progressbar" aria-valuenow="50"
                                     aria-valuemin="0" aria-valuemax="50"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12 text-right mb-4">
            <h2 class="mt-2">
                عدادات النظام
            </h2>
        </div>
        @can('اضافة مستخدم','عرض مستخدم')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.supervisors.index')}}">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">المستخدمين</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$supervisors->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-users fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة صلاحية','عرض صلاحية')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.roles.index')}}">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">صلاحيات المستخدمين</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$roles->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-lock fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('اضافة فرع','عرض فرع')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.branches.index')}}">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">الفروع</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$branches->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-users fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('اضافة صنف','عرض صنف')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.products.index')}}">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">الاصناف</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$products->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-users fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('اضافة موظف','عرض موظف')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.employees.index')}}">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">الموظفين</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$employees->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-users fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('اضافة فاتورة مبسطة','عرض فاتورة مبسطة')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.simplified.index')}}">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">الفواتير الضريبية المبسطة</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$simplified_invoices->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                <i class="fas fa-users fa-5x text-white"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة فاتورة ضريبية','عرض فاتورة ضريبية')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.tax.index')}}">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">الفواتير الضريبية للشركات</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$tax_invoices->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة فاتورة مشتريات','عرض فاتورة مشتريات')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.purchases.index')}}">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">فواتير المشتريات</h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$purchases_invoices->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة مرتجع فاتورة مبسطة','عرض مرتجع فاتورة مبسطة')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.simplified_return.index')}}">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">
                                    مرتجع الفواتير الضريبية المبسطة
                                </h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$simplified_return_invoices->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة مرتجع فاتورة ضريبية','عرض مرتجع فاتورة ضريبية')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.tax_return.index')}}">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">
                                    مرتجع الفواتير الضريبية للشركات
                                </h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$tax_return_invoices->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

        @can('اضافة مصروف ثابت','عرض مصروف ثابت')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.fixed.index')}}">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">
                                    المصروفات الثابتة
                                </h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$fixed_expenses->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('اضافة مصروف','عرض مصروف')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <a href="{{route('supervisor.expense.index')}}">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h3 class="mb-3 text-white">
                                    المصروفات
                                </h3>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h1 class="tx-50 font-weight-bold mb-1 text-white">{{$expenses->count()}}</h1>
                                    </div>
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-users fa-5x text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    @endcan


    <!-- Modal effects -->

        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Almarai'; ">
                            تفاصيل مبيعات اليوم لكل فرع على حدة
                        </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body details">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <hr>
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.get_details').on('click', function () {
            $.post("{{route('get.sales.details')}}", {
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('.details').html(data);
            });
        });
    });
</script>

@extends('supervisor.layouts.master')
<style>
    span.float-right > i.fa {
        font-size: 40px !important;
    }

    h3 {
        font-size: 15px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success  fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-lg-12 margin-tb">
                        <h5 class="text-center alert alert-md alert-outline-success">
                            تقارير النظام
                        </h5>
                    </div>
                </div>
                <div class="card-body p-1 m-1">
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-danger">
                                            تقارير الفواتير الضريبية المبسطة
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report1.get') }}">
                                                تقرير شامل المبيعات
                                            </a>
                                        </li>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report2.get') }}">
                                                تقرير لمبيعات العيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report3.get') }}">
                                                تقرير لمبيعات الموظف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report4.get') }}">
                                                تقرير لمبيعات الموظف والعيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report5.get') }}">
                                                تقرير لمبيعات الصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report6.get') }}">
                                                تقرير لمبيعات الموظف والصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report7.get') }}">
                                                تقرير لمبيعات سعر الجرام
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplified.report8.get') }}">
                                                تقرير لمبيعات الموظف و سعر الجرام
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-info">
                                            تقارير الفواتير الضريبية للشركات
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('tax.report1.get') }}">
                                                تقرير شامل المبيعات
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-info">
                                            تقارير المصروفات
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('expenses.report.get') }}">
                                                تقرير المصروفات
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-success">
                                            تقارير مرتجعات الفواتير الضريبية المبسطة
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report1.get') }}">
                                                تقرير شامل المرتجعات
                                            </a>
                                        </li>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report2.get') }}">
                                                تقرير لمرتجعات العيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report3.get') }}">
                                                تقرير لمرتجعات الموظف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report4.get') }}">
                                                تقرير لمرتجعات الموظف والعيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report5.get') }}">
                                                تقرير لمرتجعات الصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report6.get') }}">
                                                تقرير لمرتجعات الموظف والصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report7.get') }}">
                                                تقرير لمرتجعات سعر الجرام
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('simplifiedreturn.report8.get') }}">
                                                تقرير لمرتجعات الموظف و سعر الجرام
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-danger">
                                            تقارير مرتجعات الفواتير الضريبية للشركات
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report1.get') }}">
                                                تقرير شامل المرتجعات
                                            </a>
                                        </li>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report2.get') }}">
                                                تقرير لمرتجعات العيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report3.get') }}">
                                                تقرير لمرتجعات الموظف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report4.get') }}">
                                                تقرير لمرتجعات الموظف والعيار
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report5.get') }}">
                                                تقرير لمرتجعات الصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report6.get') }}">
                                                تقرير لمرتجعات الموظف والصنف
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report7.get') }}">
                                                تقرير لمرتجعات سعر الجرام
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('taxreturn.report8.get') }}">
                                                تقرير لمرتجعات الموظف و سعر الجرام
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="col-lg-12 margin-tb">
                                        <h5 class="text-center alert alert-md alert-outline-info">
                                            تقارير الاقرار الضريبى
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body p-1 m-1">
                                    <ul>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report1.get') }}">
                                                المبيعات الخاضعه للضريبة الاساسية
                                            </a>
                                        </li>
                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report2.get') }}">
                                                المرتجعات الخاضعه للضريبة الاساسية
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report3.get') }}">
                                                المبيعات الصفرية
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report4.get') }}">
                                                المرتجعات الصفرية
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report5.get') }}">
                                                مجموع المشتريات
                                            </a>
                                        </li>

                                        <li>
                                            <a class="sub-side-menu__item" href="{{ route('declaration.report6.get') }}">
                                                تقرير الضريبة لكل فرع
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>

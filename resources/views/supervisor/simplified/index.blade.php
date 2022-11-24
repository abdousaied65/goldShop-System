@extends('supervisor.layouts.master')
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .btn-md {
        height: 40px !important;
        min-width: 100px !important;
        padding: 10px !important;
        text-align: center !important;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
    }

    span.badge {
        padding: 10px !important;
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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-md alert-success">
                            عرض كل الفواتير الضريبية المبسطة
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">

                    <form method="POST" action="{{route('export.simplified.excel')}}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-md btn-success m-1">
                            <i class="fa fa-file-excel-o"></i>
                            تصدير الكل EXCEL
                        </button>
                    </form>

                    <a href="{{route('supervisor.simplified.create')}}" role="button" class="btn btn-md btn-info m-1">
                        <i class="fa fa-plus"></i>
                        اضافة
                    </a>
                </div>
                <div class="card-body p-1 m-1">
                    <div class="table-responsive hoverable-table">
                        <table class="display w-100  text-nowrap table-bordered" id="example-table"
                               style="text-align: center;">
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
                                <th style="width: 5%!important;" class="border-bottom-0 text-center">
                                    طباعة الفاتورة
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $simplified)
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
                                    <td>{{ $simplified->supervisor->name }}</td>
                                    <td>{{ $simplified->tax_total }}</td>
                                    <td>{{ $simplified->final_total }}</td>
                                    <td>
                                        @can('عرض فاتورة')
                                            <a href="{{ route('supervisor.simplified.print', $simplified->id) }}"
                                               class="btn btn-sm p-2 m-1 tx-13 btn-info">
                                                <i class="fa fa-print"></i>
                                                طباعة
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
        $('#example-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [ 7]}
            ],
            "order": [[1, "desc"]],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('input[type="text"]', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                    $('select', this.footer()).on('change', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
    });
</script>

@extends('site.layouts.master')
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .btn-md {
        height: 40px !important;
        min-width: 100px !important;
        border-radius: 0 !important;
        /*padding: 10px !important;*/
        text-align: center !important;
    }

    .form-control {
        border-radius: 0 !important;
        height: 40px !important;
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
                        <h5 class="text-center alert alert-md alert-success w-100">
                            <a href="{{route('simplified.index')}}" class="text-dark">
                                عرض كل الفواتير الضريبية المبسطة
                            </a>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                    <form method="POST" action="{{route('export.simplified')}}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-md btn-success m-1">
                            <i class="fa fa-file-excel-o"></i>
                            تصدير الكل EXCEL
                        </button>
                    </form>

                    <a href="{{route('simplified.create')}}" role="button" class="btn btn-md btn-info m-1">
                        <i class="fa fa-plus"></i>
                        اضافة
                    </a>
                </div>
                <div class="col-lg-12 mt-1 mb-1 p-1" style="border: 1px solid #bbb;">
                    <form method="POST" action="{{route('simplified.search')}}">
                        @csrf
                        @method('POST')
                        <div class="row p-2">
                            <div class="form-group col-lg-3 pull-right">
                                <label for="" class="d-block">
                                    اختر الفرع
                                </label>
                                @if(empty(Auth::user()->branch_id))
                                    <select
                                        class="js-example-basic-single w-100" name="branch_id" id="branch_id">
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input class="form-control" type="text" readonly
                                           value="{{Auth::user()->branch->branch_name}}"/>
                                    <input class="form-control" type="hidden" readonly name="branch_id" id="branch_id"
                                           value="{{Auth::user()->branch_id}}"/>
                                @endif

                            </div>
                            <div class="form-group col-lg-3 pull-right">
                                <label for="" class="d-block">
                                    من تاريخ
                                </label>
                                <input type="date"
                                       @if(isset($from_date) && !empty($from_date))
                                       value={{$from_date}}
                                       @else
                                           value="{{date('Y-m-d')}}"
                                       @endif
                                       name="from_date" class="form-control"/>
                            </div>
                            <div class="form-group col-lg-3 pull-right">
                                <label for="" class="d-block">
                                    الى تاريخ
                                </label>
                                <input type="date"
                                       @if(isset($to_date) && !empty($to_date))
                                       value={{$to_date}}
                                       @else
                                           value="{{date('Y-m-d')}}"
                                       @endif
                                       name="to_date" class="form-control"/>
                            </div>
                            <div class="form-group col-lg-3 pull-right">
                                <button type="submit" class="btn btn-md btn-info w-100" style="margin-top: 27px;">
                                    <i class="fa fa-search"></i>
                                    بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-1 m-1">
                    <div class="table-responsive hoverable-table">
                        <table
                            class="table table-condensed table-striped text-nowrap table-hover display w-100 table-bordered"
                            id="example-table"
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
                                    تحكم
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
                                    <td>{{ $simplified->employee->name }}</td>
                                    <td>{{ $simplified->tax_total }}</td>
                                    <td>{{ $simplified->final_total }}</td>
                                    <td>
                                        <a target="_blank"
                                           href="{{ route('simplified.print', $simplified->id) }}"
                                           class="btn btn-sm p-2 m-1 tx-13 btn-info">
                                            <i class="fa fa-print"></i>
                                            طباعة
                                        </a>

                                        <a href="{{ route('simplified.edit', $simplified->id) }}"
                                           class="btn btn-sm p-2 m-1 tx-13 btn-success">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
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
        $('#example-table tfoot tr th:nth-child(1)').html('<input class="form-control" type="number" placeholder="رقم الفاتورة" />');
        $('#example-table tfoot tr th:nth-child(2)').html('<input class="form-control" value="{{date('Y-m-d')}}" type="date" placeholder="تاريخ" />');
        $('#example-table tfoot tr th:nth-child(3)').html('<input class="form-control" type="text" placeholder="طريقة الدفع" />');
        $('#example-table tfoot tr th:nth-child(4)').html('<input class="form-control" type="text" placeholder="الفرع" />');
        $('#example-table tfoot tr th:nth-child(5)').html('<input class="form-control" type="text" placeholder="الموظف" />');
        $('#example-table tfoot tr th:nth-child(6)').html('<input class="form-control" type="text" placeholder="الضريبة" />');
        $('#example-table tfoot tr th:nth-child(7)').html('<input class="form-control" type="text" placeholder="الاجمالى" />');
        $('#example-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [7]}
            ],
            "order": [[0, "desc"]],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('input[type="text"],input[type="date"],input[type="number"]', this.footer()).on('keyup change clear', function () {
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

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
                            عرض كل فواتير المشتريات
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                    <form method="GET" action="{{route('print.selected.purchases')}}">
                        <button type="submit" class="btn btn-md btn-warning m-1 print_selected">
                            <i class="fa fa-print"></i>
                            طباعة
                        </button>
                    </form>
                    <form method="POST" action="{{route('export.purchases.excel')}}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-md btn-success m-1">
                            <i class="fa fa-file-excel-o"></i>
                            تصدير الكل EXCEL
                        </button>
                    </form>
                    <a href="{{route('supervisor.purchases.create')}}" role="button" class="btn btn-md btn-info m-1">
                        <i class="fa fa-plus"></i>
                        اضافة
                    </a>
                </div>
                <div class="card-body p-1 m-1">
                    <table
                        class="table table-condensed table-striped table-hover display w-100 table-bordered"
                        id="example-table"
                        style="text-align: center;">
                        <thead>
                        <tr>
                            <th class="border-bottom-0 text-center">رقم الفاتورة</th>
                            <th class="border-bottom-0 text-center">التاريخ</th>
                            <th class="border-bottom-0 text-center">اسم الفرع</th>
                            <th class="border-bottom-0 text-center">الموظف</th>
                            <th class="border-bottom-0 text-center"> اجمالى الضريبة</th>
                            <th class="border-bottom-0 text-center"> اجمالى الفاتورة</th>
                            <th class="border-bottom-0 text-center"> صورة الفاتورة</th>
                            <th class="border-bottom-0 text-center"> تعديل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $purchase)
                            <tr>
                                <td>{{ $purchase->invoice_number }}</td>
                                <td>{{ $purchase->date}}</td>
                                <td>
                                    @if(empty($purchase->branch_id))
                                        كل الفروع
                                    @else
                                        {{ $purchase->branch->branch_name }}
                                    @endif
                                </td>
                                <td>{{ $purchase->supervisor->name }}</td>
                                <td>{{ $purchase->tax_total }}</td>
                                <td>{{ $purchase->final_total }}</td>
                                <td>
                                    <img data-toggle="modal" href="#modaldemo9"
                                         src="{{asset($purchase->attachment)}}"
                                         style="width: 50px!important;cursor: pointer; height: 50px!important;
                                         border-radius: 100%; padding: 1px; border: 1px solid #aaa;">
                                </td>
                                <td>
                                    @can('تعديل فاتورة مشتريات')
                                        <a href="{{ route('supervisor.purchases.edit', $purchase->id) }}"
                                           class="btn btn-sm p-2 m-1 tx-13 btn-info">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    @endcan
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
        <!--/div-->
    </div>
    <!-- Modal effects -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100"
                        style="font-family: 'Almarai'; ">عرض صورة فاتورة المشتريات</h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img id="image_larger" alt="image" style="width: 100%;height: auto!important;  "/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-md btn-danger"><i class="fa fa-colse"></i> اغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });
        $('#example-table tfoot tr th:nth-child(1)').html('<input class="form-control" type="text" placeholder="رقم الفاتورة" />');
        $('#example-table tfoot tr th:nth-child(2)').html('<input class="form-control" type="date" placeholder="التاريخ" />');
        $('#example-table tfoot tr th:nth-child(3)').html('<input class="form-control" type="text" placeholder="الفرع" />');
        $('#example-table tfoot tr th:nth-child(4)').html('<input class="form-control" type="text" placeholder="الموظف" />');
        $('#example-table tfoot tr th:nth-child(5)').html('<input class="form-control" type="text" placeholder="اجمالى الضريبة" />');
        $('#example-table tfoot tr th:nth-child(6)').html('<input class="form-control" type="text" placeholder="اجمالى الفاتورة" />');

        $('#example-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [6,7]}
            ],
            "order": [[0, "desc"]],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;
                    $('input[type="text"],input[type="number"],input[type="date"]', this.footer()).on('keyup change clear', function () {
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

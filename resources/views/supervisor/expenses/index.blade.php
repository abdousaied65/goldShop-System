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
                            عرض كل المصروفات
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                    <form method="GET" action="{{route('print.selected.expense')}}">
                        <button type="submit" class="btn btn-md btn-warning m-1 print_selected">
                            <i class="fa fa-print"></i>
                            طباعة
                        </button>
                    </form>
                    <form method="POST" action="{{route('export.expense.excel')}}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-md btn-success m-1">
                            <i class="fa fa-file-excel-o"></i>
                            تصدير الكل EXCEL
                        </button>
                    </form>

                    <form method="POST" class="" id="myForm" action="{{route('remove.selected.expense')}}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-md btn-danger m-1 remove_selected">
                            <i class="fa fa-trash"></i>
                            حذف
                        </button>
                    </form>

                    <a href="{{route('supervisor.expense.create')}}" role="button" class="btn btn-md btn-info m-1">
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
                                    <input type="checkbox" id="check_all"/>
                                </th>
                                <th class="border-bottom-0 text-center">#</th>
                                <th class="border-bottom-0 text-center"> الفرع</th>
                                <th class="border-bottom-0 text-center">المصروف الثابت</th>
                                <th class="border-bottom-0 text-center">بيان المصروف</th>
                                <th class="border-bottom-0 text-center">الرقم التسلسلى</th>
                                <th class="border-bottom-0 text-center">التاريخ</th>
                                <th class="border-bottom-0 text-center">المبلغ</th>
                                <th class="border-bottom-0 text-center">ملاحظات</th>
                                <th class="border-bottom-0 text-center">صورة المصروف</th>
                                <th style="width: 5%!important;" class="border-bottom-0 text-center">تحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp

                            @foreach ($data as $key => $expense)
                                <tr>
                                    <td>
                                        <input class="check" name="expenses[]" form="myForm"
                                               value="{{$expense->id}}"
                                               type="checkbox">
                                    </td>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $expense->branch->branch_name }} </td>
                                    <td>{{ $expense->fixed->fixed_expense }} </td>
                                    <td>{{ $expense->expense_details }} </td>
                                    <td>{{ $expense->unified_serial_number }} </td>
                                    <td>{{ $expense->date }} </td>
                                    <td>{{ $expense->amount }} </td>
                                    <td>{{ $expense->notes }} </td>
                                    <td>
                                        <img data-toggle="modal" href="#modaldemo9"
                                             src="{{asset($expense->expense_pic)}}"
                                             style="width: 50px!important;cursor: pointer; height: 50px!important;
                                         border-radius: 100%; padding: 1px; border: 1px solid #aaa;">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-wrench"></i>
                                                ادارة
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('عرض مصروف')
                                                    <a href="{{ route('supervisor.expense.show', $expense->id) }}"
                                                       class="dropdown-item">
                                                        <i class="fa fa-eye"></i>
                                                        عرض
                                                    </a>
                                                @endcan
                                                @can('تعديل مصروف')
                                                    <a href="{{ route('supervisor.expense.edit', $expense->id) }}"
                                                       class="dropdown-item">
                                                        <i class="fa fa-edit"></i>
                                                        تعديل
                                                    </a>
                                                @endcan
                                                @can('حذف مصروف')
                                                    <a class="dropdown-item delete_expense"
                                                       expense_id="{{ $expense->id }}"
                                                       expense_name="{{ $expense->expense_details }}" data-toggle="modal"
                                                       href="#modaldemo8">
                                                        <i class="fa fa-trash"></i>
                                                        حذف
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
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

        <!-- Modal effects -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100"
                            style="font-family: 'Almarai'; ">عرض صورة المصروف</h6>
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

        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Almarai'; ">حذف مصروف</h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('supervisor.expense.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متأكد انك تريد الحذف ؟</p><br>
                            <input type="hidden" name="expense_id" id="expense_id" value="">
                            <input class="form-control" name="expense_name" id="expense_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#check_all').click(function () {
            if (this.checked) {
                $('input.check').prop('checked', true);
            } else {
                $('input.check').prop('checked', false);
            }
        });
        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });
        $('.delete_expense').on('click', function () {
            var expense_id = $(this).attr('expense_id');
            var expense_name = $(this).attr('expense_name');
            $('.modal-body #expense_id').val(expense_id);
            $('.modal-body #expense_name').val(expense_name);
        });
        $('.remove_selected').on('click', function (e) {
            e.preventDefault();
            let expenses = [];
            $("input:checkbox[name*='expenses']:checked").each(function () {
                expenses.push($(this).val());
            });
            if (expenses.length == 0) {
                alert('اختر بعض السجلات للحذف');
            } else {
                $('#myForm').submit();
            }
        });
        $('#example-table tfoot tr th:nth-child(3)').html('<input class="form-control" type="text" placeholder="الفرع" />');
        $('#example-table tfoot tr th:nth-child(4)').html('<input class="form-control" type="text" placeholder="المصروف الثابت" />');
        $('#example-table tfoot tr th:nth-child(5)').html('<input class="form-control" type="text" placeholder="بيان المصروف" />');
        $('#example-table tfoot tr th:nth-child(6)').html('<input class="form-control" type="number" placeholder="الرقم التسلسلى" />');
        $('#example-table tfoot tr th:nth-child(7)').html('<input class="form-control" type="date" placeholder="التاريخ" />');
        $('#example-table tfoot tr th:nth-child(8)').html('<input class="form-control" type="number" placeholder="المبلغ" />');
        $('#example-table tfoot tr th:nth-child(9)').html('<input class="form-control" type="text" placeholder="ملاحظات" />');
        $('#example-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": [0, 9,10]}
            ],
            "order": [[1, "desc"]],
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

@extends('site.layouts.master')
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    /*.btn-md {*/
    /*    height: 40px !important;*/
    /*    min-width: 100px !important;*/
    /*    border-radius: 0 !important;*/
    /*    !*padding: 10px !important;*!*/
    /*    text-align: center !important;*/
    /*}*/

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
                            <a href="{{route('simplified_return.index')}}" class="text-dark">
                                عرض كل مرتجعات الفواتير الضريبية المبسطة
                            </a>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row mt-1 mb-1 text-center justify-content-center align-content-center">
                    <a href="{{route('simplified_return.create')}}" role="button" class="btn btn-md btn-info m-1">
                        <i class="fa fa-plus"></i>
                        اضافة
                    </a>
                </div>

                <div class="card-body p-1 m-1">
                    <div class="table-responsive hoverable-table">
                        <table
                            class="table table-condensed table-striped table-hover text-nowrap display w-100 table-bordered"
                            id="example-table"
                            style="text-align: center;">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    رقم فاتورة المرتجع
                                </th>
                                <th class="border-bottom-0 text-center">
                                    رقم فاتورة المبسطة
                                </th>
                                <th class="border-bottom-0 text-center">
                                    تاريخ - وقت
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الفرع
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الموظف
                                </th>
                                <th class="border-bottom-0 text-center">
                                    ملاحظات
                                </th>

                                <th class="border-bottom-0 text-center">
                                    تحكم
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $return)
                                <tr>
                                    <td>{{ $return->unified_serial_number }}</td>
                                    <td>
                                        <a target="_blank" href="{{route('simplified.print',$return->simplified->id)}}">
                                            {{ $return->simplified->unified_serial_number }}
                                        </a>
                                    </td>
                                    <td>{{ $return->date}} - {{ $return->time}} </td>
                                    <td>
                                        @if(empty($return->branch_id))
                                            كل الفروع
                                        @else
                                            {{ $return->branch->branch_name }}
                                        @endif
                                    </td>
                                    <td>{{ $return->employee->name }}</td>
                                    <td>{{ $return->notes }}</td>
                                    <td>
                                        <a href="{{ route('simplified_return.edit', $return->id) }}"
                                           class="btn btn-md btn-info">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                        <a class="btn btn-md btn-danger mr-3 delete_return"
                                           return_id="{{ $return->id }}"
                                           unified_serial_number=" فاتورة مرتجع رقم  {{ $return->unified_serial_number }}" data-toggle="modal"
                                           href="#modaldemo8">
                                            <i class="fa fa-trash"></i>
                                            حذف
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
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Almarai'; ">حذف فاتورة مرتجع</h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('simplified_return.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متأكد انك تريد الحذف ؟</p><br>
                            <input type="hidden" name="return_id" id="return_id" value="">
                            <input class="form-control" name="unified_serial_number" id="unified_serial_number" type="text" readonly>
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

        $('.delete_return').on('click', function () {
            var return_id = $(this).attr('return_id');
            var unified_serial_number = $(this).attr('unified_serial_number');
            $('.modal-body #return_id').val(return_id);
            $('.modal-body #unified_serial_number').val(unified_serial_number);
        });


        $('#example-table tfoot tr th:nth-child(1)').html('<input class="form-control" type="number" placeholder="رقم فاتورة المرتجع" />');
        $('#example-table tfoot tr th:nth-child(2)').html('<input class="form-control" type="number" placeholder="رقم الفاتورة المبسطة" />');
        $('#example-table tfoot tr th:nth-child(3)').html('<input class="form-control" value="{{date('Y-m-d')}}" type="date" placeholder="تاريخ" />');
        $('#example-table tfoot tr th:nth-child(4)').html('<input class="form-control" type="text" placeholder="الفرع" />');
        $('#example-table tfoot tr th:nth-child(5)').html('<input class="form-control" type="text" placeholder="الموظف" />');
        $('#example-table tfoot tr th:nth-child(6)').html('<input class="form-control" type="text" placeholder="ملاحظات" />');
        $('#example-table').DataTable({
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

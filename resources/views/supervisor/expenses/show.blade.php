@extends('supervisor.layouts.master')
<!-- Internal Data table css -->
<style>
    i.la {
        font-size: 15px !important;
    }

    span.badge {
        padding: 10px !important;
    }

</style>
@section('content')
    <div class="row text-center">
        <div class="col-lg-12 mt-5">
            <p class="alert alert-info alert-md text-center"> عرض بيانات المصروف </p>
        </div>
        <div class="table-responsive hoverable-table">
            <table class="table table-striped table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center"> الفرع</th>
                    <th class="border-bottom-0 text-center">المصروف الثابت</th>
                    <th class="border-bottom-0 text-center">بيان المصروف</th>
                    <th class="border-bottom-0 text-center">الرقم التسلسلى</th>
                    <th class="border-bottom-0 text-center">التاريخ</th>
                    <th class="border-bottom-0 text-center">المبلغ</th>
                    <th class="border-bottom-0 text-center">ملاحظات</th>
                    <th class="border-bottom-0 text-center">صورة المصروف</th>
                </tr>
                </thead>
                <tbody>
                <tr>
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
                </tr>
                </tbody>
            </table>
        </div>
    </div>
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
@endsection

<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });

    });
</script>


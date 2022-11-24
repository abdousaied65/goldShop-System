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
            <p class="alert alert-info alert-md text-center"> عرض بيانات الصنف </p>
        </div>
        <div class="table-responsive hoverable-table">
            <table class="table table-striped table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">اسم الصنف</th>
                    <th class="border-bottom-0 text-center"> ضريبة القيمة المضافة </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $product->product_name}}</td>
                    <td>{{ $product->tax }} % </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

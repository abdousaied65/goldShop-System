@extends('supervisor.layouts.master')
<style>
</style>
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>الاخطاء :</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-md alert-success">
                            تعديل بيانات الفرع
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($branch, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['supervisor.branches.update', $branch->id]]) !!}
                    <div class="row m-t-3 mb-3">
                        <div class="col-md-4">
                            <label> اسم الفرع <span class="text-danger">*</span></label>
                            <input value="{{$branch->branch_name}}" class="form-control mg-b-20" name="branch_name" required="" type="text">
                        </div>
                        <div class="col-md-4">
                            <label> رقم جوال الفرع <span class="text-danger">*</span></label>
                            <input value="{{$branch->branch_phone}}" class="form-control mg-b-20" dir="ltr" min="1" name="branch_phone" required="" type="number">
                        </div>
                        <div class="col-md-4">
                            <label> عنوان الفرع <span class="text-danger">*</span></label>
                            <input value="{{$branch->branch_address}}" class="form-control mg-b-20" dir="rtl" name="branch_address" required="" type="text">
                        </div>
                    </div>
                    <div class="row m-t-3 mb-3">
                        <div class="col-md-4">
                            <label> سجل تجارى <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$branch->commercial_record}}" min="1" name="commercial_record" dir="ltr" required="" type="number">
                        </div>

                        <div class="col-md-4">
                            <label> رقم ترخيص <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$branch->license_number}}" dir="ltr" name="license_number" required="" type="text">
                        </div>

                        <div class="col-md-4">
                            <label> snap <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$branch->snap}}" dir="ltr" name="snap" required="" type="text">
                        </div>

                    </div>

                    <div class="col-lg-12 text-center mt-3 mb-3 text-center">
                        <button class="btn btn-info btn-md" type="submit"> تحديث</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->

    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection

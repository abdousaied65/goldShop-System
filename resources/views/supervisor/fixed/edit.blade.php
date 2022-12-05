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
                            تعديل بيانات المصروف الثابت
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($fixed, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['supervisor.fixed.update', $fixed->id]]) !!}
                    <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}" />
                    <div class="row m-t-3 mb-3">
                        <div class="col-md-6">
                            <label> بيان المصروف الثابت <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$fixed->fixed_expense}}" name="fixed_expense" required=""
                                   type="text">
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

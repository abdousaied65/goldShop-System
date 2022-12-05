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
                            تعديل بيانات موظف الفرع
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($employee, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['supervisor.employees.update', $employee->id]]) !!}
                    <div class="row m-t-3 mb-3">
                        <div class="col-md-4">
                            <label> اسم الموظف <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$employee->name}}" name="name" required=""
                                   type="text">
                        </div>
                        <div class="col-md-4">
                            <label> اسم الفرع <span class="text-danger">*</span></label>
                            <?php
                            $branches = \App\Models\Branch::all();
                            ?>
                            @if(empty(Auth::user()->branch_id))
                                <select
                                    class="js-example-basic-single w-100" name="branch_id" id="branch_id">
                                    <option value=""></option>
                                    @foreach($branches as $branch)
                                        <option
                                            @if($branch->id == $employee->branch_id)
                                                selected
                                            @endif
                                            value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input class="form-control" type="hidden" id="branch_id" name="branch_id"
                                       value="{{Auth::user()->branch_id}}"/>
                                <input class="form-control" type="text" readonly
                                       value="{{Auth::user()->branch->branch_name}}"/>
                            @endif
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

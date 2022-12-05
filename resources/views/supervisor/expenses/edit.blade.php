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
                            تعديل بيانات المصروف
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($expense, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['supervisor.expense.update', $expense->id]]) !!}
                    <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}"/>
                    <input type="hidden" name="unified_serial_number" value="{{$expense->unified_serial_number}}">
                    <div class="row m-t-3 mb-3">
                        <div class="col-md-3">
                            <label> المصروف الثابت <span class="text-danger">*</span></label>
                            <select
                                class="js-example-basic-single w-100" name="fixed_id" id="fixed_id">
                                <option value=""></option>
                                @foreach($fixed as $item)
                                    <option
                                        @if($item->id == $expense->fixed_id)
                                        selected
                                        @endif
                                        value="{{$item->id}}">{{$item->fixed_expense}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label> بيان المصروف <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" name="expense_details" value="{{$expense->expense_details}}" required="" type="text">
                        </div>
                        <div class="col-md-3">
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
                                            @if($branch->id == $expense->branch_id)
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
                        <div class="col-md-3">
                            <label> التاريخ <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" value="{{$expense->date}}" name="date" required=""
                                   type="date">
                        </div>
                    </div>
                    <div class="row m-t-3 mb-3">

                        <div class="col-md-4">
                            <label> المبلغ <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" min="1"  value="{{$expense->amount}}" name="amount" dir="ltr" required=""
                                   type="number">
                        </div>

                        <div class="col-md-4">
                            <label> ملاحظات <span class="text-danger">*</span></label>
                            <input class="form-control mg-b-20" name="notes" value="{{$expense->notes}}" required="" type="text">
                        </div>
                        <div class="col-lg-4">
                            <label for=""> ارفاق صورة </label>
                            <input accept="image/*" type="file"
                                   oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                   name="expense_pic" class="form-control">
                            <label for="" class="d-block"> معاينة الصورة </label>
                            <img id="pic" src="{{asset($expense->expense_pic)}}"
                                 style="width: 100px; height:100px;"/>
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

@extends('supervisor.layouts.master')
<style>

</style>
@section('content')
    <!-- main-content closed -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="alert alert-md alert-success">
                        اضافة مصروف جديد
                    </h5>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('supervisor.expense.store')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}"/>
                        <input type="hidden" name="unified_serial_number" value="{{$unified_serial_number}}">
                        <div class="row m-t-3 mb-3">
                            <div class="col-md-3">
                                <label> المصروف الثابت <span class="text-danger">*</span></label>
                                <select
                                    class="js-example-basic-single w-100" name="fixed_id" id="fixed_id">
                                    <option value=""></option>
                                    @foreach($fixed as $item)
                                        <option value="{{$item->id}}">{{$item->fixed_expense}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label> بيان المصروف <span class="text-danger">*</span></label>
                                <input class="form-control mg-b-20" name="expense_details" required="" type="text">
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
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
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
                                <input class="form-control mg-b-20" value="{{date('Y-m-d')}}" name="date" required="" type="date">
                            </div>
                        </div>
                        <div class="row m-t-3 mb-3">

                            <div class="col-md-4">
                                <label> المبلغ <span class="text-danger">*</span></label>
                                <input class="form-control mg-b-20" min="1" name="amount" dir="ltr" required="" type="number">
                            </div>

                            <div class="col-md-4">
                                <label> ملاحظات <span class="text-danger">*</span></label>
                                <input class="form-control mg-b-20" name="notes" required="" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for=""> ارفاق صورة </label>
                                <input accept="image/*" type="file"
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                       name="expense_pic" class="form-control">
                                <label for="" class="d-block"> معاينة الصورة </label>
                                <img id="pic" src=""
                                     style="width: 100px; height:100px;"/>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                اضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection

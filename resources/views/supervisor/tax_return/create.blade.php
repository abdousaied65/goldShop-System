@extends('supervisor.layouts.master')
<style>
    tbody tr td, tfoot tr th {
        padding: 10px !important;
    }

    select option {
        font-size: 15px !important;
    }
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <h5 class="alert alert-md alert-success text-center">
                        اضافة مرتجع فاتورة ضريبية للشركات
                        <div style="color:orangered;margin-top: 10px;">
                            رقم فاتورة المرتجع
                            [
                            {{$unified_serial_number}}
                            ]
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{route('supervisor.tax_return.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}"/>
                        <input type="hidden" name="unified_serial_number" value="{{$unified_serial_number}}">
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اختر رقم الفاتورة الضريبية للشركات
                                    </label>
                                    <select required class="js-example-basic-single w-100" name="tax_id"
                                            id="tax_id">
                                        <option value="">
                                            اختر
                                        </option>
                                        @if(isset($tax_invoices) && !$tax_invoices->isEmpty())
                                            @foreach($tax_invoices as $tax_invoice)
                                                <option value="{{$tax_invoice->id}}">
                                                    {{$tax_invoice->unified_serial_number}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        التاريخ
                                    </label>
                                    <input class="form-control" type="date" name="date"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->date}}" readonly
                                           @else
                                           value="{{date('Y-m-d')}}"
                                        @endif
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الوقت
                                    </label>
                                    <input class="form-control" type="time" name="time"
                                           @if(isset($open_invoice) && !empty($open_invoice))
                                           value="{{$open_invoice->time}}" readonly
                                           @else
                                           value="{{date('H:i:s')}}"
                                        @endif

                                    />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اسم الفرع
                                    </label>
                                    @if(empty(Auth::user()->branch_id))
                                        <select required class="js-example-basic-single w-100" name="branch_id" id="branch_id">
                                            <option value=""></option>
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="form-control" type="text" readonly
                                               value="{{Auth::user()->branch->branch_name}}"/>
                                        <input required class="form-control" type="hidden" id="branch_id"
                                               name="branch_id"
                                               value="{{Auth::user()->branch_id}}"/>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الموظف
                                    </label>
                                    @if(empty(Auth::user()->branch_id))
                                        <select required class="js-example-basic-single w-100" name="employee_id"
                                                id="employee_id">
                                            <option value=""></option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <?php
                                        $branch = \App\Models\Branch::FindOrFail(Auth::user()->branch_id);
                                        $branch_employees = $branch->employees;
                                        ?>
                                        <select required class="js-example-basic-single w-100" name="employee_id"
                                                id="employee_id">
                                            <option value=""></option>
                                            @foreach($branch_employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        ملاحظات
                                    </label>
                                    <input class="form-control" type="text" name="notes"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr/>

                        <div class="details">

                        </div>

                        <hr/>
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-12">
                                <button id="add" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus"></i>
                                    حفظ فاتورة المرتجع
                                </button>
                            </div>
                        </div>
                        <hr/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#tax_id').on('change',function () {
                let tax_id = $(this).val();
                $.post("{{route('get.tax.details')}}", {
                    tax_id: tax_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('.details').html(data);
                });
            });

            $('#branch_id').on('change', function () {
                let branch_id = $(this).val();
                $.post("{{route('get.branch.employees')}}", {
                    branch_id: branch_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#employee_id').html(data).trigger('change');
                });
            });
        });
    </script>
@endsection

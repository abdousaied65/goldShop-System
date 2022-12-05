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
                    <h5 class="text-center alert alert-md alert-danger">
                        اضافة فاتورة مشتريات جديدة
                    </h5>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('supervisor.purchases.store')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}"/>
                        <div class="row m-t-3 mb-3">
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        رقم فاتورة المشتريات
                                    </label>
                                    <input class="form-control" dir="ltr" type="text" required name="invoice_number"/>
                                </div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        التاريخ
                                    </label>
                                    <input class="form-control" type="date" required name="date"
                                           value="{{date('Y-m-d')}}"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اسم الفرع
                                    </label>
                                    @if(empty(Auth::user()->branch_id))
                                        <select required
                                                @if(isset($open_invoice) && !empty($open_invoice))
                                                disabled
                                                @endif
                                                class="js-example-basic-single w-100" name="branch_id" id="branch_id">
                                            <option value=""></option>
                                            @foreach($branches as $branch)
                                                <option
                                                    @if(isset($open_invoice) && !empty($open_invoice) && $branch->id == $open_invoice->branch_id)
                                                    selected
                                                    @endif
                                                    value="{{$branch->id}}">{{$branch->branch_name}}</option>
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
                            <div class="col-lg-3 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الموظف
                                    </label>
                                    @if(empty(Auth::user()->branch_id))
                                        <select required
                                                @if(isset($open_invoice) && !empty($open_invoice))
                                                disabled
                                                @endif
                                                class="js-example-basic-single w-100" name="employee_id"
                                                id="employee_id">
                                            <option value=""></option>
                                            @foreach($employees as $employee)
                                                <option
                                                    @if(isset($open_invoice) && !empty($open_invoice) && $employee->id == $open_invoice->employee_id)
                                                    selected
                                                    @endif
                                                    value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <?php
                                        $branch = \App\Models\Branch::FindOrFail(Auth::user()->branch_id);
                                        $branch_employees = $branch->employees;
                                        ?>
                                        <select required
                                                @if(isset($open_invoice) && !empty($open_invoice))
                                                disabled
                                                @endif
                                                class="js-example-basic-single w-100" name="employee_id"
                                                id="employee_id">
                                            <option value=""></option>
                                            @foreach($branch_employees as $employee)
                                                <option
                                                    @if(isset($open_invoice) && !empty($open_invoice) && $employee->id == $open_invoice->employee_id)
                                                    selected
                                                    @endif
                                                    value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row m-t-3 mb-3">
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اجمالى الضريبة
                                    </label>
                                    <input class="form-control" type="text" dir="ltr" required name="tax_total"/>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اجمالى الفاتورة
                                    </label>
                                    <input class="form-control" type="text" dir="ltr" required name="final_total"/>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for=""> إرفاق صورة فاتورة المشتريات </label>
                                <input accept="image/*" type="file"
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                       required name="attachment" class="form-control">
                                <label for="" class="d-block"> معاينة الصورة </label>
                                <img id="pic" src=""
                                     style="width: 100%; height:auto;"/>
                            </div>
                            <div class="clearfix"></div>
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
@endsection
<script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
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

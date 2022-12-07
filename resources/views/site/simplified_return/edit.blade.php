@extends('site.layouts.master')
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
                    <h5 class="alert alert-md alert-primary text-center">
                        تعديل مرتجع فاتورة ضريبية مبسطة
                        <div style="color:orangered;margin-top: 10px;">
                            رقم فاتورة المرتجع
                            [
                            {{$return->unified_serial_number}}
                            ]
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{route('simplified_return.update',$return->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="supervisor_id" value="1"/>
                        <input type="hidden" name="unified_serial_number" value="{{$return->unified_serial_number}}">
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        رقم الفاتورة المبسطة
                                    </label>
                                    <input readonly class="form-control" type="text"
                                           value="{{$return->simplified->unified_serial_number}}"/>
                                    <input class="form-control" type="hidden" name="simplified_id"
                                           value="{{$return->simplified->id}}"/>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        التاريخ
                                    </label>
                                    <input class="form-control" type="date" name="date" value="{{$return->date}}"/>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الوقت
                                    </label>
                                    <input class="form-control" type="time" name="time" value="{{$return->time}}"
                                    />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        اسم الفرع
                                    </label>
                                    <select required class="js-example-basic-single w-100" name="branch_id"
                                            id="branch_id">
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option
                                                @if($branch->id == $return->branch_id)
                                                selected
                                                @endif
                                                value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        الموظف
                                    </label>
                                    <select required class="js-example-basic-single w-100" name="employee_id"
                                            id="employee_id">
                                        <option value=""></option>
                                        @foreach($employees as $employee)
                                            <option
                                                @if($employee->id == $return->employee_id)
                                                selected
                                                @endif
                                                value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        ملاحظات
                                    </label>
                                    <input value="{{$return->notes}}" class="form-control" type="text" name="notes"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <hr/>

                        <div class="details">
                            <?php
                            $simplified = $return->simplified;

                            echo "<table class='table table-bordered table-condensed table-striped'>";
                            echo '<thead>
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    رقم الفاتورة
                                </th>
                                <th class="border-bottom-0 text-center">
                                    تاريخ - وقت
                                </th>
                                <th class="border-bottom-0 text-center">
                                    طريقة الدفع
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الفرع
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الموظف
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الضريبة
                                </th>
                                <th class="border-bottom-0 text-center">
                                    الاجمالى
                                </th>
                            </tr>
                            </thead>';
                            echo '<tbody>
                                <tr>
                                    <td>' . $simplified->unified_serial_number . '</td>
                                    <td>' . $simplified->date . ' - ' . $simplified->time . ' </td>
                                    <td>';
                                            if ($simplified->payment_method == "cash")
                                                echo $simplified->cash_amount . ' كاش';
                                            elseif ($simplified->payment_method == "visa")
                                                echo $simplified->visa_amount . ' فيزا';
                                            else
                                                echo $simplified->cash_amount . ' كاش +
                                                        ' . $simplified->visa_amount . ' فيزا';
                                            echo '</td>
                                                <td>';
                                            if (empty($simplified->branch_id))
                                                echo 'كل الفروع';

                                            else
                                                echo $simplified->branch->branch_name;

                                            echo '</td>
                                    <td>' . $simplified->employee->name . '</td>
                                    <td>' . $simplified->tax_total . '</td>
                                    <td>' . $simplified->final_total . '</td>
                                </tr>
                            </tbody>';
                            echo "</table>";
                            ?>
                        </div>
                        <hr/>
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-12">
                                <button id="add" type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus"></i>
                                    تعديل فاتورة المرتجع
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
            $('#branch_id').on('change', function () {
                let branch_id = $(this).val();
                $.post("{{route('get.employees')}}", {
                    branch_id: branch_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#employee_id').html(data).trigger('change');
                });
            });
        });
    </script>
@endsection

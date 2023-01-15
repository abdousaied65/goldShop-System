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
                    <h5 class="text-center alert alert-md alert-dark">
                        تقرير المصروفات
                    </h5>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('expenses.report.post')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row m-t-3 mb-3">
                            <div class="col-md-3">
                                <label> الفرع <span class="text-danger">*</span></label>
                                @if(empty(Auth::user()->branch_id))
                                    <select required class="js-example-basic-single w-100" name="branch_id"
                                            id="branch_id">
                                        <option value="all">
                                            كل الفروع
                                        </option>
                                        @foreach($branches as $branch)
                                            <option
                                                @if(isset($_POST['branch_id']) && $_POST['branch_id'] == $branch->id )
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
                            <div class="col-md-3">
                                <label> من تاريخ <span class="text-danger">*</span></label>
                                <input
                                    @if(isset($_POST['from_date']))
                                    value="{{$_POST['from_date']}}"
                                    @else
                                    value="{{date('Y-m-d')}}"
                                    @endif
                                    class="form-control mg-b-20" name="from_date"
                                    required="" type="date">
                            </div>
                            <div class="col-md-3">
                                <label> الى تاريخ <span class="text-danger">*</span></label>
                                <input class="form-control mg-b-20"
                                       @if(isset($_POST['to_date']))
                                       value="{{$_POST['to_date']}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                       @endif
                                       name="to_date" required=""
                                       type="date">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button name="submit" class="btn btn-info pd-x-20" type="submit">
                                <i class="fa fa-display"></i>
                                عرض التقرير
                            </button>
                        </div>
                    </form>
                    @if(isset($_POST['submit']))
                        <form action="{{route('expenses.report.print')}}" method="post" class="d-inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="from_date" value="{{$_POST['from_date']}}"/>
                            <input type="hidden" name="to_date" value="{{$_POST['to_date']}}"/>
                            <input type="hidden" name="branch_id" value="{{$_POST['branch_id']}}"/>
                            <button type="submit" class="btn btn-success pd-x-20">
                                <i class="fa fa-print"></i>
                                طباعة التقرير
                            </button>
                        </form>
                    @endif
                    @if(isset($_POST['submit']))
                        <?php
                        $branch_id = $_POST['branch_id'];
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        if ($branch_id == "all") {
                            $branch_name = "كل الفروع";
                        } else {
                            $branch = \App\Models\Branch::FindOrFAil($branch_id);
                            $branch_name = $branch->branch_name;
                        }
                        ?>
                        <hr>
                        <div class="alert alert-md alert-danger text-center">
                            تقرير المصروفات للفرع
                            ( {{$branch_name}} )
                            من يوم
                            {{$_POST['from_date']}}
                            الى يوم
                            {{$_POST['to_date']}}
                        </div>
                        <div class="results row mt-1 mb-3 p-3">
                            <div class="table-responsive hoverable-table">
                                <table class="table table-condensed table-bordered table-striped table-hover"
                                       style="text-align: center;">
                                    <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-center">#</th>
                                        <th class="border-bottom-0 text-center">المصروف الثابت</th>
                                        <th class="border-bottom-0 text-center"> الفرع</th>
                                        <th class="border-bottom-0 text-center">بيان المصروف</th>
                                        <th class="border-bottom-0 text-center">الرقم التسلسلى</th>
                                        <th class="border-bottom-0 text-center">التاريخ</th>
                                        <th class="border-bottom-0 text-center">المبلغ</th>
                                        <th class="border-bottom-0 text-center">ملاحظات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 0; $total = 0;
                                    @endphp

                                    @foreach ($expenses as $key => $expense)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $expense->fixed->fixed_expense }} </td>
                                            <td>{{ $expense->branch->branch_name }} </td>
                                            <td>{{ $expense->expense_details }} </td>
                                            <td>{{ $expense->unified_serial_number }} </td>
                                            <td>{{ $expense->date }} </td>
                                            <td>{{ $expense->amount }} </td>
                                            <td>{{ $expense->notes }} </td>
                                        </tr>
                                        <?php $total = $total + $expense->amount ?>
                                    @endforeach
                                    @foreach ($fixed as $item)
                                        <?php
                                        if ($branch_id == "all") {
                                            $expenses = \App\Models\Expense::where('fixed_id',$item->id)
                                                ->whereBetween('date', [$from_date, $to_date])
                                                ->get();
                                        } else {
                                            $expenses = \App\Models\Expense::where('fixed_id',$item->id)
                                                ->where('branch_id', $branch_id)
                                                ->whereBetween('date', [$from_date, $to_date])
                                                ->get();
                                        }
                                        $total_fix = 0;
                                        foreach ($expenses as $expense) {
                                            $total_fix = $total_fix + $expense->amount;
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4">{{$item->fixed_expense}}</td>
                                            <td colspan="4">{{$total_fix}}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="4">اجمالى المصروفات</td>
                                        <td colspan="4">{{ $total }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection

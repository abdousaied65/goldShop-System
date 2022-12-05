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
                        تقرير شامل المبيعات
                        (الفواتير الضريبية للشركات)
                    </h5>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('tax.report1.post')}}" method="post"
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


                            <div class="col-md-3">
                                <label> طريقة الدفع <span class="text-danger">*</span></label>
                                <select required name="payment_method" class="form-control">
                                    <option
                                        @if(isset($_POST['payment_method']) && $_POST['payment_method'] == "all" )
                                        selected
                                        @endif
                                        value="all">
                                        كل طرق الدفع
                                    </option>
                                    <option
                                        @if(isset($_POST['payment_method']) && $_POST['payment_method'] == "cash" )
                                        selected
                                        @endif
                                        value="cash"> كاش
                                    </option>
                                    <option
                                        @if(isset($_POST['payment_method']) && $_POST['payment_method'] == "visa" )
                                        selected
                                        @endif
                                        value="visa"> فيزا
                                    </option>
                                    <option
                                        @if(isset($_POST['payment_method']) && $_POST['payment_method'] == "mixed" )
                                        selected
                                        @endif
                                        value="mixed"> كاش + فيزا
                                    </option>
                                </select>
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
                        <form action="{{route('tax.report1.print')}}" method="post" class="d-inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="from_date" value="{{$_POST['from_date']}}"/>
                            <input type="hidden" name="to_date" value="{{$_POST['to_date']}}"/>
                            <input type="hidden" name="branch_id" value="{{$_POST['branch_id']}}"/>
                            <input type="hidden" name="payment_method" value="{{$_POST['payment_method']}}"/>
                            <button type="submit" class="btn btn-success pd-x-20">
                                <i class="fa fa-print"></i>
                                طباعة التقرير
                            </button>
                        </form>
                    @endif
                    @if(isset($_POST['submit']))
                        <?php
                        $branch_id = $_POST['branch_id'];
                        if ($branch_id == "all") {
                            $branch_name = "كل الفروع";
                        } else {
                            $branch = \App\Models\Branch::FindOrFAil($branch_id);
                            $branch_name = $branch->branch_name;

                        }
                        $payment_method = $_POST['payment_method'];
                        if ($payment_method == "all") {
                            $payment_method = "مختلف طرق الدفع";
                        } elseif ($payment_method == "cash") {
                            $payment_method = "كاش فقط";
                        } elseif ($payment_method == "visa") {
                            $payment_method = "فيزا فقط";
                        } elseif ($payment_method == "mixed") {
                            $payment_method = "كاش + فيزا";
                        }
                        ?>
                        <hr>
                        <div class="alert alert-md alert-danger text-center">
                            تقرير شامل المبيعات
                            (الفواتير الضريبية للشركات)
                            للفرع
                            ( {{$branch_name}} )
                            من يوم
                            {{$_POST['from_date']}}
                            الى يوم
                            {{$_POST['to_date']}}
                            (
                            {{$payment_method}}
                            )
                        </div>
                        <div class="results row mt-1 mb-3 p-3">
                            <table class="table table-condensed table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        مجموع المبلغ ( بدون ضريبة )
                                    </th>
                                    <th>
                                        مجموع الذهب
                                        ( مجموع الاوزان )
                                    </th>
                                    <th>
                                        الأجمالي للمبلغ ( شامل الضريبة )
                                    </th>
                                    <th>
                                        اجمالى الضريبة
                                    </th>
                                    <th>
                                        سعر الجرام
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$sum_amount_total}}</td>
                                    <td>{{$sum_total_weight}}</td>
                                    <td>{{$sum_final_total}}</td>
                                    <td>{{$sum_tax_total}}</td>
                                    <td>{{$sum_gram_price}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
@endsection

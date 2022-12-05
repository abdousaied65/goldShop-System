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
                        المرتجعات الصفرية
                    </h5>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('declaration.report4.post')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row m-t-3 mb-3">
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
                        <form action="{{route('declaration.report4.print')}}" method="post" class="d-inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="from_date" value="{{$_POST['from_date']}}"/>
                            <input type="hidden" name="to_date" value="{{$_POST['to_date']}}"/>
                            <button type="submit" class="btn btn-success pd-x-20">
                                <i class="fa fa-print"></i>
                                طباعة التقرير
                            </button>
                        </form>
                    @endif
                    @if(isset($_POST['submit']))
                        <hr>
                        <div class="alert alert-md alert-danger text-center">
                            المرتجعات الصفرية
                            من يوم
                            {{$_POST['from_date']}}
                            الى يوم
                            {{$_POST['to_date']}}
                        </div>
                        <div class="results row mt-1 mb-3 p-3">
                            <table class="table table-condensed table-bordered text-center table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="font-size: 20px!important;">
                                        مجموع المبلغ ( بدون ضريبة )
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tx-26">{{$sum_amount_total}}</td>
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

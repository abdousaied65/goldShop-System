@extends('supervisor.layouts.master')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 5px;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 0px;
        bottom: 0px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors : </strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($role, ['method' => 'PATCH','route' => ['supervisor.roles.update', $role->id]]) !!}
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-left alert alert-md alert-success">
                            تعديل مجموعة
                            [ {{ $role->name }} ] </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="main-content-label mg-b-5">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <p>اسم المجموعة :</p>
                                <input type="text" value="{{$role->name}}" readonly name="name"
                                       placeholder="اسم المجموعة"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">اسم الصلاحية</th>
                                <th class="text-center">عرض</th>
                                <th class="text-center">اضافة</th>
                                <th class="text-center">تعديل</th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>المستخدمين</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("1", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="1">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("2", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="2">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("3", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="3">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("4", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="4">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>صلاحيات المستخدمين</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("5", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="5">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("6", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="6">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("7", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="7">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("8", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="8">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td> الفروع </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("9", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="9">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("10", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="10">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("11", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="11">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("12", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="12">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td> الأصناف </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("13", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="13">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("14", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="14">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("15", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="15">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("16", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="16">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td> الفواتير الضريبية المبسطة </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("17", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="17">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("18", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="18">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td> الفواتير الضريبية للشركات والمؤسسات </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("19", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="19">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("20", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="20">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td> فواتير المشتريات </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("21", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="21">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("22", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="22">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("23", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="23">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td> مرتجعات الفواتير الضريبية المبسطة </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("24", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="24">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("25", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="25">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td> مرتجعات الفواتير الضريبية للشركات والمؤسسات </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("26", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="26">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" name="permission[]"
                                               <?php if (in_array("27", $rolePermissions)) {
                                                   echo "checked";
                                               } ?> value="27">
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-md-12 text-center">
                            <button type="button" id="check_all" class="btn btn-danger"> تحديد الكل</button>
                            <button type="submit" class="btn btn-info">تحديث</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
    {!! Form::close() !!}

    <!-- main-content closed -->
    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#check_all').click(function () {
            $('input[type=checkbox]').prop('checked', true);
        });
    </script>
@endsection

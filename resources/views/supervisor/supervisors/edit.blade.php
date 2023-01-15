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
                            تعديل بيانات المستخدم
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($supervisor, ['method' => 'PATCH','enctype' => 'multipart/form-data','route' => ['supervisor.supervisors.update', $supervisor->id]]) !!}
                    <div class="row mb-3 mt-3">
                        <div class="parsley-input col-md-4" id="fnWrapper">
                            <label> اسم المستخدم : <span class="tx-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>
                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> البريد الالكترونى : <span class="tx-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control text-left','dir'=>'ltr','required')) !!}
                        </div>
                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> الصلاحية </label>
                            {!! Form::select('role_name', $roles,$supervisorRole,
                                        array('required','id'=>'role_name','class' => 'selectpicker form-control','data-live-search' => 'true','data-style'=>'btn-info'
                                        ,'title' => 'الصلاحية',)
                                    )
                                    !!}
                        </div>
                    </div>

                    <div class="row  mb-3 mt-3">
                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> كلمة المرور : <span class="tx-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text showPassword" id="basic-addon1">
                                            <i class="fa fa-eye basic-addon1"></i>
                                        </span>
                                </div>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror text-left"
                                       dir="ltr" name="password"
                                       aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> تأكيد كلمة المرور : <span class="tx-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text showPassword2"
                                              id="basic-addon2">
                                            <i class="fa fa-eye basic-addon2"></i>
                                        </span>
                                </div>
                                <input id="confirm-password" type="password"
                                       class="form-control @error('password') is-invalid @enderror text-left"
                                       dir="ltr" name="confirm-password"
                                       aria-describedby="basic-addon2">
                            </div>
                        </div>
                        <div class="parsley-input branch col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper" style="@if($supervisor->role_name == "مدير النظام") display:none; @endif">
                            <label class="form-label"> الفرع </label>
                            <select data-live-search="true" data-style="btn-warning" title="اختر الفرع"
                                    class="form-control selectpicker" name="branch_id" id="branch_id">
                                @foreach($branches as $branch)
                                    <option
                                        @if($supervisor->branch_id == $branch->id)
                                        selected
                                        @endif
                                        value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row m-t-3 mb-3">
                        <div class="col-lg-4 mb-2">
                            <label for=""> الصورة الشخصية </label>
                            <input accept="image/*" type="file"
                                   oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                   name="profile_pic" class="form-control">
                            <label for="" class="d-block"> معاينة الصورة </label>
                            <img id="pic" src="{{asset($supervisor->profile_pic)}}"
                                 style="width: 100px; height:100px;"/>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center mt-3 mb-3">
                        <button class="btn btn-info btn-md" type="submit"> تحديث</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->

    <script src="{{asset('admin-assets/js/jquery.min.js')}}"></script>
    <script>
        $(".showPassword").click(function () {
            if ($("#password").attr("type") == "password") {
                $("#password").attr("type", "text");
                $(".showPassword").find('i.fa').toggleClass('fa-eye fa-eye-slash');
            } else {
                $("#password").attr("type", "password");
                $(".showPassword").find('i.fa').toggleClass('fa-eye fa-eye-slash');
            }
        });
        $(".showPassword2").click(function () {
            if ($("#confirm-password").attr("type") == "password") {
                $("#confirm-password").attr("type", "text");
                $(".showPassword2").find('i.fa').toggleClass('fa-eye fa-eye-slash');
            } else {
                $("#confirm-password").attr("type", "password");
                $(".showPassword2").find('i.fa').toggleClass('fa-eye fa-eye-slash');
            }
        });
        $('#role_name').on('change', function () {
            let role_name = $(this).val();
            if (role_name == "مدير النظام") {
                $('.branch').hide();
                $('#branch_id').val('').selectpicker('refresh');
                $('#branch_id').attr('required', false);
            } else {
                $('.branch').show();
                $('#branch_id').val('').selectpicker('refresh');
                $('#branch_id').attr('required', true);
            }
        });
    </script>

@endsection

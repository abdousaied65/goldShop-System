@extends('supervisor.layouts.master')
<!-- Internal Data table css -->
<style>
    i.la {
        font-size: 15px !important;
    }
</style>
@section('content')
    <div class="row text-center">
        <div class="col-lg-12 mt-5">
            <p class="alert alert-info alert-md text-center"> عرض بيانات المستخدم </p>
        </div>
        <div class="table-responsive hoverable-table">
            <table class="table table-striped table-condensed table-bordered text-center">
                <thead>
                <tr>
                    <th class="border-bottom-0 text-center">اسم المستخدم</th>
                    <th class="border-bottom-0 text-center">البريد الالكترونى</th>
                    <th class="border-bottom-0 text-center">الصورة الشخصية</th>
                    <th class="border-bottom-0 text-center">الصلاحية</th>
                    <th class="border-bottom-0 text-center">الفرع</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $supervisor->name}}</td>
                    <td>{{ $supervisor->email }}</td>
                    <td>
                        @if(empty($supervisor->profile_pic))
                            <img data-toggle="modal" href="#modaldemo9"
                                 src="{{asset('assets/img/guest.png')}}"
                                 style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                        @else
                            <img data-toggle="modal" href="#modaldemo9"
                                 src="{{asset($supervisor->profile_pic)}}"
                                 style="width: 70px;cursor: pointer; height: 70px;border-radius: 100%; padding: 3px; border: 1px solid #aaa;">
                        @endif
                    </td>
                    <td>
                        {{$supervisor->role_name}}
                    </td>
                    <td>
                        @if(empty($supervisor->branch_id))
                            كل الفروع
                        @else
                            {{$supervisor->branch->branch_name}}
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

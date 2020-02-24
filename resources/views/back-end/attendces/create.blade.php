@extends('back-end.layout.app')
@php $pageTitle = "إضافه معاد الحضور " @endphp
@section('title')
{{ $pageTitle }}
@endsection

@section('content')

@component('back-end.layout.header')
@slot('nav_title')
{{ $pageTitle }}
@endslot
@endcomponent

@component('back-end.shared.create')
<form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{ route($routeName.'.store') }}"
    data-bv-message="This value is not valid" data-bv-feedbackicons-valid="fa fa-check"
    data-bv-feedbackicons-invalid="fa fa-bug" data-bv-feedbackicons-validating="fa fa-refresh"
    enctype="multipart/form-data">
    @csrf



    @php $input = "delivery_id"; @endphp
    <div class="form-group">
        <label class="col-md-2 control-label">موظف التوصيل </label>
        <div class="col-md-4">
            <select name="{{ $input }}" class="form-control" required>
                @foreach ($deliveries as $delivery)
                <option value="{{$delivery->id}}" @if(isset($row)) @if( $row->delivery_id == $delivery->id )
                    selected
                    @endif
                    @endif
                    >{{$delivery->name}} </option>
                @endforeach
            </select>
        </div>
    </div>

    
    @php $input = "attendance"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">حضور</label>
        <div class="col-lg-4">
            <?php date_default_timezone_set("Africa/Cairo") ?>
            <input type="text" name="{{ $input }}" @if(isset($row)) value="{{$row->$input}}" @else
                value="{{date('h:ia')}}" @endif class="form-control" required readonly>
            @error($input)
            <div class="alert alert-danger" role="alert" style="text-align: center">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    @php $input = "delay_excuse"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">عذر للتاخير </label>
        <div class="col-lg-4">
            <input type="text" class="form-control" name="{{ $input }}"
                value="{{ isset($row) ? $row->{$input} : '' }}" />
            @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    @php $input = "deduction"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">خصم </label>
        <div class="col-lg-4">
            <input type="text" class="form-control" name="{{ $input }}"
                value="{{ isset($row) ? $row->{$input} : 10 }}" />
            @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <button type="submit" class="btn btn-primary" onclick="myFunction()">إضافة</button>
        </div>
    </div>
</form>
@endcomponent
@endsection
@push('css')
<!-- Responsive Style For-->
<link href="{{asset('panel/assets/css/rtl-css/responsive-rtl.css')}}" rel="stylesheet">
<!-- Responsive Style For-->
<link rel="stylesheet" href="{{asset('panel/assets/css/rtl-css/plugins/summernote-rtl.css')}}">
<!-- Custom styles for this template -->


<!-- Plugin Css Put Here -->

<link rel="stylesheet" href="{{asset('panel/assets/css/rtl-css/plugins/fileinput-rtl.css')}}">
@endpush
@push('js')
<script>
    console.log("test");
        document.getElementById('date').valueAsDate = new Date();
</script>
<!--Upload button Script Start-->
<script src="{{asset('panel/assets/js/fileinput.min.js')}}"></script>
<!--Upload button Script End-->

<!--Auto resize  text area Script Start-->
<script src="{{asset('panel/assets/js/jquery.autosize.js')}}"></script>
<!--Auto resize  text area Script Start-->
<script src="{{asset('panel/assets/js/pages/sampleForm.js')}}"></script>


<!-- summernote Editor Script For Layout start-->
<script src="{{asset('panel/assets/js/summernote.min.js')}}"></script>
<!-- summernote Editor Script For Layout End-->

<!-- Demo Ck Editor Script For Layout Start-->
<script src="{{asset('panel/assets/js/pages/editor.js')}}"></script>
<!-- Demo Ck Editor Script For Layout ENd-->
@endpush
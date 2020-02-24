@extends('back-end.layout.app')
@php

$pageTitle = "تعديل معاد الحضور والانصراف" ;
@endphp
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
<form id="defaultForm" method="post" class="form-horizontal ls_form"
    action="{{ route($routeName.'.update' , ['id' => $row]) }}" data-bv-message="This value is not valid"
    data-bv-feedbackicons-valid="fa fa-check" data-bv-feedbackicons-invalid="fa fa-bug"
    data-bv-feedbackicons-validating="fa fa-refresh" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
    {{-- @include('back-end.'.$folderName.'.form')      --}}


    @php $input = "delivery_id"; @endphp


    <div class="form-group">
        <label class="col-md-2 control-label">موظف التوصيل </label>
        <div class="col-md-4">
            <input type="text" name="" @if(isset($row->delivery)) value="{{$row->delivery->name}}" @else
            @endif
            class="form-control" required readonly>

            <input type="hidden" name="{{ $input }}" @if(isset($row->delivery)) value="{{$row->delivery->id}}" @else
            @endif
            class="form-control" required readonly>
        </div>

    </div>


    @php $input = "attendance"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">حضور</label>
        <div class="col-lg-4">
            <?php date_default_timezone_set("Africa/Cairo") ?>
            <input type="text" name="{{ $input }}" @if(isset($row)) value="{{$row->$input}}" @else @endif
                class="form-control" required readonly>
            @error($input)
            <div class="alert alert-danger" role="alert" style="text-align: center">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    @php $input = "departure"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">انصراف</label>
        <?php date_default_timezone_set("Africa/Cairo") ?>
        <div class="col-lg-4">
            <input type="text" name="{{ $input }}" value="{{date('Y-m-d h:i:sa')}}" class="form-control" required
                readonly>
            @error($input)
            <div class="alert alert-danger" role="alert" style="text-align: center">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>
    
    @php $input = "is_recieved"; @endphp
    <div class="form-group">
        <label class="col-lg-2 control-label">تم استلام 10 جنيهات</label>
       
        <div class="col-lg-4">
            <input type="checkbox" name="{{ $input }}"  class="form-control" checked value="1"
                >
            @error($input)
            <div class="alert alert-danger" role="alert" style="text-align: center">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <button type="submit" class="btn btn-primary" onclick="">انصراف</button>
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

@push('js')
     <!--botbox library script-->
  <script src="{{asset('panel/assets/js/bootbox.min.js')}}"></script>
  <script type="text/javascript">
          function check() {
            $('form').submit(function(e) {
                var currentForm = this;
               
                e.preventDefault();
                //console.log("should go to " + currentForm);
                bootbox.dialog({
                message: "تم استلام 10 جنيهات ؟",
                title: "استلام 10 جنيهات",
                buttons: {
                  success: {
                        label: "نعم!",
                        className: "btn-success",
                        callback: function() {

                            
                            currentForm.submit();
                           
                        }
                    },
                    danger: {
                        label: "لا!",
                        className: "btn-danger",
                        callback: function() {
                            currentForm.submit();
                            //Example.show("uh oh, look out!");
                        }
                    },

                  }
                  });
                // bootbox.confirm("Are you sure?", function(result) {
                //     if (result) {
                //         currentForm.submit();
                //     }
                // });
             });
      }
</script>


@endpush

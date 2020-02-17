@extends('back-end.layout.app')
@php

 $pageTitle = " تعديل عرض " . $row->user_name ;
 
 @endphp  
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')

    @component('back-end.layout.header')
        @slot('nav_title')
            {{ $pageTitle }}
            {{-- <a href="{{ route($routeName.'.create') }}">  
                    <button class="alert-success"> <i class="fa fa-plus"></i> </button>
            </a> --}}
        @endslot
    @endcomponent

        @component('back-end.shared.create')
        @if (session()->get('action') )
            <div class="alert alert-success">
                <strong>{{session()->get('action')}}</strong>
            </div>
        @endif
        <form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{ route($routeName.'.update' , ['id' => $row]) }}"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="fa fa-check"
                data-bv-feedbackicons-invalid="fa fa-bug"
                data-bv-feedbackicons-validating="fa fa-refresh"
                enctype="multipart/form-data"
                >  
                @csrf
                {{method_field('PUT')}}
                @include('back-end.'.$folderName.'.form')   
                @php $input = "image"; @endphp          
                <div class="form-group">
                        <label class="col-md-2 control-label">الصورة</label>
                        <div class="col-md-10 ls-group-input">
                            <input name="{{ $input }}" id="file-3" type="file" >
                </div>
                @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span style="margin-right: 15%">يفضل رفع الصوره 400 * 400 </span>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-info" type="submit">  إضافه  </button>
                    </div>
                </div>
             </form>
               
                <img src="{{asset("uploads/".$routeName.'/'.$row->image)}}" height="300px" width="300px" style="margin:0 10%;"> <br><br>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-info" type="submit">  تعديل  </button>
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
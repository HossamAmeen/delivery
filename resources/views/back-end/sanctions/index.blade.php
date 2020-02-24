@extends('back-end.layout.app')
@php $row_num = 1; $pageTitle = "الخصومات" @endphp
@section('title')
{{$pageTitle}}
@endsection

@section('content')

@component('back-end.layout.header')
@slot('nav_title')
{{$pageTitle}}
<a href="{{ route($routeName.'.create') }}">
    <button class="alert-success"> <i class="fa fa-plus"></i> </button>
</a>
@endslot
@endcomponent
@component('back-end.shared.table' )
@if (session()->get('action') )
<div class="alert alert-success">
    <strong>{{session()->get('action')}}</strong>
</div>
@endif
<table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
    <thead>
        <tr>
            
            <th>#</th>

            <th>تاريخ</th>
            <th>الخصم</th>
            <th>موظف الديلفري</th>
            <th>السبب</th>
          


            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $item)
        <tr>
            <td> {{$row_num++}}</td>
            <td>{{$item->date}}</td>
            <td>{{$item->deduction}}</td>
            @if(isset($item->delivery))
            <td>{{$item->delivery->name}}</td>
            @else
            <td>لا يوجد</td>
            @endif
          
            <td> {{substr($item->reason , 0 , 200 )}}</td>
            <td>
                @include('back-end.shared.buttons.delete')
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endcomponent
@endsection
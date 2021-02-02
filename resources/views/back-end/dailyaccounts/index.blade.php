@extends('back-end.layout.app')
@php $row_num = 1; $pageTitle = "مصروفات اليومية" @endphp
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
            <th>الفلوس</th>
            <th>ملحوظه</th>
           
          


            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $item)
        <tr>
            <td> {{$row_num++}}</td>
            <td>{{$item->date}}</td>
            <td>{{$item->expenses ?? 0 }}</td>
            @if(isset($item->note))
            <td>{{$item->note}}</td>
            @else 
            <td>لا يوجد</td>
            @endif
            <td>
                <form action="{{ route($routeName.'.destroy' , ['id' => $item]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    @if($item->isReceived == 0)
                    <a href="{{url('admin/dailyaccounts/'.$item->id . '/recieved')}}" class="btn btn-info">
                        <i class="material-icons">استلام</i>
                    </a>
                    @else
                    <i class="material-icons">تم الاستلام</i>
                    @endif
                    <a href="{{ route($routeName.'.edit' , ['id' => $item]) }}" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                            <i class="material-icons">تعديل</i>
                        </a>
                    <button type="submit" rel="tooltip" title="" class="btn btn-danger"  onclick="check()" data-original-title="Remove {{ $sModuleName }}">
                        <i class="material-icons">حذف</i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
          <td>حساب اليوم</td>
          <td>{{$account->expenses ?? 0}}</td>
        </tr>
      </tfoot>
    
</table>
@endcomponent
@endsection
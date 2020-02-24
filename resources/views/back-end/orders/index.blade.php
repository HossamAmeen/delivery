@extends('back-end.layout.app')
@php $row_num = 1; $pageTitle = "عرض الطلبات" @endphp
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

            <th>العميل</th>
            <th>الموظف</th>
            <th> السعر</th>
            <th>سعر الديلفري</th>
            <th> الوصف</th>
            <th> الهاتف</th>
            <th>العنوان</th>
            <th>التقيم</th>
            <th> معدل التقيم</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $item)
        <tr>
            <td> {{$row_num++}}</td>

            @if(isset($item->client))
            <td>{{$item->client->name}}</td>
            @else
            <td>لا يوجد</td>
            @endif
            @if(isset($item->delivery))
            <td>{{$item->delivery->name}}</td>
            @else
            <td>لا يوجد</td>
            @endif
            <td>{{$item->price}}</td>
            <td>{{$item->delivery_price}}</td>
            <td>{{$item->description}}</td>
            @if(isset($item->client))
            <td>{{$item->client->phone}}</td>
            @else
            <td>{{$item->phone}}</td>
            @endif
            @if(isset($item->client))
            <td>{{$item->client->address}}</td>
            @else
            <td>{{$item->address}}</td>
            @endif
            @if(isset($item->review))
            <td>{{$item->review}}</td>
            @else
            <td>لا يوجد</td>
            @endif
            <td>{{$item->rate}}</td>
            <td>
                <form action="{{ route($routeName.'.destroy' , ['id' => $item]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    @if($status < 4 ) <a href="{{ url('admin/change-status-order/'. ($status + 1).'/'.$item->id) }}"
                        rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                        <i class="material-icons">تم</i>
                        </a>
                   @elseif(isset($item->delivery) && $status == 4)
                        <a href="{{ url('admin/change-status-order/'. ($status + 1).'/'.$item->id.'/'.$item->delivery->id) }}"
                            rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                            <i class="material-icons">تم</i>
                        </a>

                    @endif
                        <a href="{{ route($routeName.'.edit' , ['id' => $item]) }}" rel="tooltip" title=""
                            class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                            <i class="material-icons">تعديل</i>
                        </a>
                        <button type="submit" rel="tooltip" title="" class="btn btn-danger" onclick="check()"
                            data-original-title="Remove {{ $sModuleName }}">
                            <i class="material-icons">حذف</i>
                        </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endcomponent
@endsection
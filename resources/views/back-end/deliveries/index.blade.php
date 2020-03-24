@extends('back-end.layout.app')
 @php $row_num = 1;   $pageTitle = "موظفين التوصيل" @endphp  
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
                            <th> الاسم </th>
                            <th>البريد</th>
                             <th>الهاتف</th>
                             <th>العنوان</th>
                             <th>فلوس التوصيل</th>
                             <th>فلوس اليومية</th>
                             <th>خصومات الشهرية</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $item)
                                 <tr>
                                    <td> {{$row_num++}}</td>
                                    
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>
                                    @if(isset($item->money))
                                    <td>{{$item->money}}</td>
                                    @else 
                                    <td>0</td>
                                    @endif
                                    @if(isset($item->daily_money))
                                    <td>{{$item->daily_money}}</td>
                                    @else 
                                    <td>0</td>
                                    @endif
                                    {{-- @if(isset($item->sanctions))
                                    <td>{{$item->sanctions->sum('deduction')}}</td>
                                    @else 
                                    <td>0</td>
                                    @endif --}}
                                    {{-- @if( $item->sumS() == null || 1) --}}
                                    <td>{{$item->sumS()}}</td>
                                    {{-- @else 
                                    <td>0</td>
                                    @endif --}}
                                    <td>
                                     @include('back-end.shared.buttons.delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    @endcomponent
@endsection

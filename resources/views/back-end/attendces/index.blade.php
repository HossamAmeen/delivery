@extends('back-end.layout.app')
 @php $row_num = 1;   $pageTitle = "جدول الحضور والانصراف" @endphp  
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
                            <th> اسم الموظف</th>
                            <th>الحضور</th>
                            <th>الانصراف</th>
                            <th>عذر التأخير</th>
                            <th>خصم</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $item)
                                 <tr>  
                                    <td> {{$row_num++}}</td>
                                    @if(isset($item->delivery))
                                    <td>{{$item->delivery->name}}</td>
                                    @else 
                                    <td>لا يوجد</td>
                                    @endif
                                    <td>{{$item->attendance}}</td>
                                    @if(isset($item->withdrawal))
                                    <td>{{$item->withdrawal}}</td>
                                    @else 
                                    <td>متاح</td>
                                    @endif
                                    
                                    @if(isset($item->delay_excuse))
                                    <td>{{$item->delay_excuse}}</td>
                                    @else 
                                    <td>لا يوجد</td>
                                    @endif
                                    @if(isset($item->deduction))
                                    <td>{{$item->deduction}}</td>
                                    @else 
                                    <td>لا يوجد</td>
                                    @endif
                                     <td>
                                        <form action="{{ route($routeName.'.destroy' , ['id' => $item]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{ route($routeName.'.edit' , ['id' => $item]) }}" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                                                    <i class="material-icons">انصراف</i>
                                                </a>
                                            <button type="submit" rel="tooltip" title="" class="btn btn-danger"  onclick="check()" data-original-title="Remove {{ $sModuleName }}">
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

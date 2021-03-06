@extends('back-end.layout.app')
 @php $row_num = 1;   $pageTitle = "العملاء" @endphp  
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
                             <th>الوظيفة</th>
                             <th>فلوس</th>
                             <th>محظور</th>
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
                                  
                                    @if(isset($item->job))
                                    <td>{{$item->job}}</td>
                                    @else 
                                    <td>لا يوجد</td>
                                    @endif
                                    @if(isset($item->money))
                                    <td>{{$item->money}}</td>
                                    @else 
                                    <td>لا يوجد</td>
                                    @endif
                                    @if($item->is_block == 0)
                                    <td> لا</td>
                                    @else 
                                    <td>نعم</td>
                                    @endif
                                    <td>
                                     @include('back-end.shared.buttons.delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    @endcomponent
@endsection

@extends('back-end.layout.app')
 @php $row_num = 1;   $pageTitle = "موظفين التوصيل" @endphp  
@section('title')
   {{$pageTitle}}
@endsection

@section('content')
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
                             <th>فلوس المتبقيه</th>
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
                                        <form action="{{ route($routeName.'.destroy' , ['id' => $item]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{url('admin/orders/'.$item->id)}}" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                                                <i class="material-icons">طلبات اليوم</i>
                                            </a>
                                            <a href="{{ route($routeName.'.edit' , ['id' => $item]) }}" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit {{ $sModuleName }}">
                                                    <i class="material-icons">تعديل</i>
                                                </a>
                                            <button type="submit" rel="tooltip" title="" class="btn btn-danger"  onclick="check()" data-original-title="Remove {{ $sModuleName }}">
                                                <i class="material-icons">حذف</i>
                                            </button>
                                        </form>
                                     {{-- @include('back-end.shared.buttons.delete') --}}
                                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    @endcomponent
@endsection

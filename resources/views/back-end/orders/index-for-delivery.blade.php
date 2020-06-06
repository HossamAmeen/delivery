@extends('back-end.layout.app')
@php $row_num = 1;$total = 0 ; $pageTitle = " عرض الطلبات اليوم الخاصه ب " . $delivery_name @endphp
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
            <th> نسبة موظف التوصيل</th>
            <td>تاريخ</td>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $item)
        <?php $total += $item->delivery_price ; ?>
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
            @if(isset($item->description))
            <td>{{$item->description}}</td>
            @else
            <td>لا يوجد</td>
            @endif

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
            @if(isset($item->rate))
            <td>{{$item->rate}}</td>
            @else
            <td>لا يوجد</td>
            @endif

            @if(isset($item->delivery_ratio))
            <td>{{$item->delivery_ratio}}</td>
            @else
            <td>لا يوجد</td>
            @endif
            <td> {{$item->updated_at }}</td>
            <td>
                {{-- <form action="{{ route($routeName.'.destroy' , ['id' => $item]) }}" method="post">
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
                </form> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
          <td>مجموع الفلوس</td>
          <td>{{$total}}</td>
        </tr>
      </tfoot>
</table>
@endcomponent

@endsection
@push('js')
{{-- <script>
      var interval = 6000;  // 1000 = 1 second, 3000 = 3 seconds
    function order_counter(){
        var ajax = new XMLHttpRequest();
        var method = "GET";
        //URL
        var url = {!! json_encode(url("admin/order/count")) !!};
        // console.log(url);
        var asynchronons = true;
        ajax.open(method, url, asynchronons);
        ajax.send();
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //v is variable that = json respone
                var v = JSON.parse(this.responseText);
                // console.log(v);
                //itemName is key in JSON
                $("#order_count").html(v['request']);
                console.log(v['NewOrderCount']);
                setTimeout(order_counter, interval);
            }
        }
    }
    // setTimeout(doAjax, interval);
    setTimeout(order_counter, 1);
</script> --}}
@endpush


 
@php $input = "delivery_id"; @endphp
<div class="form-group">
    <label class="col-md-2 control-label">موظف التوصيل </label>
    <div class="col-md-4">
        <select name="{{ $input }}" class="form-control" required>
            @foreach ($deliveries as $delivery)
            <option value="{{$delivery->id}}" 
            @if(isset($row))
            @if( $row->delivery_id == $delivery->id )
                selected
                @endif
            @endif
                >{{$delivery->name}} </option>
            @endforeach
        </select>
    </div>

</div>


 @php $input = "attendance"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label">حضور</label>
     <div class="col-lg-4">
       <?php date_default_timezone_set("Africa/Cairo") ?>
         <input type="text" name="{{ $input }}"   @if(isset($row)) value="{{$row->$input}}" @else
           @endif
           class="form-control" required readonly>
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>  


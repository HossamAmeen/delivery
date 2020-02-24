@php $input = "date"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">تاريخ </label>
    <div class="col-lg-6">
        <input type="date" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "deduction"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الخصم </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "reason"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">السبب </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "delivery_id"; @endphp
 <div class="form-group">
     <label class="col-md-3 control-label">موظف التوصيل </label>
     <div class="col-md-6">
         <select name="{{ $input }}" class="form-control" required>
             @foreach ($deliveries as $delivery)
             <option value="{{$delivery->id}}" @if(isset($row)) @if( $row->delivery_id == $delivery->id )
                 selected
                 @endif
                 @endif
                 >{{$delivery->name}} </option>
             @endforeach
         </select>
     </div>
 </div>

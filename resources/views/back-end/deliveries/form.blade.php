
@php $input = "name"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الاسم </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}" required />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "email"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">البريد </label>
    <div class="col-lg-6">
        <input type="email" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}" required/>
        @error($input)
        <span class="invalid-feedback" role="alert" >
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "password"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">كلمة المرور </label>
    <div class="col-lg-6">
        <input type="password" class="form-control" name="{{ $input }}"  @if($pageDes !="Here you can edit Delivery" )
        required @endif/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "password_confirmation"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">تاكيد كلمة المرور </label>
    <div class="col-lg-6">
        <input type="password" class="form-control" name="{{ $input }}"  @if($pageDes !="Here you can edit Delivery" )
        required @endif />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
  
@php $input = "phone"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الهاتف </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}" required />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "phone2"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الهاتف 2</label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}"  />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "address"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">العنوان </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}" required/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "address2"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">العنوان 2 </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}"/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "money"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">فلفوس التوصيل</label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "daily_money"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">فلوس اليومية</label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "delivery_ratio"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">نسبة من الطلبات </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}"  required/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- @php $input = "begin"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">معد الحضور</label>
    <div class="col-lg-6">
        <input type="time"  class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> --}}

@php $input = "attendance"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">معد الحضور</label>
    <div class="col-lg-6">
        {{-- <input type="time"  class="form-control" name="{{ $input }}" value="{{isset($row) ? date("H:i", strtotime($row->{$input}))  : Request::old($input)}}" /> --}}
        <input type="time"  class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}" required/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "departure"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">معاد الانصراف </label>
    <div class="col-lg-6">
        <input type="time"  class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : Request::old($input)}}" required/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

{{-- @php $input = "city_id"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">المدينه </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : Request::old($input) }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> --}}




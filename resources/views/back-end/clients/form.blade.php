
@php $input = "name"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الاسم </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" required />
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
        <input type="email" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" required/>
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
        <input type="password" class="form-control" name="{{ $input }}"  @if($pageDes !="Here you can edit Client" )
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
        <input type="password" class="form-control" name="{{ $input }}"  @if($pageDes !="Here you can edit Client" )
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
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" required />
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
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}"  />
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
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" required/>
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
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}"/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "job"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">الوظيفة </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}"/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "money"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">فلوس </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}"/>
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@php $input = "block_reason"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">سبب حظره من السستم</label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{isset($row) ? $row->{$input} : ''}}" />
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
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> --}}
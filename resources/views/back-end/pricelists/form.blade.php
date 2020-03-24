@php $input = "time"; @endphp
<div class="form-group">
  <label class="col-lg-2 control-label">الفتره المتاحة</label>
  <div class="col-lg-4">
    <input type="text" name="{{ $input }}" @if(isset($row)) value="{{$row->$input}}" @else
      value="{{Request::old($input)}}" @endif class="form-control" required>
    @error($input)
    <div class="alert alert-danger" role="alert" style="text-align: center">
      <strong>{{ $message }}</strong>
    </div>
    @enderror
  </div>
</div>

@php $input = "image"; @endphp
<div class="form-group">
  <label class="col-md-2 control-label">الصورة</label>
  <div class="col-md-10 ls-group-input">
    <input name="{{ $input }}" id="file-3" type="file" multiple="true">
  </div>
  @error($input)
  <span class="invalid-feedback" role="alert">
    <strong style="margin-right: 15%;color:red">{{ $message }}</strong>
  </span>
  @enderror
  <br>
  <span style="margin-right: 15%">يفضل رفع الصورة 400 * 400 </span>
</div>
@php $input = "name"; @endphp
<div class="form-group">
  <label class="col-lg-2 control-label">اسم الخدمه</label>
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

@php $input = "tybe"; @endphp
<div class="form-group">
  <label class="col-md-2 control-label">النوع</label>
  <div class="col-md-4">
    <select name="{{ $input }}" class="form-control" required>

      <option value="دليفري" @if(isset($row)) @if( $row->tybe == "دليفري")
        selected
        @endif
        @endif
        >دليفري</option>

      <option value="خدمات طبية" @if(isset($row)) @if( $row->tybe == "خدمات طبية")
        selected
        @endif
        @endif
        >خدمات طبية</option>


      <option value="صنايعية وفنين" @if(isset($row)) @if( $row->tybe == "صنايعية وفنين")
        selected
        @endif
        @endif
        >صنايعية وفنين</option>
    </select>
  </div>

</div>
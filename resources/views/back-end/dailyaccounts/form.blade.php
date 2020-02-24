
@php $input = "date"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">تاريخ </label>
    <div class="col-lg-6">
        <input type="date" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : date('Y-m-d') }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "expenses"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">االمصروف </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@php $input = "note"; @endphp
<div class="form-group">
    <label class="col-lg-3 control-label">ملحوظه </label>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
        @error($input)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

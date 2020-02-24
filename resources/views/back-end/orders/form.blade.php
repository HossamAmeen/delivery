
@php $input = "title"; @endphp
<div class="form-group">
  <label class="col-md-2 control-label">النوع </label>
  <div class="col-md-4">
    <select name="{{ $input }}" class="form-control" required>

      <option value="دليفري" @if(isset($row)) @if( $row->title == "دليفري")
        selected
        @endif
        @endif
        >دليفري</option>

      <option value="خدمات طبية" @if(isset($row)) @if( $row->title == "خدمات طبية")
        selected
        @endif
        @endif
        >خدمات طبية</option>


      <option value="صنايعية وفنين" @if(isset($row)) @if( $row->title == "صنايعية وفنين")
        selected
        @endif
        @endif
        >صنايعية وفنين</option>
    </select>
  </div>

</div>
 @php $input = "client_id"; @endphp
 <div class="form-group">
     <label class="col-md-2 control-label">عميل</label>
     <div class="col-md-4">
         <select name="{{ $input }}" class="form-control" required>
             @foreach ($clients as $client)
             <option value="{{$client->id}}" @if(isset($row)) @if( $row->client_id == $client->id )
                 selected
                 @endif
                 @endif
                 >{{$client->name}} </option>
             @endforeach
         </select>
     </div>
 </div> 
 @php $input = "delivery_id"; @endphp
 <div class="form-group">
     <label class="col-md-2 control-label">موظف التوصيل </label>
     <div class="col-md-4">
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
 @php $input = "status"; @endphp
 <div class="form-group">
     <label class="col-md-2 control-label">حالة</label>
     <div class="col-md-4">
         <select name="{{ $input }}" class="form-control" required>

             <option value="1" 
             @if(isset($row) && $row->status ==1 )   selected
              @endif>طلب جديد</option>
             <option value="2"   @if(isset($row) && $row->status ==2 )   selected
              @endif>تحت التنفيذ</option>
             <option value="3"   @if(isset($row) && $row->status ==3 )   selected
              @endif>تم الانتهاء</option>
             <option value="4"    @if(isset($row) && $row->status ==4 )   selected
              @endif>تحت التوصيل</option>
             <option value="5"   @if(isset($row) && $row->status ==5 )   selected
              @endif>تم التوصيل</option>

           
         </select>
     </div>
 </div> 
 @php $input = "price"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label"> السعر</label>
     <div class="col-lg-4">
         <input type="number" name="{{ $input }}"   @if(isset($row)) value="{{$row->$input}}" @else
         value="{{Request::old($input)}}" @endif
           class="form-control" required>
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>   
  
 @php $input = "delivery_price"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label"> سعر الديلفري</label>
     <div class="col-lg-4">
         <input type="number" name="{{ $input }}"   @if(isset($row)) value="{{$row->$input}}" @else
         value="{{Request::old($input)}}" @endif
           class="form-control" required>
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>   
 @php $input = "phone"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label"> الهاتف البديل</label>
     <div class="col-lg-4">
         <input type="text" name="{{ $input }}"   @if(isset($row)) value="{{$row->$input}}" @else
         value="{{Request::old($input)}}" @endif
           class="form-control">
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>   

 @php $input = "address"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label"> العنوان البديل</label>
     <div class="col-lg-4">
         <input type="text" name="{{ $input }}"   @if(isset($row)) value="{{$row->$input}}" @else
         value="{{Request::old($input)}}" @endif
           class="form-control">
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>   

 
 @php $input = "description"; @endphp
 <div class="form-group">
    <label class="col-lg-2 control-label"> الوصف</label>
     <div class="col-lg-10">
         {{-- <input type="text" name="{{ $input }}"   
         value="{{Request::old($input)}}"
           class="form-control"> --}}
           <textarea name="{{ $input }}" rows="10" cols="50">@if(isset($row)) {{$row->$input}}  @endif</textarea>
           @error($input)
           <div class="alert alert-danger" role="alert" style="text-align: center">
            <strong>{{ $message }}</strong>
          </div>
           @enderror
    </div>
 </div>  
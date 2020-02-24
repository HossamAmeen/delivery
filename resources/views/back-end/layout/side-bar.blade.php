<section id="left-navigation">
    <!--Left navigation user details start-->
    <div class="user-image">
        <img src="{{asset('panel/assets/images/demo/avatar-80.png')}}" alt=""/>
        <div class="user-online-status"><span class="user-status is-online  "></span> </div>
    </div>
    <ul class="social-icon">
        {{-- <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-github"></i></a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-bitbucket"></i></a></li> --}}
    </ul>
    <!--Left navigation user details end-->

    <!--Phone Navigation Menu icon start-->
    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="index.html" title="">
            <h1>baseProject</h1>
        </a>
        <a class="phone-nav-control" href="javascript:void(0)">
            <span class="fa fa-bars"></span>
        </a>
        <div class="clearfix"></div>
    </div>

    <!--Phone Navigation Menu icon start-->

    <!--Left navigation start-->
 <!--Left navigation start-->
    <ul class="mainNav">
        <li >
            <a href="{{route('configrations.edit' , ['id' => '1'])}}" class="{{is_active('configrations')}}">
                    <i class="fas fa-edit"></i><span>تعديل بيانات الموقع</span>
            </a>
        </li>

        @if( Auth::user()->role == 1 )
        <li>
            <a href="{{route('users.index')}}" class="{{is_active('users')}}">
                <i class="fa fa-group"></i><span>المستخدمين</span>
            </a>
        </li>
        @endif
        <li>
            <a href="{{route('users.edit' , ['id' => Auth::user()->id])}}" class="{{edit_profle_is_active('users')}}">
                <i class="fas fa-edit"></i><span>تعديل بيانات الحساب</span>
            </a>
        </li>
      
        <li class="{{is_active('clients')}}">
            <a href="{{route('clients.index')}}"  class="{{is_active('clients')}}">
                    <i class="far fa-newspaper"></i><span>العملاء</span>
            </a>

        </li>

        <li class="{{is_active('deliveries')}}">
            <a href="{{route('deliveries.index')}}"  class="{{is_active('deliveries')}}">
                    <i class="far fa-newspaper"></i><span>موظفين التوصيل</span>
            </a>

        </li>
        {{-- <li class="{{is_active('show-orders')}}">
            <a href="{{url('admin/show-orders/1')}}"  class="{{is_active('show-orders')}}">
                    <i class="far fa-newspaper"></i><span>الطلبات</span>
            </a>

        </li> --}}

        <li class="{{is_active('show-orders')}}">
            <a  href="#"  class="{{is_active('show-orders')}}">
                <i class="fa fa-bar-chart-o"></i> <span>الطلبات</span>
            </a>
            <ul   >
                <li>
                    <a  href="{{url('admin/show-orders/1')}}" @if(isset($status) && $status == 1) class="active" @endif>الطلبات جديده </a>
                </li>
                <li>
                    <a  href="{{url('admin/show-orders/2')}}" @if(isset($status) && $status == 2) class="active" @endif> الطلبات تحت التنفيذ </a>
                </li>
                <li>
                    <a  href="{{url('admin/show-orders/3')}}" @if(isset($status) && $status == 3) class="active" @endif> الطلبات تم الانتهاء </a>
                </li>
                <li>
                    <a  href="{{url('admin/show-orders/4')}}" @if(isset($status) && $status == 4) class="active" @endif> الطلبات تحت التوصيل </a>
                </li>
                <li>
                    <a  href="{{url('admin/show-orders/5')}}" @if(isset($status) && $status == 5) class="active" @endif> الطلبات تم التوصيل </a>
                </li>

            </ul>
        </li>


        <li class="{{is_active('offers')}}">
            <a href="{{route('offers.index')}}"  class="{{is_active('offers')}}">
                    <i class="far fa-newspaper"></i><span>العروض</span>
            </a>

        </li>
        
        <li class="{{is_active('services')}}">
            <a href="{{route('services.index')}}"  class="{{is_active('services')}}">
                    <i class="far fa-newspaper"></i><span>الخدمات</span>
            </a>

        </li>
        <li class="{{is_active('pricelists')}}">
            <a href="{{route('pricelists.index')}}"  class="{{is_active('pricelists')}}">
                    <i class="far fa-newspaper"></i><span>قائمه الاسعار</span>
            </a>

        </li>
        <li class="{{is_active('attendces')}}">
            <a href="{{route('attendces.index')}}"  class="{{is_active('attendces')}}">
                    <i class="far fa-newspaper"></i><span>الحضور</span>
            </a>
        </li>
        
        <li class="{{is_active('complaints')}}">
            <a href="{{route('complaints.index')}}"  class="{{is_active('complaints')}}">
                    <i class="far fa-newspaper"></i><span>الشكاوي</span>
            </a>

        </li>
        <li class="{{is_active('sanctions')}}">
            <a href="{{route('sanctions.index')}}"  class="{{is_active('sanctions')}}">
                    <i class="far fa-newspaper"></i><span>الخصومات</span>
            </a>

        </li>

        <li class="{{is_active('accounts')}}">
            <a href="{{route('accounts.index')}}"  class="{{is_active('accounts')}}">
                    <i class="far fa-newspaper"></i><span>الحسابات </span>
            </a>

        </li>
        <li class="{{is_active('dailyaccounts')}}">
            <a href="{{route('dailyaccounts.index')}}"  class="{{is_active('dailyaccounts')}}">
                    <i class="far fa-newspaper"></i><span>المصروفات اليومية</span>
            </a>

        </li>
       
        {{-- <li class="{{is_active('questions')}}">
            <a href="{{route('questions.index')}}"  class="{{is_active('questions')}}">
                    <i class="fa fa-question"></i><span>الأسئله الشائعه</span>
            </a>

        </li> --}}

        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">


             <i class="fa fa-power-off"></i><span>تسجيل الخروج</span>
            </a>

        </li>
    </ul>
    <!--Left navigation end-->
</section>

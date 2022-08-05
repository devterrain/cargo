<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">الصفحة الرئيسية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . $page='home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                    </svg>
                    <span class="side-menu__label">الرئيسية</span></a>
            </li>
            <li class="side-item side-item-category">العمليات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/>
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                    </svg>
                    <span class="side-menu__label">عمليات البضائع</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('إضافة رحلة سفينة')
                        <li><a class="slide-item" href="{{ url('/' . $page='shiptrip') }}">إضافة رحلة سفينة</a></li>
                    @endcan
                    @can('إضافة رقم افراج')
                        <li><a class="slide-item" href="{{ url('/' . $page='release') }}">رقم افراج</a></li>
                    @endcan
                    @can('تحرير بوليصة شحن')
                        <li><a class="slide-item" href="{{ url('/' . $page='policy') }}">تحرير بوليصة شحن</a></li>
                    @endcan
                    @can('عمليات نقل البضائع')
                        <li><a class="slide-item" href="{{ url('/' . $page='policydetail') }}">الوزن القائم</a>
                        </li>
                    @endcan
                    @can('انتظار التخزين')
                        <li><a class="slide-item" href="{{ url('/' . $page='storage') }}">إنتظار تخزين</a></li>
                    @endcan
                    @can('انهاء التخزين')
                        <li><a class="slide-item" href="{{ url('/' . $page='endstorage') }}">إنهاء التخزين</a></li>
                    @endcan
                    @can('الوزن الفارغ')
                        <li><a class="slide-item" href="{{ url('/' . $page='secondscale') }}">الوزن الفارغ</a></li>
                    @endcan
                    @can('نقل من المخزن إلى الرصيف')
                        <li><a class="slide-item" href="{{ url('/' . $page='outgoing') }}">نقل من مخزن إلى الرصيف</a>
                        </li>
                    @endcan
                    @can('عمليات الشحن')
                        <li><a class="slide-item" href="{{ url('/' . $page='shipping') }}">عمليات شحن السفن</a></li>
                    @endcan
                    @can('عمليات الشحن قيد التنفيذ')
                        <li><a class="slide-item" href="{{ url('/' . $page='underway') }}">عمليات الشحن قيد التنفيذ</a>
                        </li>
                    @endcan
                    @can('نقل من مخزن إلى مخزن')
                        <li><a class="slide-item" href="{{ url('/' . $page='inbetween') }}">نقل من مخزن إلى مخزن</a>
                        </li>
                    @endcan
                    @can('نقل من مخزن إلى مخزن')
                        <li><a class="slide-item" href="{{ url('/' . $page='terminal') }}">انهاء تخزين بضاعة من مخزن
                                اخر</a>
                        </li>
                    @endcan
                    @can('إعداد الدرافت')
                        <li><a class="slide-item" href="{{ url('/' . $page='draft') }}">إعداد الدرافت</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="side-item side-item-category">الإعدادات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path
                            d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z"
                            opacity=".3"/>
                        <path
                            d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/>
                        <circle cx="6.5" cy="11.5" r="1.5"/>
                        <circle cx="9.5" cy="7.5" r="1.5"/>
                        <circle cx="14.5" cy="7.5" r="1.5"/>
                        <circle cx="17.5" cy="11.5" r="1.5"/>
                    </svg>

                    <span class="side-menu__label">الإعدادات</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('إضافة سيارات')
                        <li><a class="slide-item" href="{{ url('/' . $page='vehicle') }}">إضافة سيارات</a></li>
                    @endcan
                    @can('إضافة مقطورات')
                        <li><a class="slide-item" href="{{ url('/' . $page='trailer') }}">إضافة مقطورات</a></li>
                    @endcan
                    @can('إضافة سائقين')
                        <li><a class="slide-item" href="{{ url('/' . $page='driver') }}">إضافة سائقين</a></li>
                    @endcan
                    @can('إضافة مشغلين معدات')
                        <li><a class="slide-item" href="{{ url('/' . $page='operator') }}">إضافة مشغل معدة</a></li>
                    @endcan
                    @can('إضافة صنف')
                        <li><a class="slide-item" href="{{ url('/' . $page='category') }}">إضافة صنف</a></li>
                    @endcan
                    @can('إضافة منتج')
                        <li><a class="slide-item" href="{{ url('/' . $page='product') }}">إضافة منتج</a></li>
                    @endcan
                    @can('إضافة بضائع')
                        <li><a class="slide-item" href="{{ url('/' . $page='cargo') }}">إضافة بضائع</a></li>
                    @endcan
                    @can('إضافة موانئ شحن')
                        <li><a class="slide-item" href="{{ url('/' . $page='port') }}">إضافة موانئ </a></li>
                    @endcan
                    @can('إضافة أرصفة ارساء')
                        <li><a class="slide-item" href="{{ url('/' . $page='dock') }}">إضافة أرصفة تحميل</a></li>
                    @endcan
                    @can('إضافة مصانع وجهات تحميل')
                        <li><a class="slide-item" href="{{ url('/' . $page='origin') }}">إضافة مصانع وجهات تحميل</a>
                        </li>
                    @endcan
                    @can('إضافة وجهات وصول')
                        <li><a class="slide-item" href="{{ url('/' . $page='destination') }}">إضافة وجهات وصول</a></li>
                    @endcan
                    @can('إضافة مخازن')
                        <li><a class="slide-item" href="{{ url('/' . $page='store') }}">إضافة مخازن</a></li>
                    @endcan
                    @can('إضافة سفينة')
                        <li><a class="slide-item" href="{{ url('/' . $page='ship') }}">إضافة سفينة</a></li>
                    @endcan
                    @can('إضافة معدات تحميل')
                        <li><a class="slide-item" href="{{ url('/' . $page='loader') }}">معدات شحن وتفريغ</a></li>
                    @endcan
                    @can('إضافة سيور رفع')
                        <li><a class="slide-item" href="{{ url('/' . $page='convair') }}">إضافة سيور رفع</a></li>
                    @endcan
                    @can('إضافة مقاول نقل')
                        <li><a class="slide-item" href="{{ url('/' . $page='contractor') }}">إضافة مقاول نقل</a></li>
                    @endcan
                    @can('إضافة مقاول شحن')
                        <li><a class="slide-item" href="{{ url('/' . $page='shipingcontractor') }}">إضافة مقاول شحن</a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('المستخدمين')
                <li class="side-item side-item-category">المستخدمين</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>

                        <span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                    @endcan
                    <ul class="slide-menu">
                        @can('قائمة المستخدمين')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين</a>
                            </li>
                        @endcan
                        @can('صلاحيات المستخدمين')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'roles')) }}">صلاحيات المستخدمين</a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('عرض تقارير')
                    <li class="side-item side-item-category">التقارير</li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"/>
                                <path
                                    d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                            </svg>
                            <span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page='transported') }}">تقارير عمليات النقل من
                                    المصانع</a>
                            </li>
                            <li><a class="slide-item" href="{{ url('/' . $page='storagereport') }}">تقارير عمليات
                                    التخزين</a>
                            </li>
                            <li><a class="slide-item" href="{{ url('/' . $page='shippingreport') }}">تقارير عمليات
                                    شحن السفن</a>
                            </li>
                        </ul>
                    </li>
                @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
        @if($role == 'Super Admin' || $role == 'Super_Admin')
        <li class="@yield('user-management') treeview">
            <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li class="@yield('user-mobile')"><a href="{{asset('user-mobile')}}"><i class="fa fa-circle-o"></i> User Mobile</a></li>
            <li class="@yield('user-cms')"><a href="{{asset('user-cms')}}"><i class="fa fa-circle-o"></i> User CMS</a></li>
            <li class="@yield('role-management')"><a href="{{asset('role-management')}}"><i class="fa fa-circle-o"></i> Role Management</a></li>
            <li class="@yield('acc-yes-migration')"><a href="{{asset('acc-yes-migration')}}"><i class="fa fa-circle-o"></i> ACCYes Migration</a></li>
            </ul>
        </li>

            <li class="@yield('account-verification') treeview">
                <a href="#">
                <i class="fa fa-check-square"></i> <span>Account Verification</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('pending')"><a href="{{ asset('pending') }}"><i class="fa fa-circle-o"></i> Pending List</a></li>
                <li class="@yield('approve')"><a href="{{ asset('approve') }}"><i class="fa fa-circle-o"></i> Approve List</a></li>
                <li class="@yield('rejected')"><a href="{{ asset('rejected') }}"><i class="fa fa-circle-o"></i> Rejected List</a></li>
                </ul>
            </li>
        
            <li class="@yield('master-management') treeview">
                <a href="#">
                <i class="fa fa-sitemap"></i> <span>Master Management</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('master-gcm')"><a href="{{asset('master-gcm')}}"><i class="fa fa-circle-o"></i> Master GCM</a></li>
                <li class="@yield('master-kota')"><a href="{{asset('master-kota')}}"><i class="fa fa-circle-o"></i> Master Kota</a></li>
                <li class="@yield('master-searching')"><a href="{{asset('master-searching')}}"><i class="fa fa-circle-o"></i> Master Searching</a></li>
                <li class="@yield('master-otr')"><a href="{{asset('master-otr')}}"><i class="fa fa-circle-o"></i> Master OTR</a></li>
                <li class="@yield('master-holiday')"><a href="{{ asset('holiday-gcm') }}"><i class="fa fa-circle-o"></i> Holiday GCM</a></li>
                <li class="@yield('master-product-accone')"><a href="{{asset('master-product-accone')}}"><i class="fa fa-circle-o"></i> Master Product ACCOne</a></li>
                </ul>
            </li>

            <li class="@yield('car') treeview">
                <a href="#">
                <i class="fa fa-car"></i> <span>Car</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('new-car')"><a href="{{asset('new-car')}}"><i class="fa fa-circle-o"></i> New Car</a></li>
                <li class="@yield('lease')"><a href="{{asset('lease')}}"><i class="fa fa-circle-o"></i> Lease</a></li>
                </ul>
            </li>

            <li class="@yield('fund') treeview">
                <a href="#">
                <i class="fa fa-credit-card"></i> <span>Fund</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('trade-in')"><a href="{{asset('trade-in')}}"><i class="fa fa-circle-o"></i> Trade In</a></li>
                <li class="@yield('multipurpose')"><a href="{{asset('multipurpose')}}"><i class="fa fa-circle-o"></i> Multipurpose</a></li>
                </ul>
            </li>

            <li class="@yield('service') treeview">
                <a href="#">
                <i class="fa fa-folder-open"></i> <span>Service</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('registered-contract')"><a href="{{ asset('registered-contract') }}"><i class="fa fa-circle-o"></i> Registered Contract</a></li>
                <li class="@yield('status-pengajuan')"><a href="{{ asset('status-pengajuan-aplikasi') }}"><i class="fa fa-circle-o"></i> Status Pengajuan Aplikasi</a></li>
                </ul>
            </li>

            <li class="@yield('content-management') treeview">
                <a href="#">
                <i class="fa fa-cogs"></i> <span>Content Management</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('promo')"><a href="{{ asset('promo') }}"><i class="fa fa-circle-o"></i> Promo</a></li>
                <li class="@yield('push-notification')"><a href="{{ asset('push-notification') }}"><i class="fa fa-circle-o"></i> Push Notification</a></li>
                <li class="@yield('master-content')"><a href="{{ asset('master-content') }}"><i class="fa fa-circle-o"></i> Master Content</a></li>
                <li class="@yield('landing-page')"><a href="{{ asset('landing-page') }}"><i class="fa fa-circle-o"></i> Landing Page</a></li>
                </ul>
            </li>

            <li class="@yield('feedback') treeview">
                <a href="#">
                <i class="fa fa-comment"></i> <span>Feedback</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('product-feedback')"><a href="{{ asset('product-feedback') }}"><i class="fa fa-circle-o"></i> Product Feedback</a></li>
                <li class="@yield('bug-report')"><a href="{{ asset('bug-report') }}"><i class="fa fa-circle-o"></i> Bug Report</a></li>
                <li class="@yield('survey')"><a href="{{ asset('survey') }}"><i class="fa fa-circle-o"></i> Survey</a></li>
                </ul>
            </li>

            <li class="@yield('acc-safe') treeview">
                <a href="#">
                <i class="fa fa-bookmark"></i> <span>ACC Safe</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('master-product')"><a href="{{asset('master-product')}}"><i class="fa fa-circle-o"></i> Master Product</a></li>
                <li class="@yield('master-transaction-mobil')"><a href="{{asset('master-transaction-mobil')}}"><i class="fa fa-circle-o"></i> Master Transaction Mobil</a></li>
                <li class="@yield('data-pemegang-polis')"><a href="{{asset('data-pemegang-polis')}}"><i class="fa fa-circle-o"></i> Data Pemegang Polis</a></li>
                <li class="@yield('data-tertanggung-utama')"><a href="{{asset('data-tertanggung-utama')}}"><i class="fa fa-circle-o"></i> Data Tertanggung Utama</a></li>
                <li class="@yield('master-pernyataan')"><a href="{{asset('master-pernyataan')}}"><i class="fa fa-circle-o"></i> Master Pernyataan</a></li>
                <li class="@yield('history-pembayaran-asuransi-jiwa')"><a href="{{asset('history-pembayaran-asuransi-jiwa')}}"><i class="fa fa-circle-o"></i> History Pembayaran Asuransi Jiwa</a></li>
                </ul>
            </li>

            <li class="@yield('bank-account') treeview">
                <a href="#">
                <i class="fa fa-university"></i> <span>Bank Account</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('customer')"><a href="{{ asset('customer') }}"><i class="fa fa-circle-o"></i> Customer</a></li>
                </ul>
            </li>
            @endif
            @if($role == 'Super Admin' || $role == 'Super_Admin' || $role == 'acccash')
            <li class="@yield('acccash') treeview">
                <a href="#">
                <i class="fa fa-money"></i> <span>acccash</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li class="@yield('acccash-apply-pending')"><a href="{{ asset('acccash-apply/PENDING') }}"><i class="fa fa-circle-o"></i> Pending List <span class="h3 badge bg-blue navbar-badge">{{$countpendingacccash}}</span></a></li>
                <!-- ditaruh di dalam a setelah text Pending List <span class="badge">t</span> -->
                <li class="@yield('acccash-apply-approved')"><a href="{{ asset('acccash-apply/APPROVED') }}"><i class="fa fa-circle-o"></i> Approved List</a></li>
                <li class="@yield('acccash-apply-reject')"><a href="{{ asset('acccash-apply/REJECT') }}"><i class="fa fa-circle-o"></i> Rejected List</a></li>
                <li class="@yield('acccash-apply-historysms')"><a href="{{ asset('acccash-apply-historysms') }}"><i class="fa fa-circle-o"></i> History SMS</a></li>
                <!-- <li class="@yield('acccash-apply-plafon')"><a href="{{ asset('acccash-apply-plafon/') }}"><i class="fa fa-circle-o"></i> Broadcast Plafond</a></li> -->
                </ul>
            </li>
            @endif
            @if($role == 'Super Admin' || $role == 'Super_Admin' || $role == 'seamless' || $role == 'dataleads')
            <li class="@yield('seamless') treeview">
                <a href="#">
                <i class="fa fa-rocket"></i> <span>Seamless</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                @if($role == 'Super Admin' || $role == 'Super_Admin' || $role == 'seamless')
                <li class="@yield('seamless-unit')"><a href="{{ asset('seamless-unit') }}"><i class="fa fa-circle-o"></i> Unit</a></li>
                @endif
                @if($role == 'Super Admin' || $role == 'Super_Admin')
                <li class="@yield('seamless-product')"><a href="{{ asset('seamless-product') }}"><i class="fa fa-circle-o"></i> Product</a></li>
                <li class="@yield('seamless-banner')"><a href="{{ asset('seamless-banner') }}"><i class="fa fa-circle-o"></i> Banner</a></li>
                <li class="@yield('seamless-otr-master')"><a href="{{ asset('seamless-otr-master') }}"><i class="fa fa-circle-o"></i> OTR Upload</a></li>
                @endif
                <li class="@yield('seamless-dataleads')"><a href="{{ asset('seamless-dataleads') }}"><i class="fa fa-circle-o"></i> Data Leads</a></li>
                @if($role == 'Super Admin' || $role == 'Super_Admin')
                <li class="@yield('seamless-diskon')"><a href="{{ asset('seamless-diskon') }}"><i class="fa fa-circle-o"></i> Master Discount</a></li>           
                <li class="@yield('seamless-spbrand')"><a href="{{ asset('seamless-spbrand') }}"><i class="fa fa-circle-o"></i> List Cabang Brand</a></li>
                @endif
                </ul>
            </li>
            @endif

        {{-- <li class="header">LABELS</li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
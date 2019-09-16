<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@yield('user-management') treeview">
            <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li class="@yield('user-mobile')"><a href="#"><i class="fa fa-circle-o"></i> User Mobile</a></li>
            <li class="@yield('user-cms')"><a href="#"><i class="fa fa-circle-o"></i> User CMS</a></li>
            <li class="@yield('role-management')"><a href="#"><i class="fa fa-circle-o"></i> Role Management</a></li>
            <li class="@yield('acc-yes-migration')"><a href="#"><i class="fa fa-circle-o"></i> ACCYes Migration</a></li>
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
            <li class="@yield('pending')"><a href="{{ asset('pendinglist') }}"><i class="fa fa-circle-o"></i> Pending List</a></li>
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
            <li class="master-gcm"><a href="#"><i class="fa fa-circle-o"></i> Master GCM</a></li>
            <li class="@yield('master-kota')"><a href="#"><i class="fa fa-circle-o"></i> Master Kota</a></li>
            <li class="@yield('master-searching')"><a href="#"><i class="fa fa-circle-o"></i> Master Searching</a></li>
            <li class="@yield('master-otr')"><a href="#"><i class="fa fa-circle-o"></i> Master OTR</a></li>
            <li class="@yield('master-holiday')"><a href="#"><i class="fa fa-circle-o"></i> Holiday GCM</a></li>
            <li class="@yield('master-product-accone')"><a href="#"><i class="fa fa-circle-o"></i> Master Product ACCOne</a></li>
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
                <li class="@yield('new-car')"><a href="#"><i class="fa fa-circle-o"></i> New Car</a></li>
                <li class="@yield('lease')"><a href="#"><i class="fa fa-circle-o"></i> Lease</a></li>
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
                <li class="@yield('trade-in')"><a href="#"><i class="fa fa-circle-o"></i> Trade In</a></li>
                <li class="@yield('Multipurpose')"><a href="#"><i class="fa fa-circle-o"></i> Multipurpose</a></li>
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
                <li class="@yield('registered-contract')"><a href="#"><i class="fa fa-circle-o"></i> Registered Contract</a></li>
                <li class="@yield('status-pengajuan-aplikasi')"><a href="#"><i class="fa fa-circle-o"></i> Ststus Pengajuan Aplikasi</a></li>
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
                <li class="@yield('promo')"><a href="#"><i class="fa fa-circle-o"></i> Promo</a></li>
                <li class="@yield('push-notification')"><a href="#"><i class="fa fa-circle-o"></i> Push Notification</a></li>
                <li class="@yield('master-content')"><a href="#"><i class="fa fa-circle-o"></i> Master Content</a></li>
                <li class="@yield('landing-page')"><a href="#"><i class="fa fa-circle-o"></i> Landing Page</a></li>
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
                <li class="@yield('bug-report')"><a href="#"><i class="fa fa-circle-o"></i> Bug Report</a></li>
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
                <li class="@yield('master-product')"><a href="#"><i class="fa fa-circle-o"></i> Master Product</a></li>
                <li class="@yield('master-transaction-mobil')"><a href="#"><i class="fa fa-circle-o"></i> Master Transaction Mobil</a></li>
                <li class="@yield('data-pemegang-polis')"><a href="#"><i class="fa fa-circle-o"></i> Data Pemegang Polis</a></li>
                <li class="@yield('data-tertanggung-utama')"><a href="#"><i class="fa fa-circle-o"></i> Data Tertanggung Utama</a></li>
                <li class="@yield('master-pernyataan')"><a href="#"><i class="fa fa-circle-o"></i> Master Pernyataan</a></li>
                <li class="@yield('history-pembayaran-asuransi-jiwa')"><a href="#"><i class="fa fa-circle-o"></i> History Pembayaran Asuransi Jiwa</a></li>
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

        {{-- <li class="header">LABELS</li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
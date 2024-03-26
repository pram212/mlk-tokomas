<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <div class="navbar-header">

                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <li class="nav-item"><a id="btnFullscreen" title="Full Screen"><i
                                    class="dripicons-expand"></i></a></li>
                        @php
                            $general_setting_permission = DB::table('permissions')
                                ->where('name', 'general_setting')
                                ->first();
                            $general_setting_permission_active = DB::table('role_has_permissions')
                                ->where([
                                    ['permission_id', $general_setting_permission->id],
                                    ['role_id', Auth::user()->role_id],
                                ])
                                ->first();

                            $pos_setting_permission = DB::table('permissions')->where('name', 'pos_setting')->first();

                            $pos_setting_permission_active = DB::table('role_has_permissions')
                                ->where([
                                    ['permission_id', $pos_setting_permission->id],
                                    ['role_id', Auth::user()->role_id],
                                ])
                                ->first();
                        @endphp

                        @if ($pos_setting_permission_active)
                            <li class="nav-item"><a class="dropdown-item" href="{{ route('setting.pos') }}"
                                    title="{{ trans('file.POS Setting') }}"><i class="dripicons-gear"></i></a> </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('sales.printLastReciept') }}"
                                title="{{ trans('file.Print Last Reciept') }}"><i class="dripicons-print"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="" id="register-details-btn"
                                title="{{ trans('file.Cash Register Details') }}"><i
                                    class="dripicons-briefcase"></i></a>
                        </li>
                        <?php
                        $today_sale_permission = DB::table('permissions')->where('name', 'today_sale')->first();
                        $today_sale_permission_active = DB::table('role_has_permissions')
                            ->where([['permission_id', $today_sale_permission->id], ['role_id', Auth::user()->role_id]])
                            ->first();
                        
                        $today_profit_permission = DB::table('permissions')->where('name', 'today_profit')->first();
                        $today_profit_permission_active = DB::table('role_has_permissions')
                            ->where([['permission_id', $today_profit_permission->id], ['role_id', Auth::user()->role_id]])
                            ->first();
                        ?>

                        @if ($today_sale_permission_active)
                            <li class="nav-item">
                                <a href="" id="today-sale-btn" title="{{ trans('file.Today Sale') }}"><i
                                        class="dripicons-shopping-bag"></i></a>
                            </li>
                        @endif
                        @if ($today_profit_permission_active)
                            <li class="nav-item">
                                <a href="" id="today-profit-btn" title="{{ trans('file.Today Profit') }}"><i
                                        class="dripicons-graph-line"></i></a>
                            </li>
                        @endif
                        @if ($alert_product + count(\Auth::user()->unreadNotifications) > 0)
                            <li class="nav-item" id="notification-icon">
                                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i
                                        class="dripicons-bell"></i><span
                                        class="badge badge-danger notification-number">{{ $alert_product + count(\Auth::user()->unreadNotifications) }}</span>
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </a>
                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications"
                                    user="menu">
                                    <li class="notifications">
                                        <a href="{{ route('report.qtyAlert') }}"
                                            class="btn btn-link">{{ $alert_product }} product exceeds alert quantity</a>
                                    </li>
                                    @foreach (\Auth::user()->unreadNotifications as $key => $notification)
                                        <li class="notifications">
                                            <a href="#"
                                                class="btn btn-link">{{ $notification->data['message'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ url('read_me') }}" target="_blank"><i
                                    class="dripicons-information"></i> {{ trans('file.Help') }}</a>
                        </li>&nbsp;
                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i>
                                <span>{{ ucfirst(Auth::user()->name) }}</span> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="{{ route('user.profile', ['id' => Auth::id()]) }}"><i
                                            class="dripicons-user"></i> {{ trans('file.profile') }}</a>
                                </li>
                                @if ($general_setting_permission_active)
                                    <li>
                                        <a href="{{ route('setting.general') }}"><i class="dripicons-gear"></i>
                                            {{ trans('file.settings') }}</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('my-transactions/' . date('Y') . '/' . date('m')) }}"><i
                                            class="dripicons-swap"></i> {{ trans('file.My Transaction') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('holidays/my-holiday/' . date('Y') . '/' . date('m')) }}"><i
                                            class="dripicons-vibrate"></i> {{ trans('file.My Holiday') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i
                                            class="dripicons-power"></i>
                                        {{ trans('file.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
</header>

<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <span class="brand-big">
                    @if ($general_setting->site_logo)
                    <img src="{{ asset($general_setting->site_logo) }}" width="50">&nbsp;&nbsp;
                    @endif
                    <a href="{{ url('/') }}">
                        <h1 class="d-inline">{{ $general_setting->site_title }}</h1>
                    </a>
                </span>

                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    @can('create', App\Sale::class)
                    <li class="nav-item">
                        <a class="dropdown-item btn-pos btn-sm" href="{{ route('sales.pos') }}">
                            <i class="dripicons-shopping-bag"></i><span>POS</span>
                        </a>
                    </li>
                    @endcan

                    <li class="nav-item"><a id="btnFullscreen"><i class="dripicons-expand"></i></a></li>
                    @if (\Auth::user()->role_id <= 2) <li class="nav-item">
                        <a href="{{ route('cash-register.index') }}" title="{{ trans('file.Cash Register List') }}">
                            <i class="dripicons-archive"></i>
                        </a>
                        </li>
                        @endif

                        @can('report', App\Product::class)
                        @if ($alert_product + count(\Auth::user()->unreadNotifications) > 0)
                        <li class="nav-item" id="notification-icon">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span
                                    class="badge badge-danger notification-number">{{ $alert_product +
                                    count(\Auth::user()->unreadNotifications) }}</span>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications"
                                user="menu">
                                <li class="notifications">
                                    <a href="{{ route('report.qtyAlert') }}" class="btn btn-link">
                                        {{ $alert_product }} product exceeds alert quantity</a>
                                </li>
                                @foreach (\Auth::user()->unreadNotifications as $key => $notification)
                                <li class="notifications">
                                    <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @elseif(count(\Auth::user()->unreadNotifications) > 0)
                        <li class="nav-item" id="notification-icon">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span
                                    class="badge badge-danger notification-number">{{
                                    count(\Auth::user()->unreadNotifications) }}</span>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications"
                                user="menu">
                                @foreach (\Auth::user()->unreadNotifications as $key => $notification)
                                <li class="notifications">
                                    <a href="#" class="btn btn-link">{{ $notification->data['message'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endcan

                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-web"></i>
                                <span>{{ __('file.language') }}</span> <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a>
                                </li>
                                <li>
                                    <a href="{{ url('language_switch/id') }}" class="btn btn-link"> Indonesia</a>
                                </li>
                            </ul>
                        </li>
                        @if (Auth::user()->role_id != 5)
                        {{-- <li class="nav-item">
                            <a class="dropdown-item" href="{{ url('help') }}" target="_blank"><i
                                    class="dripicons-information"></i> {{ trans('file.Help') }}</a>
                        </li> --}}
                        @endif
                        <li class="nav-item">
                            <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i>
                                <span>{{ ucfirst(Auth::user()->name) }}</span> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="{{ route('user.profile', ['id' => Auth::id()]) }}">
                                        <i class="dripicons-user"></i> {{ trans('file.profile') }}
                                    </a>
                                </li>

                                @can('viewAny', App\GeneralSetting::class)
                                <li>
                                    <a href="{{ route('setting.general') }}">
                                        <i class="dripicons-gear"></i>{{ trans('file.settings') }}
                                    </a>
                                </li>
                                @endcan
                                <li>
                                    <a href="{{ url('my-transactions/' . date('Y') . '/' . date('m')) }}">
                                        <i class="dripicons-swap"></i> {{ trans('file.My Transaction') }}
                                    </a>
                                </li>
                                @if (Auth::user()->role_id != 5)
                                <li>
                                    <a href="{{ url('holidays/my-holiday/' . date('Y') . '/' . date('m')) }}">
                                        <i class="dripicons-vibrate"></i> {{ trans('file.My Holiday') }}
                                    </a>
                                </li>
                                @endif

                                @can('emptyDatabase')
                                <li>
                                    <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')"
                                        href="{{ route('setting.emptyDatabase') }}"><i class="dripicons-stack"></i> {{
                                        trans('file.Empty Database') }}</a>
                                </li>
                                @endcan

                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
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
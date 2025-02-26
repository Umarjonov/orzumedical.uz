<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <h3><b>{{ config('app.name', 'OrzuMedical') }}</b></h3>
        </a>
        <div class="dropdown justify-content-center d-md-none">
            <a href="#" class="btn btn-default dropdown-toggle p-1" data-toggle="dropdown" id="navbarDropdownMenuLink2">
                <img src="{{ asset('assets/img/icons/'.App::getLocale('locale').'.png') }}"
                     class="flag-icon"/> {{ strtoupper(App::getLocale('locale')) }}
            </a>
            <ul class="dropdown-menu" style="min-width: 5rem !important;max-width: 15rem !important;" aria-labelledby="navbarDropdownMenuLink2">
                <li>
                    <a class="dropdown-item" href="/language/ru">
                        <img src="{{ asset('assets/img/icons/ru.png') }}" class="flag-icon"/> RU
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/language/uz">
                        <img src="{{ asset('assets/img/icons/uz.png') }}" class="flag-icon"/> UZ
                    </a>
                </li>
            </ul>
        </div>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            {{ config('app.name', 'OrzuMedical') }}
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                           placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> @lang('global.home')
                    </a>
                </li>
                @can('branch.show')
                    <li class="nav-item">
                        <a href="{{ route('branches.index') }}" class="nav-link {{ Request::is('branches*') ? "active":'' }}">
                            <i class="nav-icon fas fa-store"></i>
                            <span class="nav-link-text">@lang('base.branch')</span>
                        </a>
                    </li>
                @endcan
                @can('videos.show')
                    <li class="nav-item">
                        <a href="{{ route('videos.index') }}" class="nav-link {{ Request::is('videos*') ? "active":'' }}">
                            <i class="nav-icon fas fa-video"></i>
                            <span class="nav-link-text">@lang('base.video.title')</span>
                        </a>
                    </li>
                @endcan
                @can('call_back.show')
                    <li class="nav-item">
                        <a href="{{ route('call_backs.index') }}" class="nav-link {{ Request::is('call_backs*') ? "active":'' }}">
                            <i class="nav-icon fas fa-phone"></i>
                            <span class="nav-link-text">@lang('base.call_back')</span>
                        </a>
                    </li>
                @endcan

                @can('language.show')
                    <li class="nav-item">
                        <a href="{{ route('languages.index') }}" class="nav-link {{ Request::is('tools/languages*') ? "active":'' }}">
                            <i class="nav-icon fas fa-language"></i>
                            <span class="nav-link-text">@lang('base.local.title')</span>
                        </a>
                    </li>
                @endcan
                @canany([
                    'permission.show',
                    'roles.show',
                    'user.show'
                ])
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''}}" href="#navbar-examples" data-toggle="collapse" role="button"
                           aria-expanded="true" aria-controls="navbar-examples">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <span class="nav-link-text">@lang('cruds.userManagement.title')</span>
                        </a>

                        <div class="collapse {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'show':''}}" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                @can('user.index')
                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user*') ? "active":'' }}">
                                            <i class="nav-icon fas fa-user-friends"></i> @lang('cruds.user.title')
                                        </a>
                                    </li>
                                @endcan
                                @can('roles.show')
                                    <li class="nav-item">
                                        <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? "active":'' }}">
                                            <i class="nav-icon fas fa-user-lock"></i> @lang('cruds.role.fields.roles')
                                        </a>
                                    </li>
                                @endcan
                                @can('permissions.show')
                                    <li class="nav-item">
                                        <a href="{{ route('permissions.index') }}" class="nav-link {{ Request::is('permission*') ? "active":'' }}">
                                            <i class="nav-icon fas fa-key"></i> @lang('cruds.permission.title_singular')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
            </ul>
        </div>
    </div>
</nav>


<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo" src="{{ asset('../assets/media/logos/logo-6-sm.png') }}" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <div class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler">
            <span></span>
        </div>
        <div class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler">
            <span></span>
        </div>
        <div class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler">
            <i class="flaticon-more"></i>
        </div>
    </div>
</div>

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                    <ul class="kt-menu__nav ">

                        <li class="{{ Request::url() == route('admin.dashboard') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item" aria-haspopup="true">
                            <a href="{{ route('venue.dashboard') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-protection"></i>
                                <span class="kt-menu__link-text">Dashboard</span>
                            </a>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </div>
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">
                <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
                    <div class="kt-header__brand-logo">
                        <a href="index.html">
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo-6.png') }}" />
                        </a>
                    </div>
                </div>
                <h3 class="kt-header__title kt-grid__item">
                    Wedding Cluster
                </h3>
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                        
                    </div>
                </div>

                <div class="kt-header__topbar">
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                            {{-- <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                            <span class="kt-hidden kt-header__topbar-username">Nick</span> --}}
                            <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_21.jpg')}}" />
                            <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg')}})">

                                <?php $user_char = ucfirst(substr(Session::get('venue_name'), 0, 1)); ?>
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg')}}" />
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ $user_char }}</span>
                                </div>
                                <div class="kt-user-card__name">
                                    {{ Session::get('venue_name')}}
                                </div>
                            </div>


                            <div class="kt-notification">
                                <a href="{{ route('venue.edit.prifle',Session::get('venue_id')) }}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Profile
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('venue.change.password',Session::get('venue_id')) }}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon-lock kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Change Password
                                        </div>
                                    </div>
                                </a>
                                <div class="kt-notification__custom kt-space-between">
                                    <a href="{{ route('venue.logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

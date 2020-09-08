<?php
$module_data = DB::table('module_child as mc')
                ->Join('module_master as mm', 'mm.id', '=', 'mc.module_master_id')
                ->where('mc.role_id', Session::get('role_id'))
                ->where('mc.status', 1)
                ->get()->toArray();

// echo '<pre>';
// print_r($module_data);

$old_mod_name = '';
$all_module_permissions = array();
foreach ($module_data as $key => $module) {

    if ($old_mod_name == '' || $old_mod_name != $module->module_name) {
        $all_module_permissions[$module->module_name] = array();
    }
    if ($module->action_name == 'show') {
        $all_module_permissions[$module->module_name] = array('show_module' => $module->status);
    }
    $old_mod_name = $module->module_name;
}
// print_r($all_module_permissions);
// return;
?>


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
                            <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-protection"></i>
                                <span class="kt-menu__link-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="{{ Request::url() == route('admin.list.roles') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('admin.list.roles') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon-user-settings">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Roles</span>
                            </a>
                        </li>

                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Master</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Master</span></li>

                                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Venue Settings</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                        </a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ route('admin.masters.venue-settings.facility-charges') }}" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="kt-menu__link-text">Facility Charges</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ route('admin.masters.venue-settings.venue-type-and-charges') }}" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="kt-menu__link-text">Venue Type & Charges</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                <span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Lead</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                        </a>
                                        <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ route('admin.master.event-type') }}" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="kt-menu__link-text">Event type</span>
                                                    </a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true">
                                                    <a href="{{ route('admin.master.presentation-status') }}" class="kt-menu__link ">
                                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="kt-menu__link-text">Presentation Status</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                                                        <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Edit</span></a></li> -->
                                </ul>
                            </div>
                        </li>
                        
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-rotate"></i><span class="kt-menu__link-text">BSM & CSM</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.bsm') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">BSM</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.csm') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">CSM</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <?php
                        if (isset($all_module_permissions['users']['show_module'])) {
                            ?>
                            <li class="{{ Request::url() == route('admin.list.users') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item " aria-haspopup="true">
                                <a href="{{ route('admin.list.users') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon flaticon-users-1">
                                        <span></span>
                                    </i>
                                    <span class="kt-menu__link-text">Users</span>
                                </a>
                            </li>
                        <?php } if (isset($all_module_permissions['venue']['show_module'])) { ?>
                            <li class="{{ Request::url() == route('admin.list.venue') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item " aria-haspopup="true">
                                <a href="{{ route('admin.list.venue') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-icon flaticon2-list-3">
                                        <span></span>
                                    </i>
                                    <span class="kt-menu__link-text">Venue</span>
                                </a>
                            </li>
                        <?php } ?>


                        <li class="{{ Request::url() == route('admin.venue-settings.list') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item " aria-haspopup="true">
                            <a href="{{ route('admin.venue-settings.list') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-list-3">
                                    <span></span>
                                </i>
                                <span class="kt-menu__link-text">Venue Settings</span>
                            </a>
                        </li>


                        <!-- <li class=" {{ Request::url() == route('admin.list.venue') || Request::url() ==  route('admin.create.venue')  ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <i class="kt-menu__link-icon flaticon2-list-3"></i>
                                        <span class="kt-menu__link-text">Manage Venues</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu ">
                                        <span class="kt-menu__arrow"></span>
                                        <ul class="kt-menu__subnav">

                                                

                                                <li class="{{ Request::url() == route('admin.create.venue') ? 'kt-menu__item--submenu kt-menu__item--active' : '' }} kt-menu__item " aria-haspopup="true">
                                                        <a href="{{ route('admin.create.venue') }}" class="kt-menu__link ">
                                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
                                                                        <span></span>
                                                                </i>
                                                                <span class="kt-menu__link-text">Create Venue</span>
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
                        </li> -->


                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-download-1"></i><span class="kt-menu__link-text">Lead</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.lead.leads') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Leads</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.lead.quotation') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Quotation</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.lead.follow-up') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Follow Up</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.lead.feedback') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Feedback</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.lead.payment-status') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Payment Status</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-download-1"></i><span class="kt-menu__link-text">Service</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.service.services') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Service</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-download-1"></i><span class="kt-menu__link-text">Vendor</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.vendor.vendors') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Vendors</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-calendar-5"></i><span class="kt-menu__link-text">Venue Booking</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.venue-booking.venue-book') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Venue Book</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.venue-booking.calendar') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Booking Calendar</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item " aria-haspopup="true">
                                        <a href="{{ route('admin.venue-booking.discount') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span>
                                            </i>
                                            <span class="kt-menu__link-text">Discount</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                    <span class="kt-menu__link-text">Components</span>
                                    <i class="kt-menu__hor-arrow la la-angle-down"></i>
                                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                </a>
                                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                <i class="kt-menu__link-icon flaticon2-start-up"></i>
                                                <span class="kt-menu__link-text">Base</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
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

                                <?php $user_char = ucfirst(substr(Session::get('name'), 0, 1)); ?>
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg')}}" />
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ $user_char }}</span>
                                </div>
                                <div class="kt-user-card__name">
                                    {{ ucfirst(Session::get('name') ) }}
                                </div>
                            </div>


                            <div class="kt-notification">
                                <a href="{{ route('admin.edit.prifle') }}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Profile
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('admin.change.password') }}" class="kt-notification__item">
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
                                    <a href="{{ route('admin.logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .invalid-feedback
    {
        /*color: red;*/
        font-size: 13px;
    }
</style>


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    New Venue
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
                    <span class="kt-subheader__desc" id="kt_subheader_total">
                        Fill the form to create venue</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">

                <div class="btn-group">
                    <button type="button" id="save_venue" class="btn btn-brand btn-bold">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="last">
            <!--begin: Form Wizard Nav -->
            <div class="kt-wizard-v4__nav">
                <div class="kt-wizard-v4__nav-items nav">
                    <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                1
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Venue
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    Venue Information
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                2
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Owner
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    Owner Information
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                3
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Venue Features
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    Venue Information
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                        <div class="kt-wizard-v4__nav-body">
                            <div class="kt-wizard-v4__nav-number">
                                4
                            </div>
                            <div class="kt-wizard-v4__nav-label">
                                <div class="kt-wizard-v4__nav-label-title">
                                    Venue Aminities
                                </div>
                                <div class="kt-wizard-v4__nav-label-desc">
                                    Venue Information
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end: Form Wizard Nav -->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid">
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_user_add_form" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="venue_hidden_id" id="venue_hidden_id" value="{{  $single_venue->id}}">
                                <!--begin: Form Wizard Step 1-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="">
                                    <div class="kt-heading kt-heading--md">Venue Details:</div>
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="kt-section__body">
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Name</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input type="text" class="form-control" placeholder="Venue Name" id="venue_name" name="venue_name" required="" value="{{ $single_venue->venue_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Address</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <textarea class="form-control" placeholder="Venue Address" id="venue_address" name="venue_address" rows="1" required="">{{ $single_venue->venue_address }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Email</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-at"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Venue email" id="venue_email" name="venue_email" value="{{ $single_venue->venue_email }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Password</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" placeholder="Venue Password" id="venue_password" name="venue_password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue District</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Venue District" id="venue_district" name="venue_district" required="" value="{{ $single_venue->venue_district }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Mobile</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="number" class="form-control" placeholder="Venue Mobile" id="venue_mobile" name="venue_mobile" minlength="10" maxlength="10" value="{{ $single_venue->venue_mobile }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue Type</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <select class="form-control" required="" id="venue_type" name="venue_type"> 
                                                                        <option value="">Select Venue Type</option>
                                                                        <?php
                                                                        foreach ($venu_types as $venues) {
                                                                            $selected = '';
                                                                            if ($venues->id == $single_venue->venue_type_id) {
                                                                                $selected = "selected='selected'";
                                                                            }
                                                                            ?>
                                                                            <option value="{{ $venues->id }}" {{ $selected }}>{{ $venues->venue_type }}</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group  row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">About Venue</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <textarea class="form-control" placeholder="Write something about venue" id="about_venue" name="about_venue" >{{ $single_venue->about_venue }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v4__content" data-ktwizard-type="">
                                    <div class="kt-heading kt-heading--md">Owner Details:</div>
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Owner Name</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input type="text" class="form-control" placeholder="Owner Name" id="owner_name" name="owner_name" required="" value="{{ $single_venue->owner_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Owner Email</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-at"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="email" class="form-control" placeholder="Owner email" id="owner_email" name="owner_email" required="" value="{{ $single_venue->owner_email }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Owner Mobile 1</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-phone"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Owner Mobile 1" id="owner_mobile_first" name="owner_mobile_first" required="" minlength="10" maxlength="10" value="{{ $single_venue->owner_mobile_1 }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Owner Mobile 2</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-phone"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="tel" class="form-control" placeholder="Owner Mobile 2" id="owner_mobile_second" name="owner_mobile_second" {{ $single_venue->owner_mobile_2 }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Form Wizard Step 1-->

                                <!--begin: Form Wizard Step 2-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="kt-section__body">
                                                        <div class="form-group row">
                                                            <div class="col-lg-9 col-xl-6">
                                                                <h3 class="kt-section__title kt-section__title-md">Venue Features</h3>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Recetion Capacity</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Recetion Capacity" id="recetion_capacity" name="recetion_capacity" required="" value="{{ $single_venue->recetion_capacity }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Floating Capacity</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Floating Capacity" id="floating_capacity" name="floating_capacity" required="" value="{{ $single_venue->floating_capacity }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Dinning Capacity</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Dinning Capacity" id="dinning_capacity" name="dinning_capacity" required="" value="{{ $single_venue->dinning_dapacity }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Number of Rooms</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Number of Rooms" id="number_of_rooms" name="number_of_rooms" required="" value="{{ $single_venue->number_of_rooms }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">A/c rooms</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="A/c rooms" id="ac_rooms" name="ac_rooms" required="" value="{{ $single_venue->ac_rooms }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Non A/c Rooms</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Non A/c" id="non_ac_rooms" name="non_ac_rooms" required="" value="{{ $single_venue->non_ac_rooms }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Total Area</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Total Area" id="total_area" name="total_area" required="" value="{{ $single_venue->total_area }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">No. of Chairs</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" placeholder="Number Of Chairs" id="no_of_chairs" name="no_of_chairs" required="" value="{{ $single_venue->number_of_chairs }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">LPG Gas</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <select class="form-control" id="lpg_gas" name="lpg_gas" required="">

                                                                        @if($single_venue->lpg_gas == 0)
                                                                        <option value="">Select Option</option>
                                                                        <option value="0" selected="">Not Available</option>
                                                                        <option value="1">Available</option>

                                                                        @elseif($single_venue->lpg_gas == 1)
                                                                        <option value="">Select Option</option>
                                                                        <option value="0">Not Available</option>
                                                                        <option value="1" selected="">Available</option>
                                                                        @else
                                                                        <option value="" selected="">Select Option</option>
                                                                        <option value="0">Not Available</option>
                                                                        <option value="1">Available</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Power Backup</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <select class="form-control" id="power_backup" name="power_backup" required="">
                                                                        @if($single_venue->power_backup == 0)
                                                                        <option value="">Select Option</option>
                                                                        <option value="0" selected="">Not Available</option>
                                                                        <option value="1">Available</option>

                                                                        @elseif($single_venue->power_backup == 1)
                                                                        <option value="">Select Option</option>
                                                                        <option value="0">Not Available</option>
                                                                        <option value="1" selected="">Available</option>

                                                                        @else
                                                                        <option value="" selected="">Select Option</option>
                                                                        <option value="0" >Not Available</option>
                                                                        <option value="1" >Available</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Kitchen Type</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div class="input-group">
                                                                    <select class="form-control" id="kitchen_type" name="kitchen_type" required="">

                                                                        @if($single_venue->kitchen_type == 0)

                                                                        <option value="">Select Option</option>
                                                                        <option value="0" selected="">Veg</option>
                                                                        <option value="1">Non Veg</option>
                                                                        <option value="2">Both</option>

                                                                        @elseif($single_venue->kitchen_type == 1)

                                                                        <option value="">Select Option</option>
                                                                        <option value="0" >Veg</option>
                                                                        <option value="1" selected="">Non Veg</option>
                                                                        <option value="2">Both</option>

                                                                        @elseif($single_venue->kitchen_type == 2)
                                                                        <option value="">Select Option</option>
                                                                        <option value="0" >Veg</option>
                                                                        <option value="1" >Non Veg</option>
                                                                        <option value="2" selected="">Both</option>

                                                                        @else
                                                                        <option value=""  selected="">Select Option</option>
                                                                        <option value="0" >Veg</option>
                                                                        <option value="1" >Non Veg</option>
                                                                        <option value="2" >Both</option>

                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Venue is suitable for</label>
                                                            <div class="col-lg-9 col-xl-6">
                                                                <div class="kt-checkbox-inline">
                                                                    <?php
                                                                    $selected_func_ids = explode(',', $single_venue->function_ids);
                                                                    ?>
                                                                    @foreach($all_functions as $func)
                                                                    <?php
                                                                    $checked = '';
                                                                    if (in_array($func->id, $selected_func_ids)) {
                                                                        $checked = ' checked';
                                                                    }
                                                                    ?>
                                                                    <label class="kt-checkbox">
                                                                        <input type="checkbox" {{ $checked }} name="function_type[]" id="function_type" value="{{ $func->id }}" required=""> {{ $func->function_type }}
                                                                        <span></span>
                                                                    </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2-->

                                <!--begin: Form Wizard Step 3-->
                                <div class="kt-wizard-v4__content" data-ktwizard-type="">
                                    <div class="kt-heading kt-heading--md">Venue Aminities</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Hot water avialable.?</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <select class="form-control" id="hot_water" name="hot_water" required="">

                                                            @if($single_venue->hot_water_available == 0)
                                                            <option value="">Select Option</option>
                                                            <option value="0" selected="">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @elseif($single_venue->hot_water_available == 1)
                                                            <option value="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1" selected="">Available</option>

                                                            @else
                                                            <option value="" selected="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @endif							
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Lift avialable.?</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <select class="form-control" id="lift_available" name="lift_available" required="">
                                                            @if($single_venue->lift_available == 0)
                                                            <option value="">Select Option</option>
                                                            <option value="0" selected="">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @elseif($single_venue->lift_available == 1)
                                                            <option value="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1" selected="">Available</option>

                                                            @else
                                                            <option value="" selected="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">CCTV Security.?</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <select class="form-control" id="cctv" name="cctv" required="">

                                                            @if($single_venue->cctv_available == 0)
                                                            <option value="">Select Option</option>
                                                            <option value="0" selected="">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @elseif($single_venue->cctv_available == 1)
                                                            <option value="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1" selected="">Available</option>


                                                            @else
                                                            <option value="" selected="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Jewellery locker available.?</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <select class="form-control" id="jewellery" name="jewellery" required="">

                                                            @if($single_venue->jewellery_locker_available == 0)
                                                            <option value="">Select Option</option>
                                                            <option value="0" selected="">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @elseif($single_venue->jewellery_locker_available == 1)
                                                            <option value="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1" selected="">Available</option>

                                                            @else							
                                                            <option value="" selected="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Generator Facility.?</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <select class="form-control" id="generator" name="generator" required="">

                                                            @if($single_venue->generator_facility == 0)
                                                            <option value="">Select Option</option>
                                                            <option value="0" selected="">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @elseif($single_venue->generator_facility == 1)
                                                            <option value="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1" selected="">Available</option>

                                                            @else
                                                            <option value="" selected="">Select Option</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>

                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Security Guards</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Enter number of security guards" id="security_guards" name="security_guards" required="" value="{{ $single_venue->security_guards }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Bike Parking Capacity</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Number Of Bike Parking Capacity" id="bike_parking" name="bike_parking" required="" value="{{ $single_venue->bike_parking_capacity }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Car Parking Capacity</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Number Of Car Parking Capacity" id="car_parking" name="car_parking" required="" value="{{ $single_venue->car_parking_capacity }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Toilets</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Number Of Toilets" id="toilets" name="toilets" required="" value="{{ $single_venue->toilets }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Helpers</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Number Of helpers" id="total_helpers" name="total_helpers" required="" value="{{ $single_venue->helpers }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 3-->

                                <!--begin: Form Wizard Step 4-->
                                {{-- <div class="kt-wizard-v4__content" data-ktwizard-type="" data-ktwizard-state="current">
									<div class="kt-heading kt-heading--md">Review your Details and Submit</div>
									<div class="kt-form__section kt-form__section--first">
										<div class="kt-wizard-v4__review">
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Your Account Details
												</div>
												<div class="kt-wizard-v4__review-content">
													John Wick
													<br> Phone: +61412345678
													<br> Email: johnwick@reeves.com
												</div>
											</div>
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Your Address Details
												</div>
												<div class="kt-wizard-v4__review-content">
													Address Line 1
													<br> Address Line 2
													<br> Melbourne 3000, VIC, Australia
												</div>
											</div>
											<div class="kt-wizard-v4__review-item">
												<div class="kt-wizard-v4__review-title">
													Payment Details
												</div>
												<div class="kt-wizard-v4__review-content">
													Card Number: xxxx xxxx xxxx 1111
													<br> Card Name: John Wick
													<br> Card Expiry: 01/21
												</div>
											</div>
										</div>
									</div>
								</div> --}}

							<!--end: Form Wizard Step 4-->
						{{--	<!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                    Previous
                                </div>
                                <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="save_venue" data-ktwizard-type="action-submit">
                                    Submit
                                </div>
                                <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                    Next Step
                                </div>
                            </div>
						    <!--end: Form Actions --> --}}
						</form>
						<!--end: Form Wizard Form-->
						</div>
					</div>
				</div>
			</div>
		</div>        
	</div>
    <!-- en    d:: Content -->
</div>

<scriptsrc="{{ asset('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>

    <script>
	$(document).ready(function () {

		$("#save_venue").on("click", function (e)                
	    {
	    	// alert('                test');
	    	//                 return;admin.update.venue
	        e.preventDefault();
	        if ($(".kt-form").valid())
	        {
	            $.ajax({
	                type:"POST",
	                url: "{{ url('admin/venue/update') }}",
	                data: new FormData($('.kt-form')[0]),
	        		processData:false,
	        		contentType:false,
	                success: function (data)
	               {
	                    if (data.status === 'success') 
	                   {
	                    	toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
							toastr.options.onHidden = function(){
							  window.location="{{ url('admin/venue') }}";
			                };

					        toastr["success"]("Venue updated Successfully", "Success");
	                    }
	                    else if(data.status === 'error') 
	                    {
	                        toastr.options.timeOut = 3000;
							toastr.options.fadeOut = 3000;
							toastr.options.progressBar = true;
                            toastr["error"]("Opps.. Something Went Wrong.!", "Error");
	                    }
	                }
	           });
	        }
	        else
	       {
	            e.preventDefault();
	       }
	   });
	});
</script>
@stop
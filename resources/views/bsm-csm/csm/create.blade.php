@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
    .invalid-feedback
    {
        /*color: red;*/
        font-size: 13px;
    }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader-search ">
        <div class="kt-container  kt-container--fluid ">
            <h3 class="kt-subheader-search__title">
                CSM
                <span class="kt-subheader-search__desc">
                    @if(isset($edit))
                    Edit CSM
                    @else
                    Create CSM
                    @endif
                </span>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3">


            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                @if(isset($edit))
                                Edit CSM
                                @else
                                Create CSM
                                @endif
                            </h3>
                        </div>
                    </div>
                    @if(isset($edit))

                    <form class="kt-form edit__form" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <input type="hidden" name="rec_id" value="{{ $edit->id }}">
                            <div class="form-group">
                                <label>CSM Name <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Name" id="bsm_name" name="csm_name" value="{{ $edit->csm_name }}">
                            </div>
                            <div class="form-group">
                                <label>Mobile <span style="color: red;">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Mobile No." id="mobile" name="mobile" value="{{ $edit->mobile }}">
                            </div>
                            <div class="form-group">
                                <label>Email <span style="color: red;">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" value="{{ $edit->email }}">
                            </div>
                            <div class="form-group">
                                <label>Password <span style="color: red;">*</span></label>
                                <input type="password" class="form-control" placeholder="Enter Password for Bsm Login" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Venue <span style="color: red;">*</span></label>

                                <select class="form-control kt-select2" autocomplete="off" id="kt_select2_3" name="venue[]" multiple="multiple">
                                    <?php
                                    $assigned_id = array();
                                    foreach ($assigned_venue as $as_ve) {
                                        array_push($assigned_id, $as_ve->venue_id);
                                    }

                                    $edit_assigned_id = array();
                                    foreach ($edit_child as $ec) {
                                        array_push($edit_assigned_id, $ec->venue_id);
                                    }

                                    foreach ($venues as $venue) {
                                        if (in_array($venue->id, $assigned_id)) {
                                            echo 'assigned';
                                        } else {
                                            $selected = '';
                                            if (in_array($venue->id, $edit_assigned_id)) {
                                                $selected = ' selected';
                                            }
                                            ?>
                                            ?>
                                            <option {{ $selected }} value="{{ $venue->id }}">{{ $venue->venue_name }}</option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>


                            <div class="form-group">
                                <label>Vendor <span style="color: red;">*</span></label>
                                <select class="form-control kt-select2" autocomplete="off" id="kt_select2_vendor" name="vendor[]" multiple="multiple">
                                    @foreach($vendor as $val)
                                        @if(isset($csm_vendors) && in_array($val->id, $csm_vendors))
                                            <option selected value="{{$val->id}}">{{$val->full_name}}</option>
                                        @else
                                            <option value="{{$val->id}}">{{$val->full_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary" id="update">Update</button>
                                <a href="{{ route('admin.csm') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>

                    @else

                    <form class="kt-form add__form" method="POST">
                        @csrf
                        <div class="kt-portlet__body">

                            <div class="form-group">
                                <label>CSM Name <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Name" id="bsm_name" name="csm_name">
                            </div>
                            <div class="form-group">
                                <label>Mobile <span style="color: red;">*</span></label>
                                <input type="number" class="form-control" placeholder="Enter Mobile No." id="mobile" name="mobile">
                            </div>
                            <div class="form-group">
                                <label>Email <span style="color: red;">*</span></label>
                                <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password <span style="color: red;">*</span></label>
                                <input type="password" class="form-control" placeholder="Enter Password for Bsm Login" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Venue <span style="color: red;">*</span></label>

                                <select class="form-control kt-select2" autocomplete="off" id="kt_select2_3" name="venue[]" multiple="multiple">
                                    <?php
                                    $assigned_id = array();
                                    foreach ($assigned_venue as $as_ve) {
//                                        print_r($as_ve);
//                                        $exp = implode(',', $as_ve);
//                                        $exp['venue_id'] = implode(',', $as_ve->venue_id);
                                        array_push($assigned_id, $as_ve->venue_id);
                                    }
//                                    return;
//                                    echo '<pre>';
//                                    print_r($assigned_id);
//                                    return;

                                    foreach ($venues as $venue) {
                                        if (in_array($venue->id, $assigned_id)) {
                                            echo 'assigned';
                                        } else {
                                            ?>
                                            <option value="{{ $venue->id }}">{{ $venue->venue_name }}</option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>


                            <div class="form-group">
                                <label>Vendor <span style="color: red;">*</span></label>
                                <select class="form-control kt-select2" autocomplete="off" id="kt_select2_vendor" name="vendor[]" multiple="multiple">
                                    @foreach($vendor as $val)
                                        @if(isset($csm_vendors) && in_array($val->id, $csm_vendors))
                                            <option selected value="{{$val->id}}">{{$val->full_name}}</option>
                                        @else
                                            <option value="{{$val->id}}">{{$val->full_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>



                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary" id="save">Submit</button>
                                <a href="{{ route('admin.csm') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>

                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>

<script>
$(document).ready(function () {

    $('#kt_select2_3').select2({
        placeholder: 'Select Venues'
    });

     $('#kt_select2_vendor').select2({
        placeholder: 'Select vendors'
    });


    $(".add__form").validate({
        rules:
                {
                    csm_name:
                            {
                                required: true
                            },
                    mobile:
                            {
                                required: true
                            },
                    email:
                            {
                                required: true
                            },
                    password:
                            {
                                required: true
                            },
                    venue:
                            {
                                required: true
                            },
                },
        messages:
                {
                    csm_name:
                            {
                                required: "Enter Name"
                            },
                    mobile:
                            {
                                required: "Enter Mobile No."
                            },
                    email:
                            {
                                required: "Enter Email"
                            },
                    password:
                            {
                                required: true
                            },
                    venue:
                            {
                                required: "Select Venue"
                            },
                },
        highlight: function (element)
        {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element)
        {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element)
        {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#save").on("click", function (e)
    {

        e.preventDefault();
        if ($(".add__form").valid())
        {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.csm.store') }}",
                data: new FormData($('.add__form')[0]),
                processData: false,
                contentType: false,
                success: function (data)
                {
                    if (data.status === 'success')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;
                        toastr.options.onHidden = function () {
                            window.location = "{{ route('admin.csm') }}";
                        };

                        toastr["success"]("CSM Added Successfully", "Success");
                    } else if (data.status === 'duplicate')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;

                        toastr["warning"]("CSM already exist", "Warning");
                    } else if (data.status === 'error')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;

                        toastr["error"]("Opps.. Something Went Wrong.!", "Error");
                    }
                }
            });
        } else
        {
            e.preventDefault();
        }
    });

    $(".edit__form").validate({
        rules:
                {
                    csm_name:
                            {
                                required: true
                            },
                    mobile:
                            {
                                required: true
                            },
                    email:
                            {
                                required: true
                            },
                    venue:
                            {
                                required: true
                            },
                },
        messages:
                {
                    csm_name:
                            {
                                required: "Enter Name"
                            },
                    mobile:
                            {
                                required: "Enter Mobile No."
                            },
                    email:
                            {
                                required: "Enter Email"
                            },
                    venue:
                            {
                                required: "Select Venue"
                            },
                },
        highlight: function (element)
        {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element)
        {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function (error, element)
        {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#update").on("click", function (e)
    {

        e.preventDefault();
        if ($(".edit__form").valid())
        {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.csm.update') }}",
                data: new FormData($('.edit__form')[0]),
                processData: false,
                contentType: false,
                success: function (data)
                {
                    if (data.status === 'success')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;
                        toastr.options.onHidden = function () {
                            window.location = "{{ route('admin.csm') }}"
                        };

                        toastr["success"]("CSM Updated Successfully", "Success");
                    } else if (data.status === 'duplicate')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;

                        toastr["warning"]("CSM already exist", "Warning");
                    } else if (data.status === 'error')
                    {
                        toastr.options.timeOut = 3000;
                        toastr.options.fadeOut = 3000;
                        toastr.options.progressBar = true;

                        toastr["error"]("Opps.. Something Went Wrong.!", "Error");
                    }
                }
            });
        } else
        {
            e.preventDefault();
        }
    });

});
</script>



@stop

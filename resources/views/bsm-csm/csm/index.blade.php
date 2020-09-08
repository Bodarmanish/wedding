@extends('main')
@section('content')


<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader-search ">
        <div class="kt-container  kt-container--fluid ">
            <h3 class="kt-subheader-search__title">
                CSM
                <span class="kt-subheader-search__desc">CSM list</span>
            </h3>
        </div>
    </div>



    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        CSM list
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">

                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('admin.csm.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Add CSM
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="event_type_tbl">
                    @csrf
                    <thead>
                        <tr>
                            <th>CSM Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Assigned Venue</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $old_user_id = '';
                        $venue_name = '';

                        foreach ($all_csm as $csm) {
                            if ($old_user_id == '') {
                                echo '<tr>';
                                echo '<td>' . $csm->csm_name . '</td>';
                                echo '<td>' . $csm->email . '</td>';
                                echo '<td>' . $csm->mobile . '</td>';
                            }
                            if ($old_user_id != '' && $old_user_id != $csm->id) {
                                echo '<td>' . rtrim($venue_name, ',') . '</td>';
                                echo '<td>
                                        <a href=' . route("admin.csm.edit", $old_user_id) . ' class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                                                <i class="la la-edit"></i>
                                        </a>

                                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value="' . $old_user_id . '" id="delete">
                                                <i class="la la-trash"></i>
                                        </button>
                                </td>';
                                echo '</tr>';
                                $venue_name = '';
                                echo '<tr>';
                                echo '<td>' . $csm->csm_name . '</td>';
                                echo '<td>' . $csm->email . '</td>';
                                echo '<td>' . $csm->mobile . '</td>';
                            }
                            $venue_name .= $csm->venue_name . ',';
                            $old_user_id = $csm->id;
                        }
                        echo '<td>' . rtrim($venue_name, ',') . '</td>';
                        echo '<td>
                                <a href=' . route("admin.csm.edit", $old_user_id) . ' class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                                        <i class="la la-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" value="' . $old_user_id . '" id="delete">
                                        <i class="la la-trash"></i>
                                </button>
                        </td>';
                        echo '</tr>';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src = "{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type = "text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}" type="text/javascript"></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js')}}" type="text/javascript"></script>

<script>

$(document).ready(function () {

    $('#event_type_tbl').dataTable({
        "ordering": false
    });

    $(document).on('click', '#delete', function ()
    {
        var obj = $(this);
        var id = $(this).val();
//        alert(id);
//        return;

        swal({
            title: "Are you sure?",
            text: "You will not be able recover this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes delete it!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.csm.delete') }}",
                        data:
                                {
                                    '_token': $('input[name="_token"]').val(),
                                    'id': id
                                },
                        cache: false,
                        success: function (data)
                        {
                            obj.closest('tr').remove();
                        }
                    });
                    swal("Deleted", "CSM has been deleted.", "success");
                });
    });
});
</script>

@stop

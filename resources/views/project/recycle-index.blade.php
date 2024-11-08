@extends('layouts.master')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$page_title}}</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn mx-1 btn-danger" id="deleteAll" disabled>Restore All</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    @if(Auth::user()->user_type == $admin)
                    <div class="form-group col-2">
                        <label>Staff</label>
                        <select class="select-search mb-3 form-control submitable" name="user_id" id="user_id">
                            <option value="">All</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group col-2">
                        <label>Status</label>
                        <select class="select-search mb-3 form-control submitable" name="status" id="status">
                            <option value="">All</option>
                            @foreach ($project_status as $key => $value)
                            <option value="{{ $value->value }}">{{ $value->getLabel() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table class="table mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" name="select_all" type="checkbox" value="" id="selectAllCheckbox">
                                </div>
                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Assing To</th>
                            <th scope="col">Status</th>
                            {{-- <th scope="col">Avater</th> --}}
                            <th width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalOpen" tabindex="-1" aria-hidden="true"></div>
@endsection
@push('scripts')
<script type="text/javascript">
    // A $( document ).ready() block.
    $(document).ready(function() {
        // data load by data table
        var table = $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "{{ route('recycle.index') }}",
                "data": function(e) {
                    e.user_id = $("#user_id").val();
                    e.status = $("#status").val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                data: 'select',
                orderable: false,
                searchable: false,
                render: function(data, type, full, meta) {
                    return `<input type="checkbox" class="delete-checkbox" data-id="${full.id}">`;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'assign'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],

        });
        // delete User
        $("body").on('click', '.restore-btn', function() {
            var id = $(this).data('id');
            // delete function call 
            // please provide right url route (not name route)
            restore('/project/restore/', id, function(response, result) {
                if (result.isConfirmed) {
                    table.draw();
                    toastr[response.status](response.message);
                }
            });
        });

        // Toggle all checkboxes when header checkbox is clicked
        $("#selectAllCheckbox").on("change", function() {
            $(".delete-checkbox").prop("checked", $(this).is(":checked"));
            $("#deleteAll").prop("disabled", $(".delete-checkbox:checked").length === 0);
        });
        // Enable/disable "Delete All" button based on individual checkbox selection
        $("body").on("change", ".delete-checkbox", function() {
            $("#selectAllCheckbox").prop("checked", $(".delete-checkbox:checked").length === $(".delete-checkbox").length);
            $("#deleteAll").prop("disabled", $(".delete-checkbox:checked").length === 0);
        });
        // delete all
        $("#deleteAll").click(function() {
            var ids = $(".delete-checkbox:checked").map(function() {
                return $(this).data("id");
            }).get();
            
            if (ids.length > 0) {
                restoreAll('/project/multiple/restore', ids, function(response, result) {
                    if (result.isConfirmed) {
                        table.draw();
                        toastr[response.status](response.message);
                        $("#deleteAll").prop("disabled", true); // Disable delete button
                        $("#selectAllCheckbox").prop("checked", false);
                    }
                });
            }
        });

    });
</script>
@endpush
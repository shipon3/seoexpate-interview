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
            <button type="button" class="btn mx-1 btn-primary" id="add">Add</button>
            <a href="{{URL::previous()}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <table class="table mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
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
                "url": "{{ route('user.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],

        });

        //add user model 
        $("body").on('click', '#add', function() {
            $.ajax({
                url: "{{route('user.create', '')}}",
                method: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalOpen").html(response);
                    $("#modalOpen").modal('show');
                },
                error: function(error) {
                    setRequire(error);
                }
            });
        });

        // form submit 
        $("body").on('click', '#createBtn', function(e) {
            e.preventDefault();
            $("#createBtn").attr('disabled', true);
            var form = $("#dataFrom")[0];
            var formData = new FormData(form);
            $.ajax({
                url: '{{route("user.store")}}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $("#modalOpen").modal('hide');
                    $("#createBtn").attr('disabled', false);
                    toastr[response.status](response.message);
                    table.draw();
                    form.reset();
                },
                error: function(error) {
                    $("#createBtn").attr('disabled', false);
                    if (error) {
                        setRequire(error);
                    }
                }
            })

        });
        // edit user modal 
        $("body").on('click', ".edit-btn", function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('user.edit', '')}}/" + id,
                method: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalOpen").html(response);
                    $("#modalOpen").modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
        $("body").on('click', ".show-btn", function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('user.show', '')}}/" + id,
                method: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalOpen").html(response);
                    $("#modalOpen").modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

        // update user
        $("body").on('click', '#updateBtn', function(e) {
            e.preventDefault();
            $("#updateBtn").attr('disabled', true);
            var form = $("#editDataFrom")[0];
            var id = $(this).data('id');
            var formData = new FormData(form);
            $.ajax({
                url: "{{route('user.update', '')}}/" + id,
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $("#modalOpen").modal('hide');
                    form.reset();
                    $("#updateBtn").attr('disabled', false);
                    toastr[response.status](response.message);
                    table.draw();
                },
                error: function(error) {
                    $("#updateBtn").attr('disabled', false);
                    if (error) {
                        setRequire(error);
                    }
                }
            });

        });
        // delete User
        $("body").on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            // delete function call 
            // please provide right url route (not name route)
            deleteItem('/user/destroy/', id, function(response, result) {
                if (result.isConfirmed) {
                    table.draw();
                    toastr[response.status](response.message);
                }
            });
        });

    });
</script>
@endpush
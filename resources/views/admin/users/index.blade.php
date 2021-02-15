@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ trans('global.UserManage.title') }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ trans('global.UserManage.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('global.UserManage.Users') }}</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <i class="ti-user"></i> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('admin/users/create') }}" class="btn waves-effect waves-light btn-primary"><i class="ti-plus text"></i> {{ trans('global.UserManage.create') }}</a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Reference') }}</th>
                                    <th>{{ trans('global.Name') }}</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.CellPhone') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.Role') }}</th>
                                    <th>{{ trans('global.CreatedAt') }}</th>
                                    <th>{{ trans('global.Action') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Reference') }}</th>
                                    <th>{{ trans('global.Name') }}</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.CellPhone') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.Role') }}</th>
                                    <th>{{ trans('global.CreatedAt') }}</th>
                                    <th>{{ trans('global.Action') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<style>
    .jq-icon-info {
        background-color: #03a9f3;
        color: #fff;
    }

    .jq-icon-success {
        background-color: #00c292;
        color: #fff;
    }

    .jq-icon-error {
        background-color: #e46a76;
        color: #fff;
    }

    .jq-icon-warning {
        background-color: #fec107;
        color: #fff;
    }

    .alert-rounded {
        border-radius: 60px;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
<script>
    var dataTable = $('#dataTable').DataTable({
        'processing': true,
        'serverSide': true,
        'scrollX': true,
        'ajax': {
            'url': "{{ url('admin/users') }}",
            'type': 'GET'
        },
        'columns': [
            {'data': 'id'},
            {'data': 'reference'},
            {'data': 'name'},
            {'data': 'email'},
            {'data': 'cellphone'},
            {'data': 'country'},
            {'data': 'role'},
            {'data': 'created_at'},
            {'data': 'action'}
        ],
    });

    function deleteUser(userId) {
        Swal.fire({
            title: "{{ trans('global.Swal.DelConfirm.title') }}",
            text: "{{ trans('global.Swal.DelConfirm.text') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('global.Swal.DelConfirm.yes') }}",
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                $('#deleteForm'+userId).submit();
            }
        })
    }

    function blockOrUnBlockUser(userId) {
        Swal.fire({
            title: "{{ trans('global.Swal.BlockConfirm.title') }}",
            text: "{{ trans('global.Swal.BlockConfirm.text') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('global.Swal.BlockConfirm.yes') }}",
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/users/update-status') }}",
                    data: {
                        'id': userId,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.success) {
                            $.toast({
                                heading: "{{ trans('global.Success') }}",
                                text: data.message,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'success',
                                hideAfter: 3000,
                                stack: 6
                            });
                        } else {
                            $.toast({
                                heading: "{{ trans('global.Error') }}",
                                text: data.message,
                                position: 'top-right',
                                loaderBg:'#ff6849',
                                icon: 'error',
                                hideAfter: 3000,
                                stack: 6
                            });
                        }
                        dataTable.ajax.reload(null, false);
                    }
                });
            }
        })
    }
</script>
@endpush

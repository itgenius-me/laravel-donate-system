@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ trans('global.UserManage.ReferalTeams') }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ trans('global.UserManage.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('global.UserManage.ReferalTeams') }}</li>
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
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Name') }}</th>
                                    <th>{{ trans('global.UserManage.IdEmail') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.CellPhone') }}</th>
                                    <th>{{ trans('global.UserManage.DateOfRegister') }}</th>
                                    <th>{{ trans('global.UserManage.LeaderManager') }}</th>
                                    <th>{{ trans('global.UserManage.NameOfManager') }}</th>
                                    <th>{{ trans('global.UserManage.Sponsor') }}</th>
                                    <th>{{ trans('global.UserManage.NameOfSponsor') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Name') }}</th>
                                    <th>{{ trans('global.UserManage.IdEmail') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.CellPhone') }}</th>
                                    <th>{{ trans('global.UserManage.DateOfRegister') }}</th>
                                    <th>{{ trans('global.UserManage.LeaderManager') }}</th>
                                    <th>{{ trans('global.UserManage.NameOfManager') }}</th>
                                    <th>{{ trans('global.UserManage.Sponsor') }}</th>
                                    <th>{{ trans('global.UserManage.NameOfSponsor') }}</th>
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
        'ajax': {
            'url': "{{ url('admin/referal-teams') }}",
            'type': 'GET'
        },
        'columns': [
            {'data': 'id'},
            {'data': 'name'},
            {'data': 'email'},
            {'data': 'country'},
            {'data': 'cellphone'},
            {'data': 'created_at'},
            {'data': 'leader_email'},
            {'data': 'leader_name'},
            {'data': 'sponsor_email'},
            {'data': 'sponsor_name'},
        ],
    });
</script>
@endpush

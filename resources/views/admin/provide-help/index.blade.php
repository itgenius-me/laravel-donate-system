@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ trans('global.OrderManage.ProvideHelp.title') }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ trans('global.OrderManage.title') }}</li>
                <li class="breadcrumb-item active">{{ trans('global.OrderManage.ProvideHelp.title') }}</li>
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
                    <a href="{{ url('admin/provide-help/create') }}" class="btn waves-effect waves-light btn-primary"><i class="ti-plus text"></i> {{ trans('global.OrderManage.ProvideHelp.Create') }}</a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Email-Manager') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Date') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Amount') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Type') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Status') }}</th>
                                    <th width="100px">{{ trans('global.Action') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Email-Manager') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Date') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Amount') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Type') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Status') }}</th>
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
        "ordering": false,
        'scrollX': true,
        'ajax': {
            'url': "{{ url('admin/provide-help') }}",
            'type': 'GET'
        },
        'columns': [
            {'data': 'id'},
            {'data': 'email'},
            {'data': 'leader_email'},
            {'data': 'country'},
            {'data': 'date_of_provide_help'},
            {'data': 'amount'},
            {'data': 'type'},
            {'data': 'status'},
            {'data': 'action'},
        ],
    });

    function deleteProvideHelp(id) {
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
                $('#deleteForm'+id).submit();
            }
        })
    }

</script>
@endpush

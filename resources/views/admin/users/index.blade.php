@extends('layouts.app')
   
@section('content')
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
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.Reference') }}</th>
                                    <th>{{ trans('global.Name') }}</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.CellPhone') }}</th>
                                    <th>{{ trans('global.Country') }}</th>
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
@endpush

@push('js')
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $('#dataTable').DataTable({
        'processing': true,
        'serverSide': true,
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
</script>
@endpush
@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ trans('global.ViewOrders.title') }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('global.ViewOrders.title') }}</li>
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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <h5 class="box-title">{{ trans('global.currency') }}</h5>
                    <select id="currency" name="currency" class="select2 form-control custom-select @error('currency') is-invalid @enderror" style="width: 100%; height:36px;">
                        <option value="-1">&nbsp;</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->currency }}" @if(old('currency')==$currency->currency) selected @endif>
                                {{ $currency->currency }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <h5 class="box-title">{{ trans('global.ViewOrders.status') }}</h5>
                    <select id="status" name="status" class="select2 form-control custom-select @error('status') is-invalid @enderror" style="width: 100%; height:36px;">
                        <option value="-1">&nbsp;</option>
                        <option value="0">{{ trans('global.OrderManage.GetHelp.Unconfirmed') }}</option>
                        <option value="1">{{ trans('global.OrderManage.GetHelp.Confirmed') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.ViewOrders.generated_date') }}</th>
                                    <th>{{ trans('global.ViewOrders.time_left') }}</th>
                                    <th>{{ trans('global.ViewOrders.sender_email') }}</th>
                                    <th>{{ trans('global.ViewOrders.receive_email') }}</th>
                                    <th>{{ trans('global.ViewOrders.amount') }}</th>
                                    <th>{{ trans('global.ViewOrders.currency') }}</th>
                                    <th>{{ trans('global.ViewOrders.status') }}</th>
                                    <th>{{ trans('global.ViewOrders.attached_proof') }}</th>
                                    <th width="100px">{{ trans('global.Action') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('global.ViewOrders.generated_date') }}</th>
                                    <th>{{ trans('global.ViewOrders.time_left') }}</th>
                                    <th>{{ trans('global.ViewOrders.sender_email') }}</th>
                                    <th>{{ trans('global.ViewOrders.receive_email') }}</th>
                                    <th>{{ trans('global.ViewOrders.amount') }}</th>
                                    <th>{{ trans('global.ViewOrders.currency') }}</th>
                                    <th>{{ trans('global.ViewOrders.status') }}</th>
                                    <th>{{ trans('global.ViewOrders.attached_proof') }}</th>
                                    <th width="100px">{{ trans('global.Action') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sample modal content -->
<div class="modal fade time_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('global.ViewOrders.new_expire') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="current_date" class="col-form-label text-right">{{ trans('global.ViewOrders.cur_expire') }}</label>
                            <div class="input-group">
                                <input id="current_date" class="form-control" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="time_modal_id" />
                        <div class="form-group">
                            <label for="new_date" class="col-form-label text-right">{{ trans('global.ViewOrders.new_expire') }}</label>
                            <div class="input-group">
                                <input id="new_date" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" onclick="change_expire()">{{ trans('global.ViewOrders.change_expire_date') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('css')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dist/css/pages/stylish-tooltip.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>

<link href="{{ asset('datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
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

    .close:focus {
        outline: none;
    }
    .table-condensed {
        width: 100%;
    }

    .datetimepicker {
        width: 260px;
    }

</style>
@endpush

@push('js')
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('datetimepicker/js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}" type="text/javascript"></script>

<script>
    $("#new_date").datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        todayHighlight: true,
        language: 'en',
    });
    $(".select2").select2();
    $("#currency").change(function () {
        dataTable.column(6).search($(this).val()).draw();
    })
    $("#status").change(function () {
        dataTable.column(7).search($(this).val()).draw();
    })
    var dataTable = $('#dataTable').DataTable({
        'processing': true,
        'serverSide': true,
        "ordering": false,
        'scrollX': true,
        'ajax': {
            'url': "{{ url('admin/view-orders') }}",
            'type': 'GET'
        },
        "drawCallback": function( settings ) {
            $('[data-toggle="time_modal"]').click(function () {
                var expire_date = $(this).attr("data-expire-date");
                var current_date = $(this).attr("data-current-date");
                var id = $(this).attr("data-id");
                $("#time_modal_id").val(id)
                $("#current_date").val(expire_date)
                $('#new_date').datetimepicker('setStartDate', current_date);
                $(".time_modal").modal({
                    'backdrop': 'static',
                });
            })
        },
        columnDefs: [
            {
                searchable: false,
                targets:   6
            },
            {
                searchable: false,
                targets:   7
            }
        ],
        'columns': [
            {'data': 'id'},
            {'data': 'date_of_generate'},
            {'data': 'date_of_expire'},
            {'data': 'ph_email'},
            {'data': 'gh_email'},
            {'data': 'match_order_amount'},
            {'data': 'currency'},
            {'data': 'status'},
            {'data': 'proof_attachment'},
            {'data': 'action'},
        ],
    });

    function deleteOrder(id) {
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

    function change_expire() {

    }
    setTimeout(function () {
        $("#currency").trigger('change')
        $("#status").trigger('change')
    }, 500);

</script>
@endpush

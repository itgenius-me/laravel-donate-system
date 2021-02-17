@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ trans('global.OrderGenerate.title') }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ trans('global.OrderGenerate.title') }}</li>
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
    <button disabled id="btnCreate" class="btn waves-effect waves-light btn-primary mb-2">
        <i class="ti-plus text"></i>
        {{ trans('global.OrderGenerate.title') }}
    </button>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-themecolor mb-0">{{ trans('global.OrderManage.GetHelp.title') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="gTable" class="table table-bordered table-striped nowrap" width="100%">
                            <thead>
                            <tr>
                                <th>
{{--                                    <button style="border: none; background: transparent; font-size: 14px; width: 100%" id="gTableBtn">--}}
{{--                                        <i class="far fa-square"></i>--}}
{{--                                    </button>--}}
                                </th>
                                <th>#</th>
                                <th>{{ trans('global.Email') }}</th>
                                <th>{{ trans('global.OrderManage.GetHelp.Date') }}</th>
                                <th>{{ trans('global.OrderGenerate.Remain_Amount') }}</th>
                            </tr>
                            </thead>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>{{ trans('global.Email') }}</th>--}}
{{--                                <th>{{ trans('global.OrderManage.GetHelp.Date') }}</th>--}}
{{--                                <th>{{ trans('global.OrderManage.GetHelp.Amount') }}</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-themecolor mb-0">{{ trans('global.OrderManage.ProvideHelp.title') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pTable" class="table table-bordered table-striped nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>
{{--                                        <button style="border: none; background: transparent; font-size: 14px; width: 100%" id="pTableBtn">--}}
{{--                                            <i class="far fa-square"></i>--}}
{{--                                        </button>--}}
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('global.Email') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Date') }}</th>
                                    <th>{{ trans('global.OrderManage.ProvideHelp.Amount') }}</th>
                                    <th>{{ trans('global.OrderGenerate.Remain_Amount') }}</th>
                                </tr>
                            </thead>
{{--                            <tfoot>--}}
{{--                                <tr>--}}
{{--                                    <th>#</th>--}}
{{--                                    <th>{{ trans('global.Email') }}</th>--}}
{{--                                    <th>{{ trans('global.OrderManage.ProvideHelp.Date') }}</th>--}}
{{--                                    <th>{{ trans('global.OrderManage.ProvideHelp.Amount') }}</th>--}}
{{--                                    <th>{{ trans('global.OrderGenerate.Percent') }}</th>--}}
{{--                                </tr>--}}
{{--                            </tfoot>--}}
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
<link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css" rel="stylesheet">
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
    table.dataTable tr th.select-checkbox.selected::after {
        content: "✔";
        margin-top: 0px;
        margin-left: -4px;
        text-align: center;
        text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
    }
    table.dataTable tbody td.select-checkbox:before, table.dataTable tbody th.select-checkbox:before {
        margin-top: 5px;
    }
    table.dataTable tr.selected td.select-checkbox:after, table.dataTable tr.selected th.select-checkbox:after {
        margin-top: 0px;
    }
    #gTableBtn:focus, #pTableBtn:focus {
        outline:0;
    }
    .btn-primary.disabled, .btn-primary:disabled {
        color: white !important;
        opacity: 0.3;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script>

    var gCnt = 0, pCnt = 0;
    var gTable = $('#gTable').DataTable({
        'processing': true,
        'serverSide': true,
        "ordering": false,
        "scrollX": true,
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false,
        'ajax': {
            'url': "{{ url('admin/create-order/get-help') }}",
            'type': 'GET'
        },
        'columns': [
            {'data': 'ch'},
            {'data': 'id'},
            {'data': 'email'},
            {'data': 'date_of_get_help'},
            {'data': 'remain_amount'},
        ],
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
    });
    $('#gTableBtn').click(function() {

        if (pTable.rows('.selected').data().length > 1)
            return;

        if (gTable.rows({
            selected: true
        }).count() > 0) {
            gTable.rows().deselect();
            return;
        }

        gTable.rows().select();
    });
    gTable.on('select deselect', function(e, dt, type, indexes) {
        if (type === 'row') {
            checkSum();
            // We may use dt instead of myTable to have the freshest data.
            if (dt.rows().count() === dt.rows({
                selected: true
            }).count()) {
                // Deselect all items button.
                $('#gTableBtn i').attr('class', 'far fa-check-square');
                return;
            }

            if (dt.rows({
                selected: true
            }).count() === 0) {
                // Select all items button.
                $('#gTableBtn i').attr('class', 'far fa-square');
                return;
            }

            // Deselect some items button.
            $('#gTableBtn i').attr('class', 'far fa-minus-square');
        }
    });
    var checkSum = function () {
        var get_total = 0;
        gCnt = 0; pCnt = 0;
        $.each(gTable.rows('.selected').data(), function () {
            get_total += this.amount;
            ++gCnt;
        });

        var provide_total = 0;
        $.each(pTable.rows('.selected').data(), function () {
            provide_total += this.amount;
            ++pCnt;
        });

        // if (gCnt > 1)
        //     pTable.select.style( 'os' );
        // else
        //     pTable.select.style( 'multi' );
        //
        // if (pCnt > 1)
        //     gTable.select.style( 'os' );
        // else
        //     gTable.select.style( 'multi' );
        //
        // if (pCnt < 2 && gCnt < 2) {
        //     gTable.select.style('multi');
        //     pTable.select.style( 'multi' );
        // }

        if (get_total >= provide_total && get_total !== 0 && provide_total !== 0) {
            $("#btnCreate").removeAttr("disabled");
        } else {
            $("#btnCreate").attr("disabled", "disabled");
        }
    }
    var pTable = $('#pTable').DataTable({
        'processing': true,
        'serverSide': true,
        "ordering": false,
        "scrollX": true,
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false,
        'ajax': {
            'url': "{{ url('admin/create-order/provide-help') }}",
            'type': 'GET'
        },
        'columns': [
            {'data': 'ch'},
            {'data': 'id'},
            {'data': 'email'},
            {'data': 'date_of_provide_help'},
            {'data': 'amount'},
            {'data': 'remain_amount'},
        ],
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
    });

    $('#pTableBtn').click(function() {

        if (gTable.rows('.selected').data().length > 1)
            return;

        if (pTable.rows({
            selected: true
        }).count() > 0) {
            pTable.rows().deselect();
            return;
        }

        pTable.rows().select();
    });
    pTable.on('select deselect', function(e, dt, type, indexes) {
        if (type === 'row') {
            checkSum();
            // We may use dt instead of myTable to have the freshest data.
            if (dt.rows().count() === dt.rows({
                selected: true
            }).count()) {
                // Deselect all items button.
                $('#pTableBtn i').attr('class', 'far fa-check-square');
                return;
            }

            if (dt.rows({
                selected: true
            }).count() === 0) {
                // Select all items button.
                $('#pTableBtn i').attr('class', 'far fa-square');
                return;
            }

            // Deselect some items button.
            $('#pTableBtn i').attr('class', 'far fa-minus-square');
        }
    });

    $("#btnCreate").click(function () {
        var gh_ids, ph_ids;
        $.each(gTable.rows('.selected').data(), function () {
            gh_ids = this;
        });

        $.each(pTable.rows('.selected').data(), function () {
            ph_ids = this;
        });

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/create-order/order-generate') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                'gh_ids': gh_ids,
                'ph_ids': ph_ids
            },
            success: function (data) {
                gTable.ajax.reload(null, false);
                pTable.ajax.reload(null, false);
            }
        });
    })
</script>
@endpush

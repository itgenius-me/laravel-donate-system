@extends('layouts.app')

@section('content')
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		 <h4 class="text-themecolor">{{ trans('global.OrderManage.ProvideHelp.Edit') }}</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		 <div class="d-flex justify-content-end align-items-center">
			  <ol class="breadcrumb">
					<li class="breadcrumb-item">{{ trans('global.OrderManage.title') }}</li>
					<li class="breadcrumb-item"><a href="{{ url('/admin/provide-help') }}">{{ trans('global.OrderManage.ProvideHelp.title') }}</a></li>
					<li class="breadcrumb-item active">{{ trans('global.OrderManage.ProvideHelp.Edit') }}</li>
			  </ol>
		 </div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form class="form" action="{{ url('admin/provide-help/update', $pHelp->id) }}" method="POST">
						@csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label text-right">{{ trans('global.Email') }} <span class="text-danger">*</span></label>
                            <select id="email" name="email" class="select2 form-control custom-select @error('email') is-invalid @enderror" style="width: 100%; height:36px;">
                                <option>Select</option>
                                @foreach($emails as $email)
                                    <option value="{{ $email }}" @if($email == $pHelp->email) selected @endif>{{ $email }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label text-right">{{ trans('global.OrderManage.ProvideHelp.Amount') }} <span class="text-danger">*</span></label>
                            <input name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ? old('amount') : $pHelp->amount }}" required>
                            @if($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-form-label text-right">{{ trans('global.OrderManage.ProvideHelp.Type') }} <span class="text-danger">*</span></label>
                            <select id="type" name="type" class="select2 form-control custom-select @error('type') is-invalid @enderror" style="width: 100%; height:36px;">
                                <option value="1" @if($pHelp->type == 1) selected @endif>Local</option>
                                <option value="2" @if($pHelp->type == 2) selected @endif>Cripto</option>
                            </select>
                            @if($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
						<div class="text-right">
							<button type="submit" class="btn btn-primary waves-effect waves-light">{{ trans('global.Submit') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('css')
    <link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    <script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>

    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
@endpush

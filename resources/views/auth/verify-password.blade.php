@extends('template-admin.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Verify PIN') }}</span>
                    <a href="/change-pin" class="btn btn-sm btn-warning">
                        Ubah PIN
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.verify-password.post') }}">
                        @csrf

                        <input type="hidden" name="redirect_to" value="{{ session('redirect_to') }}">

                        <div class="mb-3">
                            <label for="pin" class="form-label">{{ __('PIN') }}</label>
                            <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror" name="pin" required>

                            @error('pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Verify PIN') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

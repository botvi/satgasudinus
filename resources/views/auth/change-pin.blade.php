@extends('template-admin.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Change PIN') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.change-pin.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_pin" class="form-label">{{ __('Current PIN') }}</label>
                            <input id="current_pin" type="text" class="form-control @error('current_pin') is-invalid @enderror" name="current_pin" required>

                            @error('current_pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_pin" class="form-label">{{ __('New PIN') }}</label>
                            <input id="new_pin" type="text" class="form-control @error('new_pin') is-invalid @enderror" name="new_pin" required>

                            @error('new_pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_pin_confirmation" class="form-label">{{ __('Confirm New PIN') }}</label>
                            <input id="new_pin_confirmation" type="text" class="form-control @error('new_pin_confirmation') is-invalid @enderror" name="new_pin_confirmation" required>

                            @error('new_pin_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Change PIN') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

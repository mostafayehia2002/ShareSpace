<!DOCTYPE html>
<html lang={{ app()->getLocale() }}>
@include('layouts.head', ['title' => 'Reset Password'])

<body>
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <h3>Reset Password </h3>
            </div>
            <div class="row justify-content-center">
                <form action={{ route('send_code') }} method="POST" class="row g-3">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email') }}" name="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Send Code</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @include('layouts.scripts')
</body>

</html>

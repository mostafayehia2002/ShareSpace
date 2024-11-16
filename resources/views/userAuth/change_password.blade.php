<!DOCTYPE html>
<html lang={{ app()->getLocale() }}>
@include('layouts.head', ['title' => 'Change Password'])

<body>
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <h3>Change Password </h3>
            </div>
            <div class="row justify-content-center">
                <form action={{ route('change_password') }} method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" class="form-control" id="email"
                        value="{{ empty($email) ? old('email') : $email }}" name="email">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="code" class="form-control @error('code') is-invalid @enderror" id="code"
                            value="{{ old('code') }}" name="code">
                        @error('code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" value="{{ old('password') }}" name="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password"
                            class="form-control  @error('password_confirmation') is-invalid @enderror"
                            id="confirm_password" value="{{ old('password_confirmation') }}"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Change Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @include('layouts.scripts')
</body>

</html>

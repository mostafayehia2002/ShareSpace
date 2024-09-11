<!DOCTYPE html>
<html lang={{ app()->getLocale() }}>
@include('layouts.head', ['title' => 'login'])

<body>
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <h3>login </h3>
            </div>
            <div class="row justify-content-center">
                <form action={{ route('user.login') }} method="POST" class="row g-3">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email') }}" name="email">
                        @error('email')
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

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember"
                            @checked(old('remember'))>

                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Login</button>
                    </div>
                </form>
                <div>
                    <a href="{{ route('register') }}">Register </a>
                    <br>
                    <a href="{{ route('reset_password') }}">Reset Password </a>
                </div>
            </div>
        </div>

    </div>
    @include('layouts.scripts')
</body>

</html>

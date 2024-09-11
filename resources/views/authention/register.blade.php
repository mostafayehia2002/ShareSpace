<!DOCTYPE html>
<html lang={{ app()->getLocale() }}>
@include('layouts.head', ['title' => 'register'])

<body>
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <h3> Register </h3>
            </div>
            <div class="row justify-content-center">
                <form action="{{ route('user.register') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" class="form-control  @error('name') is-invalid @enderror" id="name"
                            value="{{ old('name') }}" name="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email"
                            value="{{ old('email') }}" name="email">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control  @error('password') is-invalid @enderror"
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
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo</label>
                        <input class="form-control @error('photo') is-invalid @enderror"" type="file" id="photo"
                            name="photo" accept="image/*">
                        @error('photo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Register</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @include('layouts.scripts')
</body>

</html>

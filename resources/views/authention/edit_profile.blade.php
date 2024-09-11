@extends('layouts.master', ['title' => 'profile'])
@section('content')
    @auth
        <div class="container">
            <div class="row">
                <div class="justify-content-center">
                    <h3>Profile </h3>
                    <div class="d-flex justify-content-center my-3">
                        @if (auth()->user()->media)
                            <img src={{ asset(auth()->user()->media->file_path) }} alt="User Photo"
                                class="img-fluid rounded-circle border border-primary"
                                style="width: 250px; height: 250px; object-fit: cover;">
                        @else
                            <img src={{ asset('uploads/profile.jpg ') }} alt="User Photo"
                                class="img-fluid rounded-circle border border-primary"
                                style="width: 250px; height: 250px; object-fit: cover;">
                        @endif

                    </div>
                </div>
                <div class="row justify-content-center">
                    <form action="{{ route('user.update_profile') }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                value="{{ auth()->user()->name }}" name="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email"
                                value="{{ auth()->user()->email }}" name="email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                value="" name="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror"
                                id="confirm_password" value="{{ old('password_confirmation') }}" name="password_confirmation">
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
                            <button type="submit" class="btn btn-primary mb-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @endauth
@endsection

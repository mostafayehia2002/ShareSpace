@extends('layouts.master', ['title' => 'friends'])
@section('content')
    <div class="container">
        <form action="" method="POST">
            <div class="row g-3 align-items-center">

                <div class="col-auto">
                    <label for="search" class="col-form-label">Search</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="search" class="form-control" aria-describedby="passwordHelpInline"
                        name="search" placeholder="Search for friends...">
                </div>

                <div class="col-auto">
                    <label for="filter" class="col-form-label">Filter</label>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="filter">
                        <option disabled>Filter</option>
                        <option value="">Friends</option>
                        <option value="">Not Friends</option>
                    </select>
                </div>
            </div>
        </form>




        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    </th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>
                            <img src="{{ $user->file_path ? asset($user->file_path) : asset('uploads/profile.jpg') }}"
                                alt="User Photo" class="img-fluid rounded-circle border border-primary"
                                style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <!-- If user is a friend, show profile button -->
                            <a class="btn btn-primary" href="{{ route('user.view_profile', $user->id) }}"
                                title="View Profile">
                                <i class="fa-solid fa-user"></i>
                                <span>Profile</span>
                            </a>
{{--هل هم اصدقاء--}}
                            @if ($user->is_friends)
                                <!-- If user is a friend, show remove friend button -->
                                <a class="btn btn-danger" href="{{ route('user.remove_friend', $user->id) }}"
                                    title="Remove Friend">
                                    <i class="fa-solid fa-user-xmark"></i>
                                    <span>Remove Friend</span>
                                </a>
                            @elseif ($user->have_request)
                                <!-- If there's a friend request received, show decline and accept buttons -->
                                <a class="btn btn-danger" href="{{ route('user.decline_request', $user->id) }}"
                                    title="Decline">
                                    <i class="fa-solid fa-user-slash"></i>
                                    <span>Decline</span>
                                </a>
                                <a class="btn btn-success" href="{{ route('user.accept_request', $user->id) }}"
                                    title="Accept">
                                    <i class="fa-solid fa-square-check"></i>
                                    <span>Accept</span>
                                </a>
                            @elseif ($user->sent_a_request)
                                <!-- If there is a sent friend request, show remove request button -->
                                <a class="btn btn-warning" href="{{ route('user.cancel_request', $user->id) }}"
                                    title="Cancel Request">
                                    <i class="fa-solid fa-user-minus"></i>
                                    <span>Cancel Request</span>
                                </a>
                            @else
                                <!-- If not a friend and no request, show send friend request button -->
                                <a class="btn btn-secondary" href="{{ route('user.send_request', $user->id) }}"
                                    title="Send Friend Request">
                                    <i class="fa-solid fa-user-plus"></i>
                                    <span>Add Friend</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $users->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

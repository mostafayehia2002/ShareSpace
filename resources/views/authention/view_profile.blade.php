@extends('layouts.master', ['title' => 'View Profile'])

@section('content')
    <div class="container mt-5">
        <!-- Profile Section -->
        <div class="profile-info">
            @if (empty($user->file_path))
                <img src="{{ asset('uploads/profile.jpg') }}" alt="Profile Picture" class="profile-image">
            @else
                <img src="{{ asset($user->file_path) }}" alt="Profile Picture" class="profile-image">
            @endif
            <h2 class="mt-3">{{ $user->name }}</h2>
            <p>Friends: </p>
                @if ($user->is_friends)
                    <!-- If user is a friend, show remove friend button -->
                    <a class="btn btn-danger" href="{{ route('user.remove_friend', $user->id) }}"
                       title="Remove Friend">
                        <i class="fa-solid fa-user-xmark"></i>
                        <span>Remove Friend</span>
                    </a>
                @elseif ($user->sent_a_request)
                    <!-- If there is a sent friend request, show remove request button -->
                    <a class="btn btn-warning" href="{{ route('user.cancel_request', $user->id) }}"
                       title="Cancel Request">
                        <i class="fa-solid fa-user-minus"></i>
                        <span>Cancel Request</span>
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
                @else
                    <!-- If not a friend and no request, show send friend request button -->
                    <a class="btn btn-secondary" href="{{ route('user.send_request', $user->id) }}"
                       title="Send Friend Request">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Add Friend</span>
                    </a>
                @endif
            <button class="btn btn-secondary btn-custom">Send Message</button>
        </div>

        <!-- Posts Section -->
        <div class="posts">
            <!-- Example Post -->
            <div class="post mx-auto">
                <div class="post-header">
                    <img src="https://via.placeholder.com/50" alt="Author Picture" class="post-author-img">
                    <div class="post-info">
                        <div class="post-author">John Doe</div>
                        <small class="post-date">Posted on September 1, 2024</small>
                    </div>
                </div>
                <div class="post-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua.</p>
                    <div class="post-images">
                        <img src="https://via.placeholder.com/100x100" alt="Post Image 1">
                        <img src="https://via.placeholder.com/100x100" alt="Post Image 2">
                    </div>
                    <div class="reactions">
                        <button class="btn btn-light reaction-button"> <i class="fa-solid fa-thumbs-up"></i> Like</button>
                        <button class="btn btn-light comment-button"> <i class="fa-solid fa-comment"></i> Comment</button>
                    </div>
                    <span class="reaction-count">100 Likes</span>
                    <span class="comment-count">10 Comments</span>

                    <div class="comments d-hidden">
                        <!-- Example Comment -->
                        <div class="comment">
                            <strong>Jane Smith:</strong> Great post!
                            <button class="btn btn-link btn-sm reply-button">Reply</button>
                            <!-- Comment Replies -->
                            <div class="replies d-hidden">
                                <div class="reply">
                                    <strong>John Doe:</strong> Thank you, Jane!
                                </div>
                                <div class="reply">
                                    <strong>Another User:</strong> Yes, very insightful!
                                </div>
                                <!-- Reply Form -->
                                <form class="reply-form">
                                    <input type="text" class="form-control" placeholder="Write a reply...">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Reply</button>
                                </form>
                            </div>
                        </div>

                        <!-- Another Example Comment -->
                        <div class="comment">
                            <strong>Mike Johnson:</strong> I agree, very interesting.
                            <button class="btn btn-link btn-sm reply-button">Reply</button>
                            <!-- Comment Replies -->
                            <div class="replies d-hidden">
                                <div class="reply">
                                    <strong>John Doe:</strong> Glad you think so, Mike!
                                </div>
                                <!-- Reply Form -->
                                <form class="reply-form">
                                    <input type="text" class="form-control" placeholder="Write a reply...">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Reply</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <form class="comment-form">
                        <input type="text" class="form-control" placeholder="Write a Comment...">
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
                    </form>
                </div>
            </div>

            <!-- Example Post -->
            <div class="post mx-auto">
                <div class="post-header">
                    <img src="https://via.placeholder.com/50" alt="Author Picture" class="post-author-img">
                    <div class="post-info">
                        <div class="post-author">John Doe</div>
                        <small class="post-date">Posted on September 1, 2024</small>
                    </div>
                </div>
                <div class="post-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua.</p>
                    <div class="reactions">
                        <button class="btn btn-light reaction-button"> <i class="fa-solid fa-thumbs-up"></i> Like</button>
                        <button class="btn btn-light comment-button"> <i class="fa-solid fa-comment"></i> Comment</button>
                    </div>
                    <span class="reaction-count">100 Likes</span>
                    <span class="comment-count">10 Comments</span>
                    <div class="comments d-hidden">
                        <hr>
                        <!-- Example Comment -->
                        <div class="comment">
                            <strong>Jane Smith:</strong> Great post!
                            <button class="btn btn-link btn-sm reply-button">Reply</button>
                            <!-- Comment Replies -->
                            <div class="replies d-hidden">
                                <div class="reply">
                                    <strong>John Doe:</strong> Thank you, Jane!
                                </div>
                                <div class="reply">
                                    <strong>Another User:</strong> Yes, very insightful!
                                </div>
                                <!-- Reply Form -->
                                <form class="reply-form">
                                    <input type="text" class="form-control" placeholder="Write a reply...">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Reply</button>
                                </form>
                            </div>
                        </div>
                        <!-- Another Example Comment -->
                        <div class="comment">
                            <strong>Mike Johnson:</strong> I agree, very interesting.
                            <button class="btn btn-link btn-sm reply-button">Reply</button>
                            <!-- Comment Replies -->
                            <div class="replies d-hidden">
                                <div class="reply">
                                    <strong>John Doe:</strong> Glad you think so, Mike!
                                </div>
                                <!-- Reply Form -->
                                <form class="reply-form">
                                    <input type="text" class="form-control" placeholder="Write a reply...">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Reply</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <form class="comment-form">
                        <input type="text" class="form-control" placeholder="write Comment">
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

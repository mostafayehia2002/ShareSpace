@extends('layouts.master', ['title' => 'Home Page'])
@section('content')
    <div class="container mt-5">
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
                        {{-- <img src="https://via.placeholder.com/100x100" alt="Post Image 2"> --}}
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
                    {{-- comment form --}}
                    <form class="comment-form">
                        <input type="text" class="form-control" placeholder="write Comment">
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

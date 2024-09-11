{{-- ------------------------------------------ --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ShareSpace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('user.home') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('user.home') }}"><i class="fa-solid fa-house"></i>
                        <span>
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#CreatePost" data-bs-toggle="modal"
                        data-bs-target="#CreatePost"><i class="fa-solid fa-plus"></i>
                        <span>
                            Create Post
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('user.friends') ? 'active' : '' }}"
                        href="{{ route('user.friends') }}"><i class="fa-solid fa-users"></i>
                        <span>
                            Friends
                        </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href=""><i class="fa-solid fa-bell"></i>
                        <span>
                            Notifications
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('user.edit_profile') | Route::is('user.logout') | Route::is('user.view_profile') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i>
                        <span>
                            Setting
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href={{ route('user.view_profile', auth()->id()) }}>
                                <i class="fa-solid fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('user.edit_profile') }}"><i <i
                                    class="fa-solid fa-user-pen"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li><a class="dropdown-item " href="{{ route('user.logout') }}"><i
                                    class="fa-solid fa-right-from-bracket"></i>
                                <span>
                                    Logout
                                </span>

                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

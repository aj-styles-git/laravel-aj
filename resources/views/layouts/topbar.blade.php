<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="26"> <span
                            class="logo-txt">Vusey</span>
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="26"> <span
                            class="logo-txt">Vusey</span>
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
                <i class="fa fa-fw fa-bars font-size-16"></i>
            </button>

            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search icon-sm"></span>
                </div>
            </form>


        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-block d-lg-none">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-search icon-sm"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0"
                                    placeholder="{{ __('Search') }}...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img id="header-lang-img" src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="Header Language"
                        height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a href="{{ route('change_language', ['lang' => 'en']) }}" class="dropdown-item notify-item language">
                        <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-2"
                            height="12"> <span class="align-middle">English</span>
                    </a>
               
                    <a href="{{ route('change_language', ['lang' => 'ar']) }}" class="dropdown-item notify-item language">
                        <img src="{{ URL::asset('assets/images/flags/spain.jpg') }}" alt="user-image" class="me-2"
                            height="12"> <span class="align-middle">Arabic</span>
                    </a>

                </div>
            </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm"></i>
                    <span class="noti-dot bg-danger rounded-pill">{{ Auth::user()->notifications->count() }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> {{ __('Notifications') }} </h5>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" class="small"> Mark all as read</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <h6 class="dropdown-header bg-light">New</h6>

                        @foreach (Auth::user()->notifications()->orderBy('created_at', 'desc')->get() as $notification)
                            <a href="{{ $notification->redirect_url }}" class="text-reset notification-item">
                                <div class="d-flex border-bottom align-items-start">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/'.$notification->logo) }}"
                                            class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $notification->title ?? "New Message" }}</h6>
                                        <div class="text-muted">
                                            <p class="mb-1 font-size-13">{{ $notification->message }}
                                            </p>
                                            {{-- to <span class="badge badge-soft-success">Review</span> --}}
                                            <p class="mb-0 font-size-10 text-uppercase fw-bold"><i
                                                    class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        {{-- <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="uil-shopping-basket"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New order has been placed</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Open the order confirmation or shipment
                                            confirmation.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i
                                                class="mdi mdi-clock-outline"></i> 5 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <h6 class="dropdown-header bg-light">Earlier</h6>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm me-3">
                                        <span
                                            class="avatar-title bg-soft-success text-success rounded-circle font-size-16">
                                            <i class="uil-truck"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Here is somthing that you might light like to
                                            know.</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i
                                                class="mdi mdi-clock-outline"></i> 1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}"
                                        class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-13">Yay ! Everything worked!</p>
                                        <p class="mb-0 font-size-10 text-uppercase fw-bold"><i
                                                class="mdi mdi-clock-outline"></i> 3 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                    <i class="bx bx-cog icon-sm"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('assets/images/dawrat_logo.png') }}" alt="Header Avatar">
                    <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                        <span class="user-name">{{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Welcome, {{ Auth::user()->name }} </h6>
                    {{-- <a class="dropdown-item" href="pages-profile"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="users"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Users</span></a>
                    <a class="dropdown-item" href="apps-chat"><i class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="apps-kanban-board"><i class="mdi mdi-calendar-check-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                    <a class="dropdown-item" href="pages-faqs"><i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Help</span></a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="#"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$6951.02</b></span></a> --}}
                    {{-- <a class="dropdown-item d-flex align-items-center" href="contacts-settings"><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span><span class="badge badge-soft-success ms-auto">New</span></a> --}}
                    {{-- <a class="dropdown-item" href="auth-lockscreen-cover"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a> --}}
                    <a class="dropdown-item" href="{{  route('logout', ['lang' => app()->getLocale() ] )  }}"><i
                            class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Logout</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="collapse show verti-dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">@@title</h4>

                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">@@pagetitle</a></li>
                                <li class="breadcrumb-item active">@@title</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div> --}}
            @yield('breadcrumb')
            <!-- end page title -->

            <!-- start dash info -->
            <div class="row">

                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">

                                @yield('pagecontentinfo')






                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end dash info -->
        </div>
    </div>

    <!-- start dash troggle-icon -->
    <div>
        <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle"
            aria-expanded="true" aria-controls="dashtoggle">
            <i class="bx bx-up-arrow-alt"></i>
        </a>
    </div>
    <!-- end dash troggle-icon -->


</header>




<script>
    function changeLanguage(lang) {
        event.preventDefault();
        window.location.href = "{{ route('change_language', ['lang' => 'en']) }}";
    }
</script>

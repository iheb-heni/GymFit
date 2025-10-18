<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/png" href="{{asset('images/iconnn.png')}}" />
    <title>GymNationTN: {{ $user->name }} </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css" rel="stylesheet')}}" />
    <link href="{{asset('assets/css/nucleo-svg.css" rel="stylesheet')}}" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
    
    <!-- Custom Dashboard Styles -->
    <style>
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.5rem;
            margin: 0 0.5rem;
        }
        
        .nav-link.active .nav-link-text {
            color: #fff !important;
            font-weight: 600;
        }
        
        .nav-link.active .material-icons {
            opacity: 1 !important;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .btn-outline-primary:hover,
        .btn-outline-info:hover,
        .btn-outline-success:hover,
        .btn-outline-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .timeline-step {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }
        
        .avatar {
            border: 3px solid rgba(255, 255, 255, 0.2);
        }
        
        .icon-shape {
            border-radius: 0.75rem;
        }
        
        .table-responsive {
            border-radius: 0.5rem;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .stats-card .card-header {
            background: transparent;
            border: none;
        }
        
        .stats-card .card-footer {
            background: rgba(255, 255, 255, 0.1);
            border: none;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100 ">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="/">

                <span class="ms-1 font-weight-bold text-white" style="font-size: 1.5rem;">
                    Gym<span style="color: blue; font-size: 1.5rem;">NationTN</span>
                </span>

            </a>
        </div>

        <hr class="horizontal light mt-0 mb-2" />

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('coach.dashboard') ? 'active' : '' }}" href="{{ route('coach.dashboard') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                        Content Management
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('startcourse') ? 'active' : '' }}" href="{{ route('startcourse') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">add_circle</i>
                        </div>
                        <span class="nav-link-text ms-1">Create Course</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('courses.userCourses') ? 'active' : '' }}" href="{{route('courses.userCourses')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">class</i>
                        </div>
                        <span class="nav-link-text ms-1">My Courses</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('createpost') ? 'active' : '' }}" href="{{ route('createpost') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">add_box</i>
                        </div>
                        <span class="nav-link-text ms-1">Create Post</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('posts.userPosts') ? 'active' : '' }}" href="{{route('posts.userPosts')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">notes</i>
                        </div>
                        <span class="nav-link-text ms-1">My Posts</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                        Community
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('actuality.index') ? 'active' : '' }}" href="{{ route('actuality.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">article</i>
                        </div>
                        <span class="nav-link-text ms-1">Actuality</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                        Account
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('profile', $user->id) ? 'active' : '' }}" href="{{ route('profile', $user->id) }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>


    </aside>

    <main class="main-content border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <!-- Profile Photo -->
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="{{ route('profile', $user->id) }}"
                                class="nav-link text-body p-0 d-flex align-items-center">
                                <span class="ms-2">{{ $user->civility . ' ' . $user->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/defaultimage.jpg') }}"
                                    alt="Profile Photo" style="width: 40px; height: 40px;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @if (session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @hasSection('content')
                @yield('content')
            @else
            @include('coach.sections.defaultcontent')
            @endif
        </div>
        <footer class="footer py-4 ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center ">
                    <div class="col-lg mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-center">
                            GymNationTN © 2024, All rights reserved. by
                            <a href="https://ihebheni.infinityfreeapp.com" target="_blank">Iheb heni</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>



    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>


    <script>
        var win = navigator.platform.indexOf("Win") > -1;
        if (win && document.querySelector("#sidenav-scrollbar")) {
            var options = {
                damping: "0.5",
            };
            Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
        }

        document.addEventListener('DOMContentLoaded', function() {
        // Function to hide alerts after a specified delay
        function hideAlertsAfterDelay(selector, delay) {
            const alerts = document.querySelectorAll(selector);
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                }, delay);
            });
        }

        // Hide success and error alerts after 4 seconds (4000 milliseconds)
        hideAlertsAfterDelay('#success-alert', 4000);
        hideAlertsAfterDelay('#error-alert', 4000);
        
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading states to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                if (this.href && !this.href.includes('#')) {
                    this.innerHTML = '<i class="material-icons me-2">hourglass_empty</i>Loading...';
                    this.disabled = true;
                }
            });
        });
        
        // Add tooltip initialization
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Animate statistics cards on load
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards for animation
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    });
    </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>

 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>

</body>

</html>

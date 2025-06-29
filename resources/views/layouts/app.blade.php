<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- CoreUI CSS -->
		<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
		integrity="sha512-n+g8P11K/4RFlXnx2/RW1EZK25iYgolW6Qn7I0F96KxJibwATH3OoVCQPh/hzlc4dWAwplglKX8IVNVMWUUdsw==" crossorigin="anonymous" />

		<title>{{ config('app.name', 'Laravel') }}</title>
	</head>
	<body class="c-app">
		<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
			<div class="c-sidebar-brand d-lg-down-none">
				<svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
					<use xlink:href="assets/brand/coreui.svg#full"></use>
				</svg>
				<svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
					<use xlink:href="assets/brand/coreui.svg#signet"></use>
				</svg>
			</div>
			<ul class="c-sidebar-nav">
				<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="index.html">
					<svg class="c-sidebar-nav-icon">
						<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
					</svg> Dashboard</a>
				</li>
				<li class="c-sidebar-nav-title">Components</li>
				<li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
					<svg class="c-sidebar-nav-icon">
						<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
					</svg> Base</a>
					<ul class="c-sidebar-nav-dropdown-items">
						<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>
					</ul>
				</li>
				<li class="c-sidebar-nav-item">
					<a class="c-sidebar-nav-link" href="{{ route('logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<svg class="c-sidebar-nav-icon">
							<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
						</svg>{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</li>
			</ul>
			<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
		</div>

		<div class="c-wrapper c-fixed-components">
			<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
			<ul class="c-header-nav ml-auto mr-4">
			<li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
			<svg class="c-icon">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
			</svg></a></li>
			<li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
			<svg class="c-icon">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
			</svg></a></li>
			<li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
			<svg class="c-icon">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
			</svg></a></li>
			<li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			<div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com"></div>
			</a>
			<div class="dropdown-menu dropdown-menu-right pt-0">
			<div class="dropdown-header bg-light py-2"><strong>Account</strong></div><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
			</svg> Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
			</svg> Messages<span class="badge badge-success ml-auto">42</span></a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-task') }}"></use>
			</svg> Tasks<span class="badge badge-danger ml-auto">42</span></a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}"></use>
			</svg> Comments<span class="badge badge-warning ml-auto">42</span></a>
			 <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
			</svg> Profile</a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-settings') }}"></use>
			</svg> Settings</a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-credit-card') }}"></use>
			</svg> Payments<span class="badge badge-secondary ml-auto">42</span></a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
			</svg> Projects<span class="badge badge-primary ml-auto">42</span></a>
			<div class="dropdown-divider"></div><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
			</svg> Lock Account</a><a class="dropdown-item" href="#">
			<svg class="c-icon mr-2">
			<use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
			</svg> Logout</a>
			</div>
			</li>
			</ul>
			</header>

			<div class="c-body">
				<main class="c-main">
				@yield('content')
			</main>
		</div>


		<!-- Optional JavaScript -->
		<!-- Popper.js first, then CoreUI JS -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"
		integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/@popperjs/core@2"></script>
		<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
	</body>
</html>

{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

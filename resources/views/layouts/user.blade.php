<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FutureSight') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/profile-css.css')}}">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #121212 !important;
            color: #ffffff;
        }

        .card {
            background-color: #1E1E1E !important;
            border: 1px solid #333333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: #252525 !important;
            border-bottom: 1px solid #333333;
        }

        .card-body {
            color: #E0E0E0;
        }

        .text-muted {
            color: #AAAAAA !important;
        }

        .form-control {
            background-color: #2D2D2D !important;
            border: 1px solid #404040;
            color: #ffffff;
        }

        .form-control:focus {
            background-color: #333333 !important;
            border-color: #505050;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #2D4263 !important;
            border-color: #2D4263;
        }

        .btn-primary:hover {
            background-color: #1E2B41 !important;
            border-color: #1E2B41;
        }

        .btn-secondary {
            background-color: #4A4A4A !important;
            border-color: #4A4A4A;
        }

        .btn-secondary:hover {
            background-color: #3D3D3D !important;
            border-color: #3D3D3D;
        }

        .table {
            color: #E0E0E0;
        }

        .alert {
            background-color: #252525;
            border-color: #333333;
            color: #E0E0E0;
        }

        .alert-success {
            background-color: #1B3323;
            border-color: #265C33;
        }

        .alert-danger {
            background-color: #331B1B;
            border-color: #5C2626;
        }

        .alert-info {
            background-color: #1B2633;
            border-color: #26405C;
        }

        .nav-link {
            color: #E0E0E0 !important;
        }

        .nav-link:hover {
            color: #FFFFFF !important;
            background-color: #2D2D2D;
        }

        .nav-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .pagination .page-link {
            background-color: #2D2D2D;
            border-color: #404040;
            color: #E0E0E0;
        }

        .pagination .page-link:hover {
            background-color: #404040;
            border-color: #505050;
            color: #FFFFFF;
        }

        .pagination .active .page-link {
            background-color: #2D4263;
            border-color: #2D4263;
        }

        /* Profile section specific styles */
        .profile-section {
            background-color: #1E1E1E;
            border: 1px solid #333333;
        }

        .profile-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .section-header {
            border-bottom: 2px solid #333333;
            color: #E0E0E0;
        }

        .current-avatar {
            border: 3px solid #333333;
        }

        .current-avatar:hover {
            border-color: #2D4263;
        }

        /* Modal styles */
        .modal-content {
            background-color: #1E1E1E;
            border: 1px solid #333333;
        }

        .modal-header {
            border-bottom: 1px solid #333333;
        }

        .modal-footer {
            border-top: 1px solid #333333;
        }
    </style>
</head>

<style>
    /* Profile CSS */

.profile-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
    transition: transform 0.2s;
}

.profile-section:hover {
    transform: translateY(-2px);
}

.section-header {
    border-bottom: 2px solid #f3f4f6;
    padding: 1rem;
    font-weight: 600;
    color: #1a1a1a;
}

.avatar-upload {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.current-avatar {
    border-radius: 50%;
    border: 3px solid #e5e7eb;
    transition: border-color 0.2s;
}

.current-avatar:hover {
    border-color: #3b82f6;
}

.back-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-weight: 500;
    transition: opacity 0.2s;
}

.back-button:hover {
    opacity: 0.9;
}

.profile-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}



.btn-custom {
    background-color: #3b82f6;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: background-color 0.2s;
}

.btn-custom:hover {
    background-color: #2563eb;
}

/* Tambahkan di dalam tag <style> yang sudah ada */
.nav-link {
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
}

.nav-link i {
    font-size: 1.1rem;
}

.nav-link span {
    font-weight: 500;
}

/* Animasi hover */
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.nav-link:hover i {
    animation: pulse 1s infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .nav-link {
        padding: 0.5rem;
    }
    
    .nav-link i {
        margin-right: 0.5rem;
    }
}
</style>

<body class="bg-gray-100">
    <div id="app">
        
    @include('partials.navbar')

        <!-- Main Content -->
        <main>
            <div class="profile-container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
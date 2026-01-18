<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


    <style>
        body {
            background-color: #b8f5b8;
        }

        .dashboard-wrapper {
            background: #f1f1f1;
            border: 2px solid #000;
            margin: 40px auto;
            padding: 20px;
            max-width: 1100px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="#">
                URLs
            </a>

            <!-- Left Menu -->
            <span class="navbar-text ms-3 fw-semibold">
                @yield('title')
            </span>

            <!-- Right Menu -->

            <div class="ms-auto">

                @auth

                    <span class="navbar-text mx-3 fw-semibold">
                        {{ auth()->user()->name }}
                    </span>


                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="text-decoration-none fw-semibold">
                        Logout →
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>

        </div>
    </nav>

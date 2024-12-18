<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Facilib - Biblioteca Virtual')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .app-bar {
            background: transparent !important;
            color: #14213d;
            font-weight: 500;
            padding: 10px 20px;
            height: 80px;
            z-index: 1000;
            width: 100%;
            border-radius: 0px 0px 20px 20px;
            backdrop-filter: blur(5px);
        }

        .app-bar a {
            color: #1b4965;
            text-decoration: none;
            margin-right: 20px;
            transition: all 0.24s ease;
        }

        .app-bar a:hover,
        .app-bar a.active {
            background-color: #054f79;
            padding: 10px 22px;
            border-radius: 40px;
            color: #95c7f7;
            transition: all .24s ease-in;
        }

        .app-bar-content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 10px;
            background: linear-gradient(to right,rgb(178, 225, 248),rgb(218, 230, 243),rgb(178, 225, 248));
            border: 1.6px solid rgb(73, 143, 167);
            border-radius: 30px;
            width: 40%;
            margin: 0 auto;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .app-bar-content {
                display: flex;
                flex-direction: column;
                width: 90%;  
                gap: 6px;
                background-color: transparent !important;
            }
        }

        .app-content {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav class="app-bar">
        <div class="app-bar-content">
            <a href="{{ route('dashboard') }}"  class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('loans.index') }}"  class="{{ request()->routeIs('loans.index') ? 'active' : '' }}">Empréstimos</a>
            <a href="{{ route('books.index') }}"  class="{{ request()->routeIs('books.index') ? 'active' : '' }}">Livros</a>
            <a href="{{ route('users.index') }}"  class="{{ request()->routeIs('users.index') ? 'active' : '' }}">Usuários</a>
        </div>
    </nav>

    <div class="app-content container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

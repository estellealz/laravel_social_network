<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        <style>
                body {
                    background-color: #E8E0E5;
                    color: #480E33;
                    font-family: 'Instrument Sans', sans-serif;
                }
                header {
                    background-color: #480E33;
                    color: #E8E0E5;
                    padding: 1rem;
                    text-align: center;
                    border-radius: 10px;
                }
                .nav-container {
                    display: flex;
                    justify-content: flex-end;
                    gap: 15px;
                    padding: 10px;
                }
                .nav-link {
                    padding: 10px 15px;
                    border-radius: 5px;
                    transition: all 0.3s ease;
                    color: #E8E0E5;
                    text-decoration: none;
                    background-color: #480E33;
                }
                .nav-link:hover {
                    background-color: #8499A5;
                    color: white;
                }
                .container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    min-height: 100vh;
                    padding: 2rem;
                }
                .card {
                    background-color: white;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
            </style>
        @endif
    </head>
    <body class="bg-[#E8E0E5] text-[#480E33] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="nav-container">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('logout') }}" class="nav-link">Se déconnecter</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
        <div class="card max-w-md mt-6">
            <h1 class="text-xl font-bold">Bienvenue sur votre réseau social</h1>
            <p class="mt-2 text-gray-700">Connectez-vous pour découvrir et échanger avec d'autres utilisateurs.</p>
        </div>
    </body>
</html>
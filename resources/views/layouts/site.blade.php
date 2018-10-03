<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fácil Financeiro</title>

    <!-- Styles -->
    <link href="{{asset('css/site.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <header>
        <?php
        $menuConfig = [
            'auth' => Auth::check(),
            'name' => Auth::check() ? Auth::user()->name : '',
            'menus' => [
                [
                    'name' => 'home',
                    'url' => url('/'),
                    'active' => isRouteActive('site.home')
                ],
            ],
            'menusDropdown' => [],
            'urlLogout' => env('URL_ADMIN_LOGOUT')                 ,
            'csrfToken' => csrf_token()
        ];
        ?>
        <site-menu :config="{{ json_encode($menuConfig) }}"></site-menu
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                © {{ date('Y') }}
                <a class="grey-text text-lighten-4" href="https://github.com/wellitoncamposklein">Entre em contato</a>
            </div>
        </div>
    </footer>
</div>
@stack('scripts')
<script src="{{ asset('build/site.bundle.js')  }}"></script>
</body>
</html>

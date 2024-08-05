<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/lgo.png') }}" />
    <meta name="description" content="Login - Visit Client">
    <meta name="keywords" content="Login - Visit Client" />
    <link rel="stylesheet" href="{{ asset('assets/mobile/assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body>

    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
            </a>
        </div>
        <div class="pageTitle"></div>
    </div>
    <div id="appCapsule" class="full-height">
        <div class="section mt-2 text-center">
            <div class="mb-2">
                <a href="#" class="b-brand">
                    <img src="{{ asset('assets/img/favicon/lgo.png') }}" width="160px" />

                </a>
            </div>
            <h1>Welcome</h1>
            <h2> Marketing Report</h2>
        </div>
        <div class="section mb-5 p-2">
            <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-body pb-1">
                        <h2 class="text-center"> Login</h2>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email1" placeholder="Your e-mail"
                                    name="email" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" autocomplete="off"
                                    placeholder="Your password" name="password" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                </div>
        </div>
        </form>
    </div>

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="{{ asset('assets/mobile/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('assets/mobile/assets/js/plugins/splide/splide.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/mobile/assets/js/base.js') }}"></script>


</body>

</html>
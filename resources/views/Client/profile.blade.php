<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href={{ asset('dashassets/img/favicons/manifest.json') }}>
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href={{ asset('dashassets/css/phoenix.min.css') }} rel="stylesheet" id="style-default">
    <link href={{ asset('dashassets/css/user.min.css') }} rel="stylesheet" id="user-style-default">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>

<body>

    <main class="main" id="top">
        <div class="container-fluid px-0">
            <!--include sidebar et navbar-->
            @include('inc.client.sidebar')
            @include('inc.client.navbar')

            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <div>
                            @include('inc.flashmessage')
                            <h2> Edit profile client</h2>

                            <form action="/client/profile/update" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" value="{{ auth()->user()->name }}" class="form-control"
                                        name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="email" value="{{ auth()->user()->email }}" class="form-control"
                                        name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="new password" class="form-control"
                                        name="password">
                                </div>

                                <button type="submit" class="btn btn-primary mb-3">Save</button>

                            </form>

                        </div>

                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>
    <script src={{ asset('dashassets/js/phoenix.js') }}></script>
    <script src={{ asset('dashassets/js/ecommerce-dashboard.js') }}></script>
</body>

</html>
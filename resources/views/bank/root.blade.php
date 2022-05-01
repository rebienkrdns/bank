<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Bank</title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/plugins.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/form-2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom-loader.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <div class="loader dual-loader mx-auto mb-5"></div>
                        <h1 class="">Bank</h1>
                        @auth
                        <p class="pt-3">Usuario autenticado, redireccionando a inicio</p>
                        @else
                        <p class="pt-3">Usuario no autenticado, redireccionando a inicio de sesión</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.setTimeout(() => {
            @auth
            window.location.href = "{{url('/inicio')}}"
            @else
            window.location.href = "{{url('/iniciar-sesion')}}"
            @endauth
        }, 3000);
    </script>
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
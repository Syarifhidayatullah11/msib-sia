<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
</head>


<body>
    <!-- <body class="hold-transition login-page"> -->
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">


                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center"
                                style="background-image:url(https://i.ibb.co/znNyZc7/sia.png);opacity:1;">
                                <!-- <div class="mask" style="background-color: rgba(0, 0, 0, 0.6)"> -->

                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h1 class="mb-4 text-center text-bold shadow-lg"><b>Sistem Informasi Akuntansi</b>
                                    </h1>
                                    <h3 class="mb-4"><b>PT. Trisakti Pilar Persada</b> </h3>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="https://i.ibb.co/g6pM8Tt/tpp.png" style="width: 185px;"
                                            alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Sistem Informasi Akuntansi</h4>
                                    </div>

                                    <p>Silahkan Login Terlebih Dahulu</p>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">

                                        <ul>
                                            @foreach ($errors->all() as $item)
                                            <li>{{$item}}</li>                             
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ route('login.post') }}">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label for="email">Email</label>
                                            <input placeholder="Email" type="email" value="{{old('email')}}" name="email" id="email"
                                                class="form-control">
                                                  
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="password">Password</label>
                                            <input placeholder="Password" type="password" name="password" id="password"
                                                class="form-control">
                                                
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-block">Sign
                                                    In</button>
                                            </div>
                                        </div>


                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>

    

</body>

</html>

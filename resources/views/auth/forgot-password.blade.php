<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <link rel="icon" href="{{ asset('panel/assets/images/favicon.ico') }}" type="image/x-icon">
    <title>Visit Denizli Panel - Parolanızı mı unuttunuz</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('panel/assets/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('panel/assets/images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('panel/assets/images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('panel/assets/images/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('panel/assets/css/style.min.css') }}">

</head>
<body data-bvite="theme-CeruleanBlue" class="layout-border svgstroke-a layout-default auth">
<main class="container-fluid px-0">
    <aside class="px-xl-5 px-4 auth-aside" data-bs-theme="none">
        <img class="login-img" src="{{ asset('panel/assets/images/logo.png') }}" alt="">
    </aside>
    <div class="px-xl-5 px-4 auth-body">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <ul class="row g-3 list-unstyled li_animate">
                <li class="col-12">
                    <h1 class="h2 title-font">Parolanızı mı unuttunuz</h1>
                </li>
                <li class="col-12">
                    <label class="form-label" for="email">E-Posta</label>
                    <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"  name="email" value="{{  old('email') }}" required autofocus >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </li>

                <li class="col-12 my-lg-4">
                    <button type="submit" class="btn btn-lg w-100 btn-primary text-uppercase mb-2" >E-posta Şifre Sıfırlama Bağlantısı</button>
                </li>

            </ul>
        </form>
    </div>
    <footer class="px-xl-5 px-4">
        <p class="mb-0 text-muted">© {{ date('Y') }} <a href="#" target="_blank" title="">Gis Soft Technology</a>, All Rights Reserved.</p>
    </footer>
</main>
</body>
</html>

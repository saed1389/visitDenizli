
<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <link rel="icon" href="{{ asset('panel/assets/images/favicon.ico') }}" type="image/x-icon">
    <title>Visit Denizli Panel - login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('panel/assets/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('panel/assets/images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('panel/assets/images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('panel/assets/images/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('panel/assets/css/style.min.css') }}">

</head>
<body data-bvite="theme-CeruleanBlue" class="layout-border svgstroke-a layout-default auth">
<main class="container-fluid px-0">
    <aside class="px-xl-5 px-4 auth-aside" data-bs-theme="none">
        <img class="login-img" src="{{ asset('panel/assets/images/visit-logo.png') }}" alt="">
    </aside>
    <div class="px-xl-5 px-4 auth-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <ul class="row g-3 list-unstyled li_animate">
                <li class="col-12">
                    <h1 class="h2 title-font">Visit Denizli Panel</h1>

                </li>
                <li class="col-12">
                    <label class="form-label" for="email">E-Posta</label>
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Lütfen e-postanızı girin" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </li>
                <li class="col-12">
                    <div class="form-label">
                        <span class="d-flex justify-content-between align-items-center">
                            Şifre
                            <a class="text-primary" href="{{ route('password.request') }}">Şifremi Unuttum</a>
                        </span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Lütfen şifrenizi giriniz" id="password" name="password" required autocomplete="current-password">
                </li>
                <li class="col-12">
                    <div class="form-check fs-5">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label fs-6" for="remember">Beni Hatırla</label>
                    </div>
                </li>
                <li class="col-12 my-lg-4">
                    <button type="submit" class="btn btn-lg w-100 btn-primary text-uppercase mb-2" >Giriş</button>
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

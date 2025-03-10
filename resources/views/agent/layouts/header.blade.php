<header class="px-md-4 px-2" data-bs-theme="none">
    <div class="d-flex justify-content-between align-items-center py-2 w-100">
        <p></p>
        <ul class="header-menu flex-grow-1">
            <li class="nav-item dropdown px-md-1 d-none d-md-inline-flex">
                <a class="dropdown-toggle gray-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="notification">
                    <span class="bullet-dot bg-primary animation-blink"></span>
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727"></path>
                        <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727"></path>
                    </svg>
                </a>
                <div class="dropdown-menu shadow rounded-4 notification" id="NotificationsDiv">
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h4 class="mb-0 text-gradient title-font">Bildirimler</h4>
                            <a href="#" class="btn btn-link" title="view all">Tümünü görüntüle</a>
                        </div>
                        <ul class="card-body p-0 list-unstyled mb-0 custom_scroll ps-2" style="height: 400px;">

                            <li class="pe-2">
                                <a class="d-flex p-lg-3 p-2 rounded-3" href="javascript:void(0);">
                                    <div class="avatar sm">
                                        <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3"></path>
                                        </svg>
                                    </div>
                                    {{--<div class="flex-fill ms-3">
                                        <span class="d-flex justify-content-between"><small class="text-primary">Holiday Sale</small><small class="text-muted">11:30 AM Today</small></span>
                                        <p class="mb-0 mt-1">Your New Campaign sale live on themeforest and our store is approved.</p>
                                    </div>--}}
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item py-2 py-md-1 col-auto">
                <div class="vr d-none d-sm-flex h-100 mx-sm-2"></div>
            </li>
            <li class="nav-item dropdown px-md-1">
                <a class="dropdown-toggle gray-6" href="#" id="bd-theme" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="theme-icon-active"><use href="#sun-fill"></use></svg>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 p-xl-3 shadow rounded-4" aria-labelledby="bd-theme">
                    <li class="mb-1"><a class="dropdown-item rounded-pill" href="#" data-bs-theme-value="light"><svg class="avatar xs me-2 opacity-50 theme-icon" fill="currentColor"><use href="#sun-fill"></use></svg> Işık</a></li>
                    <li class="mb-1"><a class="dropdown-item rounded-pill active" href="#" data-bs-theme-value="dark"><svg class="avatar xs me-2 opacity-50 theme-icon" fill="currentColor"><use href="#moon-stars-fill"></use></svg> Karanlık</a></li>
                    <li class="mb-1"><a class="dropdown-item rounded-pill" href="#" data-bs-theme-value="auto"><svg class="avatar xs me-2 opacity-50 theme-icon" fill="currentColor"><use href="#circle-half"></use></svg> Otomatik</a></li>
                </ul>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="display: none;">
                    <symbol id="sun-fill" viewBox="0 0 16 16">
                        <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                    </symbol>
                    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                    </symbol>
                    <symbol id="circle-half" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                    </symbol>
                </svg>
            </li>

            <li class="nav-item py-2 py-md-1 col-auto">
                <div class="vr d-none d-sm-flex h-100 mx-sm-2"></div>
            </li>
            <li class="nav-item user ms-3">
                <a class="dropdown-toggle gray-6 d-flex text-decoration-none align-items-center lh-sm p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User" data-bs-auto-close="outside">
                    <span class="ms-2 fs-6 d-none d-sm-inline-flex">{{ Auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow p-2 p-xl-3 rounded-4">
                    <div class="bg-body p-3 rounded-3">
                        <h4 class="mb-1 title-font text-gradient">{{ Auth()->user()->name }}</h4>
                        <p class="small text-muted">{{ Auth()->user()->email }}</p>
                    </div>
                    <ul class="list-unstyled mt-3">
                        <li><a class="dropdown-item rounded-pill" aria-label="my profile" href="">Profilim</a></li>
                        <li class="dropdown-divider"></li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="btn py-2 btn-primary w-100 mt-3 rounded-pill" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Oturumu kapat</a>
                </div>
            </li>
        </ul>
    </div>
</header>

<aside class="ps-4 pe-3 py-3 sidebar" data-bs-theme="none">
    <nav class="navbar navbar-expand-xl py-0">
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas_Navbar">
            <div class="offcanvas-header">
                <div class="d-flex">
                    <a href="{{ route('agent.dashboard') }}" class="brand-icon me-2">
                        <svg height="26" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="var(--primary-color)" fill-rule="evenodd" clip-rule="evenodd" d="M8.30814 0C6.02576 0 4.33695 1.99763 4.41254 4.16407C4.48508 6.24542 4.39085 8.94102 3.7122 11.1393C3.03153 13.3441 1.88034 14.7407 0 14.92V16.9444C1.88034 17.1237 3.03153 18.5203 3.7122 20.7251C4.39085 22.9234 4.48508 25.619 4.41254 27.7003C4.33695 29.8664 6.02576 31.8644 8.30847 31.8644H31.6949C33.9773 31.8644 35.6658 29.8668 35.5902 27.7003C35.5176 25.619 35.6119 22.9234 36.2905 20.7251C36.9715 18.5203 38.1197 17.1237 40 16.9444V14.92C38.1197 14.7407 36.9715 13.3441 36.2905 11.1393C35.6119 8.94136 35.5176 6.24542 35.5902 4.16407C35.6658 1.99797 33.9773 0 31.6949 0H8.30814Z"/>
                            <path fill="white" d="M30.0474 8.81267L20.0721 26.7214C19.8661 27.0911 19.337 27.0933 19.128 26.7253L8.95492 8.81436C8.72711 8.41342 9.06866 7.92768 9.52124 8.009L19.5072 9.80102C19.5709 9.81245 19.6361 9.81234 19.6998 9.80069L29.4769 8.01156C29.928 7.92899 30.2711 8.41086 30.0474 8.81267Z"/>
                            <path fill="var(--primary-color)" d="M22.9634 11.0029L18.4147 11.8178C18.3784 11.8243 18.3455 11.8417 18.3211 11.8672C18.2967 11.8927 18.2823 11.9248 18.2801 11.9586L18.0003 16.2791C17.9937 16.3808 18.0959 16.4598 18.2046 16.4369L19.471 16.1697C19.5895 16.1447 19.6966 16.2401 19.6722 16.3491L19.2959 18.0335C19.2706 18.1468 19.387 18.2438 19.5081 18.2101L20.2903 17.9929C20.4116 17.9592 20.5281 18.0564 20.5025 18.1699L19.9045 20.8157C19.8671 20.9812 20.1079 21.0715 20.2083 20.9296L20.2754 20.8348L23.9819 14.0722C24.044 13.959 23.937 13.8299 23.8009 13.8539L22.4974 14.0839C22.3749 14.1055 22.2706 14.0012 22.3052 13.8916L23.156 11.1951C23.1906 11.0854 23.086 10.981 22.9634 11.0029Z"/>
                        </svg>
                    </a>
                    <span class="fs-5">Visit</span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-column custom_scroll ps-4 ps-xl-0">
                <ul class="list-unstyled mb-4 menu-list">
                    <li>
                        <a href="{{ route('agent.dashboard') }}" aria-label="My Dashboard">
                            <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M10 12h4v4h-4z"></path>
                            </svg>
                            <span class="mx-2">Anasayfa</span>
                        </a>
                    </li>
                </ul>
                <h6 class="fl-title title-font ps-2 small text-uppercase text-muted" style="--text-color: var(--theme-color1)">Web Sitesi</h6>
                <ul class="list-unstyled mb-4 menu-list">
                    <li>
                        <a href="#Government" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="Government">
                            <span class="mx-2">Yerel Yönetim</span>
                        </a>
                        <ul class="collapse list-unstyled" id="Government">
                            <li><a href="{{ route('agent.government.index') }}">Yerel Yönetim</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#Culture" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="Culture">
                            <span class="mx-2">Kültür ve Sanat </span>
                        </a>
                        <ul class="collapse list-unstyled" id="Culture">
                            <li><a href="{{ route('agent.local-festivals.index') }}">Yerel Festivaller</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#News" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="News">
                            <span class="mx-2">Etkinlikler ve <br> Haberler </span>
                        </a>
                        <ul class="collapse list-unstyled" id="News">
                            <li><a href="{{ route('agent.events.index') }}"> Etkinlikler</a></li>
                            <li><a href="{{ route('agent.news.index') }}"> Haberler</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#Tourism" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="Tourism">
                            <span class="mx-2">Turizm </span>
                        </a>
                        <ul class="collapse list-unstyled" id="Tourism">
                            <li><a href="{{ route('agent.housing.index') }}"> Konaklama Rehberi </a></li>
                            <li><a href="{{ route('agent.tourism-office.index') }}"> Turizm Ofisleri </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</aside>

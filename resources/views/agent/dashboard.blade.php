@extends('agent.layouts.appAgent')
@section('title') Visit Denizli Panel - Dashboard @endsection
@section('content')
    <div class="px-md-4 px-2 py-2 page-header" data-bs-theme="none">
        <div class="d-flex align-items-center">
            <button class="btn d-none d-xl-inline-flex me-3 px-0 sidebar-toggle" type="button">
                <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                    <path d="M9 4v16"></path>
                    <path d="M15 10l-2 2l2 2"></path>
                </svg>
            </button>
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}" title="home">Gösterge Paneli</a></li>
                <li class="breadcrumb-item active" aria-current="page" title="App">Genel Bilgiler</li>
            </ol>
        </div>
        <ul class="list-unstyled action d-flex align-items-center mb-0">
            <li class="d-none d-xxl-inline-flex">
                <button class="btn px-0 rightbar-toggle" type="button">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                        <path d="M15 4v16"></path>
                        <path d="M9 10l2 2l-2 2"></path>
                    </svg>
                </button>
            </li>
            <li class="d-inline-flex d-xxl-none">
                <button class="btn border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_rightbar">
                    <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                        <path d="M15 4v16"></path>
                        <path d="M9 10l2 2l-2 2"></path>
                    </svg>
                </button>
            </li>
        </ul>
    </div>
    <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
        <ul class="row g-2 list-unstyled li_animate row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 row-deck mb-lg-5 mb-4">
            <li class="col">
                <a class="card hr-arrow p-4" href="{{ route('agent.news.index') }}" title="" style="--dynamic-color: var(--theme-color1);">
                    <svg class="mb-3" width="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.7" d="M4.97978 1C4.90484 1.00011 4.83088 1.01706 4.76338 1.0496C4.69587 1.08214 4.63654 1.12944 4.58978 1.188L1.53978 5H5.99978C6.13239 5 6.25957 5.05268 6.35334 5.14645C6.4471 5.24021 6.49978 5.36739 6.49978 5.5C6.49978 5.89782 6.65782 6.27936 6.93912 6.56066C7.22043 6.84196 7.60196 7 7.99978 7C8.39761 7 8.77914 6.84196 9.06044 6.56066C9.34175 6.27936 9.49978 5.89782 9.49978 5.5C9.49978 5.36739 9.55246 5.24021 9.64623 5.14645C9.74 5.05268 9.86717 5 9.99978 5H14.4598L11.4098 1.188C11.363 1.12944 11.3037 1.08214 11.2362 1.0496C11.1687 1.01706 11.0947 1.00011 11.0198 1H4.97978ZM3.80978 0.563C3.95017 0.387503 4.1282 0.245795 4.33071 0.148346C4.53322 0.050898 4.75504 0.000200429 4.97978 0L11.0198 0C11.2445 0.000200429 11.4663 0.050898 11.6689 0.148346C11.8714 0.245795 12.0494 0.387503 12.1898 0.563L15.8898 5.188C15.9315 5.24011 15.9624 5.30004 15.9806 5.36428C15.9988 5.42851 16.004 5.49574 15.9958 5.562L15.6058 8.686C15.5604 9.04889 15.3841 9.38271 15.1099 9.62469C14.8357 9.86667 14.4825 10.0001 14.1168 10H1.88278C1.51707 10.0001 1.16391 9.86667 0.889698 9.62469C0.61549 9.38271 0.43913 9.04889 0.393782 8.686L0.00378209 5.562C-0.00441416 5.49574 0.000742512 5.42851 0.0189479 5.36428C0.0371533 5.30004 0.0680387 5.24011 0.109782 5.188L3.80978 0.563Z"/>
                        <path opacity="0.2" d="M0.294097 11.0446C0.229438 11.0739 0.171762 11.1167 0.124907 11.17V11.169C0.0780298 11.2222 0.0429981 11.2847 0.0221368 11.3525C0.00127556 11.4202 -0.00493837 11.4917 0.00390735 11.562L0.393907 14.686C0.439256 15.0489 0.615615 15.3827 0.889823 15.6247C1.16403 15.8667 1.5172 16.0001 1.88291 16H14.1169C14.4826 16.0001 14.8358 15.8667 15.11 15.6247C15.3842 15.3827 15.5606 15.0489 15.6059 14.686L15.9959 11.562C16.0047 11.4917 15.9984 11.4203 15.9775 11.3525C15.9566 11.2848 15.9216 11.2223 15.8746 11.1691C15.8277 11.116 15.7701 11.0734 15.7055 11.0443C15.6409 11.0151 15.5708 11 15.4999 11H9.99991C9.8673 11 9.74012 11.0527 9.64635 11.1464C9.55259 11.2402 9.49991 11.3674 9.49991 11.5C9.49991 11.8978 9.34187 12.2794 9.06057 12.5607C8.77926 12.842 8.39773 13 7.99991 13C7.60208 13 7.22055 12.842 6.93925 12.5607C6.65794 12.2794 6.49991 11.8978 6.49991 11.5C6.49991 11.3674 6.44723 11.2402 6.35346 11.1464C6.25969 11.0527 6.13252 11 5.99991 11H0.499907C0.428915 11.0001 0.358755 11.0153 0.294097 11.0446Z"/>
                    </svg>
                    <h6 class="title mb-1">Haber Listesi <span class="badge rounded-pill bg-warning">{{ $newsCount }}</span></h6>
                    <div class="go-corner">
                        <div class="go-arrow">→</div>
                    </div>
                </a>
            </li>
            <li class="col">
                <a class="card hr-arrow p-4" href="{{ route('agent.events.index') }}" title="" style="--dynamic-color: var(--theme-color5);">
                    <svg class="mb-3" width="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.8" d="M6 8C6.79565 8 7.55871 7.68393 8.12132 7.12132C8.68393 6.55871 9 5.79565 9 5C9 4.20435 8.68393 3.44129 8.12132 2.87868C7.55871 2.31607 6.79565 2 6 2C5.20435 2 4.44129 2.31607 3.87868 2.87868C3.31607 3.44129 3 4.20435 3 5C3 5.79565 3.31607 6.55871 3.87868 7.12132C4.44129 7.68393 5.20435 8 6 8ZM1 14C1 14 0 14 0 13C0 12 1 9 6 9C11 9 12 12 12 13C12 14 11 14 11 14H1Z"/>
                        <path opacity="0.4" d="M11.1464 3.14645C11.0527 3.24021 11 3.36739 11 3.5C11 3.63261 11.0527 3.75979 11.1464 3.85355C11.2402 3.94732 11.3674 4 11.5 4H15.5C15.6326 4 15.7598 3.94732 15.8536 3.85355C15.9473 3.75979 16 3.63261 16 3.5C16 3.36739 15.9473 3.24021 15.8536 3.14645C15.7598 3.05268 15.6326 3 15.5 3H11.5C11.3674 3 11.2402 3.05268 11.1464 3.14645Z"/>
                        <path opacity="0.4" d="M11.1464 6.14645C11.2402 6.05268 11.3674 6 11.5 6H15.5C15.6326 6 15.7598 6.05268 15.8536 6.14645C15.9473 6.24021 16 6.36739 16 6.5C16 6.63261 15.9473 6.75979 15.8536 6.85355C15.7598 6.94732 15.6326 7 15.5 7H11.5C11.3674 7 11.2402 6.94732 11.1464 6.85355C11.0527 6.75979 11 6.63261 11 6.5C11 6.36739 11.0527 6.24021 11.1464 6.14645Z"/>
                        <path opacity="0.4" d="M13.1464 9.14645C13.2402 9.05268 13.3674 9 13.5 9H15.5C15.6326 9 15.7598 9.05268 15.8536 9.14645C15.9473 9.24021 16 9.36739 16 9.5C16 9.63261 15.9473 9.75979 15.8536 9.85355C15.7598 9.94732 15.6326 10 15.5 10H13.5C13.3674 10 13.2402 9.94732 13.1464 9.85355C13.0527 9.75979 13 9.63261 13 9.5C13 9.36739 13.0527 9.24021 13.1464 9.14645Z"/>
                        <path opacity="0.4" d="M13.1464 12.1464C13.2402 12.0527 13.3674 12 13.5 12H15.5C15.6326 12 15.7598 12.0527 15.8536 12.1464C15.9473 12.2402 16 12.3674 16 12.5C16 12.6326 15.9473 12.7598 15.8536 12.8536C15.7598 12.9473 15.6326 13 15.5 13H13.5C13.3674 13 13.2402 12.9473 13.1464 12.8536C13.0527 12.7598 13 12.6326 13 12.5C13 12.3674 13.0527 12.2402 13.1464 12.1464Z"/>
                    </svg>
                    <h6 class="title mb-1">Etkinlik Listesi <span class="badge rounded-pill bg-warning">{{ $eventCount }}</span></h6>
                    <div class="go-corner">
                        <div class="go-arrow">→</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@endsection

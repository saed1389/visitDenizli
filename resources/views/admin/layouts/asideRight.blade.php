<aside class="ps-4 pe-3 py-3 rightbar" data-bs-theme="none">
    <div class="navbar navbar-expand-xxl px-3 px-xl-0 py-0">
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvas_rightbar" aria-labelledby="offcanvas_rightbar">
            <div class="offcanvas-header" style="background: var(--body-color);">
                <h5 class="offcanvas-title">Rightbar quick access</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-column custom_scroll" style="background: var(--body-color);">
                <ul class="nav nav-tabs tab-card justify-content-between px-0" role="tablist">
                    <li class="nav-item" role="presentation"><button class="nav-link pt-0 active" data-bs-toggle="pill" data-bs-target="#pills_today" type="button" role="tab">Son Etkinlikler</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link pt-0" data-bs-toggle="pill" data-bs-target="#pills_wallet" type="button" role="tab">Son Haberler</button></li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="pills_today" role="tabpanel">
                        <ul class="row g-4 list-unstyled li_animate mb-0 trending-blog">
                            @php
                                $lastEvents = \App\Models\Event::orderBy('created_at', 'desc')->take(10)->get();
                            @endphp
                            @foreach($lastEvents as $item)
                                <li class="col-12 d-flex align-items-start">
                                    <div class="fs-3 text-muted lh-sm"><span class="d-inline-flex" style="min-width: 2.5rem;">{{ $loop->index + 1 }}</span></div>
                                    <div class="text-truncate ms-2 ps-3 border-start dashed border-0">
											<span class="d-flex align-items-center mb-3">
												<img class="avatar sm rounded-circle border border-3 me-2" src="{{ asset($item->image) }}" alt="avatar">
												{{ $item->name }}
											</span>
                                        <div class="d-flex align-items-center text-muted small">
                                            <span class="pe-3">{{ ($item->created_at) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills_wallet" role="tabpanel">
                        <ul class="row g-1 list-unstyled li_animate">
                            @php
                                $lastNews = \App\Models\News::orderBy('created_at', 'desc')->take(10)->get();
                            @endphp
                            @foreach($lastNews as $item)
                                <li class="col-12 d-flex align-items-start">
                                    <div class="fs-3 text-muted lh-sm"><span class="d-inline-flex" style="min-width: 2.5rem;">{{ $loop->index + 1 }}</span></div>
                                    <div class="text-truncate ms-2 ps-3 border-start dashed border-0">
											<span class="d-flex align-items-center mb-3">
												{{ $item->name }}
											</span>
                                        <div class="d-flex align-items-center text-muted small">
                                            <span class="pe-3">{{ ($item->created_at) }}</span>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

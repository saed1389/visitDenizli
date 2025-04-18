<div>
    <div class="map-container">
        <div id="map" wire:ignore></div>
        <div class="map-destination-detail-container d-none" id="mapDetailSidebar">
            <div class="close-bar">
                <span><i class="fa fa-times" aria-hidden="true" style="font-size: inherit;"></i></span>
            </div>
            <div class="google-maps-link">
                <span class="icon-google-map"></span>
                <a class="popup-direction" id="googleMapsLink" target="_blank" href="#">{{ __('pages.Get Directions from Google Maps.') }}</a>
            </div>
            <div class="map-detail-wrapper">
                <div class="banner">
                    <img id="sidebarImage" class="lazy" src="" alt="Location image">
                </div>
                <div class="map-detail-container">
                    <div class="content-box">
                        <div class="header">
                            <div class="title">
                                <h3 id="sidebarTitle">Location Name</h3>
                            </div>
                            <div class="location-rank">
                                <div class="location d-flex align-items-center">
                                    <span class="icon-map-maker d-sm-block"></span>
                                    <span id="sidebarAddress" class="text-for-location">Location Address</span>
                                </div>
                            </div>
                        </div>
                        <div id="sidebarContent" class="content read-more-content">
                            Location description will appear here...
                        </div>

                    </div>
                    <div class="read-detail-button">
                        <a id="detailLink" class="btn btn-brand" href="#">{{ __('pages.Click for details') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile sidebar (d-block d-md-none) -->
        <div class="mobile-destination-detail d-none d-md-none" id="mobileMapSidebar">
            <div class="mobile-destination-wrapper">
                <div class="image">
                    <img id="mobileImage" class="lazy" onerror="this.src = '{{ asset('front/assets/images/default-location.png') }}';" src="" alt="">
                </div>
                <div class="content">
                    <h3 id="mobileTitle"></h3>
                    <a id="mobileDetailLink" href="#" class="btn detail-btn">{{ __('pages.Click for details') }}</a>
                    <a target="_blank" id="mobileGoogleMapsLink" class="btn btn-brand" href="">
                        <span class="icon-google-map"></span> {{ __('pages.Get Directions from Google Maps.') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            @media (max-width: 767px) {
                .mobile-destination-detail {
                    position: absolute;
                    bottom: 0;
                    z-index: 999;
                    padding: 5px;
                }

                .mobile-destination-wrapper .image {
                    width: 40%;
                    display: flex;
                    height: 130px;
                    margin-right: 15px;
                }
                .mobile-destination-wrapper .image .lazy {
                    border-radius: 7px !important;
                    height: 100% !important;
                    width: 100% !important;
                    min-height: unset;
                }

                .mobile-destination-wrapper .content {
                    width: 60%;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                .mobile-destination-wrapper .content h3 {
                    display: block;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 16px;
                    color: #373737;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                }
                .mobile-destination-detail .mobile-destination-wrapper .content .detail-btn {
                    display: block;
                    border-radius: 7px;
                    background-color: #fff;
                    border: solid 1px #ff6579;
                    color: #ff6579;
                    padding: 5px 10px;
                    width: 100%;
                }
                .mobile-destination-detail .mobile-destination-wrapper .content .btn-brand  {
                    display: flex;
                    justify-content: space-evenly;
                    align-items: center;
                    font-size: 12px;
                    background-color: #ff6579;
                    color: white;
                    border-radius: 7px;
                    border: 0px;
                    outline: none;
                    padding: 5px 10px;
                    width: 100%;
                }

            }
            .custom-icon-wrapper {
                text-align: center;
                padding: 4px;
            }

            .custom-icon-img {
                vertical-align: middle;
                margin-bottom: 2px;
                z-index: 10;
                position: absolute;
            }

            .custom-icon-label {
                position: absolute;
                left: 90px;
                top: 15px;
                background-color: #fff;
                padding: 5px;
                padding-left: 20px;
                z-index: 9;
                max-width: 190px;
                font-size: 12px;
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
                border: 1px solid;
                color: #ffffff;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .custom-marker {
                background-color: white;
                padding: 4px 8px;
                border-radius: 8px;
                border: 2px solid #555;
                font-size: 12px;
                text-align: center;
                white-space: nowrap;
                box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            }

            /* Different colors/icons for types */
            .custom-marker-event {
                border-color: #ff5722;
                background-color: #ffe0b2;
            }

            .custom-marker-housing {
                border-color: #4caf50;
                background-color: #c8e6c9;
            }

            .custom-marker-villa {
                border-color: #3f51b5;
                background-color: #d1c4e9;
            }

            .custom-marker-apartment {
                border-color: #009688;
                background-color: #b2dfdb;
            }
            .marker-cluster div {
                background-color: #277fc8;
                color: white;
            }
            .popup-direction {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 16px;
                font-weight: bold;
                text-decoration: none;
                color: #ff6579;
            }

            #map {
                height: 100%;
                width: 100%;
                z-index: 1;
            }
            .map-container {
                position: relative;
                width: 100%;
                height: 500px;
            }
            .map-canvas {
                position: relative;
                min-height: 500px;
                width: 100%;
                z-index: 1;
            }
            .map-destination-detail-container {
                display: flex;
                position: absolute;
                top: 15%;
                width: 400px;
                height: 80%;
                background: white;
                z-index: 1000;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                overflow-y: auto;
                transition: right 0.3s ease;
            }

            .map-destination-detail-container.show {
                right: 0;
                border-radius: 5%;
            }

            .close-bar {
                position: absolute;
                left: -40px;
                top: 20px;
                background: white;
                padding: 8px 10px;
                border-radius: 5px;
                cursor: pointer;
                box-shadow: -2px 0 5px rgba(0,0,0,0.1);
                z-index: 1001;
            }

            .marker-cluster {
                background-clip: padding-box;
                border-radius: 20px;
            }
            .marker-cluster div {
                width: 30px;
                height: 30px;
                margin-left: 5px;
                margin-top: 5px;
                text-align: center;
                border-radius: 15px;
                font: 12px "Helvetica Neue", Arial, Helvetica, sans-serif;
                font-weight: bold;
            }
            .marker-cluster span {
                line-height: 30px;
            }

            img.lazy {
                background-color: #f5f5f5;
                min-height: 200px;
                width: 100%;
                object-fit: cover;
            }

            .map-wrapper {
                position: relative;
                width: 100%;
                height: 100%;
            }

            @media (min-width: 768px) {
                .map-wrapper .map-destination-detail-container {
                    width: 45vh;
                    position: absolute;
                    right: 0px;
                    top: 0px;
                    z-index: 999;
                }
            }
            .map-wrapper .map-destination-detail-container .close-bar {
                position: absolute;
                left: -40px;
                z-index: 9999999;
                top: 20px;
                background-color: #fff;
                padding: 8px 10px;
                border-radius: 7px;
                cursor: pointer;
                box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            }
            .map-wrapper .map-destination-detail-container .close-bar span {
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 18px;
            }
            .google-maps-link {
                position: absolute;
                z-index: 99999999;
                background-color: #fff;
                width: 90%;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: 20px;
                padding: 10px 20px;
                border-radius: 7px;
                display: flex;
                justify-content: space-around;
                text-align: center;
            }
            .map-wrapper .map-destination-detail-container .google-maps-link {
                position: absolute;
                z-index: 99999999;
                background-color: #fff;
                width: 90%;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: 20px;
                padding: 10px 20px;
                border-radius: 7px;
                display: flex;
                justify-content: space-around;
                text-align: center;
            }
            .map-wrapper .map-destination-detail-container .google-maps-link {
                position: absolute;
                z-index: 99999999;
                background-color: #fff;
                width: 90%;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: 20px;
                padding: 10px 20px;
                border-radius: 7px;
                display: flex;
                justify-content: space-around;
                text-align: center;
            }
            .map-detail-wrapper {
                width: 100%;
                height: 100%;
                position: relative;
                overflow-y: hidden;
                border-radius: 5%;
            }
            .banner {
                position: sticky;
                top: 0;
                z-index: 99999;
                height: 203px;
                display: flex;
                padding: 0!important;
                margin: 0!important;
            }
            .map-wrapper .map-destination-detail-container .map-detail-wrapper .banner img {
                width: 100%;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 5%;
            }
            .map-detail-container {
                padding: 25px;
                height: calc(100vh - 393px);
                width: 100%;
                top: -46px;
                position: relative;
                z-index: 99999;
            }
            .content-box {
                background-color: white;
                box-shadow: 0 2px 10px rgba(11, 11, 11, 0.2);
                position: relative;
                top: -22px;
                z-index: 99999;
                border-radius: 7px;
            }
            .content-box .header {
                position: sticky;
                top: -26px;
                z-index: 9;
                height: 85px;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 10px 25px;
            }
            .map-wrapper .map-destination-detail-container .map-detail-wrapper .map-detail-container .content-box .header .title h3 {
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 20px;
                color: #373737;
                font-weight: bold;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 1.5;
            }
            .location-rank {
                display: flex;
                justify-content: space-between;
                margin-top: 7px;
            }
            .location {
                display: flex;
            }
            .icon-map-maker {
                background: url({{ asset('front/assets/images/icon-sprite.svg') }}) no-repeat -1390px -135px;
                width: 25px;
                height: 24px;
            }
            .text-for-location {
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 14px;
                color: #939393;
                font-weight: 600;
            }
            .content.read-more-content {
                max-height: 220px;
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 14px;
            }
            .content-box .content {
                padding: 30px 25px 40px;
            }
            .read-detail-button {
                display: flex;
                justify-content: center;
                position: relative;
                top: -45px;
                z-index: 9999999;
            }
            .btn {
                display: block;
                width: 80%;
            }
            .album {
                margin-top: 15px;
            }
            .mobile-destination-wrapper {
                display: inline-flex;
                background-color: #fff;
                border-radius: 7px;
                height: 150px;
                flex-direction: row;
                padding: 10px;
            }
            .image {
                width: 40%;
                display: flex;
                height: 130px;
                margin-right: 15px;
            }
            .map-wrapper .map-destination-detail-container .mobile-destination-detail .mobile-destination-wrapper .image img {
                border-radius: 7px;
                height: 100%;
                width: 100%;
            }
            .content {
                width: 60%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .map-wrapper .map-destination-detail-container .mobile-destination-detail .mobile-destination-wrapper .content h3 {
                display: block;
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 16px;
                color: #373737;
                font-weight: bold;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            body.theme-red .map-wrapper .mobile-destination-detail .mobile-destination-wrapper .content .detail-btn {
                border: solid 1px #ff6579;
                color: #ff6579;
            }
           .detail-btn {
                display: block;
                border-radius: 7px;
                background-color: #fff;
            }
            .btn-brand {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                font-family: "Izmir", Arial, Helvetica, sans-serif;
                font-size: 12px;
                background-color: #ff6579;
                color: white;
            }
            .btn-brand:hover {
                transition: all 0.2s ease-out;
                box-shadow: 0 3px 8px 0 #ff6579!important;
                -moz-box-shadow: 0 3px 8px 0 #ff6579!important;
                -webkit-box-shadow: 0 3px 8px 0 #ff6579!important;
                color: white!important;
            }
            .icon-google-map {
                background: url({{ asset('front/assets/images/icon-sprite.svg') }}) no-repeat -1269px -197px;
                width: 18px;
                height: 25px;
                display: block;
            }

            @media (max-width: 767px) {
                .map-destination-detail-container {
                    width: 90%;
                    right: -90%;
                }
                .close-bar {
                    left: auto;
                    right: 20px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            function handleImageError(img) {
                img.onerror = null;
                img.src = "{{ asset('front/assets/images/default-location.png') }}";
                img.alt = 'Image not available';
            }

            document.addEventListener('DOMContentLoaded', async function () {
                console.time('MapInit');

                async function loadMarkerCluster() {
                    return new Promise((resolve, reject) => {
                        if (typeof L !== 'undefined' && typeof L.MarkerClusterGroup !== 'undefined') {
                            resolve();
                            return;
                        }

                        const tryLoad = (url, fallback) => {
                            const script = document.createElement('script');
                            script.src = url;
                            script.onload = resolve;
                            script.onerror = fallback;
                            document.head.appendChild(script);
                        };

                        tryLoad(
                            'https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.js',
                            () => tryLoad(
                                'https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js',
                                reject
                            )
                        );
                    });
                }

                try {
                    await loadMarkerCluster();
                    console.log('MarkerCluster loaded');
                } catch (e) {
                    console.warn('MarkerCluster failed to load, using basic markers.', e);
                }

                const map = L.map('map').setView([37.7765, 29.0864], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                const createClusterCustomIcon = function (cluster) {
                    return L.divIcon({
                        html: `<div><span>${cluster.getChildCount()}</span></div>`,
                        className: 'marker-cluster',
                        iconSize: L.point(40, 40, true)
                    });
                };

                const markerGroup = typeof L.MarkerClusterGroup === 'function'
                    ? L.markerClusterGroup({
                        iconCreateFunction: createClusterCustomIcon,
                        spiderfyOnMaxZoom: false,
                        showCoverageOnHover: false
                    })
                    : L.layerGroup();

                map.addLayer(markerGroup);

                function showSidebar(locationData) {
                    const isMobile = window.innerWidth < 768;
                    const defaultImage = "{{ asset('front/assets/images/default-location.png') }}";

                    const setImage = (imgElement, url) => {
                        imgElement.onerror = () => {
                            imgElement.src = defaultImage;
                        };
                        imgElement.src = url;
                    };

                    const updateSidebarUI = (imgUrl) => {
                        if (isMobile) {
                            const mobileSidebar = document.getElementById('mobileMapSidebar');
                            document.getElementById('mobileTitle').textContent = locationData.name;
                            document.getElementById('mobileDetailLink').href = locationData.detailUrl || '#';
                            document.getElementById('mobileGoogleMapsLink').href = `https://www.google.com/maps/dir/${locationData.latitude},${locationData.longitude}`;
                            setImage(document.getElementById('mobileImage'), imgUrl);
                            mobileSidebar.classList.add('show');
                            mobileSidebar.classList.remove('d-none');
                        } else {
                            const sidebar = document.getElementById('mapDetailSidebar');
                            document.getElementById('sidebarTitle').textContent = locationData.name;
                            document.getElementById('sidebarAddress').textContent = locationData.address || 'Denizli, Turkey';
                            document.getElementById('sidebarContent').textContent = locationData.description || 'No description available';
                            document.getElementById('detailLink').href = locationData.detailUrl || '#';
                            document.getElementById('googleMapsLink').href = `https://www.google.com/maps/dir/${locationData.latitude},${locationData.longitude}`;
                            setImage(document.getElementById('sidebarImage'), imgUrl);
                            sidebar.classList.add('show');
                            sidebar.classList.remove('d-none');
                        }
                    };

                    const apiUrl = locationData.imageApi;

                    if (apiUrl) {
                        fetch(apiUrl)
                            .then(res => res.json())
                            .then(data => {
                                const fullImgUrl = data.image ? data.image : defaultImage;
                                updateSidebarUI(fullImgUrl);
                            })
                            .catch(() => {
                                updateSidebarUI(defaultImage);
                            });
                    } else {
                        updateSidebarUI(defaultImage);
                    }
                }

                function hideSidebar() {
                    const sidebar = document.getElementById('mapDetailSidebar');
                    const mobileSidebar = document.getElementById('mobileMapSidebar');
                    sidebar.classList.remove('show');
                    sidebar.classList.add('d-none');
                    mobileSidebar.classList.remove('show');
                    map.setView(map.getCenter(), map.getZoom(), { paddingTopRight: [0, 0] });
                }

                document.querySelector('.close-bar').addEventListener('click', hideSidebar);

                document.addEventListener('click', function (e) {
                    if (!e.target.closest('.map-destination-detail-container') &&
                        !e.target.closest('.leaflet-marker-icon')) {
                        hideSidebar();
                    }
                });

                function getFullIconUrl(path) {
                    if (path.startsWith('http')) return path;
                    return `${window.location.origin}/${path}`;
                }

                const createCustomIcon = (location) => {
                    const html = `
                <div class="custom-icon-wrapper" style="border-color: ${location.color};">
                    <img src="${getFullIconUrl(location.icon)}" alt="icon" class="custom-icon-img" />
                    <div class="custom-icon-label" style="background-color: ${location.color}">${location.name}</div>
                </div>`;
                    return L.divIcon({
                        html,
                        className: '',
                        iconSize: [100, 50],
                        iconAnchor: [50, 50]
                    });
                };

                const locations = @json($locations);

                locations.forEach(function (location) {
                    if (location.latitude && location.longitude) {
                        const marker = L.marker(
                            [location.latitude, location.longitude],
                            { icon: createCustomIcon(location) }
                        ).on('click', function () {
                            showSidebar({
                                name: location.name,
                                latitude: location.latitude,
                                longitude: location.longitude,
                                address: location.address,
                                description: location.description,
                                detailUrl: location.detailUrl || '#',
                                imageApi: location.imageApi || null // ✅ Added here
                            });
                        });

                        markerGroup.addLayer(marker);
                    }
                });

                const userMarker = L.marker([0, 0], {
                    icon: L.divIcon({
                        html: '<div class="pulse-marker"></div>',
                        className: 'pulse-icon',
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    })
                });

                function onLocationFound(e) {
                    userMarker.setLatLng(e.latlng).addTo(map).bindPopup("You are here");
                }

                map.on('locationfound', onLocationFound);
                map.locate({ enableHighAccuracy: true, setView: false });

                console.timeEnd('MapInit');
            });
        </script>
    @endpush
</div>

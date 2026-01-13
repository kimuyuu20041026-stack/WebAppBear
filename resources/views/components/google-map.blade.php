@props([
    'lat' => 35.681236,
    'lng' => 139.767125,
    'zoom' => 15,
    'height' => '400px',
    'title' => '地図'
])

<div class="google-map-wrapper">
    <div 
        class="map-container" 
        data-lat="{{ $lat }}" 
        data-lng="{{ $lng }}" 
        data-zoom="{{ $zoom }}" 
        data-title="{{ $title }}"
        style="width: 100%; height: {{ $height }}; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
    ></div>
</div>

@once
@push('styles')
<style>
    .google-map-wrapper {
        margin: 20px 0;
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&language=ja" async defer></script>
<script>
    let mapsLoaded = false;
    let mapInstances = [];
    
    function initializeGoogleMaps() {
        if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
            console.error('Google Maps APIが読み込まれていません');
            return;
        }
        
        const mapContainers = document.querySelectorAll('.map-container');
        
        mapContainers.forEach((container) => {
            const lat = parseFloat(container.dataset.lat);
            const lng = parseFloat(container.dataset.lng);
            const zoom = parseInt(container.dataset.zoom);
            const title = container.dataset.title;
            
            const location = { lat: lat, lng: lng };
            
            const map = new google.maps.Map(container, {
                zoom: zoom,
                center: location,
                mapTypeId: 'roadmap'
            });
            
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: title,
                animation: google.maps.Animation.DROP
            });
            
            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="padding: 10px;">
                    <strong>${title}</strong><br>
                    緯度: ${lat}<br>
                    経度: ${lng}
                </div>`
            });
            
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
            
            mapInstances.push({
                map: map,
                marker: marker,
                container: container
            });
        });
        
        mapsLoaded = true;
        console.log('Google Mapsが正常に初期化されました。地図数:', mapInstances.length);
    }
    
    window.initMap = initializeGoogleMaps;
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                if (typeof google !== 'undefined' && typeof google.maps !== 'undefined' && !mapsLoaded) {
                    initializeGoogleMaps();
                }
            }, 1000);
        });
    }
</script>
@endpush
@endonce
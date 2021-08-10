@extends('layouts.main')

@section('title', "店舗情報修正")

@section('content')
<h1>店舗情報修正</h1>

<form action="{{ route('shops.update', $shop) }}" method="post">
    @method('PATCH')
    @csrf
    <div>
        <label>
            店舗名:
            <input type="text" name="name" value="{{ $shop->name }}">
        </label>
    </div>
    <div>
        <label>
            詳細:
            <textarea name="description" cols="30" rows="10">{{ $shop->description }}</textarea>
        </label>
    </div>
    <div>
        <label>
            住所:
            <input type="text" name="address" value="{{ $shop->address }}">
        </label>
    </div>
    <input type="hidden" id="latitude" name="latitude" value="{{ $shop->latitude }}">
    <input type="hidden" id="longitude" name="longitude" value="{{ $shop->longitude }}">
    <div id="map" style="height: 50vh;"></div>
    <div>
        <input type="submit" value="修正">
    </div>
</form>

<a href="{{ route('shops.show', $shop) }}">詳細へ戻る</a>
@endsection

@section('script')
@include('partial.map')
<script defer>
    const lat = document.getElementById('latitude');
    const lng = document.getElementById('longitude');
    let clicked;

    @if(isset($shop))
        var marker = L.marker([{{ $shop->latitude}}, {{ $shop->longitude}}], {draggable: true})
            .bindPopup("{{ $shop->name }}", {closeButton: false})
            .addTo(map);
        marker.on("dragend", function(e) {
            var position = e.target.getLatLng();
            lat.value = position['lat'];
            lng.value = position['lng'];
            this.bindPopup(position.toString()).openPopup();
        });
    @endif

    map.on('click', function(e) {
        if (clicked !== true) {
            clicked = true;
            lat.value = e.latlng['lat'];
            lng.value = e.latlng['lng'];
            var marker = L.marker([e.latlng['lat'], e.latlng['lng']], {draggable: true}).addTo(map);
            
            marker.on("dragend", function(e) {
                var position = e.target.getLatLng();
                lat.value = position['lat'];
                lng.value = position['lng'];
                this.bindPopup(position.toString()).openPopup();
            });
        }
    });

</script>
@endsection
@extends('layouts.main')

@section('title', "店舗情報登録")

@section('content')

<h1>店舗情報登録</h1>

<form action="{{ route('shops.store') }}" method="post">
    @csrf
    <div>
        <label>
            店舗名:
            <input type="text" name="name" value="{{ old('name') }}">
        </label>
    </div>
    <div>
        <label>
            詳細:
            <textarea name="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </label>
    </div>
    <div>
        <label>
            住所:
            <input type="text" name="address" value="{{ old('address') }}">
        </label>
    </div>
    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
    <div id="map" style="height: 50vh;"></div>
    <div>
        <input type="submit" value="登録">
    </div>
</form>
<a href="{{ route('shops.index') }}">一覧へ戻る</a>
@endsection

@section('script')
@include('partial.map')
<script defer>
    const lat = document.getElementById('latitude');
    const lng = document.getElementById('longitude');
    let clicked;

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
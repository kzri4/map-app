@extends('layouts.main')

@section('title', "店舗情報修正")

@section('content')
<h1>店舗情報修正</h1>

<form action="{{ route('shops.update', $shop) }}" method="post">
    @csrf
    @method('put')
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

        @if (isset($shop))
           // 中心とzoomを指定
            map.setView([{{ $shop->latitude }}, {{ $shop->longitude }}], 5);
            var marker = L.marker([{{ $shop->latitude }}, {{ $shop->longitude }}, {draggable: true}])
                .bindPopup("{{ $shop->name }}", {closeButton: false})
                .addTo(map);
        @endif
        marker.on("dragend", function(e) {
            var position = e.target.getLatLng();
            lat.value=position['lat'];
            lng.value=position['lng'];
            this.bindPopup(position.toString()).openPopup();
        });
    </script>
@endsection
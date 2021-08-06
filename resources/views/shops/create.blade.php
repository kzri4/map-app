@extends('layouts.main')

@section('title', "店舗情報登録")

@section('content')

<h1>店舗情報登録</h1>

<form action="{{ route('shops.store') }}" mehthod="post">
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
    <div id="map" style="height: 50vh;"></div>
    <div>
        <input type="submit" value="登録">
    </div>
</form>
<a href="{{ route('shops.index') }}">一覧へ戻る</a>
@endsection

@section('script')
    @include('partial.map')
    <script>
    $clicked;
    @if ($clicked !== true) 
        clicked=true;
        map.on('click', function(e) {
            L.marker([e.latlng['lat'], e.latlng['lng']], {draggable: true}).addTo(map);
        });
    @endif
    </script>
@endsection
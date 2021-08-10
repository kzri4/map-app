@extends('layouts.main')

@section('title', "店舗情報")

@section('content')
<h1>店舗情報</h1>

<div>店舗名:{{ $shop->name }}</div>
<div>
    詳細:
    <div>{{ $shop->description }}</div>
</div>
<div>
    住所:
    <div>{{ $shop->address }}</div>
</div>

<div id="map" style="height:50vh;"></div>

<a href="{{ route('shops.index') }}">index</a>
<a href="{{ route('shops.edit', $shop) }}">edit</a>

<form action="{{ route('shops.destroy', $shop) }}" method="post" name="form1" style="display: inline">
    @csrf
    @method('delete')
    <a href="javascript:form1.submit()">destroy</a>
</form>
@endsection

@section('script')
    @include('partial.map')
    <script defer>
        @if (isset($shop)) 
            L.marker([{{ $shop->latitude }},{{ $shop->longitude }}])
            .bindPopup("{{ $shop->name }}", {closeButton: false})
            .addTo(map);
        @endif
    </script>
@endsection
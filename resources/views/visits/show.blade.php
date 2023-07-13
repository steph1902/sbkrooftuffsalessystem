@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home') }}">Go back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="padding:2%;"></div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Shop Details') }}</div>
                <div class="card-body">
                    <h2>{{ $visit->shop_name }}</h2>
                    <p>Visit Date: <b>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</b></p> <br>
                    <p>Address: {{ $visit->shop_address }}</p>
                    <p>Region: {{ $visit->shop_region }}</p>
                    <p>City: {{ $visit->shop_city }}</p>
                    <p>District: {{ $visit->shop_district }}</p>
                    <p>Subdistrict: {{ $visit->shop_subdistrict }}</p>

                    <h2>Visit Details</h2>
                    <p>Location: {{ $visit->location }}</p>
                    <p>Notes: {{ $visit->notes }}</p>
                    <p>Materials: {{ $visit->materials }}</p>

                    @if ($visit->photo)
                        <p>Photo Toko Depan:</p>
                        <img src="{{ asset('storage/' . $visit->photo) }}" alt="Photo Toko Depan">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($seasons as $season)
                <li><a href="{{ route('show_season', ['year' => $season->year]) }}">{{ $season->year }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection

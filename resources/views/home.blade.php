@extends('app')

@section('content')
    <div class="container">
        <ul>
            <li><a href="{{ route('seasons') }}">Seasons</a></li>
            <li><a href="{{ route('races') }}">Races</a></li>
            <li><a href="{{ route('drivers') }}">Drivers</a></li>
        </ul>
    </div>
@endsection

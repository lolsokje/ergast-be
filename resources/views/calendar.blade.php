@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>{{ $year }} Calendar</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>ROUND</th>
                    <th>NAME</th>
                    <th>DATE</th>
                    <th>REPORT</th>
                    <th>DETAILS</th>
                </tr>
                </thead>
                @foreach ($races as $race)
                    <tr>
                        <td>{{ $race->round }}</td>
                        <td>{{ $race->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($race->date)) }}</td>
                        <td><a href="{{ $race->url }}">Wikipedia</a></td>
                        <td><a href="{{ route('race_details', ['raceId' => $race->raceId]) }}">Details</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

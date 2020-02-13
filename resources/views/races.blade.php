@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>YEAR</th>
                <th>NAME</th>
                <th>REPORT</th>
                <th>DETAILS</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($races as $race)
                <tr>
                    <td>{{ $race->year }}</td>
                    <td>{{ $race->name }}</td>
                    <td><a href="{{ $race->url }}" target="_blank">Wikipedia</a></td>
                    <td><a href="{{ route('race_details', ['race' => $race->raceId]) }}">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $races->links() }}
    </div>
@endsection

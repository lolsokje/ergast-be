@extends('layouts.app')
<?php /** @var \App\Result $result */ ?>
@section('content')
    <div class="container">
        <h2><a href="{{ $driver->url }}" target="_blank">{{ $driver->fullName() }}</a> | <span class="small">{{ $results->total() }} races, showing {{ count($results) }}</span></h2>
        <div class="card mb-3" style="width:35%">
            <div class="card-header">
                Career stats
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($driver->stats() as $stat)
                    <li class="list-group-item">{{ $stat['amount'] }} {{ $stat['label'] }}</li>
                @endforeach
            </ul>
        </div>
        {{ $results->links() }}
        <div class="col-md-6">
            <table class="table">
                <thead>
                <tr>
                    <th>RACE</th>
                    <th>GRID</th>
                    <th>FINISH</th>
                    <th>DETAILS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->race->raceName(false) }}</td>
                        <td>{{ $result->grid }}</td>
                        <td>{{ $result->finishingPosition() }}</td>
                        <td><a href="{{ route('race_details', ['race' => $result->race->raceId]) }}">Details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

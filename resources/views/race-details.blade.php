@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3>{{ $race->raceName() }} QUALIFYING RESULTS</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>POS</th>
                    <th>DRIVER</th>
                    <th>TEAM</th>
                    <th>#</th>
                    <th>Q1 TIME</th>
                    <th>Q2 TIME</th>
                    <th>Q3 TIME</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($race->qualifying as $qualy)
                        <tr>
                            <td>{{ $qualy->position }}</td>
                            <td>{{ $qualy->driver->fullName() }}</td>
                            <td>{{ $qualy->constructor->name }}</td>
                            <td>{{ $qualy->driver->number }}</td>
                            <td>{{ $qualy->q1 }}</td>
                            <td>{{ $qualy->q2 }}</td>
                            <td>{{ $qualy->q3 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>{{ $race->raceName() }} RACE RESULTS</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>GRID</th>
                    <th>POS</th>
                    <th>DRIVER</th>
                    <th>TEAM</th>
                    <th>#</th>
                    <th>RACE TIME</th>
                    <th>LAPS</th>
                    <th>POINTS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($race->results as $result)
                    <tr>
                        <td>{{ $result->grid }}</td>
                        <td>
                            @if ($result->position === null)
                                RETIRED
                            @else
                                {{ $result->position }}
                            @endif
                        </td>
                        <td>{{ $result->driver->fullName() }}</td>
                        <td>{{ $result->constructor->name }}</td>
                        <td>{{ $result->number  }}</td>
                        <td>
                            @if ($result->time === null)
                                {{ $result->status->status }}
                            @else
                                {{ $result->time }}
                            @endif
                        </td>
                        <td>{{ $result->laps }}</td>
                        <td>{{ $result->points }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

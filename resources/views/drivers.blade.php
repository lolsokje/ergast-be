@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>DRIVER</th>
                <th>DATE OF BIRTH</th>
                <th>AGE</th>
                <th>RACES</th>
                <th>DETAIL</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($drivers as $driver)
                <tr>
                    <td>{{ $driver->fullName() }}</td>
                    <td>{{ $driver->dob }}</td>
                    <td>{{ $driver->age() }}</td>
                    <td>{{ count($driver->results) }}</td>
                    <td><a href="{{ route('driver_details', ['driver' => $driver->driverId]) }}">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $drivers->links() }}
    </div>
@endsection

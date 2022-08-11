@extends('app')

@section('content')
    <div class="container">
        <h3>Today's birthdays:</h3>
        <ul>
            @foreach ($birthdays as $driver)
                <li>
                    <a href="{{ route('driver_details', ['driver' => $driver->driverId]) }}">
                        {{ $driver->fullName() }}
                    </a> (age {{ $driver->age(true) }})
                </li>
            @endforeach
        </ul>

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

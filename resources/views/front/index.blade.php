@extends('admin.layouts.frame')
@section('content')
<div class="container-fluid">
        <h2>Jadwal Booking</h2>
        <form method="POST" action="{{ route('booking.store') }}">
            @csrf
            <input type="date" name="booking_date" class="form-control" required>
            <input type="text" name="user_name" class="form-control mt-3" value="{{ Auth::user()->id }}" placeholder="{{ Auth::user()->name }}" required>
            <select name="package_id" class="form-control mt-3" required>


                @foreach ($packages as $package )
                {{-- <option value="{{ $package->id }}">{{ $package->package_name }}</option> --}}
                 <option value="{{ $package->id }}">
                                    {{ $package->package_name }}
                                </option>
                @endforeach
            </select>
            <input type="time" name="booking_time" class="form-control mt-3"  required>
            <button type="submit" class="btn btn-primary mt-3">Booking</button>
        </form>
        <h2 class="mt-5">Booking yang telah ada</h2>
        {{-- <ul class="list-group">
            @foreach($bookings as $booking)

                <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ '#' . $booking->id }} - {{ $booking->package->package_name }} - {{ $booking->booking_date }} - {{ $booking->booking_time }} - {{ $booking->user->name }}</span>
                    <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success text-light' : 'bg-warning text-light' }}">
                        {{ $booking->status }}
                    </span>
                </a>
            @endforeach
        </ul> --}}
        <div class=" table-responsive card p-3 mt-3">
        <table id="example3" class="table table-striped table-hover align-middle w-100">
        <thead class="table-light">
            <tr>
            <th>ID</th>
            <th>Paket</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Nama</th>
            <th>Status</th>
            <th>View Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            @php
                $isConfirmed = $booking->status === 'confirmed';
                $datetimeForSort = \Carbon\Carbon::parse($booking->booking_date.' '.$booking->booking_time)->format('YYYY-MM-DD HH:mm');
            @endphp
            {{-- <tr data-href="{{ route('booking.show', $booking->id ?? 0) }}"> --}}
            <tr >
                <td>#{{ $booking->id }}</td>
                <td>{{ $booking->package->package_name }}</td>
                {{-- kolom tanggal & waktu diberi data-order agar sorting akurat --}}
                <td data-order="{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}">
                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                </td>
                <td data-order="{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}">
                {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}
                </td>
                <td>{{ $booking->user->name }}</td>
                {{-- <td data-order="{{ $isConfirmed ? 1 : 2 }}"> --}}
                <td>
                <span class="badge {{ $isConfirmed ? 'bg-success text-light' : 'bg-warning text-light' }}">
                    {{ ucfirst($booking->status) }}
                </span>
                </td>
                <td><a href="{{ route('booking.show', $booking->id ?? 0) }}" class="btn btn-info btn-sm">Detail</a></td>

            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
    </div>
@endsection

@extends('admin.layouts.frame')
@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $page }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $judul_page }}</a></li>
            </ol>
        </div>

        <h3>Detail Booking</h3>
    <div class="row">
        <div class="grid col-md-6">
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $booking->id }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $booking->booking_date }}</td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td>{{ $booking->booking_time }}</td>
            </tr>
            <tr>
                <th>Paket</th>
                <td>{{ $booking->package->package_name }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success text-light' : 'bg-warning text-light' }}">
                        {{ $booking->status }}
                    </span>
                </td>
            </tr>
        </table>

        </div>
        <div class="grid col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h5>Bukti Pembayaran</h5>
                </div>
                <div class="card-body">
                    {{-- @if($booking->payment_proof)
                        <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid">
                    @else
                        <p>Belum ada bukti pembayaran.</p>
                    @endif --}}
                    <img src="https://placehold.co/600x800?text=Bukti%20Pembayaran&font=montserrat&format=webp" alt="Bukti Pembayaran" class="img-fluid">
                    @if ($booking->status === 'confirmed')
                        <p class="mt-3 "><span class="badge bg-success text-light w-100">Payment has been confirmed.</span></p>
                    @else
                    <a href="{{ route('booking.approve', $booking->id) }}" class="btn btn-primary mt-2">Approve</a>
                    @endif
                    <a href="{{url('/booking') }}" class="btn btn-primary mt-2">Back</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

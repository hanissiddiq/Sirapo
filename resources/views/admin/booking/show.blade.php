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
                    <div class="justify-content-center text-center">
                    @if($booking->payments->payment_proof)
                        <img  src="{{ asset('storage/' . $booking->payments->payment_proof) }}" alt="Bukti Pembayaran" class="img-fluid w-50">
                    @else
                        <img src="https://placehold.co/600x800?text=Belum%20Ada%20Bukti%20Pembayaran&font=montserrat&format=webp" alt="Bukti Pembayaran" class="img-fluid">
                    @endif
                    {{-- <img src="https://placehold.co/600x800?text=Bukti%20Pembayaran&font=montserrat&format=webp" alt="Bukti Pembayaran" class="img-fluid"> --}}
                    <div class="text-start">

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
    </div>
    </div>
@endsection

@extends('admin.layouts.frame')
@section('content')
    <div class="container-fluid">
        <h2>Jadwal Booking</h2>
        <form method="POST" action="{{ route('booking.store') }}">
            @csrf
            <input type="date" name="booking_date" class="form-control" required>
            <input type="text" name="user_name" class="form-control mt-3" value="{{ Auth::user()->id }}"
                placeholder="{{ Auth::user()->name }}" required>
            <select id ="package_id" name="package_id" class="form-control mt-3" required>
                <option value="" disabled selected>Pilih Paket</option>


                @foreach ($packages as $package)
                    {{-- <option value="{{ $package->id }}">{{ $package->package_name }}</option> --}}
                    <option value="{{ $package->id }}" data-name="{{ $package->package_name }}"
                        data-description="{{ e($package->description) }}"
                        data-price="{{ 'Rp. ' . number_format($package->price, 0, ',', '.') }}">
                        {{ $package->package_name }} -
                        {{ 'Rp.' . number_format($package->price, 0, ',', '.') }}

                    </option>
                @endforeach
            </select>


            {{-- Card detail paket (hidden dulu) --}}
            <div id="packageCard" class="card d-none mt-3">
                <div class="card-body">
                    <h5 class="card-title" id="packageTitle">—</h5>
                    <p class="card-text" id="packageDesc">—</p>
                    Harga:
                    <span class="badge bg-warning text-black" id="packagePrice"> </span>

                </div>
            </div>

            <input type="time" name="booking_time" class="form-control mt-3" required>
            <button type="submit" class="btn btn-primary mt-3">Booking</button>
        </form>
        <h2 class="mt-5">Booking yang telah ada</h2>
        {{-- <ul class="list-group">
            @foreach ($bookings as $booking)

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
                    @foreach ($bookings as $booking)
                        @php
                            $isConfirmed = $booking->status === 'confirmed';
                            $datetimeForSort = \Carbon\Carbon::parse(
                                $booking->booking_date . ' ' . $booking->booking_time,
                            )->format('YYYY-MM-DD HH:mm');
                        @endphp
                        {{-- <tr data-href="{{ route('booking.show', $booking->id ?? 0) }}"> --}}
                        <tr>
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
                            <td><a href="{{ route('booking.show', $booking->id ?? 0) }}"
                                    class="btn btn-info btn-sm">Detail</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('package_id');
            const card = document.getElementById('packageCard');
            const title = document.getElementById('packageTitle');
            const desc = document.getElementById('packageDesc');
            const price = document.getElementById('packagePrice');


            function updateCard() {
                const opt = select.options[select.selectedIndex];
                if (!opt || !opt.value) {
                    card.classList.add('d-none');
                    return;
                }
                title.textContent = opt.getAttribute('data-name') || '';
                // pakai textContent untuk aman dari HTML injection
                desc.textContent = opt.getAttribute('data-description') || '';
                price.textContent = opt.getAttribute('data-price') || '';

                card.classList.remove('d-none');
            }

            select.addEventListener('change', updateCard);

            // Jika ada nilai lama (old input) atau default terpilih, tampilkan saat load
            if (select.value) updateCard();
        });
    </script>
@endsection

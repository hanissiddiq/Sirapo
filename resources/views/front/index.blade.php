@extends('admin.layouts.frame')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <script>
                window.onload = function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            </script>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $times = ['08:00', '09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00'];
        @endphp

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

            {{-- <input type="time" name="booking_time" class="form-control mt-3" required> --}}
            <select name="booking_time" class="form-control mt-3" required>
                <option value="" disabled selected>Pilih Waktu</option>
                @foreach ($times as $t)
                    @php
                        $booked = $bookings->where('booking_time', $t)->count() > 0;
                    @endphp
                    <option value="{{ $t }}" {{ $booked ? 'disabled' : '' }}>
                        {{ $t }} {{ $booked ? '(Sudah Penuh)' : '' }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Booking</button>
        </form>
        <h2 class="mt-5">Booking yang telah ada</h2>

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
                        @hasanyrole('owner|staff')
                            <th>View Detail</th>
                            <th>Actions</th>
                        @endhasanyrole
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
                            {{-- <td>{{ $booking->user->name }}</td> --}}
                            <td>{{ $booking->user ? $booking->user->name : 'No User' }}</td>

                            @php
                                $status = strtolower($booking->status ?? '');
                                $map = [
                                    'pending' => 'btn btn-xs btn-warning',
                                    'confirmed' => 'btn btn-xs btn-success',
                                    'in-progress' => 'btn btn-xs btn-secondary',
                                    'finish' => 'btn btn-xs btn-primary',
                                    'cancel' => 'btn btn-xs btn-danger',
                                ];
                                $btnClass = $map[$status] ?? 'btn btn-outline-secondary';
                            @endphp
                            {{-- <td data-order="{{ $isConfirmed ? 1 : 2 }}"> --}}
                            <td>
                                <button type="button" class="{{ $btnClass }}">
                                    {{ \Illuminate\Support\Str::of($status)->replace('-', ' ')->ucfirst() }}
                                </button>

                                {{-- <span class="badge {{ $isConfirmed ? 'bg-success text-light' : 'bg-warning text-light' }}">
                                    {{ ucfirst($booking->status) }}
                                </span> --}}
                            </td>
                            @hasanyrole('owner|staff')
                            <td><a href="{{ route('booking.show', $booking->id ?? 0) }}"
                                    class="btn btn-info btn-xs">Detail</a></td>

                            <td class="d-flex">

                                {{-- <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a> --}}
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal"
                                    data-target="#editBookingModal{{ $booking->id }}">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <form id="delete-form-{{ $booking->id }}"
                                    action="{{ route('booking.destroy', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1"
                                        onclick="confirmDelete({{ $booking->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <button {{-- onclick="callQueue('Nomor antrean {{ $booking->queue_number }}, atas nama {{ $booking->user->name }}, silahkan menuju ke ruang studio, Terima kasih...')" --}}
                                    onclick="callQueue('Nomor Antrean {{ $booking->queue_number }} dengan Nomor Booking {{ $booking->id }}, atas nama {{ $booking->user ? $booking->user->name : 'No User' }}, silahkan menuju ke ruang studio, Terima kasih...')"
                                    class="btn-xs btn btn-primary">Call Queue</button>
                                @endhasanyrole
                            </td>

                            {{-- =================================
    ================================= --}}
                            <!-- Modal -->
                            <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="editBookingModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Header Modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookingModalLabel{{ $booking->id }}">Edit
                                                Booking
                                                #{{ $booking->id }}</h5>

                                            <button type="button" class="btn btn-close" data-dismiss="modal"
                                                aria-label="Close">X</button>
                                        </div>

                                        <!-- Body Modal -->
                                        <div class="modal-body">
                                            <form action="{{ route('booking.update', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="user" class="form-label">Nama</label>
                                                    <input type="hidden" name="user_name_modal"
                                                        value="{{ $booking->user ? $booking->user->id : 'No IDUser' }}"></input>
                                                    <input type="text" name="user" value="{{ $booking->user ? $booking->user->name : 'No User' }}"
                                                        disabled class="form-control"></input>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="queue_modal" class="form-label">Antrian</label>
                                                    {{-- <input type="hidden" name="queueNumber_modal" value="{{ $booking->user->id }}"></input> --}}
                                                    <input type="text" id="queue_modal" name="queueNumber_modal"
                                                        value="{{ $booking->queue_number }}"
                                                        class="disabled form-control"></input>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status{{ $booking->id }}"
                                                        class="form-label">Status</label>
                                                    <select name="status_modal" id="status{{ $booking->id }}"
                                                        class="form-select form-control">
                                                        <option value="pending"
                                                            {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="confirmed"
                                                            {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                                            Confirmed
                                                        </option>
                                                        <option value="in-progress"
                                                            {{ $booking->status == 'in-progress' ? 'selected' : '' }}>
                                                            In-Progress</option>
                                                        <option value="finish"
                                                            {{ $booking->status == 'finish' ? 'selected' : '' }}>Finish
                                                        </option>
                                                        <option value="cancel"
                                                            {{ $booking->status == 'cancel' ? 'selected' : '' }}>Cancel
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="package_id" class="form-label">Package</label>
                                                    <select id="package_id" name="package_id_modal" class="form-control"
                                                        required>
                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}"
                                                                {{ $booking->package->id == $package->id ? 'selected' : '' }}>
                                                                {{ $package->package_name }} -
                                                                {{ 'Rp.' . number_format($package->price, 0, ',', '.') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="booking_date" class="form-label">Date</label>
                                                    <input type="date" name="booking_date_modal"
                                                        id="booking_date_{{ $booking->id }}"
                                                        value="{{ $booking->booking_date }}"
                                                        class="form-control"></input>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="booking_time" class="form-label">Time</label>
                                                    <select name="booking_time_modal" class="form-control"
                                                        id="booking_time_{{ $booking->id }}" required>
                                                        @foreach ($times as $t)
                                                            @php
                                                                $booked =
                                                                    $bookings
                                                                        ->where('booking_date', $booking->booking_date)
                                                                        ->where('booking_time', $t)
                                                                        ->count() > 0;
                                                                $isSelected =
                                                                    \Carbon\Carbon::parse(
                                                                        $booking->booking_time,
                                                                    )->format('H:i') === $t;
                                                            @endphp
                                                            <option value="{{ $t }}"
                                                                {{ $isSelected ? 'selected' : '' }}
                                                                {{ $booked && !$isSelected ? 'disabled' : '' }}>
                                                                {{ $t }}
                                                                {{ $booked && !$isSelected ? '(Sudah Penuh)' : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>




                                                <!-- Footer Modal -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Perubahan</button>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- =================================
    ================================= --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function confirmDelete(id) {
            // cegah submit langsung

            swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data Booking yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",

            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>




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

    {{-- script pemanggil nomor antrean --}}
    <script>
        function callQueue(fullText) {
            let audio = new Audio("https://www.myinstants.com/media/sounds/ding-sound-effect_2.mp3"); // Suara ding dong
            audio.play(); // Mainkan suara

            audio.onended = function() {
                setTimeout(() => { // Tambah delay biar voice-nya ke-load dulu
                    let msg = new SpeechSynthesisUtterance(fullText);

                    let voices = speechSynthesis.getVoices();
                    let indonesianVoice = voices.find(voice => voice.lang === "id-ID") || voices.find(voice =>
                        voice.name.includes("Google")) || voices[0];

                    msg.voice = indonesianVoice;
                    msg.rate = 0.8;
                    msg.pitch = 1.1;
                    msg.volume = 1;
                    msg.lang = 'id-ID'; // Bahasa Indonesia

                    window.speechSynthesis.speak(msg);
                }, 500); // Delay 500ms buat nunggu voice ke-load
            };

            // Fix bug: Tunggu sampai voice list ter-load sebelum ngomong
            if (speechSynthesis.getVoices().length === 0) {
                speechSynthesis.onvoiceschanged = function() {
                    audio.onended();
                };
            }
        }
    </script>
@endsection

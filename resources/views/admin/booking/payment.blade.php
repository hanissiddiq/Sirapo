@extends('admin.layouts.frame')
@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $page }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $judul_page }}</a></li>
            </ol>
        </div>

        <h3>Ini halaman payment</h3>
        <form method="POST" action="{{ route('booking.makePayment', $booking->id) }}">
            @csrf
            <label for="booking_id">Booking ID</label>
            <input type="text" name="booking_id" class="form-control" value="{{'#' . $booking->id }}" readonly>
            <label class="mt-3" for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" class="form-control" required>



                {{-- <option value="{{ $package->id }}">{{ $package->package_name }}</option> --}}
                <option value="cash">
                    Cash
                </option>
                <option value="bank_transfer">
                    Bank Transfer
                </option>
            </select>
            <label class="mt-3" for="amount">Amount</label>
            <input type="hidden" name="amount" class="form-contro" value="{{ $booking->package->price }}" readonly>

            <h2>Rp. {{ number_format($booking->package->price, 0, ',', '.') }}</h2>

            <div id="bankTransferCard" class="card mt-3 d-none">
                <div class="card-body d-flex align-items-center gap-3">
                    {{-- Ganti path logo sesuai aset kamu --}}
                    {{-- <img src="{{ asset('images/bsi.png') }}" alt="Logo BSI" style="height:40px; width:auto;"> --}}
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Transfer ke Rekening BSI</div>
                        <div class="small text-muted">No. Rekening</div>
                        <div class="fs-5 fw-bold" id="acctNum">1051078981</div>
                        {{-- Opsional: tampilkan nama pemilik rekening --}}
                        {{-- <div class="small">a.n. PT Contoh Sejahtera</div> --}}
                    </div>
                    <button class="btn btn-outline-secondary btn-sm" type="button" id="copyBtn">Copy</button>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        Setelah transfer, silakan unggah bukti atau lanjutkan sesuai instruksi pada halaman berikutnya.
                    </small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Booking</button>
        </form>
    </div>


{{-- Toggle + Copy --}}
<script>
    (function () {
        const select = document.getElementById('payment_method');
        const card   = document.getElementById('bankTransferCard');
        const copyBtn= document.getElementById('copyBtn');
        const acct   = document.getElementById('acctNum').innerText.trim();

        function toggleCard() {
            const isBT = select.value === 'bank_transfer';
            card.classList.toggle('d-none', !isBT);
        }

        select.addEventListener('change', toggleCard);
        document.addEventListener('DOMContentLoaded', toggleCard);
        // In case this script runs before DOMContentLoaded:
        toggleCard();

        copyBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(acct);
                copyBtn.innerText = 'Copied!';
                setTimeout(() => copyBtn.innerText = 'Copy', 1500);
            } catch (e) {
                alert('Gagal menyalin nomor rekening.');
            }
        });
    })();
</script>
@endsection

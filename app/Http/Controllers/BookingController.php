<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::user();
        $data['users'] = User::all();
        $data['packages'] = Package::all();
        // dd($data['packages']);
        $data['page'] = 'Booking';
        $data['judul_page'] = 'Booking';
        // Menampilkan jadwal booking pada tanggal tertentu
        $date = Carbon::today(); // Tanggal hari ini


        if (auth()->user()->hasRole('owner')) {
            $data['bookings'] = Booking::all();
        }
       elseif (auth()->user()->hasRole('staff')) {
            $data['bookings'] = Booking::where('booking_date', $date)->get();
        }
        else {
        $data['bookings'] = auth()->user()
        ->bookings()
        ->where('booking_date', $date)
        ->get();
       }
        return view('front.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Proses booking jika jadwal masih tersedia

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //
        $request->validate([
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'user_name' => 'required|string|max:255',
        ]);

        // $existingBooking = Booking::where('booking_date', $request->booking_date)
        //                           ->where('booking_time', $request->booking_time)
        //                           ->first();

        // if ($existingBooking) {
        //     return back()->with('error', 'Slot sudah penuh pada waktu tersebut.');
        // }

        //=======================start ChatGPT ==================
        // Hitung total booking hari itu
    $countPerDay = Booking::where('booking_date', $request->booking_date)->count();
    if ($countPerDay >= 8) {
        return back()->with('error', 'Kuota booking harian sudah penuh (maks 8 booking per hari).');
    }

    // Cek apakah jam tersebut sudah dipakai
    $existsAtHour = Booking::where('booking_date', $request->booking_date)
                           ->where('booking_time', $request->booking_time)
                           ->exists();
    if ($existsAtHour) {
        return back()->with('error', 'Slot jam tersebut sudah diambil, silakan pilih jam lain.');
    }

    // Nomor antrian otomatis
    $queueNumber = $countPerDay + 1;

    $booking = Booking::create([
        'booking_date'  => $request->booking_date,
        'booking_time'  => $request->booking_time,
        'user_id' => $user->id,
        'package_id' => $request->package_id,
        'status'        => 'pending',
        'queue_number'  => $queueNumber,
    ]);

    return redirect()->route('booking.payment', $booking->id)
                     ->with('success', 'Booking berhasil dibuat.');



    //================================end ChatGPT==================

        // $booking = Booking::create([
        //     'booking_date' => $request->booking_date,
        //     'booking_time' => $request->booking_time,
        //     'user_id' => $user->id,
        //     'package_id' => $request->package_id,
        //     'status' => 'pending',
        //     // Asumsikan package_id 1 untuk contoh ini
        // ]);



        // return redirect()->route('booking.payment', $booking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Auth::user();
        $data['users'] = User::all();
        $data['packages'] = Package::all();
        // dd($data['packages']);
        $data['page'] = 'Booking Detail';
        $data['judul_page'] = 'Booking Detail';
        $data['booking'] = Booking::find($id);
        return view('admin.booking.show', $data);
    }

    public function approve(string $id)
    {
        Auth::user();

         $booking = Booking::findOrFail($id);

        // Update status
        $booking->update(['status' => 'confirmed']); // pastikan 'status' fillable/unguarded

        // Siapkan data untuk view (kalau memang dipakai di blade)
        $data = [
            'page'       => 'Booking Detail',
            'judul_page' => 'Booking Detail',
            'booking'    => $booking,
            'users'      => User::all(),
            'packages'   => Package::all(),
        ];

        // $data['users'] = User::all();
        // $data['packages'] = Package::all();
        // // dd($data['packages']);        $data['page'] = 'Booking Detail';
        // $data['page'] = 'Booking Detail';
        // $data['judul_page'] = 'Booking Detail';
        // $data['booking'] = Booking::find($id);
        // $booking->status = 'confirmed';
        // $booking->save();
        return view('admin.booking.show', $data);
    }

    public function inProgress(string $id)
    {
        Auth::user();

         $booking = Booking::findOrFail($id);

        // Update status
        $booking->update(['status' => 'in-progress']); // pastikan 'status' fillable/unguarded

        // Siapkan data untuk view (kalau memang dipakai di blade)
        $data = [
            'page'       => 'Booking Detail',
            'judul_page' => 'Booking Detail',
            'bookings'    => $booking,
            'users'      => User::all(),
            'packages'   => Package::all(),
        ];
        return view('front.index', $data);
    }

    public function cancel(string $id)
    {
        Auth::user();

         $booking = Booking::findOrFail($id);

        // Update status
        $booking->update(['status' => 'cancel']); // pastikan 'status' fillable/unguarded

        // Siapkan data untuk view (kalau memang dipakai di blade)
        $data = [
            'page'       => 'Booking Detail',
            'judul_page' => 'Booking Detail',
            'booking'    => $booking,
            'users'      => User::all(),
            'packages'   => Package::all(),
            'bookings'  => Booking::all()
        ];
       return view('front.index', $data);
    }


    public function finish(string $id)
    {
        Auth::user();

         $booking = Booking::findOrFail($id);

        // Update status
        $booking->update(['status' => 'finish']); // pastikan 'status' fillable/unguarded

        // Siapkan data untuk view (kalau memang dipakai di blade)
        $data = [
            'page'       => 'Booking Detail',
            'judul_page' => 'Booking Detail',
            'booking'    => $booking,
            'users'      => User::all(),
            'packages'   => Package::all(),
        ];
        return view('front.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        //
        $request->validate([
            'booking_date_modal' => 'required|date',
            'booking_time_modal' => 'required|date_format:H:i',
            'user_name_modal' => 'required|string|max:255',
        ]);


        // Hitung total booking hari itu
    $countPerDay = Booking::where('booking_date', $request->booking_date_modal)->count();
    if ($countPerDay >= 8) {
        return back()->with('error', 'Kuota booking harian sudah penuh (maks 8 booking per hari).');
    }

    // Cek apakah jam tersebut sudah dipakai
   $existsAtHour = Booking::where('booking_date', $request->booking_date_modal)
                       ->where('booking_time', $request->booking_time_modal)
                       ->where('id', '!=', $id) // abaikan dirinya sendiri
                       ->exists();
    if ($existsAtHour) {
        return back()->with('error', 'Slot jam tersebut sudah diambil, silakan pilih jam lain.');
    }

    $booking = Booking::findOrFail($id);

    // Nomor antrian otomatis
    // $queueNumber = $countPerDay + 1;

    // $booking = Booking::update([
    //     'booking_date'  => $request->booking_date_modal,
    //     'booking_time'  => $request->booking_time_modal,
    //     'user_id' => $request->user_name_modal,
    //     'package_id' => $request->package_id_modal,
    //     'status'        => $request->status_modal,
    //     'queue_number'  => $request->queueNumber_modal,
    // ]);
      // ✅ Perbaikan utama di sini
    $booking = Booking::findOrFail($id);
    $booking->update([
        'booking_date' => $request->booking_date_modal,
        'booking_time' => $request->booking_time_modal,
        'user_id' => $request->user_name_modal,
        'package_id' => $request->package_id_modal,
        'status' => $request->status_modal,
        'queue_number' => $request->queueNumber_modal,
    ]);

    // dd($booking);

    return redirect()->route('admin.booking.index')
                     ->with('success', 'Booking berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Booking::destroy($id);
        return redirect()->route('admin.booking.index')->with('success', 'Booking deleted successfully.');
    }

     public function paymentForm($id)
    {
         $data['page'] = 'Payment';
          $data['judul_page'] = 'Payment';
        $data['booking'] = Booking::find($id);
        return view('admin.booking.payment', $data);
    }

    public function makePayment(Request $request, $id)
    {
        // $request->validate([
        //     'payment_method' => 'required|in:cash,bank_transfer',
        //     'amount' => 'numeric',
        // ]);

        // Validasi input
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,bank_transfer',
            'amount'         => 'required|numeric|min:0',
            // kalau mau izinkan PDF juga, jangan pakai 'image'
            'payment_proof'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2046',
        ]);

        // Handle upload bukti bayar
        $filePath = null;
        if ($request->hasFile('payment_proof')) {
            $filename = 'bukti_' . now()->format('Ymd_His') . '.' .
                        $request->file('payment_proof')->extension();

            // simpan ke storage/app/public/payment_proof/...
            $filePath = $request->file('payment_proof')
                                ->storeAs('payment_proof', $filename, 'public');
        }



        $payment = Payment::create([
            'booking_id' => $id,
            'payment_method' => $validated['payment_method'],
            'amount' => $validated['amount'],
            'payment_proof' => $filePath,
            // 'amount' => $booking->package->price,
        ]);

        // dd($payment);
        // $metode = $validated->payment_method;

        $booking = Booking::find($id);
        // if ($metode == 'cash') {
        //     $booking->status = 'confirmed';
        // } else {
        //     $booking->status = 'pending';
        // }
        $booking->status = 'pending';

        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil, pembayaran diterima.');
    }
}

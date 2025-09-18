<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::user();
        $data['page'] = 'User';
        $data['judul_page'] = 'List User';
        $data['users'] = User::all();
        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Auth::user();
        $data['page'] = 'User';
        $data['judul_page'] = 'Create User';
        return view('admin.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // assign role dari input form
        $user->assignRole($request->role);
        return view('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        Auth::user();
        $data['page'] = 'User';
        $data['judul_page'] = 'Edit User';
        $data['user'] = User::findOrFail($id);
        // $data['users'] = User::all();
        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);



        // 🔹 Validasi langsung di sini
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'address' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'post_code' => 'nullable|string|max:20',
            'role' => 'required|string|in:customer,staff,owner',
        ]);

        // dd($request->all());
        // die();

        // 🔹 Update tabel users
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Password hanya diupdate kalau diisi
        // if (!empty($validated['password'])) {
        //     $validated['password'] = Hash::make($validated['password']);
        // } else {
        //     unset($validated['password']);
        // }
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);
        // dd($user->fresh());


        // 🔹 Update tabel user_details
        $detailData = collect($validated)
            ->only(['address', 'kecamatan', 'kabupaten', 'provinsi', 'phone_number', 'post_code'])
            ->toArray();

        if ($request->hasFile('photo_profile')) {
            $imageName = 'profile_' . date('Ymd_His') . '.' . $request->photo_profile->extension();
            $path = $request->file('photo_profile')->storeAs('users', $imageName, 'public');
            // dd($path);
            $detailData['photo_profile'] = $path;
        }

        $user->detail()->updateOrCreate(['user_id' => $user->id], $detailData);

        // 🔹 Update role (hapus lama, assign baru)
        $user->syncRoles([$validated['role']]);


        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

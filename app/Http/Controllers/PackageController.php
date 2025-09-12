<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::user();
        $data['page'] = 'Package';
        $data['judul_page'] = 'List Package';
        $data['packages'] = Package::all();
        return view('admin.packages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['page'] = 'Package';
        $data['judul_page'] = 'Create Package';
        $data['packages'] = Package::all()->sortBy('name');
        return view('admin.packages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'package_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        //  Simpan file jika ada
        if ($request->hasFile('package_image')) {
            // $imageName = time() . '.' . $request->package_image->extension();
             // Nama file: package_20250912_153045.jpg
            $imageName = 'package_' . date('Ymd_His') . '.' . $request->package_image->extension();

            // Simpan ke storage/app/public/packages/
            $path = $request->file('package_image')->storeAs('package', $imageName, 'public');

            // Simpan path ke database (supaya bisa diakses lewat /storage)
            $validated['package_image'] = $path;
        }

        // Simpan data ke database
        Package::create($validated);

        //Jika Berhasil
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

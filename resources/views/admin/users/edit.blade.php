@extends('admin.layouts.frame')
@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $page }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $judul_page }}</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
                        <div class="d-flex">
                            {{-- <a href="{{ route('user.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                                User</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST"enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- <div class="mb-3">
                                <label for="name" class="">Name</label>
                                <input type="text" for="name" id="name" name="name"
                                    class="form-control"></input>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="">Email</label>
                                <input type="email" for="email" id="email" name="email"
                                    class="form-control"></input>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="">Password</label>
                                <input type="text" for="password" id="password" name="password"
                                    class="form-control"></input>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="">Role</label>
                                <select name="role" class="form-control">
                                    <option value="customer">Customer</option>
                                    <option value="staff">Staff</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="post_code" class="form-label">Post Code</label>
                                    <input type="text" id="post_code" name="post_code" class="form-control"
                                        value="{{ $user->detail->post_code ?? '' }}">
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="customer">Customer</option>
                                        <option value="staff">Staff</option>
                                        <option value="owner">Owner</option>
                                    </select>
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 ">
                                    <label for="photo_profile" class="form-label">Photo Profile</label>
                                    <input type="file" id="photo_profile" name="photo_profile" class="form-control ">
                                    <div class="input-group mt-1">
                                        <img src="{{ $user->detail && $user->detail->photo_profile
                                            ? Storage::url($user->detail->photo_profile)
                                            : 'https://placehold.co/150x150?text=No+Photo&font=roboto' }}"
                                        width="50" alt="Profile" />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        value="{{ $user->detail->address ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                        value="{{ $user->detail->kecamatan ?? ''}}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten</label>
                                    <input type="text" id="kabupaten" name="kabupaten" class="form-control"
                                        value="{{ $user->detail->kabupaten ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control"
                                        value="{{ $user->detail->provinsi ?? '' }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                                        value="{{ $user->detail->phone_number ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="customer"
                                            {{ $user->getRoleNames()->first() == 'customer' ? 'selected' : '' }}>Customer
                                        </option>
                                        <option value="staff"
                                            {{ $user->getRoleNames()->first() == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                        <option value="owner"
                                            {{ $user->getRoleNames()->first() == 'owner' ? 'selected' : '' }}>Owner
                                        </option>
                                    </select>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <label for="post_code" class="form-label">Post Code</label>
                                    <input type="text" id="post_code" name="post_code" class="form-control">
                                </div> --}}
                            </div>

                            <button type="submit" class=" mt-3 btn btn-primary">Submit</button>
                            <button type="submit" class=" mt-3 btn btn-secondary" onclick="window.history.back()">Back</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

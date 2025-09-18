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
                        <h4 class="card-title">Add User</h4>
                        <div class="d-flex">
                            {{-- <a href="{{ route('user.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                                User</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
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
                            </div>

                            <button type="submit" class=" mt-3 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

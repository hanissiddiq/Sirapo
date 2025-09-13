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
                        <h4 class="card-title">Form Edit Package</h4>
                        {{-- <div class="d-flex">
                            <a href="{{ route('package.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                                Package</a>
                        </div> --}}
                    </div>

                    <div class="card-body">
                        {{-- Alert Sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success w-100">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Alert Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger w-100">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('packages.update', $packages->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 custom-file">
                                <div class="mb-3">
                                    <label for="package_name" class="form-label">Package Name</label>
                                    <input type="text" class="form-control" id="package_name" name="package_name" value="{{ $packages->package_name }}" required>
                                </div>

                                <div class="">
                                    <label for="package_image" class="file-label">Package Image</label>
                                </div>
                                <div class="input-group mb-3">
                                            <div class="input-group">
                                                <img src="{{ asset('storage/' . $packages->package_image) }}" alt="Current Package Image" class="mb-3" style="max-width: 50px; display: block;">
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="package_image" name="package_image">
                                                <label class="custom-file-label" for="package_image">Choose file</label>
                                            </div>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Package Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $packages->price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Package Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $packages->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Package Status</label>
                                    <select class="form-control form-control-lg default-select" id="status" name="status" required>
                                        <option value="active" {{ $packages->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="unactive" {{ $packages->status == 'unactive' ? 'selected' : '' }}>Unactive</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class=" mt-5 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

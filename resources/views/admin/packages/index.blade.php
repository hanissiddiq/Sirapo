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
                        <h4 class="card-title">List Package</h4>
                        <div class="d-flex">
                            <a href="{{ route('packages.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                                Package</a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Alert Bootstrap Sukses --}}
                        {{-- @if (session('success'))
                            <div class="alert alert-success w-100">
                                {{ session('success') }}
                            </div>
                        @endif --}}

                        {{-- Alert Sweetalert2 Success --}}
                         @if (session('success'))
                            <script>
                                window.onload = function () {
                                    Swal.fire({
                                        title: "Berhasil!",
                                        text: "{{ session('success') }}",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            </script>
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

                        <div class="table-responsive">
                            <table id="example3" class="display min-w850">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="object-cover rounded-lg" width="60"
                                                    src="{{ Storage::url($package->package_image) }}" alt=""></td>
                                            {{-- <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td> --}}
                                            <td>{{ $package->package_name }}</td>
                                            <td>{{ 'Rp.' . number_format($package->price, 0, ',', '.') }}</td>
                                            <td>{{ $package->description }}</td>
                                            <td>
                                                @if ($package->status == 'unactive')
                                                    <span
                                                        class="badge light badge-danger">{{ ucwords($package->status) }}</span>
                                                @else
                                                    <span
                                                        class="badge light badge-success">{{ ucwords($package->status) }}</span>
                                                @endif

                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <form id="delete-form-{{ $package->id }}"
                                                        action="{{ route('packages.destroy', $package->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger shadow btn-xs sharp"
                                                            onclick="confirmDelete({{ $package->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    {{-- <a href="{{ route('packages.destroy', $package->id) }}" class="btn btn-danger shadow btn-xs sharp"><i
                                                            class="fa fa-trash"></i></a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p class="mt-4">
                                                    No Package Available
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script>
    function confirmDelete(id) {
         // cegah submit langsung

       swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
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







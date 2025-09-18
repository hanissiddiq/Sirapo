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
                        <h4 class="card-title">List User</h4>
                        <div class="d-flex">
                            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                                User</a>
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

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td><img class="object-cover rounded-lg" width="60"
                                                    src="{{ Storage::url($package->package_image) }}" alt=""></td> --}}
                                            {{-- <td><img class="rounded-circle" width="35" src="images/profile/small/pic1.jpg" alt=""></td> --}}
                                            <td >{{ $user->name }}</td>
                                            <td >{{ $user->email }}</td>
                                            <td> <span class="badge badge-success">{{ $user->getRoleNames()->first() }}</span></td>
                                            {{-- <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td> --}}

                                            {{-- cek status user aktif atau tidak --}}

                                            {{-- <td>
                                                @if ($user->status == 'unactive')
                                                    <span
                                                        class="badge light badge-danger">{{ ucwords($user->status) }}</span>
                                                @else
                                                    <span
                                                        class="badge light badge-success">{{ ucwords($user->status) }}</span>
                                                @endif

                                            </td> --}}

                                            <td class="d-flex">

                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                            class="fa fa-pencil"></i></a>
                                                <!-- Tombol Edit -->
                                                {{-- <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal"
                                                    data-target="#editBookingModal{{ $user->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </button> --}}
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1"
                                                        onclick="confirmDelete({{ $user->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>


                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p class="mt-4">
                                                    No User Available
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
            text: "Data User yang dihapus tidak bisa dikembalikan!",
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

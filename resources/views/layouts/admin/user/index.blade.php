@extends('layouts.admin.app')


@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>


        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Data User</h1>
                <p class="mb-0">List data seluruh user</p>
            </div>


            <div>
                <a href="{{ route('user.create') }}"
                    class="btn btn-success text-white">
                    Tambah User
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 mb-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-user"
                            class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">NAME</th>
                                    <th class="border-0">EMAIL</th>
                                    <th class="border-0">PASSWORD</th>
                                    <th class="border-0 rounded-end">ACTION</th>
                                </tr>
                            </thead>


                            <tbody>
                                @forelse ($dataUser as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>


                                        {{-- Jangan tampilkan hash password asli --}}
                                        <td>********</td>


                                        <td>
                                            <a href="{{ route('user.edit', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-edit me-1"></i>
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('user.destroy', $item->id) }}"
                                                method="POST"
                                                style="display:inline"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')


                                                <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Belum ada data user.
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
@endsection

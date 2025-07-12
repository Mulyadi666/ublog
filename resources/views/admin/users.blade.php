@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar User</h1>
<table class="table-auto w-full text-left bg-white shadow rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
        <tr class="border-t">
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="flex space-x-2">
                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                </form>
                <form action="{{ route('admin.users.reset', $user->id) }}" method="POST">
                    @csrf
                    <button class="text-blue-600">Reset Password</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

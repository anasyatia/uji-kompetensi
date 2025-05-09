@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="container mx-auto p-6">
        <nav class="text-sm text-gray-500">
            <a href="#" class="hover:underline">Home</a> / <span>User</span>
        </nav>
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white p-6 rounded shadow-md">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold">Email <span class="text-red-500">*</span></label>
                        <input type="text" name="email" class="w-full p-2 border rounded" value="{{ $user->email }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $user->name }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold">Role <span class="text-red-500">*</span></label>
                        <select name="role" class="w-full p-2 border rounded" required>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold">Password</label>
                        <input type="text" name="password" class="w-full p-2 border rounded" placeholder="Biarkan kosong jika tidak ingin mengubah">
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow-md hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

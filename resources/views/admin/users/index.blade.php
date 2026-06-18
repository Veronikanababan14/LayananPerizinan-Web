@extends('layouts.admin')

@section('title', 'Manajemen Users')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Daftar Pengguna</h1>

    <!-- WRAPPER DENGAN BORDER FULL SAMPAI BAWAH -->
    <div class="w-full overflow-x-auto border border-gray-300 rounded-lg min-h-[300px]">

        <table class="min-w-max w-full text-[10px] md:text-sm border-collapse">
            <thead class="bg-blue-900 text-white">
                <tr class="text-[10px] md:text-xs">
                    <th class="py-2 px-2 text-centre border border-gray-300">No</th>
                    <th class="py-2 px-2 text-centre border border-gray-300">Nama</th>
                    <th class="py-2 px-2 text-centre border border-gray-300">Email</th>
                    <th class="py-2 px-2 text-centre border border-gray-300">Tanggal Daftar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="hover:bg-gray-100 text-[10px] md:text-xs">
                    <td class="py-1 px-2 text-center border border-gray-300">{{ $loop->iteration }}</td>
                    <td class="py-1 px-2 text-center border border-gray-300">{{ $user->name }}</td>
                    <td class="py-1 px-2 text-center border border-gray-300">{{ $user->email }}</td>
                    <td class="py-1 px-2 text-center border border-gray-300">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection

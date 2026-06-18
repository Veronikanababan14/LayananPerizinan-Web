@extends('layouts.dashboard')

@section('content')

<div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-5 relative overflow-hidden">

        <a href="{{ url('/dashboard-user') }}"
           class="absolute top-4 right-4 text-gray-400 hover:text-red-500">
            <i class="fa-solid fa-xmark text-lg"></i>
        </a>

        <h2 class="text-xl font-bold text-gray-800">
            Edit Profile
        </h2>

        <p class="text-sm text-gray-500 mt-1 mb-5">
            Kelola informasi akun anda.
        </p>
        @if(session('success'))
    <div id="successAlert"
         class="mb-5 flex items-center gap-3 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">

        <i class="fa-solid fa-circle-check"></i>

        <span>{{ session('success') }}</span>
    </div>
@endif

        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div>
                <h3 class="text-base font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </h3>

                <p class="text-xs text-gray-500">
                    {{ Auth::user()->email }}
                </p>

                
            </div>
        </div>

        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Nama Lengkap
                </label>

                <input 
                    type="text"
                    name="name"
                    value="{{ Auth::user()->name }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Email
                </label>

                <input 
                    type="email"
                    name="email"
                    value="{{ Auth::user()->email }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">
                    Nomor HP
                </label>

                <input 
                    type="text"
                    name="phone"
                    placeholder="08xxxxxxxxxx"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end gap-2 pt-3">
                <a href="{{ url('/dashboard-user') }}"
                   class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">
                    Batal
                </a>

                <button 
    type="button"
    onclick="showSuccessThenSubmit()"
    class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 text-sm">
    Simpan
</button>
<div id="profileToast"
     class="hidden absolute inset-0 z-50 flex items-center justify-center">

    <div class="flex items-center gap-3 bg-blue-500 text-white px-6 py-4 rounded-2xl shadow-2xl">

        <i class="fa-solid fa-circle-check text-xl"></i>

        <span class="text-sm font-medium">
            Profile berhasil diperbarui.
        </span>

    </div>

</div>
        </form>

    </div>

</div>

<script>
function showSuccessThenSubmit() {
    const toast = document.getElementById('profileToast');
    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
        document.getElementById('profileForm').submit();
    }, 800);
}
</script>
@endsection
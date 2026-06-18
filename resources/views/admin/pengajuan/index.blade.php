@extends('layouts.admin')

@section('content')

<div class="mt-4 mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Pengajuan Masuk</h2>
    <p class="text-gray-500 text-sm mt-1">Daftar semua pengajuan perizinan dari user.</p>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-3 rounded-xl text-center
                transition-all duration-300 transform
                hover:scale-105 hover:shadow-xl hover:brightness-110">
        <div class="font-bold text-xs">TOTAL</div>

        <div class="text-lg font-extrabold mt-1">{{ $pengajuan->count() }}</div>
    </div>
    <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white p-3 rounded-xl text-center
            transition-all duration-300 transform
            hover:scale-105 hover:shadow-xl hover:brightness-110">

        <div class="font-bold text-xs">MENUNGGU</div>
        <div class="text-lg font-extrabold mt-1">{{ $pengajuan->where('status', 'menunggu')->count() }}</div>
    </div>
   <div class="bg-gradient-to-r from-green-500 to-green-700 text-white p-3 rounded-xl text-center
            transition-all duration-300 transform
            hover:scale-105 hover:shadow-xl hover:brightness-110">
        <div class="font-bold text-xs">DISETUJUI</div>
        <div class="text-lg font-extrabold mt-1">{{ $pengajuan->where('status', 'disetujui')->count() }}</div>
    </div>

    <div class="bg-gradient-to-r from-red-400 to-red-600 text-white p-3 rounded-xl text-center
            transition-all duration-300 transform
            hover:scale-105 hover:shadow-xl hover:brightness-110">
        <div class="font-bold text-xs">DITOLAK</div>
        <div class="text-lg font-extrabold mt-1">{{ $pengajuan->where('status', 'ditolak')->count() }}</div>
    </div>
</div>

<!-- TABEL PENGAJUAN -->
<div class="bg-white rounded-xl shadow p-4">

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                    <th class="px-4 py-3 text-left">No. Permohonan</th>
                    <th class="px-4 py-3 text-left">Pemohon</th>
                    <th class="px-4 py-3 text-left">Jenis Perizinan</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuan as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-semibold text-sm text-gray-800">{{ $item->no_permohonan }}</td>
                    <td class="px-4 py-3">
                        <p class="text-sm font-semibold text-gray-800">{{ $item->nama_lengkap }}</p>
                        <p class="text-xs text-gray-400">{{ $item->user->email ?? '-' }}</p>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->layanan->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        @if($item->status == 'menunggu')
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                        @elseif($item->status == 'diproses')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                        @elseif($item->status == 'disetujui')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>
                        @elseif($item->status == 'ditolak')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <button onclick="openUpdateModal(
    {{ $item->id }},
    '{{ $item->no_permohonan }}',
    '{{ $item->nama_lengkap }}',
    '{{ $item->layanan->nama ?? '-' }}',
    '{{ $item->status }}',
    '{{ $item->catatan_admin ?? '' }}',
    '{{ $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : '' }}'
)"
                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-700 transition">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Proses
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400 text-sm">
                        Belum ada pengajuan masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<!-- MODAL UPDATE STATUS -->
<div id="updateModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl p-8 relative">

        <button type="button" onclick="closeUpdateModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <h2 class="text-xl font-bold text-gray-800 mb-1">Proses Pengajuan</h2>
        <p class="text-sm text-gray-400 mb-5" id="modal_no_permohonan"></p>

        <!-- INFO -->
        <div class="bg-gray-50 rounded-xl p-6 mb-6 space-y-4">
            <div>
                <p class="text-xs text-gray-400">Pemohon</p>
                <p class="text-sm font-semibold text-gray-700" id="modal_nama"></p>
            </div>
            <div>
                <p class="text-xs text-gray-400">Jenis Perizinan</p>
                <p class="text-sm font-semibold text-gray-700" id="modal_layanan"></p>
            </div>
            <div>
    <p class="text-xs text-gray-400">Dokumen Pengajuan</p>

    <a id="modal_dokumen"
       href="#"
       target="_blank"
       class="hidden inline-flex items-center gap-2 mt-1 px-3 py-2 bg-blue-600 text-white rounded-lg text-xs hover:bg-blue-700">
        <i class="fa-solid fa-file"></i>
        Lihat Dokumen
    </a>

    <p id="modal_dokumen_kosong" class="text-sm text-gray-500 mt-1">
        Tidak ada dokumen
    </p>
</div>
        </div>

        <form id="updateForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                <select name="status" id="modal_status"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>

            <!-- CATATAN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan Admin <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <textarea name="catatan_admin" id="modal_catatan" rows="3"
                    placeholder="Tambahkan catatan atau alasan penolakan..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 pb-2">
                <button type="button" onclick="closeUpdateModal()"
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">
                    Batal
                </button>
                <button type="button" onclick="submitUpdate()"
    class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
    Simpan Perubahan
</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openUpdateModal(id, noPermohonan, nama, layanan, status, catatan, dokumenUrl) {
        document.getElementById('modal_no_permohonan').textContent = 'No. ' + noPermohonan;
        document.getElementById('modal_nama').textContent = nama;
        document.getElementById('modal_layanan').textContent = layanan;
        document.getElementById('modal_status').value = status;
        document.getElementById('modal_catatan').value = catatan;

        // SET ACTION FORM
        document.getElementById('updateForm').action = '/admin/pengajuan/' + id + '/status';
const dokumenLink = document.getElementById('modal_dokumen');
const dokumenKosong = document.getElementById('modal_dokumen_kosong');

if (dokumenUrl) {
    dokumenLink.href = dokumenUrl;
    dokumenLink.classList.remove('hidden');
    dokumenKosong.classList.add('hidden');
} else {
    dokumenLink.href = '#';
    dokumenLink.classList.add('hidden');
    dokumenKosong.classList.remove('hidden');
}
        document.getElementById('updateModal').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('updateModal').classList.add('hidden');
    }


function submitUpdate() {
    // Tampilkan pesan sukses di dalam modal
    const modalBody = document.querySelector('#updateModal .space-y-4');
    const successMsg = document.createElement('div');
    successMsg.className = 'bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2';
    successMsg.innerHTML = '<i class="fa-solid fa-circle-check text-green-500"></i> Status berhasil diperbarui!';
    modalBody.prepend(successMsg);

    // Submit form setelah 1.5 detik
    setTimeout(function () {
        document.getElementById('updateForm').submit();
    }, 1500);
}

</script>
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@endsection
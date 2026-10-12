@extends('layouts.admin')

@section('content')

<div class="mt-4 mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Permohonan Masuk</h2>
    <p class="text-gray-500 text-sm mt-1">Daftar semua permohonan perizinan dari user</p>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white border border-gray-200 rounded-xl text-center p-3
            hover:bg-blue-100 hover:border-blue-400
            hover:shadow-xl hover:scale-105
            transition-all duration-300 cursor-pointer">

    <div class="font-bold text-xs text-gray-700">
        TOTAL
    </div>

    <div class="text-2xl font-bold text-gray-900 mt-1">
        {{ $pengajuan->count() }}
    </div>

</div>
    <div class="bg-white border border-gray-200 rounded-xl text-center p-3
            hover:bg-blue-100 hover:border-blue-400
            hover:shadow-xl hover:scale-105
            transition-all duration-300 cursor-pointer">

    <div class="font-bold text-xs text-gray-700">
        DIPROSES
    </div>

    <div class="text-2xl font-bold text-gray-900 mt-1">
        {{ $pengajuan->where('status', 'diproses')->count() }}
    </div>

</div>
   <div class="bg-white border border-gray-200 rounded-xl text-center p-3
            hover:bg-blue-100 hover:border-blue-400
            hover:shadow-xl hover:scale-105
            transition-all duration-300 cursor-pointer">

    <div class="font-bold text-xs text-gray-700">
        DISETUJUI
    </div>

    <div class="text-2xl font-bold text-gray-900 mt-1">
        {{ $pengajuan->where('status', 'disetujui')->count() }}
    </div>

</div>

    <div class="bg-white border border-gray-200 rounded-xl text-center p-3
            hover:bg-blue-100 hover:border-blue-400
            hover:shadow-xl hover:scale-105
            transition-all duration-300 cursor-pointer">

    <div class="font-bold text-xs text-gray-700">
        DITOLAK
    </div>

    <div class="text-2xl font-bold text-gray-900 mt-1">
        {{ $pengajuan->where('status', 'ditolak')->count() }}
    </div>

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
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item->layanan->nama ?? $item->perizinan->nama ?? '-' }}</td>
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
                        <button type="button"
    onclick='openUpdateModal(
        @json($item->id),
        @json($item->no_permohonan),
        @json($item->nama_lengkap),
        @json($item->layanan?->nama ?? $item->perizinan?->nama ?? "-"),
        @json($item->status),
        @json($item->catatan_admin ?? ""),
        @json($item->file_dokumen ? asset("storage/" . $item->file_dokumen) : ""),
        @json((bool) $item->is_perbaikan)
    )'
    class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-700 transition">

    <i class="fa-solid fa-pen-to-square mr-1"></i>
    Proses
</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400 text-sm">
                        Belum ada permohonan masuk
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

        <h2 class="text-xl font-bold text-gray-800 mb-1">Proses Permohonan</h2>
        <p class="text-sm text-gray-400 mb-5" id="modal_no_permohonan"></p>
       
        <div id="statusMessage" class="hidden mb-5"></div>
        <div id="modal_perbaikan_badge" class="hidden mt-3 mb-5">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                Perbaikan Permohonan
            </span>
        </div>

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
    <p class="text-xs text-gray-400">Dokumen Permohonan</p>

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
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Permohonan</label>
                <select name="status" id="modal_status"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 text-sm">
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
    function openUpdateModal(id, noPermohonan, nama, layanan, status, catatan, dokumenUrl, isPerbaikan) {
        document.getElementById('modal_no_permohonan').textContent = 'No. ' + noPermohonan;
        document.getElementById('modal_nama').textContent = nama;
        document.getElementById('modal_layanan').textContent = layanan;
        document.getElementById('modal_status').value = status;
        document.getElementById('modal_catatan').value = catatan;
        // TAMPILKAN BADGE JIKA PERMOHONAN HASIL PERBAIKAN
const perbaikanBadge = document.getElementById('modal_perbaikan_badge');

if (isPerbaikan) {
    perbaikanBadge.classList.remove('hidden');
} else {
    perbaikanBadge.classList.add('hidden');
}

        // Sesuaikan placeholder catatan dengan status
        updateCatatanAdmin();

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


    // =========================
    // CATATAN ADMIN BERDASARKAN STATUS
    // =========================
    const statusSelect = document.getElementById('modal_status');
    const catatanInput = document.getElementById('modal_catatan');

    function updateCatatanAdmin() {
        const status = statusSelect.value;

        if (status === 'ditolak') {
            catatanInput.placeholder =
                'Masukkan alasan penolakan atau perbaikan yang diperlukan...';

            catatanInput.required = true;

        } else if (status === 'disetujui') {
            catatanInput.placeholder =
                'Tambahkan catatan persetujuan (opsional)...';

            catatanInput.required = false;

        } else {
            catatanInput.placeholder =
                'Tambahkan catatan terkait proses permohonan (opsional)...';

            catatanInput.required = false;
        }
    }

    // Jalankan saat Admin mengganti pilihan status
    statusSelect.addEventListener('change', updateCatatanAdmin);


   function submitUpdate() {

    const status = document.getElementById('modal_status').value;
    const statusMessage = document.getElementById('statusMessage');

    let pesan = 'Status permohonan berhasil diperbarui.';
    let classBox = 'bg-green-100 border border-green-300 text-green-700';
    let icon = 'fa-circle-check text-green-500';

    if (status === 'disetujui') {
        pesan = 'Permohonan berhasil disetujui.';
    } 
    else if (status === 'ditolak') {
        pesan = 'Permohonan berhasil ditolak.';
        classBox = 'bg-red-100 border border-red-300 text-red-700';
        icon = 'fa-circle-xmark text-red-500';
    }

    statusMessage.className =
        'px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2 ' 
        + classBox;

    statusMessage.innerHTML =
        '<i class="fa-solid ' + icon + '"></i>' +
        '<span>' + pesan + '</span>';

    statusMessage.classList.remove('hidden');

    setTimeout(function () {
        document.getElementById('updateForm').submit();
    }, 3000);
}
</script>


@endsection
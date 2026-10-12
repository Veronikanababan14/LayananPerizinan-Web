@extends('layouts.app')

@section('content')

<div class="min-h-screen w-full bg-slate-100">
<div class="max-w-4xl w-full px-4 py-10 mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-blue-700">FAQ</h1>

    <div class="space-y-4">
        <!-- Item FAQ -->
        @foreach ([
            1 => 'Apa itu layanan perizinan BP Batam?',
            2 => 'Bagaimana cara mengajukan permohonan perizinan?',
            3 => 'Bagaimana cara mengetahui status permohonan?',
            4 => 'Siapa yang bisa saya hubungi jika mengalami kesulitan?',
            5 => 'Apa yang harus dilakukan jika permohonan ditolak?'
        ] as $id => $question)
        
        <div class="border rounded-xl shadow-sm p-5 text-left transition hover:bg-gray-300">
            <button onclick="toggleFaq({{ $id }})" 
                    class="flex justify-between items-center w-full text-left cursor-pointer">

                <span class="font-semibold text-lg text-gray-800">
                    {{ $question }}
                </span>

                <svg id="icon-{{ $id }}" 
                     class="w-5 h-5 text-gray-500 transform transition-transform rotate-180"
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <p id="answer-{{ $id }}" class="mt-2 text-gray-600 hidden">
                @if ($id == 1)
                    Layanan perizinan BP Batam adalah sistem yang memfasilitasi masyarakat dan pelaku usaha
                @elseif ($id == 2)
                    Permohonan izin dapat dilakukan secara online melalui portal layanan BP Batam atau datang langsung ke kantor PTSP.
                @elseif ($id == 3)
                    Status permohonan dapat dilihat melalui menu Permohonan Saya setelah pengguna masuk ke dalam sistem.
                @elseif ($id == 4)

                        Anda dapat menghubungi layanan BP Batam melalui informasi kontak yang tersedia pada halaman Kontak.

                    @elseif ($id == 5)

                        Pengguna dapat melihat catatan dari Admin pada detail permohonan, kemudian memperbaiki dan mengirim ulang dokumen sesuai dengan catatan yang diberikan.

                    @endif

            </p>
        </div>

        @endforeach
    </div>

</div>

<script>
    function toggleFaq(id) {
        const answer = document.getElementById(`answer-${id}`);
        const icon = document.getElementById(`icon-${id}`);

        answer.classList.toggle("hidden");
        icon.classList.toggle("rotate-180");
    }
</script>

@endsection

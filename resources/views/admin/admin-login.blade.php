<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-center">Login Admin</h2>

        <!-- Tampilkan pesan error jika login gagal -->
        @if(session('error'))
            <div class="bg-red-100 text-red-700 border border-red-400 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Password</label>
                <div class="relative flex items-center">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full border p-2 rounded pr-10 @error('password') border-red-500 @enderror" 
                        required
                    >
                    <!-- Tombol ikon mata -->
                    <button 
                        type="button" 
                        id="togglePassword" 
                        class="absolute right-3 flex items-center justify-center text-gray-500"
                    >
                        <!-- SVG mata -->
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" 
                             class="h-5 w-5 pointer-events-none" fill="none" 
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                     c4.477 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.065 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
        </form>

        <!-- Forgot Password -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.password.request') }}" class="text-red-600 hover:underline text-sm">
                Lupa Password?
            </a>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Ganti ikon mata terbuka / tertutup
            if(type === 'text') {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M13.875 18.825A10.05 10.05 0 0112 19
                             c-4.478 0-8.268-2.943-9.542-7
                             a10.05 10.05 0 012.152-3.317m3.91-2.667
                             A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                             9.542 7a10.05 10.05 0 01-1.334 2.585M15 12
                             a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 3l18 18" />
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.477 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.065 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        });
    </script>
</body>
</html>

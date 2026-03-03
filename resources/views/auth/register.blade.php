<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-4 bg-gray-100">
        
        <div class="relative flex flex-col w-full max-w-4xl overflow-hidden bg-white shadow-2xl rounded-[30px] md:flex-row min-h-[550px]">
            
            <div class="hidden md:flex w-1/2 bg-indigo-700 flex-col justify-center items-center text-center p-12 relative">
                
                <div class="absolute top-0 right-0 w-full h-full bg-indigo-700 rounded-r-[100px] z-0"></div>
                
                <div class="relative z-10 text-white">
                    <h2 class="mb-4 text-3xl font-bold">Welcome Back!</h2>
                    <p class="mb-8 text-sm leading-relaxed text-indigo-100">
                        Untuk tetap terhubung dengan kami, silakan login dengan info pribadi Anda.
                    </p>
                    
                    <a href="{{ route('login') }}" class="inline-block px-10 py-3 text-xs font-bold tracking-wider text-white uppercase transition border border-white rounded-lg hover:bg-white hover:text-indigo-700">
                        Sign In
                    </a>
                </div>
            </div>

            <div class="flex flex-col justify-center w-full p-8 bg-white md:w-1/2 md:p-14">
                <div class="mb-6 text-center">
                    <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                    
                    <div class="flex justify-center gap-3 my-4">
                        <a href="#" class="flex items-center justify-center w-10 h-10 transition border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 hover:border-gray-400">
                            <i class="fa-brands fa-google-plus-g"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 transition border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 hover:border-gray-400">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 transition border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 hover:border-gray-400">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                    
                    <p class="text-xs text-gray-400">or use your email for registration</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
                    @csrf

                    <div>
                        <input type="text" name="name" placeholder="Nama Lengkap" :value="old('name')" required autofocus
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Email" :value="old('email')" required
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password" required
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <button type="submit" class="w-full py-3 mt-4 text-xs font-bold tracking-wider text-white uppercase transition bg-indigo-700 rounded-lg shadow-md hover:bg-indigo-800">
                        Sign Up
                    </button>
                    
                    <div class="mt-4 text-center md:hidden">
                        <p class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-indigo-700 hover:underline">Masuk</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
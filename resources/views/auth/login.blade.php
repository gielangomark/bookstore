<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen p-4 bg-gray-100">
        
        <div class="relative flex flex-col w-full max-w-4xl overflow-hidden bg-white shadow-2xl rounded-[30px] md:flex-row min-h-[500px]">
            
            <div class="flex flex-col justify-center w-full p-8 bg-white md:w-1/2 md:p-14">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-800">Sign In</h2>
                    
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
                        <a href="#" class="flex items-center justify-center w-10 h-10 transition border border-gray-300 rounded-full text-gray-600 hover:bg-gray-100 hover:border-gray-400">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                    
                    <p class="text-xs text-gray-400">or use your email password</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    <div>
                        <input type="email" name="email" placeholder="Email" required autofocus
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password" required
                               class="w-full px-4 py-3 text-sm bg-gray-100 border-none rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none placeholder-gray-400">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="mt-1 text-center">
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-500 hover:text-gray-900">
                            Forget Your Password?
                        </a>
                    </div>

                    <button type="submit" class="w-full py-3 mt-4 text-xs font-bold tracking-wider text-white uppercase transition bg-indigo-700 rounded-lg shadow-md hover:bg-indigo-800">
                        Sign In
                    </button>
                </form>
            </div>

            <div class="hidden md:flex w-1/2 bg-indigo-700 flex-col justify-center items-center text-center p-12 relative">
                <div class="absolute top-0 left-0 w-full h-full bg-indigo-700 rounded-l-[100px] z-0"></div>
                
                <div class="relative z-10 text-white">
                    <h2 class="mb-4 text-3xl font-bold">Hello, Friend!</h2>
                    <p class="mb-8 text-sm leading-relaxed text-indigo-100">
                        Register with your personal details to use all of site features
                    </p>
                    
                    <a href="{{ route('register') }}" class="inline-block px-10 py-3 text-xs font-bold tracking-wider text-white uppercase transition border border-white rounded-lg hover:bg-white hover:text-indigo-700">
                        Sign Up
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
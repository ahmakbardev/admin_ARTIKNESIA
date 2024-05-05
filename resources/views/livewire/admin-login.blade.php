<div class="flex flex-col bg-primary">
    <div class="flex justify-center lg:justify-normal draggable">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex items-center xl:p-10">
                <form wire:submit.prevent="login" class="flex flex-col w-full h-full p-6 text-center bg-white rounded-lg">
                    <h3 class="mb-3 text-4xl font-extrabold text-dark-gray-900">Sign In</h3>
                    <!-- Menampilkan pesan kesalahan jika login gagal -->
                    @if (session()->has('error'))
                        <div class="text-red-500 mb-3">{{ session('error') }}</div>
                    @endif
                    <label for="email" class="mb-2 text-sm text-start text-gray-900">Email*</label>
                    <input id="email" wire:model="email" type="email" placeholder="user@example.com"
                        class="flex items-center w-full px-5 py-3 mr-2 text-sm font-medium outline-none focus:bg-white focus:ring-1 focus:ring-primary mb-7 placeholder:text-gray-300 placeholder:font-semibold bg-gray-100 text-dark-gray-900 rounded-lg" />
                    <label for="password" class="mb-2 text-sm text-start text-gray-900">Password*</label>
                    <input id="password" wire:model="password" type="password" placeholder="Enter a password"
                        class="flex items-center w-full px-5 py-3 mb-5 mr-2 text-sm font-medium outline-none focus:bg-white focus:ring-1 focus:ring-primary placeholder:text-gray-300 placeholder:font-semibold bg-gray-100 text-dark-gray-900 rounded-lg" />
                    <button
                        class="w-full py-3 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-lg focus:ring-4 bg-primary">Sign
                        In</button>
                </form>
            </div>
        </div>
    </div>
</div>

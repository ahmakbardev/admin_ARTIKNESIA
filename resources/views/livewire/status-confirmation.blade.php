<div class="text-center">
    <select wire:model="status"
        class="px-2 py-1 font-semibold leading-tight rounded-full appearance-none text-center
        @if ($status == 'confirmed') text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100
        @elseif ($status == 'pending') text-yellow-500 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100
        @elseif ($status == 'gagal') text-red-500 bg-red-100 dark:bg-red-700 dark:text-red-100 @endif">
        <option value="confirmed">Confirmed</option>
        <option value="pending">Pending</option>
        <option value="gagal">Gagal</option>
    </select>

    <button wire:click="updateStatus" class="bg-white w-full mt-3 py-1 rounded-md text-black font-semibold">Save</button>

    <!-- Modal -->
    {{-- <div x-show="isModalOpen || updating" x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal"
        @keydown.escape="closeModal"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog" id="modal">
        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex justify-end">
            <button
                class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                aria-label="close" @click="closeModal">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                    <path
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </button>
        </header>
        <!-- Modal body -->
        <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Modal header
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
                eligendi repudiandae voluptatem tempore!
            </p>
        </div>
        <footer
            class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Cancel
            </button>
            <button wire:loading.remove wire:click="updateStatus"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Accept
            </button>
        </footer>
    </div> --}}

    <!-- Modal loading -->
    <div wire:loading x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-gray-900 bg-opacity-50"
        role="dialog" aria-modal="true" aria-labelledby="modal-title" id="loading-modal">
        <div class="w-full mx-auto absolute overflow-hidden top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-white rounded-lg shadow-lg max-w-lg">
            <div class="flex items-center justify-center p-8">
                <svg viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg"
                    class="w-24 h-24 text-purple-600 animate-spin">
                    <circle cx="400" cy="400" r="203" stroke-width="50" stroke="#E387FF"
                        stroke-dasharray="451 1400" stroke-linecap="round" fill="none"></circle>
                </svg>
            </div>
        </div>
    </div>

</div>

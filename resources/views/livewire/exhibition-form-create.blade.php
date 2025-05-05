<div>
    <div class="w-full">
        <form wire:submit.prevent="submit" enctype="multipart/form-data" class="flex w-full flex-col gap-4">
            <div class="flex gap-4">
                <div class="w-full">
                    <label class="text-sm text-white">Name</label>
                    <input type="text" class="h-8 w-full rounded-md px-2" wire:model.live="name" />
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="text-sm text-white">Slug</label>
                    <input type="text" class="h-8 w-full rounded-md px-2" wire:model.live="slug" />
                    @error('slug')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Description</label>
                <textarea class="w-full rounded-md px-2" name="description" id="description" rows="4" wire:model="description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Address</label>
                <textarea class="w-full rounded-md px-2" name="address" id="address" rows="2" wire:model="address">{{ old('address') }}</textarea>
                @error('address')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-4">
                <div class="w-full">
                    <label class="text-sm text-white">Start Date</label>
                    <input type="date" class="h-8 w-full rounded-md px-2" name="start_date" id="start_date"
                           wire:model="start_date" value="{{ old('start_date') }}" />
                    @error('start_date')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="text-sm text-white">End Date</label>
                    <input type="date" class="h-8 w-full rounded-md px-2" name="end_date" id="end_date"
                           wire:model="end_date" value="{{ old('end_date') }}" />
                    @error('end_date')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-full">
                    <label class="text-sm text-white">Organizer</label>
                    <input type="text" class="h-8 w-full rounded-md px-2" name="organizer" id="organizer"
                           wire:model="organizer" value="{{ old('organizer') }}" />
                    @error('organizer')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="text-sm text-white">Category</label>
                    <select name="category" id="category" class="h-8 w-full rounded-md px-2" wire:model="category">
                        <option>Pilih salah satu</option>
                        <option value="lukisan" {{ old('category') == 'lukisan' ? 'selected' : '' }}>
                            Lukisan
                        </option>
                        <option value="fotografi" {{ old('category') == 'fotografi' ? 'selected' : '' }}>
                            Fotografi
                        </option>
                        <option value="instalasi" {{ old('category') == 'instalasi' ? 'selected' : '' }}>
                            Instalasi
                        </option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-full">
                    <label class="text-sm text-white">City</label>
                    <select class="select2 h-8 w-full rounded-md px-2" name="city" id="city" wire:model="city">
                        <option>Pilih salah satu</option>
                        @foreach ($cities as $item)
                            <option value="{{ $item->name }}" {{ old('city') == $item->name ? 'selected' : '' }}>
                                {{ $item->province->name . ' - ' . $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="text-sm text-white">Type</label>
                    <select name="type" id="type" class="h-8 w-full rounded-md px-2" wire:model="type">
                        <option>Pilih salah satu</option>
                        <option value="onsite" {{ old('type') == 'onsite' ? 'selected' : '' }}>
                            Onsite
                        </option>
                        <option value="virtual" {{ old('type') == 'virtual' ? 'selected' : '' }}>
                            Virtual
                        </option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-full">
                    <label class="text-sm text-white">Price</label>
                    <input type="number" class="h-8 w-full rounded-md px-2" name="price" id="price"
                           wire:model="price" value="{{ old('price', 0) }}" />
                    @error('price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full">
                    <label class="text-sm text-white">Status</label>
                    <select name="status" id="status" class="h-8 w-full rounded-md px-2" wire:model="status">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Link</label>
                <input type="url" class="h-8 w-full rounded-md px-2" name="link" id="link"
                       wire:model="link" value="{{ old('link') }}" />
                @error('link')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Banner</label>
                <input type="file" class="w-full rounded-md bg-white p-2" wire:model="banner" accept="image/*" />
                <div wire:loading wire:target="banner">
                    Uploading...
                </div>
                @error('banner')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @if ($banner)
                    <div class="mt-2">
                        <img src="{{ $banner->temporaryUrl() }}" alt="Banner Preview" class="h-32 rounded object-cover">
                    </div>
                @endif
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Foto Pameran</label>
                {{-- Test  --}}
                <input type="file" class="new_image w-full rounded-md bg-white p-2" wire:model="new_image"
                       accept="image/*" />
                <div wire:loading wire:target="new_image">
                    Uploading...
                </div>
                @error('new_image')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @if ($exhibition_images)
                    <div class="mt-2 flex gap-4">
                        @foreach ($exhibition_images as $key => $item_image)
                            <div class="group relative">
                                <img src="{{ $item_image->temporaryUrl() }}" alt="exhibition_image Preview"
                                     class="h-32 rounded object-cover">
                                <button type="button" wire:click="removeImage({{ $key }})"
                                        class="absolute right-1 top-1 size-4 rounded-sm bg-red-500 p-0.5 text-xs leading-none text-white shadow-md hover:bg-red-700"><i class="fa-solid fa-xmark"></i></button>
                                <button type="button" onclick="openZoom('{{ $item_image->temporaryUrl() }}')"
                                        class="absolute left-1 top-1 size-4 rounded-sm bg-neutral-300/70 p-0.5 leading-none shadow-md hover:bg-neutral-500/60"><img src="{{ asset('admin/assets/img/zoom-picture-pameran.svg') }}" class="size-3" alt=""></button>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- @if ($exhibition_images)
                    <div class="mt-2 flex gap-4">
                        @foreach ($exhibition_images as $key => $item_image)
                            <div class="relative group">
                                <img src="{{ $item_image->temporaryUrl() }}" alt="exhibition_image Preview"
                                    class="h-32 object-cover rounded">
                                <button type="button" wire:click="removeImage({{ $key }})"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs hover:bg-red-700">×</button>
                            </div>
                        @endforeach
                    </div>
                @endif --}}


                @error('exhibition_images')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-sm text-white">Link Vidio Pameran(youtube)</label>
                <input type="url" class="h-8 w-full rounded-md px-2" name="link_vidio" id="link_vidio"
                       wire:model.live.debounce.250ms="link_vidio" value="{{ old('link_vidio') }}" />
                @error('link_vidio')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @else
                    @if ($embed_link)
                        <div class="mt-2 flex justify-center">
                            <iframe width="560" height="315" src="{{ $embed_link }}" title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    @endif
                @enderror

            </div>
            <button type="submit" class="w-full rounded-md bg-blue-500 px-4 py-2 text-white">Simpan
            </button>
        </form>
    </div>

    <!-- Modal Zoom -->
    <div id="zoomModal" class="fixed inset-0 z-[110] flex hidden items-center justify-center bg-black/80">
        <img id="zoomedImage" src="" class="max-h-full max-w-full scale-75 transform rounded-lg" alt="img">
        <button onclick="closeZoom()" class="absolute right-5 top-5 flex h-8 w-8 items-center justify-center rounded-full bg-red-500 text-white"><i class="fa-solid fa-xmark"></i></button>
    </div>
</div>


<script>
    function openZoom(src) {
        const modal = document.getElementById('zoomModal');
        const zoomedImg = document.getElementById('zoomedImage');
        zoomedImg.src = src;
        modal.classList.remove('hidden');
    }

    // Fungsi tutup modal zoom
    function closeZoom() {
        document.getElementById('zoomModal').classList.add('hidden');
    }
</script>

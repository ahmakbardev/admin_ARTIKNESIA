<div class="w-full ">
    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="flex flex-col gap-4 w-full">
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Name</label>
                <input type="text" class="w-full px-2 rounded-md h-8" wire:model.live="name" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Slug</label>
                <input type="text" class="w-full px-2 rounded-md h-8" wire:model.live="slug" />
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Description</label>
            <textarea class="w-full px-2 rounded-md" name="description" id="description" rows="4" wire:model="description">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Address</label>
            <textarea class="w-full px-2 rounded-md" name="address" id="address" rows="2" wire:model="address">{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Start Date</label>
                <input type="date" class="w-full px-2 rounded-md h-8" name="start_date" id="start_date"
                    wire:model="start_date" value="{{ old('start_date') }}" />
                @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">End Date</label>
                <input type="date" class="w-full px-2 rounded-md h-8" name="end_date" id="end_date"
                    wire:model="end_date" value="{{ old('end_date') }}" />
                @error('end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Organizer</label>
                <input type="text" class="w-full px-2 rounded-md h-8" name="organizer" id="organizer"
                    wire:model="organizer" value="{{ old('organizer') }}" />
                @error('organizer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Category</label>
                <select name="category" id="category" class="w-full px-2 rounded-md h-8" wire:model="category">
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
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">City</label>
                <select class="select2 w-full px-2 rounded-md h-8" name="city" id="city" wire:model="city">
                    <option>Pilih salah satu</option>
                    @foreach ($cities as $item)
                        <option value="{{ $item->name }}" {{ old('city') == $item->name ? 'selected' : '' }}>
                            {{ $item->province->name . ' - ' . $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Type</label>
                <select name="type" id="type" class="w-full px-2 rounded-md h-8" wire:model="type">
                    <option>Pilih salah satu</option>
                    <option value="onsite" {{ old('type') == 'onsite' ? 'selected' : '' }}>
                        Onsite
                    </option>
                    <option value="virtual" {{ old('type') == 'virtual' ? 'selected' : '' }}>
                        Virtual
                    </option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Price</label>
                <input type="number" class="w-full px-2 rounded-md h-8" name="price" id="price"
                    wire:model="price" value="{{ old('price', 0) }}" />
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Status</label>
                <select name="status" id="status" class="w-full px-2 rounded-md h-8" wire:model="status">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Link</label>
            <input type="url" class="w-full px-2 rounded-md h-8" name="link" id="link"
                wire:model="link" value="{{ old('link') }}" />
            @error('link')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Banner</label>
            <input type="file" class="w-full p-2 rounded-md bg-white" wire:model="banner" accept="image/*" />
            <div wire:loading wire:target="banner">
                Uploading...
            </div>
            @error('banner')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @if ($banner)
                <div class="mt-2">
                    <img src="{{ $banner->temporaryUrl() }}" alt="Banner Preview" class="h-32 object-cover rounded">
                </div>
            @endif
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Foto Pameran</label>
            {{-- Test  --}}
            <input type="file" class="w-full p-2 rounded-md bg-white new_image" wire:model="new_image"
                accept="image/*" />
            <div wire:loading wire:target="new_image">
                Uploading...
            </div>
            @error('new_image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @if ($exhibition_images)
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
            @endif
            @error('exhibition_images')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Link Vidio Pameran(youtube)</label>
            <input type="url" class="w-full px-2 rounded-md h-8" name="link_vidio" id="link_vidio"
                wire:model.live.debounce.250ms="link_vidio" value="{{ old('link_vidio') }}" />
            @error('link_vidio')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @else
                @if ($embed_link)
                    <div class="flex justify-center mt-2">
                        <iframe width="560" height="315" src="{{ $embed_link }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                @endif
            @enderror

        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full">Simpan
        </button>
    </form>
</div>

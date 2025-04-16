<div class="w-full">
    <form wire:submit="submit" enctype="multipart/form-data" class="flex flex-col gap-6">
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Name</label>
                <input type="text" class="w-full px-2 rounded-md h-8"
                       wire:model.live="name"/>
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Slug</label>
                <input type="text" class="w-full px-2 rounded-md h-8"
                       wire:model.live="slug"/>
                @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Description</label>
            <textarea class="w-full px-2 rounded-md" name="description" id="description" rows="4"
                      wire:model="description"
            >{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Address</label>
            <textarea class="w-full px-2 rounded-md" name="address" id="address" rows="2"
                      wire:model="address"
            >{{ old('address') }}</textarea>
            @error('address')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Start Date</label>
                <input type="date" class="w-full px-2 rounded-md h-8" name="start_date"
                       id="start_date"
                       wire:model="start_date"
                       value="{{ old('start_date') }}"/>
                @error('start_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">End Date</label>
                <input type="date" class="w-full px-2 rounded-md h-8" name="end_date" id="end_date"
                       wire:model="end_date"
                       value="{{ old('end_date') }}"/>
                @error('end_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-full">
                <label class="text-white text-sm">Organizer</label>
                <input type="text" class="w-full px-2 rounded-md h-8" name="organizer"
                       id="organizer"
                       wire:model="organizer"
                       value="{{ old('organizer') }}"/>
                @error('organizer')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Category</label>
                <select name="category" id="category" class="w-full px-2 rounded-md h-8"
                        wire:model="category">
                    <option>Pilih salah satu</option>
                    <option value="lukisan" {{ old('category',$exhibition->category) == 'lukisan' ? 'selected' : '' }}>
                        Lukisan
                    </option>
                    <option value="fotografi" {{ old('category',$exhibition->category) == 'fotografi' ? 'selected' : '' }}>
                        Fotografi
                    </option>
                    <option value="instalasi" {{ old('category',$exhibition->category) == 'instalasi' ? 'selected' : '' }}>
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
                <select class="select2 w-full px-2 rounded-md h-8" name="city" id="city"
                        wire:model="city">
                    <option>Pilih salah satu</option>
                    @foreach($cities as $item)
                        <option value="{{ $item->name }}" {{ old('city', $exhibition->city) == $item->name ? 'selected' : '' }}>
                            {{ $item->province->name . ' - ' .$item->name }}
                        </option>
                    @endforeach
                </select>

                @error('city')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Type</label>
                <select name="type" id="type" class="w-full px-2 rounded-md h-8"
                        wire:model="type">
                    <option>Pilih salah satu</option>
                    <option value="onsite" {{ old('type', $exhibition->type) == 'onsite' ? 'selected' : '' }}>
                        Onsite
                    </option>
                    <option value="virtual" {{ old('type', $exhibition->type) == 'virtual' ? 'selected' : '' }}>
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
                       wire:model="price"
                       value="{{ old('price', 0) }}"/>
                @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <label class="text-white text-sm">Status</label>
                <select name="status" id="status" class="w-full px-2 rounded-md h-8"
                        wire:model="status">
                    <option value="active" {{ old('status',$exhibition->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive" {{ old('status', $exhibition->status) == 'inactive' ? 'selected' : '' }}>
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
                   wire:model="link"
                   value="{{ old('link') }}"/>
            @error('link')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="text-white text-sm">Banner</label>
            <input type="file"
                   class="w-full p-2 rounded-md bg-white"
                   wire:model="newBanner"
                   accept="image/*"/>
            <div wire:loading wire:target="newBanner">
                <span class="text-sm text-blue-400">Uploading...</span>
            </div>
            @error('newBanner')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @if ($newBanner)
                <div class="mt-2">
                    <img src="{{ $newBanner->temporaryUrl() }}"
                         alt="New Banner Preview"
                         class="h-32 object-cover rounded">
                </div>
            @else
                @if($banner)
                    <div class="mb-2">
                        <img src="{{asset('storage/'.ltrim($banner, '/')) }}"
                             alt="Current Banner"
                             class="h-32 object-cover rounded">
                    </div>
                @endif
            @endif
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full">Simpan
        </button>
    </form>
</div>

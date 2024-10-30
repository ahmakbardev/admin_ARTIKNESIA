<div class="flex flex-col gap-y-4">
    <div class="w-full">
        <label class="text-white text-sm">Title</label>
        <input type="text" class="w-full px-2 rounded-md h-8" name="title" id="title" wire:model="title"
               wire:blur="generateSlug"/>
    </div>
    <div class="w-full">
        <label class="text-white text-sm">Slug</label>
        <input type="text" class="w-full px-2 rounded-md h-8" name="slug" id="slug" wire:model="slug" readonly/>
    </div>
</div>

@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    
    
    <div class="px-6 py-4">
        <div class="text-lg text-sky-900">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class=" justify-end px-3 py-2 border-t bg-sky-800 border-sky-300 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>

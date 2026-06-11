@props([
    'label' => 'Upload Image',
    'id' => null,
])

@php
    $id = $id ?? 'image-dropzone-' . Str::random(8);
    $wireModel = $attributes->wire('model')->value();
@endphp

<div class="w-full" x-data="base64ImageUploader({
    state: @if($wireModel) $wire.entangle('{{ $wireModel }}') @else null @endif
})">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-text-primary mb-2">
            {{ $label }}
        </label>
    @endif

    @if($wireModel)
        <!-- Hidden input to allow parent form scripts (like local storage) to find and read the value -->
        <input type="hidden" {{ $attributes->whereStartsWith('wire:model') }} :value="state">
    @endif

    <div
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="handleDrop"
        class="relative border-2 border-dashed rounded-2xl flex flex-col items-center justify-center cursor-pointer transition-all duration-300 min-h-60 overflow-hidden group w-full"
        :class="isDragging ? 'bg-brand-primary/5 border-brand-primary' : 'bg-surface-muted/30 border-subtle hover:bg-surface-muted/60 hover:border-brand-primary/60'"
        @click="$refs.fileInput.click()"
    >
        <input
            type="file"
            id="{{ $id }}"
            x-ref="fileInput"
            @change="handleFileChange"
            accept="image/*"
            class="hidden"
        >

        <!-- Placeholder state -->
        <div x-show="!previewUrl" class="flex flex-col items-center justify-center p-6 text-center w-full h-full absolute inset-0">
            <div class="w-16 h-16 mb-4 rounded-full bg-surface shadow-sm border border-subtle flex items-center justify-center group-hover:scale-110 group-hover:shadow-md transition-all duration-300">
                <svg class="w-7 h-7 text-text-muted group-hover:text-brand-primary transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
            </div>
            <p class="text-sm font-medium text-text-primary mb-1.5">
                <span class="text-brand-primary hover:underline">Click to upload</span> or drag and drop
            </p>
            <p class="text-xs text-text-muted font-medium">SVG, PNG, JPG or GIF (max. 5MB)</p>
        </div>

        <!-- Preview state -->
        <div x-show="previewUrl" style="display: none;" class="w-full h-full absolute inset-0 bg-surface">
            <img :src="previewUrl" alt="Preview" class="w-full h-full object-contain p-2" />
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                <div class="flex items-center gap-2 bg-white text-gray-900 px-6 py-3 rounded-full font-bold shadow-2xl transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ring-4 ring-black/10">
                    <svg class="w-5 h-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Change Image
                </div>
            </div>
        </div>
    </div>
    
    @error($wireModel)
        <p class="mt-2 text-sm text-red-500 font-medium flex items-center gap-1.5">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>

@once
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('base64ImageUploader', (config) => ({
            state: config.state,
            previewUrl: null,
            isDragging: false,

            init() {
                if (this.state) {
                    this.previewUrl = this.state;
                }
                this.$watch('state', (value) => {
                    this.previewUrl = value;
                    // Dispatch input event so that parent form persistence scripts can catch it
                    this.$el.dispatchEvent(new Event('input', { bubbles: true }));
                });
            },
            handleDrop(e) {
                this.isDragging = false;
                if (e.dataTransfer.files.length) {
                    this.processFile(e.dataTransfer.files[0]);
                }
            },
            handleFileChange(e) {
                if (e.target.files.length) {
                    this.processFile(e.target.files[0]);
                }
            },
            processFile(file) {
                if (!file.type.match('image.*')) {
                    alert('Please upload an image file.');
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        const webpBase64 = canvas.toDataURL('image/webp', 0.85); // High quality WebP
                        this.state = webpBase64;
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }));
    });
</script>
@endonce

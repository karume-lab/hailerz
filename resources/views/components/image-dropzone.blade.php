@props([
    'label' => 'Upload Image',
    'id' => null,
])

@php
    $id = $id ?? 'image-dropzone-' . Str::random(8);
@endphp

<div class="w-full" x-data="base64ImageUploader({
    state: $wire.entangle('{{ $attributes->wire('model')->value() }}')
})">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-text-primary mb-2">
            {{ $label }}
        </label>
    @endif

    <div
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="handleDrop"
        class="relative border-2 border-dashed rounded-2xl p-10 flex flex-col items-center justify-center cursor-pointer transition-all duration-200"
        :class="isDragging ? 'bg-surface-light border-brand-primary' : 'bg-surface-muted/30 border-subtle hover:bg-surface-muted/50 hover:border-brand-primary/50'"
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

        <div x-show="!previewUrl" class="flex flex-col items-center justify-center gap-3 py-4">
            <div class="flex items-center gap-2 px-5 py-2.5 rounded-full border border-subtle shadow-sm bg-surface hover:bg-surface-muted transition-colors text-brand-primary font-medium">
                <x-lucide-arrow-up-circle class="w-5 h-5" />
                Select a file
            </div>
            <span class="text-sm text-text-muted">or</span>
            <span class="text-base text-text-secondary">Drag and drop a file here</span>
        </div>

        <div x-show="previewUrl" style="display: none;" class="w-full relative group">
            <img :src="previewUrl" alt="Preview" class="w-full h-auto max-h-64 object-contain rounded-lg shadow-sm" />
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                <p class="text-white font-medium flex items-center gap-2">
                    <x-lucide-refresh-cw class="w-5 h-5" /> Change Image
                </p>
            </div>
        </div>
    </div>
    
    @error($attributes->wire('model')->value())
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
                        // Optional: Scale down if too large, but for now just use original size
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        // Compress to WebP with 0.5 quality
                        const webpBase64 = canvas.toDataURL('image/webp', 0.5);
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

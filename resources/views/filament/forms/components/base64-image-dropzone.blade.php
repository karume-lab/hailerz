<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="filamentBase64ImageUploader({
        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }}
    })">
        <div
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop"
            class="relative border-2 border-dashed rounded-2xl p-10 flex flex-col items-center justify-center cursor-pointer transition-all duration-200"
            :class="isDragging ? 'bg-primary-50 border-primary-500 dark:bg-primary-500/10' : 'bg-gray-50 border-gray-300 dark:border-gray-600 hover:border-primary-500 dark:hover:border-primary-500 hover:bg-gray-100 dark:bg-gray-800/50 dark:hover:bg-gray-800'"
            @click="$refs.fileInput.click()"
        >
            <input
                type="file"
                x-ref="fileInput"
                @change="handleFileChange"
                accept="image/*"
                class="hidden"
            >

            <div x-show="!previewUrl" class="flex flex-col items-center justify-center gap-3 py-4">
                <div class="flex items-center gap-2 px-5 py-2.5 rounded-full border border-gray-200 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-primary-600 dark:text-primary-400 font-medium">
                    <x-heroicon-o-arrow-up-circle class="w-5 h-5" />
                    Select a file
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">or</span>
                <span class="text-base text-gray-600 dark:text-gray-300">Drag and drop a file here</span>
            </div>

            <div x-show="previewUrl" style="display: none;" class="w-full relative group">
                <img :src="previewUrl" alt="Preview" class="w-full h-auto max-h-64 object-contain rounded-lg shadow-sm" />
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                    <p class="text-white font-medium flex items-center gap-2">
                        <x-heroicon-o-arrow-path class="w-5 h-5" /> Change Image
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>

@once
<script>
    window.hasRegisteredFilamentBase64ImageUploader = false;
    const initFilamentBase64ImageUploader = () => {
        if (window.hasRegisteredFilamentBase64ImageUploader || !window.Alpine) return;
        
        window.Alpine.data('filamentBase64ImageUploader', (config) => ({
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
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        const webpBase64 = canvas.toDataURL('image/webp', 0.5);
                        this.state = webpBase64;
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }));
        
        window.hasRegisteredFilamentBase64ImageUploader = true;
    };

    if (window.Alpine) {
        initFilamentBase64ImageUploader();
    } else {
        document.addEventListener('alpine:init', initFilamentBase64ImageUploader);
    }
</script>
@endonce

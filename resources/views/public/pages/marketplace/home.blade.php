<x-layouts.app>
    <x-slot:title>Hailerz Marketplace | Hailerz</x-slot>
    
    <div class="bg-surface-light">
        <x-marketplace.hero :allCategories="$allCategories" />
        <x-marketplace.booking-steps />
    </div>
</x-layouts.app>
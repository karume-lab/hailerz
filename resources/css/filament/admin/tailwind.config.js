import preset from '../../../../vendor/filament/filament/tailwind.config.preset.js'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'brand-teal': 'var(--brand-teal)',
                'text-secondary': 'var(--text-secondary)',
            }
        }
    }
}

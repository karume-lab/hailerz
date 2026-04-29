<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->font('Outfit')
            ->brandLogo(asset('images/logo.webp'))
            ->brandLogoHeight('2.5rem')
            ->colors([
                'primary' => [
                    50 => '#e6f3f6',
                    100 => '#cde7ee',
                    200 => '#9ccedd',
                    300 => '#6bb6cc',
                    400 => '#3a9ebb',
                    500 => '#1a8aa7', // Brand Teal
                    600 => '#156e86',
                    700 => '#105364',
                    800 => '#0a3843',
                    900 => '#051d21',
                    950 => '#020e10',
                ],
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Sky,
                'success' => [
                    50 => '#f0faf6',
                    100 => '#e0f5ee',
                    200 => '#c1ebdc',
                    300 => '#a2e1ca',
                    400 => '#83d7b9',
                    500 => '#65c4af', // Brand Mint
                    600 => '#519d8c',
                    700 => '#3d7669',
                    800 => '#284e46',
                    900 => '#142723',
                    950 => '#0a1311',
                ],
                'warning' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->renderHook(
                'panels::head.end',
                fn (): string => \Illuminate\Support\Facades\Blade::render("
                    @vite('resources/css/admin.css')
                    <script>
                        function applyTheme() {
                            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        }
                        applyTheme();
                    </script>
                ")
            )
            ->renderHook(
                'panels::user-menu.before',
                fn (): string => \Illuminate\Support\Facades\Blade::render("<div class='hidden lg:flex items-center me-4'><x-theme-toggle /></div>")
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

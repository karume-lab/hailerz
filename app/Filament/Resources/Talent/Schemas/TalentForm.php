<?php

namespace App\Filament\Resources\Talent\Schemas;

use App\Filament\Forms\Components\Base64ImageDropzone;
use App\Helpers\MediaPreviewHelper;
use App\Models\Talent;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class TalentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Professional Identity')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Performer / Act Name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                        ->columnSpan(1),
                    Forms\Components\Select::make('talent_type')
                        ->label('Talent Type')
                        ->options([
                            'individual' => 'Individual Performer',
                            'group' => 'Group / Band',
                        ])
                        ->required()
                        ->live()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('member_count')
                        ->label('Member Count')
                        ->numeric()
                        ->visible(fn ($get) => $get('talent_type') === 'group')
                        ->required(fn ($get) => $get('talent_type') === 'group')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('slug')
                        ->hidden()
                        ->dehydrated()
                        ->required()
                        ->unique(Talent::class, 'slug', ignoreRecord: true)
                        ->columnSpan(1),
                    Forms\Components\Select::make('category_id')
                        ->label('Discipline / Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('genre')
                        ->label('Primary Genre')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('years_active')
                        ->label('Years Active')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('email')
                        ->label('Contact Email')
                        ->email()
                        ->required()
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Executive Biography & Career Highlights')
                ->schema([
                    Forms\Components\RichEditor::make('bio')
                        ->label('Artist Biography')
                        ->placeholder("Detail the performer's experience with corporate clients, notable venues, and performance scale...")
                        ->required()
                        ->columnSpanFull()
                        ->extraAttributes(['style' => 'min-height: 350px']),
                ])
                ->columnSpanFull(),

            Section::make('Media & Performance Assets')
                ->description('All media should be provided as links - no file uploads required.')
                ->schema([
                    Base64ImageDropzone::make('primary_image_url')
                        ->label('Primary Promotional Image Upload')
                        ->live(onBlur: true)
                        ->columnSpanFull(),
                    TextEntry::make('primary_image_preview')
                        ->label('Primary Image Preview')
                        ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('primary_image_url'))))
                        ->visible(fn ($get) => ! empty($get('primary_image_url')) && filter_var($get('primary_image_url'), FILTER_VALIDATE_URL))
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('video_url')
                        ->url()
                        ->label('Showreel / Performance Link')
                        ->placeholder('https://youtube.com/watch?v=...')
                        ->live(onBlur: true)
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openVideo')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    Forms\Components\TextInput::make('rate_card_url')
                        ->url()
                        ->label('Rate Card URL')
                        ->live(onBlur: true)
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openRateCard')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    TextEntry::make('video_preview')
                        ->label('Video Preview')
                        ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('video_url'))))
                        ->visible(fn ($get) => ! empty($get('video_url')) && filter_var($get('video_url'), FILTER_VALIDATE_URL))
                        ->columnSpan(1),
                    TextEntry::make('rate_card_preview')
                        ->label('Rate Card Preview')
                        ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('rate_card_url'))))
                        ->visible(fn ($get) => ! empty($get('rate_card_url')) && filter_var($get('rate_card_url'), FILTER_VALIDATE_URL))
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('technical_rider')
                        ->label('Technical Rider URL')
                        ->live(onBlur: true)
                        ->columnSpanFull()
                        ->suffixAction(
                            Action::make('openTechnicalRider')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    TextEntry::make('technical_rider_preview')
                        ->label('Technical Rider Preview')
                        ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('technical_rider'))))
                        ->visible(fn ($get) => ! empty($get('technical_rider')) && filter_var($get('technical_rider'), FILTER_VALIDATE_URL))
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('website_url')
                        ->label('Website URL')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openWebsite')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    Forms\Components\TextInput::make('instagram_handle')
                        ->label('Instagram URL')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openInstagram')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openFacebook')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    Forms\Components\TextInput::make('youtube_channel')
                        ->label('YouTube Channel URL')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openYoutube')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    Forms\Components\TextInput::make('tiktok_handle')
                        ->label('TikTok URL')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openTiktok')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),

                    Forms\Components\Repeater::make('gallery')
                        ->relationship('gallery')
                        ->label('Portfolio Gallery')
                        ->schema([
                            Forms\Components\Select::make('media_type')
                                ->label('Media Type')
                                ->options([
                                    'image' => 'Image Upload',
                                    'link' => 'External Link',
                                ])
                                ->default('link')
                                ->live()
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('url')
                                ->label('Media URL (YouTube, Vimeo, etc.)')
                                ->url()
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpan(2)
                                ->visible(fn ($get) => $get('media_type') === 'link')
                                ->suffixAction(
                                    Action::make('openGalleryItem')
                                        ->icon('heroicon-m-arrow-top-right-on-square')
                                        ->url(fn ($state) => $state)
                                        ->openUrlInNewTab()
                                        ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                                ),
                            Base64ImageDropzone::make('url')
                                ->label('Upload Image')
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpan(2)
                                ->visible(fn ($get) => $get('media_type') === 'image'),
                            Forms\Components\TextInput::make('title')
                                ->label('Title')
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('description')
                                ->label('Description')
                                ->columnSpan(1),
                            TextEntry::make('media_preview')
                                ->label('Media Preview')
                                ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('url'))))
                                ->visible(fn ($get) => ! empty($get('url')) && (filter_var($get('url'), FILTER_VALIDATE_URL) || str_starts_with($get('url'), 'data:image/')))
                                ->columnSpanFull(),
                        ])
                        ->columns(4)
                        ->defaultItems(0)
                        ->reorderable(true)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Financial Parameters & Logistics')
                ->schema([
                    Forms\Components\TextInput::make('location')
                        ->label('Primary Base (City, Country)')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('starting_price')
                        ->label('Minimum Performance Fee (USD)')
                        ->numeric()
                        ->prefix('$')
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Agency Procurement Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Talent Status')
                        ->options([
                            'draft' => 'Under Review',
                            'awaiting_agreement' => 'Awaiting Agreement',
                            'active' => 'Active on Talent',
                            'hidden' => 'Archived / Private',
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Premium Placement')
                        ->inline(false)
                        ->columnSpan(1),
                    Forms\Components\Toggle::make('has_signed_agreement')
                        ->label('Agreement Signed')
                        ->inline(false)
                        ->columnSpan(1),
                    Forms\Components\DateTimePicker::make('agreement_signed_at')
                        ->label('Signed At')
                        ->columnSpan(1),
                    Forms\Components\Textarea::make('internal_notes')
                        ->label('Internal Agency Notes')
                        ->helperText('Notes for internal booking agents only - never shown to clients.')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}

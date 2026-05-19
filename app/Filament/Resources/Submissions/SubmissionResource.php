<?php

namespace App\Filament\Resources\Submissions;

use App\Helpers\CurrencyHelper;
use App\Helpers\MediaPreviewHelper;
use App\Mail\TalentAgreementMail;
use App\Models\Category;
use App\Models\Submission;
use App\Models\Talent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use UnitEnum;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static string|UnitEnum|null $navigationGroup = 'Talent Procurement';

    public static function getNavigationLabel(): string
    {
        return 'Talent Applications';
    }

    public static function getModelLabel(): string
    {
        return 'Talent Application';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Talent Applications';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Applicant Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('artist_name')
                        ->label('Performer / Act Name')
                        ->required()
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
                    Forms\Components\TextInput::make('real_name')
                        ->label('Legal / Real Name')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('email')
                        ->label('Professional Email')
                        ->email()
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('phone')
                        ->label('Phone Number')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('location')
                        ->label('Base Location')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('profile_photo_url')
                        ->label('Profile Photo URL')
                        ->url()
                        ->live(onBlur: true)
                        ->columnSpanFull()
                        ->suffixAction(
                            Action::make('openPhoto')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                    TextEntry::make('profile_photo_preview')
                        ->label('Profile Photo Preview')
                        ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('profile_photo_url'))))
                        ->visible(fn ($get) => ! empty($get('profile_photo_url')) && filter_var($get('profile_photo_url'), FILTER_VALIDATE_URL))
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Professional Details')
                ->schema([
                    Forms\Components\TextInput::make('category')
                        ->label('Talent Category')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('genre')
                        ->label('Primary Genre')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('years_active')
                        ->label('Years Active')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('min_rate')
                        ->label(fn ($record) => 'Minimum Rate ('.(($record ? $record->currency : null) ?? 'USD').')')
                        ->numeric()
                        ->prefix(fn ($record) => CurrencyHelper::getCurrencySymbolForCode(($record ? $record->currency : null) ?? 'USD'))
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('max_rate')
                        ->label(fn ($record) => 'Maximum Rate ('.(($record ? $record->currency : null) ?? 'USD').')')
                        ->numeric()
                        ->prefix(fn ($record) => CurrencyHelper::getCurrencySymbolForCode(($record ? $record->currency : null) ?? 'USD'))
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('currency')
                        ->label('Currency Code')
                        ->disabled()
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Online Presence')
                ->schema([
                    Forms\Components\TextInput::make('website_url')
                        ->label('Website')
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
                        ->label('Instagram')
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
                        ->label('Facebook')
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
                        ->label('YouTube')
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
                        ->label('TikTok')
                        ->url()
                        ->columnSpan(1)
                        ->suffixAction(
                            Action::make('openTiktok')
                                ->icon('heroicon-m-arrow-top-right-on-square')
                                ->url(fn ($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                        ),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Experience & Credentials')
                ->schema([

                    Forms\Components\Textarea::make('notable_clients')
                        ->label('Notable Clients')
                        ->rows(3),
                    Forms\Components\Textarea::make('press_features')
                        ->label('Press & Awards')
                        ->rows(3),
                ])
                ->columnSpanFull(),

            Section::make('Artist Statement')
                ->schema([
                    Forms\Components\Textarea::make('bio')
                        ->label('Artist Biography')
                        ->required()
                        ->rows(6),

                    Forms\Components\TextInput::make('source')
                        ->label('How they heard about us')
                        ->disabled(),
                ])
                ->columnSpanFull(),

            Section::make('Application Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Application Status')
                        ->options([
                            'pending' => 'Pending Review',
                            'approved' => 'Admitted to Talent',
                            'rejected' => 'Declined',
                        ])
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Section::make('Media Gallery')
                ->description('Portfolio links provided by the applicant')
                ->schema([
                    Forms\Components\Repeater::make('gallery')
                        ->relationship('gallery')
                        ->schema([
                            Forms\Components\TextInput::make('url')
                                ->label('Media URL')
                                ->url()
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpan(2)
                                ->suffixAction(
                                    Action::make('openMedia')
                                        ->icon('heroicon-m-arrow-top-right-on-square')
                                        ->url(fn ($state) => $state)
                                        ->openUrlInNewTab()
                                        ->visible(fn ($state) => ! empty($state) && filter_var($state, FILTER_VALIDATE_URL))
                                ),
                            Forms\Components\TextInput::make('title')
                                ->label('Title')
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('description')
                                ->label('Description')
                                ->columnSpan(1),
                            TextEntry::make('media_preview')
                                ->label('Media Preview')
                                ->state(fn ($get) => new HtmlString(MediaPreviewHelper::getPreviewHtml($get('url'))))
                                ->visible(fn ($get) => ! empty($get('url')) && filter_var($get('url'), FILTER_VALIDATE_URL))
                                ->columnSpanFull(),
                        ])
                        ->columns(4)
                        ->defaultItems(0)
                        ->reorderable(true)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('artist_name')
                    ->label('Act / Performer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Professional Email'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'approved' => 'Admitted to Talent',
                        'rejected' => 'Declined',
                        default => 'Pending Review',
                    }),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Admit to Talent')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->hidden(fn (Submission $record) => $record->status !== 'pending')
                    ->action(function (Submission $record) {
                        $record->update(['status' => 'approved']);

                        // Find or create category based on the string value from submission
                        $category = Category::firstOrCreate(['name' => $record->category]);

                        // Automatically create the Talent profile
                        $talent = Talent::create([
                            'name' => $record->artist_name,
                            'talent_type' => $record->talent_type ?? 'individual',
                            'member_count' => $record->member_count,
                            'email' => $record->email,
                            'category_id' => $category->id,
                            'bio' => $record->bio,
                            'location' => $record->location,
                            'starting_price' => CurrencyHelper::convertToUsd((float) ($record->min_rate ?? 0), $record->currency ?? 'USD'),
                            'genre' => $record->genre,
                            'years_active' => $record->years_active,
                            'website_url' => $record->website_url,
                            'instagram_handle' => $record->instagram_handle,
                            'facebook_url' => $record->facebook_url,
                            'youtube_channel' => $record->youtube_channel,
                            'tiktok_handle' => $record->tiktok_handle,
                            'primary_image_url' => $record->profile_photo_url,
                            'status' => 'awaiting_agreement',
                            'slug' => Str::slug($record->artist_name),
                        ]);

                        // Send Agreement Email
                        Mail::to($talent->email)->send(new TalentAgreementMail($talent));

                        // Sync Gallery Items
                        foreach ($record->gallery as $item) {
                            $talent->gallery()->create([
                                'url' => $item->url,
                                'title' => $item->title,
                                'description' => $item->description,
                            ]);
                        }

                        Notification::make()
                            ->title('Act Admitted to Agency Talent')
                            ->body('A new talent profile has been initialized based on this application.')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\Submissions;

use App\Filament\Resources\Submissions\Pages;
use App\Models\Submission;
use App\Models\Talent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static string|UnitEnum|null $navigationGroup = 'A&R / Talent Procurement';

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
            \Filament\Schemas\Components\Section::make('Applicant Personal Information')
                ->schema([
                    Forms\Components\TextInput::make('artist_name')
                        ->label('Performer / Act Name')
                        ->required()
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
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Professional Details')
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
                        ->label('Minimum Rate (₦)')
                        ->numeric()
                        ->prefix('₦')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('max_rate')
                        ->label('Maximum Rate (₦)')
                        ->numeric()
                        ->prefix('₦')
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Online Presence')
                ->schema([
                    Forms\Components\TextInput::make('website_url')
                        ->label('Website')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('instagram_handle')
                        ->label('Instagram')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('youtube_channel')
                        ->label('YouTube')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('tiktok_handle')
                        ->label('TikTok')
                        ->url()
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Experience & Credentials')
                ->schema([
                    Forms\Components\Textarea::make('notable_venues')
                        ->label('Notable Venues')
                        ->rows(3),
                    Forms\Components\Textarea::make('notable_clients')
                        ->label('Notable Clients')
                        ->rows(3),
                    Forms\Components\Textarea::make('press_features')
                        ->label('Press & Awards')
                        ->rows(3),
                ])
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Artist Statement')
                ->schema([
                    Forms\Components\Textarea::make('bio')
                        ->label('Artist Biography')
                        ->required()
                        ->rows(6),
                    Forms\Components\Textarea::make('motivation')
                        ->label('Motivation to Join')
                        ->rows(4),
                    Forms\Components\TextInput::make('source')
                        ->label('How they heard about us')
                        ->disabled(),
                ])
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Application Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Application Status')
                        ->options([
                            'pending'  => 'Pending Review',
                            'approved' => 'Admitted to Talent',
                            'rejected' => 'Declined',
                        ])
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            \Filament\Schemas\Components\Section::make('Media Gallery')
                ->description('Portfolio links provided by the applicant')
                ->schema([
                    Forms\Components\Repeater::make('gallery')
                        ->relationship('gallery')
                        ->schema([
                            Forms\Components\TextInput::make('url')
                                ->label('Media URL')
                                ->url()
                                ->required()
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('title')
                                ->label('Title')
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('description')
                                ->label('Description')
                                ->columnSpan(1),
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
                        $category = \App\Models\Category::firstOrCreate(['name' => $record->category]);

                        // Automatically create the Talent profile
                        $talent = Talent::create([
                            'name' => $record->artist_name,
                            'category_id' => $category->id,
                            'bio' => $record->bio,
                            'location' => $record->location,
                            'starting_price' => $record->min_rate,
                            'genre' => $record->genre,
                            'years_active' => $record->years_active,
                            'website_url' => $record->website_url,
                            'instagram_handle' => $record->instagram_handle,
                            'facebook_url' => $record->facebook_url,
                            'youtube_channel' => $record->youtube_channel,
                            'tiktok_handle' => $record->tiktok_handle,
                            'primary_image_url' => $record->profile_photo_url,
                            'status' => 'active',
                            'slug' => \Illuminate\Support\Str::slug($record->artist_name),
                        ]);

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
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
            \Filament\Schemas\Components\Section::make('Applicant Details')
                ->schema([
                    Forms\Components\TextInput::make('artist_name')
                        ->label('Performer / Act Name')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('email')
                        ->label('Professional Email')
                        ->email()
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('epk_link')
                        ->url()
                        ->label('Electronic Press Kit (EPK)')
                        ->columnSpanFull(),
                ])
                ->columns(2)
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
                ->description('Links to media provided by the applicant')
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
                Tables\Columns\TextColumn::make('epk_link')
                    ->label('EPK')
                    ->copyable(),
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
                        // Automatically create the Talent profile
                        $talent = Talent::create([
                            'name' => $record->artist_name,
                            'category_id' => 1, // Default, admin adjusts later
                            'bio' => $record->bio,
                            'location' => $record->location,
                            'starting_price' => (float)$record->minimum_fee,
                            'video_url' => $record->youtube_url ?? $record->epk_link,
                            'status' => 'active',
                            'slug' => \Illuminate\Support\Str::slug($record->artist_name),
                        ]);

                        // Sync Gallery Items
                        foreach ($record->gallery as $item) {
                            $talent->gallery()->create([
                                'url' => $item->url,
                                'title' => $item->title,
                                'description' => $item->description,
                                'sort_order' => $item->sort_order,
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
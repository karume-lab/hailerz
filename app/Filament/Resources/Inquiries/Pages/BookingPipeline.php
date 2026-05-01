<?php

namespace App\Filament\Resources\Inquiries\Pages;

use App\Enums\InquiryStatus;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Models\Inquiry;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class BookingPipeline extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = InquiryResource::class;

    protected string $view = 'filament.resources.inquiries.pages.booking-pipeline';

    protected static ?string $title = 'Booking Pipeline';

    protected static ?string $navigationLabel = 'Pipeline (Kanban)';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-view-columns';

    #[Url(as: 'view', history: true)]
    public string $activeView = 'kanban';

    public array $inquiries = [];

    public function mount(): void
    {
        $this->loadInquiries();
    }

    public function loadInquiries(): void
    {
        $this->inquiries = Inquiry::with('talent')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(fn (Inquiry $i) => $i->status->value)
            ->map(fn ($group) => $group->map(fn (Inquiry $i) => [
                'id'          => $i->id,
                'client_name' => $i->client_name,
                'event_date'  => $i->event_date ? \Illuminate\Support\Carbon::parse($i->event_date)->format('M d, Y') : null,
                'talent_name' => $i->talent?->name ?? 'General Inquiry',
                'budget'      => $i->budget ? '₦' . number_format((float) $i->budget, 0) : 'TBC',
                'status'      => $i->status->value,
                'edit_url'    => InquiryResource::getUrl('edit', ['record' => $i->id]),
            ])->values()->toArray())
            ->toArray();
    }

    #[On('move-card')]
    public function moveCard(int $id, string $status): void
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = InquiryStatus::from($status);
        $inquiry->save();

        $this->loadInquiries();
    }

    public function getStatuses(): array
    {
        return InquiryStatus::cases();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Inquiry::query())
            ->columns([
                TextColumn::make('client_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('talent.name')
                    ->label('Talent')
                    ->sortable(),
                TextColumn::make('event_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('budget')
                    ->money('NGN')
                    ->sortable(),
                SelectColumn::make('status')
                    ->options(collect(InquiryStatus::cases())->mapWithKeys(
                        fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                    ))
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                \Filament\Actions\EditAction::make(),
            ]);
    }

    public function toggleView(string $view): void
    {
        $this->activeView = $view;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('new_inquiry')
                ->label('New Inquiry')
                ->icon('heroicon-o-plus')
                ->url(InquiryResource::getUrl('create')),
        ];
    }
}

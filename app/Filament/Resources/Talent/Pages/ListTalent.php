<?php

namespace App\Filament\Resources\Talent\Pages;

use App\Filament\Resources\Talent\TalentResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTalent extends ListRecords
{
    protected static string $resource = TalentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['all' => Tab::make('All')];

        $categories = Category::all();
        foreach ($categories as $category) {
            $tabs[$category->slug] = Tab::make($category->name)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category_id', $category->id));
        }

        return $tabs;
    }
}

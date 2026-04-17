<?php

namespace App\Filament\Resources\Talent\Pages;

use App\Filament\Resources\Talent\TalentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

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
        $tabs = ['all' => \Filament\Schemas\Components\Tabs\Tab::make('All')];
        
        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            $tabs[$category->slug] = \Filament\Schemas\Components\Tabs\Tab::make($category->name)
                ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('category_id', $category->id));
        }
        
        return $tabs;
    }
}

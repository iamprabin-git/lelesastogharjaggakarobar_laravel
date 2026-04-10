<?php

namespace App\Filament\Pages;

use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;
use App\Filament\Widgets\CrmStatsOverview;
use App\Livewire\CrmLeadsTable;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class CrmConsole extends Page
{
    protected static ?string $title = 'CRM workspace';

    protected static ?string $navigationLabel = 'Full CRM';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'crm';

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getHeading(): string
    {
        return 'CRM workspace';
    }

    public function getSubheading(): ?string
    {
        return 'Land-sales funnel: contact → site visit → offer → pending close. Live table, mailto actions, and bulk stage moves.';
    }

    /**
     * @return array<Action | \Filament\Actions\ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('addLead')
                ->label('Add lead')
                ->icon(Heroicon::OutlinedPlus)
                ->url(PropertyInquiryResource::getUrl('create'))
                ->color('success'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            CrmStatsOverview::class,
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Livewire::make(CrmLeadsTable::class),
            ]);
    }
}

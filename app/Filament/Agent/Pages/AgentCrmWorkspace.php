<?php

namespace App\Filament\Agent\Pages;

use App\Filament\Agent\Resources\LandLeads\LandLeadResource;
use App\Filament\Agent\Widgets\AgentCrmStatsOverview;
use App\Livewire\CrmLeadsTable;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class AgentCrmWorkspace extends Page
{
    protected static ?string $title = 'Sales workspace';

    protected static ?string $navigationLabel = 'Sales workspace';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'sales-workspace';

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getHeading(): string
    {
        return 'Land sales workspace';
    }

    public function getSubheading(): ?string
    {
        return 'Track your buyers from first contact through site visit, offer, and close.';
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
                ->url(LandLeadResource::getUrl('create'))
                ->color('success'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            AgentCrmStatsOverview::class,
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Livewire::make(CrmLeadsTable::class, fn (): array => [
                    'scopedAgentId' => Auth::guard('agent')->id(),
                ]),
            ]);
    }
}

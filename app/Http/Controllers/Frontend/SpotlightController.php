<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MonthlySpotlight;
use Inertia\Inertia;

class SpotlightController extends Controller
{
    /**
     * @return array<string, mixed>|null
     */
    private function payload(?MonthlySpotlight $spotlight): ?array
    {
        if ($spotlight === null) {
            return null;
        }

        return [
            'kind' => $spotlight->kind,
            'honoree_name' => $spotlight->honoree_name,
            'subtitle' => $spotlight->subtitle,
            'period_label' => $spotlight->period_label,
            'page_title' => $spotlight->page_title,
            'image' => $spotlight->image ? asset('storage/'.$spotlight->image) : null,
            'congratulations_html' => $spotlight->congratulations_html,
            'is_published' => $spotlight->is_published,
        ];
    }

    public function agentOfMonth()
    {
        $spotlight = MonthlySpotlight::query()
            ->where('kind', MonthlySpotlight::KIND_AGENT_OF_MONTH)
            ->first();

        return Inertia::render('Spotlights/Show', [
            'variant' => 'agent',
            'spotlight' => $this->payload($spotlight),
        ]);
    }

    public function buyerOfMonth()
    {
        $spotlight = MonthlySpotlight::query()
            ->where('kind', MonthlySpotlight::KIND_BUYER_OF_MONTH)
            ->first();

        return Inertia::render('Spotlights/Show', [
            'variant' => 'buyer',
            'spotlight' => $this->payload($spotlight),
        ]);
    }
}

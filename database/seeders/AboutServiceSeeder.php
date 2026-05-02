<?php

namespace Database\Seeders;

use App\Models\AboutService;
use Illuminate\Database\Seeder;

class AboutServiceSeeder extends Seeder
{
    public function run(): void
    {
        if (AboutService::query()->exists()) {
            return;
        }

        $rows = [
            ['title' => 'Affordable Listings', 'description' => 'We specialize in “Sasto” (affordable) plots and houses so budget-conscious buyers can find a place to call home.', 'icon' => 'Banknote', 'sort_order' => 10],
            ['title' => 'Targeted Property Marketing', 'description' => 'We use modern digital tools and local networking so sellers’ listings reach the right buyers quickly.', 'icon' => 'Megaphone', 'sort_order' => 20],
            ['title' => 'Legal & Paperwork Assistance', 'description' => 'Our team handles Malpot and municipal documentation so ownership transfers stay fully legal.', 'icon' => 'Scale', 'sort_order' => 30],
            ['title' => 'Buyer Representation', 'description' => 'We match your budget and location preferences—including “hidden gems” not widely advertised.', 'icon' => 'UserSearch', 'sort_order' => 40],
            ['title' => 'Market Valuation', 'description' => 'Honest valuations based on local trends so you neither overpay nor undersell.', 'icon' => 'LineChart', 'sort_order' => 50],
            ['title' => 'Property Tours', 'description' => 'Guided visits across Lele and nearby areas with insight into future development potential.', 'icon' => 'MapPinned', 'sort_order' => 60],
            ['title' => 'Investment Consultation', 'description' => 'Data-driven guidance on agricultural land, residential plots, and emerging growth corridors.', 'icon' => 'Briefcase', 'sort_order' => 70],
            ['title' => 'Negotiation Excellence', 'description' => 'We mediate fairly so buyers and sellers reach prices that work for both sides.', 'icon' => 'Handshake', 'sort_order' => 80],
        ];

        foreach ($rows as $row) {
            AboutService::query()->create([
                ...$row,
                'is_active' => true,
            ]);
        }
    }
}

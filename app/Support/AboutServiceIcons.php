<?php

namespace App\Support;

/**
 * Icon keys map to lucide-react components on the About page (same string keys).
 */
class AboutServiceIcons
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            'Banknote' => 'Banknote — Affordable / pricing',
            'Megaphone' => 'Megaphone — Marketing',
            'Scale' => 'Scale — Legal / fairness',
            'UserSearch' => 'User search — Buyer match',
            'LineChart' => 'Line chart — Valuation / trends',
            'MapPinned' => 'Map pinned — Tours / location',
            'Briefcase' => 'Briefcase — Investment',
            'Handshake' => 'Handshake — Negotiation',
            'Home' => 'Home — Property / listings',
            'ShieldCheck' => 'Shield — Trust / verification',
            'Building2' => 'Building — Commercial',
            'CircleHelp' => 'Help — Generic',
        ];
    }

    public static function default(): string
    {
        return 'CircleHelp';
    }
}

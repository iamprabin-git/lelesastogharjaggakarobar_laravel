<?php

namespace App\Crm;

final class LeadSource
{
    public const WEBSITE = 'website';

    public const REFERRAL = 'referral';

    public const SOCIAL = 'social';

    public const WALK_IN = 'walk_in';

    public const PHONE = 'phone';

    public const AGENT_OUTREACH = 'agent_outreach';

    public const OTHER = 'other';

    /** Admin or agent typed the lead directly in the CRM. */
    public const CRM_MANUAL = 'crm_manual';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::CRM_MANUAL => 'Manual entry (CRM)',
            self::WEBSITE => 'Website inquiry',
            self::REFERRAL => 'Referral',
            self::SOCIAL => 'Social / ads',
            self::WALK_IN => 'Walk-in / office',
            self::PHONE => 'Phone',
            self::AGENT_OUTREACH => 'Agent outreach',
            self::OTHER => 'Other',
        ];
    }

    public static function label(?string $source): string
    {
        if ($source === null || $source === '') {
            return '—';
        }

        return self::options()[$source] ?? ucfirst(str_replace('_', ' ', $source));
    }
}

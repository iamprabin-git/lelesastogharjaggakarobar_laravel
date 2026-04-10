<?php

namespace App\Crm;

/**
 * Land / real-estate sales pipeline stages (industry-style funnel).
 */
final class CrmLeadStage
{
    public const NEW = 'new';

    public const CONTACTED = 'contacted';

    public const QUALIFIED = 'qualified';

    public const SITE_VISIT = 'site_visit';

    public const OFFER = 'offer';

    public const PENDING_CLOSE = 'pending_close';

    public const CLOSED_WON = 'closed_won';

    public const CLOSED_LOST = 'closed_lost';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::NEW => 'New',
            self::CONTACTED => 'Contacted',
            self::QUALIFIED => 'Qualified',
            self::SITE_VISIT => 'Site visit / inspection',
            self::OFFER => 'Offer & negotiation',
            self::PENDING_CLOSE => 'Pending close / settlement',
            self::CLOSED_WON => 'Closed — won',
            self::CLOSED_LOST => 'Closed — lost',
        ];
    }

    public static function label(?string $stage): string
    {
        if ($stage === null || $stage === '') {
            return '—';
        }

        return self::options()[$stage] ?? ucfirst(str_replace('_', ' ', $stage));
    }

    /**
     * Filament badge color name.
     */
    public static function color(?string $stage): string
    {
        return match ($stage) {
            self::NEW => 'gray',
            self::CONTACTED => 'info',
            self::QUALIFIED => 'primary',
            self::SITE_VISIT => 'warning',
            self::OFFER => 'warning',
            self::PENDING_CLOSE => 'success',
            self::CLOSED_WON => 'success',
            self::CLOSED_LOST => 'danger',
            default => 'gray',
        };
    }

    /**
     * Open pipeline (not terminal).
     */
    public static function isOpen(?string $stage): bool
    {
        return ! in_array($stage, [self::CLOSED_WON, self::CLOSED_LOST], true);
    }

    /**
     * Ordered list for funnel-style stats.
     *
     * @return list<string>
     */
    public static function orderedOpenStages(): array
    {
        return [
            self::NEW,
            self::CONTACTED,
            self::QUALIFIED,
            self::SITE_VISIT,
            self::OFFER,
            self::PENDING_CLOSE,
        ];
    }
}

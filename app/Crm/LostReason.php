<?php

namespace App\Crm;

final class LostReason
{
    public const PRICE = 'price';

    public const LOCATION = 'location';

    public const TIMING = 'timing';

    public const FINANCING = 'financing';

    public const COMPETITOR = 'competitor';

    public const NO_RESPONSE = 'no_response';

    public const OTHER = 'other';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::PRICE => 'Price / budget',
            self::LOCATION => 'Location / plot fit',
            self::TIMING => 'Timing',
            self::FINANCING => 'Financing / legal',
            self::COMPETITOR => 'Chose another seller',
            self::NO_RESPONSE => 'No response',
            self::OTHER => 'Other',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySpotlight extends Model
{
    public const KIND_AGENT_OF_MONTH = 'agent_of_month';

    public const KIND_BUYER_OF_MONTH = 'buyer_of_month';

    protected $fillable = [
        'kind',
        'honoree_name',
        'subtitle',
        'period_label',
        'page_title',
        'image',
        'congratulations_html',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    /** @return array<string, string> */
    public static function kindLabels(): array
    {
        return [
            self::KIND_AGENT_OF_MONTH => 'Agent of the month',
            self::KIND_BUYER_OF_MONTH => 'Buyer of the month',
        ];
    }
}

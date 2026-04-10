<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPropertySearch extends Model
{
    protected $fillable = [
        'user_id',
        'keyword',
        'city',
        'type',
        'bedrooms',
        'min_price',
        'max_price',
        'sort',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function summaryLabel(): string
    {
        $parts = [];

        if (filled($this->keyword)) {
            $parts[] = '"'.$this->keyword.'"';
        }
        if (filled($this->city)) {
            $parts[] = $this->city;
        }
        if (filled($this->type)) {
            $parts[] = $this->type === 'sale' ? 'For sale' : ($this->type === 'rent' ? 'For rent' : $this->type);
        }
        if (filled($this->bedrooms)) {
            $parts[] = $this->bedrooms === '4' ? '4+ beds' : $this->bedrooms.' bed';
        }
        if (filled($this->min_price) || filled($this->max_price)) {
            $range = 'Rs. ';
            $range .= filled($this->min_price) ? number_format((float) $this->min_price) : '…';
            $range .= ' – ';
            $range .= filled($this->max_price) ? number_format((float) $this->max_price) : '…';
            $parts[] = $range;
        }
        if (filled($this->sort)) {
            $parts[] = $this->sort === 'low_high' ? 'Price ↑' : 'Price ↓';
        }

        return $parts !== [] ? implode(' · ', $parts) : 'All listings';
    }

    /**
     * @return array<string, string>
     */
    public function queryParams(): array
    {
        $out = [];
        foreach (['keyword', 'city', 'type', 'bedrooms', 'min_price', 'max_price', 'sort'] as $key) {
            $v = $this->{$key};
            if (filled($v)) {
                $out[$key] = (string) $v;
            }
        }

        return $out;
    }

    public static function pruneForUser(int $userId, int $keep = 15): void
    {
        $ids = static::query()
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->skip($keep)
            ->pluck('id');

        if ($ids->isNotEmpty()) {
            static::query()->whereIn('id', $ids)->delete();
        }
    }
}

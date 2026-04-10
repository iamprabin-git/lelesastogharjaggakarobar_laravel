<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];

    /**
     * @return list<array{id: int, question: string, answer: string}>
     */
    public static function activeForInertia(): array
    {
        return static::query()
            ->where('is_active', true)
            ->latest()
            ->get()
            ->map(fn (self $f) => [
                'id' => $f->id,
                'question' => $f->question,
                'answer' => $f->answer,
            ])
            ->values()
            ->all();
    }
}

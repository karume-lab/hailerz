<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\InquiryStatus;

/**
 * @property \Carbon\Carbon|null $event_date
 */
class Inquiry extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'expected_guests' => 'integer',
            'status' => InquiryStatus::class,
        ];
    }

    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }

    public function getClientNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getClientEmailAttribute(): string
    {
        return $this->email;
    }
}

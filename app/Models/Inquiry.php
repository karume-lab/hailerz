<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\InquiryStatus;

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
}

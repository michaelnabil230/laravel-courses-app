<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QaMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'topic_id',
        'sender_id',
        'content',
        'read_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the topic that owns the QaMessage
     *
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(QaTopic::class);
    }

    /**
     * Get the sender associated with the QaMessage
     *
     * @return HasOne
     */
    public function sender(): HasOne
    {
        return $this->hasOne(Admin::class, 'id', 'sender_id')->withTrashed();
    }
}

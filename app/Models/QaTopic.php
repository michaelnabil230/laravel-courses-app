<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QaTopic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'creator_id',
        'receiver_id',
        'sent_at',
    ];

    /**
     * Get all of the messages for the QaTopic
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(QaMessage::class, 'topic_id')->latest();
    }

    /**
     * Get count of messages unread for the QaTopic
     *
     * @return int
     */
    public static function unreadCount(): int
    {
        $topics = self::where(function (Builder $query) {
            return $query->where('creator_id', auth('admin')->id())
                ->orWhere('receiver_id', auth('admin')->id());
        })
            ->with('messages')
            ->latest()
            ->get();

        $unreadCount = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== auth('admin')->id() && $message->read_at === null) {
                    $unreadCount++;
                }
            }
        }

        return $unreadCount;
    }

    /**
     * If exists, get the last message for the QaTopic
     *
     * @return bool
     */
    public function hasUnreads(): bool
    {
        return $this->messages()->whereNull('read_at')->where('sender_id', '!=', auth('admin')->id())->exists();
    }

    /**
     * Get the receiver or creator of the QaTopic
     *
     * @return Admin
     */
    public function receiverOrCreator(): Admin
    {
        return $this->creator_id === auth('admin')->id()
            ? Admin::withTrashed()->findOrFail($this->receiver_id)
            : Admin::withTrashed()->findOrFail($this->creator_id);
    }
}

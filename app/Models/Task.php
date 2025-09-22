<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_completed',
    ];

    /**
     * @return BelongsTo<User,Task>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Notification extends EloquentModel
{
use HasFactory;
protected $fillable = [
    'member_id',
    'title',
    'message',
    'type',
    'is_read',
    'read_at',
];

protected $casts = [
    'is_read' => 'boolean',
    'read_at' => 'datetime',
];

// Relasi ke member
public function member(): BelongsTo
{
    return $this->belongsTo(Member::class);
}

// Method untuk tandai sudah dibaca
public function markAsRead(): void
{
    $this->update([
        'is_read' => true,
        'read_at' => now(),
    ]);
}


}
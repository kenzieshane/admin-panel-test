<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class LibraryVisit extends Model
{
use HasFactory;
protected $fillable = [
    'member_id',
    'check_in',
    'check_out',
    'purpose',
];

protected $casts = [
    'check_in' => 'datetime',
    'check_out' => 'datetime',
];

// Relasi ke member
public function member(): BelongsTo
{
    return $this->belongsTo(Member::class);
}

// Method untuk hitung durasi kunjungan
public function getDuration(): ?int
{
    if (!$this->check_out) {
        return null;
    }

    return $this->check_in->diffInMinutes($this->check_out);
}


}

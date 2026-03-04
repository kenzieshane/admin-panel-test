<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class QrCode extends Model
{
use HasFactory;
protected $fillable = [
    'member_id',
    'code',
    'qr_image',
    'is_active',
    'last_used_at',
];

protected $casts = [
    'is_active' => 'boolean',
    'last_used_at' => 'datetime',
];

// Relasi ke member
public function member(): BelongsTo
{
    return $this->belongsTo(Member::class);
}

// Generate kode QR unik saat dibuat
protected static function boot()
{
    parent::boot();

    static::creating(function ($qrCode) {
        if (empty($qrCode->code)) {
            $qrCode->code = Str::upper(Str::random(10));
        }
    });
}


}

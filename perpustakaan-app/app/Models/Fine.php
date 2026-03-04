<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Fine extends Model
{
use HasFactory;
protected $fillable = [
    'borrowing_id',
    'member_id',
    'amount',
    'days_late',
    'daily_rate',
    'status',
    'paid_date',
    'payment_method',
    'notes',
];

protected $casts = [
    'amount' => 'decimal:2',
    'daily_rate' => 'decimal:2',
    'paid_date' => 'date',
];

// Relasi ke peminjaman
public function borrowing(): BelongsTo
{
    return $this->belongsTo(Borrowing::class);
}

// Relasi ke member
public function member(): BelongsTo
{
    return $this->belongsTo(Member::class);
}

// Method untuk hitung denda otomatis
public static function calculateFine(Borrowing $borrowing): float
{
    $daysLate = $borrowing->getDaysLate();
    $dailyRate = 1000; // Rp 1.000 per hari
    return $daysLate * $dailyRate;
}


}

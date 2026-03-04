<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
class Borrowing extends Model
{
use HasFactory;
protected $fillable = [
    'borrowing_code',
    'member_id',
    'book_id',
    'borrowed_by',
    'borrowed_date',
    'due_date',
    'returned_date',
    'status',
    'notes',
];

protected $casts = [
    'borrowed_date' => 'date',
    'due_date' => 'date',
    'returned_date' => 'date',
];

// Relasi ke member
public function member(): BelongsTo
{
    return $this->belongsTo(Member::class);
}

// Relasi ke buku
public function book(): BelongsTo
{
    return $this->belongsTo(Book::class);
}

// Relasi ke user (pustakawan yang memproses)
public function borrowedBy(): BelongsTo
{
    return $this->belongsTo(User::class, 'borrowed_by');
}

// Relasi ke denda
public function fine(): HasOne
{
    return $this->hasOne(Fine::class);
}

// Method untuk cek apakah terlambat
public function isOverdue(): bool
{
    return $this->status === 'borrowed' 
        && $this->due_date < now();
}

// Method untuk hitung hari terlambat
public function getDaysLate(): int
{
    if ($this->status !== 'overdue' && !$this->isOverdue()) {
        return 0;
    }

    $returnDate = $this->returned_date ?? now();
    return $this->due_date->diffInDays($returnDate);
}

// Method untuk generate kode peminjaman otomatis
protected static function boot()
{
    parent::boot();

    static::creating(function ($borrowing) {
        if (empty($borrowing->borrowing_code)) {
            $borrowing->borrowing_code = 'BRW-' . date('Ymd') . '-' . rand(1000, 9999);
        }
    });
}


}

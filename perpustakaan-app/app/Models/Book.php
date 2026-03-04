<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Book extends Model
{
use HasFactory;
protected $fillable = [
    'isbn',
    'title',
    'author',
    'publisher',
    'publication_year',
    'category_id',
    'description',
    'cover_image',
    'total_copies',
    'available_copies',
    'location',
    'condition',
];

// Relasi: Buku milik satu kategori
public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}

// Relasi: Satu buku punya banyak peminjaman
public function borrowings(): HasMany
{
    return $this->hasMany(Borrowing::class);
}

// Method helper untuk cek apakah buku tersedia
public function isAvailable(): bool
{
    return $this->available_copies > 0;
}

// Method untuk kurangi stok saat dipinjam
public function decreaseStock(): void
{
    if ($this->available_copies > 0) {
        $this->decrement('available_copies');
    }
}

// Method untuk tambah stok saat dikembalikan
public function increaseStock(): void
{
    if ($this->available_copies < $this->total_copies) {
        $this->increment('available_copies');
    }
}


}

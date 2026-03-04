<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
    'member_code',
    'name',
    'email',
    'phone',
    'address',
    'date_of_birth',
    'gender',
    'photo',
    'membership_start',
    'membership_end',
    'status',
];

protected $casts = [
    'date_of_birth' => 'date',
    'membership_start' => 'date',
    'membership_end' => 'date',
];

public function borrowings(): HasMany
{
    return $this->hasMany(Borrowing::class);
}

public function fines(): HasMany
{
    return $this->hasMany(Fine::class);
}

public function qrCode(): HasOne
{
    return $this->hasOne(QrCode::class);
}

public function visits(): HasMany
{
    return $this->hasMany(LibraryVisit::class);
}

public function notifications(): HasMany
{
    return $this->hasMany(Notification::class);

}
public function isActive(): bool
{
    return $this->status === 'active' 
        && $this->membership_end >= now();
}



}

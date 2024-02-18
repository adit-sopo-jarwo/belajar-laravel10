<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';
    protected $table = 'password_reset_tokens';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}
<?php

namespace App\Models; // Namespace doğru olmalı

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'is_completed'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // BUNI QO‘SHING
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

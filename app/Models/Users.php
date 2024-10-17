<?php

namespace App\Models;

use App\Models\Elearning\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $connection = 'elearning';

    public function guru() {
        return $this->belongsTo(Guru::class, 'user_id');
    }
}

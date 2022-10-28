<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'image',
        'date_of_birth',
        'address',
        'gender'
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}

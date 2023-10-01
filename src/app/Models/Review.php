<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'shop_id',
        'review',
        ];
    
    public function reviewPost(){

        return $this->hasOne('App\Models\ReviewPost');
    }
}
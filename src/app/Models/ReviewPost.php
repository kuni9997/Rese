<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewPost extends Model
{
    use HasFactory;

    protected $table = 'reviewPosts';

    protected $fillable = [
        'review_id',
        'review_text',
        'review_pic'
    ];
}
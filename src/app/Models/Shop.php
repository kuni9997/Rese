<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'registered_id',
        'shop_name',
        'area',
        'genre',
        'shop_desc',
        'pic_url'
    ];

    public function scopeWhereAreas($query, $area)
    {
        if ($area != '') {
            $query->where('area', $area);
        }
    }

    public function scopeWhereGenres($query, $genre)
    {
        if ($genre != '') {
            $query->where('genre', $genre);
        }
    }

    public function scopeWhereShopsName($query, $shop_name)
    {
        if ($shop_name){
            $query->where('shop_name', 'like', "%$shop_name%");
        }
    }

    public function Reservation(){
        return $this->hasMany(Reservation::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * The reviews of a product
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function facturas()
    {
        return $this->belongsToMany(factura::class);
    }
}

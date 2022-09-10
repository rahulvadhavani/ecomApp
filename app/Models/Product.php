<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'user_id'
    ];
    const IMAGEPATH = 'product/images';

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value != null? url(self::IMAGEPATH,$value) : url('images/placeholder.png'),
        );
    }
}

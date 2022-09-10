<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quantity',
        'product_id'
    ];

    static function cartCount()
    {
        $userId = auth()->user()->id ?? 0;
        $cartCount = self::where('user_id', $userId)->count();
        return $cartCount;
    }
    
    static function totalcartAmount()
    {
        try {
            //code...
            $userId = auth()->user()->id ?? 0;
            $items = self::where('user_id', $userId)->with('product')->get();
            $amount = 0;
            foreach ($items as $item) {
                $amount = $amount + ($item->quantity * $item->product->price);
            }
        } catch (\Throwable $th) {
            return 0;
        }
        return $amount;
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

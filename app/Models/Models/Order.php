<?php

namespace App\Models\Models;

use App\Models\User;
use App\Models\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'identify', 'code', 'status', 'payment_method', 'date'];

    //Relacionamentos com produtos - Muitos para Muitos
    public function products()
    {
        return $this->belongsToMany(Product::class, 'sales')
                        ->withPivot('qty', 'price');
    }

    //Relacionamento de usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }  

}

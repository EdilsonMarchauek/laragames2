<?php

namespace App\Models\Models;


use App\Models\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['category_id', 'name', 'url', 'price', 'photo', 'description'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByPrice', function(Builder $builder){

            $builder->orderBy('price', 'asc');
            
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Has Many - Relacionamento de um para muitos
    public function imageProduct()
    {
        // return $this->hasMany(Images::class, 'product_id', 'id'); // nome da chave estrangeira
        return $this->hasMany(Images::class, 'product_id', 'id');
    }
}

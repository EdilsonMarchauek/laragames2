<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['image', 'product_id'];

    public function product()
    {
    return $this->belongsTo(Product::class, 'product_id');
    }
}

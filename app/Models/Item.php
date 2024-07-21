<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items'; // Specify the custom table name

    protected $fillable = [
        'category',
        'name',
        'sku',
        'description',
        'price',
        'count',
        'added_date',
        'remarks',
    ];

    protected $casts = [
        'added_date' => 'datetime', // Cast to Carbon instance
    ];

    public function categoryname()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}

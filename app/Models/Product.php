<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock','photo', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $searchQuery)
    {
        if (!empty($searchQuery)) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        }
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['category'])) {
            $query->whereHas('category', function ($catQuery) use ($filters) {
                $catQuery->where('name', $filters['category']);
            });
        }
    }
    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'price-low-high':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high-low':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }

}

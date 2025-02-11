<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'name'
    ];
    
    public function products(): HasMany 
    {
        return $this->hasMany(Product::class);
    }

    public function avaiableProducts(): int
    {
    	return $this->products()->where('status', 1)->count();    	
    }

    public function unavaiableProducts(): int
    {
    	return $this->products->where('status', 0)->count();
    }
}

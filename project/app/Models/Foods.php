<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    protected $table = "food";
    protected $guarded = [];
    public $timestamps = true;

    public function category()
    {
        return $this->hasOne('App\Models\FoodCategories','id','category_id')->first();
    }
}

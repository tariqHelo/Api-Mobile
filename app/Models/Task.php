<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    
    protected $table = "tasks";

  protected $fillable = [];

     public function area()
    {
      return $this->belongsTo(Area::class , 'area_id' , 'id');
    }
    public function brand()
    {
      return $this->belongsTo(Brand::class , 'brand_id' , 'id');
    }
    public function city()
    {
      return $this->belongsTo(City::class , 'city_id' , 'id');
    }
    public function country()
    {
      return $this->belongsTo(Country::class , 'country_id' , 'id');
    }
    public function user()
    {
      return $this->belongsTo(User::class , 'user_id' , 'id');
    }
     public function branch()
     {
     return $this->belongsTo(Branche::class , 'branch_id' , 'id');
     }

}

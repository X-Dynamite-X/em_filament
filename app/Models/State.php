<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "country_id"
    ];
    public function  country() {
       return $this->belongsTo(Country::class);
    }
    public function  citys() {
        return $this->hasMany(Employee::class);
     }
     public function  employees()
     {
         return $this->hasMany(Employee::class);
     }
}

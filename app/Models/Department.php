<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',


    ];
    public function  employee() {
        return $this->hasMany(Employee::class);
     }
     public function  team()
     {
         return $this->belongsTo(Team::class);
     }
}

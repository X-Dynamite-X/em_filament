<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];
    public function  state()
    {
        return $this->hasMany(State::class);
    }
    public function  employees()
    {
        return $this->hasMany(Employee::class);
    }
}

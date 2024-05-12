<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "slug"
    ];
    public function  employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function  departments()
    {
        return $this->hasMany(Department::class);
    }


    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

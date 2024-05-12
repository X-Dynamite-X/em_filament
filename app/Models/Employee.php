<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $grade  = [];

    protected $fillable = [
        'country_id',
        'state_id',
        'city_id',
        'department_id',
        'user_id',
        'address',
        'zip_code',
        'date_of_birth',
        'date_hired',
    ];
    public function  user()
    {
        return $this->belongsTo(User::class);
    }
    public function  users()
    {
        return $this->hasMany(User::class);
    }
    public function  employee()
    {
        return $this->hasMany(Employee::class);
    }
    public function  country()
    {
        return $this->belongsTo(Country::class);
    }

    public function  state()
    {
        return $this->belongsTo(State::class);
    }
    public function  city()
    {
        return $this->belongsTo(City::class);
    }
    public function  department()
    {
        return $this->belongsTo(Department::class);
    }
    public function  team()
    {
        return $this->belongsTo(Team::class);
    }
}

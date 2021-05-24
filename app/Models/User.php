<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthday'
    ];

    public function phones()
    {
        return $this->hasMany('App\Models\Phone');
    }

    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function phone()
    {
        return $this->phones()->where('type_id', 2);
    }

    public function phoneMobile()
    {
        return $this->phones()->where('type_id', 1);
    }

    public function fullAddress()
    {
        if (!$this->address->last()) {
            return '';
        }

        return $this->address->last()->state .', '. $this->address->last()->city .''. $this->address->last()->street .', '. $this->address->last()->number .' - '. $this->address->last()->zip_code;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Restaurant extends Model
{
    use Searchable;

    protected $fillable = ['name', 'location', 'cuisine'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'location' => $this->location,
            'cuisine' => $this->cuisine,
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

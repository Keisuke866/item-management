<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public  function updateAll() {
        Item::where('name','!=','passive')->update([
            'id'=>
            'name'=>
            'status'=>
            'type'=>
            'detail'=>
        ]);
    };
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}

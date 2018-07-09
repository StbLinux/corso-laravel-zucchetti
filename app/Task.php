<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //query scopes

    public function scopeIncomplete($query)
    {
        $query->where('completed', 0);
    }

    public function scopeCompleted($query)
    {
        $query->where('completed', 1);
    }
}

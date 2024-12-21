<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public $timestamps = true;
    use HasFactory;
    public function episode_id()
    {
        return $this->belongsTo(Episode::class, 'episode_id');
    }
}

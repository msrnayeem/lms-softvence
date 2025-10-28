<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'module_id', 'source_type', 'link'];

    public function module() {
        return $this->belongsTo(Module::class);
    }
}

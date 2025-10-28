<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function all()
    {
        return DB::table('categories')->orderBy('name')->get();
    }
}

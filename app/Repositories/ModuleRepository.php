<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    public function create(array $data)
    {
        return Module::create($data);
    }
}

<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    public function create(array $data)
    {
        return Content::create($data);
    }
}

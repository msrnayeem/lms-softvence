<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function create(array $data)
    {
        return Course::create($data);
    }

    public function all()
    {
        return Course::with('category', 'modules.contents')->get();
    }

}

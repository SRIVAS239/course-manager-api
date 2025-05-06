<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function getById($id)
    {
        return Course::with('chapters')->findOrFail($id);
    }


    //for testing
    public function getAll()
    {
        // Return a hardcoded list for now
        return [
            [
                'id' => 1,
                'course_name' => 'Intro to Laravel',
                'course_desc' => 'Start building with Laravel',
                'is_active' => true,
                'teacher_id' => 5
            ],
            [
                'id' => 2,
                'course_name' => 'Advanced Laravel',
                'course_desc' => 'Master advanced Laravel topics',
                'is_active' => true,
                'teacher_id' => 6
            ]
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable=['teacher_id','course_name','course_desc','is_active'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'is_locked',
        'is_preview'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

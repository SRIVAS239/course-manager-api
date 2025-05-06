<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostCourseRequest;
use App\Repositories\CourseRepository;
use App\Models\Chapter;
use App\Models\Course;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseRepo;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->middleware('auth:api');
        $this->courseRepo = $courseRepo;
    }
    
    //post a course from a teacher
    public function store(PostCourseRequest $request){
        $user = auth()->user();

        if ($user->role !== 'teacher') {
            return response()->json(['error' => 'Only teachers can add courses'], 403);
        }

        $validated = $request->validated();
        $validated['teacher_id'] = $user->id;

        $course = $this->courseRepo->create($validated);

        if (!empty($validated['chapters'])) {
            foreach ($validated['chapters'] as $chapterData) {
                Chapter::create([
                    'course_id' => $course->id,
                    'title' => $chapterData['title'],
                    'description' => $chapterData['description'] ?? null,
                    'is_locked' => $chapterData['is_locked'] ?? false,
                    'is_preview' => $chapterData['is_preview'] ?? false,
                ]);
            }
        }

        return response()->json([
            'message' => 'Course created successfully',
            'course' => $course
        ], 201);
    }

    public function index()
    {
        $courses = $this->courseRepo->getAll();

        return response()->json([
            'courses' => $courses
        ], 200);
    }

    public function getChapters($id)
    {
        $user = auth()->user();

        $course = Course::with('chapters')->findOrFail($id);

        $chapters = $course->chapters;

        if ($user->role === 'student') {
            // Filter out locked chapters for students
            $chapters = $chapters->filter(function ($chapter) {
                return !$chapter->is_locked;
            })->values();
        }

        return response()->json([
            'course_id' => $course->id,
            'course_name' => $course->course_name,
            'chapters' => $chapters
        ], 200);
    }

}
